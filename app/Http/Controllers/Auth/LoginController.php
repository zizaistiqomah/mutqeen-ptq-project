<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        if (Auth::user()->role == 'santri') {
            return redirect('/santri/dashboard');
        } 
        elseif (Auth::user()->role == 'pengurus') {
            return redirect('/pengurus/dashboard');
        } 
        elseif (Auth::user()->role == 'penyimak') {
            return redirect('/penyimak/dashboard');
        }
    }

    return back()->with('error', 'Email atau password salah');
}

}


