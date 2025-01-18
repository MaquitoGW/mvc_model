<?php
namespace lib;

class Request {

    private $postData;
    private $fileData;
    private $getData;
    private $serverData;

    public function __construct() {
        $this->postData = $_POST ?? [];
        $this->fileData = $_FILES ?? [];
        $this->getData = $_GET ?? [];
        $this->serverData = $_SERVER ?? [];
    }

    // Obtém um valor do POST
    public function input($name) {
        return $this->postData[$name] ?? null;
    }

    // Obtém um valor do GET
    public function query($name) {
        return $this->getData[$name] ?? null;
    }

    // Obtém um arquivo do FILES
    public function files($name = null) {
        if (is_null($name)) return $this->fileData;
        return $this->fileData[$name] ?? null;
    }

    // Obtém dados de cabeçalhos da requisição via $_SERVER
    public function header($name) {
        $header = strtoupper(str_replace('-', '_', $name));
        return $this->serverData['HTTP_' . $header] ?? null;
    }

    // Obtém todos os dados (POST, GET, FILES)
    public function all() {
        return [
            'post' => $this->postData,
            'get' => $this->getData,
            'files' => $this->fileData,
        ];
    }
}