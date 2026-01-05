<?php

/**
 * Arquivo de ponto de entrada para Cron Jobs
 * 
 * Use este arquivo para executar crons periodicamente via cron do sistema:
 * 
 * * * * * * /usr/bin/php /caminho/para/seu/projeto/cron-runner.php
 * 
 * Ou configure uma rota HTTP e execute via curl:
 * 
 * * * * * * curl http://seu-site.com/admin/cron-run?token=seu_token
 */

// Autoload do Composer
require_once __DIR__ . '/vendor/autoload.php';

// Carregar variáveis de ambiente
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

// Carregar o sistema de cron
require_once __DIR__ . '/lib/cron.php';

// ============================================
// REGISTRE SUAS TAREFAS AQUI
// ============================================

/**
 * Exemplo 1: Limpar cache expirado
 */
Cron::register('clear_expired_cache', function() {
    try {
        // Seu código aqui
        echo "[CRON] Cache expirado limpo com sucesso\n";
    } catch (Exception $e) {
        echo "[CRON ERROR] Erro ao limpar cache: " . $e->getMessage() . "\n";
    }
})->daily('clear_expired_cache');

/**
 * Exemplo 2: Sincronizar dados
 */
// Descomente e configure conforme necessário
// Cron::register('sync_data', function() {
//     try {
//         // Seu código aqui
//         echo "[CRON] Dados sincronizados com sucesso\n";
//     } catch (Exception $e) {
//         echo "[CRON ERROR] Erro ao sincronizar: " . $e->getMessage() . "\n";
//     }
// })->hourly('sync_data');

/**
 * Exemplo 3: Gerar relatórios
 */
// Descomente e configure conforme necessário
// Cron::register('generate_report', function() {
//     try {
//         // Seu código aqui
//         echo "[CRON] Relatório gerado com sucesso\n";
//     } catch (Exception $e) {
//         echo "[CRON ERROR] Erro ao gerar relatório: " . $e->getMessage() . "\n";
//     }
// })->daily('generate_report');

// ============================================
// EXECUTAR CRONS
// ============================================

$output = Cron::run();

// Exibir resultado
if (!empty($output)) {
    echo "\n=== CRON EXECUTION REPORT ===\n";
    foreach ($output as $taskName => $result) {
        $status = strtoupper($result['status']);
        $message = $result['message'];
        $time = $result['time'];
        echo "[$time] $taskName: $status - $message\n";
    }
    echo "============================\n\n";
} else {
    echo "[" . date('Y-m-d H:i:s') . "] No tasks were executed\n";
}

// Retornar código de saída apropriado
exit(empty($output) ? 0 : 1);
