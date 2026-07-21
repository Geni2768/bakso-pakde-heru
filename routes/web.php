<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Payment;


/*
|--------------------------------------------------------------------------
| CUSTOMER
|--------------------------------------------------------------------------
*/

Route::get('/', [CustomerController::class,'index'])
->name('home');


Route::get('/pesanan-menu',
[CustomerController::class,'menu'])
->name('customer.menu');


Route::post('/cart/add/{id}',
[CustomerController::class,'addCart'])
->name('cart.add');


Route::get('/cart',
[CustomerController::class,'cart'])
->name('cart');


Route::delete('/cart/{id}',
[CustomerController::class,'deleteCart'])
->name('cart.delete');



/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login',
    [AuthenticatedSessionController::class,'create'])
    ->name('login');


    Route::post('/login',
    [AuthenticatedSessionController::class,'store']);


    Route::get('/register',
    [RegisteredUserController::class,'create'])
    ->name('register');


    Route::post('/register',
    [RegisteredUserController::class,'store']);

});



/*
|--------------------------------------------------------------------------
| LOGIN USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {


Route::get('/dashboard', function () {


    $user = auth()->user();


    if($user->hasRole('admin')){

        return redirect()->route('admin.dashboard');

    }


    if($user->hasRole('kasir')){

        return redirect()->route('kasir.dashboard');

    }


    return redirect()->route('pelanggan.dashboard');


})->name('dashboard');




/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', function(){


$totalMenu = Menu::count();

$totalKategori = Kategori::count();

$totalOrder = Order::count();

$totalPendapatan = Payment::sum('amount');



return view('admin.dashboard',
compact(
'totalMenu',
'totalKategori',
'totalOrder',
'totalPendapatan'
));


})->name('admin.dashboard');




/*
|--------------------------------------------------------------------------
| ADMIN CRUD
|--------------------------------------------------------------------------
*/


Route::middleware(['role:admin|kasir'])->group(function(){


Route::resource('/kategori',
KategoriController::class);


Route::resource('/menu',
MenuController::class);


});




Route::view('/kasir',
'kasir.dashboard')
->name('kasir.dashboard');



Route::view('/pelanggan',
'pelanggan.dashboard')
->name('pelanggan.dashboard');




Route::post('/logout',
[AuthenticatedSessionController::class,'destroy'])
->name('logout');

});


require __DIR__.'/auth.php';
