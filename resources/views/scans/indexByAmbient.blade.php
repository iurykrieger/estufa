<!-- resources/views/index.blade.php -->
@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
@endsection

@section('title','Leituras')

@section('page_heading')
	Leituras do ambiente {{ $selected_ambient->description }}
@endsection

@section('content')

<div class="dataTables_wrapper form-inline dt-bootstrap">
	<div class="col-sm-6">
		<div class="dataTables_length" id="scans_length">
			<label>
				Mostrando leituras do ambiente 
				<select id="paginator" name="paginate" aria-controls="scans" class="form-control input-sm" style="width: 150px">
					@foreach ($ambients as $ambient)
					<option value="{{ $ambient->id_ambient }}" {{ ($ambient == $selected_ambient ? "selected":"") }}>{{ $ambient->id_ambient . " - " . $ambient->description }}</option>
					@endforeach
				</select>
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
			<td><a href="{{url('admin/sensor/'.$scan->sensor->id_sensor)}}">{{ $scan->sensor->id_sensor." - ".$scan->sensor->description }}</a></td>
			<td><a href="{{url('admin/ambient/'.$scan->ambient->id_ambient)}}">{{ $scan->ambient->id_ambient." - ".$scan->ambient->description}}</a></td>
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
@include('common.dataTables')

@endsection