@extends('layouts.panel')

@section('title', 'Especialidades')
@section('content')


    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nueva especialidad</h3>
                </div>

                <div class="col text-right">
                    <a href="{{ route('specialties.index') }}" class="btn btn-sm btn-primary">Regresar</a>
                </div>

            </div>
        </div>
        <div class="card-body">
            @if(Session::has('message'))
               <div class="alert alert-info alert-dismissible fade show">
                   <strong style="font-weight: bold"> <i class="fa fa-info"></i> {{ Session::get('message') }}</strong>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
            @endif
        <form action="{{ route('specialties.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre de la especialidad</label>
                <input type="text" autofocus name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="name">Descripcion de la especialidad</label>
                <textarea class="form-control" name="description" id="description">N/A</textarea>
            </div>

            <button type="submit" class="btn btn-sm btn-outline-success">Guardar especialidad</button>
        </form>
        </div>
    </div>

@endsection
