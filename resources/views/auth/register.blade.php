@extends('layouts.form')

@section('title', 'Registro')

@section('titlePage', 'Registro')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card bg-secondary shadow border-0">

                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                        <small>Ingresa lo siguiente</small>
                    </div>
                    <form role="form" method="POST" action="{{ route('register') }}">
                        @csrf

                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                @foreach ($errors->all() as $error)
                                    <strong>Nota: </strong> {{$error}} <br>
                                @endforeach

                            </div>
                        @endif

                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" placeholder="Nombre" type="text" name="name" id="name"
                                value="{{ old('name') }}" autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" placeholder="Email" id="email" name="email" type="email" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control {{ $errors->has('password') ? "is-invalid" : "" }}" placeholder="Password" name="password" id="password" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" placeholder="Repita la password" type="password" name="password_confirmation" id="password-confirm">
                            </div>
                        </div>
                        <div class="text-muted font-italic"><small>recuerda colocar una password: <span class="text-success font-weight-700">strong</span></small></div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4">Crear Cuenta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
