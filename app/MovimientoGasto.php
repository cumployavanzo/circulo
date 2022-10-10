<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoGasto extends Model
{
    //
    protected $table = 'movimientos_compras';

    public function compra (){
        return $this->hasOne(Gasto::class, 'id', 'compras_id');
    }
    
    public function cuentas (){
        return $this->hasOne(Cuenta::class, 'id', 'cuentas_id');
    }
}
