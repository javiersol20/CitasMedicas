@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0 ">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Gestion de horario</h3>
                </div>

                <div class="col text-right">
                    <a href="{{ route('doctors.create') }}" class="btn btn-sm btn-outline-success">Guardar cambios</a>
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
            <table class="table align-items-center table-dark">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">DIA</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">TURNO TEMPRANO</th>
                    <th scope="col">TURNO TARDE</th>
                </tr>
                </thead>
                <tbody>
                @foreach($days as $key => $day)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $day }} </td>
                        <td>
                            <label class="custom-toggle">
                                <input type="checkbox" checked name="" id="">
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <select name="" class="form-control" id="">
                                        @for($i = 5; $i <= 11; $i++)
                                            <option value="">{{ $i }}:00 am</option>
                                            <option value="">{{ $i }}:30 pm</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="" class="form-control" id="">
                                        @for($i = 5; $i <= 11; $i++)
                                            <option value="">{{ $i }}:00 am</option>
                                            <option value="">{{ $i }}:30 pm</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>

                            <div class="row">
                                <div class="col">
                                    <select name="" class="form-control" id="">
                                        @for($i = 0; $i <= 11; $i++)
                                            <option value="">{{ $i }}:00 Am</option>
                                            <option value="">{{ $i }}:30 Pm</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="" class="form-control" id="">
                                        @for($i = 0; $i <= 11; $i++)
                                            <option value="">{{ $i }}:00 Am</option>
                                            <option value="">{{ $i }}:30 Pm</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-body">
        </div>
    </div>
@endsection

