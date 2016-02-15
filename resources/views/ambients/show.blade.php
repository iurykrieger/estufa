<!-- resources/views/ambients/show.blade.php -->
@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
@endsection

@section('title','Ambiente - '.$ambient->description)

@section('page_heading','Ambiente - '.$ambient->description)

@section('content')

@include('common.messages')

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">ID do Ambiente</h3>
	</div>
	<div class="panel-body">
		{{ $ambient->id_ambient }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Descrição</h3>
	</div>
	<div class="panel-body">
		{{ $ambient->description }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Temperatura Máxima</h3>
	</div>
	<div class="panel-body">
		{{ $ambient->max_temperature }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Temperatura Mínima</h3>
	</div>
	<div class="panel-body">
		{{ $ambient->min_temperature }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Umidade do Ar Máxima</h3>
	</div>
	<div class="panel-body">
		{{ $ambient->max_air_humidity }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Umidade do Ar Mínima</h3>
	</div>
	<div class="panel-body">
		{{ $ambient->min_air_humidity }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Umidade do Solo Máxima</h3>
	</div>
	<div class="panel-body">
		{{ $ambient->max_ground_humidity }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Umidade do Solo Mínima</h3>
	</div>
	<div class="panel-body">
		{{ $ambient->min_ground_humidity }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Criado em:</h3>
	</div>
	<div class="panel-body">
		{{ $ambient->created_at->format('d/m/Y H:m:s') }}
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Última Alteração em:</h3>
	</div>
	<div class="panel-body">
		{{ $ambient->updated_at->format('d/m/Y H:m:s') }}
	</div>
</div>
<a href="{{ url('admin/ambient') }}">
	<button type="button" class="btn btn-primary">@include('widgets.icon',['class'=>'arrow-left']) Voltar aos ambientes</button>
</a>
<a href="{{ url('admin/ambient/'.$ambient->id_ambient.'/edit') }}">
	<button type="button" class="btn btn-info">@include('widgets.icon',['class'=>'pencil']) Editar Ambient</button>
</a>
{!! Form::open(['method' => 'DELETE','url' => 'admin/ambient/'.$ambient->id_ambient, 'class' => 'action-form', 'id' => 'form-delete']) !!}
{!! csrf_field() !!}
{!! Form::button('<i class="fa fa-times"></i> Remover Ambiente', ['class' => 'btn btn-danger pull-right', 'id' => 'btn-delete', 'type' => 'submit', 'onClick' => 'confirmDelete()']) !!}
{!! Form::close() !!}

@endsection

@section('scripts')

<script>
	function confirmDelete(){
		event.preventDefault();
		swal({   
			title: "Você tem certeza que deseja deletar este ambiente?",   
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