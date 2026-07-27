<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Halaman utama.
     */
    public function index()
    {
        $menus = Menu::with('kategori')
            ->latest()
            ->limit(4)
            ->get();

        return view('home', compact('menus'));
    }


    /**
     * Halaman semua menu.
     */
    public function menu(Request $request)
    {
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
            ->get();

        return view(
            'menu.index',
            compact(
                'menus',
                'search'
            )
        );
    }


    /**
     * Tambah menu ke keranjang.
     *
     * Mendukung:
     * 1. Request biasa dari form.
     * 2. Request AJAX menggunakan fetch().
     */
    public function addCart(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'nama' => $menu->nama_menu,
                'harga' => $menu->harga,
                'qty' => 1,
                'gambar' => $menu->gambar,
            ];
        }

        session()->put('cart', $cart);


        /*
        |--------------------------------------------------------------------------
        | RESPONSE AJAX
        |--------------------------------------------------------------------------
        */

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' =>
                    $menu->nama_menu .
                    ' berhasil ditambahkan ke keranjang.',
                'cart_count' =>
                    collect($cart)->sum('qty'),
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | RESPONSE FORM BIASA
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            $menu->nama_menu .
            ' berhasil ditambahkan ke keranjang.'
        );
    }


    /**
     * Halaman keranjang.
     */
    public function cart()
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(function ($item) {
            return $item['harga'] * $item['qty'];
        });

        return view(
            'cart',
            compact(
                'cart',
                'total'
            )
        );
    }


    /**
     * Update jumlah item di keranjang.
     */
    public function updateCart(
        Request $request,
        $id
    ) {
        $request->validate([
            'qty' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back()->with(
                'error',
                'Menu tidak ditemukan di keranjang.'
            );
        }

        $cart[$id]['qty'] =
            $request->qty;

        session()->put(
            'cart',
            $cart
        );

        return back()->with(
            'success',
            'Jumlah pesanan berhasil diperbarui.'
        );
    }


    /**
     * Hapus item dari keranjang.
     */
    public function deleteCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put(
            'cart',
            $cart
        );

        return back()->with(
            'success',
            'Menu berhasil dihapus dari keranjang.'
        );
    }


    /**
     * Halaman Pesanan Saya.
     *
     * Hanya menampilkan pesanan
     * milik pelanggan yang sedang login.
     */
    public function orders()
    {
        $orders = Order::with([
            'items.menu',
            'payment',
        ])
            ->where(
                'user_id',
                auth()->id()
            )
            ->latest()
            ->get();

        return view(
            'pelanggan.orders',
            compact('orders')
        );
    }


    /**
     * Checkout dan membuat order.
     */
    public function checkout(
        Request $request
    ) {
        $request->validate([
            'nama_lengkap' => [
                'required',
                'string',
                'max:255',
            ],

            'no_whatsapp' => [
                'required',
                'string',
                'max:20',
            ],

            'alamat' => [
                'required',
                'string',
            ],

            'metode_pembayaran' => [
                'required',
                'in:cod,transfer',
            ],
        ]);


        $cart = session()->get(
            'cart',
            []
        );


        if (empty($cart)) {
            return back()->with(
                'error',
                'Keranjang kamu masih kosong.'
            );
        }


        $total = collect($cart)->sum(
            function ($item) {
                return $item['harga'] *
                    $item['qty'];
            }
        );


        try {

            $order = DB::transaction(
                function () use (
                    $request,
                    $cart,
                    $total
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | 1. BUAT ORDER
                    |--------------------------------------------------------------------------
                    */

                    $order = Order::create([
                        'user_id' =>
                            auth()->id(),

                        'nama_lengkap' =>
                            $request->nama_lengkap,

                        'no_whatsapp' =>
                            $request->no_whatsapp,

                        'alamat' =>
                            $request->alamat,

                        'total_harga' =>
                            $total,

                        'status' =>
                            'pending',
                    ]);


                    /*
                    |--------------------------------------------------------------------------
                    | 2. SIMPAN ORDER ITEMS
                    |--------------------------------------------------------------------------
                    */

                    foreach (
                        $cart
                        as $menuId => $item
                    ) {

                        OrderItem::create([
                            'order_id' =>
                                $order->id,

                            'menu_id' =>
                                $menuId,

                            'jumlah' =>
                                $item['qty'],

                            'harga' =>
                                $item['harga'],
                        ]);

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | 3. SIMPAN PAYMENT
                    |--------------------------------------------------------------------------
                    */

                    Payment::create([
                        'order_id' =>
                            $order->id,

                        'metode_pembayaran' =>
                            $request
                                ->metode_pembayaran,

                        'amount' =>
                            $total,

                        'status' =>
                            'pending',
                    ]);


                    return $order;

                }
            );


            /*
            |--------------------------------------------------------------------------
            | 4. KOSONGKAN KERANJANG
            |--------------------------------------------------------------------------
            */

            session()->forget(
                'cart'
            );


            /*
            |--------------------------------------------------------------------------
            | 5. REDIRECT PESANAN
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route(
                    'customer.orders'
                )
                ->with(
                    'success',
                    'Pesanan #' .
                    $order->id .
                    ' berhasil dibuat.'
                );


        } catch (\Throwable $e) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pesanan gagal dibuat. Silakan coba lagi.'
                );

        }
    }
}

