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
        @foreach($pendingAppointments as $key => $pendingAppointment)
            <tr>
                <td>{{$pendingAppointment->id}}</td>
                <td>{{$pendingAppointment->description}}</td>
                <td>{{$pendingAppointment->specialty->name}}</td>
                <td>{{$pendingAppointment->doctor->name}}</td>
                <td>{{$pendingAppointment->schedule_date}}</td>
                <td>{{$pendingAppointment->schedule_time_12 }}</td>
                <td>{{$pendingAppointment->type}}</td>

                <td>
                    <form id="formStatusCancelAppointment" action="{{ route('appointments.update.cancel.appointment', ['appointment' => $pendingAppointment->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <button type="button" id="btnStatusCancelAppointment" onclick="changeStatusCancelAppointment()" title="Cancelar cita" class="btn btn-danger btn-sm text-white"><i class="ni ni-fat-remove text-white mr-3"></i>CANCELAR</button>

                    </form>
                    <button class="btn btn-info btn-sm">Ver datalle</button>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
