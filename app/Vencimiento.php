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

    public function scopeName ($query, $name){
        if($name)
        return $query->orWhereRaw("CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) LIKE '%$name%' ");
    }
}
