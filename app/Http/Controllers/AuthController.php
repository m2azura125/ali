<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'rt') {
                return redirect('/admin');
            }
            return redirect('/resident');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identity' => 'required|string',
            'pin' => 'required|string',
            'role' => 'required|string',
        ]);

        $credentials = [
            'username' => $request->identity,
            'password' => $request->pin,
            'role' => $request->role,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'rt') {
                return redirect()->intended('/admin');
            }
            return redirect()->intended('/resident');
        }

        return back()->withErrors([
            'loginError' => 'ID, PIN atau Role tidak sesuai.',
        ])->onlyInput('identity', 'role');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
