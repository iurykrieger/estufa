<!-- resources/views/auth/register.blade.php -->
@extends('layouts.login')

@section('title','Redefinir Senha')

@section('subtitle','Preencha o formulário para redifinir sua senha')

@section('content')
    <form class="form-signup" method="POST" action="/admin/password/reset">
        {!! csrf_field() !!}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="login-form">
            <div class="form-group">
                <input type="email" class="form-control" value="{{ old('email') }}" placeholder="Email" id="email" name="email">
                <label class="login-field-icon fui-mail" for="register-email"></label>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Nova Senha" id="register-pass" name="password">
                <label class="login-field-icon fui-lock" for="register-pass"></label>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Confirmação da Nova Senha" id="register-pass-conf" name="password_confirmation">
                <label class="login-field-icon fui-lock" for="register-pass-conf"></label>
            </div>
            <button type="submit" value="Redefinir a Senha" class="btn btn-primary btn-lg btn-block btn-flat">Redefinir Sua Senha</button>
            <a class="login-link" href="/admin/auth/login">Voltar ao login</a>
        </div>
    </form>
@stop

