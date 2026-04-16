<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\Target;
use App\Models\Setoran;

class SantriDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Ambil target santri
        $target = Target::where('user_id', $userId)->first();

        // Ambil semua data setoran santri
        $setorans = Setoran::where('user_id', $userId)->get();

        // Hitung total setoran
        $totalSetoran = $setorans->count();

        // Default progress
        $progress = 0;

        // Hitung progress (sementara berbasis jumlah setoran)
        if ($target && $target->jumlah_target > 0) {
            $progress = min(100, ($totalSetoran / $target->jumlah_target) * 100);
        }

        return view('santri.dashboard', [
            'target' => $target,
            'totalSetoran' => $totalSetoran,
            'progress' => round($progress, 1) // biar rapi (misal 33.3%)
        ]);
    }
}