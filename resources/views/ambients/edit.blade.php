<!-- resources/views/ambients/create.blade.php -->
@extends('layouts.dashboard')

@section('title','Editar - '.$ambient->description)

@section('page_title','Ambiente')

@section('page_subtitle',$ambient->description)

@section('breadcrumb')
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-tree"></i> Ambientes</li>
    <li class="active">Editar Ambiente</li>
@endsection

@section('content')

<!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-tree"></i> Edição de Ambiente</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      	{!! Form::open(['url' => 'admin/ambient/'.$ambient->id_ambient, 'method' => 'PATCH']) !!}

		<div class="form-group">
			{!! Form::label('description', 'Descrição:', ['class' => 'control-label']) !!}
			{!! Form::text('description', $ambient->description, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('max_temperature', 'Temperatura Máxima:', ['class' => 'control-label']) !!}
			{!! Form::text('max_temperature', $ambient->max_temperature, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('min_temperature', 'Temperatura Mínima:', ['class' => 'control-label']) !!}
			{!! Form::text('min_temperature', $ambient->min_temperature, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('max_air_humidity', 'Umidade do Ar Máxima:', ['class' => 'control-label']) !!}
			{!! Form::text('max_air_humidity', $ambient->max_air_humidity, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('min_air_humidity', 'Umidade do Ar Mínima:', ['class' => 'control-label']) !!}
			{!! Form::text('min_air_humidity', $ambient->min_air_humidity, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('max_ground_humidity', 'Umidade do Solo Máxima:', ['class' => 'control-label']) !!}
			{!! Form::text('max_ground_humidity', $ambient->max_ground_humidity, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('min_ground_humidity', 'Umidade do Solo Mínima:', ['class' => 'control-label']) !!}
			{!! Form::text('min_ground_humidity', $ambient->min_ground_humidity, ['class' => 'form-control']) !!}
		</div>
		
		{!!Form::button('<i class="fa fa-save"></i> Editar Ambiente', array('type' => 'submit', 'class' => 'btn btn-primary btn-flat'))!!}

		<a href="{{ url('admin/ambient') }}">
			<button type="button" class="btn btn-info btn-flat"><i class="fa fa-arrow-left"></i> Voltar aos ambientes</button>
		</a>
		{!! Form::close() !!}
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

@endsection