<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan Dashboard Kasir.
     *
     * Dashboard berisi:
     * - Total semua pesanan
     * - Jumlah pesanan pending
     * - Jumlah pesanan diproses
     * - Jumlah pesanan dikirim
     * - Jumlah pesanan selesai
     * - Jumlah pesanan dibatalkan
     * - Detail semua pesanan pelanggan
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA PESANAN
        |--------------------------------------------------------------------------
        |
        | Mengambil:
        | - Data user/pelanggan
        | - Item pesanan
        | - Menu dari setiap item
        | - Data pembayaran
        |
        */

        $orders = Order::with([
            'user',
            'items.menu',
            'payment',
        ])
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK PESANAN
        |--------------------------------------------------------------------------
        */

        $totalOrder = $orders->count();

        $pending = $orders
            ->where('status', 'pending')
            ->count();

        $diproses = $orders
            ->where('status', 'diproses')
            ->count();

        $dikirim = $orders
            ->where('status', 'dikirim')
            ->count();

        $selesai = $orders
            ->where('status', 'selesai')
            ->count();

        $dibatalkan = $orders
            ->where('status', 'dibatalkan')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN DASHBOARD KASIR
        |--------------------------------------------------------------------------
        */

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
     * Mengubah status pesanan pelanggan.
     */
    public function updateStatus(
        Request $request,
        Order $order
    ) {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI STATUS
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'status' => [
                'required',
                'in:pending,diproses,dikirim,selesai,dibatalkan',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS PESANAN
        |--------------------------------------------------------------------------
        */

        $order->update([
            'status' => $request->status,
        ]);


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE DASHBOARD KASIR
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('kasir.dashboard')
            ->with(
                'success',
                'Status pesanan #' .
                $order->id .
                ' berhasil diperbarui menjadi ' .
                ucfirst($request->status) .
                '.'
            );
    }
}
