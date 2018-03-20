<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propinsi extends Model
{
    protected $table = 'propinsi';
    //

    public function kabupatenkota() {
        return $this->hasMany('App\KabupatenKota');
    }

    
   
}
