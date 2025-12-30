<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Major;
use App\Models\Santri;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SantriRegisterController extends Controller
{
    public function create()
    {
        $faculties = Faculty::all();
        $majors = Major::all();

        return view('auth.santri-register', compact('faculties', 'majors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'phone' => ['required', 'string', 'max:15'],
            'major_id' => ['required', 'numeric'],
            'nim' => ['required', 'string', 'max:15'],
        ]);

        $user = User::create([
            'role_id' => config('constants.ROLE_SANTRI'),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        Santri::create([
            'user_id' => $user->id,
            'major_id' => $request->major_id,
            'nim' => $request->nim,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::SANTRI);
    }
}
