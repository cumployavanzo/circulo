<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleGasto extends Model
{
    //
    protected $table = 'detalles_compras';

    public function articulo (){
        return $this->hasOne(Articulo::class, 'id', 'articulos_id');
    }
}
