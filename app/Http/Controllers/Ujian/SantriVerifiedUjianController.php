<?php

namespace App\Http\Controllers\Ujian;

use App\Helper\RouteHelper;
use App\Http\Controllers\Controller;
use App\Models\SantriVerifiedUjian;
use Illuminate\Http\Request;

class SantriVerifiedUjianController extends Controller
{
    public function index()
    {
        $santriVerifiedUjian = SantriVerifiedUjian::with('santri.user')->get();

        return view('ujian.santri-verified', compact('santriVerifiedUjian'));
    }


    public function store(Request $request)
    {

        SantriVerifiedUjian::create([
            'santri_id' => $request->user()->santri->id,
            'is_done' => false
        ]);


        return redirect()->route('dashboard.santri.ujian.index')->with('success', 'Berhasil mendaftar ke program ujian tahfidz!');
    }

    public function update(Request $request, SantriVerifiedUjian $santriVerifiedUjian)
    {

        if ($request->user()->role_id == 2) {
            $santriVerifiedUjian->update([
                'panitia_verified' => $request->panitia_verified,
            ]);

            return redirect()->route('dashboard.panitia')->with('Success', 'Berhasil merubah data!');
        } elseif ($request->user()->role_id == 4) {
            $santriVerifiedUjian->update([
                'penguji_verified' => $request->penguji_verified,
            ]);

            return RouteHelper::getRedirect($request->user()->role_id)->with('Success', 'Berhasil merubah data!');

        } elseif ($request->user()->role_id == config('constants.ROLE_ADMIN')) {
            if (isset($request->panitia_verified)) {
                $santriVerifiedUjian->update([
                    'panitia_verified' => $request->panitia_verified,
                ]);
            } elseif (isset($request->penguji_verified)) {
                $santriVerifiedUjian->update([
                    'penguji_verified' => $request->penguji_verified,
                ]);
            }

            return redirect()->intended('/admin/ujian')->with('success', 'Data berhasil di ubah!');
        } else if ($request->user()->role_id == config('constants.ROLE_SANTRI')) {

       

            $santriVerifiedUjian->update([
                'penguji_verified' => $request->penguji_verified,
                'panitia_verified' => $request->panitia_verified,
            ]);

            return redirect()->route('dashboard.santri.ujian.index')->with('success', 'Data berhasil di ubah!');
        }

        return redirect()->route('dashboard.admin.setoran')->with('Success', 'Berhasil merubah data!');
    }

    public function updateDone(Request $request, SantriVerifiedUjian $santriVerifiedUjian)
    {
        if ($request->user()->role_id == 2) {
            $santriVerifiedUjian->update([
                'panitia_done' => $request->panitia_done,
            ]);

            return redirect()->route('dashboard.panitia.pendaftaran-ujian')->with('Success', 'Berhasil merubah data!');
        } elseif ($request->user()->role_id == 4) {
            $santriVerifiedUjian->update([
                'penguji_done' => $request->penguji_done,
            ]);

            return RouteHelper::getRedirect($request->user()->role_id)->with('Success', 'Berhasil merubah data!');

        } elseif ($request->user()->role_id == config('constants.ROLE_ADMIN')) {
            if (isset($request->panitia_done)) {
                $santriVerifiedUjian->update([
                    'panitia_done' => $request->panitia_done,
                ]);
            } elseif (isset($request->penguji_done)) {
                $santriVerifiedUjian->update([
                    'penguji_done' => $request->penguji_done,
                ]);
            }

            return redirect()->intended('/admin/ujian')->with('success', 'Data berhasil di ubah!');
        }

        return redirect()->route('dashboard.admin.setoran')->with('Success', 'Berhasil merubah data!');
    }
}

