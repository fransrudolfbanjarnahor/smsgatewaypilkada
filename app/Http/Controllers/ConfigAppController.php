<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ConfigApp;
class ConfigAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       // $data = ['propinsi' => Propinsi::all()];
        //$data = "frans";
       // $propinsi =  Propinsi::all();
       $config = ConfigApp::where('user_id',Auth::user()->id)->first();
    //    dd($config);
       return view("configapp.index")->with('config',$config); 
        //->with('data',$data);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $config = ConfigApp::where('user_id',Auth::user()->id)->first();
        if ($config == null) {
            $config = new ConfigApp();
            $config->propinsi = $request->input('propinsi');
            $config->kabupatenkota = $request->input('kabupatenkota');
            $config->kecamatan = $request->input('kecamatan');
            $config->kelurahandesa = $request->input('kelurahandesa');
            $config->user_id = Auth::user()->id;
            $config->save();
        } else {
            $config->propinsi = $request->input('propinsi');
            $config->kabupatenkota = $request->input('kabupatenkota');
            $config->kecamatan = $request->input('kecamatan');
            $config->kelurahandesa = $request->input('kelurahandesa');
            $config->user_id = Auth::user()->id;
            $config->update();
        }
        return redirect()->action('ConfigAppController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
