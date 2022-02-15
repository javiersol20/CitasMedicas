<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SpecialtyController as ApiSpecialtyController;
use App\Http\Controllers\Api\ScheduleController as ApiScheduleController;


// Public resources
Route::post('/login', [AuthController::class, 'login']);

Route::get('/specialties', [ApiSpecialtyController::class, 'index']);
Route::get('/specialties/{specialty}/doctors', [ApiSpecialtyController::class, 'doctors'])->name('json.doctors');
Route::get('/specialties/{specialty}/doctorsJson', [ApiSpecialtyController::class, 'doctorsJson'])->name('json.doctors');
Route::get('/schedule/hours', [ApiScheduleController::class, 'hours'])->name('json.hours');

Route::middleware('auth:api')->group(function (){

   Route::get('/user', [UserController::class, 'show']);
   Route::post('/logout', [AuthController::class, 'logout']);

});
