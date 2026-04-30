<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PenyimakController;
use App\Http\Controllers\SantriRegisterController;

use App\Http\Controllers\Santri\SantriDashboardController;
use App\Http\Controllers\Santri\TargetController;
use App\Http\Controllers\Santri\SetoranController;

use App\Http\Controllers\Penyimak\DashboardController;
use App\Http\Controllers\Pengurus\DashboardPengurusController;

/*
|--------------------------------------------------------------------------
| LANDING
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('landing.index'))->name('home');

Route::get('/departemen-humas', fn() => view('landing.departemen_humas'))
    ->name('departemen.humas');

Route::get('/departemen-pendidikan', fn() => view('landing.departemen_pendidikan'))
    ->name('departemen.pendidikan');

Route::get('/departemen-psdm', fn() => view('landing.departemen_psdm'))
    ->name('departemen.psdm');

Route::get('/departemen-tahfidz', fn() => view('landing.departemen_tahfidz'))
    ->name('departemen.tahfidz'); 

Route::get('/program-tahfidz', fn() => view('landing.tahfidz'))
    ->name('program.tahfidz');

Route::get('/pengumuman', fn() => view('landing.pengumuman'))
    ->name('pengumuman');

Route::get('/semua-programi', fn() => view('landing.semua-program'))
    ->name('semua-program');

    Route::get('/profile', function () {
    return view('profile.index');
})->name('profile.index');
/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/register-role', fn() => view('landing.role_register'));

Route::get('/register/santri', [SantriRegisterController::class, 'create']);
Route::post('/register/santri', [SantriRegisterController::class, 'store']);

Route::get('/register/pengurus', [PengurusController::class, 'create']);
Route::post('/register/pengurus', [PengurusController::class, 'store']);

Route::get('/register/penyimak', [PenyimakController::class, 'create']);
Route::post('/register/penyimak', [PenyimakController::class, 'store']);

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::get('/login', [LoginController::class, 'showLogin'])->name('login.create');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register-role', function () {
    return view('landing.role_register');
})->name('register.role');

Route::get('/register/santri', [SantriRegisterController::class, 'create'])
    ->name('santri.create');

Route::post('/register/santri', [SantriRegisterController::class, 'store'])
    ->name('santri.store');

Route::get('/register/pengurus', [PengurusController::class, 'create'])
    ->name('pengurus.create');

Route::post('/register/pengurus', [PengurusController::class, 'store'])
    ->name('pengurus.store');

Route::get('/register/penyimak', [PenyimakController::class, 'create'])
    ->name('penyimak.create');

Route::post('/register/penyimak', [PenyimakController::class, 'store'])
    ->name('penyimak.store');
/*
|--------------------------------------------------------------------------
| DASHBOARD (ROLE BASED)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/santri', [SantriDashboardController::class, 'index'])
        ->name('dashboard.santri');

    Route::get('/dashboard/pengurus', [DashboardPengurusController::class, 'index'])
        ->name('dashboard.pengurus');

    Route::get('/dashboard/penyimak', [DashboardController::class, 'index'])
        ->name('dashboard.penyimak');

    Route::put(
        '/penyimak/setoran/{id}/verifikasi',
        [DashboardController::class, 'verifikasi']
    )->name('penyimak.verifikasi');
});

/*
|--------------------------------------------------------------------------
| SANTRI FEATURE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('santri')->group(function () {

    // 🔥 DASHBOARD UTAMA (INI YANG DIPAKAI)
    Route::get('/dashboard', [SantriDashboardController::class, 'index']);

    // TARGET
    Route::resource('target', TargetController::class);
    Route::post('/target/{id}/toggle', [TargetController::class, 'toggle']);

    // SETORAN
    Route::get('/setoran/create', [SetoranController::class, 'create']);
    Route::post('/setoran', [SetoranController::class, 'store']);

    // MUROJAAH
    Route::post('/murojaah', [SantriDashboardController::class, 'storeMurojaah']);
    Route::post('/murojaah/check', [SantriDashboardController::class, 'checkMurojaah']);
    Route::get('/santri/murojaah/create', function () {
    return view('santri.murojaah.create');
})->middleware(['auth','role:santri']);

Route::post('/santri/murojaah', [SantriDashboardController::class, 'storeMurojaah']);
Route::post('/santri/murojaah/toggle', [SantriDashboardController::class, 'toggleMurojaah']);
});