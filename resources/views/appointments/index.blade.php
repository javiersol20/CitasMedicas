@extends('layouts.panel')

@section('title', 'Citas')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Mis citas</h3>
                </div>

                <div class="col text-right">
                    <a href="{{ route('patients.create') }}" class="btn btn-sm btn-primary">Nueva cita</a>
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

                </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
        </div>
        <div class="card-body">
        </div>
    </div>
@endsection



