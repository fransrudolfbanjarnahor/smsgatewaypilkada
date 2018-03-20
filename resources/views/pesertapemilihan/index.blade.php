@extends('layouts.app')
@section('content')
<div class="container">
        <ul class="nav justify-content-end">
                <li class="nav-item">
                  <a class="nav-link active" href="/data/pesertapemilihan/create">Tambah Peserta</a>
                </li>
               
              </ul>

    @foreach ($data as $row)
        <div class="card">
                <div class="card-body">
                <div class="row" align="center">
                        <div class="col-sm">
                             <h2>Pasangan Nomor Urut {{$row->nourut}} ({{$row->inisialpaslon}})</h2>
                        </div>
                </div>
            <div class="row">
                <div class="col-sm" align="center">
                        <img src='data:image/jpeg;base64, {{$row->photocalon}}' alt="Card image cap" width="90px" height="160px">
                </div>
                <div class="col-sm" align="center">
                        <img src='data:image/jpeg;base64, {{$row->photowakilcalon}}' alt="Card image cap" width="90px" height="160px">
                </div>
            </div>
            <div class="row">
                <div class="col-sm" align="center">
                        <h4>{{$row->namacalon}}</h4>
                </div>
                <div class="col-sm" align="center">
                        <h4>{{$row->namawakilcalon}}</h4>
                </div>
            </div>
            <div class="row">
                    <div class="col-sm" align="right">
              <a href="/data/pesertapemilihan/{{$row->id}}/edit" class="btn btn-primary">Edit</a>
            </div>
        </div>
            </div>
          </div>
    @endforeach
</div>
@endsection
{{--  @section('scripts')  --}}

{{--  @endsection  --}}