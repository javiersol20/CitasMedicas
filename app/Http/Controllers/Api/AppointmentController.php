<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{

    public function index()
    {
       $user = Auth::guard('api')->user();
       $appointments =  $user->asPatientAppointments()
           ->with(['specialty' => function($query)
           {
                $query->select('id', 'name');
           },'doctor' => function($query)
           {
               $query->select('id', 'name');
           }
           ])
           ->get([
          'id',
          'doctor_id',
           'specialty_id',
           'description',
           'schedule_date',
           'schedule_time',
           'type',
           'created_at',
           'status'
       ]);

       return $appointments;
    }

    public function store()
    {

    }

}
