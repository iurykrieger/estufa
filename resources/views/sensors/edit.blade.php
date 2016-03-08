<!-- resources/views/sensors/create.blade.php -->
@extends('layouts.dashboard')

@section('title','Editar - '.$sensor->description)

@section('page_title','Sensor')

@section('page_subtitle',$sensor->description)

@section('breadcrumb')
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-sitemap"></i> Sensores</li>
    <li class="active">Editar Sensor</li>
@endsection

@section('content')

<!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-sitemap"></i> Edição de Sensor</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      	{!! Form::open(['url' => 'admin/sensor/'.$sensor->id_sensor, 'method' => 'PATCH']) !!}
		{!! csrf_field() !!}

		<div class="form-group">
			{!! Form::label('description', 'Descrição:', ['class' => 'control-label']) !!}
			{!! Form::text('description', $sensor->description, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('id_ambient', 'Ambiente:', ['class' => 'control-label']) !!}
			{!! Form::select('id_ambient', $ambients, $sensor->id_ambient, ['class' => 'form form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('active', 'Ativo:', ['class' => 'control-label']) !!}
			{!! Form::select('active', ['1' => 'Sim', '0' => 'Não'], $sensor->active, ['class' => 'form form-control']) !!}
		</div>

		{!!Form::button('<i class="fa fa-save"></i> Editar Sensor', array('type' => 'submit', 'class' => 'btn btn-primary btn-flat'))!!}

		<a href="{{ url('admin/sensor') }}">
			<button type="button" class="btn btn-info btn-flat"><i class="fa fa-arrow-left"></i> Voltar aos sensores</button>
		</a>

		{!! Form::close() !!}
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

@endsection