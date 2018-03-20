<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmsData;
use App\User;
use App\ConfigApp;
use App\Propinsi;
use App\KabupatenKota;
use App\Kecamatan;
use App\LokasiTPS;
use App\KelurahanDesa;
use App\PesertaPemilihan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
    
class ApiController extends Controller
{
    public function smsdata(Request $request) {
        $data = SmsData::create($request->all());
        return response()->json($data, 200);
        
    }

    public function getConfig(Request $request) {
        $config = ConfigApp::where('user_id',$request->user()->id)->first();
        $propinsi = null;$kabkota=null;$kecamatan=null; $kelurahan=null;
        if ($config->kelurahandesa > 0 && $config->kecamatan > 0 &&  $config->kabupatenkota > 0) {
            $propinsi = Propinsi::find($config->propinsi)->nama;
            $kabkota = KabupatenKota::find($config->kabupatenkota)->nama;
            $kecamatan = Kecamatan::find($config->kecamatan)->nama;
            $kelurahan = KelurahanDesa::find($config->kelurahan)->nama;
        }

        if ( ($config->kelurahandesa ==  0 || $config->kelurahandesa == null) && $config->kecamatan > 0 &&  $config->kabupatenkota > 0) {
            // Level Kecamataan
            $propinsi = Propinsi::find($config->propinsi->nama);
            $kabkota = KabupatenKota::find($config->kabupatenkota)->nama;
            $kecamatan = Kecamatan::find($config->kecamatan)->nama;
        }

        if ( ($config->kelurahandesa ==  0 || $config->kelurahandesa == null) && ($config->kecamatan > 0 || $config->kecamatan == null)  &&  $config->kabupatenkota > 0) {
            // Level Kabupaten Kota
            $propinsi = Propinsi::find($config->propinsi)->nama;
            $kabkota = KabupatenKota::find($config->kabupatenkota)->nama;
        }


        if ( ($config->kelurahandesa ==  0 || $config->kelurahandesa == null) && ($config->kecamatan > 0 || $config->kecamatan == null)  &&  ($config->kabupatenkota > 0 || $config->kabupatenkota == null)) {
            // Level Propinsi
            $propinsi = Propinsi::find($config->propinsi)->nama;
        }
        
        $data = ['propinsi' => $propinsi, 'kabkota'=>$kabkota,'kecamatan'=>$kecamatan,'keldesa'=>$kelurahan];
        return response()->json($data, 200);
    }
    public function test() {

       return "ok " ;
    }

    public function getTPS(Request $request) {
        $tps = LokasiTPS::where('user_id',$request->user()->id)->get();
        return response()->json($tps, 200);
    }
    public function getPeserta(Request $request) {
        $tps = PesertaPemilihan::where('user_id',$request->user()->id)->get();
        return response()->json($tps, 200);
    }
    // public function auth(Request $request) {
    //   //  $usertemp = User::find('email',$request->input('username'));
    //     // $pass = Hash::make($request->input('password'));
    //     // $pair = ['dbpass'=> $usertemp->password, 'check'=>$pass];
    //     // // $user = User::where('username',$request->input('username'))->where('password',$pass);
    //     if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
    //         $resp = "auth";
    //     }else {
    //         $resp = "go to hell";
    //     }
    //     return response()->json($resp , 200);
    // }
}
