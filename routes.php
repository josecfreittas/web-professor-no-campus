<?php
use App\Controllers;

$router->map('GET', '/lista/[i:tempo]-horas?/[i:facebook]/?', function($tempo, $facebook) {
    $page = new Controllers\Lista;
    $page->index($tempo, $facebook);
});
