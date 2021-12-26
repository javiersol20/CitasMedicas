@extends('layouts.panel')

@section('title', 'Pacientes')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Pacientes</h3>
                </div>

                <div class="col text-right">
                    <a href="{{ route('patients.create') }}" class="btn btn-sm btn-primary">Nuevo paciente</a>
                </div>
            </div>
        </div>
        <div class="card-header">
            @if(Session::has('message'))
                <div class="alert alert-info alert-dismissible fade show">
                    <strong style="font-weight: bold"> <i class="fa fa-info"></i> {{ Session::get('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        <div class="table-responsive">

            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">DNI</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                @if(count($patients) > 0)
                    @foreach($patients as $patient)
                        <tr>
                            <td scope="row">
                                {{ $patient->id }}
                            </td>
                            <td>
                                {{ $patient->name }}
                            </td>
                            <td>
                                {{ $patient->email }}
                            </td>
                            <td>
                                2121
                            </td>
                            <td>
                                ACTIVE
                            </td>
                            <td>
                                <form id="formDeletePatient"  action="{{ route('patients.destroy', ['user' => $patient->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('patients.edit', ['user' => $patient->id]) }}"  class="btn btn-warning btn-sm text-white"><i class="fas fa-edit text-white mr-3"></i> EDITAR </a>

                                    <button onclick="deletePatient()" id="buttonDelete" type="button" class="btn btn-danger btn-sm text-white"><i class="fas fa-trash text-white mr-3"></i> ELIMINAR</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h2 class="text-center">No hay datos en estos momentos...</h2>
                @endif

                </tbody>
            </table>
        </div>
        <div class="card-body">
        {{ $patients->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function deletePatient()
        {

            swal({
                title: "ESTAS SEGURO DE ELIMINAR AL PACIENTE?",
                text: "Una vez eliminada, ya no se puede recuperar!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        var buttonDelete = document.getElementById('buttonDelete');
                        buttonDelete.type = "submit";
                        var formDeletePatient = document.getElementById('formDeletePatient');
                        formDeletePatient.submit();
                    } else {
                        return false;
                    }
                });
        }
    </script>
@endsection
