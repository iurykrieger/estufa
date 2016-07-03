<!-- resources/views/ambients/create.blade.php -->
@extends('layouts.dashboard')

@section('title','Editar - '.$user->name)

@section('page_title','Editar Usuário')

@section('page_subtitle',$user->name)

@section('breadcrumb')
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-user"></i> Usuários</li>
    <li class="active">Editar Usuário</li>
@endsection

@section('content')

<!-- Default box -->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-user"></i> Editar Usuário - {{ $user->name }}</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body">
		{!! Form::open(['url' => 'admin/user/account/'.$user->id_user, 'method' => 'PATCH']) !!}
		<div class="form-group">
			{!! Form::label('name', 'Nome:', ['class' => 'control-label']) !!}
			{!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
			{!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
		</div>

		@if (Auth::user()->isAdmin())
			<div class="form-group">
				{!! Form::label('id_role', 'Tipo:', ['class' => 'control-label']) !!}
				{!! Form::select('id_role', $roles, $user->id_role, ['class' => 'form-control']) !!}
			</div>
		
			<div class="form-group">
				{!! Form::label('active', 'Ativo:', ['class' => 'control-label']) !!}
				{!! Form::select('active', ['1' => 'Sim', '0' => 'Não'], $user->active, ['class' => 'form form-control']) !!}
			</div>
		@endif

		@if (Auth::user()->id_user == $user->id_user)
			<div class="form-group">
				{!! Form::label('secret_question', 'Pergunta Secreta:', ['class' => 'control-label']) !!}
				{!! Form::text('secret_question', $user->secret_question, ['class' => 'form-control']) !!}
			</div>
		@endif

		@if (Auth::user()->id_user == $user->id_user)
			<div class="form-group">
				{!! Form::label('secret_answer', 'Resposta da Pergunta:', ['class' => 'control-label']) !!}
				{!! Form::text('secret_answer', $user->secret_answer, ['class' => 'form-control']) !!}
			</div>
		@endif
		
		{!!Form::button('<i class="fa fa-save"></i> Editar Usuário', array('type' => 'submit', 'class' => 'btn btn-primary btn-flat'))!!}
		
		@if (Auth::user()->isAdmin())
			<a href="{{ url('admin/user') }}">
				<button type="button" class="btn btn-info btn-flat"><i class="fa fa-arrow-left"></i> Voltar aos usuários</button>
			</a>
		@endif
		
		{!! Form::close() !!}
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->

@endsection