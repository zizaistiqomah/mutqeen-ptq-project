<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Halaqah;
use App\Models\Penyimak;
use App\Models\Setoran;
use App\Exports\LaporanTahfidzExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanTahfidzController extends Controller
{
    public function index(Request $request)
    {
        $santris = User::with([
            'halaqah.penyimak.user',
            'setorans'
        ])
        ->where('role', 'santri')
        ->get();

        $query = Setoran::with(['user', 'penyimak']);

        // filter tanggal awal
        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_awal);
        }

        // filter tanggal akhir
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_akhir);
        }

        // filter penyimak
        if ($request->filled('penyimak')) {
            $query->where('penyimak_id', $request->penyimak);
        }

        // filter halaqah via user
        if ($request->filled('halaqah')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('halaqah_id', $request->halaqah);
            });
        }

        $laporan = $query->latest()->paginate(10);

        // data dropdown
        $halaqahList = Halaqah::all();
        $penyimakList = Penyimak::with('user')->get();

        return view('pengurus.laporan-tahfidz', compact(
            'santris',
            'laporan',
            'halaqahList',
            'penyimakList'
        ));
    }

    public function export()
    {
        return Excel::download(
            new LaporanTahfidzExport,
            'laporan-tahfidz.xlsx'
        );
    }
}