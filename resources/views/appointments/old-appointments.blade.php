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
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($oldAppointments as $key =>  $oldAppointment)
            <tr>
                <td>{{$oldAppointment->id}}</td>
                <td>{{$oldAppointment->description}}</td>
                <td>{{$oldAppointment->specialty->name}}</td>
                <td>{{$oldAppointment->doctor->name}}</td>
                <td>{{$oldAppointment->schedule_date}}</td>
                <td>{{$oldAppointment->schedule_time_12 }}</td>
                <td>{{$oldAppointment->type }}</td>
                <td style="{{ $oldAppointment->status == 'Cancelada' ? 'color: red' : "" }}">{{ $oldAppointment->status }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('appointments.show', ['appointment' => $oldAppointment->id]) }}">Ver detalle</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>


<div class="card-body">
    {{ $oldAppointments->links() }}
</div>
