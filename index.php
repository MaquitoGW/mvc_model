<?php
// index.php

// Inclui o autoloader do Composer
require 'vendor/autoload.php';

// Agora você pode usar suas classes com seus namespaces
use lib\db\sql;
// use lib\config;

echo json_encode(
    sql::SELECT("products")
    ->where("id")
    ->OrderBy("id","ASC")
    ->all()
);
