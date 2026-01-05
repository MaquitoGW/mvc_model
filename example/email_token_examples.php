<?php

/**
 * EMAIL E TOKEN EXAMPLES
 * 
 * Exemplos práticos de como usar Email (PHPMailer) e Token (JWT)
 * Este arquivo contém exemplos funcionais que você pode adaptar
 */

// ============================================
// 1. EXEMPLO SIMPLES - ENVIO DE E-MAIL
// ============================================

function exemplo_1_email_simples()
{
    use_namespace('lib');

    $mail = new Mail();
    
    $resultado = $mail->send(
        'Bem-vindo ao nosso site!',
        '<h1>Olá, Bem-vindo!</h1><p>Sua conta foi criada com sucesso.</p>',
        ['usuario@example.com']
    );

    if ($resultado['success']) {
        echo "E-mail enviado com sucesso!";
    } else {
        echo "Erro: " . $resultado['error'];
    }
}

// ============================================
// 2. E-MAIL COM MÚLTIPLOS DESTINATÁRIOS
// ============================================

function exemplo_2_email_multiplos()
{
    use_namespace('lib');

    $mail = new Mail();
    
    $destinatarios = [
        'usuario1@example.com',
        'usuario2@example.com',
        'usuario3@example.com'
    ];

    $html = '
        <h1>Notificação Importante</h1>
        <p>Este é um e-mail para múltiplos destinatários.</p>
        <p><strong>Data:</strong> ' . date('d/m/Y H:i:s') . '</p>
    ';

    $resultado = $mail->send('Notificação do Sistema', $html, $destinatarios);
    
    if ($resultado['success']) {
        echo "E-mail enviado para " . count($destinatarios) . " pessoas!";
    } else {
        echo "Erro: " . $resultado['error'];
    }
}

// ============================================
// 3. E-MAIL COM TEMPLATE HTML
// ============================================

function exemplo_3_email_template()
{
    use_namespace('lib');

    $mail = new Mail();

    // Dados para o template
    $dados = [
        'nome' => 'João Silva',
        'email' => 'joao@example.com',
        'data_cadastro' => date('d/m/Y'),
        'link_confirmacao' => 'https://seusite.com/confirmar?token=abc123'
    ];

    // HTML template
    $html = "
        <html>
        <body style='font-family: Arial; line-height: 1.6; color: #333;'>
            <h1>Bem-vindo ao MVC Model, {$dados['nome']}!</h1>
            
            <p>Sua conta foi criada com sucesso em {$dados['data_cadastro']}.</p>
            
            <p><strong>E-mail:</strong> {$dados['email']}</p>
            
            <p>Para confirmar sua conta, clique no link abaixo:</p>
            <p>
                <a href='{$dados['link_confirmacao']}' 
                   style='display: inline-block; padding: 10px 20px; 
                          background-color: #4CAF50; color: white; 
                          text-decoration: none; border-radius: 5px;'>
                   Confirmar Conta
                </a>
            </p>
            
            <hr>
            <p><small>Este é um e-mail automático, não responda.</small></p>
        </body>
        </html>
    ";

    $resultado = $mail->send(
        'Confirme sua conta no MVC Model',
        $html,
        [$dados['email']]
    );

    return $resultado;
}

// ============================================
// 4. CRIAR TOKEN JWT
// ============================================

function exemplo_4_criar_token()
{
    use_namespace('lib');

    // Criar token para um usuário
    $user_id = 42;
    
    $token = Token::create($user_id);

    echo "Token criado: " . $token;
    
    return $token;
}

// ============================================
// 5. VALIDAR TOKEN JWT
// ============================================

function exemplo_5_validar_token()
{
    use_namespace('lib');

    $token = $_GET['token'] ?? null;

    if (!$token) {
        echo "Nenhum token fornecido";
        return false;
    }

    if (Token::isValid($token)) {
        echo "✓ Token válido!";
        
        // Decodificar para obter os dados
        $payload = Token::decode($token);
        echo "User ID: " . $payload->user_id;
        echo "Emitido em: " . date('d/m/Y H:i:s', $payload->iat);
        
        return $payload;
    } else {
        echo "✗ Token inválido ou expirado";
        return false;
    }
}

// ============================================
// 6. FLUXO DE LOGIN COM TOKEN
// ============================================

function exemplo_6_login_com_token($email, $senha)
{
    use_namespace('lib');

    // Buscar usuário no banco
    $user = sql::SELECT("usuarios")
        ->where("email", $email)
        ->first();

    if (!$user) {
        return ['sucesso' => false, 'erro' => 'Usuário não encontrado'];
    }

    // Verificar senha
    if (!password_verify($senha, $user['password'])) {
        return ['sucesso' => false, 'erro' => 'Senha incorreta'];
    }

    // Criar token
    $token = Token::create($user['id']);

    return [
        'sucesso' => true,
        'token' => $token,
        'usuario' => [
            'id' => $user['id'],
            'nome' => $user['nome'],
            'email' => $user['email']
        ]
    ];
}

// ============================================
// 7. MIDDLEWARE DE AUTENTICAÇÃO COM TOKEN
// ============================================

function exemplo_7_middleware_autenticacao()
{
    use_namespace('lib');

    // Extrair token do header Authorization
    $header = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
    
    if (!preg_match('/Bearer\s+(.*)$/i', $header, $matches)) {
        return [
            'autenticado' => false,
            'erro' => 'Token não fornecido'
        ];
    }

    $token = $matches[1];

    // Validar token
    if (!Token::isValid($token)) {
        return [
            'autenticado' => false,
            'erro' => 'Token inválido ou expirado'
        ];
    }

    // Decodificar e obter dados do usuário
    $payload = Token::decode($token);

    return [
        'autenticado' => true,
        'user_id' => $payload->user_id,
        'usuario' => sql::SELECT("usuarios")
            ->where("id", $payload->user_id)
            ->first()
    ];
}

// ============================================
// 8. CONFIRMAR E-MAIL COM TOKEN
// ============================================

function exemplo_8_confirmar_email_com_token($token)
{
    use_namespace('lib');

    // Validar token
    if (!Token::isValid($token)) {
        return ['sucesso' => false, 'erro' => 'Link inválido ou expirado'];
    }

    // Extrair user_id do token
    $payload = Token::decode($token);
    $user_id = $payload->user_id;

    // Atualizar usuário como confirmado
    sql::UPDATE("usuarios")
        ->set(['email_confirmado' => 1, 'confirmado_em' => date('Y-m-d H:i:s')])
        ->where("id", $user_id)
        ->execute();

    return [
        'sucesso' => true,
        'mensagem' => 'E-mail confirmado com sucesso!'
    ];
}

// ============================================
// 9. ENVIAR E-MAIL DE RECUPERAÇÃO DE SENHA
// ============================================

function exemplo_9_recuperar_senha($email)
{
    use_namespace('lib');

    // Buscar usuário
    $user = sql::SELECT("usuarios")
        ->where("email", $email)
        ->first();

    if (!$user) {
        // Não informar se o e-mail existe (segurança)
        return ['sucesso' => true, 'mensagem' => 'Se o e-mail existe, receberá um link'];
    }

    // Criar token de recuperação
    $token = Token::create($user['id']);

    // Link para redefinir senha
    $link_reset = 'https://seusite.com/reset-password?token=' . $token;

    // Enviar e-mail
    $mail = new Mail();
    $html = "
        <h1>Recuperação de Senha</h1>
        <p>Clique no link abaixo para redefinir sua senha:</p>
        <p><a href='{$link_reset}'>Redefinir Senha</a></p>
        <p><small>Link válido por 1 hora</small></p>
    ";

    $resultado = $mail->send(
        'Recuperação de Senha',
        $html,
        [$email]
    );

    return $resultado;
}

// ============================================
// 10. ENVIAR E-MAIL VIA CRON JOB
// ============================================

function exemplo_10_email_em_cron()
{
    use_namespace('lib', 'Cron');

    // Registrar cron job para enviar e-mails pendentes
    Cron::register('enviar_emails_pendentes', function() {
        $emails_pendentes = sql::SELECT("fila_emails")
            ->where("status", "pendente")
            ->limit(10)
            ->get();

        $mail = new Mail();

        foreach ($emails_pendentes as $email) {
            $resultado = $mail->send(
                $email['assunto'],
                $email['corpo_html'],
                [$email['destinatario']]
            );

            // Atualizar status
            $novo_status = $resultado['success'] ? 'enviado' : 'erro';
            
            sql::UPDATE("fila_emails")
                ->set(['status' => $novo_status])
                ->where("id", $email['id'])
                ->execute();
        }

        echo "Processados " . count($emails_pendentes) . " e-mails";
    })->everyFiveMinutes('enviar_emails_pendentes');

    // Executar o cron
    // Cron::run();
}

// ============================================
// 11. USAR TOKEN EM API REST
// ============================================

function exemplo_11_api_rest_com_token()
{
    use_namespace('lib');

    // Endpoint: GET /api/usuarios/perfil
    // Com header: Authorization: Bearer SEU_TOKEN

    // Validar token
    $header = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
    
    if (!preg_match('/Bearer\s+(.*)$/i', $header, $matches)) {
        http_response_code(401);
        return json_encode(['erro' => 'Unauthorized']);
    }

    $token = $matches[1];

    if (!Token::isValid($token)) {
        http_response_code(401);
        return json_encode(['erro' => 'Invalid token']);
    }

    // Obter dados do usuário
    $payload = Token::decode($token);
    
    $usuario = sql::SELECT("usuarios")
        ->where("id", $payload->user_id)
        ->first();

    // Retornar dados do usuário
    return json_encode([
        'sucesso' => true,
        'usuario' => [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email']
        ]
    ]);
}

// ============================================
// 12. REFRESH TOKEN (RENOVAR SESSÃO)
// ============================================

function exemplo_12_refresh_token($token_antigo)
{
    use_namespace('lib');

    // Validar token antigo
    if (!Token::isValid($token_antigo)) {
        return ['sucesso' => false, 'erro' => 'Token inválido'];
    }

    // Extrair user_id
    $payload = Token::decode($token_antigo);

    // Gerar novo token
    $novo_token = Token::create($payload->user_id);

    return [
        'sucesso' => true,
        'token' => $novo_token,
        'mensagem' => 'Sessão renovada com sucesso'
    ];
}

// ============================================
// CONFIGURAÇÕES NECESSÁRIAS NO .env
// ============================================

/*
# E-mail Configuration
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu_email@gmail.com
MAIL_PASSWORD=sua_senha_app
MAIL_FROM_NAME=Seu Site

# JWT Configuration  
JWT_SECRET=sua_chave_secreta_super_segura
JWT_ALGORITHM=HS256
JWT_EXPIRES=3600  # 1 hora em segundos

# Para Gmail: Use "App Password" ao invés da senha normal
# https://myaccount.google.com/apppasswords

# Para Outlook: Use a senha da conta
# Para AWS SES: Use as credenciais do IAM
*/

// ============================================
// USAR ESTES EXEMPLOS
// ============================================

/*

// 1. No seu controlador:
use lib\Mail;
use lib\Token;

// Enviar e-mail simples
$mail = new Mail();
$mail->send('Assunto', '<h1>Olá</h1>', ['email@example.com']);

// Criar token
$token = Token::create($user_id);

// Validar token
if (Token::isValid($token)) {
    $payload = Token::decode($token);
    $user_id = $payload->user_id;
}

// 2. Com cron jobs:
Cron::register('meu_cron', function() {
    $mail = new Mail();
    $mail->send('Subject', '<h1>Automático</h1>', ['email@example.com']);
})->daily('meu_cron');

// 3. Em middlewares:
$token = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
if (preg_match('/Bearer\s+(.*)$/i', $token, $m) && Token::isValid($m[1])) {
    $payload = Token::decode($m[1]);
    // Usuário autenticado: $payload->user_id
}

*/
