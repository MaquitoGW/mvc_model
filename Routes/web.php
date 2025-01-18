<?php

use lib\Routes;
use Controllers\Site;

$route = new Routes();
$route->get("form/{id}", [Site::class, "form"], true);
$route->get("", [Site::class, "index"], true);
$route->get("form", [Site::class, "form"], true);



$route->post("recive", [Site::class, "reciveForm"], true)->name("recive");



$route->exit();

// Route::post();
// Route::all(); 