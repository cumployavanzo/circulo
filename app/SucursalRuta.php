<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SucursalRuta extends Model
{
    //
    protected $table = 'sucursales';

    public function scopeName ($query, $name){
        if($name)
        return $query->where('nombre_ruta','LIKE', "%$name%");
    }
}
