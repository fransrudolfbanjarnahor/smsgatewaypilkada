<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Propinsi;
use App\KabupatenKota;
use App\Kecamatan;
use App\KelurahanDesa;
use App\ConfigApp;
use App\LokasiTPS;

class ReferensiController extends Controller
{

    public function __construct()
    {
      //  $this->middleware('auth');
    }
    
    public function getPropinsi() {
        return response()->json(Propinsi::all());
    }


    public function getKabupatenKota($id) {
        return response()->json(KabupatenKota::where('propinsi_id', $id)->get());
    }

    public function test() {
       $p = KabupatenKota::find(1);
       echo $p->propinsi; 
    }

    public function getKecamatan($id) {
        return response()->json(Kecamatan::where('kabupatenkota_id', $id)->get());
    }

    public function getKelurahanDesa($id) {
        return response()->json(KelurahanDesa::where('kecamatan_id', $id)->get());
    }
}
