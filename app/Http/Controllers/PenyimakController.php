<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Penyimak;

class PenyimakController extends Controller
{
    public function create()
    {
        return view('penyimak.register-penyimak');
    }
    public function store(Request $request)
    {
        // VALIDASI DASAR
        $rules = [
            'name' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'tipe' => 'required|in:eksternal,pengurus',
        ];

        // VALIDASI KONDISIONAL
        if ($request->tipe == 'eksternal') {
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = 'required|confirmed|min:6';
        }

        if ($request->tipe == 'pengurus') {
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = 'required|confirmed|min:6';
            $rules['nim'] = 'required';
            $rules['fakultas'] = 'required';
            $rules['jurusan'] = 'required';
        }

        $request->validate($rules);

        DB::beginTransaction();

        try {
            // Buat user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'penyimak',
            ]);

            // Buat penyimak
            Penyimak::create([
                'user_id' => $user->id,
                'no_hp' => $request->no_hp,
                'tipe' => $request->tipe,
                'nim' => $request->nim ?? null,
                'fakultas' => $request->fakultas ?? null,
                'jurusan' => $request->jurusan ?? null,
            ]);

            Auth::login($user);

            DB::commit();

            return redirect()->route('dashboard.penyimak');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}