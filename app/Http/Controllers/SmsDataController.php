<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmsData;
class SmsDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = SmsData::where('username',auth()->user()->email)->get();
        return view("smsdata.index")->with('data',$data); 
    }
}
