<?php

use App\Controllers;


// map homepage
$router->map('GET', '/professores/[i:tempo]-horas?/[i:facebook]/?', function($tempo, $facebook) {
    $page = new Controllers\Professores;
    $page->index($tempo, $facebook);
});
