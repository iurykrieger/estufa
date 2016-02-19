<!-- resources/views/auth/login.blade.php -->
@extends('layouts.login')

@section('subtitle','Faça login para abrir sua sessão')

@section('content')
    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}
        <div class="form-group has-feedback">
            <input type="email" class="form-control" value="{{ old('email') }}" placeholder="Email" id="login-email" name="email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Senha" id="login-pass" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-6">
              <div class="checkbox icheck">
                    <label>
                      <input type="checkbox" name="remember" id="remember" class="custom-checkbox"> Lembrar-me
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <a href="{{ url('password/email') }}">Perdeu sua senha?</a><br>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-lg btn-block btn-flat">Login</button>
            </div>
        </div>
    </form>
@stop