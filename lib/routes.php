<?php
namespace lib;
use lib\Response;

class Routes
{
    protected $uri;
    protected $err;
    protected $check = [];
    protected $segments = [];

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $separator = ["#","?", "&"];
        foreach ($separator as $key) {
            if(is_array(explode($key,$this->uri))) {
                $this->uri = explode($key,$this->uri)[0];
            }
        }
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
