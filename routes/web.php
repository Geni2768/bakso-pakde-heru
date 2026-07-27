<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminOrderController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

use App\Models\User;
use App\Models\Menu;
use App\Models\Kategori;
use App\Models\Order;
use App\Models\Payment;

/*
|--------------------------------------------------------------------------
| HALAMAN CUSTOMER / PELANGGAN
|--------------------------------------------------------------------------
*/

// Beranda
Route::get('/', [
    CustomerController::class,
    'index'
])->name('home');

// Daftar Menu
Route::get('/menu', [
    CustomerController::class,
    'menu'
])->name('customer.menu');

// Tambah Menu ke Keranjang
Route::post('/cart/add/{id}', [
    CustomerController::class,
    'addCart'
])->name('cart.add');

// Keranjang
Route::get('/cart', [
    CustomerController::class,
    'cart'
])->name('cart');

// Update jumlah keranjang
Route::patch('/cart/{id}', [
    CustomerController::class,
    'updateCart'
])->name('cart.update');

// Hapus dari Keranjang
Route::delete('/cart/{id}', [
    CustomerController::class,
    'deleteCart'
])->name('cart.delete');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [
        AuthenticatedSessionController::class,
        'create'
    ])->name('login');

    Route::post('/login', [
        AuthenticatedSessionController::class,
        'store'
    ]);

    // Register
    Route::get('/register', [
        RegisteredUserController::class,
        'create'
    ])->name('register');

    Route::post('/register', [
        RegisteredUserController::class,
        'store'
    ]);

});


/*
|--------------------------------------------------------------------------
| USER LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD REDIRECT
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'kasir') {
            return redirect()->route('kasir.dashboard');
        }

        return redirect()->route('pelanggan.dashboard');

    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | CHECKOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/checkout', [
        CustomerController::class,
        'checkout'
    ])->name('checkout');


    /*
    |--------------------------------------------------------------------------
    | PESANAN SAYA - PELANGGAN
    |--------------------------------------------------------------------------
    */

    Route::get('/pesanan-saya', function () {

        $orders = Order::with([
            'items.menu',
            'payment'
        ])
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

        return view(
            'pelanggan.orders',
            compact('orders')
        );

    })->name('customer.orders');


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {

        // Dashboard Admin
        Route::get('/admin/dashboard', function () {

            $totalMenu = Menu::count();

            $totalKategori = Kategori::count();

            $totalOrder = Order::count();

            $totalIncome = Payment::sum('amount');

            $totalCustomer = User::where(
                'role',
                'pelanggan'
            )->count();

            return view(
                'admin.dashboard',
                compact(
                    'totalMenu',
                    'totalKategori',
                    'totalOrder',
                    'totalIncome',
                    'totalCustomer'
                )
            );

        })->name('admin.dashboard');


        // CRUD Kategori
        Route::resource(
            'kategori',
            KategoriController::class
        );


        // CRUD Menu
        Route::resource(
            'menu-admin',
            MenuController::class
        );


        /*
        |--------------------------------------------------------------------------
        | KELOLA PESANAN ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get('/admin/orders', [
            AdminOrderController::class,
            'index'
        ])->name('admin.orders.index');

        Route::patch('/admin/orders/{order}/status', [
            AdminOrderController::class,
            'updateStatus'
        ])->name('admin.orders.updateStatus');

    });






    /*
    |--------------------------------------------------------------------------
    | PELANGGAN
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:pelanggan')->group(function () {

        Route::view(
            '/pelanggan/dashboard',
            'pelanggan.dashboard'
        )->name('pelanggan.dashboard');

    });
    
/*
|--------------------------------------------------------------------------
| KASIR
|--------------------------------------------------------------------------
*/

Route::middleware('role:kasir')->group(function () {

    // Dashboard Kasir
    Route::get(
        '/kasir/dashboard',
        [
            \App\Http\Controllers\Kasir\DashboardController::class,
            'index'
        ]
    )->name('kasir.dashboard');


    // Update Status Pesanan oleh Kasir
    Route::patch(
        '/kasir/orders/{order}/status',
        [
            \App\Http\Controllers\Kasir\DashboardController::class,
            'updateStatus'
        ]
    )->name('kasir.orders.updateStatus');

});

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [
        AuthenticatedSessionController::class,
        'destroy'
    ])->name('logout');

});


require __DIR__ . '/auth.php';
