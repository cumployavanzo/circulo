<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analisis_credito extends Model
{
    protected $table = 'analisis_credito';

    public function solicitud (){
        return $this->hasOne(Solicitud::class, 'id', 'solicituds_id');
    }

    // public function detalleDesembolso (){
    //     return $this->hasOne(DetalleDesembolso::class, 'analisis_credito_id', 'id');
    // }

    public function detalleDesembolso (){
        return $this->hasOne(MovimientoGasto::class, 'analisis_credito_id', 'id');
    }
    
    public function scopeName ($query, $name){
        if($name)
        return $query->orWhereRaw("CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) LIKE '%$name%' ");
    }
}
