<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePrestamo extends Model
{
    protected $table = 'detalle_prestamos';

    public function detalleNomina (){
        return $this->hasOne(DetalleNomina::class, 'id', 'detalle_nomina_id');
    }
}
