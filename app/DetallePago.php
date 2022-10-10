<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePago extends Model
{
    //
    protected $table = 'detalles_pagos';

    public function cuentas (){
        return $this->hasOne(Cuenta::class, 'id', 'cuentas_id');
    }
}
