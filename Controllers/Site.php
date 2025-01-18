<?php

namespace Controllers;

use lib\File;
use lib\Request;
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

        // $name = md5("maicon". rand(111,423442));
        // $path = File::IsDir("new")->get(true);

        // $data = File::isFile("image.png")->save($name . ".png", "/preto/marron/"); // Aqui salva na pasta especificada do usuario, caso não exista ele cria
        // $data = File::isFile("image.png")->save($name . ".png"); // Aqui vai salvar no home do storage
        // $data = File::isFile("image.png")->save($name . ".png",$path); // Aqui vai salvar com base em um valor de uma buca de pasta

        // echo $data->get(true); // Aqui retorna a resposta

        return Response::view("form", [
            "response" => Response::class
        ]);
    }

    public function form($param)
    {
        var_dump($param);
        // return Response::view("form");
        // echo Response::route("mai");
        // echo $_SESSION['parament'];
    }

    public function reciveForm(Request $e)
    {
        $form = $e->files("valor");

        $name = md5(rand(111, 423442)) . "." . pathinfo($form['name'], PATHINFO_EXTENSION);;
        $path = File::IsDir("new")->get(true);

        // echo $path;
        // $data = File::isFile($form["tmp_name"])->save($name, $path); // Aqui vai salvar com base em um valor de uma buca de pasta

        // File::isFile($path . $name)->readfile();
        echo $path . $name;
        // echo $data->get(true); // Aqui retorna a resposta

        var_dump($_FILES);
    }
}
