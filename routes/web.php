<?php

use App\Http\Controllers\SantriRegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SantriRegisterControllerController;
use App\Http\Controllers\Auth\LoginController;



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




Route::get('/register', function () {
    return view('landing.register');
})->name('register');

Route::get('/register/santri', function () {
    return view('auth.register-santri');
})->name('register.santri');

Route::get('/register/penyimak', function () {
    return view('auth.register-penyimak');
})->name('register.penyimak');

Route::get('/register/admin', function () {
    return view('auth.register-admin');
})->name('register.admin');

Route::get('/register-role', function () {
    return view('landing.role_register');
})->name('register.role');


//REGISTER
Route::get('/register/santri', [SantriRegisterController::class, 'create'])->name('santri.create');
Route::post('/register/santri', [SantriRegisterController::class, 'store'])->name('santri.store');
Route::get('/dashboard', function () {
    return "Login berhasil, ini dashboard!";
})->middleware('auth');


//LOGIN
Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', [LoginController::class, 'login']);

Route::get('/login', function () {
    return view('auth.pilih-login');
})->middleware('guest');


//DASHBOARD
Route::get('/santri/dashboard', function () {
    return view('santri.dashboard');
})->middleware('auth');

Route::get('/santri/dashboard', function () {
    return view('santri.dashboard');
})->middleware(['auth', 'role:santri']);
