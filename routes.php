<?php

use App\Controllers;


// map homepage
$router->map('GET', '/professores/?', function() {
    $page = new Controllers\Professores;
    $page->index();
});
$router->map('GET', '/votos/[i:tempo]-horas?/[i:facebook]/[i:id]/?', function($tempo, $facebook, $id) {
    $page = new Controllers\Votos;
    $page->index($tempo, $facebook, $id);
});
