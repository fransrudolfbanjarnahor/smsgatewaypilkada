<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PesertaPemilihan;
class PesertaPemilihanController extends Controller
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
        $data = PesertaPemilihan::where('user_id',auth()->user()->id)->get();
        return view("pesertapemilihan.index")->with('data',$data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $e = new PesertaPemilihan();
        // $e->inisialpaslon = "";
        // $e->nourut = "";
        // $e->namacalon = "";
        // $e->inisialcalon = "";

        // $e->namawakilcalon = "";
        // $e->inisialwakilcalon = "";

        return view("pesertapemilihan.create")->with('data',$e); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $e = PesertaPemilihan::find($request->input('id'));
        $state = 0;
        if ($e==null) {
            $e = new PesertaPemilihan();
            $state =1;

        }
        $e->inisialpaslon = $request->input('inisialpaslon');
        $e->nourut = $request->input('nourut');
        $e->namacalon = $request->input('namacalon');
        $e->inisialcalon = $request->input('inisialcalon');

        $e->namawakilcalon = $request->input('namawakilcalon');
        $e->inisialwakilcalon = $request->input('inisialwakilcalon');
        $e->user_id = auth()->user()->id;
        echo $e->namacalon;
        
        if ($request->hasFile('photocalon')) {
            $imagedata = file_get_contents($request->file('photocalon'));
            $base64 = base64_encode($imagedata);
            $e->photocalon = $base64;
        }

        if ($request->hasFile('photowakilcalon')) {
            $imagedata = file_get_contents($request->file('photowakilcalon'));
            $base64 = base64_encode($imagedata);
            $e->photowakilcalon = $base64;
        }

        if ($state==1) {
            $e->save();
        }else{
            $e->update();
        }
        return redirect()->action('PesertaPemilihanController@index');
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
        $p = PesertaPemilihan::find($id);
        return view("pesertapemilihan.create")->with('data',$p); 

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
