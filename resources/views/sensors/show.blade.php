<!-- resources/views/sensors/show.blade.php -->
@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
@endsection

@section('title','Sensor - '.$sensor->description)

@section('page_heading','Sensor - '.$sensor->description)

@section('content')

@include('common.messages')

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">ID do Sensor</h3>
	</div>
	<div class="panel-body">
		{{ $sensor->id_sensor }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Descrição</h3>
	</div>
	<div class="panel-body">
		{{ $sensor->description }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Ambiente</h3>
	</div>
	<div class="panel-body">
		<a href="{{url('admin/ambient/'.$sensor->ambient->id_ambient)}}">{{ $sensor->ambient->id_ambient." - ".$sensor->ambient->description}}</a>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Ativo:</h3>
	</div>
	<div class="panel-body">
		{{ ($sensor->active == 1 ? "Sim":"Não") }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Criado em:</h3>
	</div>
	<div class="panel-body">
		{{ $sensor->created_at->format('d/m/Y H:m:s') }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Última Alteração em:</h3>
	</div>
	<div class="panel-body">
		{{ $sensor->updated_at->format('d/m/Y H:m:s') }}
	</div>
</div>
<a href="{{ url('admin/sensor') }}">
	<button type="button" class="btn btn-primary">@include('widgets.icon',['class'=>'arrow-left']) Voltar aos sensores</button>
</a>
<a href="{{ url('admin/sensor/'.$sensor->id_sensor.'/edit') }}">
	<button type="button" class="btn btn-info">@include('widgets.icon',['class'=>'pencil']) Editar Sensor</button>
</a>
{!! Form::open(['method' => 'DELETE','url' => 'admin/sensor/'.$sensor->id_sensor, 'class' => 'action-form', 'id' => 'form-delete']) !!}
{!! csrf_field() !!}
{!! Form::button('<i class="fa fa-times"></i> Remover Sensor', ['class' => 'btn btn-danger pull-right', 'id' => 'btn-delete', 'type' => 'submit', 'onClick' => 'confirmDelete()']) !!}
{!! Form::close() !!}

@endsection

@section('scripts')

<script>
	function confirmDelete(){
		event.preventDefault();
		swal({   
			title: "Você tem certeza que deseja deletar este sensor?",   
			text: "Você não poderá recuperar este registro!",   
			type: "warning",   
			showCancelButton: true,   
			confirmButtonColor: "#DD6B55",  
			confirmButtonText: "Sim, remover!",   
			cancelButtonText: "Não, cancelar!",   
			closeOnConfirm: false,
		}, 
		function(isConfirm){   
			if (isConfirm) {    
				$("#form-delete").submit();
			}
		});
	};
</script>

@append