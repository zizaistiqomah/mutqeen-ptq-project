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

        // TARGET

        $targets = \App\Models\Target::where('user_id', auth()->id())->get();

        $totalTarget = $targets->count();
        $completedTarget = $targets->where('status', 1)->count();

        $progressTarget = $totalTarget > 0
            ? ($completedTarget / $totalTarget) * 100
            : 0;

        // SETORAN
        $setorans = Setoran::where('user_id', $userId)
            ->latest()
            ->get();

        $setoranTerakhir = Setoran::where('user_id', $userId)
            ->latest()
            ->first();

        $totalSetoran = $setorans->count();


        // MUROJAAH
        $murojaahTerakhir = MurojaahLog::where('user_id', $userId)
            ->latest()
            ->first();

        $startWeek = Carbon::now()->startOfWeek();
        $endWeek = Carbon::now()->endOfWeek();

        $totalMurojaah = MurojaahLog::where('user_id', $userId)
            ->whereBetween('tanggal', [$startWeek, $endWeek])
            ->where('status', 1)
            ->count();

        $progressMurojaah = min(100, ($totalMurojaah / 7) * 100);

        return view('santri.dashboard', compact(
            'setorans',
            'setoranTerakhir',
            'totalSetoran',
            'progress',
            'murojaahTerakhir',
            'totalMurojaah',
            'progressMurojaah',
            'targets',
            'progressTarget'
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

        return back();
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

        return back();
    }
}