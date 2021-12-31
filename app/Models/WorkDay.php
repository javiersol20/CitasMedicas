<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkDay extends Model
{
    use HasFactory;
    protected $fillable = ['doctor_id', 'day', 'status', 'morning_start', 'morning_end', 'afternoon_start', 'afternoon_end'];
}
