<?php

/**
 * Exemplos de uso do Sistema de Cron Jobs
 */

// ============================================
// 1. REGISTRAR E EXECUTAR TAREFAS SIMPLES
// ============================================

// Registrar uma tarefa que executa a cada minuto
Cron::register('check_emails', function() {
    echo "Verificando e-mails...\n";
    // Aqui você colocaria a lógica para verificar e-mails
});

// Registrar uma tarefa que executa a cada 5 minutos
Cron::register('cleanup_temp', function() {
    echo "Limpando arquivos temporários...\n";
    // Lógica de limpeza
});

// Registrar uma tarefa diária
Cron::register('generate_reports', function() {
    echo "Gerando relatórios diários...\n";
    // Lógica de relatórios
});


// ============================================
// 2. AGENDAMENTOS PRÉ-DEFINIDOS
// ============================================

// A cada minuto
Cron::register('task_1', function() {
    echo "Executando a cada minuto\n";
})->everyMinute('task_1');

// A cada 5 minutos
Cron::register('task_2', function() {
    echo "Executando a cada 5 minutos\n";
})->everyFiveMinutes('task_2');

// A cada 10 minutos
Cron::register('task_3', function() {
    echo "Executando a cada 10 minutos\n";
})->everyTenMinutes('task_3');

// A cada 15 minutos
Cron::register('task_4', function() {
    echo "Executando a cada 15 minutos\n";
})->everyFifteenMinutes('task_4');

// A cada 30 minutos
Cron::register('task_5', function() {
    echo "Executando a cada 30 minutos\n";
})->everyThirtyMinutes('task_5');

// A cada hora
Cron::register('task_hourly', function() {
    echo "Executando a cada hora\n";
})->hourly('task_hourly');

// Diariamente à meia-noite
Cron::register('task_daily', function() {
    echo "Executando diariamente à meia-noite\n";
})->daily('task_daily');

// Diariamente às 14:30
Cron::register('task_at_time', function() {
    echo "Executando às 14:30 diariamente\n";
})->dailyAt('14:30', 'task_at_time');

// Toda segunda (0 = domingo, 1 = segunda, ... 6 = sábado)
Cron::register('task_weekly', function() {
    echo "Executando toda segunda-feira\n";
})->weeklyOn(1, '09:00', 'task_weekly');

// Mensalmente no dia 1º
Cron::register('task_monthly', function() {
    echo "Executando no 1º de cada mês\n";
})->monthly('task_monthly');

// Mensalmente no dia 15 às 10:00
Cron::register('task_monthly_at', function() {
    echo "Executando no dia 15 às 10:00\n";
})->monthlyOn(15, '10:00', 'task_monthly_at');

// Anualmente (1º de janeiro)
Cron::register('task_yearly', function() {
    echo "Executando no 1º de janeiro\n";
})->yearly('task_yearly');


// ============================================
// 3. AGENDAMENTOS CUSTOMIZADOS
// ============================================

// Expressões cron customizadas
Cron::register('custom_task_1', function() {
    echo "Executando customizado\n";
}, '*/3 * * * *'); // A cada 3 minutos

Cron::register('custom_task_2', function() {
    echo "Executando customizado\n";
}, '0 2 * * *'); // Diariamente às 2 da manhã

Cron::register('custom_task_3', function() {
    echo "Executando customizado\n";
}, '0 0 * * 1-5'); // Segunda a sexta às 00:00


// ============================================
// 4. EXEMPLO PRÁTICO - Limpeza de cache expirado
// ============================================

Cron::register('clear_expired_cache', function() {
    try {
        // Limpar cache expirado do banco de dados
        sql::DELETE("cache")
            ->where("expires_at", "!=", null)
            ->where("expires_at", "<", date("Y-m-d H:i:s"))
            ->execute();
        
        echo "Cache expirado limpo com sucesso\n";
    } catch (Exception $e) {
        echo "Erro ao limpar cache: " . $e->getMessage() . "\n";
    }
})->daily('clear_expired_cache');


// ============================================
// 5. EXEMPLO PRÁTICO - Envio de e-mails pendentes
// ============================================

Cron::register('send_pending_emails', function() {
    try {
        $emails = sql::SELECT("email_queue")
            ->where("status", "pending")
            ->get();
        
        foreach ($emails as $email) {
            // Enviar e-mail
            // Mail::send($email['to'], $email['subject'], $email['body']);
            
            // Marcar como enviado
            sql::UPDATE("email_queue")
                ->set(['status' => 'sent', 'sent_at' => date("Y-m-d H:i:s")])
                ->where("id", $email['id'])
                ->execute();
        }
        
        echo count($emails) . " e-mails enviados\n";
    } catch (Exception $e) {
        echo "Erro ao enviar e-mails: " . $e->getMessage() . "\n";
    }
})->everyFiveMinutes('send_pending_emails');


// ============================================
// 6. EXEMPLO PRÁTICO - Sincronizar dados
// ============================================

Cron::register('sync_external_data', function() {
    try {
        // Buscar dados de API externa
        // $data = file_get_contents('https://api.example.com/data');
        // $data = json_decode($data, true);
        
        // Sincronizar com banco local
        // foreach ($data as $item) {
        //     sql::INSERT("external_data")->add($item)->execute();
        // }
        
        echo "Sincronização concluída\n";
    } catch (Exception $e) {
        echo "Erro ao sincronizar: " . $e->getMessage() . "\n";
    }
})->hourly('sync_external_data');


// ============================================
// 7. EXEMPLO PRÁTICO - Gerar relatórios
// ============================================

Cron::register('generate_daily_report', function() {
    try {
        $date = date('Y-m-d');
        
        $stats = [
            'total_users' => sql::SELECT("users")->count(),
            'total_sales' => sql::SELECT("sales")->where("DATE(created_at)", $date)->sum('amount'),
            'generated_at' => date('Y-m-d H:i:s')
        ];
        
        // Salvar relatório
        sql::INSERT("daily_reports")
            ->add([
                'date' => $date,
                'data' => json_encode($stats),
                'created_at' => date('Y-m-d H:i:s')
            ])
            ->execute();
        
        echo "Relatório gerado para $date\n";
    } catch (Exception $e) {
        echo "Erro ao gerar relatório: " . $e->getMessage() . "\n";
    }
})->daily('generate_daily_report');


// ============================================
// 8. EXECUTAR CRONS
// ============================================

// Executar no ponto de entrada da aplicação
// ou em uma rota específica
$result = Cron::run();

// $result conterá:
// [
//     'task_name' => [
//         'status' => 'success|error',
//         'message' => 'mensagem',
//         'time' => '2024-01-04 14:30:00'
//     ]
// ]

// Exibir resultado
// dd($result);


// ============================================
// 9. VERIFICAR STATUS
// ============================================

// Listar todas as tarefas
$tasks = Cron::list();
// dd($tasks);

// Obter status de todas as tarefas
$status = Cron::status();
// dd($status);

// Obter histórico de uma tarefa
$logs = Cron::getLog('clear_expired_cache', 10);
// dd($logs);

// Próxima execução
$nextRun = Cron::nextRun('0 0 * * *'); // Próxima execução diária
// echo $nextRun;
