<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    //
    protected $table = 'asignacion';

    public function movimientos (){
        return $this->hasOne(MovimientoAsignacion::class, 'asignacion_id', 'id')->where('estatus','1');
    }

    public function detalle_compra (){
        return $this->hasOne(DetalleGasto::class, 'id', 'detalles_compras_id');
    }

    public function tipoVehiculo (){
        return $this->hasOne(TipoVehiculo::class, 'id', 'tipos_vehiculos_id');
    }

    public function propietario (){
        return $this->hasOne(Personal::class, 'id', 'personals_id_propietario');
    }
   
}
