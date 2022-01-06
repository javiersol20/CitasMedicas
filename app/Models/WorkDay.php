<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkDay extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'day', 'status', 'morning_start', 'morning_end', 'afternoon_start', 'afternoon_end'];


    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }

    public function scopeDays($query, $day)
    {
        return $query->where('day', $day);
    }

    public function scopeDoctor($query, $doctor_id)
    {
        return $query->where('doctor_id', $doctor_id);
    }
}
