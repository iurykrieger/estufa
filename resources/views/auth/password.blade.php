<!-- resources/views/auth/password.blade.php -->
@extends('layouts.login')

@section('subtitle','Digite o email relacionado à sua conta')

@section('content')

    @include('common.messages')
    <form class="form-password" method="POST" action="/password/email">
        {!! csrf_field() !!}
        @if (session('status')) 
            <div class="alert alert-success">
                <strong>Tudo certo!</strong>
                <br>
                O email com seu token de redefinição de senha foi enviado.
            </div>
        @endif
        <div class="form-group has-feedback">
            <div class="form-group">
                <input type="email" class="form-control" value="{{ old('email') }}" placeholder="Email" id="login-email" name="email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <button type="submit" value="Redefinir Senha" class="btn btn-primary btn-lg btn-block btn-flat">Redefinir Senha</button><br>
            <a class="login-link" href="/auth/login">Voltar ao login</a>
        </div>
    </form>
@stop