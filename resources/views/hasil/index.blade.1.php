@extends('layouts.app')
@section('style')
    <style>
        .graph {
            width: 50%;
            height: 50%;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="graph">
        <canvas id="myChart" width="100px" height="100px"></canvas>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('js/Chart.js')}}"></script>
<script>
var ctx = document.getElementById("myChart");
var data =  {
    datasets: [{
        data: [10, 20, 30],
        backgroundColor:['rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)']
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Red',
        'Yellow',
        'Blue'
    ]
};

var options = {
}
var myPieChart = new Chart(ctx,{
    type: 'pie',
    data: data,
    options: Chart.defaults.pie
});
</script>
@endsection





