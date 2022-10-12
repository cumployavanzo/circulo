<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vencimiento extends Model
{
    //
    protected $table = 'tabla_amortizacion';

    public function analisisC (){
        return $this->hasOne(Analisis_credito::class, 'id', 'analisis_credito_id');
    }
}
