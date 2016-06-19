<!-- resources/views/ambients/show.blade.php -->
@extends('layouts.dashboard')

@section('title','Leitura - '.$scan->id_scan)

@section('page_title','Leitura')

@section('page_subtitle',$scan->id_scan)

@section('breadcrumb')
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-tasks"></i> Leituras</li>
    <li class="active">Vizualisar Leitura</li>
@endsection

@section('content')

<!-- Default box -->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-tasks"></i> Vizualização de Leitura</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body">
		<div class="box-header">
			<h3 class="box-title">ID da Leitura</h3>
		</div>
		<div class="box-body">
			{{ $scan->id_scan }}
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">Data</h3>
		</div>
		<div class="box-body">
			{{ $scan->date->format('d/m/Y') }}
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">Hora</h3>
		</div>
		<div class="box-body">
			{{ $scan->time }}
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">Sensor</h3>
		</div>
		<div class="box-body">
			<a href="{{url('admin/sensor/'.$scan->sensor->id_sensor)}}">{{ $scan->sensor->id_sensor." - ".$scan->sensor->description}}</a>
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">Leitura</h3>
		</div>
		<div class="box-body">
			<a href="{{url('admin/ambient/'.$scan->ambient->id_ambient)}}">{{ $scan->ambient->id_ambient." - ".$scan->ambient->description}}</a>
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">Temperatura</h3>
		</div>
		<div class="box-body">
			{{ $scan->temperature }} ºC
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">Umidade do Ar</h3>
		</div>
		<div class="box-body">
			{{ $scan->air_humidity }} %
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">Umidade do solo</h3>
		</div>
		<div class="box-body">
			{{ $scan->ground_humidity }} %
		</div>
		<hr>
		<a href="{{ url('admin/scan/all') }}">
			<button type="button" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i> Voltar as Leituras</button>
		</a>
		{!! Form::open(['method' => 'DELETE','url' => 'admin/scan/'.$scan->id_scan, 'class' => 'action-form inline', 'id' => 'form-delete']) !!}
		{!! csrf_field() !!}
		{!! Form::button('<i class="fa fa-times"></i> Remover Leitura', ['class' => 'btn btn-danger pull-right btn-flat', 'id' => 'btn-delete', 'type' => 'submit', 'onClick' => 'confirmDelete()']) !!}
		{!! Form::close() !!}
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->

@endsection