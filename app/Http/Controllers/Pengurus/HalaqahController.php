<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Halaqah;
use App\Models\User;
use App\Models\Penyimak;

class HalaqahController extends Controller
{
    public function index()
    {
        $halaqahList = Halaqah::with(['penyimak', 'santris'])->get();
        $santris = User::where('role', 'santri')->get();
        $penyimaks = Penyimak::with('user')->get();
        $halaqahList = Halaqah::with(['penyimak', 'santris'])->get();

        return view('pengurus.halaqah', compact(
            'halaqahList',
            'santris',
            'penyimaks'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_halaqah' => 'required',
            'penyimak_id' => 'required|exists:penyimaks,id',
        ]);

        $halaqah = Halaqah::create([
            'nama_halaqah' => $request->nama_halaqah,
            'penyimak_id' => $request->penyimak_id
        ]);

        if ($request->santri_ids) {
            User::whereIn('id', $request->santri_ids)
                ->update(['halaqah_id' => $halaqah->id]);
        }

        return back();
    }

    public function update(Request $request, int $id)
    {
        $halaqah = Halaqah::findOrFail($id);

        $halaqah->update([
            'nama_halaqah' => $request->nama_halaqah,
            'penyimak_id' => $request->penyimak_id
        ]);

        // reset santri lama
        User::where('halaqah_id', $id)->update(['halaqah_id' => null]);

        // assign ulang
        if ($request->santri_ids) {
            User::whereIn('id', $request->santri_ids)
                ->update(['halaqah_id' => $id]);
        }

        return back();
    }

    public function destroy(int $id)
    {
        User::where('halaqah_id', $id)->update(['halaqah_id' => null]);

        Halaqah::destroy($id);

        return back();
    }
}
