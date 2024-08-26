<?php
// namespace routes;

use lib\Routes;

Routes::group('t',
    function () {
        Routes::get('teste', 'eu');
    }
);
Routes::get('teste', 'eu');

// Route::post();
// Route::all();