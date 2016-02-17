<!-- resources/views/index.blade.php -->
@extends('layouts.dashboard')

@section('css')
@endsection

@section('title','Gráficos')

@section('page_heading')
  Gráficos
@endsection

@section('content')
  <div id="curve_chart" style="width:auto; height:700px;"></div>

    <div id="chart"></div>
    {!! Lava::render('LineChart', 'Temps', 'chart') !!}
    
@endsection


@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Hora', 'Temp Min', 'Temp Max', 'Umidade Solo Min' , 'Umidade Solo Max'],
          ['10:00', -10.07,  30.02, 10.12, 85.03],
          ['11:00', -10.07,  30.02, 10.12, 85.03],
          ['12:00', -10.07,  30.02, 10.12, 85.03],
          ['13:00', -10.07,  30.02, 10.12, 85.03]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
@endsection