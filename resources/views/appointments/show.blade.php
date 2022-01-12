@extends('layouts.panel')

@section('title', 'Detalle cita')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">CITA # {{ $appointment->id }}</h3>
                </div>

                <div class="col text-right">
                </div>
            </div>
        </div>
        <div class="card-body">

            <ul>
                <li>
                    <strong>Fecha: </strong> {{ $appointment->schedule_date }}
                </li>

                <li>
                    <strong>Hora: </strong> {{ $appointment->schedule_time_12 }}
                </li>

                <li>
                    <strong>Tipo: </strong> {{ $appointment->type }}
                </li>

                <li>
                    <strong>Estado: </strong> <span class="badge badge-{{$appointment->status == 'Cancelada' ? 'danger' : 'success'}}">{{ $appointment->status }}</span>
                </li>



                @if($role == 'doctor' || $role == 'admin')

                    <li>
                        <strong>Paciente: </strong> {{ $appointment->patient->name }}
                    </li>

                @endif
                @if($role == 'patient' || $role == 'admin')
                    <li>
                        <strong>Medico: </strong> {{ $appointment->doctor->name }}
                    </li>
                @endif
                <li>
                    <strong>Especialidad: </strong> {{ $appointment->specialty->name }}
                </li>

                <li>
                    <strong>Detalle: </strong> {{ $appointment->description }}
                </li>
            </ul>
                <div class="alert alert-{{ $appointment->status == 'Cancelada' ? 'danger' : "info" }}">
                @if($appointment->status == 'Cancelada')
                    <p>Acerca de la cancelacion</p>

                    <ul>
                        @if($appointment->cancellation)
                            <li>
                                <strong>Fecha de eliminacion: </strong> {{ $appointment->cancellation->created_at }}
                            </li>

                            <li>
                                <strong>Motivo de cancelacion: </strong> {{ $appointment->cancellation->justification }}
                            </li>

                            <li>
                                <strong>Persona que cancelo: </strong> {{ $appointment->cancellation->cancelled_by->name }}
                            </li>
                        @else
                            <li>
                                <strong>Nota: </strong> Esta cita fue cancelada antes de su confirmacion
                            </li>
                        @endif
                    </ul>
                    @elseif($appointment->status == 'Atendida' || $appointment->status == "'Reservada'" || $appointment->status == 'Confirmada')
                        <ul>
                            <li>
                                <strong>Nota: </strong> Esta cita fue {{ $appointment->status }} exitosamente
                            </li>
                        </ul>
                    @endif
                </div>



            <a href="{{ route('appointments.index') }}" class="btn btn-outline-primary btn-block"><i class="fa fa-retweet"></i> Regresar</a>
        </div>

    </div>
@endsection


