<!-- resources/views/index.blade.php -->
@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
@endsection

@section('title','Leituras')

@section('page_heading','Todas as Leituras')

@section('content')

{!! Form::open(['method' => 'POST','url' => 'admin/scan/date', 'class' => 'action-form form-inline', 'id' => 'form-dates']) !!}
{!! csrf_field() !!}
<div class="form-group">
	{!! Form::label('initialDate', 'Data Inicial:', ['class' => 'control-label']) !!}
	{!! Form::input('date','initialDate', $initialDate, ['class' => 'form-control', 'placeholder' => 'Date']) !!}
</div>
<div class="form-group">
	{!! Form::label('endDate', 'Data Final:', ['class' => 'control-label']) !!}
	{!! Form::input('date','endDate', $endDate, ['class' => 'form-control', 'placeholder' => 'Date']) !!}
</div>
{!! Form::button('<i class="fa fa-search"></i> Pesquisar', ['class' => 'btn btn-primary', 'id' => 'btn-search', 'type' => 'submit']) !!}
{!! Form::close() !!}

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
				<!-- Show Button -->
                <a href="{{ url('admin/scan/'.$scan->id_scan) }}"><button type="button" class="btn btn-primary">@include('widgets.icon',['class'=>'eye']) Visualizar</button></a>
                
                <!-- Destroy Form Button -->
                {!! Form::open(['method' => 'DELETE','url' => 'admin/scan/'.$scan->id_scan, 'class' => 'action-form', 'id' => 'form-delete']) !!}
                {!! csrf_field() !!}
                {!! Form::button('<i class="fa fa-times"></i> Remover', ['class' => 'btn btn-danger', 'id' => 'btn-delete', 'type' => 'submit', 'onClick' => 'confirmDelete()']) !!}
                {!! Form::close() !!}
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