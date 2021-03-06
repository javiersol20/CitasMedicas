<?php

namespace App\Models;

use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'specialty_id', 'patient_id', 'description', 'schedule_date', 'schedule_time', 'type', 'status'];

    protected $hidden = [
        'specialty_id',
        'doctor_id',
        'schedule_time'
    ];

    protected $appends = [
        'schedule_time_12'
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->belongsTo(User::class);
    }

    public function cancellation()
    {
        return $this->hasOne(CancelledAppointment::class);
    }

    public function getScheduleTime12Attribute()
    {

        return (new Carbon($this->schedule_time))->format('g:i A');
    }

}
