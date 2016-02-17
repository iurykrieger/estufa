<!-- resources/views/auth/password.blade.php -->
@extends('layouts.login')

@section('title')
    Esqueci Minha Senha
@stop

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
        <div class="login-form">
            <p>
                Digite o email relacionado à sua conta.
            </p>
            <div class="form-group">
                <input \type="email" class="form-control login-field" value="" placeholder="Email" id="login-email" name="email">
                <label class="login-field-icon fui-user" for="login-name"></label>
            </div>
            <button type="submit" value="Redefinir Senha" class="btn btn-primary btn-lg btn-block">Redefinir Senha</button>
            <a class="login-link" href="/auth/login">Voltar ao login</a>
        </div>
    </form>
@stop