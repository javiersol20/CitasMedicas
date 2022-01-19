@extends('layouts.panel')

@section('title', 'Mis pacientes')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Mis pacientes</h3>
                </div>


            </div>
        </div>

        <div class="table-responsive">

            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefono</th>

                </tr>
                </thead>
                <tbody>

                @foreach($myPatients as $key => $myPatient)
                    <tr>
                        <td>{{ $key + 1}}</td>
                        <td>{{ $myPatient->patient->name }}</td>
                        <td>{{ $myPatient->patient->email }}</td>
                        <td>{{ $myPatient->patient->phone }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

    </div>
@endsection


