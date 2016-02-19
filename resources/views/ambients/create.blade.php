<!-- resources/views/ambients/create.blade.php -->
@extends('layouts.dashboard')

@section('title','Novo Ambiente')

@section('page_title','Ambiente')

@section('page_subtitle','Novo Ambiente')

@section('parent_breadcrumb','Home')

@section('active_breadcrumb','Novo Ambiente')

@section('content')

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Cadastro de Ambiente</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      	{!! Form::open(['url' => 'admin/ambient']) !!}

		<div class="form-group">
			{!! Form::label('description', 'Descrição:', ['class' => 'control-label']) !!}
			{!! Form::text('description', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('max_temperature', 'Temperatura Máxima:', ['class' => 'control-label']) !!}
			{!! Form::text('max_temperature', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('min_temperature', 'Temperatura Mínima:', ['class' => 'control-label']) !!}
			{!! Form::text('min_temperature', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('max_air_humidity', 'Umidade do Ar Máxima:', ['class' => 'control-label']) !!}
			{!! Form::text('max_air_humidity', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('min_air_humidity', 'Umidade do Ar Mínima:', ['class' => 'control-label']) !!}
			{!! Form::text('min_air_humidity', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('max_ground_humidity', 'Umidade do Solo Máxima:', ['class' => 'control-label']) !!}
			{!! Form::text('max_ground_humidity', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('min_ground_humidity', 'Umidade do Solo Mínima:', ['class' => 'control-label']) !!}
			{!! Form::text('min_ground_humidity', null, ['class' => 'form-control']) !!}
		</div>

		{!! Form::submit('Salvar Novo Ambiente', ['class' => 'btn btn-primary']) !!}

		{!! Form::close() !!}
    </div>
    <!-- /.box-body -->
    
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

@endsection