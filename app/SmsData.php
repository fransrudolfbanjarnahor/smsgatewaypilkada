<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsData extends Model
{
    protected $table = 'smsdata';
    //
    protected $fillable = [
        'nomorhp', 'pesan', 'statuspesan', 'nourut', 'jumlah', 'state'
    ];
}
