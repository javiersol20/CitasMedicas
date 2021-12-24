@extends('layouts.panel')

@section('title', 'Doctores')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Medicos</h3>
                </div>

                <div class="col text-right">
                    <a href="{{ route('doctors.create') }}" class="btn btn-sm btn-primary">Nuevo medico</a>
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
                @if(count($doctors) > 0)
                    @foreach($doctors as $doctor)
                        <tr>
                            <td scope="row">
                                {{ $doctor->id }}
                            </td>
                            <td>
                                {{ $doctor->name }}
                            </td>
                            <td>
                                {{ $doctor->email }}
                            </td>
                            <td>
                                2121
                            </td>
                            <td>
                                ACTIVE
                            </td>
                            <td>
                                <form id="formDeleteDoctor"  action="{{ route('doctors.destroy', ['user' => $doctor->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('doctors.edit', ['user' => $doctor->id]) }}"  class="btn btn-warning btn-sm text-white"><i class="fas fa-edit text-white mr-3"></i> EDITAR </a>

                                    <button onclick="deleteDoctor()" id="buttonDelete" type="button" class="btn btn-danger btn-sm text-white"><i class="fas fa-trash text-white mr-3"></i> ELIMINAR</button>
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
    </div>
@endsection

@section('scripts')
    <script>
        function deleteDoctor()
        {
            swal("HAS")
        }
    </script>
@endsection
