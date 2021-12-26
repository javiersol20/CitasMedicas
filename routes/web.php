<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
