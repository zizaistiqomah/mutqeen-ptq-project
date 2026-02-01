<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\SantriVerifiedSetoran;
use App\Models\SantriVerifiedUjian;
use Illuminate\Http\Request;

class PengujiDashboardController extends Controller
{
    public function indexDetailSantri(int $id) {
        $pendaftaran = SantriVerifiedSetoran::find($id);
        return view('dashboard.penguji-pendaftaran-setoran', compact('pendaftaran'));
    }

    public function indexDetailUjian(int $id) {
        $pendaftaran = SantriVerifiedUjian::find($id);
        return view('dashboard.penguji-pendaftaran-ujian', compact('pendaftaran'));
    }
}

