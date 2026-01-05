<?php

/**
 * Debug Helper — estilo MVC Model
 * Inspirado no Laravel, com identidade visual própria
 */

function isDebugEnabled(): bool
{
    static $enabled;

    if ($enabled !== null) {
        return $enabled;
    }

    $env = __DIR__ . '/../.env';

    if (!file_exists($env)) {
        return $enabled = false;
    }

    return $enabled = preg_match('/^DEBUG\s*=\s*true/im', file_get_contents($env)) === 1;
}

/**
 * Dump and Die
 */
if (!function_exists('dd')) {
    function dd(...$vars): void
    {
        if (!isDebugEnabled()) {
            return;
        }

        dump(...$vars);
        exit(1);
    }
}

/**
 * Dump estilizado
 */
if (!function_exists('dump')) {
    function dump(...$vars): void
    {
        if (!isDebugEnabled()) {
            return;
        }

        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? null;
        $currentRoute = getCurrentRoute();

        echo getDebugBaseStyles();
        echo '<div class="mvc-debug">';

        if ($trace) {
            echo '<div class="mvc-debug-header">';
            echo 'Debug em <strong>' . basename($trace['file']) . '</strong> : linha <strong>' . $trace['line'] . '</strong>';
            if ($currentRoute) {
                echo ' | Rota: <strong>' . htmlspecialchars($currentRoute) . '</strong>';
            }
            echo '</div>';
        }

        foreach ($vars as $var) {
            renderDebugItem($var);
        }

        echo '</div>';
    }
}

/**
 * Renderiza cada item
 */
function renderDebugItem(mixed $var): void
{
    $type = gettype($var);

    echo '<div class="mvc-debug-item">';
    echo '<div class="mvc-debug-type">' . strtoupper($type) . '</div>';

    if (is_array($var) || is_object($var)) {
        echo '<details open>';
        echo '<summary>Conteúdo</summary>';
        echo '<pre>' . htmlspecialchars(print_r($var, true)) . '</pre>';
        echo '</details>';
    } else {
        echo '<div class="mvc-debug-value">';
        echo formatScalar($var);
        echo '</div>';
    }

    echo '</div>';
}

/**
 * Formata tipos simples
 */
function formatScalar(mixed $value): string
{
    return match (true) {
        is_null($value)  => '<span class="null">null</span>',
        is_bool($value)  => '<span class="bool">' . ($value ? 'true' : 'false') . '</span>',
        is_numeric($value) => '<span class="number">' . $value . '</span>',
        default => '<span class="string">' . htmlspecialchars((string)$value) . '</span>',
    };
}

/**
 * CSS base do debug
 */
function getDebugBaseStyles(): string
{
    return <<<HTML
<style>
.mvc-debug {
    position: relative;
    background: #0f1114;
    border: 1px solid #2f363d;
    border-radius: 8px;
    padding: 16px;
    margin: 20px;
    font-family: Consolas, monospace;
    color: #cfcfcf;
    box-shadow: 0 10px 30px rgba(0,0,0,.4);
}

.mvc-debug-header {
    margin-bottom: 12px;
    font-size: 13px;
    color: #8b949e;
}

.mvc-debug-item {
    background: #161b22;
    border: 1px solid #2f363d;
    border-radius: 6px;
    padding: 12px;
    margin-bottom: 10px;
}

.mvc-debug-type {
    font-size: 11px;
    font-weight: bold;
    color: #0366d6;
    margin-bottom: 6px;
}

.mvc-debug-value {
    font-size: 13px;
}

.mvc-debug pre {
    background: #0d1117;
    padding: 10px;
    border-radius: 4px;
    overflow-x: auto;
    font-size: 12px;
    margin-top: 8px;
}

.mvc-debug details summary {
    cursor: pointer;
    color: #58a6ff;
    font-size: 12px;
}

/* Tipos */
.string { color: #a5d6ff; }
.number { color: #f2cc60; }
.bool   { color: #ff7b72; }
.null   { color: #8b949e; }
</style>
HTML;
}

/**
 * Obter rota atual
 */
function getCurrentRoute(): ?string
{
    return $_SERVER['REQUEST_URI'] ?? null;
}

/**
 * LogView - Armazena em log a saída de uma informação
 */
if (!function_exists('logView')) {
    function logView(mixed $data, string $label = 'INFO'): void
    {
        if (!isDebugEnabled()) {
            return;
        }

        $logDir = __DIR__ . '/../storage/logs';
        
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        $logFile = $logDir . '/debug.log';
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? null;
        $currentRoute = getCurrentRoute();

        $timestamp = date('Y-m-d H:i:s');
        $file = $trace ? basename($trace['file']) : 'unknown';
        $line = $trace ? $trace['line'] : 'unknown';

        $logMessage = "\n[{$timestamp}] [{$label}]\n";
        $logMessage .= "Rota: {$currentRoute}\n";
        $logMessage .= "Arquivo: {$file}:{$line}\n";
        $logMessage .= "Dados:\n";
        $logMessage .= print_r($data, true);
        $logMessage .= "\n" . str_repeat('-', 80) . "\n";

        file_put_contents($logFile, $logMessage, FILE_APPEND);

        echo '<div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 10px; margin: 10px; border-radius: 4px; font-size: 13px;">';
        echo '✓ Log armazenado em <code>storage/logs/debug.log</code>';
        echo '</div>';
    }
}

/**
 * CutErr - Captura erros com try-catch
 * 
 * @param callable $callback - Função a ser executada
 * @param bool $logError - Se true, salva em log; se false, exibe na tela
 * @return mixed - Resultado da função ou null em caso de erro
 */
if (!function_exists('cutErr')) {
    function cutErr(callable $callback, bool $logError = false): mixed
    {
        if (!isDebugEnabled()) {
            try {
                return $callback();
            } catch (Exception $e) {
                if (!$logError) {
                    http_response_code(500);
                    echo "Erro: " . htmlspecialchars($e->getMessage());
                }
                return null;
            }
        }

        try {
            return $callback();
        } catch (Exception $e) {
            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0] ?? null;
            $currentRoute = getCurrentRoute();

            $errorInfo = [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'route' => $currentRoute,
                'timestamp' => date('Y-m-d H:i:s'),
                'trace' => $e->getTraceAsString()
            ];

            if ($logError) {
                // Salvar em log
                $logDir = __DIR__ . '/../storage/logs';
                if (!is_dir($logDir)) {
                    mkdir($logDir, 0755, true);
                }

                $logFile = $logDir . '/errors.log';
                $logMessage = "\n[{$errorInfo['timestamp']}] [ERROR]\n";
                $logMessage .= "Rota: {$errorInfo['route']}\n";
                $logMessage .= "Arquivo: {$errorInfo['file']}:{$errorInfo['line']}\n";
                $logMessage .= "Mensagem: {$errorInfo['message']}\n";
                $logMessage .= "Stack Trace:\n{$errorInfo['trace']}\n";
                $logMessage .= str_repeat('-', 80) . "\n";

                file_put_contents($logFile, $logMessage, FILE_APPEND);

                echo '<div style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 10px; margin: 10px; border-radius: 4px; font-size: 13px;">';
                echo '⚠ Erro capturado e registrado em <code>storage/logs/errors.log</code>';
                echo '</div>';
            } else {
                // Exibir na tela
                echo getDebugBaseStyles();
                echo '<div class="mvc-debug" style="border-color: #ff7b72; background: #161b22;">';
                echo '<div class="mvc-debug-header" style="color: #ff7b72;">';
                echo '❌ ERRO CAPTURADO';
                echo '</div>';

                echo '<div class="mvc-debug-item">';
                echo '<div class="mvc-debug-type" style="color: #ff7b72;">MENSAGEM</div>';
                echo '<div class="mvc-debug-value">' . htmlspecialchars($errorInfo['message']) . '</div>';
                echo '</div>';

                echo '<div class="mvc-debug-item">';
                echo '<div class="mvc-debug-type">ROTA</div>';
                echo '<div class="mvc-debug-value">' . htmlspecialchars($errorInfo['route']) . '</div>';
                echo '</div>';

                echo '<div class="mvc-debug-item">';
                echo '<div class="mvc-debug-type">LOCALIZAÇÃO</div>';
                echo '<div class="mvc-debug-value">' . htmlspecialchars($errorInfo['file']) . ':' . $errorInfo['line'] . '</div>';
                echo '</div>';

                echo '<div class="mvc-debug-item">';
                echo '<div class="mvc-debug-type">STACK TRACE</div>';
                echo '<details>';
                echo '<summary>Ver detalhes</summary>';
                echo '<pre>' . htmlspecialchars($errorInfo['trace']) . '</pre>';
                echo '</details>';
                echo '</div>';

                echo '</div>';
            }

            return null;
        }
    }
}
