<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProcessLoginRequest;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function processLogin(ProcessLoginRequest $request)
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            switch(Auth::user()->role) {
                case 'admin':
                    return redirect()->route('home.index');
                case 'petugas':
                    return redirect()->route('home.index');
                case 'peminjam':
                    return redirect()->route('index.book');
                default:
                    return redirect('/');
            }
        }

        return back()->withInput($request->only('email'))->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function processLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
