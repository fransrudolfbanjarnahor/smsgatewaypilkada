<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LokasiTPS extends Model
{
    protected $table = 'lokasitps';
    //
    public function kelurahandesa()
    {
        return $this->belongsTo('App\KelurahanDesa');
    } 
    
    public function user()
    {
        return $this->belongsTo('App\User');
    } 
    
    public function petugastps()
    {
        return $this->hasOne('App\PetugasTPS', 'lokasitps_id');
    }
}
