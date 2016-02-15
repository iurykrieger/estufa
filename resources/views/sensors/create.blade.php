<!-- resources/views/sensors/create.blade.php -->
@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
@endsection

@section('title','Novo Sensor')

@section('page_heading','Novo Sensor')

@section('content')

{!! Form::open(['url' => 'admin/sensor']) !!}
{!! csrf_field() !!}

<div class="form-group">
	{!! Form::label('description', 'Descrição:', ['class' => 'control-label']) !!}
	{!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('id_ambient', 'Ambiente:', ['class' => 'control-label']) !!}
	{!! Form::select('id_ambient', $ambients, null, ['class' => 'form form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('active', 'Ativo:', ['class' => 'control-label']) !!}
	{!! Form::select('active', ['1' => 'Sim', '0' => 'Não'], null, ['class' => 'form form-control']) !!}
</div>

{!! Form::submit('Salvar Novo Sensor', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@endsection