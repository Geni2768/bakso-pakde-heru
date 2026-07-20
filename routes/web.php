<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes — Bakso Pak Heru
|--------------------------------------------------------------------------
*/

// Halaman utama redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes yang butuh login
Route::middleware(['auth'])->group(function () {

    // Dashboard redirect sesuai role
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('kasir')) {
            return redirect()->route('kasir.dashboard');
        }

        return redirect()->route('pelanggan.dashboard');
    })->name('dashboard');

    // Dashboard tiap role
    Route::view('/admin', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/kasir', 'kasir.dashboard')->name('kasir.dashboard');
    Route::view('/pelanggan', 'pelanggan.dashboard')->name('pelanggan.dashboard');

    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // CRUD Kategori & Menu
    Route::middleware(['role:kasir|admin'])->group(function () {

        // Kategori
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/data', [KategoriController::class, 'getData'])->name('kategori.data');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
        Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

        // Menu
        Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
        Route::get('/menu/data', [MenuController::class, 'getData'])->name('menu.data');
        Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
        Route::get('/menu/{menu}', [MenuController::class, 'show'])->name('menu.show');
        Route::post('/menu/{menu}', [MenuController::class, 'update'])->name('menu.update');
        Route::delete('/menu/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');
    });
});

// Guest
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// Breeze
require __DIR__.'/auth.php';