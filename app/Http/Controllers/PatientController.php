<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\Validations;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Traits\ManagePhotos;

class PatientController extends Controller
{

    use ManagePhotos, Validations;

    public function index()
    {
        $patients = User::patients()->paginate(10);

        return view('patients.index', compact('patients'));
    }


    public function create()
    {
        return view('patients.create');
    }


    public function store(Request $request)
    {
        $validation = $this->ValidateStoreUser($request);

        if($validation->fails())
        {
           $responseStore = $validation->messages()->all();
        }else{
            if($request->hasFile('photo'))
            {
                $name = $this->StorePhotoProfile($request);
            }else{
                $name = "default.png";
            }

            try {
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'dni'  => $request->dni,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'role' => "patient",
                    'photo' => $name,
                ]);
                $responseStore = ["Medico creado"];
            }catch (QueryException $exception)
            {
                $responseStore = ['Paciente creado'];
                Log::error('Error al crear un paciente en el metodo store: '. $exception->getMessage());
            }
        }
        return redirect()->route('patients.create')->with('message', $responseStore);
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        $patient = $user;

        return view('patients.edit', compact('patient'));
    }


    public function update(Request $request, User $user)
    {
        $validation = $this->ValidateUpdateUser($request, $user);

        if($validation->fails())
        {
            $responseUpdate = $validation->messages()->all();

        }else{
            if($request->hasFile('photo'))
            {
                $name = $this->UpdatePhotoProfile($request, $user);
            }else{
                $name = $user->photo;
            }

            try {

                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    $request->password == "" ? "" : 'password' => bcrypt($request->password),
                    'dni'  => $request->dni,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'photo' => $name
                ]);
                $responseUpdate = ['Paciente actualizado'];
            }catch (QueryException $exception)
            {
                $responseUpdate = ['Ha ocurrido un error en el servidor'];
                Log::error('Error en actualizacion de paciente: '.$exception->getMessage());
            }
        }

        return redirect()->route('patients.edit', ['user' => $user->id])->with('message', $responseUpdate);
    }


    public function destroy(User $user)
    {
        try {
            $user->delete();
            $responseDelete = 'Paciente eliminado';
        }catch (QueryException $exception)
        {
            $responseDelete = 'Ha ocurrido un error interno: 500';
            Log::error('Error al eliminar un paciente: '. $exception->getMessage());
        }

        return redirect()->route('patients.index')->with('message', $responseDelete);
    }
}
