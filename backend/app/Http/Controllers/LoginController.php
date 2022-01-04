<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' =>  ['required']
        ]);

        if(Auth::attempt($request->only('email','password'))){
            $token = Auth::user()->createToken('apptoken')->plainTextToken;
            return response()->json(['user' => Auth::user(),'token' => $token],200);
        }

        throw ValidationException::withMessages([
            'email' => ['the provided information are incorrect']
        ]);
    }

    public function logout()
    {
        Auth::logout();
    }
}
