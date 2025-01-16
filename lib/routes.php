<?php

namespace lib;

use lib\Response;
use lib\IsConfig;

class Routes
{
    protected $uri;
    protected $err;
    protected $check = [];
    protected $segments = [];

    public function __construct()
    {
        $mountURL = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
        $urlSTR = str_replace(["/", "."], "-", $mountURL);
        $urlENV = str_replace(["/", "."], "-", IsConfig::env("URL"));

        preg_match("/" . $urlENV . "/", $urlSTR, $valid);

        if (!empty($valid)) {
            $this->uri = str_replace(IsConfig::env("URL"), "/", $mountURL);
            $separator = ["#", "?", "&"];
            foreach ($separator as $key) {
                if (is_array(explode($key, $this->uri))) {
                    $this->uri = explode($key, $this->uri)[0];
                }
            }
        } else Response::abort(503);
        $this->IsAssets(); // Verificar se e algum asset
    }

    public function prefix($value)
    {
        $this->segments = []; // Reinicia array
        $this->segments[] = $value; // Adiciona segmento do grupo
        $this->check[] = $value; // Adiciona segmento do grupo para verificacao
        $this->err++;

        return $this;
    }

    public function group($callback)
    {
        $callback($this);
    }

    public function get($parament, $array, $no_group = false)
    {
        if ($this->header($parament, $no_group, "GET")) {
            // Obter classe e o metodo
            $class = $array[0];
            $method = $array[1];

            // Instanciar classe e chamar metodo
            $controller = new $class();
            $controller->$method();
            exit;
        }
    }

    public function post($parament, $view, $no_group = false)
    {
        if ($this->header($parament, $no_group, "POST")) {
            echo $parament;
            exit;
        }
    }

    // Verifica URL e Methodo enviado
    public function header($parament, $no_group, $method)
    {

        $this->check[] = trim($parament, '/');
        if (!$no_group) {
            $this->segments[] = $parament;
            $parament = reset($this->segments) . '/' . end($this->segments);
        }

        if ('/' . $parament == $this->uri) {
            if ($_SERVER['REQUEST_METHOD'] == $method) return true;
            else Response::abort(405);
        } else {
            $this->err++;
            return false;
        }
    }

    // Verificar se algum asset na url
    private function IsAssets()
    {
        $assets = [
            'img' => null, 
            'js' => 'application/javascript', 
            'css' => 'text/css', 
            'fonts' => null
        ];
        
        $pathURI = explode("/", $this->uri);
        foreach ($assets as $path => $value) {
            if ($pathURI[1] == $path) {
                if (isset(explode(".", end($pathURI))[1])) {
                    $filePath = __DIR__ . "/../public/" . $pathURI[1] . "/" . end($pathURI);
                    if (file_exists($filePath)) {
                        $mimeType = !is_null($value) ? $value : mime_content_type($filePath);
                        header("Content-Type: $mimeType");
                        readfile($filePath);
                        exit;
                    } else Response::abort(404);
                } else Response::abort(404);
            }
        }
    }

    // Finalizar a rota
    public function exit()
    {
        if (count($this->check)) Response::abort(404);
    }
}
