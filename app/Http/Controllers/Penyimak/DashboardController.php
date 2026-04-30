<?php

namespace App\Http\Controllers\Penyimak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Halaqah;
use App\Models\Penyimak;
use App\Models\Setoran;
use App\Models\Santri;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // ambil data penyimak berdasarkan user login
        $penyimak = Penyimak::where('user_id', $user->id)->first();

        // default value
        $halaqah = null;
        $antrianHariIni = 0;
        $totalVerifikasi = 0;
        $setoranPending = collect();
        $totalSetoranMingguIni = 0;
        $persentaseMingguan = 0;
        $anggotaHalaqah = collect();

        // cek apakah penyimak ada
        if ($penyimak) {

            // ambil halaqah milik penyimak
            $halaqah = Halaqah::where('penyimak_id', $penyimak->id)->first();

            // cek apakah halaqah ada
            if ($halaqah) {

                $anggotaHalaqah = Santri::with(['user', 'setorans'])
                    ->where('halaqah_id', $halaqah->id)
                    ->get()
                    ->map(function ($santri) {

                        // total setoran semester ini
                        $santri->total_setoran = $santri->setorans
                            ->whereIn('status', ['diterima', 'revisi'])
                            ->whereBetween('updated_at', [
                                now()->startOfYear(),
                                now()->endOfYear()
                            ])
                            ->count();

                        return $santri;
                    })
                    ->sortByDesc('total_setoran');

                // ambil semua user_id santri di halaqah
                $santriIds = Santri::where('halaqah_id', $halaqah->id)
                    ->pluck('user_id');

                // hitung antrean hari ini
                $antrianHariIni = Setoran::whereIn('user_id', $santriIds)
                    ->where('status', 'pending')
                    ->whereDate('tanggal', today())
                    ->count();

                // total setoran terverifikasi
                $totalVerifikasi = Setoran::whereIn('user_id', $santriIds)
                    ->whereIn('status', ['diterima', 'revisi'])
                    ->count();

                // ambil data antrean setoran
                $setoranPending = Setoran::with('santri')
                    ->whereIn('user_id', $santriIds)
                    ->where('status', 'pending')
                    ->latest()
                    ->get();
                // daftar anggota halaqah + total setoran
                $anggotaHalaqah = Santri::with(['user', 'setorans'])
                    ->where('halaqah_id', $halaqah->id)
                    ->get()
                    ->map(function ($santri) {

                        $santri->total_setoran = $santri->setorans
                            ->whereIn('status', ['diterima', 'revisi'])
                            ->whereBetween('updated_at', [
                                now()->startOfYear(),
                                now()->endOfYear()
                            ])
                            ->count();

                        return $santri;
                    })
                    ->sortByDesc('total_setoran');

                $totalSetoranMingguIni = Setoran::whereIn('user_id', $santriIds)
                    ->whereIn('status', ['diterima', 'revisi'])
                    ->whereBetween('updated_at', [
                        now()->startOfWeek(),
                        now()->endOfWeek()
                    ])
                    ->count();
                
                // total minggu lalu
                $totalMingguLalu = Setoran::whereIn('user_id', $santriIds)
                    ->whereIn('status', ['diterima', 'revisi'])
                    ->whereBetween('updated_at', [
                        now()->subWeek()->startOfWeek(),
                        now()->subWeek()->endOfWeek()
                    ])
                    ->count();
                
                if ($totalMingguLalu > 0) {

                    $persentaseMingguan = round(
                        (($totalSetoranMingguIni - $totalMingguLalu) / $totalMingguLalu) * 100
                    );
                }
            }
        }

        return view('penyimak.dashboard', compact(
            'user',
            'penyimak',
            'halaqah',
            'antrianHariIni',
            'totalVerifikasi',
            'setoranPending',
            'totalSetoranMingguIni',
            'persentaseMingguan',
            'anggotaHalaqah'
        ));
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'nilai' => 'nullable',
            'catatan' => 'nullable',
        ]);

        $setoran = Setoran::findOrFail($id);

        // ambil penyimak login
        $penyimak = Penyimak::where('user_id', auth()->id())->first();

        // update verifikasi
        $setoran->update([
            'status' => $request->status,
            'nilai' => $request->nilai,
            'catatan' => $request->catatan,
            'penyimak_id' => $penyimak->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | AUTO UPDATE PROGRESS TARGET
        |--------------------------------------------------------------------------
        */

        // hanya jika diterima
        if ($request->status === 'diterima') {

            $target = \App\Models\Target::where('user_id', $setoran->user_id)
                ->where('target_juz', $setoran->juz)
                ->first();

            // jika target ditemukan
            if ($target) {

                $target->progress_halaman += $setoran->halaman;

                // max 20 halaman per juz
                if ($target->progress_halaman > 20) {
                    $target->progress_halaman = 20;
                }

                $target->save();
            }
        }

        return redirect()
            ->route('dashboard.penyimak')
            ->with('success', 'Setoran berhasil diverifikasi');
    }

}