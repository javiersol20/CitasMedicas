<?php

namespace App\Http\Controllers;

use App\Interfaces\ScheduleServiceInterface;
use App\Models\Appointment;
use App\Models\CancelledAppointment;
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


        $pendingAppointments = Appointment::where('status', "'Reservada'")->where('patient_id', auth()->user()->id)->get();
        $confirmedAppointments = Appointment::where('status', 'Confirmada')->where('patient_id', auth()->user()->id)->get();

        $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])->where('patient_id', auth()->user()->id)->paginate(10);

            return view('appointments.index', compact('pendingAppointments', 'confirmedAppointments', 'oldAppointments'));
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

    public function cancel(Appointment $appointment, Request $request)
    {
        if($request->justification)
        {

            try {
                $appointment->update(['status' => 'Cancelada']);

                CancelledAppointment::create([
                    'appointment_id' => $appointment->id,
                    'cancelled_by' => auth()->user()->id,
                    'justification' => $request->justification
                ]);

                $responseUpdateStatusCancel = "Esta cita confirmada, ha sido cancelada";

            }catch (QueryException $exception)
            {
                Log::error('Error al actualizar la cita confirmada a estado CANCELADA: '. $exception->getMessage());
                $responseUpdateStatusCancel = "Lo sentimos... ha ocurrido un error cancelar la cita";
            }
        }else{
            try {
                $appointment->update(['status' => 'Cancelada']);
                $responseUpdateStatusCancel = "La cita ha sido cancelada";
            }catch (QueryException $exception)
            {
                Log::error('Error al actualizar la cita reservada a estado CANCELADA: '. $exception->getMessage());
                $responseUpdateStatusCancel = "Lo sentimos... ha ocurrido un error cancelar la cita";
            }
        }


        return redirect()->route('appointments.index')->with('message', $responseUpdateStatusCancel);


    }

    public function cancelConfirm(Appointment $appointment)
    {
        if($appointment->status == 'Confirmada')
        {
            return view('appointments.cancel', compact('appointment'));

        }else{
            return redirect()->route('appointments.index');
        }

    }

    public function show(Appointment $appointment)
    {
        return json_decode($appointment);
    }


}
