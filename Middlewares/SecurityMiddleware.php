<?php
namespace Middlewares;

class StartSessionMiddleware {
    public function handle($request, $next) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();  // Inicia a sessão
        }
        return $next($request);  // Passa para o próximo middleware ou controlador
    }
}

