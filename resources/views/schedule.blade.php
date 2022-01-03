@extends('layouts.panel')

@section('content')
    <form action="{{ route('schedule.store') }}" method="POST">
        @csrf
    <div class="card shadow">
        <div class="card-header border-0 ">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Gestion de horario</h3>
                </div>

                <div class="col text-right">
                    <button type="submit" class="btn btn-sm btn-outline-success">Guardar cambios</button>
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

                @if(Session::has('errors'))
                    <div class="alert alert-warning alert-dismissible fade show">
                        <strong style="font-weight: bold"> <i class="ni ni-notification-70"></i> Los cambios se han guardado pero tienes que tener en cuenta que:</strong>
                        @foreach(session('errors') as $error )
                            <li>{{ $error }}</li>
                        @endforeach
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
                    <th scope="col">DIA</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">TURNO TEMPRANO</th>
                    <th scope="col">TURNO TARDE</th>
                </tr>
                </thead>
                <tbody>
                @foreach($workDays as $key => $workDay)

                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $days[$key] }} </td>
                        <td>
                            <label class="custom-toggle">
                                <input type="checkbox" name="active[]" id="" value="{{ $key }}"
                                {{ $workDay->status ? "checked" : "" }}>
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <select name="morning_start[]" class="form-control" id="">

                                        @for($i = 5; $i <= 11; $i++)
                                            <option value="{{ ($i < 10 ? '0' : '').$i }}:00" {{ $i.':00 AM' == $workDay->morning_start ? "selected" : "" }}>{{ $i }}:00 am</option>
                                            <option value="{{ ($i < 10 ? '0' : '').$i }}:30" {{ $i.':30 AM' == $workDay->morning_start ? "selected" : "" }}>{{ $i }}:30 am</option>
                                        @endfor
                                            <option value="00:00" {{ '12:00 AM' == $workDay->morning_end ? "selected" : "" }}>CERRADO</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="morning_end[]" class="form-control" id="">
                                        @for($i = 5; $i <= 11; $i++)
                                            <option value="{{  ($i < 10 ? '0' : '').$i  }}:00" {{ $i.':00 AM' == $workDay->morning_end ? "selected" : "" }}>{{ $i }}:00 am</option>
                                            <option value="{{  ($i < 10 ? '0' : '').$i  }}:30" {{ $i.':30 AM' == $workDay->morning_end ? "selected" : "" }}>{{ $i }}:30 am</option>
                                        @endfor
                                            <option value="00:00" {{ '12:00 AM' == $workDay->morning_end ? "selected" : "" }}>CERRADO</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>

                            <div class="row">
                                <div class="col">
                                    <select name="afternoon_start[]" class="form-control" id="">
                                        @for($i = 1; $i <= 11; $i++)
                                            <option value="{{ $i+12 }}:00" {{ $i.':00 PM' == $workDay->afternoon_start ? "selected" : "" }}>{{ $i+12 }}:00 pm</option>
                                            <option value="{{ $i+12 }}:30" {{ $i.':30 PM' == $workDay->afternoon_start ? "selected" : "" }} >{{ $i+12 }}:30 pm</option>
                                        @endfor
                                            <option value="00:00" {{ '12:00 AM' == $workDay->afternoon_start ? "selected" : "" }}>CERRADO</option>

                                    </select>
                                </div>
                                <div class="col">
                                    <select name="afternoon_end[]" class="form-control" id="">
                                        @for($i = 1; $i <= 11; $i++)
                                            <option value="{{ $i+12 }}:00" {{ $i.':00 PM' == $workDay->afternoon_end ? "selected" : "" }}>{{ $i+12 }}:00 pm</option>
                                            <option value="{{ $i+12 }}:30" {{ $i.':30 PM' == $workDay->afternoon_end ? "selected" : "" }}>{{ $i+12 }}:30 pm</option>
                                        @endfor
                                            <option value="00:00" {{ '12:00 AM' == $workDay->afternoon_end ? "selected" : "" }}>CERRADO</option>

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
    </form>
@endsection

