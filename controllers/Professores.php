<?php
namespace App\Controllers;

use App\Models\Professor;
use App\Models\Voto;

class Professores {

    public function index ($facebook, $tempo) {

        $professores = Professor::all();

        foreach ($professores as $professor) {
            $professor->votos = $this->votos($facebook, $tempo, $professor->id);
        }

        echo json_encode($professores);
    }


    private function votos ($facebook, $tempo, $id) {

        // pega o intervalo de tempo requisitado
        $tempo = \Carbon\Carbon::now()->subHours($tempo);

        // conta votos positivos
        $positivos = Voto::where("professor_id", $id)
            ->where('data', '>=', $tempo)
            ->where("valor", "positivo")
            ->count();

        // conta votos negativos
        $negativos = Voto::where("professor_id", $id)
            ->where('data', '>=', $tempo)
            ->where("valor", "negativo")
            ->count();

        // verificar se já existe um voto dado ao mesmo professor na ultima hora
        $ultima_hora = Voto::where("professor_id", $id)
            ->where('data', '>=', \Carbon\Carbon::now()->subHours(1))
            ->where("facebook_id", $facebook)
            ->get();

        if (!$ultima_hora->isEmpty()) {
            $voto = $ultima_hora[0]->valor;
        } else {
            $voto = null;
        }

        // calcula a porcetagem de confirmações
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
