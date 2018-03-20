<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KabupatenKota extends Model
{
    protected $table = 'kabupatenkota';
    //

    public function propinsi()
    {
        return $this->belongsTo('App\Propinsi');
    }

    public function kecamatan()
    {
        return $this->hasMany('App\Kecamatan');
    }


    public function lokasitps()
    {
        return $this->hasManyThrough(KelurahanDesa::class,Kecamatan::class,'kabupatenkota_id','kecamatan_id');
    }
}
