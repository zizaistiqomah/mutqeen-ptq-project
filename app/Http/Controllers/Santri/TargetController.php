<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Target;

class TargetController extends Controller
{
    public function index()
    {
        $target = Target::where('user_id', auth()->id())->first();
        return view('santri.target.index', compact('target'));
    }

    public function create()
    {
        return view('santri.target.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_target' => 'required',
            'jumlah_target' => 'required|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
        ]);

        Target::create([
            'user_id' => auth()->id(),
            'jenis_target' => $request->jenis_target,
            'jumlah_target' => $request->jumlah_target,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('santri.target.index')->with('success', 'Target berhasil ditambahkan');
    }

    public function edit($id)
    {
        $target = Target::findOrFail($id);
        return view('santri.target.edit', compact('target'));
    }

    public function update(Request $request, $id)
    {
        $target = Target::findOrFail($id);

        $target->update($request->all());

        return redirect()->route('santri.target.index')->with('success', 'Target berhasil diupdate');
    }

    public function destroy($id)
    {
        $target = Target::findOrFail($id);
        $target->delete();

        return redirect()->route('santri.target.index')->with('success', 'Target berhasil dihapus');
    }
}