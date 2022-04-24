<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fieldes = $request->validate([
            'name'=> 'required|string',
            'email' => 'required|string|unique:users,email',
            'password'=> 'required|string',
            'phone_number'=> 'required'
        ]);

        $user = User::create([
            'name'=> $fieldes['name'],
            'email' => $fieldes['email'],
            'password' => bcrypt($fieldes['password']),
            'phone_number' => $fieldes['phone_number'],
        ]);

        $token = $user->createToken('myappToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,

        ];

        return response([$response,'message'=>'user created successfully'],200);
    }

    public function login(Request $request)
    {
        $fieldes = $request->validate([

            'email' => 'required|string',
            'password'=> 'required|string',

        ]);
        //check email
        $user = User::where('email', $fieldes['email'])->first();
        //check password
        if(!$user || !Hash::check($fieldes['password'],$user->password)){
            return response([
                'message'=>'unavailable account'
            ], 401);
        }

        $token = $user->createToken('myappToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,

        ];

        return response([$response,'message'=>'access account'] ,200);
    }
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return[
            'message'=> 'logged out'
        ];
    }
}
