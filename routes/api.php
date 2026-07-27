<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Menu;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Route API untuk aplikasi Bakso Pakde Heru.
|
*/


/*
|--------------------------------------------------------------------------
| API DAFTAR MENU
|--------------------------------------------------------------------------
|
| Endpoint:
| GET /api/menus
|
| Mengambil seluruh menu yang tersedia.
|
*/

Route::get('/menus', function (Request $request) {

    $search = $request->input('search');

    $menus = Menu::with('kategori')
        ->when($search, function ($query) use ($search) {

            $query->where(
                'nama_menu',
                'like',
                '%' . $search . '%'
            );

        })
        ->latest()
        ->get()
        ->map(function ($menu) {

            return [
                'id' => $menu->id,

                'nama_menu' =>
                    $menu->nama_menu,

                'deskripsi' =>
                    $menu->deskripsi,

                'harga' =>
                    $menu->harga,

                'gambar' =>
                    $menu->gambar,

                'kategori' =>
                    $menu->kategori
                        ? $menu->kategori->nama_kategori
                        : null,

            ];

        });


    return response()->json([

        'success' => true,

        'message' =>
            'Data menu berhasil diambil.',

        'data' =>
            $menus,

    ]);

});


/*
|--------------------------------------------------------------------------
| API DETAIL MENU
|--------------------------------------------------------------------------
|
| Endpoint:
| GET /api/menus/{id}
|
| Mengambil detail satu menu.
|
*/

Route::get('/menus/{id}', function ($id) {

    $menu = Menu::with('kategori')
        ->find($id);


    if (!$menu) {

        return response()->json([

            'success' => false,

            'message' =>
                'Menu tidak ditemukan.',

            'data' =>
                null,

        ], 404);

    }


    return response()->json([

        'success' => true,

        'message' =>
            'Detail menu berhasil diambil.',

        'data' => [

            'id' =>
                $menu->id,

            'nama_menu' =>
                $menu->nama_menu,

            'deskripsi' =>
                $menu->deskripsi,

            'harga' =>
                $menu->harga,

            'gambar' =>
                $menu->gambar,

            'kategori' =>
                $menu->kategori
                    ? $menu->kategori->nama_kategori
                    : null,

        ],

    ]);

});
