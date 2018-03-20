<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function lokasitps() {
        return $this->hasMany('App\LokasiTPS');
    }


    public function petugastps() {
        return $this->hasMany('App\PetugasTPS');
    }

    public function config()
    {
        return $this->hasOne('App\ConfigApp');
    }
}
