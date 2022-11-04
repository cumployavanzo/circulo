<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleBono extends Model
{
    //
    protected $table = 'detalles_bonos';

    public function ruta (){
        return $this->hasOne(SucursalRuta::class, 'id', 'sucursales_id');
    }


}
