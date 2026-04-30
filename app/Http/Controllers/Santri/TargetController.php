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
            'target_juz' => 'required|integer|min:1|max:30',
        ]);

        $targetHalaman = 20;

        Target::create([

            'user_id' => auth()->id(),

            'juz' => $request->target_juz,
            'surat' => '-',
            'target_juz' => $request->target_juz,
            'target_halaman' => $targetHalaman,
            'progress_halaman' => 0,

        ]);

        return back()->with('success', 'Target berhasil dibuat');
    }

    public function edit($id)
    {
        $target = Target::findOrFail($id);
        return view('santri.target.edit', compact('target'));
    }

    public function update(Request $request, Target $target)
    {
        $request->validate([
            'target_juz' => [
                'required',
                'integer',
                'min:1',
                'max:30',
            ],
        ]);

        $existing = Target::where('user_id', auth()->id())
            ->where('target_juz', $request->target_juz)
            ->exists();

        if ($existing) {
            return back()->with('error', 'Target juz sudah ditambahkan.');
        }

        $targetHalaman = $request->target_juz * 20;

        $target->update([
            'judul' => $request->judul,
            'target_juz' => $request->target_juz,
            'target_halaman' => $targetHalaman,
        ]);

        return back()->with('success', 'Target berhasil diupdate.');
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