<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\DoctorController;

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
