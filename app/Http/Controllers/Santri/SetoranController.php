<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setoran;

class SetoranController extends Controller
{
    public function create()
    {
        return view('santri.setoran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'juz' => 'required',
            'tanggal' => 'required',
            'surat_mulai' => 'required',
            'ayat_mulai' => 'required',
            'surat_selesai' => 'required',
            'ayat_selesai' => 'required',

            // TAMBAHAN
            'halaman' => 'required|integer|min:1|max:20',
        ]);

        Setoran::create([

            'user_id' => auth()->id(),

            'juz' => $request->juz,
            'tanggal' => $request->tanggal,

            'surat_mulai' => $request->surat_mulai,
            'ayat_mulai' => $request->ayat_mulai,

            'surat_selesai' => $request->surat_selesai,
            'ayat_selesai' => $request->ayat_selesai,

            // INI PENTING
            'halaman' => $request->halaman,

            'status' => 'pending',
        ]);

        return back()->with('success', 'Setoran berhasil dikirim');
    }
}