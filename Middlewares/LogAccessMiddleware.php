<?php
namespace Middlewares;

class LogAccessMiddleware {
    public function handle($request, $next) {
        $logDir = __DIR__ . '/../Private/logs';
        
        // Cria o diretório se não existir
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        
        $logData = [
            'ip' => $_SERVER['REMOTE_ADDR'],
            'uri' => $_SERVER['REQUEST_URI'],
            'timestamp' => date('Y-m-d H:i:s'),
        ];
        file_put_contents($logDir . '/access.log', json_encode($logData) . PHP_EOL, FILE_APPEND);  // Grava no arquivo de log
        return $next($request);  // Passa para o próximo middleware ou controlador
    }
}
