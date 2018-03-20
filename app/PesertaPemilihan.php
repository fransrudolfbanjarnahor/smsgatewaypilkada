<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesertaPemilihan extends Model
{
    protected $table = 'pesertapemilihan';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

