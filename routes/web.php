<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| HALAMAN PELANGGAN
|--------------------------------------------------------------------------
*/

Route::get('/', [CustomerController::class, 'index'])
    ->name('home');

Route::get('/menu', [CustomerController::class, 'menu'])
    ->name('customer.menu');

Route::post('/cart/add/{id}', [CustomerController::class, 'addCart'])
    ->name('cart.add');

Route::get('/cart', [CustomerController::class, 'cart'])
    ->name('cart');

Route::patch('/cart/{id}', [CustomerController::class, 'updateCart'])
    ->name('cart.update');

Route::delete('/cart/{id}', [CustomerController::class, 'deleteCart'])
    ->name('cart.delete');

Route::post('/checkout', [CustomerController::class, 'checkout'])
    ->middleware('auth')
    ->name('checkout');

Route::get('/pesanan-saya', [CustomerController::class, 'orders'])
    ->middleware('auth')
    ->name('customer.orders');


/*
|--------------------------------------------------------------------------
| LOGIN DAN REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');


/*
|--------------------------------------------------------------------------
| REDIRECT DASHBOARD BERDASARKAN ROLE
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'kasir') {
        return redirect()->route('kasir.dashboard');
    }

    return redirect()->route('pelanggan.dashboard');
})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | KELOLA MENU
    |--------------------------------------------------------------------------
    */

    Route::get('/menu-admin', [MenuController::class, 'index'])
        ->name('menu-admin.index');

    Route::get('/menu-admin/create', [MenuController::class, 'create'])
        ->name('menu-admin.create');

    Route::post('/menu-admin', [MenuController::class, 'store'])
        ->name('menu-admin.store');

    Route::get('/menu-admin/{menu_admin}', [MenuController::class, 'show'])
        ->name('menu-admin.show');

    Route::get('/menu-admin/{menu_admin}/edit', [MenuController::class, 'edit'])
        ->name('menu-admin.edit');

    Route::put('/menu-admin/{menu_admin}', [MenuController::class, 'update'])
        ->name('menu-admin.update');

    Route::delete('/menu-admin/{menu_admin}', [MenuController::class, 'destroy'])
        ->name('menu-admin.destroy');


    /*
    |--------------------------------------------------------------------------
    | KELOLA KATEGORI
    |--------------------------------------------------------------------------
    */

    Route::get('/kategori', [KategoriController::class, 'index'])
        ->name('kategori.index');

    Route::get('/kategori/create', [KategoriController::class, 'create'])
        ->name('kategori.create');

    Route::post('/kategori', [KategoriController::class, 'store'])
        ->name('kategori.store');

    Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])
        ->name('kategori.show');

    Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])
        ->name('kategori.edit');

    Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])
        ->name('kategori.update');

    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])
        ->name('kategori.destroy');


    /*
    |--------------------------------------------------------------------------
    | KELOLA PESANAN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/orders', function () {
        $orders = \App\Models\Order::with([
            'user',
            'items.menu',
            'payment',
        ])->latest()->get();

        return view('admin.orders.index', compact('orders'));
    })->name('admin.orders.index');

    Route::patch(
        '/admin/orders/{order}/status',
        function (
            \Illuminate\Http\Request $request,
            \App\Models\Order $order
        ) {
            $request->validate([
                'status' => [
                    'required',
                    'in:pending,diproses,siap,selesai,dibatalkan',
                ],
            ]);

            $order->update([
                'status' => $request->status,
            ]);

            return back()->with(
                'success',
                'Status pesanan berhasil diperbarui.'
            );
        }
    )->name('admin.orders.updateStatus');

});


/*
|--------------------------------------------------------------------------
| PELANGGAN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pelanggan'])->group(function () {

    Route::get('/pelanggan/dashboard', function () {
        return view('pelanggan.dashboard');
    })->name('pelanggan.dashboard');

});


/*
|--------------------------------------------------------------------------
| KASIR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:kasir'])->group(function () {

    Route::get('/kasir/dashboard', function () {
        return view('kasir.dashboard');
    })->name('kasir.dashboard');

    Route::patch(
        '/kasir/orders/{order}/status',
        function (
            \Illuminate\Http\Request $request,
            \App\Models\Order $order
        ) {
            $request->validate([
                'status' => [
                    'required',
                    'in:pending,diproses,siap,selesai,dibatalkan',
                ],
            ]);

            $order->update([
                'status' => $request->status,
            ]);

            return back()->with(
                'success',
                'Status pesanan berhasil diperbarui.'
            );
        }
    )->name('kasir.orders.updateStatus');

});
