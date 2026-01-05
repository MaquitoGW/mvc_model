<?php

/**
 * Cache Helper - CacheerPHP Integration
 * 
 * Sistema de cache com suporte a múltiplos drivers:
 * - File System (padrão)
 * - Redis
 * - Database (MySQL, PostgreSQL, SQLite)
 * - In-Memory Array
 */

use Silviooosilva\CacheerPhp\Cacheer;

// Configuração estática do Cache
function initializeCache()
{
    static $initialized = false;
    
    if ($initialized) {
        return;
    }
    
    $driver = getenv('CACHE_DRIVER') ?: 'file';
    
    // Configurar timezone
    Cacheer::setConfig()->setTimeZone(date_default_timezone_get());
    
    // Configurar driver de cache
    switch ($driver) {
        case 'redis':
            if (class_exists('Predis\Client')) {
                Cacheer::setDriver()->useRedisDriver(
                    host: getenv('REDIS_HOST') ?: 'localhost',
                    port: (int)(getenv('REDIS_PORT') ?: 6379),
                    db: (int)(getenv('REDIS_DB') ?: 0)
                );
            } else {
                error_log('Redis driver requested but Predis not installed. Falling back to file driver.');
                Cacheer::setDriver()->useFileDriver(
                    cacheDir: __DIR__ . '/../storage/cache'
                );
            }
            break;
            
        case 'database':
            Cacheer::setDriver()->useDatabaseDriver(
                host: getenv('DB_HOST'),
                user: getenv('DB_USER'),
                password: getenv('DB_PASS'),
                database: getenv('DB_NAME'),
                table: 'cache'
            );
            break;
            
        case 'array':
            Cacheer::setDriver()->useArrayDriver();
            break;
            
        case 'file':
        default:
            Cacheer::setDriver()->useFileDriver(
                cacheDir: __DIR__ . '/../storage/cache'
            );
            break;
    }
    
    $initialized = true;
}

if (!function_exists('cache_put')) {
    /**
     * Armazena um valor no cache
     *
     * @param string $key Chave do cache
     * @param mixed $value Valor a ser armazenado
     * @param int $ttl Tempo de vida em segundos (null = sem expiração)
     * @param string $namespace Namespace opcional
     * @return bool
     */
    function cache_put($key, $value, $ttl = null, $namespace = null)
    {
        initializeCache();
        
        $cache = new Cacheer();
        
        if ($namespace) {
            $cache->setNamespace($namespace);
        }
        
        if ($ttl) {
            $cache->setExpirationTime($ttl);
        }
        
        return $cache->putCache($key, $value);
    }
}

if (!function_exists('cache_get')) {
    /**
     * Recupera um valor do cache
     *
     * @param string $key Chave do cache
     * @param mixed $default Valor padrão se não encontrado
     * @param string $namespace Namespace opcional
     * @return mixed
     */
    function cache_get($key, $default = null, $namespace = null)
    {
        initializeCache();
        
        $cache = new Cacheer();
        
        if ($namespace) {
            $cache->setNamespace($namespace);
        }
        
        if ($cache->has($key)) {
            return $cache->getCache($key);
        }
        
        return $default;
    }
}

if (!function_exists('cache_has')) {
    /**
     * Verifica se uma chave existe no cache
     *
     * @param string $key Chave do cache
     * @param string $namespace Namespace opcional
     * @return bool
     */
    function cache_has($key, $namespace = null)
    {
        initializeCache();
        
        $cache = new Cacheer();
        
        if ($namespace) {
            $cache->setNamespace($namespace);
        }
        
        return $cache->has($key) && $cache->isSuccess();
    }
}

if (!function_exists('cache_forget')) {
    /**
     * Remove um valor do cache
     *
     * @param string $key Chave do cache
     * @param string $namespace Namespace opcional
     * @return bool
     */
    function cache_forget($key, $namespace = null)
    {
        initializeCache();
        
        $cache = new Cacheer();
        
        if ($namespace) {
            $cache->setNamespace($namespace);
        }
        
        return $cache->delete($key);
    }
}

if (!function_exists('cache_flush')) {
    /**
     * Limpa todo o cache
     *
     * @param string $namespace Namespace opcional (se não informado, limpa tudo)
     * @return bool
     */
    function cache_flush($namespace = null)
    {
        initializeCache();
        
        $cache = new Cacheer();
        
        if ($namespace) {
            $cache->setNamespace($namespace);
            return $cache->flush();
        }
        
        return $cache->flushAll();
    }
}

if (!function_exists('cache_remember')) {
    /**
     * Recupera do cache ou armazena o resultado de um callback
     *
     * @param string $key Chave do cache
     * @param int|null $ttl Tempo de vida em segundos
     * @param callable $callback Função para gerar o valor
     * @param string $namespace Namespace opcional
     * @return mixed
     */
    function cache_remember($key, $ttl, $callback, $namespace = null)
    {
        initializeCache();
        
        $cache = new Cacheer();
        
        if ($namespace) {
            $cache->setNamespace($namespace);
        }
        
        if ($cache->has($key) && $cache->isSuccess()) {
            return $cache->getCache($key);
        }
        
        $value = call_user_func($callback);
        
        if ($ttl) {
            $cache->setExpirationTime($ttl);
        }
        
        $cache->putCache($key, $value);
        
        return $value;
    }
}

if (!function_exists('cache_pull')) {
    /**
     * Recupera do cache e remove a chave
     *
     * @param string $key Chave do cache
     * @param mixed $default Valor padrão
     * @param string $namespace Namespace opcional
     * @return mixed
     */
    function cache_pull($key, $default = null, $namespace = null)
    {
        initializeCache();
        
        $cache = new Cacheer();
        
        if ($namespace) {
            $cache->setNamespace($namespace);
        }
        
        if ($cache->has($key) && $cache->isSuccess()) {
            $value = $cache->getCache($key);
            $cache->delete($key);
            return $value;
        }
        
        return $default;
    }
}

// Inicializa o cache automaticamente
initializeCache();
