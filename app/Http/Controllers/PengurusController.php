<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pengurus;

class PengurusController extends Controller
{
    public function create()
    {
        return view('pengurus.register-pengurus');
    }

    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'fakultas' => 'required|string',
            'jurusan' => 'required|string',
            'jabatan' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            // SIMPAN KE USERS
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'pengurus',
            ]);

            // SIMPAN KE PENGURUS
            Pengurus::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'no_hp' => $request->no_hp,
                'fakultas' => $request->fakultas,
                'jurusan' => $request->jurusan,
                'jabatan' => $request->jabatan,
            ]);

            // AUTO LOGIN
            Auth::login($user);

            DB::commit();

            return redirect()->route('dashboard.pengurus');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
}