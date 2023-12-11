<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    //
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'commercial_number' => 'required',
            'address' => 'required',          
        ]);       

        $user = User::create([
            'password'=> bcrypt($fields['password']),
            'name'=> $fields['name'],
            'phone'=>$fields['phone'],
            'email'=>$fields['email'],
            'commercial_number'=>$fields['commercial_number'],
            'address'=>$fields['address'],
        ]);

        $token = $user->createToken('vision_things')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout (Request $request) {
        auth()->user()->tokens()->delete();
        return ['message' => 'logged out'];
    }

    public function login (Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password )) {
            return response([
                'message' => 'Bad Creds'
            ], 401);
        }

        $token = $user->createToken('vision_things_login')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }
}
