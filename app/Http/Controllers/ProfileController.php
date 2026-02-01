<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Faculty;
use App\Models\Major;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return view("profile.index", [
            'user' => $request->user(),
        ]);
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'faculties' => Faculty::all(),
            'majors' => Major::all()
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->role_id == 3) {
            $request->validate([
                'nim' => ['required', 'string', 'max:255', 'unique:santris,nim,' . $user->santri->id],
                'jumlah_hafalan' => ['nullable', 'numeric'],
                'informasi_hafalan' => ['nullable', 'array'],
                'major_id' => ['required', 'exists:majors,id'],
            ]);

            $santri = $user->santri;
            $santri->nim = $request->nim;
            $santri->major_id = $request->major_id;
            
            if($request->filled('jumlah_hafalan')){
                $santri->jumlah_hafalan = $request->jumlah_hafalan;
            }

            if($request->filled('informasi_hafalan')){
                $santri->informasi_hafalan = $request->informasi_hafalan;
            }

            if (!$santri->save()) {
                return back()->withErrors(['msg' => 'Failed to update santri data. Please try again.']);
            }
        } elseif ($user->role_id == 2) {
            $request->validate([
                'nim' => ['required', 'string', 'max:255', 'unique:panitias,nim,' . $user->panitia->id],
                'major_id' => ['required', 'exists:majors,id'],
            ]);

            $panitia = $user->panitia;
            $panitia->nim = $request->nim;
            $panitia->major_id = $request->major_id;

            if (!$panitia->save()) {
                return back()->withErrors(['msg' => 'Failed to update panitia data. Please try again.']);
            }
        }

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if (!$user->save()) {
            return back()->withErrors(['msg' => 'Failed to update user data. Please try again.']);
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
