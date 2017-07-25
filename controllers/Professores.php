<?php
namespace App\Controllers;

use App\Models\Professor;

class Professores {
    public function index () {
        $professores = Professor::all();

        header('Content-Type: application/json');
        echo json_encode($professores);
    }
}
