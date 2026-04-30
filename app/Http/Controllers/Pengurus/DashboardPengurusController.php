<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;

class DashboardPengurusController extends Controller
{
    public function index()
    {
        return view('pengurus.dashboard');
    }
}