<?php

namespace App\Http\Controllers;

use App\Models\Penguji;
use App\Models\SantriVerifiedSetoran;
use App\Models\SantriVerifiedUjian;
use App\Models\Tempat;
use App\Models\Ujian;
use Illuminate\Support\Facades\DB;



class PanitiaDashboardController extends Controller
{
    public function index()
    {
        $ujianSubQuery = SantriVerifiedUjian::select(DB::raw('MAX(id) as id'))
            ->groupBy('santri_id');

        $setoranSubQuery = SantriVerifiedSetoran::select(DB::raw('MAX(id) as id'))
            ->groupBy('santri_id');

        $pendaftaranSetoran = SantriVerifiedSetoran::whereIn('id', $setoranSubQuery)->get();
        $pendaftaranUjian = SantriVerifiedUjian::whereIn('id', $ujianSubQuery)->get();

        return view('dashboard.panitia', compact('pendaftaranSetoran', 'pendaftaranUjian'));
    }

    public function indexSetoran($id)
    {
        $pendaftaran = SantriVerifiedSetoran::find($id);

        return view('dashboard.panitia-pendaftaran-setoran', compact('pendaftaran'));
    }

    public function indexUjian($id)
    {
        $pendaftaran = SantriVerifiedUjian::find($id);

        return view('dashboard.panitia-pendaftaran-ujian', compact('pendaftaran'));
    }



    public function indexUjianSantri()
    {
        $ujian = Ujian::all();

        return view('dashboard.panitia-ujian', compact('ujian'));
    }

    public function indexPendaftaranUjian()
    {
        $ujianSubQuery = SantriVerifiedUjian::select(DB::raw('MAX(id) as id'))
            ->groupBy('santri_id');

        $setoranSubQuery = SantriVerifiedSetoran::select(DB::raw('MAX(id) as id'))
            ->groupBy('santri_id');

        $pendaftaranSetoran = SantriVerifiedSetoran::whereIn('id', $setoranSubQuery)->get();
        $pendaftaranUjian = SantriVerifiedUjian::whereIn('id', $ujianSubQuery)->get();

        $ujianDiterima = SantriVerifiedUjian::whereIn('id', $ujianSubQuery)
            ->where('panitia_verified', true)
            ->where('penguji_verified', true)
            ->get();

        return view('dashboard.panitia-dashboard-pendaftaran-ujian', compact('pendaftaranSetoran', 'pendaftaranUjian', 'ujianDiterima'));
    }
    public function indexPendaftaranSetoran()
    {
        $ujianSubQuery = SantriVerifiedUjian::select(DB::raw('MAX(id) as id'))
            ->groupBy('santri_id');

        $setoranSubQuery = SantriVerifiedSetoran::select(DB::raw('MAX(id) as id'))
            ->groupBy('santri_id');

        $pendaftaranSetoran = SantriVerifiedSetoran::whereIn('id', $setoranSubQuery)->get();
        $pendaftaranUjian = SantriVerifiedUjian::whereIn('id', $ujianSubQuery)->get();

        return view('dashboard.panitia-dashboard-pendaftaran-setoran', compact('pendaftaranSetoran', 'pendaftaranUjian'));

    }

    public function createUjian()
    {
        $penguji = Penguji::all();
        $tempat = Tempat::all();
        $penguji->load('user');
        $subQuery = SantriVerifiedUjian::select(DB::raw('MAX(id) as id'))
            ->where('penguji_verified', 1)
            ->where('panitia_verified', 1)
            ->groupBy('santri_id');

        $santri = SantriVerifiedUjian::whereIn('id', $subQuery)->get();
        $santri->load('santri');



        return view('dashboard.panitia-create-ujian', compact('penguji', 'santri', 'tempat'));
    }

    public function editUjian(Ujian $ujian)
    {
        $penguji = Penguji::all();
        $tempat = Tempat::all();
        $penguji->load('user');
        $subQuery = SantriVerifiedUjian::select(DB::raw('MAX(id) as id'))
            ->where('penguji_verified', 1)
            ->where('panitia_verified', 1)
            ->groupBy('santri_id');

        $santri = SantriVerifiedUjian::whereIn('id', $subQuery)->get();
        $santri->load('santri');

        return view('dashboard.panitia-edit-ujian', compact('ujian', 'santri', 'penguji', 'tempat'));
    }
}

