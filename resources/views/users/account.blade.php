<!-- resources/views/users/show.blade.php -->
@extends('layouts.dashboard')

@section('title','Usuário - '.$user->name)

@section('page_title','Usuário')

@section('page_subtitle',$user->name)

@section('breadcrumb')
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-user"></i> Usuários</li>
    <li class="active">Vizualisar Usuário</li>
@endsection

@section('content')

<!-- Default box -->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-user"></i> Usuário</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body">
		<div class="box-header">
			<h3 class="box-title">ID DO USUÁRIO</h3><br>
		</div>
		<div class="box-body">
		    {{ $user->id_user }}
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">NOME</h3><br>
		</div>
		<div class="box-body">
		    {{ $user->name }}
		</div>
		<hr>	
		<div class="box-header">
			<h3 class="box-title">EMAIL</h3><br>
		</div>
		<div class="box-body">
		    {{ $user->email }}
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">TIPO</h3><br>
		</div>
		<div class="box-body">
		    {{ $user->role->description }}
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">ATIVO</h3><br>
		</div>
		<div class="box-body">
		    {{ ($user->active == true ? "Sim" : "Não") }}
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">INGRESSO EM</h3><br>
		</div>
		<div class="box-body">
		    {{ $user->created_at->format('d/m/Y H:m:s') }}
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">ÚLTIMA ALTERAÇÃO EM</h3><br>
		</div>
		<div class="box-body">
		   	{{ $user->updated_at->format('d/m/Y H:m:s') }}
		</div>
		<hr>
		<a href="{{ url('admin/user/account/'.$user->id_user.'/edit') }}">
			<button type="button" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i> Editar Usuário</button>
		</a>

		@if (Auth::user()->isAdmin())
			<a href="{{ url('admin/user') }}">
				<button type="button" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i> Voltar aos Usuários</button>
			</a>
		@endif
		
		{!! Form::open(['method' => 'DELETE','url' => 'admin/user/delete/'.$user->id_user, 'class' => 'action-form inline', 'id' => 'form-delete']) !!}
		{!! Form::button('<i class="fa fa-trash"></i> Remover Usuário', ['class' => 'btn btn-danger btn-flat pull-right', 'id' => 'btn-delete', 'type' => 'submit', 'onClick' => 'confirmDelete()']) !!}
		{!! Form::close() !!}
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->

@endsection