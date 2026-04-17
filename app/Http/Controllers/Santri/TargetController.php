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
            'juz' => 'required|integer',
            'surat' => 'required|string',
        ]);

        \App\Models\Target::create([
            'user_id' => auth()->id(),
            'juz' => $request->juz,
            'surat' => $request->surat,
            'status' => 0
        ]);

        return back();
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

    public function toggle($id)
    {
        $target = \App\Models\Target::findOrFail($id);

        $target->status = !$target->status;
        $target->save();

        return back();
    }
}