<!-- resources/views/ambients/create.blade.php -->
@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
@endsection

@section('title','Novo Ambiente')

@section('page_heading','Novo Ambiente')

@section('content')

@include('common.messages')

{!! Form::open(['url' => 'admin/ambient']) !!}
{!! csrf_field() !!}

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

@endsection