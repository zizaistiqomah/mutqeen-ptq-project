<?php

namespace App\Http\Controllers\Setoran;

use App\Helper\RouteHelper;
use App\Http\Controllers\Controller;
use App\Models\SantriVerifiedSetoran;
use Illuminate\Http\Request;

class SantriVerifiedSetoranController extends Controller
{
    public function index()
    {
        $setoranVerified = SantriVerifiedSetoran::with('santri.user')->get();

        return view('setoran.santri-verified', compact('setoranVerified'));
    }


    public function store(Request $request)
    {

        SantriVerifiedSetoran::create([
            'santri_id' => $request->user()->santri->id,
        ]);


        return redirect()->route('dashboard.santri')->with('success', 'Berhasil mendaftar ke program setoran tahfidz!');
    }

    public function update(Request $request, SantriVerifiedSetoran $santriVerifiedSetoran)
    {


        if ($request->user()->role_id == 2) {
            $santriVerifiedSetoran->update([
                'panitia_verified' => $request->panitia_verified,
            ]);
        } elseif ($request->user()->role_id == 4) {

            $santriVerifiedSetoran->update([
                'penguji_verified' => $request->penguji_verified,
            ]);
        } elseif ($request->user()->role_id == config('constants.ROLE_ADMIN')) {
            if (isset($request->panitia_verified)) {
                $santriVerifiedSetoran->update([
                    'panitia_verified' => $request->panitia_verified,
                ]);
            } elseif (isset($request->penguji_verified)) {
                $santriVerifiedSetoran->update([
                    'penguji_verified' => $request->penguji_verified,
                ]);
            }

            return redirect()->intended('/admin/setoran')->with('success', 'Data berhasil di ubah!');
        }



        return RouteHelper::getRedirect($request->user()->role_id)->with('Success', 'Berhasil merubah data!');
    }
}
