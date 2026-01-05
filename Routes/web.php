<?php

use lib\Routes;
use Controllers\Site;
use Controllers\HelpController;

$route = new Routes();

// WELCOME
$route->get("", [Site::class, "welcome"], true);
$route->get("test", [Site::class, "test"], true);

// HELP CENTER
$route->get("help", [HelpController::class, "index"], true);
$route->get("help/documentation", [HelpController::class, "documentation"], true);
$route->get("help/debug", [HelpController::class, "debug"], true);
$route->get("help/cache", [HelpController::class, "cache"], true);
$route->get("help/cron", [HelpController::class, "cron"], true);
$route->get("help/email", [HelpController::class, "email"], true);
$route->get("help/configuration", [HelpController::class, "configuration"], true);

$route->exit();