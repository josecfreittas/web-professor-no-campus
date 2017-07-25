<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class Professor extends Model {

    protected $table = "professores";
    public $timestamps = false;

    public function votos() {
        return $this->hasMany("App\Models\Voto");
    }
}
