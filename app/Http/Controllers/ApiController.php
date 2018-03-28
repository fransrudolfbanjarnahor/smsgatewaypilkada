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
use App\PetugasTPS;
use App\KelurahanDesa;
use App\PesertaPemilihan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;   
class ApiController extends Controller
{
    public function smsdata(Request $request) {
        $data = SmsData::where('nomorhp',$request->input('nomorhp'))->where('username',$request->user()->email)->where('tps',$request->input('tps'))->first();
        if ($data == null) {
            $data = new SmsData();
            $data->nomorhp = $request->input('nomorhp');
            $data->pesan = $request->input('pesan');
            $data->statuspesan = $request->input('statuspesan');
            $data->state = $request->input('state');
            $data->tps = $request->input('tps');
            $data->nourut = $request->input('nourut');
            $data->jumlah = $request->input('jumlah');
            $data->username = $request->user()->email;
            $data->save();
        } else {
            $data->jumlah = $request->input('jumlah');
            $data->update();
        }
        $response = ["status" => "OK"];
        return response()->json($response, 200);
        
    }
    
    public function petugas(Request $request) {
       
        $petugas = PetugasTPS::where('nomorhp',$request->input('nomorhp'))->where('lokasitps_id',$request->input('tps_id'))->first();
      
        if ($petugas == null) {
            $petugas = new PetugasTPS();
            $petugas->nomorhp = $request->input('nomorhp');
            $petugas->nama = $request->input('petugas');
            $petugas->lokasitps_id = $request->input('tps_id');
           
            $petugas->save();
           
        }else {
            $petugas->nomorhp = $request->input('nomorhp');
            $petugas->nama = $request->input('petugas');
            $petugas->lokasitps_id = $request->input('tps_id');
            $petugas->update();
        }

        $response = ["status" => "OK"];
        return response()->json($response, 200);
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
        
        $data = ['propinsi' => $propinsi, 'kabkota'=>$kabkota,'kecamatan'=>($kecamatan==null?'':$kecamatan),'keldesa'=>($kelurahan==null?'':$kelurahan)];
        return response()->json($data, 200);
    }

    public function test() {

       return "ok " ;
    }

    public function getTPS(Request $request) {
        //$tps = PetugasTPS::with('lokasi')->where('user_id',$request->user()->id)->get();
        $userid = $request->user()->id;
        // $tps = PetugasTPS::whereHas('lokasitps', function($q) use ($userid) {
        //     $q->where('user_id', $userid);
        // })->get();
        $tps = DB::table('lokasitps')
            ->leftJoin('petugastps', 'lokasitps.id', '=', 'petugastps.lokasitps_id')
            ->where('user_id', $userid)
            ->select('lokasitps.*','petugastps.nama as petugas','petugastps.nomorhp')
            ->get();
       // dd($tps[0]);
        $data = [];
        foreach($tps as $t) {
            $data[] = ['kode' => $t->kode,'nama' => $t->nama,'lokasi' => $t->lokasi,
            'petugas'=>$t->petugas,'nomorhppetugas'=>$t->nomorhp];
        }
        return response()->json($data, 200);
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
