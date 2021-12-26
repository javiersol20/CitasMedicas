<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait Validations
{

    /**
     * Este metodo esta encargado de validar los datos que llegan por request
     * tanto para el metodo store del medico, como para el paciente
     */

    public function ValidateStoreUser($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|unique:users',
            'dni' => 'required|digits_between:5,255|unique:users',
            'phone' => 'required|string|min:8|max:255|unique:users',
            'password' => 'required|string|min:8|max:255',
            'photo' => 'nullable|mimes:jpg,jpeg,png'
        ]);

    }

    public function ValidateUpdateUser($request, $user)
    {

        return Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|unique:users,email,'.$user->id,
            'dni' => 'required|digits_between:5,255|unique:users,dni,'.$user->id,
            'phone' => 'required|string|min:8|max:255|unique:users,phone,'.$user->id,
            'photo' => 'nullable|mimes:jpg,jpeg,png'
        ]);
    }
}
