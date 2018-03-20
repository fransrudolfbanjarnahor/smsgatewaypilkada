<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';
    //
    public function kabupatenkota()
    {
        return $this->belongsTo('App\KabupatenKota');
    }


    public function kelurahandesa()
    {
        return $this->hasMany('App\KelurahanDesa');
    }

    public function lokasitps()
    {
        return $this->hasManyThrough('App\LokasiTPS','App\KelurahanDesa','kecamatan_id','kelurahandesa_id');
    }
}
