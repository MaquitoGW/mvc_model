<?php

/**
 * Cron Job System
 * 
 * Sistema para agendamento e execução de tarefas periódicas
 * Funciona como um simulador de cron jobs do sistema operacional
 */

use lib\sql;

class Cron {
    
    private static array $tasks = [];
    private static string $logDir = '';
    private static bool $initialized = false;
    
    /**
     * Inicializa o sistema de cron
     */
    public static function init() {
        if (self::$initialized) {
            return;
        }
        
        self::$logDir = __DIR__ . '/../storage/logs/cron';
        
        // Cria diretório de logs se não existir
        if (!is_dir(self::$logDir)) {
            mkdir(self::$logDir, 0755, true);
        }
        
        self::$initialized = true;
    }
    
    /**
     * Registra uma tarefa de cron
     *
     * @param string $name Nome da tarefa
     * @param callable $callback Função a executar
     * @param string $schedule Agendamento em expressão cron (ex: "* * * * *")
     * @return self
     */
    public static function register(string $name, callable $callback, string $schedule = '* * * * *'): self {
        self::init();
        
        self::$tasks[$name] = [
            'callback' => $callback,
            'schedule' => $schedule,
            'last_run' => null,
            'next_run' => null,
            'status' => 'pending'
        ];
        
        return new self();
    }
    
    /**
     * Define quando a tarefa deve executar
     *
     * Exemplos:
     * - "* * * * *" - A cada minuto
     * - "*5 * * * *" - A cada 5 minutos
     * - "0 * * * *" - A cada hora
     * - "0 0 * * *" - Diariamente à meia-noite
     * - "0 12 * * *" - Diariamente ao meio-dia
     * - "0 0 * * 0" - Toda segunda-feira
     * - "0 0 1 * *" - Mensalmente no dia 1º
     *
     * @param string $schedule Expressão cron
     * @return self
     */
    public static function everyMinute(string $taskName = ''): self {
        return self::schedule($taskName, '* * * * *');
    }
    
    public static function everyFiveMinutes(string $taskName = ''): self {
        return self::schedule($taskName, '*/5 * * * *');
    }
    
    public static function everyTenMinutes(string $taskName = ''): self {
        return self::schedule($taskName, '*/10 * * * *');
    }
    
    public static function everyFifteenMinutes(string $taskName = ''): self {
        return self::schedule($taskName, '*/15 * * * *');
    }
    
    public static function everyThirtyMinutes(string $taskName = ''): self {
        return self::schedule($taskName, '*/30 * * * *');
    }
    
    public static function hourly(string $taskName = ''): self {
        return self::schedule($taskName, '0 * * * *');
    }
    
    public static function daily(string $taskName = ''): self {
        return self::schedule($taskName, '0 0 * * *');
    }
    
    public static function dailyAt(string $time, string $taskName = ''): self {
        // Formato: "14:30"
        [$hour, $minute] = explode(':', $time);
        return self::schedule($taskName, "$minute $hour * * *");
    }
    
    public static function weekly(string $taskName = ''): self {
        return self::schedule($taskName, '0 0 * * 0');
    }
    
    public static function weeklyOn(int $day, string $time = '00:00', string $taskName = ''): self {
        // $day: 0 (domingo) a 6 (sábado)
        // $time: "14:30"
        [$hour, $minute] = explode(':', $time);
        return self::schedule($taskName, "$minute $hour * * $day");
    }
    
    public static function monthly(string $taskName = ''): self {
        return self::schedule($taskName, '0 0 1 * *');
    }
    
    public static function monthlyOn(int $day, string $time = '00:00', string $taskName = ''): self {
        // $day: 1-31
        [$hour, $minute] = explode(':', $time);
        return self::schedule($taskName, "$minute $hour $day * *");
    }
    
    public static function yearly(string $taskName = ''): self {
        return self::schedule($taskName, '0 0 1 1 *');
    }
    
    public static function schedule(string $taskName, string $schedule): self {
        if (isset(self::$tasks[$taskName])) {
            self::$tasks[$taskName]['schedule'] = $schedule;
        }
        return new self();
    }
    
    /**
     * Executa as tarefas agendadas
     *
     * Deve ser chamado periodicamente (a cada minuto via cron do sistema ou via HTTP)
     *
     * @return array Resultado da execução
     */
    public static function run(): array {
        self::init();
        
        $executed = [];
        $now = new \DateTime();
        
        foreach (self::$tasks as $name => $task) {
            if (self::shouldRun($task['schedule'], $now)) {
                try {
                    // Executa a tarefa
                    call_user_func($task['callback']);
                    
                    $executed[$name] = [
                        'status' => 'success',
                        'message' => 'Executed successfully',
                        'time' => $now->format('Y-m-d H:i:s')
                    ];
                    
                    self::log($name, "Executed successfully");
                    
                } catch (\Exception $e) {
                    $executed[$name] = [
                        'status' => 'error',
                        'message' => $e->getMessage(),
                        'time' => $now->format('Y-m-d H:i:s')
                    ];
                    
                    self::log($name, "Error: " . $e->getMessage());
                }
            }
        }
        
        return $executed;
    }
    
    /**
     * Verifica se uma tarefa deve ser executada
     *
     * @param string $schedule Expressão cron
     * @param \DateTime $now Data/hora atual
     * @return bool
     */
    private static function shouldRun(string $schedule, \DateTime $now): bool {
        $parts = explode(' ', $schedule);
        
        if (count($parts) !== 5) {
            return false;
        }
        
        [$minute, $hour, $day, $month, $dayOfWeek] = $parts;
        
        $currentMinute = (int)$now->format('i');
        $currentHour = (int)$now->format('H');
        $currentDay = (int)$now->format('d');
        $currentMonth = (int)$now->format('m');
        $currentDayOfWeek = (int)$now->format('w');
        
        return self::matchesCronPart($minute, $currentMinute) &&
               self::matchesCronPart($hour, $currentHour) &&
               self::matchesCronPart($day, $currentDay) &&
               self::matchesCronPart($month, $currentMonth) &&
               self::matchesCronPart($dayOfWeek, $currentDayOfWeek);
    }
    
    /**
     * Verifica se um valor corresponde à parte da expressão cron
     *
     * @param string $part Parte da expressão (ex: "*5", "0", "0-5")
     * @param int $value Valor atual
     * @return bool
     */
    private static function matchesCronPart(string $part, int $value): bool {
        $part = trim($part);
        
        // Qualquer valor
        if ($part === '*') {
            return true;
        }
        
        // Intervalo
        if (str_contains($part, '*/')) {
            $interval = (int)str_replace('*/', '', $part);
            return $value % $interval === 0;
        }
        
        // Range
        if (str_contains($part, '-')) {
            [$start, $end] = explode('-', $part);
            return $value >= (int)$start && $value <= (int)$end;
        }
        
        // Valores múltiplos
        if (str_contains($part, ',')) {
            return in_array((string)$value, explode(',', $part));
        }
        
        // Valor específico
        return (int)$part === $value;
    }
    
    /**
     * Registra a execução de uma tarefa
     *
     * @param string $taskName Nome da tarefa
     * @param string $message Mensagem
     */
    private static function log(string $taskName, string $message): void {
        $logFile = self::$logDir . '/' . $taskName . '.log';
        $timestamp = (new \DateTime())->format('Y-m-d H:i:s');
        file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
    }
    
    /**
     * Obtém o histórico de execução de uma tarefa
     *
     * @param string $taskName Nome da tarefa
     * @param int $lines Número de linhas a retornar
     * @return array
     */
    public static function getLog(string $taskName, int $lines = 50): array {
        self::init();
        
        $logFile = self::$logDir . '/' . $taskName . '.log';
        
        if (!file_exists($logFile)) {
            return [];
        }
        
        $allLines = file($logFile);
        return array_slice($allLines, -$lines);
    }
    
    /**
     * Limpa o histórico de uma tarefa
     *
     * @param string $taskName Nome da tarefa
     */
    public static function clearLog(string $taskName): bool {
        self::init();
        
        $logFile = self::$logDir . '/' . $taskName . '.log';
        
        if (file_exists($logFile)) {
            return unlink($logFile);
        }
        
        return true;
    }
    
    /**
     * Obtém status de todas as tarefas
     *
     * @return array
     */
    public static function status(): array {
        self::init();
        
        $status = [];
        
        foreach (self::$tasks as $name => $task) {
            $logFile = self::$logDir . '/' . $name . '.log';
            $lastRun = file_exists($logFile) ? filemtime($logFile) : null;
            
            $status[$name] = [
                'schedule' => $task['schedule'],
                'last_run' => $lastRun ? date('Y-m-d H:i:s', $lastRun) : 'Never',
                'log_file' => $logFile
            ];
        }
        
        return $status;
    }
    
    /**
     * Lista todas as tarefas registradas
     *
     * @return array
     */
    public static function list(): array {
        return array_keys(self::$tasks);
    }
    
    /**
     * Obtém o próximo horário de execução de uma tarefa
     *
     * @param string $schedule Expressão cron
     * @return string Data/hora no formato Y-m-d H:i:s
     */
    public static function nextRun(string $schedule): string {
        $now = new \DateTime();
        
        for ($i = 0; $i < 1440; $i++) { // Verifica próximos 24 horas
            $now->modify('+1 minute');
            if (self::shouldRun($schedule, $now)) {
                return $now->format('Y-m-d H:i:s');
            }
        }
        
        return 'Never in next 24 hours';
    }
}

// Inicializa automaticamente
Cron::init();
