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
                    <label for="specialty">Especialidad</label>
                    <select name="specialty_id" id="specialty" class="form-control">
                        @foreach($specialties as $key => $specialty)
                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="doctor">Medicos</label>
                    <select name="doctor_id" aria-invalid="doctor" class="form-control" id="doctor">
                        <option value="">Seleccionar especialidad</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="date">Fecha</label>
                    <div class="input-group input-group-alternative">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input type="text" value="{{ date('Y-m-d') }}"  autocomplete="off" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                        data-date-start-date="{{ date('Y-m-d') }}" data-date-end-date="+30d" id="date" name="">

                    </div>
                </div>


                <div class="form-group">
                    <label for="hour">Hora de atencion</label>
                    <div id="hours"></div>
                </div>

                <div class="form-group">
                    <label for="phone">Telefono</label>
                    <input type="number" id="phone" name="phone" class="form-control">
                </div>

                <button type="submit" class="btn btn-sm btn-outline-success">Registrar paciente</button>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('js/appointments/create.js') }}"></script>
@endsection

