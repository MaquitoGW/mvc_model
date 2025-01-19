<?php

namespace Controllers;

use lib\File;
use lib\Request;
use lib\Response;

class Site extends App
{
    public function welcome() {
        return Response::view("welcome");
    }
}
