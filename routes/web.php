<?php

use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\SpecialtyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Api\SpecialtyController as ApiSpecialtyController;
use App\Http\Controllers\Api\ScheduleController as ApiScheduleController;
use App\Http\Controllers\Admin\ChartController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'admin'])->group(function (){

    /**
     * Routes Specialty
     */

# GET
    Route::get('/specialties', [SpecialtyController::class, 'index'])->name('specialties.index');
    Route::get('/specialties/create', [SpecialtyController::class, 'create'])->name('specialties.create');
    Route::get('/specialties/{specialty}/edit', [SpecialtyController::class, 'edit'])->name('specialties.edit');

# POST
    Route::post('/specialties', [SpecialtyController::class, 'store'])->name('specialties.store');

# PUT
    Route::put('/specialties/{specialty}', [SpecialtyController::class, 'update'])->name('specialties.update');

# DELETE
    Route::delete('/specialties/{specialty}', [SpecialtyController::class, 'destroy'])->name('specialties.destroy');

    /**
     * Routes Doctors
     */

# GET
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
    Route::get('/doctors/{user}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');

# POST
    Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');

# PUT
    Route::put('/doctors/{user}', [DoctorController::class, 'update'])->name('doctors.update');

# DELETE
    Route::delete('/doctors/{user}', [DoctorController::class, 'destroy'])->name('doctors.destroy');

    /**
     * Routes Patient
     */

# GET
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::get('/patients/{user}/create', [PatientController::class, 'edit'])->name('patients.edit');

# POST
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');

# PUT
    Route::put('/patients/{user}', [PatientController::class, 'update'])->name('patients.update');

# DELETE
    Route::delete('/patients/{user}', [PatientController::class, 'destroy'])->name('patients.destroy');

    /**
     * CHARTS
     */

    Route::get('/charts/appointments/line', [ChartController::class, 'appointments'])->name('charts.appointments.line');
    Route::get('/charts/doctors/colum', [ChartController::class, 'doctors'])->name('charts.doctors.column');

    # JSON CHARTS COLUMN DATA

    Route::get('/charts/doctors/column/data', [ChartController::class, 'doctorsJson']);

});

Route::middleware(['auth', 'doctor'])->group(function () {

# GET
    Route::get('/schedule', [ScheduleController::class, 'edit'])->name('schedule.edit');

# POST
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
});

Route::middleware('auth')->group(function () {

# GET

    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancelConfirm'])->name('appointments.update.cancel.appointment.confirm');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');

# POST

    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');


# PUT

    Route::put('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.update.cancel.appointment');
    Route::put('/appointments/{appointment}/confirm', [AppointmentController::class, 'confirmAppointment'])->name('appointments.confirmAppointment');


    // JSON
    Route::get('/specialties/{specialty}/doctors', [ApiSpecialtyController::class, 'doctors'])->name('json.doctors');
    Route::get('/schedule/hours', [ApiScheduleController::class, 'hours'])->name('json.hours');



});
