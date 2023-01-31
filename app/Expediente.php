<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    //
    protected $table = 'expedientes';

    public function getAvatarUrl()
    {
        if ($this->photo_extension)
            return asset('img/users/'.$this->id.'.'.$this->photo_extension);

        return asset('img/users/default.jpg');
    }
}
