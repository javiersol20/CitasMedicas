@extends('layouts.panel')

@section('title', 'Doctores')

@section('content')


    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nuevo doctor</h3>
                </div>

                <div class="col text-right">
                    <a href="{{ route('doctors.index') }}" class="btn btn-sm btn-primary">Regresar</a>
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
            <form action="{{ route('doctors.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del medico</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" >
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" >
                </div>

                <div class="form-group">
                    <label for="specialidad">Especialidades</label>
                    <select class="form-control selectpicker " data-live-search="true"  multiple data-style="btn-secondary">
                        @foreach($specialties as $key => $specialty)
                        <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                        @endforeach
                    </select>


                </div>

                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="number" name="dni" id="dni" class="form-control" value="{{ old('dni') }}" >
                </div>


                <div class="form-group">
                    <label for="address">Direccion</label>
                    <textarea name="address" id="address" class="form-control" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="phone">Telefono</label>
                    <input type="number" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password" class="form-control" value="{{ Str::random(8) }}" >
                    <p>Si no tienes una password en mente, puedes dejar por defecto la que aparece asignada por el sistema</p>
                </div>

                <div class="form-group">
                    <label for="photo">Foto</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>

                <button type="submit" class="btn btn-sm btn-outline-success">Registar medico</button>
            </form>
        </div>
    </div>

@endsection

