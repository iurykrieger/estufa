<!-- resources/views/index.blade.php -->
@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
@endsection

@section('title','Leituras')

@section('page_heading','Últimas Leituras')

@section('content')

<div class="dataTables_wrapper form-inline dt-bootstrap">
	<div class="col-sm-6">
		<div class="dataTables_length" id="scans_length">
			<label>
				Mostrando 
				<select id="paginator" name="paginate" aria-controls="scans" class="form-control input-sm">
					@foreach ($sizes as $value)
					<option value="{{ $value }}" {{ ($value == $pagesize ? "selected":"") }}>{{ $value }}</option>
					@endforeach
				</select>
				leituras por página
			</label>
		</div>
	</div>
</div>

<table id="scans" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>ID</th>
			<th>Data</th>
			<th>Hora</th>
			<th>Temperatura</th>
			<th>Umidade do Ar</th>
			<th>Umidade do Solo</th>
			<th>Sensor</th>
			<th>Ambiente</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>ID</th>
			<th>Data</th>
			<th>Hora</th>
			<th>Temperatura</th>
			<th>Umidade do Ar</th>
			<th>Umidade do Solo</th>
			<th>Sensor</th>
			<th>Ambiente</th>
			<th>Ações</th>
		</tr>
	</tfoot>
	<tbody>
		@foreach ($scans as $scan)
		<tr>
			<td>{{ $scan->id_scan }}</td>
			<td>{{ $scan->date->format('d/m/Y') }}</td>
			<td>{{ $scan->time }}</td>
			<td>{{ $scan->temperature }} ºC</td>
			<td>{{ $scan->air_humidity }} %</td>
			<td>{{ $scan->ground_humidity }} %</td>
			<td><a href="{{url('admin/sensor/show/'.$scan->sensor->id_sensor)}}">{{ $scan->sensor->id_sensor." - ".$scan->sensor->description }}</a></td>
			<td>{{ $scan->ambient->id_ambient." - ".$scan->ambient->description}}</td>
			<td>
				<button>@include('widgets.icon',['class'=>'times'])</button>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
{!! $scans->render() !!}

@endsection

@section('scripts')

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		$('#scans').DataTable({
			language: {
				"lengthMenu": "Mostrando _MENU_ leituras por página",
				"zeroRecords": "Nada encontrado",
				"info": "Mostrando página _PAGE_ de _PAGES_",
				"infoEmpty": "Sem registros",
				"infoFiltered": "(Filtrado de _MAX_ registros totais)",
				"search": "Buscar:",
				"paginate": {
					"first":      "Primeiro",
					"last":       "Último",
					"next":       "Próximo",
					"previous":   "Anterior"
				},
			},
			order: [[ 1, "desc" ],[2 , "desc"]],
			responsive: true,
			pageLength: 50,
			paging:false,
		});
		$('#paginator').bind('change', function () {
			var path = '/admin/';
			var pathname = window.location.pathname.split( '/' );
			var url = path + pathname[2] + '/' +$(this).val(); 
			if (url) {
				window.location = url; 
			}
			return false;
		});
	} );
</script>

@endsection