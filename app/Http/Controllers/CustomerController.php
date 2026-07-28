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
    public function index()
    {
        $menus = Menu::with('kategori')
            ->latest()
            ->limit(4)
            ->get();

        return view('home', compact('menus'));
    }

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

        /*
        |--------------------------------------------------------------------------
        | RESPONSE AJAX
        |--------------------------------------------------------------------------
        | Jika request berasal dari JavaScript,
        | kirim data menu dalam format JSON.
        */

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'menus' => $menus->map(function ($menu) {
                    return [
                        'id' => $menu->id,
                        'nama_menu' => $menu->nama_menu,
                        'deskripsi' => $menu->deskripsi,
                        'harga' => $menu->harga,
                        'gambar' => $menu->gambar,
                        'kategori' => $menu->kategori
                            ? $menu->kategori->nama_kategori
                            : '-',
                    ];
                }),
            ]);
        }

        return view(
            'menu.index',
            compact('menus', 'search')
        );
    }

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

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $menu->nama_menu .
                    ' berhasil ditambahkan ke keranjang.',
                'cart_count' => collect($cart)->sum('qty'),
            ]);
        }

        return back()->with(
            'success',
            $menu->nama_menu .
            ' berhasil ditambahkan ke keranjang.'
        );
    }

    public function cart()
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(function ($item) {
            return $item['harga'] * $item['qty'];
        });

        return view('cart', compact('cart', 'total'));
    }

    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back()->with(
                'error',
                'Menu tidak ditemukan di keranjang.'
            );
        }

        $cart[$id]['qty'] = $request->qty;

        session()->put('cart', $cart);

        return back()->with(
            'success',
            'Jumlah pesanan berhasil diperbarui.'
        );
    }

    public function deleteCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return back()->with(
            'success',
            'Menu berhasil dihapus dari keranjang.'
        );
    }

    public function orders()
    {
        $orders = Order::with([
            'items.menu',
            'payment',
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view(
            'pelanggan.orders',
            compact('orders')
        );
    }

    public function checkout(Request $request)
    {
        if (!auth()->check()) {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu untuk melakukan checkout.'
                );
        }

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_whatsapp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'metode_pembayaran' => 'required',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with(
                'error',
                'Keranjang kamu masih kosong.'
            );
        }

        $total = collect($cart)->sum(function ($item) {
            return $item['harga'] * $item['qty'];
        });

        try {
            $order = DB::transaction(
                function () use (
                    $request,
                    $cart,
                    $total
                ) {
                    $order = Order::create([
                        'user_id' => auth()->id(),
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

                    foreach ($cart as $menuId => $item) {
                        OrderItem::create([
                            'order_id' =>
                                $order->id,

                            'menu_id' =>
                                $menuId,

                            'qty' =>
                                $item['qty'],

                            'harga_satuan' =>
                                $item['harga'],

                            'subtotal' =>
                                $item['harga']
                                * $item['qty'],
                        ]);
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | DATABASE PAYMENT
                    |--------------------------------------------------------------------------
                    | Nilai yang diizinkan:
                    | tunai, transfer, qris
                    */

                    $metode = strtolower(
                        $request->metode_pembayaran
                    );

                    if ($metode === 'cod') {
                        $metode = 'tunai';
                    }

                    Payment::create([
                        'order_id' =>
                            $order->id,

                        'metode_pembayaran' =>
                            $metode,

                        'jumlah_bayar' =>
                            $total,
                    ]);

                    return $order;
                }
            );

            session()->forget('cart');

            return redirect()
                ->route('customer.orders')
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
                    'Gagal membuat pesanan: ' .
                    $e->getMessage()
                );
        }
    }
}
