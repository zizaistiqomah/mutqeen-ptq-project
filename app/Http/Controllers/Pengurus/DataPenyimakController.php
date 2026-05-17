<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DataPenyimakController extends Controller
{
    public function index()
    {
        $penyimaks = User::where('role', 'penyimak')
            ->with('penyimak')
            ->get();

        return view('pengurus.data-penyimak', compact('penyimaks'));
    }

    public function destroy(int $id)
    {
        $penyimak = User::findOrFail($id);

        $penyimak->delete();

        return back();
    }
}
