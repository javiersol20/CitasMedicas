@extends('layouts.panel')

@section('title', 'Especialidades')
@section('content')


    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar especialidad | {{ $specialty->name }}</h3>
                </div>

                <div class="col text-right">
                    <a href="{{ route('specialties.index') }}" class="btn btn-sm btn-primary">Regresar</a>
                </div>

            </div>
        </div>
        <div class="card-body">
            @if(Session::has('message'))
                <div class="alert alert-info alert-dismissible fade show">
                    <strong style="font-weight: bold"> <i class="fa fa-info"></i>  {{ Session::get('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{ route('specialties.update', ["specialty" => $specialty->id]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name">Nombre de la especialidad</label>
                    <input type="text" name="name" value="{{ $specialty->name }}" id="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="name">Descripcion de la especialidad</label>
                    <textarea class="form-control" name="description" id="description">{{ $specialty->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="name">Estado de la especialidad</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">SELECCIONE ESTADO</option>
                        <option value="1" {{ $specialty->status === 1 ? "selected" : "" }}>ACTIVO</option>
                        <option value="0" {{ $specialty->status === 0 ? "selected" : "" }}>INACTIVO</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-sm btn-outline-success">Actualizar especialidad</button>
            </form>
        </div>
    </div>

@endsection
