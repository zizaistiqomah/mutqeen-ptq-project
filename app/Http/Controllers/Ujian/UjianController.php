<?php

namespace App\Http\Controllers\Ujian;

use App\Http\Controllers\Controller;
use App\Models\Penguji;
use App\Models\SantriVerifiedUjian;
use App\Models\Surat;
use App\Models\Tempat;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UjianController extends Controller
{
    public function index()
    {
        $ujian = Ujian::where('santri_id', Auth::user()->santri->id)->get();

        $santriVerified = SantriVerifiedUjian::where('santri_id', Auth::user()->santri->id)->first();

        $ujian->load('penguji.user', 'santri.user', 'nilais', 'surats', 'tempat');

        return view('dashboard.santri-ujian', compact('ujian', 'santriVerified'));
    }

    public function create()
    {
        $surat = Surat::all();
        $penguji = Penguji::all();
        $tempat = Tempat::all();
        $penguji->load('user');
        $subQuery = SantriVerifiedUjian::select(DB::raw('MAX(id) as id'))
            ->where('penguji_verified', 1)
            ->where('panitia_verified', 1)
            ->groupBy('santri_id');

        $santri = SantriVerifiedUjian::whereIn('id', $subQuery)->get();
        $santri->load('santri');



        return view('dashboard.penguji-ujian-create', compact('penguji', 'santri', 'surat', 'tempat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penguji_id' => 'required',
            'santri_id' => 'required',
            'tempat_id' => 'required',
            'jam' => 'required',
            'tanggal_ujian' => 'required|date',
        ]);


        Ujian::create([
            'penguji_id' => $request->penguji_id,
            'santri_id' => $request->santri_id,
            'tempat_id' => $request->tempat_id,
            'jam' => $request->jam,
            'tanggal_ujian' => $request->tanggal_ujian,
        ]);

        return \App\Helper\RouteHelper::getRedirect(Auth::user()->role->id)->with('success', 'Data has been saved successfully');
    }

    public function updatePanitia(Request $request, Ujian $ujian)
    {

        $request->validate([
            'penguji_id' => 'required',
            'santri_id' => 'required',
            'tempat_id' => 'required',
            'jam' => 'required',
            'tanggal_ujian' => 'required|date',
        ]);

        $ujian->update([
            'penguji_id' => $request->penguji_id,
            'santri_id' => $request->santri_id,
            'tempat_id' => $request->tempat_id,
            'jam' => $request->jam,
            'tanggal_ujian' => $request->tanggal_ujian,
        ]);

        return \App\Helper\RouteHelper::getRedirect(Auth::user()->role->id)->with('success', 'Data has been saved successfully');
    }

    public function show(Ujian $ujian)
    {
        $ujian->load('penguji.user', 'santri.user', 'nilais', 'surats', 'tempat');

        return view('ujian.show', compact('ujian'));
    }

    public function edit(Ujian $ujian)
    {
        $ujian->load('penguji.user', 'santri.user', 'nilais', 'surats', 'tempat');
        $surat = Surat::all();
        $penguji = Penguji::all();
        $tempat = Tempat::all();
        $penguji->load('user');
        $subQuery = SantriVerifiedUjian::select(DB::raw('MAX(id) as id'))
            ->where('penguji_verified', 1)
            ->where('panitia_verified', 1)
            ->groupBy('santri_id');

        $santri = SantriVerifiedUjian::whereIn('id', $subQuery)->get();
        $santri->load('santri.user');

        return view('dashboard.penguji-ujian-update', compact('ujian', 'penguji', 'santri', 'surat', 'tempat'));
    }

    public function update(Request $request, Ujian $ujian)
    {

        $request->validate([
            'catatan' => 'required',
            'nilai_kelancaran' => 'required',
            'nilai_makhraj' => 'required',
            'nilai_lagu' => 'required',
            'nilai_adab' => 'required',
            'isDone' => 'required'
        ]);

        $average = ($request->nilai_kelancaran + $request->nilai_makhraj + $request->nilai_lagu + $request->nilai_adab) / 4;


        $ujian->update([
            'catatan' => $request->catatan,
            'nilai' => $average,
            'isDone' => $request->isDone
        ]);

        if (isset($request->surat)) {
            $suratUjian = $ujian->surats->pluck('id')->toArray();

            if (empty($suratUjian)) {
                $ujian->surats()->attach($request->surat);
            } else {
                $ujian->surats()->sync($request->surat);
            }
        }

        $nilaiUjian = $ujian->nilais->pluck('id')->toArray();


        if (empty($nilaiUjian)) {
            $ujian->nilais()->attach([
                1 => ['nilai' => $request->nilai_kelancaran],
                2 => ['nilai' => $request->nilai_makhraj],
                3 => ['nilai' => $request->nilai_lagu],
                4 => ['nilai' => $request->nilai_adab],
            ]);
        } else {
            $ujian->nilais()->sync([
                1 => ['nilai' => $request->nilai_kelancaran],
                2 => ['nilai' => $request->nilai_makhraj],
                3 => ['nilai' => $request->nilai_lagu],
                4 => ['nilai' => $request->nilai_adab],
            ]);
        }

        return \App\Helper\RouteHelper::getRedirect(Auth::user()->role->id);
    }

    public function destroy(Ujian $ujian)
    {
        $ujian->delete();

        return \App\Helper\RouteHelper::getRedirect(Auth::user()->role->id);
    }
}

