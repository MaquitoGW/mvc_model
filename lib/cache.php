<?php

declare(strict_types=1);

/**
 * Cache Helper - CacheerPHP 6.x Integration
 *
 * Drivers: arquivos (padrão), Redis, PDO e memória.
 * Uma instância compartilhada mantém os dados do driver array na requisição.
 */

use Dotenv\Dotenv;
use Predis\Client;
use Silviooosilva\CacheerPhp\Cacheer;
use Silviooosilva\CacheerPhp\Kernel\Ttl;
use Silviooosilva\CacheerPhp\Stores\Support\PredisConnection;

/**
 * Inicializa o cache no primeiro uso e retorna uma visão do namespace solicitado.
 * A configuração é responsabilidade da aplicação, não da biblioteca.
 */
function initializeCache(?string $namespace = null): Cacheer
{
    static $cache = null;

    if ($cache === null) {
        Dotenv::createImmutable(dirname(__DIR__))->safeLoad();

        $env = static function (string $name, string $default = ''): string {
            $value = getenv($name);

            if ($value === false) {
                $value = $_ENV[$name] ?? $_SERVER[$name] ?? $default;
            }

            return $value === '' ? $default : (string) $value;
        };

        switch ($env('CACHE_DRIVER', 'file')) {
            case 'redis':
                $client = new Client([
                    'scheme' => 'tcp',
                    'host' => $env('REDIS_HOST', 'localhost'),
                    'port' => (int) $env('REDIS_PORT', '6379'),
                    'database' => (int) $env('REDIS_DB', '0'),
                    'password' => $env('REDIS_PASSWORD') ?: null,
                ]);

                $cache = Cacheer::build()
                    ->redis(new PredisConnection($client), 'mvc_model:cache:v6')
                    ->create();
                break;

            case 'database':
                $dsn = match ($env('DB', 'mysql')) {
                    'mysql' => sprintf(
                        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
                        $env('DB_HOST', 'localhost'),
                        $env('DB_PORT', '3306'),
                        $env('DB_NAME'),
                    ),
                    'pgsql' => sprintf(
                        'pgsql:host=%s;port=%s;dbname=%s',
                        $env('DB_HOST', 'localhost'),
                        $env('DB_PORT', '5432'),
                        $env('DB_NAME'),
                    ),
                    'sqlite' => 'sqlite:' . $env('DB_NAME'),
                    default => throw new InvalidArgumentException('DB deve ser mysql, pgsql ou sqlite.'),
                };

                $pdo = new PDO($dsn, $env('DB_USER'), $env('DB_PASS'), [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]);

                // Crie o schema 6.x antes do uso; veja database/cache_table.sql.
                $cache = Cacheer::build()->database($pdo, 'cacheer_store')->create();
                break;

            case 'array':
                $cache = Cacheer::build()->inMemory()->create();
                break;

            case 'file':
            default:
                // Mantém os arquivos antigos separados dos dados do CacheerPHP 6.x.
                $cache = Cacheer::build()->file(dirname(__DIR__) . '/storage/cache/v6')->create();
                break;
        }
    }

    return $namespace === null || $namespace === '' ? $cache : $cache->scope($namespace);
}

if (!function_exists('cache_put')) {
    /**
     * Armazena um valor. TTL aceita segundos positivos, texto ou DateInterval;
     * null significa sem expiração. Erros de armazenamento geram exceções.
     */
    function cache_put(
        string $key,
        mixed $value,
        Ttl|DateInterval|int|string|null $ttl = null,
        ?string $namespace = null,
    ): bool {
        initializeCache($namespace)->set($key, $value, $ttl);

        return true;
    }
}

if (!function_exists('cache_get')) {
    /**
     * Retorna o valor original, inclusive null ou false; o padrão é usado só em misses.
     */
    function cache_get(string $key, mixed $default = null, ?string $namespace = null): mixed
    {
        return initializeCache($namespace)->get($key, $default);
    }
}

if (!function_exists('cache_has')) {
    /**
     * Verifica se uma chave possui um valor válido no cache.
     */
    function cache_has(string $key, ?string $namespace = null): bool
    {
        return initializeCache($namespace)->has($key);
    }
}

if (!function_exists('cache_forget')) {
    /**
     * Remove uma chave do cache.
     */
    function cache_forget(string $key, ?string $namespace = null): bool
    {
        return initializeCache($namespace)->delete($key);
    }
}

if (!function_exists('cache_flush')) {
    /**
     * Limpa o cache da aplicação ou apenas o namespace informado.
     */
    function cache_flush(?string $namespace = null): bool
    {
        initializeCache($namespace)->clear();

        return true;
    }
}

if (!function_exists('cache_remember')) {
    /**
     * Executa e armazena o callback somente quando a chave não está no cache.
     */
    function cache_remember(
        string $key,
        Ttl|DateInterval|int|string|null $ttl,
        callable $callback,
        ?string $namespace = null,
    ): mixed {
        return initializeCache($namespace)->remember($key, $ttl, $callback);
    }
}

if (!function_exists('cache_pull')) {
    /**
     * Recupera o valor e remove a chave, ou retorna o padrão em um miss.
     */
    function cache_pull(string $key, mixed $default = null, ?string $namespace = null): mixed
    {
        return initializeCache($namespace)->pull($key, $default);
    }
}
