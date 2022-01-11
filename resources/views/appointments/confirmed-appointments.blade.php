<div class="table-responsive">

    <table class="table align-items-center table-flush">
        <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Especialidad</th>
            <th>Medico</th>
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
                <td>{{$confirmedAppointment->doctor->name}}</td>
                <td>{{$confirmedAppointment->schedule_date}}</td>
                <td>{{$confirmedAppointment->schedule_time_12 }}</td>
                <td>{{$confirmedAppointment->type }}</td>
                <td>

                    <a href="{{ route('appointments.update.cancel.appointment.confirm', ['appointment' => $confirmedAppointment->id])}}" title="Cancelar cita" class="btn btn-danger btn-sm text-white"><i class="ni ni-fat-remove text-white mr-3"></i>CANCELAR</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
