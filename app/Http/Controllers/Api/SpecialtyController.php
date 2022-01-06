<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpecialtyResource;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{


    public function doctors(Specialty $specialty)
    {
        return SpecialtyResource::make($specialty);
    }
}
