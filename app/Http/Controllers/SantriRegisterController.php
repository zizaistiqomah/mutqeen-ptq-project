<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Santri;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SantriRegisterController extends Controller
{
    public function create()
    {
        return view('santri.register-santri');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:santris',
            'no_hp' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'fakultas' => 'required',
            'jurusan' => 'required',
        ]);

        // 1. Simpan ke users
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'santri'
        ]);

        // 2. Simpan ke santri
        Santri::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'no_hp' => $request->no_hp,
            'fakultas' => $request->fakultas,
            'jurusan' => $request->jurusan,
        ]);

        // 3. Auto login
        Auth::login($user);

        // 4. Redirect
            return redirect('/santri/dashboard')->with('success', 'Registrasi berhasil!');

        }
}