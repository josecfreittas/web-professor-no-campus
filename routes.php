<?php
use App\Controllers;

$router->map('GET', '/lista/[i:tempo]-horas?/[i:facebook]/?', function($tempo, $facebook) {
    $page = new Controllers\Lista;
    $page->index($tempo, $facebook);
});

$router->map('GET', '/votar/[i:id]/[a:voto]/[i:facebook]/?', function($id, $voto, $facebook) {
    $page = new Controllers\Votar;
    $page->index($id, $voto, $facebook);
});
