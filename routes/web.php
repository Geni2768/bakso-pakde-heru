<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;

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

    // Dashboard — redirect sesuai role
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('kasir')) {
            return redirect()->route('kasir.dashboard');
        } else {
            return redirect()->route('pelanggan.dashboard');
        }
    })->name('dashboard');

    // -------------------------------------------------------
    // KASIR: Kelola Kategori & Menu
    // Middleware 'role:kasir|admin' — kasir dan admin bisa akses
    // -------------------------------------------------------
    Route::middleware(['role:kasir|admin'])->group(function () {

        // CRUD Kategori
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/data', [KategoriController::class, 'getData'])->name('kategori.data');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
        Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

        // CRUD Menu
        Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
        Route::get('/menu/data', [MenuController::class, 'getData'])->name('menu.data');
        Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
        Route::get('/menu/{menu}', [MenuController::class, 'show'])->name('menu.show');
        Route::post('/menu/{menu}', [MenuController::class, 'update'])->name('menu.update');
        // Catatan: pakai POST bukan PUT untuk support multipart/form-data (upload file)
        Route::delete('/menu/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');

    });

});

// Include routes Breeze (login, register, dll)
require __DIR__ . '/auth.php';
