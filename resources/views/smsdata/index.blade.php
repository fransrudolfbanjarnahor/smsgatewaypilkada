@extends('layouts.app')

@section('content')
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
        <h3>SMS DATA</h3>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
          </ul>
          <form class="form-inline my-2 my-lg-0">
              <select class="form-control input-sm" name="filtersms" id="filtersms">
                <option value="0">Semua</option>
                <option value="1">Valid</option>
                <option value="-1">In Valid</option>
              </select>
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filter</button>
             
          </form>
          <a class="btn btn-outline-success my-2 my-sm-0" type="menu" href="/data/sms/confirm">Kosongkan SMS Data</a>
        </div>
      </nav>
  <form action="/data/lokasitps/filter" method="POST" id="formfilter">
  </form>
  <div class="card">
    <div class="card-body">
    <table class="table">
    <tr>
      <th>DARI</th>
      <th>Pesan</th>
      <th>Status Pesan</th>
      <th>TPS</th>
      <th>NO URUT PESERTA</th>
      <th>Jumlah</th>
    </tr>
  @foreach ($data as $row)
    <tr>
      <td>{{$row->nomorhp}}</td>
      <td>{{$row->pesan}}</td>
      <td>{{$row->statuspesan}}</td>
      <td>{{$row->tps}}</td>
      <td>{{$row->nourut}}</td>
      <td>{{$row->jumlah}}</td>
    </tr>
  @endforeach
  </table>
    </div>
  </div>
</div>
@endsection





