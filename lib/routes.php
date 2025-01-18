<?php

namespace lib;

use lib\Response;
use lib\IsConfig;
use lib\Request;

class Routes
{
    protected $uri;
    protected $err;
    protected $check = [];
    protected $segments = [];
    protected $found = false;
    protected $parament;
    protected $routes = [];

    /**
     * Construtor da classe Routes.
     * Inicializa a sessão e verifica a URL.
     * Verifica se a URL fornecida corresponde ao ambiente configurado.
     * Caso contrário, retorna um erro 503 (serviço indisponível).
     * Também verifica se a URL aponta para algum arquivo estático.
     */
    public function __construct()
    {
        session_start();

        $mountURL = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
        $urlSTR = str_replace(["/", "."], "-", $mountURL);
        $urlENV = str_replace(["/", "."], "-", IsConfig::env("URL"));

        preg_match("/" . $urlENV . "/", $urlSTR, $valid);

        if (!empty($valid)) {
            $this->uri = str_replace(IsConfig::env("URL"), "/", $mountURL);
            $separator = ["#", "?", "&"];
            foreach ($separator as $key) {
                if (is_array(explode($key, $this->uri))) {
                    $this->uri = explode($key, $this->uri)[0];
                }
            }
        } else Response::abort(503);
        $this->IsAssets(); // Verificar se e algum asset
    }

    /**
     * Define um prefixo para agrupar rotas.
     * O prefixo é adicionado à lista de segmentos da rota e será usado para compor a rota completa.
     *
     * @param string $value O prefixo do grupo de rotas.
     * @return $this
     */
    public function prefix($value)
    {
        $this->segments = []; // Reinicia array
        $this->segments[] = $value; // Adiciona segmento do grupo
        $this->check[] = $value; // Adiciona segmento do grupo para verificacao
        $this->err++;

        return $this;
    }

    /**
     * Define um grupo de rotas com base no prefixo configurado.
     * O callback passado permite definir várias rotas dentro desse grupo.
     *
     * @param callable $callback Função de callback que define as rotas do grupo.
     */
    public function group($callback)
    {
        $callback($this);
    }

    /**
     * Registra uma rota com o método GET.
     * O primeiro parâmetro define o caminho da rota, o segundo define o controlador e método a serem chamados,
     * e o terceiro parâmetro define se a rota pertence ou não a um grupo.
     * Se a rota for encontrada, o método especificado do controlador será executado.
     *
     * @param string $parament O caminho da rota.
     * @param array $array Um array contendo a classe do controlador e o método.
     * @param bool $no_group Se a rota não pertence a um grupo, defina como true.
     * @return $this
     */
    public function get($parament, $array, $no_group = false)
    {
        $header = $this->header($parament, $no_group, "GET");
        if (!$this->found && $header[0]) {
            // Obter classe e o metodo
            $class = $array[0];
            $method = $array[1];

            // check ID
            $param = !empty($header[1]) ? $header[1] : false;

            // Instanciar classe e chamar metodo
            $controller = new $class();
            $controller->$method($param);

            $this->found = true;
        }
        $this->parament = $parament;
        return $this;
    }

    /**
     * Registra uma rota com o método POST.
     * Funciona da mesma maneira que o método get, mas lida com requisições POST.
     *
     * @param string $parament O caminho da rota.
     * @param array $array Um array contendo a classe do controlador e o método.
     * @param bool $no_group Se a rota não pertence a um grupo, defina como true.
     * @return $this
     */
    public function post($parament, $array, $no_group = false)
    {
        $header = $this->header($parament, $no_group, "POST");
        if (!$this->found && $header[0]) {
            // Obter classe e o metodo
            $class = $array[0];
            $method = $array[1];

            // check ID
            $param = !empty($header[1]) ? $header[1] : false;

            // Instanciar classe e chamar metodo
            $controller = new $class();
            $controller->$method(new Request, $param);

            $this->found = true;
        }
        $this->parament = $parament;
        return $this;
    }

    /**
     * Atribui um nome à rota definida.
     * O nome pode ser usado para gerar URLs no controlador.
     *
     * @param string $value Nome da rota.
     * @return $this
     */
    public function name($value)
    {
        $parament = reset($this->segments) . '/' . $this->parament;
        $this->segments = []; // Reinicia array

        $this->routes[$value] = $parament;
        return $this;
    }

    /**
     * Verifica o método HTTP e o caminho da URL para determinar se corresponde à rota definida.
     * Se a rota possuir parâmetros dinâmicos, o método os identifica e os valida.
     * Se o método da requisição não corresponder, retorna um erro 405 (método não permitido).
     *
     * @param string $parament O caminho da rota.
     * @param bool $no_group Indica se a rota pertence a um grupo.
     * @param string $method O método HTTP (GET, POST, etc.).
     * @return array Um array contendo o status da verificação e o parâmetro da rota, se houver.
     */
    public function header($parament, $no_group, $method)
    {
        // Cria a rota
        $this->check[] = trim($parament, '/');
        if (!$no_group) {
            $this->segments[] = $parament;
            $parament = reset($this->segments) . '/' . end($this->segments);
        }

        $regex = "/{[\w]+}/";
        preg_match($regex, $parament, $matche);

        if (!empty($matche)) {
            $remove = explode("/", $this->uri);
            $uri = end($remove);
            $newUri = str_replace($uri, "", $this->uri);
            $newParament = "/" . str_replace($matche, "", $parament);

            if ($newParament == $newUri) {
                if ($_SERVER['REQUEST_METHOD'] == $method) {
                    return [true, $uri];
                } else Response::abort(405);
            } else {
                $this->err++;
                return [false];
            }
        } elseif ('/' . $parament == $this->uri) {
            if ($_SERVER['REQUEST_METHOD'] == $method) return [true];
            else Response::abort(405);
        } else {
            $this->err++;
            return [false];
        }
    }

    /**
     * Verifica se a URL solicitada aponta para um arquivo estático (como CSS, JS, imagens).
     * Caso o arquivo exista, ele é servido com o tipo MIME apropriado.
     * Se o arquivo não for encontrado, retorna um erro 404 (não encontrado).
     */
    private function IsAssets()
    {
        $assets = [
            'img' => null,
            'js' => 'application/javascript',
            'css' => 'text/css',
            'fonts' => null
        ];

        $pathURI = explode("/", $this->uri);
        foreach ($assets as $path => $value) {
            if ($pathURI[1] == $path) {
                if (isset(explode(".", end($pathURI))[1])) {
                    $filePath = __DIR__ . "/../public/" . $pathURI[1] . "/" . end($pathURI);
                    if (file_exists($filePath)) {
                        $mimeType = !is_null($value) ? $value : mime_content_type($filePath);
                        header("Content-Type: $mimeType");
                        readfile($filePath);
                        exit;
                    } else Response::abort(404);
                } else Response::abort(404);
            }
        }
    }

    /**
     * Finaliza a definição das rotas e armazena a lista de rotas nomeadas na sessão.
     * Se nenhuma rota foi encontrada, retorna um erro 404.
     */
    public function exit()
    {
        $_SESSION['routes'] = $this->routes;
        if (!$this->found && count($this->check)) Response::abort(404);
    }
}
