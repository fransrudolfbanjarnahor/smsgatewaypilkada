<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelurahanDesa extends Model
{
    protected $table = 'kelurahandesa';
    //
    public function kecamatan()
    {
        return $this->belongsTo('App\Kecamatan');
    }

    public function lokasitps()
    {
        return $this->hasMany('App\LokasiTPS');
    }
}
