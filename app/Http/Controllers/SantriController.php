<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\SantriVerifiedUjian;
use App\Models\Setoran;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function indexNilaiSetoran(int $id)
    {
        $setoran = Setoran::find($id);

        return view("dashboard.santri-setoran", compact('setoran'));
    }

    public function indexNilaiUjian(int $id)
    {
        $ujian = Ujian::find($id);

        return view("dashboard.santri-ujian", compact('ujian'));
    }

    public function detailUjian(Ujian $ujian)
    {
        $user = Auth::user();
        return view('dashboard.santri-detail-ujian', compact('user', 'ujian'));
    }

    public function indexPengumuman(SantriVerifiedUjian $ujianVerified)
    {
        $user = Auth::user();
        $status = $ujianVerified->panitia_done == '1' && $ujianVerified->penguji_done == 1;

        return view('dashboard.santri-detail-pengumuman', compact('status', 'user'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

