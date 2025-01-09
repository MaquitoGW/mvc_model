<?php
use lib\Routes;
use Controllers\Site;

$route = new Routes();

$route->prefix("teste")->group(function ($e) {
    $e->get("maicon", [Site::class, "index2"]);
    $e->get("maicon2", "");
});

$route->get("", [Site::class, "index"], true);
$route->post("teste2", "index", true);
$route->get("teste3", "index", true);

$route->prefix("ty")->group(function ($e) {
    $e->get("val", "");
    $e->get("val2", "");
});

$route->exit();

// Route::post();
// Route::all(); 