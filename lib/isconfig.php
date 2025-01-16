<?php
namespace lib;

use Dotenv\Dotenv;

class IsConfig
{
    public static function env($e)
    {
        // Carrega as variáveis do arquivo .env
        $dotenv = Dotenv::createImmutable(dirname(__DIR__), '/.env');
        $dotenv->load();

        return $_ENV[$e];
    }
}
