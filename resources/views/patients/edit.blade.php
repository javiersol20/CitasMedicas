@extends('layouts.panel')

@section('title', 'Doctores')
@section('content')


    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar medico | {{ $patient->name }}</h3>
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
            <form action="{{ route('patients.update', ['user' => $patient->id]) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre del medico</label>
                    <input type="text" name="name" class="form-control" value="{{ $patient->name }}" >
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $patient->email }}" >
                </div>


                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" name="dni" id="dni" class="form-control" value="{{ $patient->dni }}" >
                </div>


                <div class="form-group">
                    <label for="address">Direccion</label>
                    <textarea name="address" id="address" class="form-control" cols="30" rows="10"> {{ $patient->address }}</textarea>
                </div>

                <div class="form-group">
                    <label for="phone">Telefono</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $patient->phone }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password" class="form-control" >
                    <p>Ingrese un valor solo si desea modificar la password del medico.</p>
                </div>

                <div class="form-group">
                    <label for="photo">Foto</label>
                    <input type="file" name="photo" id="photo" class="form-control" value="{{ $patient->photo }}">
                    <span class="avatar avatar-lg  mt-4">
                    <img src="{{ asset('storage/photosProfile/'.$patient->photo) }}" alt="{{ $patient->photo }}">
                    </span>
                </div>

                <button type="submit" class="btn btn-sm btn-outline-success">Registar medico</button>
            </form>
        </div>
    </div>

@endsection
