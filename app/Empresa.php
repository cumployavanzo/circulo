<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    protected $table = 'empresas';

    public function empleados (){
        return $this->hasOne(Personal::class, 'id', 'personals_id');
    }
}
