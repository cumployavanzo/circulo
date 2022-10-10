<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    //
    protected $table = 'puestos';
    protected $fillable = ['id', 'puesto', 'area', 'sueldo_inicial','sueldo_inicial','sueldo_final','comisiones'];

    public function areas (){
        return $this->hasOne(Area::class, 'id', 'areas_id');
    }
}
