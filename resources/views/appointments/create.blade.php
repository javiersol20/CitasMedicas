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

                    @foreach(Session::get('message') as $value)
                        - <strong style="font-weight: bold"> <i class="fa fa-info"></i> {{ $value }}</strong> <br>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="specialty">Especialidad</label>
                        <select name="specialty_id" id="specialty" class="form-control">
                            <option value="null">Seleccione una especialidad</option>
                            @foreach($specialties as $key => $specialty)
                                <option value="{{ $specialty->id }}" {{ old('specialty_id') == $specialty->id ? "selected" : "" }}>{{ $specialty->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="doctor">Medicos</label>
                        <select name="doctor_id" aria-invalid="doctor" class="form-control" id="doctor">
                            @foreach($doctors as $key => $doctor)
                                <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? "selected" : "" }}>{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>


                </div>


                <div class="form-group">
                    <label for="date">Fecha</label>
                    <div class="input-group input-group-alternative">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input type="text" value="{{ old('date', date('Y-m-d')) }}" data-date-lenguage="es" autocomplete="off" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                        data-date-start-date="{{ date('Y-m-d') }}" data-date-end-date="+7d" id="date" name="date">

                    </div>
                </div>


                <div class="form-group">
                    <label for="hour">Hora de atencion</label>
                    <div id="hours">
                        @if($intervals)
                            @foreach($intervals['morning'] as $key => $interval)
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" id="intervalMorning{{$key}}" name="interval" class="custom-control-input" value="{{ $interval['start'] }}">
                                    <label class="custom-control-label" for="intervalMorning{{$key}}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
                                </div>
                            @endforeach
                                @foreach($intervals['afternoon'] as $key => $interval)
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" id="intervalAfternoon{{$key}}" name="interval" class="custom-control-input" value="{{ $interval['start'] }}">
                                        <label class="custom-control-label" for="intervalAfternoon{{$key}}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
                                    </div>
                                @endforeach
                        @else
                        <div class="alert alert-default" role="alert">
                            <strong>Nota: </strong> Selecciona un medico y una fecha para ver sus horarios disponibles.
                        </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="type">Tipo de consulta</label>

                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" id="type1" name="type" class="custom-control-input" {{ old('type', 'consulta') == "consulta" ? "checked" : "" }} value="consulta">
                        <label class="custom-control-label" for="type1">Consulta</label>
                    </div>

                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" id="type2" name="type" class="custom-control-input" {{ old('type') == "examen" ? "checked" : "" }} value="examen">
                        <label class="custom-control-label" for="type2">Examen</label>
                    </div>

                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" id="type3" name="type" class="custom-control-input" {{ old('type') == "operacion" ? "checked" : "" }} value="operacion">
                        <label class="custom-control-label" for="type3">Operacion</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Descripcion</label>
                    <input name="description" id="description" cols="30" rows="10" class="form-control" value="{!! old('description') !!}">
                </div>

                <button type="submit" class="btn btn-sm btn-outline-success">Agendar cita</button>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('js/appointments/create.js') }}"></script>
@endsection

