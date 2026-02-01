<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Authentication\PanitiaRegisterController;
use App\Http\Controllers\Authentication\PengujiRegisterController;
use App\Http\Controllers\Authentication\SantriRegisterController;
use App\Http\Controllers\PanitiaDashboardController;
use App\Http\Controllers\PengujiDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\Setoran\SantriVerifiedSetoranController;
use App\Http\Controllers\Setoran\SetoranController;
use App\Http\Controllers\Ujian\SantriVerifiedUjianController;
use App\Http\Controllers\Ujian\UjianController;
use App\Models\SantriVerifiedSetoran;
use App\Models\SantriVerifiedUjian;
use App\Models\Setoran;
use App\Models\Ujian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing.index');
})->name('home');



Route::get('/departemen-mudarosah', function () {
    return view('landing.departemen_mudarosah');
})->name('departemen.mudarosah');

Route::get('/departemen-munaqosyah', function () {
    return view('landing.departemen_munaqosyah');
})->name('departemen.munaqosyah');

Route::get('/departemen-syiar', function () {
    return view('landing.departemen_syiar');
})->name('departemen.syiar');

Route::get('/departemen-tahfidz', function () {
    return view('landing.departemen_tahfidz');
})->name('departemen.tahfidz');

Route::get('/departemen-ukhuwah', function () {
    return view('landing.departemen_ukhuwah');
})->name('departemen.ukhuwah');

Route::get('/publikasi', function () {
    return view('landing.publikasi');
})->name('publikasi');

Route::get('/program-tahfidz', function () {
    return view('landing.tahfidz');
})->name('program.tahfidz');


require_once __DIR__ . '/auth.php';
