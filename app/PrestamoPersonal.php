<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrestamoPersonal extends Model
{

    protected $table = 'prestamo_personal';

    public function personals (){
        return $this->hasOne(Personal::class, 'id', 'personals_id');
    }

    public function concepto (){
        return $this->hasOne(ConceptoNomina::class, 'id', 'conceptos_nomina_id');
    }

    public function detallesPrestamo (){
        return $this->hasMany(DetallePrestamo::class, 'prestamo_personal_id', 'id');
    }

    public function scopeName ($query, $name){
        if($name)
        return $query->orWhereRaw("CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) LIKE '%$name%' ");
    }
}
