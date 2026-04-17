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
            'tanggal' => 'required|date',
            'juz' => 'required|integer',
            'surat_mulai' => 'required',
            'ayat_mulai' => 'required',
            'surat_selesai' => 'required',
            'ayat_selesai' => 'required',
        ]);

        Setoran::create([
            'user_id' => auth()->id(),
            'tanggal' => $request->tanggal,
            'juz' => $request->juz,
            'surat_mulai' => $request->surat_mulai,
            'ayat_mulai' => $request->ayat_mulai,
            'surat_selesai' => $request->surat_selesai,
            'ayat_selesai' => $request->ayat_selesai,
            'is_tasmi' => $request->has('is_tasmi'),
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Setoran berhasil ditambahkan');
    }
}