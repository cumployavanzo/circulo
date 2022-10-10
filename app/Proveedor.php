<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
     
    public function scopeNameProveedor($query, $name){
        if($name)
        return $query->where('nombre_proveedor','LIKE', "%$name%");
    }

    public function cuentas (){
        return $this->hasOne(Cuenta::class, 'id', 'cuentas_id');
    }
}
