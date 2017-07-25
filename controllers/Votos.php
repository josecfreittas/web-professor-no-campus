<?php
namespace App\Controllers;

use App\Models\Voto;

class Votos {
    public function index ($tempo, $facebook, $id) {

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

        $resultado = [
            "positivos" => $positivos,
            "negativos" => $negativos,
            "voto" => $voto
        ];

        echo json_encode($resultado);
    }

}
