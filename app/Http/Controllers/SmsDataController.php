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
    public function index(Request $request)
    {
        //dd($request->input('filtersms'));
        if ($request->input('filtersms') == 0 || $request->input('filtersms') == null) {
            $data = SmsData::where('username',auth()->user()->email)->get();
        } else {
            $state = ($request->input('filtersms') ==1?true:false);
            $data = SmsData::where('username',auth()->user()->email)->where('state',$state)->get();
        }
        return view("smsdata.index")->with('data',$data); 
    }
}
