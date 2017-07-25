<?php
namespace App\Controllers;

use App\Models\Professor;

class Professores {
    public function index ($tempo, $facebook) {

        $professores = Professor::all();

        foreach ($professores as $professor) {
            $votos = new Votos();
            $professor->votos = $votos->professor($tempo, $facebook,  $professor->id);
        }


        echo json_encode($professores);
    }
}
