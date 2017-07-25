<?php
namespace App\Controllers;

use App\Models\Professor;

class Professores {
    public function index () {
        $professores = Professor::all();

        echo json_encode($professores);
    }
}
