<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request) {
        $data = $request->only('name','surname', 'twitter','cep_number','email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'surname' => 'required|string',
            'twitter' => 'required|string|unique:users',
            'cep_number' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'cep_number' => $request->cep_number,
            'password' => bcrypt($request->password),
            'twitter' => $request->twitter,
        ]);
        return response(['message'=>'Success create user','user' => $user]);
    }

    public function login(Request $request) {
        $data = $request->only("email", "password");

        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        if (!auth()->attempt($data)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
}
