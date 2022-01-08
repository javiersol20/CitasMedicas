<?php

namespace App\Services;

use App\Interfaces\ScheduleServiceInterface;
use App\Models\Appointment;
use App\Models\WorkDay;
use Carbon\Carbon;

class ScheduleService implements ScheduleServiceInterface {


    public function isAvailableInterval($date, $doctorId,Carbon $start): bool
    {
        $exists = Appointment::where('doctor_id', $doctorId)->where('schedule_date', $date)->where('schedule_time', $start->format('H:i:s'))->exists();

        return !$exists;
    }
    public function getAvailableIntervals($date, $doctorId): array
    {
        $wordDay = WorkDay::status()->days($this->getDayFromDate($date))->doctor($doctorId)->first();

        if(!$wordDay)
        {
            $responseScheduleJson = [];

        }else{
            $morningIntervals = $this->getIntervals($wordDay->morning_start, $wordDay->morning_end, $date, $doctorId);
            $afternoonIntervals = $this->getIntervals($wordDay->afternoon_start, $wordDay->afternoon_end, $date, $doctorId);

            $responseScheduleJson['morning'] = $morningIntervals;
            $responseScheduleJson['afternoon'] = $afternoonIntervals;
        }

        return $responseScheduleJson;
    }

    private function getDayFromDate($date): int
    {
         $dateCarbon = new Carbon($date);

         $i = $dateCarbon->dayOfWeek;
         $day = ($i ==  0 ? 6 : $i-1);

         return $day;
    }



    private function getIntervals($start, $end, $date, $doctorId): array
    {

        $start = new Carbon($start);
        $end = new Carbon($end);

        $intervals = [];

        while ($start < $end)
        {
            $interval = [];
            $interval['start'] = $start->format('g:i A');

            $available = $this->isAvailableInterval($date, $doctorId, $start);

            $start->addMinute(30);
            $interval['end'] = $start->format('g:i A');

            if($available)
            {
                $intervals []= $interval;

            }

        }
        return $intervals;
    }
}
