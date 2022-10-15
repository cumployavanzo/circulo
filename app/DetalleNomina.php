<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleNomina extends Model
{
    //
    protected $table = 'detalle_nomina';

    public function concepto (){
        return $this->hasOne(ConceptoNomina::class, 'id', 'conceptos_nomina_id');
    }
    
    public function personals (){
        return $this->hasOne(Personal::class, 'id', 'personals_id');
    }
    public function nomina (){
        return $this->hasOne(Nomina::class, 'id', 'nomina_id');
    }
}
