<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // =========================
    // Form login
    // =========================
    public function loginForm()
    {
        return view('auth.login');
    }

    // =========================
    // Proses login
    // =========================
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin'  || $user->role === 'rekam_medis') {
                return redirect()->intended('/permintaan');
            }

            if ($user->role === 'user') {
                return redirect()->intended('/layanan');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah',
        ])->onlyInput('username');
    }

    // =========================
    // Logout
    // =========================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}