<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\Target;
use App\Models\Setoran;
use App\Models\MurojaahLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SantriDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            abort(403);
        }

        $userId = $user->id;

        // =====================
        // TARGET
        // =====================
        $targets = Target::where('user_id', $userId)->latest()->get();

        $totalTarget = $targets->count();
        $completedTarget = $targets->where('status', 1)->count();

        $progressTarget = $totalTarget > 0
            ? round(($completedTarget / $totalTarget) * 100, 0)
            : 0;

        // =====================
        // SETORAN
        // =====================
        $setorans = Setoran::where('user_id', $userId)
            ->latest()
            ->get();

        $setoranTerakhir = $setorans->first();

        $totalSetoran = $setorans->count();

        // 🔥 FIX: TAMBAHIN INI (BIAR ERROR HILANG)
        $progress = 0;

        // =====================
        // MUROJAAH
        // =====================
        
        $today = Carbon::today()->toDateString();

        $murojaahToday = MurojaahLog::where('user_id', $userId)
            ->where('tanggal', $today)
            ->pluck('target_id')
            ->toArray();

        $today = now()->toDateString();

        $murojaahHariIni = MurojaahLog::where('user_id', $userId)
            ->whereDate('tanggal', $today)
            ->latest()
            ->get();

        $murojaahTerakhir = MurojaahLog::where('user_id', $userId)
            ->latest()
            ->first();

        $startWeek = Carbon::now()->startOfWeek();
        $endWeek = Carbon::now()->endOfWeek();

        $totalMurojaah = MurojaahLog::where('user_id', $userId)
            ->whereBetween('tanggal', [$startWeek, $endWeek])
            ->where('status', 1)
            ->count();

        $progressMurojaah = min(100, round(($totalMurojaah / 7) * 100, 0));

        return view('santri.dashboard', compact(
            'targets',
            'progressTarget',

            'setorans',
            'setoranTerakhir',
            'totalSetoran',
            'progress',

            'murojaahTerakhir',
            'totalMurojaah',
            'progressMurojaah',
            'murojaahHariIni'
        ));
    }

    // =====================
    // STORE MUROJAAH
    // =====================
    public function storeMurojaah(Request $request)
    {
        $request->validate([
            'juz' => 'required|integer',
            'surat' => 'required|string',
            'ayat' => 'required|string',
        ]);

        MurojaahLog::create([
            'user_id' => auth()->id(),
            'tanggal' => Carbon::today()->toDateString(),
            'juz' => $request->juz,
            'surat' => $request->surat,
            'ayat' => $request->ayat,
            'status' => 0,
        ]);

        return back()->with('success', 'Murojaah berhasil disimpan');
    }

    // =====================
    // CHECK MUROJAAH
    // =====================
    public function checkMurojaah()
    {
        $userId = auth()->id();

        $log = MurojaahLog::where('user_id', $userId)
            ->latest()
            ->first();

        if ($log) {
            $log->update(['status' => 1]);
        }

        return back()->with('success', 'Murojaah selesai');
    }

    public function toggleMurojaah(Request $request)
{
    $userId = auth()->id();
    $today = now()->toDateString();

    $existing = MurojaahLog::where('user_id', $userId)
        ->where('target_id', $request->target_id)
        ->where('tanggal', $today)
        ->first();

    if ($existing) {
        // kalau sudah ada → hapus (uncheck)
        $existing->delete();
    } else {
        // kalau belum → insert
        MurojaahLog::create([
            'user_id' => $userId,
            'target_id' => $request->target_id,
            'tanggal' => $today,
            'status' => 1
        ]);
    }

    return back();
}


}