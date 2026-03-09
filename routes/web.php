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



Route::get('/departemen-humas', function () {
    return view('landing.departemen_humas');
})->name('departemen.humas');

Route::get('/departemen-pendidikan', function () {
    return view('landing.departemen_pendidikan');
})->name('departemen.pendidikan');

Route::get('/departemen-psdm', function () {
    return view('landing.departemen_psdm');
})->name('departemen.psdm');

Route::get('/departemen-tahfidz', function () {
    return view('landing.departemen_tahfidz');
})->name('departemen.tahfidz');

Route::get('/semua-programi', function () {
    return view('landing.semua-program');
})->name('semua-program');

Route::get('/program-tahfidz', function () {
    return view('landing.tahfidz');
})->name('program.tahfidz');

Route::get('/pengumuman', function () {
    return view('landing.pengumuman');
})->name('pengumuman');


require_once __DIR__ . '/auth.php';
