<?php

namespace App\Http\Controllers\Pengurus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Halaqah;

class DataSantriController extends Controller
{
    public function index()
    {
        $santris = User::with('halaqah')
            ->where('role', 'santri')
            ->latest()
            ->get();

        $santris = User::with(['halaqah', 'santri'])
            ->where('role', 'santri')
            ->get();

        $halaqahList = Halaqah::all(); 

        return view('pengurus.data-santri', compact('santris', 'halaqahList'));
    }

    public function update(Request $request, int $id)
    {
        $santri = User::findOrFail($id);

        $santri->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back();
    }

    public function updateHalaqah(Request $request, int $id)
    {
        $request->validate([
            'halaqah_id' => 'nullable|exists:halaqahs,id'
        ]);

        $santri = User::where('role', 'santri')->findOrFail($id);

        $santri->update([
            'halaqah_id' => $request->halaqah_id
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pengelompokan santri berhasil diperbarui');
        }

    public function destroy(int $id)
    {
        $santri = User::findOrFail($id);
        $santri->delete();

        return back();
    }
}