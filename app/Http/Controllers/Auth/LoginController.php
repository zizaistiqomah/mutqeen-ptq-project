<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // VALIDASI
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // hanya dipakai jika ada input role 
        if ($request->filled('role')) {
            $credentials['role'] = $request->role;
        }

        // ATTEMPT LOGIN
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // REDIRECT BERDASARKAN ROLE 
            if ($user->role == 'santri') {
                return redirect()->route('dashboard.santri');
            } 
            elseif ($user->role == 'pengurus') {
                return redirect()->route('dashboard.pengurus');
            } 
            elseif ($user->role == 'penyimak') {
                return redirect()->route('dashboard.penyimak');
            }

            return redirect('/');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function showPengurusLogin()
    {
        return view('pengurus.login-pengurus');
    }

    public function logout()
    {
        \Illuminate\Support\Facades\Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }
}