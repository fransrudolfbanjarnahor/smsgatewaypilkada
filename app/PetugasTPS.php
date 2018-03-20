<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetugasTPS extends Model
{
    protected $table = 'petugastps';

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function lokasitps()
    {
        return $this->belongsTo('App\LokasiTPS');
    }
}
