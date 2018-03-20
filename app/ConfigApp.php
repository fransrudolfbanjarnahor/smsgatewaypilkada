<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigApp extends Model
{
    protected $table = 'configapps';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
