<?php
use App\Controllers;

$router->map("GET", '/[i:facebook]/professores/all/intervalo/[i:tempo]/?', function($facebook, $tempo) {
    $page = new Controllers\Professores;
    $page->index($facebook, $tempo);
});

$router->map("POST", '/[i:facebook]/votos/[i:professor]/[a:voto]/?', function($facebook, $professor, $voto) {
    $page = new Controllers\Votos;
    $page->adicionar($facebook, $professor, $voto);
});

$router->map("DELETE", '/[i:facebook]/votos/[i:professor]/?', function($facebook, $professor) {
    $page = new Controllers\Votos;
    $page->remover($facebook, $professor);
});

