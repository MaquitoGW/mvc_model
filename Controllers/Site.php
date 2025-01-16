<?php

namespace Controllers;

use lib\File;
use lib\Response;

class Site extends App
{
    public function index()
    {
        // Response::message("sucess", "Sua sessão foi criada")->redirect("teste/maicon");
        // return Response::view("other", [
        //     "maicon" => ["valor", 1, 2, 3, 4]
        // ]);

        // echo File::dir("/maicon/3/", true)->delete();

        // $path = File::IsDir("maicon")->get(true); // Obtem apenas a rota e envia dois valores boleano e caminho completo
        // $path = File::IsDir("maicon", true)->get(true); // Cria a pasta e envia dois valores boleano e caminho completo
        // $path = File::IsDir("maicon", true)->delete()->get(true); // Cria a pasta e  apaga logo apos envia dois valores boleano e mensagem
        // $path = File::IsDir("maicon")->delete()->get(true); // Apaga a pasta e envia dois valores boleano e mensagem
        // $path = File::IsDir("maicon"); // Recebe apenas um objeto
        // $path = File::IsDir("maicon")->get(); // Recebe apenas um valor boleano
        // $path = File::IsDir("maicon")->get(true); // Recebe apenas a rota ou mensagem
    
        // var_dump(File::isFile($path . "eu.png")->delete()->get(true));
    }
    public function index2()
    {
        return Response::view("eu");
    }
}
