@extends('layouts.app')

@section('content')
<div class="container">
   
   {!! Form::open(['action' => 'PesertaPemilihanController@store','files'=>'true']) !!}
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <input type="hidden" name="id" value="{{$data->id}}">
   
   <div class="form-group">
       
      <div class="row">
          <div class="col">
              <label>Nomor Urut </label>
          </div>
          <div class="col">
              <label>Inisial Pasangan Calon </label>
          </div>
      </div>   
      <div class="row">
          <div class="col">
            <input type="text" class="form-control" id="nourut"  name="nourut" value="{{$data->nourut}}">
          </div>
          <div class="col">
          <input type="text" class="form-control" id="inisialpaslon"  name="inisialpaslon" value="{{$data->inisialpaslon}}">
          </div>
      </div>    
  </div>
  <div class="form-group">
    <label>Nama Peserta Pemilihan (Calon)</label>
    <input type="text" class="form-control" id="namacalon"  name="namacalon" value="{{$data->namacalon}}"> 
  </div>
  
  <div class="form-group">
    <label>Inisial (Calon)</label>
    <input type="text" class="form-control" id="inisialcalon"  name="inisialcalon" name="namacalon" value="{{$data->inisialcalon}}">
  </div>

  <div class="form-group">
      <label>Photo (Calon)</label>
      <input type="file" class="form-control" id="photocalon"  name="photocalon">
  </div>
  
  <div class="form-group">
      <label>Nama Wail Peserta Pemilihan (Wakil Calon)</label>
      <input type="text" class="form-control" id="namawakilcalon"  name="namawakilcalon" value="{{$data->namawakilcalon}}">
    </div>
    
    <div class="form-group">
      <label>Inisial Wakil (Calon)</label>
      <input type="text" class="form-control" id="inisialwakilcalon"  name="inisialwakilcalon" value="{{$data->inisialwakilcalon}}">
    </div>
  
    <div class="form-group">
        <label>Photo Wakil (Calon)</label>
        <input type="file" class="form-control" id="photowakilcalon"  name="photowakilcalon" >
    </div>
    

  {!! Form::submit('Simpan');!!}
  {!! Form::close() !!}
 
</div>
@endsection


@section('script')
@endsection