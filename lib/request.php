<?php

namespace lib;

class Request
{

    private $postData;
    private $fileData;
    private $getData;
    private $serverData;

    /**
     * Construtor
     *
     * Inicializa as variáveis com os dados das superglobais $_POST, $_FILES, $_GET e $_SERVER.
     */
    public function __construct()
    {
        $this->postData = $_POST ?? [];
        $this->fileData = $_FILES ?? [];
        $this->getData = $_GET ?? [];
        $this->serverData = $_SERVER ?? [];
    }

    /**
     * Obtém um valor do POST.
     *
     * @param string $name Nome do campo no POST que deseja acessar.
     * @return mixed Retorna o valor do campo POST solicitado ou null se não existir.
     */
    public function input($name)
    {
        return $this->postData[$name] ?? null;
    }

    /**
     * Obtém um valor do GET.
     *
     * @param string $name Nome do parâmetro no GET que deseja acessar.
     * @return mixed Retorna o valor do parâmetro GET solicitado ou null se não existir.
     */
    public function query($name)
    {
        return $this->getData[$name] ?? null;
    }

    /**
     * Obtém um arquivo do FILES.
     *
     * @param string|null $name Nome do arquivo no FILES que deseja acessar. Se não for fornecido, retorna todos os arquivos.
     * @return mixed Retorna o arquivo solicitado ou null se não existir. Se $name for null, retorna todos os arquivos enviados.
     */
    public function files($name = null)
    {
        if (is_null($name)) return $this->fileData;
        return $this->fileData[$name] ?? null;
    }

    /**
     * Obtém dados de cabeçalhos da requisição via $_SERVER.
     *
     * @param string $name Nome do cabeçalho que deseja acessar.
     * @return mixed Retorna o valor do cabeçalho solicitado ou null se não existir.
     */
    public function header($name)
    {
        $header = strtoupper(str_replace('-', '_', $name));
        return $this->serverData['HTTP_' . $header] ?? null;
    }

    /**
     * Obtém todos os dados (POST, GET, FILES).
     *
     * @return array Retorna uma array com todos os dados de POST, GET e FILES.
     */
    public function all()
    {
        return [
            'post' => $this->postData,
            'get' => $this->getData,
            'files' => $this->fileData,
        ];
    }
}
