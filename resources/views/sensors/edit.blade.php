<!-- resources/views/sensors/create.blade.php -->
@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
@endsection

@section('title','Editar - '.$sensor->description)

@section('page_heading','Editar - '.$sensor->description)

@section('content')

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

{!! Form::submit('Editar Sensor', ['class' => 'btn btn-primary']) !!}

<a href="{{ url('admin/sensor') }}">
	<button type="button" class="btn btn-info">@include('widgets.icon',['class'=>'arrow-left']) Voltar aos sensores</button>
</a>

{!! Form::close() !!}

@endsection