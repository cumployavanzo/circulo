<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospecto extends Model
{
    //
    protected $table = 'prospectos';

    public function getFullName (){
        return "{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}";
    }

    public function scopeName ($query, $name){
        if($name)
        return $query->orWhereRaw("CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) LIKE '%$name%' ");
    }

    public function usuario (){
        return $this->hasOne(User::class, 'id', 'users_id');
    }
    
    public function usuario (){
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    public function ruta (){
        return $this->hasOne(SucursalRuta::class, 'id', 'sucursales_id');
    }

    public function estadoNac (){
        return $this->hasOne(EstadoNacimiento::class, 'clave', 'clave_estado_nacimiento');
    }
}
