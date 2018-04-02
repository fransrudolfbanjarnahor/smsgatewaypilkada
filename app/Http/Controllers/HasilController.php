<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PesertaPemilihan;
class HasilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getHasil()
    {
        $smsdata = DB::table('smsdata')
        ->join('users', 'users.email', '=', 'smsdata.username')
        ->groupBy('smsdata.username','smsdata.nourut')
        ->select('smsdata.nourut', DB::raw('SUM(smsdata.jumlah) as total'))->where('nourut', '>' ,0)
        ->get();
       
        return response()->json($smsdata);
    }

    public function index()
    {
        $data = PesertaPemilihan::where('user_id',auth()->user()->id)->get();
        return view("hasil.index")->with('data',$data); 
    }
}
