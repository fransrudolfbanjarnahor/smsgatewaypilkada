<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LokasiTPS;
use Illuminate\Support\Facades\Auth;
use Excel;
use App\Propinsi;
use App\KabupatenKota;
use App\Kecamatan;
use App\KelurahanDesa;
use App\ConfigApp;
use App\PetugasTPS;
class LokasiTPSController extends Controller
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
    
    public function index(Request $request)
    {

        $config = ConfigApp::where('user_id',Auth::user()->id)->first();
        $kecamatan = 0;
        $kelurahandesa = 0;
        $kabupatenkota = 0;

        if ($request->input('kelurahandesa') == 0 && $request->input('kecamatan') == 0 && $request->input('kabupatenkota') > 0) {
            $fkabkota = $request->input('kabupatenkota');
            $lokasitps = LokasiTPS::whereHas('kelurahandesa.kecamatan.kabupatenkota', function($q) use ($fkabkota) {
                $q->where('id', $fkabkota);
            })->get();
          //  echo "kabkota";
        } else if ($request->input('kelurahandesa') == 0 && $request->input('kecamatan') > 0 && $request->input('kabupatenkota') > 0) {
            // dd($fkec);
           $fkec = $request->input('kecamatan');
           $lokasitps = LokasiTPS::whereHas('kelurahandesa.kecamatan', function($q) use ($fkec) {
            $q->where('id', $fkec);
            })->get();
         //   echo "kecamatan";
        } else if ($request->input('kelurahandesa') > 0 && $request->input('kecamatan') > 0 && $request->input('kabupatenkota') > 0) {
            $fkeldes = $request->input('kelurahandesa');
            $lokasitps = LokasiTPS::whereHas('kelurahandesa', function($q) use ($fkeldes) {
                $q->where('id', $fkeldes);
            })->get();
           // echo "kelurahandesa";
        } else if ($request->input('kelurahandesa') == 0 && $request->input('kecamatan') == 0 && $request->input('kabupatenkota') == 0) {
            $fprop = $config->propinsi;
            $lokasitps = LokasiTPS::whereHas('kelurahandesa.kecamatan.kabupatenkota.propinsi', function($q) use ($fprop) {
                $q->where('id', $fprop);
            })->where('user_id',Auth::user()->id) ->get();
           // echo "propinsi";
        }   
        
       $kabkota = null;$propinsi = null;$kecamatan=null;$kelurahan=null;
        if ($config->kelurahandesa > 0 && $config->kecamatan > 0 &&  $config->kabupatenkota > 0) {
            $propinsi = Propinsi::find($config->propinsi);
            $kabkota = KabupatenKota::find($config->kabupatenkota);
            $kecamatan = Kecamatan::find($config->kecamatan);
            $kelurahan = KelurahanDesa::find($config->kelurahan);
        }

        if ( ($config->kelurahandesa ==  0 || $config->kelurahandesa == null) && $config->kecamatan > 0 &&  $config->kabupatenkota > 0) {
            // Level Kecamataan
            $propinsi = Propinsi::find($config->propinsi);
            $kabkota = KabupatenKota::find($config->kabupatenkota);
            $kecamatan = Kecamatan::find($config->kecamatan);
        }

        if ( ($config->kelurahandesa ==  0 || $config->kelurahandesa == null) && ($config->kecamatan > 0 || $config->kecamatan == null)  &&  $config->kabupatenkota > 0) {
            // Level Kabupaten Kota
            $propinsi = Propinsi::find($config->propinsi);
            $kabkota = KabupatenKota::find($config->kabupatenkota);
        }


        if ( ($config->kelurahandesa ==  0 || $config->kelurahandesa == null) && ($config->kecamatan > 0 || $config->kecamatan == null)  &&  ($config->kabupatenkota > 0 || $config->kabupatenkota == null)) {
            // Level Propinsi
            $propinsi = Propinsi::find($config->propinsi);
        }
       
        $message = "success";

        $data = ['lokasitps' => $lokasitps,'config' => $config,'propinsi' => $propinsi, 'kabkota'=>$kabkota,'kecamatan'=>$kecamatan,'keldesa'=>$kelurahan];
       
        return view("lokasitps.index",['message'=>$message])->with($data); 
    }

    public function filter(Request $request)
    {
        $kabkota = $request->input('kabupatenkota');
        $kec = $request->input('kecamatan');
        $keldesa = $request->input('kelurahandesa');
        $data = ['kecamatan'=>$kec, 'kabupatenkota'=>$kabkota,'kelurahandesa'=>$keldesa];
        return redirect()->action('LokasiTPSController@index',$data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = ConfigApp::where('user_id',Auth::user()->id)->first();
        $propinsi = null;$kabkota=null;$kecamatan=null; $kelurahan=null;
        if ($config->kelurahandesa > 0 && $config->kecamatan > 0 &&  $config->kabupatenkota > 0) {
            $propinsi = Propinsi::find($config->propinsi);
            $kabkota = KabupatenKota::find($config->kabupatenkota);
            $kecamatan = Kecamatan::find($config->kecamatan);
            $kelurahan = KelurahanDesa::find($config->kelurahan);
        }

        if ( ($config->kelurahandesa ==  0 || $config->kelurahandesa == null) && $config->kecamatan > 0 &&  $config->kabupatenkota > 0) {
            // Level Kecamataan
            $propinsi = Propinsi::find($config->propinsi);
            $kabkota = KabupatenKota::find($config->kabupatenkota);
            $kecamatan = Kecamatan::find($config->kecamatan);
        }

        if ( ($config->kelurahandesa ==  0 || $config->kelurahandesa == null) && ($config->kecamatan > 0 || $config->kecamatan == null)  &&  $config->kabupatenkota > 0) {
            // Level Kabupaten Kota
            $propinsi = Propinsi::find($config->propinsi);
            $kabkota = KabupatenKota::find($config->kabupatenkota);
        }


        if ( ($config->kelurahandesa ==  0 || $config->kelurahandesa == null) && ($config->kecamatan > 0 || $config->kecamatan == null)  &&  ($config->kabupatenkota > 0 || $config->kabupatenkota == null)) {
            // Level Propinsi
            $propinsi = Propinsi::find($config->propinsi);
        }

        $data = ['config' => $config,'propinsi' => $propinsi, 'kabkota'=>$kabkota,'kecamatan'=>$kecamatan,'keldesa'=>$kelurahan];
       
        return view("lokasitps.create")->with($data); 
    }

    public function setPetugas(Request $request)
    {
       
        $lokasitps = LokasiTPS::find($request->input('lokasitps'));
       
        if ($lokasitps->petugastps == null) {
           // dd($lokasitps->petugastps);
            $e = new PetugasTPS();
            $e->nama = $request->input('nama');
            $e->nomorhp = $request->input('nomorhp');
            $e->lokasitps_id = $request->input('lokasitps');
            $e->save(); 
           
        }else {
            $e = $lokasitps->petugastps;
            $e->nama = $request->input('nama');
            $e->nomorhp = $request->input('nomorhp');
            $e->lokasitps_id = $request->input('lokasitps');
            $e->update(); 
            echo "update";
        }
        $message = "success";
      return redirect()->action('LokasiTPSController@index',['message'=>$message]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     


        $message = "store ";
        if ($request->hasFile('tps')) {
            $filenameext =  $request->file('tps')->getClientOriginalName();
            //$filename =  pathinfo($filenameext, PATHINFO_FILENAME);
            $path =  $request->file('tps')->storeAs("public/tps",$filenameext);
            $filepath = "storage/tps/" . $filenameext;
           
            Excel::load($filepath, function($reader) {
                $results = $reader->get();
                //  echo json_encode($reader->toArray());
               //echo $results->getTitle();
               $ctr = 0;
               foreach ($results as $row) {
                    $tps = LokasiTPS::where('kode', $row->kode_tps)->first();
                    if ($tps == null) {
                        $tps = new LokasiTPS();
                        $tps->kode = $row->kode_tps;
                        $tps->nama = $row->nama_tps;
                        $tps->lokasi = $row->lokasi_tps;
                        $tps->kelurahandesa_id = $row->idkeldesa;
                        $tps->user_id = auth()->user()->id;
                        $tps->save();
                        
                        $ctr++;
                     //   echo "save ";
                    }
               }
               $message = $ctr . " Record ditambahkan";
            });
        }
       return redirect()->action('LokasiTPSController@index',['message'=>$message]);
    }
    
    public function export(Request $request)
    {

        $this->validate($request,[
            'kelurahandesa' => 'required|integer|min:1|digits_between: 1,6',
        ]);
        //    dd($request->input('kelurahandesa'));
        // $keldes = KelurahanDesa::find($request->input('kelurahandesa'))  ;

        // $kec = $keldes->kecamatan->nama;
        // $kabkota = $keldes->kecamatan->kabupatenkota->nama;
        // $propinsi = $keldes->kecamatan->kabupatenkota->propinsi->nama;
        // $export = []; 
        // for ($i=1;$i<11;$i++) {
        //     $data = array('KODE TPS' => '','NAMA TPS' => '','LOKASI TPS' => '','IDKELDESA'=>$keldes->id,'KELURAHAN/DESA'=>$keldes->nama,
        //               'KECAMATAN'=>$kec,'KABUPATEN/KOTA'=>$kabkota,'PROPINSI'=>$propinsi);
        //     $export[] = $data;
        // }

        // $data =  json_encode($export);
        // return Excel::create($keldes->kode . '-' . $keldes->nama, function($excel) use ($export) {
        //     $excel->setTitle('Lokasi TPS');
        //     $excel->setCreator(Auth::user()->name)
        //           ->setCompany('SMS GATEWAY PILKADA');
     
        //     $excel->setDescription('Template File untuk upload lokasi TPS');
        //     $excel->sheet('LokasiTPS', function($sheet) use ($export)
	    //     {
		// 		$sheet->fromArray($export);
	    //     });
        
        // })->download('xlsx');
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
