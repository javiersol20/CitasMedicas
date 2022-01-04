<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use App\Models\User;
use App\Traits\ManagePhotos;
use App\Traits\Validations;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function bcrypt;
use function redirect;
use function view;

class DoctorController extends Controller
{

    use ManagePhotos, Validations;



    public function index()
    {
        $doctors = User::doctors()->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        $specialties = Specialty::status()->get();
        return view('doctors.create', compact('specialties'));
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
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'dni'  => $request->dni,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'role' => "doctor",
                    'photo' => $name,
                ]);

                $user->specialties()->attach($request->specialties);

                $responseStore = ["Medico creado"];
            }catch(QueryException $exception)
            {
                $responseStore = ["Lo siento... al parecer estamos experimentando fallas en procesar tu solicitud"];
                Log::error('El metodo store del controllador doctor ha producido un error: '. $exception->getMessage());
            }
        }

        return redirect()->route('doctors.create')->with('message', $responseStore);

    }


    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $doctor = $user;
        $specialties = Specialty::status()->get();

        $specialty_ids = $doctor->specialties()->pluck('specialties.id');

       return view('doctors.edit', compact('doctor', 'specialties', 'specialty_ids'));
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
                    'photo' => $name,
                ]);
                $user->specialties()->sync($request->specialties);

                $responseUpdate = ['Medico actualizado'];
            }catch (QueryException $exception)
            {
                $responseUpdate = ["Ha ocurrido un error interno en el servidor: 500"];
                Log::error('Error al intentar actualizar un medico: '. $exception->getMessage());
            }

        }
        return redirect()->route('doctors.edit', ['user' => $user->id])->with('message', $responseUpdate);

    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            $responseDelete = "Medico eliminado";
        }catch (QueryException $exception)
        {
            $responseDelete = "Ha ocurrido un error al eliminar, intenta mas tarde";
            Log::error('Error en eliminacion de medico: '. $exception->getMessage());

        }
        return redirect()->route('doctors.index')->with('message', $responseDelete);
    }
}
