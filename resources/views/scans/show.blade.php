<!-- resources/views/scans/show.blade.php -->
@extends('layouts.dashboard')

@section('title','Leitura - '.$scan->date)

@section('page_heading','Leitura - '.$scan->date->format('d/m/Y').' às '.$scan->time)

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">ID da Leitura</h3>
	</div>
	<div class="panel-body">
		{{ $scan->id_scan }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Data</h3>
	</div>
	<div class="panel-body">
		{{ $scan->date->format('d/m/Y') }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Hora</h3>
	</div>
	<div class="panel-body">
		{{ $scan->time }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Sensor</h3>
	</div>
	<div class="panel-body">
		<a href="{{url('admin/sensor/'.$scan->sensor->id_sensor)}}">{{ $scan->sensor->id_sensor." - ".$scan->sensor->description}}</a>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Ambiente</h3>
	</div>
	<div class="panel-body">
		<a href="{{url('admin/ambient/'.$scan->ambient->id_ambient)}}">{{ $scan->ambient->id_ambient." - ".$scan->ambient->description}}</a>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Temperatura</h3>
	</div>
	<div class="panel-body">
		{{ $scan->temperature }} ºC
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Umidade do Ar</h3>
	</div>
	<div class="panel-body">
		{{ $scan->air_humidity }} %
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Umidade do solo</h3>
	</div>
	<div class="panel-body">
		{{ $scan->ground_humidity }} %
	</div>
</div>
<a href="{{ url('admin/scan/all') }}">
	<button type="button" class="btn btn-primary">@include('widgets.icon',['class'=>'arrow-left']) Voltar as Leituras</button>
</a>
{!! Form::open(['method' => 'DELETE','url' => 'admin/scan/'.$scan->id_scan, 'class' => 'action-form', 'id' => 'form-delete']) !!}
{!! csrf_field() !!}
{!! Form::button('<i class="fa fa-times"></i> Remover Leitura', ['class' => 'btn btn-danger pull-right', 'id' => 'btn-delete', 'type' => 'submit', 'onClick' => 'confirmDelete()']) !!}
{!! Form::close() !!}

@endsection