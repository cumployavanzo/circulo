<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoNomina extends Model
{
    //
    protected $table = 'movimiento_nomina';

    public function concepto (){
        return $this->hasOne(ConceptoNomina::class, 'id', 'conceptos_nomina_id');
    }
}
