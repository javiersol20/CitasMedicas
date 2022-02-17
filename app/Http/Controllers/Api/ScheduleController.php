<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\ScheduleServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Json;

class ScheduleController extends Controller
{
    public function hours(Request $request, ScheduleServiceInterface $scheduleService)
    {

        $validation = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:users,id'
        ]);


        if($validation->fails())
        {
            $responseScheduleJson = $validation->messages();
        }else{
            $date = $request->date;

            $doctorId = $request->doctor_id;

            $responseScheduleJson = $scheduleService->getAvailableIntervals($date, $doctorId);

        }


        return response()->json($responseScheduleJson, 200);

    }


}
