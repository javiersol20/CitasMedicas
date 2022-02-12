<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            $success = false;
            $message = "Invalid Credentials";

            return compact('success', 'message');
        }else{

            $user = Auth::guard('api')->user();
            $jwt = $this->respondWithToken($token);
            $success = true;
            return compact('success','user', 'jwt');
        }


    }

    public function logout()
    {
        Auth::guard('api')->logout();
        $success = true;

        return compact('success');
    }

    protected function respondWithToken($token)
    {
        return $token;
    }

}
