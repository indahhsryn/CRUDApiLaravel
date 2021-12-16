<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users', //tabel users uniqe in email (kolom email)
            'password' => 'required|string|max:100',
        ]);
        //to crreate new user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), //using function hash to create password
        ]);
        //create token
        $token = $user->createToken('TokenLogin')->plainTextToken;
        //response after create and have token to login
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
        //201 created success

    }
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|string|max:100',
        ]);
        $user = User::Where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message', 'Invalid email or password'], 401);
            //401 status code error email/password invalid
        } else {
            //create token
            $token = $user->createToken('TokenLogin')->plainTextToken;
            $response =[
                'user' => $user,
                'token' => $token
            ];
            return response($response, 200);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message', 'Logout successfuly'], 200);
    }
}
