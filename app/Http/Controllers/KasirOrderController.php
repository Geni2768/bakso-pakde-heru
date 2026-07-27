<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class KasirOrderController extends Controller
{
    /**
     * Dashboard Kasir
     *
     * Menampilkan:
     * - Total pesanan
     * - Pesanan pending
     * - Pesanan diproses
     * - Pesanan selesai
     * - Pesanan dibatalkan
     * - Daftar semua pesanan terbaru
     */
    public function dashboard()
    {
        $orders = Order::with([
            'user',
            'items.menu',
            'payment',
        ])
            ->latest()
            ->get();

        $totalOrder = Order::count();

        $pending = Order::where(
            'status',
            'pending'
        )->count();

        $diproses = Order::where(
            'status',
            'diproses'
        )->count();

        $dikirim = Order::where(
            'status',
            'dikirim'
        )->count();

        $selesai = Order::where(
            'status',
            'selesai'
        )->count();

        $dibatalkan = Order::where(
            'status',
            'dibatalkan'
        )->count();

        return view(
            'kasir.dashboard',
            compact(
                'orders',
                'totalOrder',
                'pending',
                'diproses',
                'dikirim',
                'selesai',
                'dibatalkan'
            )
        );
    }


    /**
     * Mengubah status pesanan oleh Kasir.
     */
    public function updateStatus(
        Request $request,
        Order $order
    ) {
        $request->validate([
            'status' => [
                'required',
                'in:pending,diproses,dikirim,selesai,dibatalkan',
            ],
        ]);


        $order->update([
            'status' => $request->status,
        ]);


        return redirect()
            ->route('kasir.dashboard')
            ->with(
                'success',
                'Status pesanan #' .
                $order->id .
                ' berhasil diperbarui.'
            );
    }
}
