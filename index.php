<?php

/**
 * MVC-Model
 * Created by MaquitoGW
 * @version 1.0-beta
 * @year 2025
 * 
 * Portfolio: https://maquitogw.awefortec.com
 * GitHub: https://github.com/maquitogw
 * LinkedIn: https://www.linkedin.com/in/maquitogw
 * 
 * Licensed under the MIT License
 */

// Autoload de dependências 
require_once 'vendor/autoload.php';

// Carregar funções de debug
require_once 'Lib/debug.php';

// Inicializar modo de aplicação (Production/Dev)
require_once 'Lib/mode.php';
initializeApplication();

// Carregar o arquivo que registra os middlewares
require_once 'Lib/MiddlewareRegistry.php';

// Inicializando os middlewares antes de processar as rotas
$request = $_SERVER['REQUEST_URI'];  // Captura a URI da requisição

// Aplica middlewares essenciais
applyMiddleware('debug', $request, function ($request) {
    applyMiddleware('start_session', $request, function ($request) {
        applyMiddleware('log_access', $request, function ($request) {
            require_once 'routes/web.php';  // Carrega as rotas da aplicação
        });
    });
});
