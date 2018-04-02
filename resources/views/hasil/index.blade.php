@extends('layouts.app')
@section('style')
    <style>
        #piechart {
            width: 100%;
            height: 100%;
        }
        .row {
            padding: 16px;
        }
    </style>
@endsection
@section('content')
<div class="container">
        <div class="row">
                <div class="col-4">
                        @foreach ($data as $row)
                        <div class="row">
                            <div class="col-sm" align="center">
                                    <img src='data:image/jpeg;base64, {{$row->photocalon}}' alt="Card image cap" width="60px" height="90px">
                                    {{$row->namacalon}}
                            </div>
                            <div class="col-sm" align="center">{{$row->nourut}}
                            </div>
                            <div class="col-sm" align="center">
                                    <img src='data:image/jpeg;base64, {{$row->photowakilcalon}}' alt="Card image cap" width="60px" height="90px">
                                    {{$row->namawakilcalon}}
                            </div>
                        </div>
                        @endforeach

                </div>
                <div class="col-8">
                        <div id="piechart"></div>
                    </div>
        </div>  
</div>
@endsection

@section('script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
   
    function drawChart() {
        
       

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'No Urut');
    data.addColumn('number', 'total');
    var options = {
        title: 'Hasil Pemilihan',
        is3D: true,
      };
      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    var arr = Array();
    $.get('/perhitungan', function(dt) {  
        $.each(dt, function(index, row){
            arr.push([String(row.nourut), Number(row.total)]);
        });          
    }).done(function() {
        console.log(arr);
        data.addRows(arr);
     
      chart.draw(data, options);
    });
   
    
      
    }
  </script>
@endsection





