<?php

namespace lib;

class Response
{
    private $routeName;
    private $querys = [];

    public function __construct()
    {
        session_start();
    }

    // Exbir view
    public static function view($value)
    {
        return require "views/" . $value . ".html";
    }

    // obter rota
    public static function route($name) {
        $instance = new Self();
        return $instance;
    }

    // Redirecione para a url especifica
    public static function redirect($url)
    {
        $instance = new Self();
        $_SESSION['HTTP_URI'] = $_SERVER['REQUEST_URI']; // passar uri atual
        header("Location: " . $url);
        return $instance;
        exit;
    }

    // Volta a página anterior
    public static function back()
    {
        $instance = new Self();
        header("Location: " . $_SESSION['HTTP_URI']);
        return $instance;
        exit;
    }

    // Obtem os atributos da url
    public static function attributes($query)
    {
        return isset($_GET[$query]) ? $_GET[$query] : false;
    }

    public static function message() {}

    public static function getMessage() {}


    public static function abort($code, $message = null)
    {
        $errorCodes = [
            // 4xx - Erros do Cliente
            400 => 'Bad Request',                 // Solicitação inválida
            401 => 'Unauthorized',                // Não autorizado (precisa de autenticação)
            402 => 'Payment Required',            // Requisição de pagamento
            403 => 'Forbidden',                   // Proibido (não tem permissão para acessar)
            404 => 'Not Found',                   // Não encontrado
            405 => 'Method Not Allowed',          // Método não permitido
            406 => 'Not Acceptable',              // Não aceitável (tipo de resposta não suportado)
            407 => 'Proxy Authentication Required', // Requer autenticação de proxy
            408 => 'Request Timeout',             // Tempo limite da solicitação
            409 => 'Conflict',                    // Conflito na solicitação
            410 => 'Gone',                         // O recurso não está mais disponível
            411 => 'Length Required',             // O cabeçalho Content-Length é necessário
            412 => 'Precondition Failed',         // Falha na pré-condição
            413 => 'Payload Too Large',           // Corpo da solicitação muito grande
            414 => 'URI Too Long',                // URI muito longa
            415 => 'Unsupported Media Type',     // Tipo de mídia não suportado
            416 => 'Range Not Satisfiable',       // Intervalo solicitado não satisfatório
            417 => 'Expectation Failed',          // Expectativa falhou
            418 => 'I\'m a teapot',               // Código de erro do protocolo HTTP/2 (protocolo de brincadeira)
            421 => 'Misdirected Request',         // Solicitação mal direcionada
            422 => 'Unprocessable Entity',       // Entidade não processável
            423 => 'Locked',                      // Recurso bloqueado
            424 => 'Failed Dependency',           // Dependência falhada
            425 => 'Too Early',                   // Solicitação muito precoce
            426 => 'Upgrade Required',            // Requer atualização de protocolo
            428 => 'Precondition Required',      // Requer uma pré-condição
            429 => 'Too Many Requests',          // Muitas solicitações
            431 => 'Request Header Fields Too Large', // Campos de cabeçalho da solicitação muito grandes
            451 => 'Unavailable For Legal Reasons', // Indisponível por razões legais

            // 5xx - Erros do Servidor
            500 => 'Internal Server Error',       // Erro interno do servidor
            501 => 'Not Implemented',             // Método não implementado
            502 => 'Bad Gateway',                 // Gateway ruim
            503 => 'Service Unavailable',        // Serviço indisponível
            504 => 'Gateway Timeout',             // Tempo limite do gateway
            505 => 'HTTP Version Not Supported',  // Versão HTTP não suportada
            506 => 'Variant Also Negotiates',    // Variantes também negociam
            507 => 'Insufficient Storage',       // Armazenamento insuficiente
            508 => 'Loop Detected',              // Loop detectado
            510 => 'Not Extended',                // Não estendido
            511 => 'Network Authentication Required' // Requer autenticação de rede
        ];

        if (is_null($message)) $message = $errorCodes[$code];
        return require "views/err.php";
    }
}
