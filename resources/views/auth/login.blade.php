@extends('layouts.form')

@section('title', 'Login')

@section('titlePage', 'Inicio de sesion')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary shadow border-0">

                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                        <small>Ingrese sus credenciales</small>
                    </div>
                    <form role="form" method="POST" action="{{ route('login') }}">
                        @csrf

                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <strong>Nota: </strong> {{$errors->first()}}
                            </div>
                        @endif


                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"  name="email" value="{{ old('email') }}"
                                       id="email" autofocus placeholder="Correo electronico" type="email">

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password"
                                       placeholder="Password" type="password">

                            </div>
                        </div>
                        <div class="custom-control custom-control-alternative custom-checkbox">
                            <input class="custom-control-input" name="remember" id=" customCheckLogin" type="checkbox"
                            {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">
                                <span class="text-muted">Recordar sesion</span>
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary my-4">INGRESAR</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <a href="{{ route('password.request') }}" class="text-light"><small>Olvidaste tu password?</small></a>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('register') }}" class="text-light"><small>Crear cuenta</small></a>
                </div>
            </div>
        </div>
    </div>
@endsection
