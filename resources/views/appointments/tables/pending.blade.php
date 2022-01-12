<div class="table-responsive">

    <table class="table align-items-center table-flush">
        <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Especialidad</th>
            @if($role == 'doctor')
                <th>Paciente</th>
            @elseif($role == 'patient')
                <th>Medico</th>
            @endif
            <th>Fecha</th>
            <th>Hora</th>
            <th>Tipo</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pendingAppointments as $key => $pendingAppointment)
            <tr>
                <td>{{$pendingAppointment->id}}</td>
                <td>{{$pendingAppointment->description}}</td>
                <td>{{$pendingAppointment->specialty->name}}</td>
                @if($role == 'doctor')
                    <td>{{ $pendingAppointment->patient->name }}</td>
                @elseif($role == 'patient')
                    <td>{{ $pendingAppointment->doctor->name }}</td>
                @endif
                <td>{{$pendingAppointment->schedule_date}}</td>
                <td>{{$pendingAppointment->schedule_time_12 }}</td>
                <td>{{$pendingAppointment->type}}</td>

                <td>
                    @if($role == 'doctor' || $role == 'admin')
                        <form action="{{ route('appointments.confirmAppointment', ['appointment' => $pendingAppointment->id]) }}" class="d-inline-block" method="POST">
                            @csrf
                            @method('PUT')

                            <button type="submit" title="Confirmar cita" class="btn btn-default btn-sm text-white " data-toggle="tooltip"> <i class="fa fa-check"></i> </button>
                        </form>


                        <a href="{{ route('appointments.update.cancel.appointment.confirm', ['appointment' => $pendingAppointment->id])}}" data-toggle="tooltip" title="Cancelar cita" class="btn btn-danger btn-sm text-white"><i class="fa fa-trash text-white "></i></a>


                    @else


                        <form id="formStatusCancelAppointment" class="d-inline-block" action="{{ route('appointments.update.cancel.appointment', ['appointment' => $pendingAppointment->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <button type="button" id="btnStatusCancelAppointment" onclick="changeStatusCancelAppointment()" title="Cancelar cita" class="btn btn-danger btn-sm text-white" data-toggle="tooltip"><i class="fa fa-trash text-white "></i></button>

                        </form>
                    @endif

                        @if($role == 'admin')

                            <a href="{{ route('appointments.show', ['appointment' => $pendingAppointment->id]) }}" data-toggle="tooltip" title="Detalles" class="btn btn-info btn-sm text-white"><i class="fa fa-eye text-white "></i></a>
                        @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
