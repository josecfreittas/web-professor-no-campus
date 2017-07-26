<?php
namespace App\Controllers;

use App\Models\Professor;
use App\Models\Voto;

class Lista {
    public function index ($tempo, $facebook) {

        $professores = Professor::all();

        foreach ($professores as $professor) {
            $professor->votos = $this->votos($tempo, $facebook,  $professor->id);
        }

        echo json_encode($professores);
    }


    private function votos ($tempo, $facebook, $id) {

        $tempo = \Carbon\Carbon::now()->subHours($tempo);

        $positivos = Voto::where("professor_id", $id)
            ->where('created_at', '>=', $tempo)
            ->where("valor", true)
            ->count();
        $negativos = Voto::where("professor_id", $id)
            ->where('created_at', '>=', $tempo)
            ->where("valor", false)
            ->count();
        $ultima_hora = Voto::where("professor_id", $id)
            ->where('created_at', '>=', \Carbon\Carbon::now()->subHours(1))
            ->where("facebook_id", $facebook)
            ->get();

        if (!$ultima_hora->isEmpty()) {
            if ($ultima_hora[0]->valor) {
                $voto = true;
            } else {
                $voto = false;
            }
        } else {
            $voto = null;
        }

        if (($positivos + $negativos) > 0) {
            $porcentagem = round(( $positivos * 100 ) / ($positivos + $negativos), 2);
        } else {
            $porcentagem = null;
        }

        $resultado = [
            "positivos" => $positivos,
            "negativos" => $negativos,
            "porcentagem" => $porcentagem,
            "voto" => $voto
        ];
        return $resultado;
    }
}
