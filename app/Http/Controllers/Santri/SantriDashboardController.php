<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Target;
use App\Models\Setoran;
use App\Models\MurojaahLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SantriDashboardController extends Controller
{
    public function index()
    {
        $user = User::with(['halaqah.penyimak.user'])
            ->find(auth()->id());

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

        // =====================
        // PENCAPAIAN MINGGU INI 
        // =====================

        // RANGE MINGGU
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();

        // JUMLAH SETORAN MINGGU INI
        $setoranMingguIni = Setoran::where('user_id', $userId)
            ->whereBetween('tanggal', [$startOfWeek, $endOfWeek])
            ->count();

        //  JUZ UNIK MINGGU INI
        $juzMingguIni = Setoran::where('user_id', $userId)
            ->whereBetween('tanggal', [$startOfWeek, $endOfWeek])
            ->distinct('juz')
            ->count('juz');

        //  TOTAL HALAMAN MINGGU INI
        $halamanMingguIni = Setoran::where('user_id', $userId)
            ->whereBetween('tanggal', [$startOfWeek, $endOfWeek])
            ->sum('halaman');

        //  STREAK SETORAN (HARI BERUNTUN)
        $dates = Setoran::where('user_id', $userId)
            ->orderBy('tanggal', 'desc')
            ->pluck('tanggal')
            ->map(fn($d) => Carbon::parse($d)->format('Y-m-d'))
            ->unique()
            ->values();

        $streak = 0;
        $currentDate = Carbon::today();

        foreach ($dates as $date) {
            if ($currentDate->format('Y-m-d') == $date) {
                $streak++;
                $currentDate->subDay();
            } else {
                break;
            }
        }

        // =====================
        // STREAK SETORAN (GRACE 3 HARI)
        // =====================
        $dates = Setoran::where('user_id', $userId)
            ->orderBy('tanggal', 'desc')
            ->pluck('tanggal')
            ->map(fn($d) => Carbon::parse($d)->format('Y-m-d'))
            ->unique()
            ->values();

        $streak = 0;

        if ($dates->isNotEmpty()) {

            $today = Carbon::today();
            $lastSetoranDate = Carbon::parse($dates->first());

            $gap = $today->diffInDays($lastSetoranDate);
            if ($gap > 3) {
                $streak = 0;
            } else {

                $currentDate = $lastSetoranDate;

                foreach ($dates as $date) {

                    $dateCarbon = Carbon::parse($date);

                    if ($currentDate->format('Y-m-d') == $dateCarbon->format('Y-m-d')) {
                        $streak++;
                        $currentDate->subDay();
                    } else {
                        break;
                    }
                }
            }
        }

        return view('santri.dashboard', compact(
            'user',
            'targets',
            'progressTarget',
            'setorans',
            'setoranTerakhir',
            'totalSetoran',
            'progress',
            'murojaahTerakhir',
            'totalMurojaah',
            'progressMurojaah',
            'murojaahHariIni',
            'setoranMingguIni',
            'juzMingguIni',
            'halamanMingguIni',
            'streak',
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