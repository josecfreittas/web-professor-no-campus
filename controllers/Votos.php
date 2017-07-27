<?php
namespace App\Controllers;

use App\Models\Voto;

class Votos {

    public function adicionar ($facebook, $professor, $voto) {

        try {

            $this->remover($facebook, $professor, false);

            // checa se é um voto válido
            if ($voto == "positivo" || $voto == "negativo") {
                Voto::insert([
                    "valor" => $voto,
                    "facebook_id" => $facebook,
                    "professor_id" => $professor
                    ]);
            }

            $resultado = "success";

        } catch(\Illuminate\Database\QueryException $e) {
            http_response_code(500);
            $resultado = "failure";
        }

        echo json_encode(["result" => $resultado]);
    }

    public function remover ($facebook, $professor, $retorno = true) {


        try {

            // caso exista, deleta último voto feito dentro da ultima hora
            // pela mesma pessoa e para o mesmo professor
            Voto::where("professor_id", $professor)
                ->where('data', '>=', \Carbon\Carbon::now()->subHours(1))
                ->where("facebook_id", $facebook)
                ->delete();

            $resultado = "success";

        } catch(\Illuminate\Database\QueryException $e) {
            http_response_code(500);
            $resultado = "failure";
        }

        if ($retorno) {
            echo json_encode(["result" => $resultado]);
        }
    }
}
