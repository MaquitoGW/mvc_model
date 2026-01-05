<?php

/**
 * Mode Manager — Controla modo Production/Dev
 * Gerencia exibição de erros e comportamento da aplicação
 */

/**
 * Verifica o modo atual da aplicação
 */
function isProduction(): bool
{
    return getAppMode() === 'Production';
}

/**
 * Verifica se está em modo desenvolvimento
 */
function isDevelopment(): bool
{
    return getAppMode() === 'Dev';
}

/**
 * Obtém o modo configurado
 */
function getAppMode(): string
{
    static $mode;

    if ($mode !== null) {
        return $mode;
    }

    $env = __DIR__ . '/../.env';

    if (!file_exists($env)) {
        return $mode = 'Dev'; // Padrão para desenvolvimento
    }

    $content = file_get_contents($env);
    
    // Procura por MODE= no arquivo
    if (preg_match('/^MODE\s*=\s*(\w+)/im', $content, $matches)) {
        $mode = trim($matches[1]);
        return $mode === 'Production' ? 'Production' : 'Dev';
    }

    return $mode = 'Dev'; // Padrão para desenvolvimento
}

/**
 * Configura as opções de erro baseado no modo
 */
function configureErrorHandling(): void
{
    if (isProduction()) {
        // Modo Production: Desativa exibição de erros
        ini_set('display_errors', '0');
        ini_set('display_startup_errors', '0');
        error_reporting(E_ALL);
        
        // Log de erros em arquivo
        ini_set('log_errors', '1');
        
        $logDir = __DIR__ . '/../storage/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        
        ini_set('error_log', $logDir . '/php_errors.log');
    } else {
        // Modo Dev: Ativa exibição de erros
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
        
        // Também loga em arquivo
        ini_set('log_errors', '1');
        
        $logDir = __DIR__ . '/../storage/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        
        ini_set('error_log', $logDir . '/php_errors.log');
    }
}

/**
 * Retorna informações sobre o ambiente
 */
function getEnvironmentInfo(): array
{
    return [
        'mode' => getAppMode(),
        'is_production' => isProduction(),
        'is_development' => isDevelopment(),
        'php_version' => PHP_VERSION,
        'php_sapi' => php_sapi_name(),
        'error_reporting' => error_reporting(),
        'display_errors' => ini_get('display_errors'),
        'error_log' => ini_get('error_log'),
    ];
}

/**
 * Middleware para configurar manipulação de erros
 * Execute isto antes de carregar as rotas
 */
if (!function_exists('initializeApplication')) {
    function initializeApplication(): void
    {
        // Configurar tratamento de erros baseado no modo
        configureErrorHandling();
        
        // Handler customizado para erros
        set_error_handler(function($errno, $errstr, $errfile, $errline) {
            if (!(error_reporting() & $errno)) {
                return false; // Ignora erros não reportados
            }

            $errorType = match($errno) {
                E_ERROR => 'Fatal Error',
                E_WARNING => 'Warning',
                E_PARSE => 'Parse Error',
                E_NOTICE => 'Notice',
                E_CORE_ERROR => 'Core Error',
                E_CORE_WARNING => 'Core Warning',
                E_COMPILE_ERROR => 'Compile Error',
                E_COMPILE_WARNING => 'Compile Warning',
                E_USER_ERROR => 'User Error',
                E_USER_WARNING => 'User Warning',
                E_USER_NOTICE => 'User Notice',
                E_STRICT => 'Strict',
                E_RECOVERABLE_ERROR => 'Recoverable Error',
                E_DEPRECATED => 'Deprecated',
                E_USER_DEPRECATED => 'User Deprecated',
                default => 'Unknown Error'
            };

            $errorInfo = [
                'type' => $errorType,
                'message' => $errstr,
                'file' => $errfile,
                'line' => $errline,
                'timestamp' => date('Y-m-d H:i:s'),
                'mode' => getAppMode()
            ];

            // Logar erro
            logError($errorInfo);

            // Em produção, não exibe detalhes
            if (isProduction()) {
                return true; // Indica que o erro foi tratado
            }

            // Em desenvolvimento, mostra erro formatado
            displayError($errorInfo);
            return true;
        });

        // Handler para exceções não capturadas
        set_exception_handler(function(Throwable $e) {
            $exceptionInfo = [
                'type' => basename(str_replace('\\', '/', $e::class)),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'timestamp' => date('Y-m-d H:i:s'),
                'mode' => getAppMode(),
                'trace' => $e->getTraceAsString()
            ];

            // Logar exceção
            logError($exceptionInfo);

            // Em produção, mostra mensagem genérica
            if (isProduction()) {
                http_response_code(500);
                echo "An error occurred. Please try again later.";
            } else {
                // Em desenvolvimento, mostra detalhes
                displayException($exceptionInfo);
            }

            exit(1);
        });
    }
}

/**
 * Registra erro em log
 */
function logError(array $errorInfo): void
{
    $logDir = __DIR__ . '/../storage/logs';
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }

    $logFile = $logDir . '/php_errors.log';

    $logMessage = "\n[{$errorInfo['timestamp']}] [{$errorInfo['type']}]\n";
    $logMessage .= "Message: {$errorInfo['message']}\n";
    $logMessage .= "File: {$errorInfo['file']}:{$errorInfo['line']}\n";
    
    if (isset($errorInfo['trace'])) {
        $logMessage .= "Trace:\n{$errorInfo['trace']}\n";
    }
    
    $logMessage .= "Mode: {$errorInfo['mode']}\n";
    $logMessage .= str_repeat('-', 80) . "\n";

    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

/**
 * Exibe erro em desenvolvimento
 */
function displayError(array $errorInfo): void
{
    if (!isDevelopment()) {
        return;
    }

    $styles = <<<HTML
<style>
    .error-container {
        background: #fee;
        border: 2px solid #f00;
        color: #333;
        padding: 20px;
        margin: 20px;
        border-radius: 8px;
        font-family: monospace;
        line-height: 1.6;
    }
    .error-type {
        color: #f00;
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 10px;
    }
    .error-file {
        color: #666;
        font-size: 12px;
        margin-bottom: 10px;
    }
    .error-message {
        color: #333;
        margin-bottom: 10px;
        word-wrap: break-word;
    }
</style>
HTML;

    echo $styles;
    echo '<div class="error-container">';
    echo '<div class="error-type">⚠️ ' . htmlspecialchars($errorInfo['type']) . '</div>';
    echo '<div class="error-file">' . htmlspecialchars($errorInfo['file']) . ':' . $errorInfo['line'] . '</div>';
    echo '<div class="error-message">' . htmlspecialchars($errorInfo['message']) . '</div>';
    echo '</div>';
}

/**
 * Exibe exceção em desenvolvimento
 */
function displayException(array $exceptionInfo): void
{
    if (!isDevelopment()) {
        http_response_code(500);
        echo "<!DOCTYPE html>";
        echo "<html><head><title>Error</title></head>";
        echo "<body><h1>An error occurred</h1>";
        echo "<p>Please contact support if the problem persists.</p>";
        echo "</body></html>";
        return;
    }

    $styles = <<<HTML
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f5f5f5; }
    .exception-container {
        max-width: 1000px;
        margin: 20px auto;
        background: white;
        border: 2px solid #d32f2f;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0,.1);
    }
    .exception-header {
        background: #d32f2f;
        color: white;
        padding: 20px;
    }
    .exception-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .exception-subtitle {
        font-size: 14px;
        opacity: 0.9;
    }
    .exception-content {
        padding: 20px;
    }
    .exception-section {
        margin-bottom: 20px;
    }
    .exception-label {
        font-weight: bold;
        color: #d32f2f;
        margin-bottom: 5px;
        text-transform: uppercase;
        font-size: 12px;
    }
    .exception-value {
        background: #f5f5f5;
        padding: 10px;
        border-radius: 4px;
        border-left: 3px solid #d32f2f;
        word-break: break-all;
        font-family: 'Courier New', monospace;
    }
    .exception-trace {
        background: #1e1e1e;
        color: #a0a0a0;
        padding: 15px;
        border-radius: 4px;
        overflow-x: auto;
        font-family: 'Courier New', monospace;
        font-size: 12px;
        line-height: 1.5;
        max-height: 400px;
        overflow-y: auto;
    }
    .mode-badge {
        display: inline-block;
        background: #ff9800;
        color: white;
        padding: 4px 8px;
        border-radius: 3px;
        font-size: 11px;
        font-weight: bold;
        margin-top: 5px;
    }
</style>
HTML;

    echo "<!DOCTYPE html>";
    echo "<html><head><meta charset='utf-8'><title>Exception</title>";
    echo $styles;
    echo "</head><body>";

    echo '<div class="exception-container">';
    echo '<div class="exception-header">';
    echo '<div class="exception-title">❌ ' . htmlspecialchars($exceptionInfo['type']) . '</div>';
    echo '<div class="exception-subtitle">' . htmlspecialchars($exceptionInfo['message']) . '</div>';
    echo '<span class="mode-badge">' . strtoupper($exceptionInfo['mode']) . '</span>';
    echo '</div>';

    echo '<div class="exception-content">';

    echo '<div class="exception-section">';
    echo '<div class="exception-label">File</div>';
    echo '<div class="exception-value">' . htmlspecialchars($exceptionInfo['file']) . ':' . $exceptionInfo['line'] . '</div>';
    echo '</div>';

    echo '<div class="exception-section">';
    echo '<div class="exception-label">Message</div>';
    echo '<div class="exception-value">' . htmlspecialchars($exceptionInfo['message']) . '</div>';
    echo '</div>';

    echo '<div class="exception-section">';
    echo '<div class="exception-label">Stack Trace</div>';
    echo '<div class="exception-trace">' . htmlspecialchars($exceptionInfo['trace']) . '</div>';
    echo '</div>';

    echo '<div class="exception-section">';
    echo '<div class="exception-label">Environment Info</div>';
    echo '<div class="exception-value">';
    echo 'Mode: ' . $exceptionInfo['mode'] . '<br>';
    echo 'Timestamp: ' . $exceptionInfo['timestamp'] . '<br>';
    echo 'PHP Version: ' . PHP_VERSION . '<br>';
    echo '</div>';
    echo '</div>';

    echo '</div>';
    echo '</div>';
    echo "</body></html>";
}
