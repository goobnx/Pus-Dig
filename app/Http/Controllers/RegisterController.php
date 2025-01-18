<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function processRegister(RegisterRequest $request)
    {
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('login')->with('success', 'Berhasil Register! Silahkan Login');
    }
}