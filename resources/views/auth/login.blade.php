<!-- resources/views/auth/login.blade.php -->
@extends('layouts.login')

@section('title')
    Login
@stop

@section('content')
    <form class="form-signin" method="POST" action="/auth/login">
        {!! csrf_field() !!}
        <div class="login-form">
            <div class="form-group">
                <input type="email" class="form-control login-field" value="{{ old('email') }}" placeholder="Email" id="login-email" name="email">
                <label class="login-field-icon fui-user" for="login-name"></label>
            </div>
            <div class="form-group">
                <input type="password" class="form-control login-field" placeholder="Senha" id="login-pass" name="password">
                <label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>
            <div class="form-group">
                <label class="checkbox" for="remember">
                    <input type="checkbox" name="remember" id="remember" class="custom-checkbox">
                    <span class="icons">
                        <span class="icon-unchecked"></span>
                        <span class="icon-checked"></span>
                    </span>
                    Lembrar-me
                </label>
            </div>
            <button type="submit" value="Login" class="btn btn-primary btn-lg btn-block">Login</button>
            <a class="login-link" href="/password/email">Perdeu sua senha?</a>
        </div>
    </form>
@stop