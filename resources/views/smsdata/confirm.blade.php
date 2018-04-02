@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-danger" role="alert">
        <h3>Proses ini akan membuat data sms akan dihapus, sehingga proses re-sync dari aplikasi mobile menjadi kosong <br />
        Yakin ingin mengosongkan data sms?</h3>
      </div>
      <form action="/data/sms/destroy">
        <input type="hidden" value="1" name="confirm" />
        <a class="btn btn-primary" href="/data/sms/index">Batal</a> <button class="btn btn-danger" type="submit">Proses</button>
      </form>
      

</div>
@endsection





