<!-- resources/views/sensors/show.blade.php -->
@extends('layouts.dashboard')

@section('title','Sensor - '.$sensor->description)

@section('page_title','Sensor')

@section('page_subtitle',$sensor->description)

@section('breadcrumb')
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-sitemap"></i> Sensores</li>
    <li class="active">Vizualisar Sensor</li>
@endsection

@section('content')

<!-- Default box -->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-sitemap"></i> Vizualização de Sensor</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body">
		<div class="box-header">
			<h3 class="box-title">ID DO SENSOR</h3>
		</div>
		<div class="box-body">
			{{ $sensor->id_sensor }}
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">DESCRIÇÃO</h3>
		</div>
		<div class="box-body">
			{{ $sensor->description }}
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">AMBIENTE</h3>
		</div>
		<div class="box-body">
			@if(is_null($sensor->ambient))
                <a href="{{url('admin/sensor/'.$sensor->id_sensor.'/edit')}}"><i class="fa fa-plus"></i> Adicionar Ambiente</a>
			@else
				<a href="{{url('admin/ambient/'.$sensor->ambient->id_ambient)}}">{{ $sensor->ambient->id_ambient." - ".$sensor->ambient->description}}</a>
			@endif
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">ATIVO</h3>
		</div>
		<div class="box-body">
			{{ ($sensor->active == 1 ? "Sim":"Não") }}
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">CRIADO EM</h3>
		</div>
		<div class="box-body">
			{{ $sensor->created_at->format('d/m/Y H:m:s') }}
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">ÚLTIMA ALTERAÇÃO EM</h3>
		</div>
		<div class="box-body">
			{{ $sensor->updated_at->format('d/m/Y H:m:s') }}
		</div>
		<hr>
		@if (Auth::user()->isAdmin())
			<a href="{{ url('admin/sensor/'.$sensor->id_sensor.'/edit') }}"><button type="button" class="btn btn-primary btn-flat"><i class="fa fa-pencil"></i> Editar Sensor</button></a>
		@endif

		<a href="{{ url('admin/sensor') }}"><button type="button" class="btn btn-info btn-flat"><i class="fa fa-arrow-left"></i> Voltar aos sensores</button></a>
		
		@if (Auth::user()->isAdmin())
			{!! Form::open(['method' => 'DELETE','url' => 'admin/sensor/'.$sensor->id_sensor, 'class' => 'action-form inline', 'id' => 'form-delete']) !!}
			{!! csrf_field() !!}
			{!! Form::button('<i class="fa fa-trash"></i> Remover Sensor', ['class' => 'btn btn-danger btn-flat pull-right', 'id' => 'btn-delete', 'type' => 'submit', 'onClick' => 'confirmDelete()']) !!}
			{!! Form::close() !!}
		@endif
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->

@endsection