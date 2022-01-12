@extends('layouts.panel')

@section('title', 'Justificacion de cancelacion')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Paso a cancelar cita</h3>
                </div>

                <div class="col text-right">
                </div>
            </div>
        </div>
        <div class="card-header">

            @if($role == 'patient' )
            <p>Estas a punto de cancelar tu cita ya confirmada para : {{ $appointment->schedule_date }} a las: {{ $appointment->schedule_time_12 }}</p>
            @elseif($role == 'doctor' || $role == 'admin')
                <p>Estas a punto de cancelar una cita ya confirmada para : {{ $appointment->schedule_date }} a las: {{ $appointment->schedule_time_12 }}</p>

            @endif
                <form id="formStatusCancelAppointmentConfirm" action="{{ route('appointments.update.cancel.appointment', ['appointment' => $appointment->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="justification">Por favor cuentamos el motivo de la cancelacion</label>
                        <textarea name="justification" id="justification" class="form-control" cols="30" rows="10"></textarea>
                        <div id="messageError"></div>
                    </div>

                    <button onclick="changeStatusCancelAppointmentConfirm()" class="btn btn-outline-danger" type="button">Cancelar cita</button>
                    <a href="{{ route('appointments.index') }}" class="btn btn-outline-info">Volver sin cancelar</a>
                </form>

        </div>



    </div>
@endsection

@section('scripts')
    <script>
        function changeStatusCancelAppointmentConfirm()
        {
            let justification = $('#justification');
            let formStatusCancelAppointmentConfirm = $('#formStatusCancelAppointmentConfirm');

            if(justification.val().trim() === "")
            {
                let messageError = $('#messageError');
                messageError.html('<p class="alert alert-warning py-2 mt-3">* El campo de justificacion es obligatorio para cancelar una cita confirmada</p>');
                return false;
            }else{
                formStatusCancelAppointmentConfirm.submit();
            }

        }
    </script>
@endsection
