<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use function redirect;
use function view;

class SpecialtyController extends Controller
{


    public function index()
    {

        $specialties = Specialty::paginate(10);

        return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('specialties.create');
    }


    public function store(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255|unique:specialties'
        ]);

        if($validation->fails())
        {
            $responseStore = $validation->messages()->first();

        }else{

            try {

                Specialty::create($request->all());
                $responseStore = "Especialidad creada";

            }catch (QueryException $exception)
            {

                $responseStore = "Ha ocurrido un error interno en el servidor";
                Log::error('Error de insertar especialidad en el metodo store: ' . $exception->getMessage());

            }

        }

        return redirect()->route('specialties.create')->with('message', $responseStore);
    }


    public function show(Specialty $specialty)
    {
        //
    }


    public function edit(Specialty $specialty)
    {
        return view('specialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255|unique:specialties,name,'.$specialty->id
        ]);

        if($validation->fails())
        {
            $responseUpdate = $validation->messages()->first();
        }else{

            try {
                $specialty->update($request->all());
                $responseUpdate = "Especialidad actualizada";
            }catch (QueryException $exception)
            {
                $responseUpdate = "Ha ocurrido un error interno en el servidor";
                Log::error('Error de actualizacion de especialidad en el metodo update: ' . $exception->getMessage());
            }
        }

        return redirect()->route('specialties.edit', ["specialty" => $specialty->id])->with('message', $responseUpdate);

    }

    public function destroy(Specialty $specialty)
    {

            try {
                $specialty->delete();
                $responseDelete = "Especialidad eliminada";
            }catch (QueryException $exception)
            {
                $responseDelete = "Error al eliminar, al parecer es interno...";
                Log::error('Error de eliminacion de especialidad en el metodo destroy: '.$exception->getMessage());
            }


        return redirect()->route('specialties.index')->with('message', $responseDelete);
    }
}
