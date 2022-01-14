@extends('layouts.panel')

@section('title', 'Reporte de barras')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Reporte: Medicos mas activos</h3>
                </div>

            </div>
        </div>
        <div class="card-header">

            <div class="input-daterange datepicker row align-items-center" data-date-format="yyyy-mm-dd">
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control event" id="startDate" name="startDate" placeholder="Fecha inicio" type="text" value="{{ $start }}" >
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control event" id="endDate" name="endDate" placeholder="Fecha final" type="text" value="{{ $end }}" >
                        </div>
                    </div>
                </div>
            </div>

            <div id="containerChartColumDoctors"></div>

        </div>


    </div>
@endsection

@section('scripts')

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script src="{{ asset('js/charts/doctors.js') }}"></script>

@endsection
