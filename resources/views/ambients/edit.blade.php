<!-- resources/views/ambients/create.blade.php -->
@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
@endsection

@section('title','Editar - '.$ambient->description)

@section('page_heading','Editar - '.$ambient->description)

@section('content')

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

{!! Form::submit('Editar Ambiente', ['class' => 'btn btn-primary']) !!}

<a href="{{ url('admin/ambient') }}">
	<button type="button" class="btn btn-info">@include('widgets.icon',['class'=>'arrow-left']) Voltar aos ambientes</button>
</a>

{!! Form::close() !!}

@endsection