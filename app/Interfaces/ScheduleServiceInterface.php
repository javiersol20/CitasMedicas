<?php

namespace App\Interfaces;

use Carbon\Carbon;

interface ScheduleServiceInterface{

    public function getAvailableIntervals($date, $doctorId): array;

    public function isAvailableInterval($date, $doctorId, Carbon $start): bool;

}
