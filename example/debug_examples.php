<?php

/**
 * DEBUG EXAMPLES
 * 
 * Exemplos práticos de como usar as novas funções de debug
 * LogView() e CutErr() com exibição de rota
 */

// ============================================
// 1. DD - EXIBIR E PARAR
// ============================================

function exemplo_1_dd()
{
    $usuario = ['id' => 1, 'nome' => 'João', 'email' => 'joao@example.com'];
    
    // Exibe o usuário e para a execução
    // A rota atual será exibida no header
    dd($usuario);
}

// ============================================
// 2. DUMP - EXIBIR SEM PARAR
// ============================================

function exemplo_2_dump()
{
    $usuario = ['id' => 1, 'nome' => 'João'];
    $configuracao = ['theme' => 'dark', 'language' => 'pt-br'];
    
    // Exibe múltiplas variáveis sem parar
    // A rota atual será exibida no header
    dump($usuario, $configuracao);
    
    echo "Continuou após dump!";
}

// ============================================
// 3. LOGVIEW - REGISTRAR EM LOG
// ============================================

function exemplo_3_logview()
{
    $usuario = [
        'id' => 1,
        'nome' => 'João Silva',
        'email' => 'joao@example.com',
        'login_em' => date('Y-m-d H:i:s')
    ];
    
    // Registra em storage/logs/debug.log
    // Não exibe na tela
    // Inclui: timestamp, rota, arquivo, linha e dados
    logView($usuario, 'USER_LOGIN');
    
    echo "Dados registrados em log!";
}

// ============================================
// 4. CUTERR - CAPTURAR ERRO E EXIBIR NA TELA
// ============================================

function exemplo_4_cuterr_exibir()
{
    // Exibe o erro na tela (padrão)
    cutErr(function() {
        $usuario = sql::SELECT("usuarios")->where("id", 999)->first();
        
        if (!$usuario) {
            throw new Exception("Usuário não encontrado");
        }
        
        echo "Usuário: " . $usuario['nome'];
    }, false); // false = exibir na tela
}

// ============================================
// 5. CUTERR - CAPTURAR ERRO E LOGAR
// ============================================

function exemplo_5_cuterr_logar()
{
    // Registra o erro em storage/logs/errors.log
    // Não exibe na tela
    cutErr(function() {
        $arquivo = fopen('arquivo_inexistente.txt', 'r');
        $conteudo = fread($arquivo, 1024);
    }, true); // true = registrar em log
    
    echo "Erro foi registrado em log se houver";
}

// ============================================
// 6. EXEMPLO COMPLETO - FORM DE REGISTRO
// ============================================

function exemplo_6_registro_completo()
{
    // Dados do formulário
    $dados = $_POST ?? [];
    
    // Log dos dados recebidos
    logView($dados, 'FORM_SUBMISSION');
    
    // Validação com tratamento de erro
    cutErr(function() use ($dados) {
        // Validar dados
        if (empty($dados['email']) || empty($dados['senha'])) {
            throw new Exception("E-mail e senha são obrigatórios");
        }
        
        if (strlen($dados['senha']) < 8) {
            throw new Exception("Senha deve ter no mínimo 8 caracteres");
        }
        
        // Verificar se usuário já existe
        $existe = sql::SELECT("usuarios")
            ->where("email", $dados['email'])
            ->first();
        
        if ($existe) {
            throw new Exception("Este e-mail já está registrado");
        }
        
        // Inserir novo usuário
        sql::INSERT("usuarios", [
            'email' => $dados['email'],
            'password' => password_hash($dados['senha'], PASSWORD_BCRYPT),
            'criado_em' => date('Y-m-d H:i:s')
        ])->execute();
        
        logView(['email' => $dados['email']], 'USER_REGISTERED');
        
        return Response::json(['sucesso' => true, 'mensagem' => 'Usuário registrado!']);
    }, false); // Exibe erro na tela se houver
}

// ============================================
// 7. EXEMPLO - AUTENTICAÇÃO COM CAPTURA
// ============================================

function exemplo_7_login()
{
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    
    // Log da tentativa de login
    logView(['email' => $email, 'timestamp' => date('Y-m-d H:i:s')], 'LOGIN_ATTEMPT');
    
    // Capturar erro na autenticação
    cutErr(function() use ($email, $senha) {
        $usuario = sql::SELECT("usuarios")->where("email", $email)->first();
        
        if (!$usuario || !password_verify($senha, $usuario['password'])) {
            throw new Exception("E-mail ou senha incorretos");
        }
        
        // Login bem-sucedido
        session_start();
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_email'] = $usuario['email'];
        
        logView(['user_id' => $usuario['id']], 'LOGIN_SUCCESS');
        
        return Response::json(['sucesso' => true, 'redirect' => '/dashboard']);
    }, false); // Exibe erro na tela
}

// ============================================
// 8. EXEMPLO - PROCESSAMENTO COM MÚLTIPLOS LOGS
// ============================================

function exemplo_8_processamento()
{
    $pedido_id = $_GET['id'] ?? null;
    
    if (!$pedido_id) {
        cutErr(function() {
            throw new Exception("ID do pedido não fornecido");
        }, false);
        return;
    }
    
    // Log do início do processamento
    logView(['pedido_id' => $pedido_id], 'PEDIDO_INICIO');
    
    cutErr(function() use ($pedido_id) {
        // Buscar pedido
        $pedido = sql::SELECT("pedidos")->where("id", $pedido_id)->first();
        
        if (!$pedido) {
            throw new Exception("Pedido não encontrado");
        }
        
        logView($pedido, 'PEDIDO_ENCONTRADO');
        
        // Processar pagamento
        if ($pedido['status'] !== 'pendente') {
            throw new Exception("Pedido já foi processado");
        }
        
        // Atualizar status
        sql::UPDATE("pedidos")
            ->set(['status' => 'processado', 'processado_em' => date('Y-m-d H:i:s')])
            ->where("id", $pedido_id)
            ->execute();
        
        logView(['pedido_id' => $pedido_id, 'novo_status' => 'processado'], 'PEDIDO_PROCESSADO');
        
        echo "Pedido processado com sucesso!";
    }, false);
}

// ============================================
// 9. EXEMPLO - DEBUG DE CONSULTA
// ============================================

function exemplo_9_debug_consulta()
{
    // Ativar debug de consultas
    logView(['acao' => 'iniciando debug de consulta'], 'DEBUG_START');
    
    $usuarios = sql::SELECT("usuarios")
        ->where("status", "ativo")
        ->limit(10)
        ->get();
    
    // Exibir resultado
    dump($usuarios);
    
    logView(['total' => count($usuarios)], 'USUARIOS_ENCONTRADOS');
}

// ============================================
// 10. EXEMPLO - TRATAMENTO DE EXCEÇÃO COMPLEXA
// ============================================

function exemplo_10_tratamento_complexo()
{
    cutErr(function() {
        // Iniciar transação
        // sql::beginTransaction();
        
        try {
            // Operação 1
            $usuario_id = sql::INSERT("usuarios", [
                'email' => 'novo@example.com',
                'nome' => 'Novo Usuário'
            ])->execute();
            
            logView(['usuario_id' => $usuario_id], 'USUARIO_CRIADO');
            
            // Operação 2
            sql::INSERT("perfis", [
                'usuario_id' => $usuario_id,
                'tipo' => 'cliente'
            ])->execute();
            
            logView(['usuario_id' => $usuario_id, 'tipo' => 'cliente'], 'PERFIL_CRIADO');
            
            // Operação 3
            sql::INSERT("configuracoes", [
                'usuario_id' => $usuario_id,
                'theme' => 'light'
            ])->execute();
            
            logView(['usuario_id' => $usuario_id], 'CONFIGURACOES_CRIADAS');
            
            // sql::commit();
            
            echo "Todas as operações completadas!";
        } catch (Exception $e) {
            // sql::rollback();
            throw new Exception("Erro ao criar usuário: " . $e->getMessage());
        }
    }, false); // Exibe erro se houver
}

// ============================================
// 11. EXEMPLO - MONITORAMENTO DE PERFORMANCE
// ============================================

function exemplo_11_performance()
{
    $inicio = microtime(true);
    
    logView(['acao' => 'iniciando processamento'], 'PERFORMANCE_START');
    
    // Suas operações aqui
    sleep(1); // Simula processamento
    
    $fim = microtime(true);
    $tempo_decorrido = ($fim - $inicio) * 1000;
    
    logView([
        'tempo_ms' => round($tempo_decorrido, 2),
        'acao' => 'processamento concluído'
    ], 'PERFORMANCE_END');
    
    echo "Processamento levou " . round($tempo_decorrido, 2) . "ms";
}

// ============================================
// 12. EXEMPLO - RELATÓRIO DE ERRO
// ============================================

function exemplo_12_relatorio_erro()
{
    cutErr(function() {
        // Simular erro
        $resultado = json_decode(file_get_contents('arquivo_invalido.json'), true);
        
        if ($resultado === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("JSON inválido: " . json_last_error_msg());
        }
        
        echo "JSON processado com sucesso";
    }, true); // Registra em log
}

// ============================================
// COMO USAR ESTES EXEMPLOS
// ============================================

/*

Nos seus controladores:

use lib\Debug;

public function criar() {
    $dados = $_POST;
    
    // Debug dos dados
    dump($dados);
    
    // Registrar em log
    logView($dados, 'FORM_DATA');
    
    // Processar com tratamento de erro
    cutErr(function() use ($dados) {
        // Código que pode gerar erro
        sql::INSERT("tabela", $dados)->execute();
    }, false); // false = exibe erro, true = loga
}

// Configuração necessária no .env:
DEBUG=true

// Os logs serão salvos em:
// - storage/logs/debug.log (via logView)
// - storage/logs/errors.log (via cutErr com true)

// Todos os outputs incluem:
// - Arquivo e linha do código
// - Rota atual ($_SERVER['REQUEST_URI'])
// - Timestamp do evento
// - Dados completos

*/
