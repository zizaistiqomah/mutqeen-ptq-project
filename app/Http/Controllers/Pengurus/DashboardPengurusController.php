<?php

namespace App\Http\Controllers\Pengurus;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Halaqah;
use App\Models\User;
use App\Models\Setoran;
use App\Models\Target;
use Carbon\Carbon;

class DashboardPengurusController extends Controller
{
    public function index(Request $request)
    {
        // =========================
        // BASIC DATA
        // =========================
        $totalHalaqah = Halaqah::count();
        $totalSantri = User::where('role', 'santri')->count();

        // =========================
        // SETORAN HARIAN
        // =========================
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $setoranHariIni = Setoran::whereDate('created_at', $today)
            ->where('status', 'diterima')
            ->count();

        $setoranKemarin = Setoran::whereDate('created_at', $yesterday)
            ->where('status', 'diterima')
            ->count();

        $growthHarian = $setoranKemarin > 0
            ? (($setoranHariIni - $setoranKemarin) / $setoranKemarin) * 100
            : 0;

        // =========================
        // TOTAL SEMESTER
        // =========================
        $totalSemester = Setoran::where('status', 'diterima')
            ->whereBetween('created_at', [now()->subMonths(4), now()])
            ->count();

        // =========================
        // HALAQAH
        // =========================
        $halaqahList = Halaqah::with(['penyimak', 'santris'])->get();

        // =========================
        // WEEKLY DATA
        // =========================
        $bulan = $request->input('bulan', now()->month);

        $startMonth = Carbon::create(now()->year, $bulan, 1)->startOfMonth();
        $endMonth = Carbon::create(now()->year, $bulan, 1)->endOfMonth();

        $weeklyData = [];

        for ($i = 0; $i < 4; $i++) {

            $start = (clone $startMonth)->addWeeks($i)->startOfWeek();
            $end = (clone $start)->endOfWeek();

            if ($start < $startMonth) $start = $startMonth;
            if ($end > $endMonth) $end = $endMonth;

            $weeklyData[] = Setoran::where('status', 'diterima')
                ->whereBetween('created_at', [$start, $end])
                ->count();
        }

        // =========================
        // TOP SANTRI
        // =========================
        $topSantri = Setoran::select('user_id', DB::raw('COUNT(*) as total_setoran'))
            ->where('status', 'diterima')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('user_id')
            ->with('user.halaqah')
            ->orderByDesc('total_setoran')
            ->take(3)
            ->get();

        // =========================
        // DATA & PROGRES 
        // =========================

        $santriProgress = User::where('role', 'santri')
            ->with(['halaqah', 'targets', 'setorans'])
            ->get();

        foreach ($santriProgress as $santri) {

            $targets = Target::where('user_id', $santri->id)->latest()->get();

            $totalTarget = $targets->count();
            $completedTarget = $targets->where('status', 1)->count();

            $progressTarget = $totalTarget > 0
                ? round(($completedTarget / $totalTarget) * 100, 0)
                : 0;

            $totalHalaman = $santri->setorans
                ->where('status', 'diterima')
                ->sum('halaman_diterima');

            $targetHalaman = $totalTarget * 20;

            $capaianHalaman = $targetHalaman > 0
                ? round(($totalHalaman / $targetHalaman) * 100, 0)
                : 0;

            $capaianHalaman = min($capaianHalaman, 100);
            $santri->target_halaman = $targetHalaman;

            $santri->target_juz = $totalTarget;
            $santri->total_halaman = $totalHalaman;
            $santri->target_halaman = $targetHalaman;
            $santri->capaian = $capaianHalaman;
            $santri->progress = $capaianHalaman;
        }

        // =========================
        // RETURN VIEW
        // =========================
        return view('pengurus.dashboard', compact(
            'totalHalaqah',
            'totalSantri',
            'setoranHariIni',
            'growthHarian',
            'totalSemester',
            'halaqahList',
            'weeklyData',
            'bulan',
            'topSantri',
            'santriProgress',
            'totalHalaman'
        ));
    }
}