<?php
namespace Middlewares;

class DebugMiddleware {
    public function handle($request, $next) {
        // Carrega o arquivo de debug se configurado
        if ($this->isDebugEnabled()) {
            require_once __DIR__ . '/../lib/debug.php';
        }
        
        return $next($request);
    }

    private function isDebugEnabled() {
        $envFile = __DIR__ . '/../.env';
        
        if (!file_exists($envFile)) {
            return false;
        }

        $envContent = file_get_contents($envFile);
        
        // Verifica se DEBUG está setado como true
        return preg_match('/^DEBUG\s*=\s*true/im', $envContent) === 1;
    }
}
