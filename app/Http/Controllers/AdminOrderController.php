<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Menampilkan semua pesanan pelanggan.
     */
    public function index()
    {
        $orders = Order::with([
            'user',
            'items.menu',
            'payment',
        ])
            ->latest()
            ->get();

        return view(
            'admin.orders.index',
            compact('orders')
        );
    }

    /**
     * Mengubah status pesanan.
     */
    public function updateStatus(
        Request $request,
        Order $order
    ) {
        $request->validate([
            'status' => [
                'required',
                'in:pending,diproses,selesai,dibatalkan',
            ],
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with(
                'success',
                'Status pesanan #' .
                $order->id .
                ' berhasil diperbarui.'
            );
    }
}

