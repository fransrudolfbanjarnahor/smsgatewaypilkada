<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HasilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $smsdata = DB::table('smsdata')
        ->join('users', 'users.email', '=', 'smsdata.username')
        ->groupBy('smsdata.username','smsdata.nourut')
        ->select('smsdata.username','smsdata.nourut', DB::raw('SUM(smsdata.jumlah) as total'))
        ->get();
        dd($smsdata);
        return view("hasil.index"); 
    }
}
