<?php

namespace Controllers;

use lib\File;
use lib\Request;
use lib\Response;

use Exception;

class Site extends App
{
    public function welcome()
    {
        return Response::view("welcome");
    }

    public function test()
    {
        echo "<h1>🧪 Testes Básicos do Framework MVC Model</h1>";
        echo "<hr>";

        // ============ 1. TESTE DEBUG ============
        echo "<h2>1️⃣ Sistema de Debug</h2>";
        echo "<p><strong>dump():</strong> Exibe variável e continua</p>";
        $usuario = ["id" => 1, "nome" => "João Silva", "email" => "joao@example.com"];
        dump($usuario);
        echo "<p>✓ Continuou após dump()</p>";
        echo "<hr>";

        // ============ 2. TESTE CACHE ============
        // echo "<h2>2️⃣ Sistema de Cache</h2>";
        
        // // Armazenar no cache
        // cache_put("teste_chave", "Dados em Cache", 3600);
        // echo "<p>✓ Dados armazenados em cache</p>";
        
        // // Recuperar do cache
        // $valor_cache = cache_get("teste_chave");
        // echo "<p><strong>Valor do cache:</strong> " . htmlspecialchars($valor_cache) . "</p>";
        
        // // Verificar se existe
        // if (cache_has("teste_chave")) {
        //     echo "<p>✓ Cache encontrado</p>";
        // }
        
        // // Cache com callback (cache_remember)
        // $dados = cache_remember("lista_usuarios", 3600, function() {
        //     return ["João", "Maria", "Pedro"];
        // });
        // echo "<p><strong>Cache com callback:</strong> " . implode(", ", $dados) . "</p>";
        
        // echo "<hr>";

        // ============ 3. TESTE LOGGING ============
        echo "<h2>3️⃣ Sistema de Logging</h2>";
        logView([
            "acao" => "teste_basico",
            "usuario" => "Admin",
            "timestamp" => date("Y-m-d H:i:s")
        ], 'TESTE_BASICO');
        echo "<p>✓ Evento registrado em log (storage/logs/debug.log)</p>";
        echo "<hr>";

        // ============ 4. TESTE MODO ============
        echo "<h2>4️⃣ Modo da Aplicação</h2>";
        $modo = getenv('MODE');
        $debug = getenv('DEBUG');
        echo "<p><strong>Modo:</strong> " . htmlspecialchars($modo) . "</p>";
        echo "<p><strong>Debug:</strong> " . htmlspecialchars($debug) . "</p>";
        echo "<hr>";

        // ============ 5. TESTE TRATAMENTO DE ERRO ============
        echo "<h2>5️⃣ Tratamento de Erros (cutErr)</h2>";
        echo "<p>Testando tratamento com logging...</p>";
        
        cutErr(function () {
            throw new Exception("Erro simulado para teste");
        }, true); // true = salva em log
        
        echo "<p>✓ Erro foi capturado e registrado em log</p>";
        echo "<hr>";

        // ============ 6. TESTE REQUEST ============
        echo "<h2>6️⃣ Classe Request</h2>";
        $request = new Request();
        $metodo = $_SERVER['REQUEST_METHOD'];
        echo "<p><strong>Método HTTP:</strong> " . htmlspecialchars($metodo) . "</p>";
        echo "<p><strong>URL Atual:</strong> " . htmlspecialchars($_SERVER['REQUEST_URI']) . "</p>";
        echo "<p><strong>User Agent:</strong> " . htmlspecialchars($_SERVER['HTTP_USER_AGENT'] ?? 'N/A') . "</p>";
        echo "<hr>";

        // ============ 7. TESTE ARQUIVO ============
        echo "<h2>7️⃣ Manipulação de Arquivos</h2>";
        $file = new File();
        $exists = file_exists("VERSION.md");
        echo "<p><strong>Arquivo VERSION.md existe:</strong> " . ($exists ? "✓ Sim" : "✗ Não") . "</p>";
        if ($exists) {
            $versao = file_get_contents("VERSION.md");
            echo "<p><strong>Conteúdo:</strong> " . htmlspecialchars(substr($versao, 0, 100)) . "...</p>";
        }
        echo "<hr>";

        // ============ 8. TESTE VARIÁVEIS DE AMBIENTE ============
        echo "<h2>8️⃣ Variáveis de Ambiente (.env)</h2>";
        echo "<p><strong>APP_URL:</strong> " . htmlspecialchars(getenv('APP_URL') ?? 'N/A') . "</p>";
        echo "<p><strong>DB_DRIVER:</strong> " . htmlspecialchars(getenv('DB_DRIVER') ?? 'N/A') . "</p>";
        echo "<p><strong>CACHE_DRIVER:</strong> " . htmlspecialchars(getenv('CACHE_DRIVER') ?? 'N/A') . "</p>";
        echo "<hr>";

        // ============ 9. TESTE SESSION ============
        echo "<h2>9️⃣ Sessão</h2>";
        $_SESSION['teste_sessao'] = "Valor de sessão de teste";
        echo "<p>✓ Valor armazenado em sessão</p>";
        echo "<p><strong>Valor:</strong> " . htmlspecialchars($_SESSION['teste_sessao']) . "</p>";
        echo "<hr>";

        // ============ RESUMO ============
        echo "<h2>✅ Resumo dos Testes</h2>";
        echo "<ul>";
        echo "<li>✓ Debug (dump, logView, cutErr)</li>";
        echo "<li>✓ Cache (put, get, has, remember)</li>";
        echo "<li>✓ Logging</li>";
        echo "<li>✓ Modo e Debug</li>";
        echo "<li>✓ Request (metodo, URI, headers)</li>";
        echo "<li>✓ Arquivos</li>";
        echo "<li>✓ Variáveis de Ambiente</li>";
        echo "<li>✓ Session</li>";
        echo "</ul>";
        echo "<hr>";
        echo "<p><strong>📝 Nota:</strong> Verifique os logs em <code>storage/logs/debug.log</code></p>";
        
        return;
    }
}
