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
        @foreach($confirmedAppointments as $key => $confirmedAppointment)
            <tr>
                <td>{{$confirmedAppointment->id}}</td>
                <td>{{$confirmedAppointment->description}}</td>
                <td>{{$confirmedAppointment->specialty->name}}</td>
                @if($role == 'doctor')
                    <td>{{ $confirmedAppointment->patient->name }}</td>
                @elseif($role == 'patient')
                    <td>{{ $confirmedAppointment->doctor->name }}</td>
                @endif
                <td>{{$confirmedAppointment->schedule_date}}</td>
                <td>{{$confirmedAppointment->schedule_time_12 }}</td>
                <td>{{$confirmedAppointment->type }}</td>
                <td>
                    @if($role == 'doctor' || $role == 'admin')
                        <form action="" method="POST" class="d-inline-block">

                            @csrf
                            @method('PUT')

                            <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Cita atendida"><i class="fa fa-check-circle"></i></button>
                        </form>
                    @endif
                    @if($role == 'admin')

                            <a href="{{ route('appointments.show', ['appointment' => $confirmedAppointment->id]) }}" data-toggle="tooltip" title="Detalles" class="btn btn-info btn-sm text-white"><i class="fa fa-eye text-white "></i></a>
                    @endif

                    <a href="{{ route('appointments.update.cancel.appointment.confirm', ['appointment' => $confirmedAppointment->id])}}" data-toggle="tooltip" title="Cancelar cita" class="btn btn-danger btn-sm text-white"><i class="fa fa-trash text-white "></i></a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
