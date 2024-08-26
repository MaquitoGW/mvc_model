<?php
require 'vendor/autoload.php';
// index.php

// Inclui o autoloader do Composer



// use routes;
require 'routes/web.php';



// Agora você pode usar suas classes com seus namespaces
// use lib\db\sql;
// use lib\config;

// echo json_encode(
//     sql::SELECT("products")
//         ->where("id")
//         ->OrderBy("id", "ASC")
//         ->all()
// );

// echo json_encode(
//     sql::INSERT("banners")->add($_POST)
// );

?>

<!-- <form action="#" method="post">
    <input type="text" name="title" placeholder="title"><br>
    <input type="text" name="description" placeholder="description"><br>
    <input type="text" name="link" placeholder="link"><br>
    <br><button type="submit">Enviar</button>
</form> -->
