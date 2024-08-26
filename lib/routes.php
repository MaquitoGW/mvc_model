<?php

namespace lib;

class Routes
{

    protected $end;
    protected $segment;

    public function __construct()
    {
        $uri = $_SERVER['REQUEST_URI'];

        // Divide o caminho em partes com base na barra (/)
        $path = explode('/', trim($uri, '/'));

        // Pega o último valor do array resultante
        $this->end = end($path);

        // Verifica o valor anterior ao último segmento
        $this->segment = count($path) > 1 ? $path[count($path) - 2] : null;
    }

    public static function group($prefix, $callback)
    {
        $i = new self();
        $segment = $i->segment;

        if ($segment == $prefix) {
            $_SESSION['route_prefix'] = $prefix;
            $callback();
        }
    }

    public static function get($route, $view)
    {
        $i = new self();
        $end = $i->end;
        $segment = $i->segment;


        if (isset($_SESSION['route_prefix'])) $prefix = $_SESSION['route_prefix'];
        else $prefix = null;

        if ($segment == $prefix && $route == $end) {
            return require 'views/' . $view . '.html';
            session_destroy();
        } elseif (empty($prefix) && $route == $end) {
            $path = explode('/', trim($route, '/'));
            if(count($path) >! 1) return require 'views/' . $view . '.html';
        } else {
            require 'views/err.html';
            exit;
        }
    }

    public static function post() {}

    public static function all() {}
}
