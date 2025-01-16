<?php

namespace lib;

use lib\Response;
use lib\config;

class Routes
{
    protected $uri;
    protected $err;
    protected $check = [];
    protected $segments = [];

    public function __construct()
    {
        $mountURL = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
        $mountURL = str_replace(["/", "."], "-", $mountURL);
        $url = str_replace(["/", "."], "-", config::env("URL"));

        preg_match("/" . $url . "/", $mountURL, $valid);

        if (!empty($valid)) {
            $this->uri = str_replace($url, "/", $mountURL);
            $separator = ["#", "?", "&"];
            foreach ($separator as $key) {
                if (is_array(explode($key, $this->uri))) {
                    $this->uri = explode($key, $this->uri)[0];
                }
            }
        } else Response::abort(503);
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

    // Finalizar a rota
    public function exit()
    {
        if (count($this->check)) Response::abort(404);
    }
}
