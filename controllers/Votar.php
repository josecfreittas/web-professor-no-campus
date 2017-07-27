<?php
namespace App\Controllers;

use App\Models\Voto;

class Votar {

    public function index ($id, $voto, $facebook) {

        Voto::where("professor_id", $id)
            ->where('data', '>=', \Carbon\Carbon::now()->subHours(1))
            ->where("facebook_id", $facebook)
            ->delete();

        if ($voto != "null") {
            Voto::insert([
                "valor" => $voto,
                "facebook_id" => $facebook,
                "professor_id" => $id
                ]);
        }

    }

}