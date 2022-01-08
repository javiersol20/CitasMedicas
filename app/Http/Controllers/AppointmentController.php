<?php

namespace App\Http\Controllers;

use App\Interfaces\ScheduleServiceInterface;
use App\Models\Appointment;
use App\Models\Specialty;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{

    public function index()
    {
            return view('appointments.index');
    }

    public function create(ScheduleServiceInterface $scheduleService)
    {
        $specialties = Specialty::status()->get();

        $specialtyId = old('specialty_id');

        if($specialtyId)
        {
            $specialty = Specialty::find($specialtyId);
            $doctors = $specialty->users;

        }else{

            $doctors = collect();
        }

        $scheduleDate = old('date');
        $doctorId = old('doctor_id');

        if($scheduleDate && $doctorId)
        {
            $intervals = $scheduleService->getAvailableIntervals($scheduleDate, $doctorId);
        }else{
            $intervals = null;
        }

            return view('appointments.create', compact('specialties', 'doctors', 'intervals'));
    }

    public function store(Request $request, ScheduleServiceInterface $scheduleService)
    {
        $validation = Validator::make($request->all(), [
           'specialty_id' => 'required|exists:specialties,id',
            'doctor_id' => 'required|exists:users,id',
            'date' => 'required',
            'interval' => 'required',
            'type' => 'required',
            'description' => 'required'
        ]);

        $validation->after(function ($validation) use ($request, $scheduleService) {
            $date = $request->date;
            $doctorId = $request->doctor_id;
            $time = $request->interval;

            if($date && $doctorId && $time)
                {
                    $start = new Carbon($time);
                }else{
                    return;
                }
                if(!$scheduleService->isAvailableInterval($date,$doctorId,$start))
                {
                    $validation->errors()->add('available_time', 'La hora seleccionada ya se encuentra reservada por otra persona');
                }
        });

        if($validation->fails())
        {
            $responseAppointment = $validation->messages()->all();

        }else{

            $carbonTime = Carbon::createFromFormat('g:i A', $request->interval);

            try {
                Appointment::create([
                    'doctor_id' => $request->doctor_id,
                    'specialty_id' => $request->specialty_id,
                    'patient_id' => auth()->user()->id,
                    'description' => $request->description,
                    'schedule_date' => $request->date,
                    'schedule_time' => $request->interval = $carbonTime->format('H:i:s'),
                    'type' => $request->type
                ]);

                $responseAppointment = ['Cita agendada con exito'];

            }catch (QueryException $exception)
            {
                $responseAppointment = ['Ha ocurrido un error interno en el servidor'];
                Log::error('Error al agendar una cita: '. $exception->getMessage());
            }
        }

        $message = $responseAppointment;
        return back()->with(compact('message'))->withInput();
    }


}
