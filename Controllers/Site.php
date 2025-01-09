<?php
namespace Controllers;

use lib\Response;

class Site {
    public function index() {
        // Response::redirect("teste/maicon");
    }
    public function index2() {
        Response::back();
    }
}