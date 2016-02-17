<!-- resources/views/index.blade.php -->
@extends('layouts.dashboard')

@section('css')
@endsection

@section('title','Gráficos')

@section('page_heading')
  Gráficos
@endsection

@section('content')
  <label>
        Sensores
        <select id="paginator" name="paginate" aria-controls="scans" class="form-control input-sm" style="width: 150px">
          @foreach ($sensors as $sensor)
            <option value="{{ $sensor->id_sensor }}" {{ ($sensor == $sensors ? "selected":"") }}>{{ $sensor->id_sensor . " - " . $sensor->description }}</option>
          @endforeach
        </select>
  </label>

  <label>
        Scans
        <select id="paginator" name="paginate" aria-controls="scans" class="form-control input-sm" style="width: 150px">
          @foreach ($scans as $scan)
            <option value="{{ $scan->id_scan }}" {{ ($scan == $scans ? "selected":"") }}>{{ $scan->id_scan . " - " . $scan->temperature }}</option>
          @endforeach
        </select>
  </label>

  <div id="curve_chart" style="width: 900px; height: 500px"></div>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      var str = "<?php echo $sensor->id_sensor ?>"

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() { 

        var data = new google.visualization.DataTable();
              data.addColumn('number', 'Hora');
              data.addColumn('number', 'Temp Min');
              data.addColumn('number', 'Temp Max');
              data.addColumn('number', 'Umidade Solo Min');


        data.addRows([
        [1,  37.8, 80.8, 41.8],
        [3,  25.4,   57, 25.7],
        [4,  11.7, 18.8, 10.5],
        [5,  11.9, 17.6, 10.4],
        [9,  16.9, 42.9, 14.8],
        [12,  6.6,  8.4,  5.2],
        [14,  4.2,  6.2,  3.4]
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