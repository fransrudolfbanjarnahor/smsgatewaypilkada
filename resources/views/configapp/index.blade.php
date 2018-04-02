@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Konfigurasi Level Koordinasi Wilayah Pemilihan</h1>
    
   {!! Form::open(['action' => 'ConfigAppController@store']) !!}
   <input type="hidden" name="_token" value="{{ csrf_token() }}">

   <div class="form-group">
    <label>Untuk Pemilihan</label>
         <input type="text" class="form-control input-sm" name="untukpemilihan" id="untukpemilihan" value="{{ $config->untukpemilihan }}" />
    </div>


   <div class="form-group">
  <label>Propinsi</label>
        <select class="form-control input-sm" name="propinsi" id="propinsi">
        </select>
  </div>

  <div class="form-group">
    <label>Kabupaten / Kota</label>
        <select class="form-control input-sm" name="kabupatenkota" id="kabupatenkota">
        </select>
  </div>

  <div class="form-group">
    <label>Kecamatan</label>
        <select class="form-control input-sm" name="kecamatan" id="kecamatan">
        </select>
  </div>

  <div class="form-group">
    <label>Kelurahan</label>
        <select class="form-control input-sm" name="kelurahandesa" id="kelurahandesa">
        </select>
  </div>

  {!! Form::submit('Simpan');!!}
  {!! Form::close() !!}
</div>
@endsection

@section('script')
{{--  <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>  --}}
<script type="text/javascript">
      $.get('/ref/propinsi', function(data){
          $('#propinsi').empty();
          $.each(data, function(index, row){
            if (row.id == {{isset($config->propinsi) ? $config->propinsi :0 }}) {
              $('#propinsi').append('<option value="'+row.id+'" selected>'+row.kode + ' - ' + row.nama + '</option>');
            }else{
              $('#propinsi').append('<option value="'+row.id+'">'+row.kode + ' - ' + row.nama + '</option>');
            }
          });        
        }).done(function() {
          onChangePropinsi({{isset($config->propinsi) ? $config->propinsi :1}});
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
        if (row.id == {{isset($config->kabupatenkota) ? $config->kabupatenkota :0 }}) {
          $('#kabupatenkota').append('<option value="'+row.id+'" selected>'+row.kode + ' - ' + row.nama + '</option>');
        }else {
          $('#kabupatenkota').append('<option value="'+row.id+'">'+row.kode + ' - ' + row.nama + '</option>');
        }
      });
    }).done(function() {
      onChangeKabupatenKota({{isset($config->kabupatenkota) ? $config->kabupatenkota :0 }});
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
        if (row.id == {{isset($config->kecamatan) ? $config->kecamatan :0}}) {
          $('#kecamatan').append('<option value="'+row.id+'" selected>'+row.kode + ' - ' + row.nama + '</option>');
        }else{
          $('#kecamatan').append('<option value="'+row.id+'">'+row.kode + ' - ' + row.nama + '</option>');
        }
      });
    }).done(function() {
      onChangeKecamatan({{isset($config->kecamatan) ? $config->kecamatan :0 }});
          $('#kecamatan').on('change', function(e){
            var state_id = e.target.value;
            onChangeKecamatan(state_id);
          });
        }) ;
  }      

function onChangeKecamatan(id) {
    $.get('/ref/kelurahandesa/' + id, function(data) {
      $('#kelurahandesa').empty();
      $('#kelurahandesa').append('<option value=0>Semua Kelurahan</option>');
      $.each(data, function(index,row){
        if (row.id == {{isset($config->kelurahandesa) ? $config->kelurahandesa :0}}) {
          $('#kelurahandesa').append('<option value="'+row.id+'" selected>'+row.kode + ' - ' + row.nama + '</option>');
        }else{
          $('#kelurahandesa').append('<option value="'+row.id+'">'+row.kode + ' - ' + row.nama + '</option>');
        }
      });
    });
  }

</script>
@endsection
{{--  @section('scripts')  --}}

{{--  @endsection  --}}