<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialBaja extends Model
{
    //
    protected $table = 'historial_baja';

    public function usuario (){
        return $this->hasOne(User::class, 'id', 'users_id');
    }
}
