<!-- resources/views/auth/register.blade.php -->
@extends('layouts.login')

@section('title')
    Registro
@stop

@section('content')
    <form class="form-signup" method="POST" action="/admin/auth/register">
        {!! csrf_field() !!}
        <div class="login-form">
            <div class="form-group">
                <input type="text" class="form-control" value="{{ old('name') }}" placeholder="Nome" id="register-name" name="name">
                <label class="login-field-icon fui-user" for="register-name"></label>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" value="{{ old('email') }}" placeholder="Email" id="register-email" name="email">
                <label class="login-field-icon fui-mail" for="register-email"></label>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Senha" id="register-pass" name="password">
                <label class="login-field-icon fui-lock" for="register-pass"></label>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Confirmação da Senha" id="register-pass-conf" name="password_confirmation">
                <label class="login-field-icon fui-lock" for="register-pass-conf"></label>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Pergunta Secreta" id="register-secret-question" name="secret_question">
                <label class="login-field-icon fui-new" for="register-secret-question"></label>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Resposta da Pergunta Secreta" id="register-secret-answer" name="secret_answer">
                <label class="login-field-icon fui-list" for="register-secret-answer"></label>
            </div>
            <button type="submit" value="Registrar" class="btn btn-primary btn-lg btn-block">Registrar</button>
            <a class="login-link" href="/admin/auth/login">Voltar ao login</a>
        </div>
    </form>
@stop

