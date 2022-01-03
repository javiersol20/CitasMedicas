<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkDay;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;


class ScheduleController extends Controller
{

    private $days = ['Lunes','Martes','Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];

    public function store(Request $request)
    {

            $active = $request->active ?: [];
            $morning_start = $request->morning_start;
            $morning_end = $request->morning_end;
            $afternoon_start = $request->afternoon_start;
            $afternoon_end = $request->afternoon_end;

            $errors = [];

            for ($i = 0; $i < 7; $i++)
        {

                if(in_array($i, $active))
                {

                    if($morning_start[$i] > $morning_end[$i])
                    {
                        $errors []="Las horas del turno temprano son inconsistentes para el dia ". $this->days[$i];
                    }
                    if($afternoon_start[$i] > $afternoon_end[$i])
                    {
                        $errors []="Las horas del turno en la tarde son inconsistentes para el dia ". $this->days[$i];

                    }

                }

                    try{

                        WorkDay::updateOrCreate(
                            [
                                'doctor_id' => auth()->user()->id,
                                'day' => $i,

                            ],
                            [
                                'status' => in_array($i, $active),
                                'morning_start' => $morning_start[$i],
                                'morning_end' => $morning_end[$i],
                                'afternoon_start' => $afternoon_start[$i],
                                'afternoon_end' => $afternoon_end[$i]
                            ]
                        );
                        $responseWordDay = 'Horario actualizado';
                    }catch (\ErrorException $exception)
                    {
                        Log::error('Error al actualizar o en dado caso no exista al crear el horario del medico: '. $exception->getMessage()." ". $exception->getFile()." ". $exception->getLine());
                        $responseWordDay = 'Ha ocurrido un error interno en el servidor';
                    }

        }

        $message = $responseWordDay;

        if(count($errors) > 0)
        {
            return redirect()->route('schedule.edit')->with(compact( 'errors', 'message'));
        }
        return redirect()->route('schedule.edit')->with(compact('message'));
    }



    public function edit()
    {


        $workDays = WorkDay::where('doctor_id', auth()->user()->id)->get();

        $workDays->map(function ($workDay)
        {
            $workDay->morning_start = (new Carbon($workDay->morning_start))->format('g:i A');
            $workDay->morning_end = (new Carbon($workDay->morning_end))->format('g:i A');
            $workDay->afternoon_start = (new Carbon($workDay->afternoon_start))->format('g:i A');
            $workDay->afternoon_end = (new Carbon($workDay->afternoon_end))->format('g:i A');
            return $workDay;
        });

        $days = $this->days;

        return view('schedule', compact('days', 'workDays'));
    }


}
