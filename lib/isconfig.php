<?php
namespace lib;

use Dotenv\Dotenv;
use Exception;

class IsConfig
{
    protected static $envLoaded = false;

    public static function env($e)
    {
        // Verifica se já carregou as variáveis de ambiente anteriormente
        if (!self::$envLoaded) {
            $dotenv = Dotenv::createImmutable(dirname(__DIR__), '/.env');

            // Verifica se o arquivo .env existe
            if (!file_exists(dirname(__DIR__) . '/.env')) {
                throw new Exception('Arquivo .env não encontrado');
            }

            // Carrega as variáveis do arquivo .env
            $dotenv->load();
            self::$envLoaded = true;
        }

        // Verifica se a variável existe
        if (!isset($_ENV[$e])) {
            throw new Exception("Variável de ambiente {$e} não definida.");
        }

        return $_ENV[$e];
    }
}
