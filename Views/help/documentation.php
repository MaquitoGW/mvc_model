<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentação - MVC Model</title>
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="/css/help.css">
    <style>
        /* Documentação específica */
        .doc-nav {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            margin-bottom: 64px;
            position: sticky;
            top: 73px;
            z-index: 99;
        }

        .doc-nav ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
            margin: 0;
        }

        .doc-nav a {
            padding: 10px 18px;

            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all .2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: .9rem;

            background: var(--bg-soft);
            border: 1px solid var(--border);
            border-radius: 10px;
            transition: all .2s ease;
        }

        .doc-nav a:hover {
            background: var(--primary-soft);
            color: var(--primary);
            border-color: var(--primary);
        }

        .doc-content {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 48px 40px;
            margin-bottom: 64px;
        }

        .section {
            margin-bottom: 64px;
        }

        .section-title {
            font-size: 2rem;
            color: var(--text-title);
            margin-bottom: 32px;
            padding-bottom: 16px;
            border-bottom: 2px solid var(--border);
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .section-title i {
            width: 32px;
            height: 32px;
            color: var(--primary);
        }

        .subsection-title {
            font-size: 1.2rem;
            color: var(--primary);
            margin: 25px 0;
            padding-left: 16px;
            border-left: 4px solid var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
        }

        .subsection-title i {
            width: 20px;
            height: 20px;
        }

        pre {
            background: var(--bg-soft);
            color: #7ee787;
            padding: 20px;
            border-radius: 10px;
            overflow-x: auto;
            margin: 24px 0;
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
            line-height: 1.5;
        }

        code {
            background: var(--bg-soft);
            padding: 4px 8px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            color: #7ee787;
            font-size: 0.9rem;
        }

        .doc-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            margin: 32px 0;
        }

        .doc-feature {
            background: var(--bg-soft);
            border: 1px solid var(--border);
            padding: 28px;
            border-radius: 10px;
            transition: all .2s ease;
        }

        .doc-feature:hover {
            border-color: var(--primary);
            background: rgba(31, 111, 235, 0.08);
        }

        .doc-feature-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 12px;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .doc-feature-title i {
            width: 20px;
            height: 20px;
        }

        .doc-feature p {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 28px 0;
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background: var(--bg-soft);
        }

        th,
        td {
            padding: 16px;
            border-bottom: 1px solid var(--border);
            text-align: left;
            font-size: 0.9rem;
        }

        th {
            color: var(--text-title);
            font-weight: 600;
            background: var(--bg-soft);
        }

        tbody tr:hover {
            background: rgba(31, 111, 235, 0.05);
        }

        ul,
        ol {
            margin-left: 28px;
            margin-bottom: 16px;
        }

        li {
            margin-bottom: 10px;
            font-size: 0.9rem;
            color: var(--text-main);
            line-height: 1.6;
        }

        .success-box {
            background: var(--bg-soft);
            border-left: 4px solid var(--success);
            padding: 20px;
            border-radius: 10px;
            margin: 24px 0;
        }

        .success-box strong {
            color: var(--text-title);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .warning-box {
            background: var(--bg-soft);
            border-left: 4px solid #d29922;
            padding: 20px;
            border-radius: 10px;
            margin: 24px 0;
        }

        .warning-box strong {
            color: var(--text-title);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .success-box ul,
        .warning-box ul {
            margin-left: 20px;
            margin-top: 8px;
        }

        .success-box li,
        .warning-box li {
            margin-left: 0;
            padding-left: 0;
        }

        @media (max-width: 768px) {
            .doc-nav ul {
                flex-direction: column;
            }

            .doc-nav a {
                width: 100%;
                justify-content: center;
            }

            .doc-content {
                padding: 28px 20px;
            }

            .section-title {
                font-size: 1.6rem;
            }

            .subsection-title {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header>
        <div class="navbar">
            <a href="/" class="logo logo-only">
                <img src="/img/FaviconWhite.png" alt="MVC Model">
            </a>

            <div class="navbar-btn-group">
                <a href="/" class="back-btn">
                    <i data-lucide="arrow-left"></i>
                    Voltar ao Início
                </a>
            </div>
        </div>
    </header>

    <main>

        <!-- HEADER -->
        <section class="container">
            <div class="help-header">
                <div class="hero-logo-wrapper">
                    <img src="/img/logo.png" alt="MVC Model" class="hero-logo">
                </div>

                <h1>Documentação Completa</h1>
                <p>Guia profissional para todos os sistemas do MVC Model</p>
            </div>
        </section>

        <!-- Navigation -->
        <section class="container">
            <nav class="doc-nav">
                <ul>
                    <li><a href="#debug"><i data-lucide="palette"></i> Debug</a></li>
                    <li><a href="#cache"><i data-lucide="database"></i> Cache</a></li>
                    <li><a href="#cron"><i data-lucide="clock-3"></i> Cron</a></li>
                    <li><a href="#email"><i data-lucide="mail"></i> Email</a></li>
                    <li><a href="#mode"><i data-lucide="toggle-left"></i> Modo</a></li>
                    <li><a href="#routes"><i data-lucide="share-2"></i> Rotas</a></li>
                    <li><a href="#controllers"><i data-lucide="code"></i> Controllers</a></li>
                    <li><a href="#database"><i data-lucide="database"></i> BD</a></li>
                    <li><a href="#files"><i data-lucide="folder-open"></i> Arquivos</a></li>
                    <li><a href="#views"><i data-lucide="layout"></i> Views</a></li>
                    <li><a href="#middleware"><i data-lucide="filter"></i> Middleware</a></li>
                    <li><a href="#config"><i data-lucide="settings"></i> Config</a></li>
                    <li><a href="#agradecimentos"><i data-lucide="heart"></i> Agradecimentos</a></li>
                </ul>
            </nav>

            <!-- Content -->
            <div class="doc-content">
                <!-- Debug Section -->
                <div class="section" id="debug">
                    <h2 class="section-title">
                        <i data-lucide="palette"></i>
                        Sistema de Debug com Estilo
                    </h2>

                    <div>
                        <h3 class="subsection-title">
                            <i data-lucide="info"></i>
                            Visão Geral
                        </h3>
                        <p>Sistema de debug inspirado no Laravel com 4 funções principais que exibem variáveis com estilo visual atraente, exibição de rota e logging automático.</p>

                        <div class="doc-features">
                            <div class="doc-feature">
                                <div class="doc-feature-title">
                                    <i data-lucide="zap"></i>
                                    dd()
                                </div>
                                <p>Dump and Die - Exibe variáveis e para a execução</p>
                            </div>
                            <div class="doc-feature">
                                <div class="doc-feature-title">
                                    <i data-lucide="code"></i>
                                    dump()
                                </div>
                                <p>Exibe variáveis formatadas sem parar a execução</p>
                            </div>
                            <div class="doc-feature">
                                <div class="doc-feature-title">
                                    <i data-lucide="file-text"></i>
                                    logView()
                                </div>
                                <p>Registra dados em arquivo de log sem exibir</p>
                            </div>
                            <div class="doc-feature">
                                <div class="doc-feature-title">
                                    <i data-lucide="shield-alert"></i>
                                    cutErr()
                                </div>
                                <p>Captura erros de forma elegante com try-catch</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="subsection-title">
                        <i data-lucide="sliders"></i>
                        Configuração
                    </h3>
                    <pre><code># .env
DEBUG=true   # Ativa o sistema de debug
DEBUG=false  # Desativa o sistema de debug</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="play-circle"></i>
                        Exemplos de Uso
                    </h3>
                    <pre><code>// 1. DD - Exibe e para a execução
$usuario = ['id' => 1, 'nome' => 'João'];
dd($usuario); // Exibe e interrompe tudo

// 2. DUMP - Exibe sem parar
dump($var1, $var2, $var3); // Exibe e continua normalmente

// 3. LOGVIEW - Registra em log
logView(['user_id' => 1, 'acao' => 'login'], 'USER_ACTION');
// Salva em: storage/logs/debug.log

// 4. CUTERR - Captura erros
cutErr(function() {
    $usuario = sql::SELECT("users")->where("id", 999)->first();
    if (!$usuario) {
        throw new Exception("Usuário não encontrado");
    }
}, false); // false = exibe tela, true = salva em log

// 5. Exemplo prático em controlador
public function processar() {
    $dados = $_POST;
    
    // Debug dos dados recebidos
    dump($dados); // Ver os dados
    
    cutErr(function() {
        sql::INSERT("usuarios")->add($dados)->execute();
        Response::message('success', 'Usuário criado!')->redirect('/usuarios');
    }); // Captura erros de BD
}</code></pre>
                </div>

                <!-- Cache Section -->
                <div class="section" id="cache">
                    <h2 class="section-title">
                        <i data-lucide="database"></i>
                        Sistema de Cache (CacheerPHP)
                    </h2>

                    <h3 class="subsection-title">
                        <i data-lucide="info"></i>
                        O que é Cache?
                    </h3>
                    <p>Cache é um sistema de armazenamento temporário que melhora a performance da sua aplicação. Ao invés de executar a mesma operação pesada várias vezes, você armazena o resultado e reutiliza.</p>

                    <div class="success-box">
                        <strong><i data-lucide="check-circle"></i> Casos de Uso</strong>
                        <ul>
                            <li>Resultados de queries complexas</li>
                            <li>Dados de APIs externas</li>
                            <li>Cálculos pesados ou processamentos</li>
                            <li>Sessões de usuários</li>
                            <li>Configurações da aplicação</li>
                        </ul>
                    </div>

                    <h3 class="subsection-title">
                        <i data-lucide="layers"></i>
                        Drivers Disponíveis
                    </h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Driver</th>
                                <th>Configuração</th>
                                <th>Melhor Para</th>
                                <th>Velocidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Array</strong></td>
                                <td>CACHE_DRIVER=array</td>
                                <td>Testes unitários</td>
                                <td>Imediata</td>
                            </tr>
                            <tr>
                                <td><strong>File</strong></td>
                                <td>CACHE_DRIVER=file</td>
                                <td>Desenvolvimento local</td>
                                <td>Rápida</td>
                            </tr>
                            <tr>
                                <td><strong>Redis</strong></td>
                                <td>CACHE_DRIVER=redis</td>
                                <td>Produção (recomendado)</td>
                                <td>Muito Rápida</td>
                            </tr>
                            <tr>
                                <td><strong>Database</strong></td>
                                <td>CACHE_DRIVER=database</td>
                                <td>Dados persistentes</td>
                                <td>Normal</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="warning-box">
                        <strong><i data-lucide="alert-circle"></i> Dica de Produção</strong>
                        <ul>
                            <li>Use <strong>Redis</strong> para melhor performance</li>
                            <li>Defina TTL apropriado (não muito longo, não muito curto)</li>
                            <li>Limpe o cache quando dados são atualizados</li>
                        </ul>
                    </div>

                    <h3 class="subsection-title">
                        <i data-lucide="list"></i>
                        7 Funções Principais
                    </h3>
                    <pre><code>// 1. Armazenar com TTL (em segundos)
cache_put('chave', 'valor', 3600); // Expira em 1 hora

// 2. Recuperar (com valor padrão)
$valor = cache_get('chave', 'padrão');

// 3. Verificar existência
if (cache_has('chave')) {
    echo "Está em cache!";
}

// 4. Remover uma chave
cache_forget('chave');

// 5. Limpar todo o cache
cache_flush();

// 6. Armazenar se não existir, com callback
$dados = cache_remember('usuarios', 3600, function() {
    return sql::SELECT("usuarios")->all();
});

// 7. Recuperar e remover (one-time use)
$codigo = cache_pull('codigo_temporario');</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="zap"></i>
                        Exemplo Prático: Listar Usuários
                    </h3>
                    <pre><code>// Controllers/UserController.php
public function index() {
    // Tenta buscar do cache
    $usuarios = cache_remember('usuarios_list', 3600, function() {
        // Se não estiver em cache, executa a query
        return sql::SELECT("usuarios")
            ->orderBy("name", "ASC")
            ->all();
    });
    
    return Response::view("users.index", ['users' => $usuarios]);
}

// Ao criar novo usuário, limpa o cache
public function store() {
    $dados = $_POST;
    sql::INSERT("usuarios")->add($dados)->execute();
    
    // Limpa o cache para refletir os dados novos
    cache_forget('usuarios_list');
    
    return Response::message('success', 'Usuário criado!')->redirect('/usuarios');
}</code></pre>
                </div>

                <!-- Cron Section -->
                <div class="section" id="cron">
                    <h2 class="section-title">
                        <i data-lucide="clock-3"></i>
                        Sistema de Cron Jobs
                    </h2>

                    <h3 class="subsection-title">
                        <i data-lucide="info"></i>
                        O que é Cron Jobs?
                    </h3>
                    <p>Cron Jobs são tarefas agendadas que executam automaticamente em intervalos de tempo. Ideais para limpeza de dados, envio de emails, backup, atualização de dados, etc.</p>

                    <div class="success-box">
                        <strong><i data-lucide="check-circle"></i> Exemplos de Uso</strong>
                        <ul>
                            <li>Limpar sessões expiradas</li>
                            <li>Enviar emails em massa</li>
                            <li>Gerar relatórios</li>
                            <li>Atualizar cache</li>
                            <li>Fazer backup de dados</li>
                            <li>Sincronizar com APIs externas</li>
                        </ul>
                    </div>

                    <h3 class="subsection-title">
                        <i data-lucide="plus-circle"></i>
                        Registrar uma Tarefa
                    </h3>
                    <p>Você pode registrar crons dentro dos seus controladores ou em arquivos separados:</p>
                    <pre><code>use lib\Cron;

// Registrar um cron
Cron::register('enviar_emails', function() {
    // Sua lógica aqui
    echo "Emails enviados com sucesso!";
})->daily('enviar_emails');  // Executa diariamente</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="calendar"></i>
                        Agendamentos Disponíveis
                    </h3>
                    <pre><code>// Minutos e Horas
->everyMinute('task')          // A cada minuto
->everyFiveMinutes('task')     // A cada 5 minutos
->everyTenMinutes('task')      // A cada 10 minutos
->everyThirtyMinutes('task')   // A cada 30 minutos
->hourly('task')               // A cada hora

// Diários
->daily('task')                // Diariamente à meia-noite
->dailyAt('14:30', 'task')     // Todos os dias às 14:30
->twiceDaily('task')           // Duas vezes ao dia (00:00 e 12:00)

// Semanais e Mensais
->weekly('task')               // Toda semana (segunda-feira)
->weeklyOn(1, '09:00', 'task') // Toda segunda às 09:00
->monthly('task')              // Mensalmente (1º dia do mês)
->monthlyOn(15, '10:00', 'task') // Dia 15 de cada mês às 10:00

// Anuais
->yearly('task')               // A cada ano</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="play"></i>
                        Executar Crons
                    </h3>
                    <pre><code>// Opção 1: Via rota no controlador
$route->get("admin/cron-run", [AdminController::class, "runCron"], true);

// Opção 2: Via CLI (linha de comando)
php cron-runner.php

// Opção 3: Via Cron do Sistema Operacional
// Adicione esta linha ao seu crontab:
* * * * * /usr/bin/php /caminho/para/cron-runner.php

// Para editar crontab no Linux/Mac:
crontab -e</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="zap"></i>
                        Exemplo Prático: Limpeza Automática
                    </h3>
                    <pre><code>// Controllers/AdminController.php
public function setupCrons() {
    // Limpar sessões expiradas todos os dias
    Cron::register('cleanup_sessions', function() {
        $expiredTime = time() - (24 * 3600); // 24 horas atrás
        sql::DELETE("sessions")
            ->where("last_activity", "<", $expiredTime)
            ->execute();
        echo "Sessões expiradas removidas!";
    })->daily('cleanup_sessions');

    // Enviar emails pendentes a cada 15 minutos
    Cron::register('send_pending_emails', function() {
        $emails = sql::SELECT("email_queue")
            ->where("sent", 0)
            ->all();
        
        foreach ($emails as $email) {
            // Enviar email
            echo "Email enviado para: " . $email['to'];
            sql::UPDATE("email_queue")
                ->set(['sent' => 1])
                ->where("id", $email['id'])
                ->execute();
        }
    })->everyFifteenMinutes('send_pending_emails');

    echo "Crons registrados com sucesso!";
}</code></pre>

                    <div class="warning-box">
                        <strong><i data-lucide="alert-circle"></i> Dicas Importantes</strong>
                        <ul>
                            <li>Configure seu cron do sistema para executar a cada minuto</li>
                            <li>Verifique se o arquivo <code>cron-runner.php</code> existe na raiz do projeto</li>
                            <li>Monitore logs em <code>storage/logs</code> para debugar crons</li>
                            <li>Use TTL curto para crons críticos, longo para não-críticos</li>
                        </ul>
                    </div>
                </div>

                <!-- Email Section -->
                <div class="section" id="email">
                    <h2 class="section-title">
                        <i data-lucide="mail"></i>
                        Email e Autenticação
                    </h2>

                    <h3 class="subsection-title">
                        <i data-lucide="info"></i>
                        Visão Geral
                    </h3>
                    <p>O framework oferece dois sistemas integrados: envio de emails robusto com PHPMailer e autenticação segura com JWT (JSON Web Tokens).</p>

                    <!-- EMAIL SUBSECTION -->
                    <h3 class="subsection-title">
                        <i data-lucide="send"></i>
                        Enviar Email (PHPMailer)
                    </h3>
                    <p>PHPMailer é uma biblioteca robusta para envio de emails com suporte a SMTP, TLS/SSL e múltiplas configurações de segurança.</p>

                    <pre><code>use lib\Mail;

// Configuração básica
$mail = new Mail();
$recipients = ['user@example.com'];
$subject = "Bem-vindo ao MVC Model!";
$body = "<h1>Olá!</h1><p>Seu acesso foi ativado com sucesso.</p>";

$resultado = $mail->send($subject, $body, $recipients);

if ($resultado) {
    echo "Email enviado com sucesso!";
} else {
    echo "Erro ao enviar email";
}</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="settings"></i>
                        Configurar Email no .env
                    </h3>
                    <pre><code># .env - Configurações SMTP
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_FROM=seu-email@gmail.com
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-de-app

# Exemplo para Gmail com Senha de App
# 1. Ative 2FA na sua conta Google
# 2. Gere uma "Senha de Aplicação"
# 3. Use esta senha no campo MAIL_PASSWORD</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="zap"></i>
                        Exemplo Prático: Email de Bem-vindo
                    </h3>
                    <pre><code>// Controllers/UserController.php
public function store() {
    $dados = $_POST;
    
    // Criar usuário
    $user_id = sql::INSERT("users")->add($dados)->execute();
    
    // Enviar email de bem-vindo
    $mail = new Mail();
    $subject = "Bem-vindo, " . $dados['name'] . "!";
    $body = "
        <h2>Bem-vindo ao MVC Model!</h2>
        <p>Sua conta foi criada com sucesso.</p>
        <p>Email: " . $dados['email'] . "</p>
        <p><a href='https://seu-site.com/login'>Fazer Login</a></p>
    ";
    
    $resultado = $mail->send($subject, $body, [$dados['email']]);
    
    return Response::message('success', 'Usuário criado!')
        ->redirect('/usuarios');
}</code></pre>

                    <!-- JWT SUBSECTION -->
                    <h3 class="subsection-title">
                        <i data-lucide="key"></i>
                        Autenticação com JWT
                    </h3>
                    <p>JWT (JSON Web Token) é um padrão para autenticação stateless, ideal para APIs e aplicações modernas. O token é assinado criptograficamente.</p>

                    <div class="success-box">
                        <strong><i data-lucide="check-circle"></i> Vantagens JWT</strong>
                        <ul>
                            <li>Stateless - Sem necessidade de sessões no servidor</li>
                            <li>Escalável - Funciona bem em aplicações distribuídas</li>
                            <li>Seguro - Criptograficamente assinado</li>
                            <li>Portável - Funciona em diferentes domínios e dispositivos</li>
                        </ul>
                    </div>

                    <h3 class="subsection-title">
                        <i data-lucide="zap"></i>
                        Criar Token JWT
                    </h3>
                    <pre><code>use lib\Token;

// Dados do usuário
$user = [
    'id' => 1,
    'email' => 'user@example.com',
    'nome' => 'João Silva',
    'role' => 'admin'
];

// Criar token (válido por 24 horas)
$token = Token::create($user);
echo $token;  // Retorna JWT criptografado

// Exemplo: Após login bem-sucedido
Response::json([
    'success' => true,
    'token' => $token,
    'user' => $user
]);</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="check-circle"></i>
                        Validar e Decodificar Token
                    </h3>
                    <pre><code>// Recuperar token do header
$token = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
$token = str_replace('Bearer ', '', $token);

// Validar token
if (Token::validate($token)) {
    // Decodificar
    $decoded = Token::decode($token);
    
    echo "Bem-vindo, " . $decoded->nome;
    echo "Seu email: " . $decoded->email;
    
    // Usar em middleware de autenticação
} else {
    Response::error('Token inválido ou expirado', 401);
}</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="layers"></i>
                        Exemplo Prático: Middleware de Autenticação
                    </h3>
                    <pre><code>// Middlewares/AuthMiddleware.php
class AuthMiddleware {
    public function handle($next) {
        $token = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
        
        if (empty($token)) {
            return Response::error('Token não fornecido', 401);
        }
        
        $token = str_replace('Bearer ', '', $token);
        
        if (!Token::validate($token)) {
            return Response::error('Token inválido', 401);
        }
        
        // Token válido, continuar
        return $next();
    }
}</code></pre>

                    <div class="warning-box">
                        <strong><i data-lucide="alert-circle"></i> Dicas de Segurança</strong>
                        <ul>
                            <li>Sempre use HTTPS em produção</li>
                            <li>Defina expiração curta para tokens (1-24 horas)</li>
                            <li>Use refresh tokens para renovar acesso</li>
                            <li>Nunca armazene dados sensíveis no JWT</li>
                            <li>Valide tokens em cada requisição da API</li>
                        </ul>
                    </div>
                </div>

                <!-- Mode Section -->
                <div class="section" id="mode">
                    <h2 class="section-title">
                        <i data-lucide="toggle-left"></i>
                        Modo Production vs Dev
                    </h2>

                    <h3 class="subsection-title">
                        <i data-lucide="info"></i>
                        Visão Geral
                    </h3>
                    <p>O framework oferece dois modos de operação: Desenvolvimento (Dev) e Produção (Production). Cada um com comportamento diferente para erros e debug.</p>

                    <h3 class="subsection-title">
                        <i data-lucide="monitor"></i>
                        Modo Dev (Desenvolvimento)
                    </h3>
                    <pre><code># .env
MODE=Dev
DEBUG=true
APP_URL=http://localhost:8000</code></pre>
                    <div class="success-box">
                        <strong><i data-lucide="check-circle"></i> Comportamento:</strong>
                        <ul>
                            <li>Exibe erros completos com detalhes</li>
                            <li>Mostra arquivo, linha e tipo de erro</li>
                            <li>Stack trace completo em caso de exceção</li>
                            <li>Debug functions funcionam: dd(), dump(), logView(), cutErr()</li>
                            <li>Tudo é registrado em logs</li>
                            <li>Cache pode ser desativado facilmente</li>
                        </ul>
                    </div>

                    <h3 class="subsection-title">
                        <i data-lucide="shield"></i>
                        Modo Production (Produção)
                    </h3>
                    <pre><code># .env
MODE=Production
DEBUG=false
APP_URL=https://seu-dominio.com

# Adicione variaveis de produção
DB_HOST=seu-servidor-db
CACHE_DRIVER=redis
MAIL_HOST=smtp.gmail.com</code></pre>
                    <div class="warning-box">
                        <strong><i data-lucide="alert-triangle"></i> Comportamento:</strong>
                        <ul>
                            <li>Oculta detalhes técnicos dos erros do usuário</li>
                            <li>Exibe mensagem genérica ao usuário</li>
                            <li>Erros completos são registrados apenas em logs</li>
                            <li>Debug functions desativadas (dd, dump ignoram saída)</li>
                            <li>Máxima segurança contra exposição de informações</li>
                            <li>Cache deve estar ativo para melhor performance</li>
                        </ul>
                    </div>

                    <h3 class="subsection-title">
                        <i data-lucide="zap"></i>
                        Exemplo: Tratamento de Erro
                    </h3>
                    <pre><code>// Seu código
try {
    $usuario = sql::SELECT("users")->where("id", 999)->first();
} catch (Exception $e) {
    // Em DEV: Exibe "User not found on line 42 of UserController"
    // Em PRODUCTION: Exibe "Ocorreu um erro ao processar sua requisição"
    if (getenv('MODE') === 'Dev') {
        throw $e;
    }
    logView($e->getMessage(), 'ERROR');
    return Response::error('Ocorreu um erro');
}</code></pre>
                </div>

                <!-- Config Section -->
                <div class="section" id="config">
                    <h2 class="section-title">
                        <i data-lucide="settings"></i>
                        Configuração do Projeto
                    </h2>

                    <h3 class="subsection-title">
                        <i data-lucide="info"></i>
                        Primeiro Passo
                    </h3>
                    <p>O arquivo <code>.env</code> é essencial para configurar sua aplicação. Crie-o baseado no arquivo <code>.env.example</code> ou copie o modelo abaixo.</p>

                    <h3 class="subsection-title">
                        <i data-lucide="file-code"></i>
                        Arquivo .env - Configuração Completa
                    </h3>
                    <pre><code># ===== APLICAÇÃO =====
APP_NAME=MVC Model
APP_URL=http://localhost:8000
DOMAIN=localhost

# ===== DEBUG E MODO =====
DEBUG=true
MODE=Dev

# ===== BANCO DE DADOS =====
DB_DRIVER=mysql
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=
DB_NAME=mvc_model
DB_PORT=3306

# ===== CACHE =====
# Opções: array, file, redis, database
CACHE_DRIVER=file

# ===== EMAIL (SMTP) =====
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_FROM=seu_email@gmail.com
MAIL_USERNAME=seu_email@gmail.com
MAIL_PASSWORD=sua_app_password

# ===== JWT (Autenticação) =====
JWT_SECRET=sua_chave_secreta_muito_longa_e_segura_aqui
JWT_ALGORITHM=HS256
JWT_EXPIRATION=86400

# ===== CACHE DRIVERS (Se Redis) =====
REDIS_HOST=localhost
REDIS_PORT=6379
REDIS_PASSWORD=null
REDIS_DATABASE=0</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="shield"></i>
                        Dicas de Segurança
                    </h3>
                    <div class="warning-box">
                        <strong><i data-lucide="alert-circle"></i> Proteja seu .env</strong>
                        <ul>
                            <li>Nunca compartilhe o arquivo .env publicamente</li>
                            <li>Adicione .env ao .gitignore</li>
                            <li>Use chaves seguras e aleatórias (senhas, JWT_SECRET)</li>
                            <li>Altere credenciais padrão antes de ir a produção</li>
                            <li>Use variáveis de ambiente do servidor em produção</li>
                        </ul>
                    </div>

                    <h3 class="subsection-title">
                        <i data-lucide="folder-structure"></i>
                        Estrutura de Diretórios
                    </h3>
                    <pre><code>mvc_model/
├── Controllers/          # Seus controladores
│   ├── App.php
│   ├── Site.php
│   └── ...
├── Views/                # Suas views (HTML)
│   ├── welcome.php
│   ├── help/
│   └── ...
├── Public/               # Arquivos públicos (CSS, JS, IMG)
│   ├── css/
│   ├── js/
│   └── img/
├── storage/              # Cache, logs, uploads
│   ├── cache/
│   ├── logs/
│   └── uploads/
├── lib/                  # Biblioteca interna do framework
│   ├── debug.php         # Sistema de debug
│   ├── cache.php         # Sistema de cache
│   ├── cron.php          # Agendador de tarefas
│   ├── mail.php          # Envio de emails
│   ├── token.php         # JWT tokens
│   ├── sql.php           # Query builder
│   ├── sessions.php      # Gerenciamento de sessão
│   └── ...
├── Middlewares/          # Processadores de requisição
├── routes/               # Definição de rotas
│   └── web.php
├── .env                  # Configurações da aplicação
├── index.php             # Arquivo de entrada
└── cron-runner.php       # Executor de crons</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="zap"></i>
                        Acessar Configurações no Código
                    </h3>
                    <pre><code>// Usar getenv() para acessar variáveis .env
$app_url = getenv('APP_URL');
$debug = getenv('DEBUG') === 'true';
$modo = getenv('MODE');
$cache_driver = getenv('CACHE_DRIVER');

// Exemplo em um controlador
public function index() {
    if (getenv('MODE') === 'Dev') {
        dump("Estou em desenvolvimento!");
    }
    
    return Response::view("welcome", [
        'app_url' => getenv('APP_URL'),
        'debug' => getenv('DEBUG')
    ]);
}</code></pre>

                    <div class="success-box">
                        <strong><i data-lucide="check-circle"></i> Checklist de Configuração</strong>
                        <ul>
                            <li>✓ Criar arquivo .env baseado em .env.example</li>
                            <li>✓ Configurar banco de dados</li>
                            <li>✓ Definir cache driver (recomendado: redis em produção)</li>
                            <li>✓ Configurar email SMTP</li>
                            <li>✓ Gerar JWT_SECRET seguro</li>
                            <li>✓ Testar conexão ao banco de dados</li>
                            <li>✓ Verificar permissões da pasta storage/</li>
                            <li>✓ Adicionar .env ao .gitignore</li>
                        </ul>
                    </div>
                </div>

                <!-- Summary -->
                <div class="section">
                    <h2 class="section-title">
                        <i data-lucide="list-check"></i>
                        Resumo de Implementações
                    </h2>
                    <div class="doc-features">
                        <div class="doc-feature">
                            <div class="doc-feature-title">
                                <i data-lucide="check"></i>
                                Debug (4 funções)
                            </div>
                            <p>Sistema com estilo visual e logging automático</p>
                        </div>
                        <div class="doc-feature">
                            <div class="doc-feature-title">
                                <i data-lucide="check"></i>
                                Cache (7 funções)
                            </div>
                            <p>CacheerPHP com 4 drivers</p>
                        </div>
                        <div class="doc-feature">
                            <div class="doc-feature-title">
                                <i data-lucide="check"></i>
                                Cron (15+ agendamentos)
                            </div>
                            <p>Sistema completo de tarefas agendadas</p>
                        </div>
                        <div class="doc-feature">
                            <div class="doc-feature-title">
                                <i data-lucide="check"></i>
                                Email (PHPMailer)
                            </div>
                            <p>Suporte a Gmail, Outlook, AWS SES</p>
                        </div>
                        <div class="doc-feature">
                            <div class="doc-feature-title">
                                <i data-lucide="check"></i>
                                JWT (Firebase)
                            </div>
                            <p>Autenticação segura com tokens</p>
                        </div>
                        <div class="doc-feature">
                            <div class="doc-feature-title">
                                <i data-lucide="check"></i>
                                Mode (Production/Dev)
                            </div>
                            <p>Controle inteligente de erros</p>
                        </div>
                    </div>
                </div>

                <!-- Routes Section -->
                <div class="section" id="routes">
                    <h2 class="section-title">
                        <i data-lucide="share-2"></i>
                        Sistema de Rotas
                    </h2>

                    <h3 class="subsection-title">
                        <i data-lucide="info"></i>
                        O que são Rotas?
                    </h3>
                    <p>Rotas mapeiam URLs (como /usuarios ou /posts/123) para métodos de controladores. Quando um usuário acessa uma URL, o framework usa as rotas para decidir qual código executar.</p>

                    <div class="success-box">
                        <strong><i data-lucide="check-circle"></i> Tipos de Rotas</strong>
                        <ul>
                            <li><strong>GET</strong> - Recuperar dados (requisições seguras)</li>
                            <li><strong>POST</strong> - Submeter dados (formulários)</li>
                            <li><strong>PUT/PATCH</strong> - Atualizar dados</li>
                            <li><strong>DELETE</strong> - Remover dados</li>
                        </ul>
                    </div>

                    <h3 class="subsection-title">
                        <i data-lucide="road"></i>
                        Criar uma Rota
                    </h3>
                    <p>As rotas devem ser definidas no arquivo <code>routes/web.php</code> usando a classe <code>Routes</code>:</p>
                    <pre><code>use lib\Routes;
use Controllers\UserController;
use Controllers\Site;

$route = new Routes();

// GET - Listar usuários
$route->get("usuarios", [UserController::class, "index"], true);

// GET - Exibir um usuário específico
$route->get("usuarios/@id", [UserController::class, "show"], true);

// POST - Criar novo usuário
$route->post("usuarios", [UserController::class, "store"], true);

// Nomeando rotas para usar em views
$route->post("usuarios/@id", [UserController::class, "update"], true)
    ->name("usuarios.update");

$route->delete("usuarios/@id", [UserController::class, "destroy"], true)
    ->name("usuarios.destroy");

// Finalizando rotas
$route->exit();</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="layers"></i>
                        Grupos de Rotas
                    </h3>
                    <p>Agrupe rotas que compartilham o mesmo prefixo para melhor organização:</p>
                    <pre><code>// Agrupar rotas com prefixo /admin
$route->prefix("admin")->group(function ($e) {
    $e->get("dashboard", [AdminController::class, "dashboard"]);
    $e->get("usuarios", [AdminController::class, "users"]);
    $e->post("login", [AuthController::class, "login"]);
    $e->post("logout", [AuthController::class, "logout"]);
});

// Resultado:
// /admin/dashboard
// /admin/usuarios
// /admin/login
// /admin/logout</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="zap"></i>
                        Parâmetros de Rota
                    </h3>
                    <pre><code>// Parâmetro obrigatório
$route->get("usuarios/@id", [UserController::class, "show"], true);

// Parâmetro opcional
$route->get("posts/@page?", [BlogController::class, "index"], true);

// Múltiplos parâmetros
$route->get("usuarios/@id/posts/@post_id", [UserController::class, "posts"], true);

// Usar no controlador:
public function show($id) {
    $user = sql::SELECT("users")->where("id", $id)->first();
    return Response::view("users.show", ['user' => $user]);
}</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="shield"></i>
                        Rotas Protegidas
                    </h3>
                    <pre><code>// Rota que requer autenticação (terceiro parâmetro = true)
$route->get("dashboard", [DashboardController::class, "index"], true);

// Rota pública (terceiro parâmetro = false ou omitido)
$route->get("home", [Site::class, "index"], false);

// O framework verifica se o usuário está autenticado
// Se não estiver, redireciona para a página de login</code></pre>
                </div>

                <!-- Controllers Section -->
                <div class="section" id="controllers">
                    <h2 class="section-title">
                        <i data-lucide="code"></i>
                        Controladores e Requests
                    </h2>

                    <h3 class="subsection-title">
                        <i data-lucide="info"></i>
                        O que são Controladores?
                    </h3>
                    <p>Controladores são classes que contêm a lógica da aplicação. Eles recebem requisições HTTP, processam dados e retornam respostas (views ou JSON).</p>

                    <h3 class="subsection-title">
                        <i data-lucide="file-code"></i>
                        Estrutura de um Controlador
                    </h3>
                    <p>Controladores devem estar na pasta <code>Controllers/</code> e herdar da classe <code>App</code>:</p>
                    <pre><code>namespace Controllers;

use Controllers\App;
use lib\sql;
use lib\Response;

class UserController extends App {
    // Listar todos os usuários
    public function index() {
        $users = sql::SELECT("users")->all();
        return Response::view("users.index", ['users' => $users]);
    }
    
    // Exibir um usuário específico
    public function show($id) {
        $user = sql::SELECT("users")->where("id", $id)->first();
        
        if (!$user) {
            return Response::error("Usuário não encontrado", 404);
        }
        
        return Response::view("users.show", ['user' => $user]);
    }
    
    // Armazenar novo usuário
    public function store() {
        $dados = $_POST;
        
        // Validar dados
        if (empty($dados['name']) || empty($dados['email'])) {
            return Response::message('error', 'Nome e email são obrigatórios')
                ->back();
        }
        
        // Inserir no banco
        sql::INSERT("users")->add($dados)->execute();
        
        return Response::message('success', 'Usuário criado com sucesso!')
            ->redirect('/usuarios');
    }
    
    // Atualizar usuário
    public function update($id) {
        $dados = $_POST;
        
        sql::UPDATE("users")
            ->set($dados)
            ->where("id", $id)
            ->execute();
        
        return Response::message('success', 'Usuário atualizado!')
            ->redirect('/usuarios/' . $id);
    }
    
    // Deletar usuário
    public function destroy($id) {
        sql::DELETE("users")->where("id", $id)->execute();
        
        return Response::message('success', 'Usuário removido!')
            ->redirect('/usuarios');
    }
}</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="inbox"></i>
                        Classe Request
                    </h3>
                    <p>Facilita o acesso aos dados das requisições HTTP:</p>
                    <pre><code>use lib\Request;

$request = new Request();

// Acessar dados POST (formulários)
$username = $request->input('username');
$email = $request->input('email');

// Acessar dados GET (query string)
$search = $request->query('search');
$page = $request->query('page', 1); // Com valor padrão

// Acessar FILES (upload)
$file = $request->files('avatar');

// Acessar Headers HTTP
$userAgent = $request->header('user-agent');
$auth = $request->header('authorization');

// Obter todos os inputs
$all_data = $request->all();

// Verificar se requisição é POST
if ($request->isPost()) {
    // Processar formulário
}</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="arrow-right"></i>
                        Classe Response
                    </h3>
                    <p>Oferece métodos para respostas, redirecionamentos e mensagens:</p>
                    <pre><code>use lib\Response;

// Renderizar uma view
Response::view("users.show", ['user' => $user]);

// Redirecionar
Response::redirect('/home');

// Voltar página anterior
Response::back();

// Mensagens de sessão
Response::message('success', 'Operação realizada!')
    ->redirect('/');

// Obter mensagem da sessão
$msg = Response::getMessage('success');

// Retornar JSON
Response::json([
    'success' => true,
    'message' => 'Dados processados',
    'data' => $user
]);

// Erro HTTP
Response::error('Página não encontrada', 404);
Response::abort(403, 'Acesso negado');

// Obter atributo da URL (parâmetro)
$id = Response::attribute('id');</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="zap"></i>
                        Exemplo Completo: CRUD
                    </h3>
                    <pre><code>// Controllers/ProductController.php
public function store() {
    $data = $_POST;
    
    // Validar dados
    if (empty($data['name']) || empty($data['price'])) {
        return Response::message('error', 'Nome e preço são obrigatórios')
            ->back();
    }
    
    // Usar cache para listar produtos
    cache_forget('products_list');
    
    // Inserir
    sql::INSERT("products")->add($data)->execute();
    
    // Enviar email de notificação
    $mail = new Mail();
    $mail->send(
        "Novo Produto: " . $data['name'],
        "Um novo produto foi cadastrado.",
        ['admin@exemplo.com']
    );
    
    return Response::message('success', 'Produto criado com sucesso!')
        ->redirect('/productos');
}</code></pre>
                </div>

                <!-- Database Section -->
                <div class="section" id="database">
                    <h2 class="section-title">
                        <i data-lucide="database"></i>
                        Banco de Dados (SQL)
                    </h2>

                    <h3 class="subsection-title">
                        <i data-lucide="plus"></i>
                        Inserir Dados
                    </h3>
                    <pre><code>sql::INSERT("users")->add([
    'name' => 'João Silva',
    'email' => 'joao@example.com',
    'password' => password_hash('senha123', PASSWORD_BCRYPT)
])->execute();

// Inserir múltiplos
sql::INSERT("users")->add([
    ['name' => 'João', 'email' => 'joao@example.com'],
    ['name' => 'Maria', 'email' => 'maria@example.com']
])->execute();</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="search"></i>
                        Selecionar Dados
                    </h3>
                    <pre><code>// Um resultado
$user = sql::SELECT("users")->where("id", 1)->get();

// Primeiro resultado
$user = sql::SELECT("users")->where("status", "active")->first();

// Todos os resultados
$users = sql::SELECT("users")->where("status", "active")->all();

// Com múltiplas condições
$users = sql::SELECT("users")
    ->where("status", "active")
    ->where("role", "admin")
    ->all();</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="edit"></i>
                        Atualizar Dados
                    </h3>
                    <pre><code>sql::UPDATE("users")->set([
    'name' => 'Novo Nome',
    'updated_at' => date('Y-m-d H:i:s')
])->where("id", 1)->execute();

// Múltiplas condições
sql::UPDATE("users")->set(['status' => 'inactive'])
    ->where("role", "!=", "admin")
    ->execute();</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="trash-2"></i>
                        Deletar Dados
                    </h3>
                    <pre><code>// Por ID
sql::DELETE("users")->where("id", 1)->execute();

// Por condição
sql::DELETE("users")
    ->where("status", "inactive")
    ->where("created_at", "<", date('Y-m-d', strtotime('-1 year')))
    ->execute();</code></pre>
                </div>

                <!-- Files Section -->
                <div class="section" id="files">
                    <h2 class="section-title">
                        <i data-lucide="folder-open"></i>
                        Manipulação de Arquivos
                    </h2>

                    <h3 class="subsection-title">
                        <i data-lucide="info"></i>
                        Sobre a Classe File
                    </h3>
                    <p>A classe <code>File</code> permite manipulação segura de arquivos e diretórios na pasta <code>storage/</code>:</p>

                    <h3 class="subsection-title">
                        <i data-lucide="check"></i>
                        Métodos Disponíveis
                    </h3>
                    <pre><code>// Verificar diretório
File::isDir("meuDiretorio", true)->get(); // Cria se não existir

// Verificar arquivo
if (File::isFile("documento.pdf")->get()) {
    echo "Arquivo existe";
}

// Renomear
File::rename("nome_novo.pdf")->get();

// Deletar
File::isFile("imagem.png")->delete()->get();

// Alterar permissões
File::permissions(0755)->get();

// Salvar arquivo
File::save($arquivo, "uploads")->get();

// Ler arquivo
$conteudo = File::readFile()->get();</code></pre>
                </div>

                <!-- Views Section -->
                <div class="section" id="views">
                    <h2 class="section-title">
                        <i data-lucide="layout"></i>
                        Sistema de Views
                    </h2>

                    <h3 class="subsection-title">
                        <i data-lucide="eye"></i>
                        Exibir Views
                    </h3>
                    <p>Para retornar uma view dentro do controlador, utilize o método <code>view</code>:</p>
                    <pre><code>// Arquivo: Controllers/UserController.php
public function index() {
    $users = sql::SELECT("users")->all();
    return Response::view("users.index", ['users' => $users]);
}

public function show($id) {
    $user = sql::SELECT("users")->where("id", $id)->get();
    return Response::view("users.show", ['user' => $user]);
}</code></pre>

                    <h3 class="subsection-title">
                        <i data-lucide="folder-tree"></i>
                        Estrutura de Arquivos
                    </h3>
                    <p>As views devem estar na pasta <code>views/</code>. Use ponto (.) para acessar subpastas:</p>
                    <pre><code>// Arquivo: views/users/index.php
<h1>Lista de Usuários</h1>
<ul>
    <?php foreach ($users as $user): ?>
        <li><?= htmlspecialchars($user['name']) ?></li>
    <?php endforeach; ?>
</ul>

// Chamado como:
Response::view("users.index", ['users' => $users])</code></pre>
                </div>

                <!-- Middleware Section -->
                <div class="section" id="middleware">
                    <h2 class="section-title">
                        <i data-lucide="filter"></i>
                        Middlewares
                    </h2>

                    <h3 class="subsection-title">
                        <i data-lucide="info"></i>
                        O que é Middleware?
                    </h3>
                    <p>Middlewares são classes que processam requisições antes de chegarem aos controladores. O projeto inclui middlewares essenciais:</p>

                    <h3 class="subsection-title">
                        <i data-lucide="list"></i>
                        Middlewares Inclusos
                    </h3>
                    <div class="doc-features">
                        <div class="doc-feature">
                            <div class="doc-feature-title">
                                <i data-lucide="bug"></i>
                                DebugMiddleware
                            </div>
                            <p>Registra informações de debug durante a execução</p>
                        </div>
                        <div class="doc-feature">
                            <div class="doc-feature-title">
                                <i data-lucide="log"></i>
                                LogAccessMiddleware
                            </div>
                            <p>Registra acessos e requisições em logs</p>
                        </div>
                        <div class="doc-feature">
                            <div class="doc-feature-title">
                                <i data-lucide="shield"></i>
                                SecurityMiddleware
                            </div>
                            <p>Adiciona headers de segurança nas respostas</p>
                        </div>
                        <div class="doc-feature">
                            <div class="doc-feature-title">
                                <i data-lucide="lock"></i>
                                StartSessionMiddleware
                            </div>
                            <p>Inicializa sessões do usuário automaticamente</p>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- Agradecimentos Especiais -->
        <section id="agradecimentos" class="container section">
            <h2 class="section-title">
                <i data-lucide="heart"></i>
                Agradecimentos Especiais
            </h2>

            <div style="background: linear-gradient(135deg, rgba(31, 111, 235, 0.1) 0%, rgba(46, 160, 67, 0.1) 100%); border: 1px solid var(--border); border-radius: var(--radius); padding: 24px; margin: 24px 0;">
                <h3 class="subsection-title">
                    <i data-lucide="star"></i>
                    Créditos e Reconhecimentos
                </h3>

                <p style="color: var(--text-main); line-height: 1.6; margin: 16px 0;">
                    Este projeto foi desenvolvido com dedicação e inclui integrações de ferramentas excelentes da comunidade open source. Gostaríamos de expressar nossos agradecimentos especiais:
                </p>

                <div class="doc-features">
                    <div class="doc-feature" style="background: var(--bg-card); border: 1px solid var(--border);">
                        <h4 style="color: var(--text-title); margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="database"></i>
                            CacheerPHP
                        </h4>
                        <p style="color: var(--text-main); font-size: 0.9rem; margin: 8px 0;">
                            Sistema de cache excelente e otimizado, fornecendo suporte a múltiplos drivers (Redis, File, Database, Array).
                        </p>
                        <p style="color: var(--text-muted); font-size: 0.85rem; margin: 8px 0;">
                            Desenvolvido por <strong><a href="https://github.com/silviooosilva" target="_blank" style="color: #1f6feb; text-decoration: none;">Silvio Silva</a></strong>
                        </p>
                    </div>

                    <div class="doc-feature" style="background: var(--bg-card); border: 1px solid var(--border);">
                        <h4 style="color: var(--text-title); margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="mail"></i>
                            PHPMailer
                        </h4>
                        <p style="color: var(--text-main); font-size: 0.9rem; margin: 8px 0;">
                            Biblioteca robusta para envio de emails com suporte a SMTP, POP3 e múltiplas configurações de segurança.
                        </p>
                        <p style="color: var(--text-muted); font-size: 0.85rem; margin: 8px 0;">
                            Projeto open source confiável da comunidade PHP
                        </p>
                    </div>

                    <div class="doc-feature" style="background: var(--bg-card); border: 1px solid var(--border);">
                        <h4 style="color: var(--text-title); margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="code"></i>
                            Firebase JWT
                        </h4>
                        <p style="color: var(--text-main); font-size: 0.9rem; margin: 8px 0;">
                            Implementação segura de JSON Web Tokens, essencial para autenticação stateless e API security.
                        </p>
                        <p style="color: var(--text-muted); font-size: 0.85rem; margin: 8px 0;">
                            Padrão confiável na comunidade para gerenciar tokens
                        </p>
                    </div>

                    <div class="doc-feature" style="background: var(--bg-card); border: 1px solid var(--border);">
                        <h4 style="color: var(--text-title); margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="package"></i>
                            Guzzle HTTP
                        </h4>
                        <p style="color: var(--text-main); font-size: 0.9rem; margin: 8px 0;">
                            Cliente HTTP poderoso para requisições e integração com APIs externas, simplificando comunicação entre serviços.
                        </p>
                        <p style="color: var(--text-muted); font-size: 0.85rem; margin: 8px 0;">
                            Padrão da indústria para requisições HTTP em PHP
                        </p>
                    </div>

                    <div class="doc-feature" style="background: var(--bg-card); border: 1px solid var(--border);">
                        <h4 style="color: var(--text-title); margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="shield"></i>
                            PHP DotEnv
                        </h4>
                        <p style="color: var(--text-main); font-size: 0.9rem; margin: 8px 0;">
                            Solução elegante para gerenciar variáveis de ambiente, protegendo credenciais sensíveis e configurações.
                        </p>
                        <p style="color: var(--text-muted); font-size: 0.85rem; margin: 8px 0;">
                            Best practice para aplicações seguras
                        </p>
                    </div>
                </div>

                <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--border);">
                    <h3 style="color: var(--text-title); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                        <i data-lucide="gift"></i>
                        Quer Contribuir?
                    </h3>
                    <p style="color: var(--text-main); margin-bottom: 16px;">
                        Este é um projeto open source e sua contribuição é muito bem-vinda! Você pode:
                    </p>
                    <ul style="color: var(--text-main); margin-left: 20px; line-height: 1.8;">
                        <li>Reportar bugs e sugerir melhorias</li>
                        <li>Enviar pull requests com novas funcionalidades</li>
                        <li>Melhorar a documentação e exemplos</li>
                        <li>Compartilhar seu feedback e usar casos</li>
                    </ul>

                    <a href="https://www.buymeacoffee.com/maquitogw" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; background: #1f6feb; color: white; padding: 10px 20px; border-radius: var(--radius); text-decoration: none; font-weight: 500; transition: background 0.3s; margin-top: 16px;">
                        <i data-lucide="coffee"></i>
                        Apoie o Desenvolvimento
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">

            <!-- Brand -->
            <div class="footer-brand">
                <img src="/img/logo.png" alt="MVC Model">
                <p>
                    Framework PHP moderno inspirado no Laravel,
                    focado em produtividade, organização e performance.
                </p>
            </div>

            <!-- Links -->
            <div class="footer-links">

                <div class="footer-column">
                    <h4>Navegação</h4>
                    <a href="/">Home</a>
                    <a href="/help">Centro de Ajuda</a>
                    <a href="/help/documentation">Documentação</a>
                    <a href="/test">Testes</a>
                </div>

                <div class="footer-column">
                    <h4>Principais Seções</h4>
                    <a href="/help/documentation#debug">Debug</a>
                    <a href="/help/documentation#cache">Cache</a>
                    <a href="/help/documentation#cron">Cron Jobs</a>
                    <a href="/help/documentation#email">Email & JWT</a>
                </div>

                <div class="footer-column">
                    <h4>Comunidade</h4>
                    <a href="https://github.com/maquitogw/mvc_model" target="_blank">
                        <i data-lucide="github"></i> GitHub
                    </a>
                    <a href="https://www.linkedin.com/in/maquitogw/" target="_blank">
                        <i data-lucide="linkedin"></i> LinkedIn
                    </a>
                    <a href="mailto:maicongoncalves826@gmail.com" target="_blank">
                        <i data-lucide="mail"></i> Email
                    </a>
                </div>

            </div>
        </div>

        <!-- Bottom -->
        <div class="footer-bottom">
            <span>© <?= date('Y') ?> MVC Model</span>
            <span>Licença MIT</span>
        </div>
    </footer>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>