<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bono extends Model
{
    //
    protected $table = 'bonos';

    public function personals (){
        return $this->hasOne(Personal::class, 'id', 'personals_id');
    }
}
