<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kecamatan;
use App\KabupatenKota;
use App\LokasiTPS;
class TestController extends Controller
{
    public function hasmanythrough() {
        $e = Kecamatan::find(697);
        foreach ($e->lokasitps as $a) {
            echo $a->nama . ' - ' .$a->kelurahandesa->nama . '<br />';
        }
     }

     public function hasmanythrough2() {
        $e = KabupatenKota::find(54);
        foreach ($e->lokasitps as $a) {
            echo $a->nama . '<br />';
        }
     }

     public function wherehas() {
        $e = LokasiTPS::whereHas('kelurahandesa.kecamatan.kabupatenkota', function($q){
            $q->where('id', 54);
        })->get();
        foreach ($e as $a) {
            echo $a->nama . ' ' .$a->kelurahandesa->kecamatan->kabupatenkota->propinsi->nama .  '<br />';
        }
     }
}
