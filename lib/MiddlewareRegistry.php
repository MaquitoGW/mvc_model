<?php
// Registrando middlewares
use Middlewares\LogAccessMiddleware;
use Middlewares\StartSessionMiddleware;
use Middlewares\DebugMiddleware;

$middlewares = [
    'debug' => new DebugMiddleware(),
    'start_session' => new StartSessionMiddleware(),
    'log_access' => new LogAccessMiddleware()
];

// Função para aplicar middlewares
function applyMiddleware($middlewareName, $request, $next) {
    global $middlewares;

    if (isset($middlewares[$middlewareName])) {
        return $middlewares[$middlewareName]->handle($request, $next);
    }

    return $next($request);
}
