@extends('layouts.panel')

@section('title', 'Pacientes')
@section('content')


    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nuevo paciente</h3>
                </div>

                <div class="col text-right">
                    <a href="{{ route('patients.index') }}" class="btn btn-sm btn-primary">Regresar</a>
                </div>

            </div>
        </div>
        <div class="card-body">
            @if(Session::has('message'))
                <div class="alert alert-info alert-dismissible fade show">

                    @foreach(Session::get('message') as $key => $value)
                        - <strong style="font-weight: bold"> <i class="fa fa-info"></i> {{ $value }}</strong> <br>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{ route('patients.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del paciente</label>
                    <input type="text" name="name" id="name" class="form-control" >
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" >
                </div>


                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="number" name="dni" id="dni" class="form-control" >
                </div>


                <div class="form-group">
                    <label for="address">Direccion</label>
                    <textarea name="address" id="address" class="form-control" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="phone">Telefono</label>
                    <input type="number" name="phone" id="phone" class="form-control" >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password" class="form-control" value="{{ Str::random(8) }}" >
                </div>

                <div class="form-group">
                    <label for="photo">Foto</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>

                <button type="submit" class="btn btn-sm btn-outline-success">Registrar paciente</button>
            </form>
        </div>
    </div>

@endsection

