<!-- resources/views/ambients/create.blade.php -->
@extends('layouts.dashboard')

@section('title','Registrar Usuário')

@section('page_title','Usuário')

@section('page_subtitle','Registrar Usuário')

@section('breadcrumb')
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-user"></i> Usuários</li>
    <li class="active">Registrar Usuário</li>
@endsection

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-user"></i> Registro de Usuário</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        
      </div>
    </div>
    <div class="box-body">
      	{!! Form::open(['url' => 'admin/user/register']) !!}

		<div class="form-group">
			{!! Form::label('name', 'Nome:', ['class' => 'control-label']) !!}
			{!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
			{!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('password', 'Senha:', ['class' => 'control-label']) !!}
			{!! Form::password('password', ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('password_confirmation', 'Confirmação de Senha:', ['class' => 'control-label']) !!}
			{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('id_role', 'Tipo:', ['class' => 'control-label']) !!}
			{!! Form::select('id_role', $roles, null, ['class' => 'form form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('secret_question', 'Pergunta Secreta:', ['class' => 'control-label']) !!}
			{!! Form::text('secret_question', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('secret_answer', 'Resposta da Pergunta:', ['class' => 'control-label']) !!}
			{!! Form::text('secret_answer', null, ['class' => 'form-control']) !!}
		</div>

		{!!Form::button('<i class="fa fa-save"></i> Registrar Usuário', array('type' => 'submit', 'class' => 'btn btn-primary btn-flat'))!!}

		<a href="{{ url('admin/user') }}">
			<button type="button" class="btn btn-info btn-flat"><i class="fa fa-arrow-left"></i> Voltar aos usuários</button>
		</a>

		{!! Form::close() !!}
		
    </div>
    <!-- /.box-body -->
    
  </div>
  <!-- /.box -->
@endsection