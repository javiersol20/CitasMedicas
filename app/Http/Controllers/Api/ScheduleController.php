<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WorkDay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function hours(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'date' => 'required',
            'doctor_id' => 'required|exists:users,id'
        ]);


        if($validation->fails())
        {
            $responseScheduleJson = $validation->messages();
        }else{
            $date = $request->date;
            $dateCarbon = new Carbon($date);

            $i = $dateCarbon->dayOfWeek;
            $day = ($i ==  0 ? 6 : $i-1);
            $doctorId = $request->doctor_id;

            $wordDay = WorkDay::status()->days($day)->doctor($doctorId)->first();

            if(!$wordDay)
            {
                $responseScheduleJson = [];
            }else{
                $morningIntervals = $this->getIntervals($wordDay->morning_start, $wordDay->morning_end);
                $afternoonIntervals = $this->getIntervals($wordDay->afternoon_start, $wordDay->afternoon_end);

                $responseScheduleJson['morning'] = $morningIntervals;
                $responseScheduleJson['afternoon'] = $afternoonIntervals;
            }
        }


        return response()->json($responseScheduleJson, 200);

    }

    private function getIntervals($start, $end): array
    {

        $start = new Carbon($start);
        $end = new Carbon($end);

        $intervals = [];

        while ($start < $end)
        {
            $interval = [];
            $interval['start'] = $start->format('g:i A');
            $start->addMinute(30);
            $interval['end'] = $start->format('g:i A');

            $intervals [] = $interval;

        }
        return $intervals;
    }
}
