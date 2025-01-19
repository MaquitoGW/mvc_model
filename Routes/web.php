<?php

use lib\Routes;
use Controllers\Site;

$route = new Routes();

// WELCOME
$route->get("", [Site::class, "welcome"], true);

$route->exit();