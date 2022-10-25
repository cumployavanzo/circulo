<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoAsignacion extends Model
{
    //
    protected $table = 'mov_asignacion';

    public function conductor (){
        return $this->hasOne(Personal::class, 'id', 'personals_id_conductor');
    }

    public function ruta(){
        return $this->hasOne(SucursalRuta::class, 'id', 'sucursales_id');
    }
}
