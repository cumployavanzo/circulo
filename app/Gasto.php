<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    //
    protected $table = 'compras';

    public function movimiento (){
        return $this->belongsTo(MovimientoGasto::class, 'id', 'compras_id');
    }

    public function proveedor (){
        return $this->hasOne(Proveedor::class, 'id', 'proveedores_id');
    }

    public function personals (){
        return $this->hasOne(Personal::class, 'id', 'personals_id');
    }

    public function usuario (){
        return $this->hasOne(User::class, 'id', 'users_id');
    }
}