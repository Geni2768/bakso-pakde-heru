<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Order;

class CustomerOrderController extends Controller
{
    /**
     * Menampilkan semua pesanan milik pelanggan.
     */
    public function index()
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

    /**
     * Menampilkan detail pesanan pelanggan.
     */
    public function show($id)
    {
        $order = Order::with([
            'items.menu',
            'payment',
        ])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view(
            'pelanggan.order-detail',
            compact('order')
        );
    }
}
