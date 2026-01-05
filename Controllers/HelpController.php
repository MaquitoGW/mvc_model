<?php

namespace Controllers;

use lib\Response;

class HelpController extends App
{
    /**
     * Página principal do centro de ajuda
     */
    public function index()
    {
        return Response::view("help/index");
    }

    /**
     * Documentação completa
     */
    public function documentation()
    {
        return Response::view("help/documentation");
    }

    /**
     * Documentação - Debug
     */
    public function debug()
    {
        return Response::view("help/documentation");
    }

    /**
     * Documentação - Cache
     */
    public function cache()
    {
        return Response::view("help/documentation");
    }

    /**
     * Documentação - Cron
     */
    public function cron()
    {
        return Response::view("help/documentation");
    }

    /**
     * Documentação - Email
     */
    public function email()
    {
        return Response::view("help/documentation");
    }

    /**
     * Documentação - Configuração
     */
    public function configuration()
    {
        return Response::view("help/documentation");
    }
}
