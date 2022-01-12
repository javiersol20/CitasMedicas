<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelledAppointment extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_id',
                            'cancelled_by_id',
                            'justification'];


    public function cancelled_by()
    {
        return $this->belongsTo(User::class);
    }
}
