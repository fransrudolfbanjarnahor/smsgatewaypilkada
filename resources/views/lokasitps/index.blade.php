@extends('layouts.app')



@section('content')
<div class="container">
    <h1>Upload Lokasi TPS</h1> <a href="/data/lokasitps/create">Template Upload</a>
   
  {!! Form::open(['action' => 'LokasiTPSController@store','files'=>'true']) !!}
  {!! Form::file('tps'); !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  {!! Form::submit('Upload');!!}
  {!! Form::close() !!}
</div>
<hr />
<div class="info">
@if (session('message'))
  {{session(message)}}
@endif  
</div>
<hr />
<div class="container">
  <h1>Lokasi TPS</h1>
  <form action="/data/lokasitps/filter" method="POST" id="formfilter">
  <div class="form-group">
      <label>Propinsi</label>
         <h4>{{$propinsi->nama}}</h4>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="card">
        <div class="card-body">
      <label>Filter Wilayah: </label>
      @if ($config->kabupatenkota == 0 || $config->kabupatenkota == null)
          <select class="input-sm" name="kabupatenkota" id="kabupatenkota">
          </select>
       @else
       <input type="hidden" name="kabupatenkota" id="kabupatenkota" value="{{ $config->kabupatenkota }}">
       <span>{{$kabkota->nama}}</span>
       @endif

       @if ($config->kecamatan == 0 || $config->kecamatan == null)
          <select class="input-sm" name="kecamatan" id="kecamatan">
              <option value="0" selected>Semua Kecamatan</option>
          </select>
      @else
      <input type="hidden" name="kecamatan" id="kecamatan" value="{{ $config->kecamatan }}">
          <span>{{$kecamatan->nama}}</span>
      @endif

      <select class="input-sm" name="kelurahandesa" id="kelurahandesa">
          <option value="0" selected>Semua Kelurahan</option>
      </select>   
      <button type="submit" class="btn btn-primary" form="formfilter">Proses</button>
      </div>
    </div>
  </form>

    <table class="table">
    <tr>
      <th>KODE</th>
      <th>NAMA</th>
      <th>LOKASI</th>
      <th>WILAYAH</th>
      <th>OPERATOR</th>
    </tr>
  @foreach ($lokasitps as $row)
    <tr>
      <td>{{$row->kode}}</td>
      <td>{{$row->nama}}</td>
      <td>{{$row->lokasi}}</td>
      <td>{{$row->kelurahandesa->nama}} - {{$row->kelurahandesa->kecamatan->nama}} - {{$row->kelurahandesa->kecamatan->kabupatenkota->nama}} - {{$row->kelurahandesa->kecamatan->kabupatenkota->propinsi->nama}} </td>
      @if (empty($row->petugastps))
      <td>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#petugasmodal"  
          data-petugas="" data-tps="{{$row->kode . ' ' . $row->kelurahandesa->nama}}" data-idtps="{{$row->id}}">Set Nomor Petugas</button>
      </td>
      @else
      <td>
          {{$row->petugastps->nama . ' - ' . $row->petugastps->nomorhp}} 
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#petugasmodal" data-tps="" data-idtps="{{$row->id}}" data-petugas="{{$row->petugastps}}">Edit</button>
      </td>
      @endif
    </tr>
  @endforeach
  </table>
</div>

<div class="modal fade" id="petugasmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/data/lokasitps/petugas" method="POST" id="formpetugas">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="lokasitps" id="lokasitps">
          <div class="form-group">
            <label for="nama" class="col-form-label">Nama Petugas</label>
            <input type="text" class="form-control" id="nama" name="nama">
          </div>
          <div class="form-group">
              <label for="nomorhp" class="col-form-label">Nomor HP Petugas</label>
              <input type="text" class="form-control" id="nomorhp" name="nomorhp">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="formpetugas">Proses</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
{{--  <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>  --}}
<script>
   console.log("Script section");
$('#petugasmodal').on('show.bs.modal', function (event) {
  console.log("Modal");
  var button = $(event.relatedTarget); // Button that triggered the modal
  var infotps = button.data('tps'); // Extract info from data-* attributes
  var idtps = button.data('idtps'); 
  console.log(infotps);
  var petugas = button.data('petugas');
  var modal = $(this);
  modal.find('.modal-title').text(infotps)
  modal.find('.modal-body #lokasitps').val(idtps);
  if (petugas != null) {
    modal.find('.modal-body #nama').val(petugas.nama);
    modal.find('.modal-body #nomorhp').val(petugas.nomorhp);
  }
//  modal.find('.modal-title').text(infotps)
//  modal.find('.modal-body #nomorhp').val(idtps)
})


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
      @if ($config->kabupatenkota == 0 || $config->kabupatenkota == null)
        onChangePropinsi({{$config->propinsi}});
        $('#propinsi').on('change', function(e){
          var state_id = e.target.value;
          onChangePropinsi(state_id);
        });
      @endif
    });
      
  function onChangePropinsi(id) {
    console.log("ID " + id);
    $.get('/ref/kabupatenkota/' + id, function(data) {
    $('#kabupatenkota').empty();
    $('#kabupatenkota').append('<option value=0>Semua Kab/Kota</option>');
      $.each(data, function(index,row){
        if (row.id == {{ app('request')->input('kabupatenkota') != null ? app('request')->input('kabupatenkota') : 0 }}) {
          $('#kabupatenkota').append('<option value="'+row.id+'" selected>'+row.kode + ' - ' + row.nama + '</option>');
        }else {
          $('#kabupatenkota').append('<option value="'+row.id+'">'+row.kode + ' - ' + row.nama + '</option>');
        }
      });
    }).done(function() {
      @if ($config->kecamatan == 0 || $config->kecamatan == null) 
      onChangeKabupatenKota({{ app('request')->input('kabupatenkota') != null ? app('request')->input('kabupatenkota') : 0 }});
          $('#kabupatenkota').on('change', function(e){
            var state_id = e.target.value;
            onChangeKabupatenKota(state_id);
          });
        });
      @endif  
  }      

  function onChangeKabupatenKota(id) {
    console.log("ID " + id);
    $.get('/ref/kecamatan/' + id, function(data) {
    $('#kecamatan').empty();
    $('#kecamatan').append('<option value=0>Semua Kecamatan</option>');
      $.each(data, function(index,row){
        if (row.id ==  {{ app('request')->input('kecamatan') != null ? app('request')->input('kecamatan') : 0 }}) {
          $('#kecamatan').append('<option value="'+row.id+'" selected>'+row.kode + ' - ' + row.nama + '</option>');
        }else{
          $('#kecamatan').append('<option value="'+row.id+'">'+row.kode + ' - ' + row.nama + '</option>');
        }
      });
    }).done(function() {
      onChangeKecamatan({{ app('request')->input('kecamatan') != null ? app('request')->input('kecamatan') : 0 }});
          $('#kecamatan').on('change', function(e){
            var state_id = e.target.value;
            onChangeKecamatan(state_id);
          });
        }) ;
  }      

function onChangeKecamatan(id) {
  $('#kelurahandesa').empty();
  $('#kelurahandesa').append('<option value=0>Semua Kelurahan</option>');
    $.get('/ref/kelurahandesa/' + id, function(data) {
      $.each(data, function(index,row){
        if (row.id ==  {{ app('request')->input('kelurahandesa') != null ? app('request')->input('kelurahandesa') : 0 }}) {
          $('#kelurahandesa').append('<option value="'+row.id+'" selected>'+row.kode + ' - ' + row.nama + '</option>');
        }else {
          $('#kelurahandesa').append('<option value="'+row.id+'">'+row.kode + ' - ' + row.nama + '</option>');
        }
      });
    });
  }

if ($("#kecamatan").val() == 0) { 
onChangeKabupatenKota($("#kabupatenkota").val());
}
</script>
@endsection





