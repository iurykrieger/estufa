<!-- resources/views/ambients/show.blade.php -->
@extends('layouts.dashboard')

@section('title','Ambiente - '.$ambient->description)

@section('page_title','Ambiente')

@section('page_subtitle',$ambient->description)

@section('breadcrumb')
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-tree"></i> Ambientes</li>
    <li class="active">Vizualisar Ambiente</li>
@endsection

@section('content')

<!-- Default box -->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-tree"></i> Vizualização de Ambiente</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i>
			</button>
			
		</div>
	</div>
	<div class="box-body">
		<div class="box-header">
			<h3 class="box-title">ID DO AMBIENTE</h3><br>
		</div>
		<div class="box-body">
		    {{ $ambient->id_ambient }}
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">DESCRIÇÃO</h3><br>
		</div>
		<div class="box-body">
		    {{ $ambient->description }}
		</div>
		<hr>	
		<div class="box-header">
			<h3 class="box-title">TEMPERATURA MÁXIMA</h3><br>
		</div>
		<div class="box-body">
		    {{ $ambient->max_temperature }} ºC
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">TEMPERATURA MÍNIMA</h3><br>
		</div>
		<div class="box-body">
		    {{ $ambient->min_temperature }} ºC
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">UMIDADE DO AR MÁXIMA</h3><br>
		</div>
		<div class="box-body">
		    {{ $ambient->max_air_humidity }} %
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">UMIDADE DO AR MÍNIMA</h3><br>
		</div>
		<div class="box-body">
		    {{ $ambient->min_air_humidity }} %
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">UMIDADE DO SOLO MÁXIMA</h3><br>
		</div>
		<div class="box-body">
		    {{ $ambient->max_ground_humidity }} %
		</div>
		<hr>		
		<div class="box-header">
			<h3 class="box-title">UMIDADE DO SOLO MÍNIMA</h3><br>
		</div>
		<div class="box-body">
		    {{ $ambient->min_ground_humidity }} %
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">CRIADO EM</h3><br>
		</div>
		<div class="box-body">
		    {{ $ambient->created_at->format('d/m/Y H:m:s') }}
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">ÚLTIMA ALTERAÇÃO EM</h3><br>
		</div>
		<div class="box-body">
		   	{{ $ambient->updated_at->format('d/m/Y H:m:s') }}
		</div>
		<hr>
		<a href="{{ url('admin/ambient/'.$ambient->id_ambient.'/edit') }}">
			<button type="button" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i> Editar Ambiente</button>
		</a>
		<a href="{{ url('admin/ambient') }}">
			<button type="button" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i> Voltar aos ambientes</button>
		</a>
		<a href="{{ url('admin/sensor/ambient/'.$ambient->id_ambient) }}">
			<button type="button" class="btn btn-flat"><i class="fa fa-sitemap"></i> Sensores</button>
		</a>
		{!! Form::open(['method' => 'DELETE','url' => 'admin/ambient/'.$ambient->id_ambient, 'class' => 'action-form inline', 'id' => 'form-delete']) !!}
		{!! Form::button('<i class="fa fa-trash"></i> Remover Ambiente', ['class' => 'btn btn-danger btn-flat pull-right', 'id' => 'btn-delete', 'type' => 'submit', 'onClick' => 'confirmDelete()']) !!}
		{!! Form::close() !!}
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->

@endsection