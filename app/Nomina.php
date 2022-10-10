<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    //
    protected $table = 'nomina';

    public function personals (){
        return $this->hasOne(Personal::class, 'id', 'personals_id');
    }
}
