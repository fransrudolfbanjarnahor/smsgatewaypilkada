@extends('layouts.app')

@section('content')
<div class="container">
  <h1>SMS DATA</h1>
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





