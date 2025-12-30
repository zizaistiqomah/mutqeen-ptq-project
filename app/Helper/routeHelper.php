<?php

namespace App\Helper;

use App\Providers\RouteServiceProvider;

class RouteHelper
{
    public static function getRedirect($role_id)
    {
        switch ($role_id) {
            case config('constants.ROLE_PENGUJI'):
                return redirect()->intended(RouteServiceProvider::PENGUJI);
            case config('constants.ROLE_SANTRI'):
                return redirect()->intended(RouteServiceProvider::SANTRI);
            case config('constants.ROLE_ADMIN'):
                return redirect()->intended(RouteServiceProvider::ADMIN);
            case config('constants.ROLE_PANITIA'):
                return redirect()->intended(RouteServiceProvider::PANITIA);
            default:
                return redirect()->intended(RouteServiceProvider::HOME);
        }
    }
}
