<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\WorkDay;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Exception\TimeSourceException;

class ScheduleController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $active = $request->active ?: [];
        $morning_start = $request->morning_start;
        $morning_end = $request->morning_end;
        $afternoon_start = $request->afternoon_start;
        $afternoon_end = $request->afternoon_end;


        for ($i = 0; $i < 7; $i++)

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
            }catch (QueryException $exception)
            {
                Log::error('Error al actualizar o en dado caso no exista al crear el horario del medico: '. $exception->getMessage());
                $responseWordDay = 'Ha ocurrido un error interno en el servidor';
            }



        return redirect()->route('schedule.edit')->with('message', $responseWordDay);
    }


    public function show($id)
    {
        //
    }

    public function edit()
    {
        $days = ['Lunes','Martes','Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];

        return view('schedule', compact('days'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
