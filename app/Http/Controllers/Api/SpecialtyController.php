<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpecialtyResource;
use App\Models\Specialty;

class SpecialtyController extends Controller
{


    public function index()
    {
        return  Specialty::all(['id', 'name']);
    }
    public function doctors(Specialty $specialty)
    {
        return SpecialtyResource::make($specialty);
    }

    public function doctorsJson(Specialty $specialty)
    {
        return $specialty->users()->get([
            'users.id', 'users.name'
        ]);
    }
}
