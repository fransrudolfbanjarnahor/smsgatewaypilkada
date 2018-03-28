@extends('layouts.app')
@section('style')
<style>
.depan {
    background-image: url('/images/background.jpg');
    background-size: cover;
    position: fixed;
    width: 100%;
    height: 100%;
    margin-top: -24px;
}
.contents {
    margin-top: 150px;
   
}

.contents h1 {
    font-size: 48px;
    color: darkgray;
}

.contents h3 {
    font-size: 32px;
    color: cornflowerblue;
}

.contents h4 {
    font-size: 24px;
    color: darkgray;
}
</style>
@endsection
@section('content')
{{--  <div>
    <img src="/images/background.jpg" id="bg" alt="">  
 </div>  --}}
 
 <div class="depan">
    <div class="container contents">
        <div class="row justify-content-center">
            <div>
                <h1>SMS GATEWAY ANDROID UNTUK PILKADA</h1>
                <h3>Cara Lama Solusi Masa Kini</h3>
                <h4>Berhenti menghabiskan biaya dan waktu untuk konfigurasi sms gateway</h4>
                <div>
                        <a href="/page/tentang">Tentang</a> |
                        <a href="/page/carakerja">Cara kerja</a>
                    </div>
            </div>
        </div>
    </div>
 </div>
@endsection
