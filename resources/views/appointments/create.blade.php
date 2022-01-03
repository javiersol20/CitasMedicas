@extends('layouts.panel')

@section('title', 'Reservar cita')
@section('content')


    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Reservar cita</h3>
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
                    <label for="name">Especialidad</label>
                    <select name="" id="" class="form-control">
                        @foreach($specialties as $key => $specialty)
                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Medicos</label>
                    <select name="" class="form-control" id="">

                    </select>
                </div>


                <div class="form-group">
                    <label for="dni">Fecha</label>
                    <div class="input-group input-group-alternative">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input type="text" name="dni" id="dni" autocomplete="off" class="form-control datepicker" >

                    </div>
                </div>


                <div class="form-group">
                    <label for="address">Hora de atencion</label>
                    <input type="time" class="form-control">
                </div>



                <button type="submit" class="btn btn-sm btn-outline-success">Registrar paciente</button>
            </form>
        </div>
    </div>

@endsection

