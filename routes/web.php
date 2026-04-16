<?php

use App\Http\Controllers\SantriRegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SantriRegisterControllerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PenyimakController;
use App\Http\Controllers\Santri\TargetController;
use App\Http\Controllers\Santri\SantriDashboardController;




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

Route::get('/register/pengurus', function () {
    return view('pengurus.register-pengurus');
})->name('pengurus.create');


Route::get('/register/pengurus', [PengurusController::class, 'create'])
    ->name('pengurus.create');

Route::post('/register/pengurus', [PengurusController::class, 'store'])
    ->name('pengurus.store');

Route::get('/register/penyimak', [PenyimakController::class, 'create'])
    ->name('penyimak.create');

Route::post('/register/penyimak', [PenyimakController::class, 'store'])
    ->name('penyimak.store');



//LOGIN
Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', [LoginController::class, 'login']);

Route::get('/login', function () {
    return view('landing.role-login');
})->middleware('guest');

Route::get('/login/santri', function () {
    return view('santri.login-santri');
})->name('login.santri');

Route::get('/login/pengurus', function () {
    return view('pengurus.login-pengurus');
})->name('login.pengurus');

Route::get('/login/penyimak', function () {
    return view('auth.login-penyimak');
})->name('login.penyimak');

Route::post('/login', function (Request $request) {
    if (Auth::attempt($request->only('email', 'password'))) {

        if (Auth::user()->role != $request->role) {
            Auth::logout();
            return back()->with('error', 'Role tidak sesuai');
        }

        return redirect()->route('dashboard.' . $request->role);
    }

    return back()->with('error', 'Login gagal');
})->name('login.process');


Route::get('/login/pengurus', [LoginController::class, 'showPengurusLogin'])
    ->name('login.pengurus');

Route::post('/login/pengurus', [LoginController::class, 'loginPengurus']);

// login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::get('/login', [LoginController::class, 'showLogin'])->name('login.create');

Route::get('/login', [LoginController::class, 'showLogin'])->name('login.create');

// logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



//DASHBOARD
Route::get('/santri/dashboard', function () {
    return view('santri.dashboard');
})->middleware('auth');

Route::get('/santri/dashboard', function () {
    return view('santri.dashboard');
})->middleware(['auth', 'role:santri']);

Route::get('/dashboard/pengurus', function () {
    return view('pengurus.dashboard');
})->middleware('role:pengurus')->name('dashboard.pengurus');

Route::get('/dashboard/santri', function () {
    return view('santri.dashboard');
})->middleware('role:santri')->name('dashboard.santri');

Route::get('/dashboard/penyimak', function () {
    return view('penyimak.dashboard');
})->name('dashboard.penyimak')->middleware('auth');

Route::get('/dashboard/penyimak', function () {
    return view('penyimak.dashboard');
})->middleware('auth')->name('dashboard.penyimak');


Route::get('/profile', function () {
    return view('profile.index');
})->name('profile.index');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


//DASHBOARD SANTRI//
Route::middleware(['auth', 'role:santri'])->prefix('santri')->group(function () {
    Route::get('/dashboard', [SantriDashboardController::class, 'index'])->name('santri.dashboard');
});

Route::middleware(['auth', 'role:santri'])->prefix('santri')->group(function () {
    Route::resource('target', TargetController::class);
});

Route::middleware(['auth', 'role:santri'])->prefix('santri')->group(function () {
    Route::resource('target', TargetController::class);
});
