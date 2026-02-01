<?php

namespace App\Http\Controllers\Setoran;

use App\Http\Controllers\Controller;
use App\Models\Penguji;
use App\Models\SantriVerifiedSetoran;
use App\Models\SantriVerifiedUjian;
use App\Models\Setoran;
use App\Models\Surat;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetoranController extends Controller
{
    public function indexSantri()
    {
        $santriVerified = SantriVerifiedSetoran::where('santri_id', Auth::user()->santri->id)->latest()->first();

        $ujianVerified = SantriVerifiedUjian::where('santri_id', Auth::user()->santri->id)->latest()->first();

        $setoran = Setoran::where('santri_id', Auth::user()->santri->id)->get();

        $ujian = Ujian::where('santri_id', Auth::user()->santri->id)->get();

        $ujian->load('penguji.user', 'santri.user', 'nilais', 'surats');

        $setoran->load('penguji.user', 'santri.user', 'nilais', 'surats');

        return view('dashboard.santri', compact('setoran', 'ujian', 'ujianVerified', 'santriVerified'));
    }
    public function indexSantriUjian()
    {
        $ujianVerified = SantriVerifiedUjian::where('santri_id', Auth::user()->santri->id)->latest()->first();

        $ujian = Ujian::where('santri_id', Auth::user()->santri->id)->get();

        $ujian->load('penguji.user', 'santri.user', 'nilais', 'surats');

        if ($ujianVerified) {
            if ($ujianVerified->penguji_verified == '1' && $ujianVerified->panitia_verified == '1') {
                $activeStepper = ['Registrasi', 'Ujian'];

                $ujianFirst = Ujian::where('santri_id', Auth::user()->santri->id)->latest()->first();

                if ($ujianFirst && $ujianFirst->nilai != null) {
                    if ($ujianVerified->penguji_done == '1' && $ujianVerified->panitia_done == '1') {
                        $activeStepper = ['Registrasi', 'Ujian', 'Hasil Ujian', 'Pengumuman'];

                        return view('dashboard.santri-dashboard-ujian', compact('ujian', 'ujianVerified', 'activeStepper'));
                    }
                    if ($ujianVerified->penguji_done == '0' || $ujianVerified->panitia_done == '0') {
                        $activeStepper = ['Registrasi', 'Ujian', 'Hasil Ujian', 'Pengumuman'];

                        return view('dashboard.santri-dashboard-ujian', compact('ujian', 'ujianVerified', 'activeStepper'));

                    }

                    $activeStepper = $ujianFirst->nilai != null && $ujianFirst->isDone == '1' ? ['Registrasi', 'Ujian', 'Hasil Ujian'] : ['Registrasi', 'Ujian'];
                    return view('dashboard.santri-dashboard-ujian', compact('ujian', 'ujianVerified', 'activeStepper'));
                }

                return view('dashboard.santri-dashboard-ujian', compact('ujian', 'ujianVerified', 'activeStepper'));
            } else if ($ujianVerified->penguji_verified != '1' || $ujianVerified->panitia_verified != '1') {
                $activeStepper = ['Registrasi'];
                return view('dashboard.santri-dashboard-ujian', compact('ujian', 'ujianVerified', 'activeStepper'));
            }

        }

        $activeStepper = [];


        return view('dashboard.santri-dashboard-ujian', compact('ujian', 'ujianVerified', 'activeStepper'));
    }
    public function indexSantriSetoran()
    {
        $santriVerified = SantriVerifiedSetoran::where('santri_id', Auth::user()->santri->id)->latest()->first();

        $setoran = Setoran::where('santri_id', Auth::user()->santri->id)->get();

        $setoran->load('penguji.user', 'santri.user', 'nilais', 'surats');

        return view('dashboard.santri-dashboard-setoran', compact('setoran', 'santriVerified'));
    }

    public function create()
    {
        $surat = Surat::all();
        $penguji = Penguji::all();
        $penguji->load('user');
        $santri = SantriVerifiedSetoran::where('penguji_verified', 1)->where('panitia_verified', 1)->get();
        $santri->load('santri');

        return view('dashboard.penguji-setoran-create', compact('penguji', 'santri', 'surat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penguji_id' => 'required',
            'santri_id' => 'required',
            'surat' => 'required',
            'tanggal_setoran' => 'required|date',
            'jumlah_setoran' => 'required',
            'catatan' => 'nullable',
            'status' => 'required',
            'nilai_kelancaran' => 'required',
            'nilai_makhraj' => 'required',
            'nilai_lagu' => 'required',
            'nilai_adab' => 'required',
        ]);



        $average = ($request->nilai_kelancaran + $request->nilai_makhraj + $request->nilai_lagu + $request->nilai_adab) / 4;

        $setoran = Setoran::create([
            'penguji_id' => $request->penguji_id,
            'santri_id' => $request->santri_id,
            'surat' => $request->surat,
            'tanggal_setoran' => $request->tanggal_setoran,
            'jumlah_setoran' => $request->jumlah_setoran,
            'catatan' => $request->catatan,
            'status' => $request->status,
            'nilai' => $average,
        ]);

        $setoran->surats()->attach($request->surat);

        $setoran->nilais()->attach([
            1 => ['nilai' => $request->nilai_kelancaran],
            2 => ['nilai' => $request->nilai_makhraj],
            3 => ['nilai' => $request->nilai_lagu],
            4 => ['nilai' => $request->nilai_adab],
        ]);

        return \App\Helper\RouteHelper::getRedirect(Auth::user()->role->id)->with('success', 'Data has been saved successfully');
    }

    public function show(Setoran $setoran)
    {
        $setoran->load('penguji.user', 'santri.user', 'nilais', 'surats');

        return view('setoran.show', compact('setoran'));
    }

    public function edit(Setoran $setoran)
    {
        $surat = Surat::all();
        $penguji = Penguji::all();
        $penguji->load('user');
        $santri = SantriVerifiedSetoran::where('penguji_verified', 1)->where('panitia_verified', 1)->get();
        $santri->load('santri');
        $setoran->load('penguji.user', 'santri.user', 'nilais', 'surats');

        return view('dashboard.penguji-setoran-update', compact('setoran', 'penguji', 'santri', 'surat'));
    }

    public function update(Request $request, Setoran $setoran)
    {
        $request->validate([
            'penguji_id' => 'required',
            'santri_id' => 'required',
            'surat' => 'required',
            'tanggal_setoran' => 'required',
            'jumlah_setoran' => 'required',
            'catatan' => 'nullable',
            'status' => 'required',
            'nilai_kelancaran' => 'required',
            'nilai_makhraj' => 'required',
            'nilai_lagu' => 'required',
            'nilai_adab' => 'required',
        ]);

        $average = ($request->nilai_kelancaran + $request->nilai_makhraj + $request->nilai_lagu + $request->nilai_adab) / 4;

        $setoran->update([
            'penguji_id' => $request->penguji_id,
            'santri_id' => $request->santri_id,
            'surat' => $request->surat,
            'tanggal_setoran' => $request->tanggal_setoran,
            'jumlah_setoran' => $request->jumlah_setoran,
            'catatan' => $request->catatan,
            'status' => $request->status,
            'nilai' => $average,
        ]);

        $setoran->surats()->sync($request->surat);

        $setoran->nilais()->sync([
            1 => ['nilai' => $request->nilai_kelancaran],
            2 => ['nilai' => $request->nilai_makhraj],
            3 => ['nilai' => $request->nilai_lagu],
            4 => ['nilai' => $request->nilai_adab],
        ]);

        return \App\Helper\RouteHelper::getRedirect(Auth::user()->role->id);
    }

    public function destroy(Setoran $setoran)
    {
        $setoran->delete();

        return \App\Helper\RouteHelper::getRedirect(Auth::user()->role->id);
    }
}

