@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Template Import Lokasi TPS Per wilayah terkecil (Kelurahan/Desa)</h1>
   {!! Form::open(['action' => 'LokasiTPSController@export','files'=>'true']) !!}
  
   <div class="form-group">
    <label>Propinsi</label>
       <h4>{{$propinsi->nama}}</h4>
  </div>

  <div class="form-group">
    <label>Kabupaten / Kota</label>
    @if ($config->kabupatenkota == 0 || $config->kabupatenkota == null)
        <select class="form-control input-sm" name="kabupatenkota" id="kabupatenkota">
        </select>
     @else
     <h4>{{$kabkota->nama}}</h4>
     @endif
  </div>

  <div class="form-group">
    <label>Kecamatan</label>
    @if ($config->kecamatan == 0 || $config->kecamatan == null)
        <select class="form-control input-sm" name="kecamatan" id="kecamatan">
        </select>
    @else
        <h4>{{$kecamatan->nama}}</h4>
    @endif    
  </div>

  <div class="form-group">
    <label>Kelurahan</label>
        <select class="form-control input-sm" name="kelurahandesa" id="kelurahandesa">
        </select>
  </div>

  @if ($errors->has('kelurahandesa'))
  <div class="alert alert-warning" role="alert">
      Template hanya dapat dilakukan sampai level Kelurahan / Desa
  </div>
  @endif
  {!! Form::submit('Buat Template') !!}
  {!! Form::close() !!}
</div>
@endsection


@section('script')
<script type="text/javascript">
      $.get('/ref/propinsi', function(data){
          $('#propinsi').empty();
          $.each(data, function(index, row){
            if (row.id == {{$config->propinsi}}) {
              $('#propinsi').append('<option value="'+row.id+'" selected>'+row.kode + ' - ' + row.nama + '</option>');
            }else{
              $('#propinsi').append('<option value="'+row.id+'">'+row.kode + ' - ' + row.nama + '</option>');
            }
          });        
        }).done(function() {
          onChangePropinsi({{$config->propinsi}});
          $('#propinsi').on('change', function(e){
            var state_id = e.target.value;
            onChangePropinsi(state_id);
          });
        });
      
  function onChangePropinsi(id) {
    console.log("ID " + id);
    $.get('/ref/kabupatenkota/' + id, function(data) {
    $('#kabupatenkota').empty();
    $('#kabupatenkota').append('<option value=0>Semua Kab/Kota</option>');
      $.each(data, function(index,row){
        if (row.id == {{$config->kabupatenkota}}) {
          $('#kabupatenkota').append('<option value="'+row.id+'" selected>'+row.kode + ' - ' + row.nama + '</option>');
        }else {
          $('#kabupatenkota').append('<option value="'+row.id+'">'+row.kode + ' - ' + row.nama + '</option>');
        }
      });
    }).done(function() {
      onChangeKabupatenKota({{$config->kabupatenkota}});
          $('#kabupatenkota').on('change', function(e){
            var state_id = e.target.value;
            onChangeKabupatenKota(state_id);
          });
        });
  }      

  function onChangeKabupatenKota(id) {
    $.get('/ref/kecamatan/' + id, function(data) {
    $('#kecamatan').empty();
    $('#kecamatan').append('<option value=0>Semua Kecamatan</option>');
      $.each(data, function(index,row){
        if (row.id == {{$config->kecamatan}}) {
          $('#kecamatan').append('<option value="'+row.id+'" selected>'+row.kode + ' - ' + row.nama + '</option>');
        }else{
          $('#kecamatan').append('<option value="'+row.id+'">'+row.kode + ' - ' + row.nama + '</option>');
        }
      });
    }).done(function() {
      onChangeKecamatan({{$config->kecamatan}});
          $('#kecamatan').on('change', function(e){
            var state_id = e.target.value;
            onChangeKecamatan(state_id);
          });
        }) ;
  }      

function onChangeKecamatan(id) {
  $('#kelurahandesa').empty();
  $('#kelurahandesa').append('<option value=0>Pilih Kelurahan</option>');
    $.get('/ref/kelurahandesa/' + id, function(data) {
      $.each(data, function(index,row){
        $('#kelurahandesa').append('<option value="'+row.id+'">'+row.kode + ' - ' + row.nama + '</option>');
      });
    });
  }

</script>
@endsection