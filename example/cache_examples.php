<?php

/**
 * Exemplos de uso do sistema de Cache (CacheerPHP)
 * 
 * Este arquivo demonstra como utilizar as funções de cache
 * disponibilizadas no projeto.
 */

// ============================================
// 1. CACHE BÁSICO - PUT e GET
// ============================================

// Armazenar um valor
cache_put('welcome_message', 'Bem-vindo ao MVC Model!', 3600);

// Recuperar um valor
$message = cache_get('welcome_message');
echo $message; // Output: Bem-vindo ao MVC Model!

// Recuperar com valor padrão se não encontrado
$message = cache_get('nonexistent_key', 'Valor padrão');
echo $message; // Output: Valor padrão


// ============================================
// 2. NAMESPACES - Organizar cache por contexto
// ============================================

// Armazenar na namespace 'settings'
cache_put('app_version', '1.0.0', null, 'settings');
cache_put('app_name', 'MVC Model', null, 'settings');

// Recuperar da namespace
$version = cache_get('app_version', null, 'settings');
$name = cache_get('app_name', null, 'settings');

// Limpar apenas a namespace 'settings'
cache_flush('settings');


// ============================================
// 3. VERIFICAÇÃO E REMOÇÃO
// ============================================

// Verificar se existe
if (cache_has('user_123')) {
    $user = cache_get('user_123');
}

// Remover uma chave
cache_forget('user_123');

// Remover tudo
cache_flush();


// ============================================
// 4. CACHE REMEMBER - Padrão útil para banco de dados
// ============================================

// Recupera do cache, se não existir executa o callback
$users = cache_remember('all_users', 3600, function() {
    // Esta função é executada apenas se não estiver em cache
    return sql::SELECT("users")->get();
});


// ============================================
// 5. CACHE PULL - Recuperar e remover
// ============================================

// Recupera e remove automaticamente
$tempData = cache_pull('temporary_data');

// Útil para dados que só devem ser acessados uma vez
$one_time_code = cache_pull('auth_code_xyz', null, 'auth');


// ============================================
// 6. EXEMPLO PRÁTICO - Cache de dados de usuário
// ============================================

class UserController {
    
    public function getUser($userId) {
        $cacheKey = "user_{$userId}";
        
        // Tenta obter do cache
        $user = cache_get($cacheKey);
        
        if (!$user) {
            // Se não estiver em cache, busca no banco
            $user = sql::SELECT("users")
                ->where("id", $userId)
                ->get();
            
            // Armazena em cache por 24 horas (86400 segundos)
            cache_put($cacheKey, $user, 86400);
        }
        
        return $user;
    }
    
    public function updateUser($userId, $data) {
        // Atualiza no banco
        sql::UPDATE("users")
            ->set($data)
            ->where("id", $userId)
            ->execute();
        
        // Invalida o cache
        cache_forget("user_{$userId}");
    }
    
    public function deleteUser($userId) {
        // Deleta do banco
        sql::DELETE("users")
            ->where("id", $userId)
            ->execute();
        
        // Remove do cache
        cache_forget("user_{$userId}");
    }
}


// ============================================
// 7. EXEMPLO PRÁTICO - Cache com namespaces
// ============================================

class ConfigManager {
    
    private const NAMESPACE = 'config';
    
    public function get($key, $default = null) {
        return cache_get($key, $default, self::NAMESPACE);
    }
    
    public function set($key, $value) {
        // Configurações não expiram (TTL = null)
        cache_put($key, $value, null, self::NAMESPACE);
    }
    
    public function forget($key) {
        cache_forget($key, self::NAMESPACE);
    }
    
    public function flushAll() {
        cache_flush(self::NAMESPACE);
    }
}

// Uso
$config = new ConfigManager();
$config->set('theme', 'dark');
$theme = $config->get('theme'); // 'dark'
$config->flushAll(); // Limpa todas as configurações


// ============================================
// 8. EXEMPLO PRÁTICO - Cache Remember avançado
// ============================================

class PostController {
    
    public function getPosts($page = 1) {
        $cacheKey = "posts_page_{$page}";
        $ttl = 3600; // 1 hora
        
        $posts = cache_remember($cacheKey, $ttl, function() use ($page) {
            $limit = 10;
            $offset = ($page - 1) * $limit;
            
            return sql::SELECT("posts")
                ->limit($limit)
                ->offset($offset)
                ->get();
        });
        
        return $posts;
    }
    
    public function createPost($data) {
        // Insere no banco
        $post = sql::INSERT("posts")
            ->add($data)
            ->execute();
        
        // Invalida todos os caches de posts
        cache_flush('posts');
    }
}


// ============================================
// 9. TTL (Time To Live) - Exemplos
// ============================================

// Sem expiração (armazenado indefinidamente)
cache_put('permanent_setting', 'value', null);

// 1 minuto (60 segundos)
cache_put('temp_token', 'xyz123', 60);

// 1 hora (3600 segundos)
cache_put('session_data', ['user_id' => 1], 3600);

// 1 dia (86400 segundos)
cache_put('daily_report', $data, 86400);

// 1 semana (604800 segundos)
cache_put('weekly_stats', $stats, 604800);


// ============================================
// 10. DRIVERS DIFERENTES
// ============================================

/*
 * Mude o driver no arquivo .env alterando:
 * CACHE_DRIVER=file      (padrão - arquivos)
 * CACHE_DRIVER=redis     (Redis)
 * CACHE_DRIVER=database  (Banco de dados)
 * CACHE_DRIVER=array     (Memória - sem persistência)
 * 
 * As funções de cache funcionam igual independente do driver!
 */
