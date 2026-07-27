@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')

<div class="container py-5">

    {{-- HEADER --}}
    <div class="mb-4">
        <h1 class="fw-bold">Pesanan Saya</h1>
        <p class="text-muted">
            Lihat riwayat dan status pesanan yang sudah kamu buat.
        </p>
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- JIKA BELUM ADA PESANAN --}}
    @if($orders->isEmpty())

        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">

                <div style="font-size: 60px;">
                    📦
                </div>

                <h3 class="fw-bold mt-3">
                    Belum Ada Pesanan
                </h3>

                <p class="text-muted">
                    Kamu belum memiliki riwayat pesanan.
                </p>

                <a
                    href="{{ route('customer.menu') }}"
                    class="btn btn-primary"
                >
                    Lihat Menu
                </a>

            </div>
        </div>

    @else

        {{-- DAFTAR PESANAN --}}
        @foreach($orders as $order)

            @php
                $status = strtolower($order->status ?? 'pending');

                $statusLabel = match($status) {
                    'pending' => 'Menunggu',
                    'diproses', 'processing' => 'Diproses',
                    'selesai', 'completed' => 'Selesai',
                    'dibatalkan', 'cancelled' => 'Dibatalkan',
                    default => ucfirst($status),
                };

                $statusClass = match($status) {
                    'pending' => 'warning',
                    'diproses', 'processing' => 'info',
                    'selesai', 'completed' => 'success',
                    'dibatalkan', 'cancelled' => 'danger',
                    default => 'secondary',
                };
            @endphp

            <div class="card shadow-sm border-0 mb-4">

                {{-- HEADER PESANAN --}}
                <div class="card-header bg-white py-3">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Pesanan #{{ $order->id }}
                            </h5>

                            <small class="text-muted">
                                {{ $order->created_at?->format('d M Y, H:i') }}
                            </small>
                        </div>

                        <span class="badge bg-{{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>

                    </div>

                </div>

                {{-- ISI PESANAN --}}
                <div class="card-body">

                    {{-- INFORMASI PESANAN --}}
                    <div class="mb-4">

                        <h6 class="fw-bold mb-3">
                            Informasi Pengiriman
                        </h6>

                        <div class="row">

                            <div class="col-md-4 mb-2">
                                <small class="text-muted d-block">
                                    Nama
                                </small>

                                <strong>
                                    {{ $order->nama_lengkap }}
                                </strong>
                            </div>

                            <div class="col-md-4 mb-2">
                                <small class="text-muted d-block">
                                    WhatsApp
                                </small>

                                <strong>
                                    {{ $order->no_whatsapp }}
                                </strong>
                            </div>

                            <div class="col-md-4 mb-2">
                                <small class="text-muted d-block">
                                    Alamat
                                </small>

                                <strong>
                                    {{ $order->alamat }}
                                </strong>
                            </div>

                        </div>

                    </div>

                    {{-- ITEM PESANAN --}}
                    <h6 class="fw-bold mb-3">
                        Detail Pesanan
                    </h6>

                    @if($order->items->count() > 0)

                        <div class="table-responsive">

                            <table class="table align-middle">

                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th class="text-center">
                                            Jumlah
                                        </th>
                                        <th class="text-end">
                                            Harga
                                        </th>
                                        <th class="text-end">
                                            Subtotal
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($order->items as $item)

                                        <tr>

                                            <td>
                                                <strong>
                                                    {{ $item->menu->nama_menu ?? 'Menu telah dihapus' }}
                                                </strong>
                                            </td>

                                            <td class="text-center">
                                                {{ $item->jumlah }}
                                            </td>

                                            <td class="text-end">
                                                Rp{{ number_format($item->harga, 0, ',', '.') }}
                                            </td>

                                            <td class="text-end fw-bold">
                                                Rp{{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="alert alert-warning">
                            Detail item pesanan tidak ditemukan.
                        </div>

                    @endif

                </div>

                {{-- FOOTER PESANAN --}}
                <div class="card-footer bg-white">

                    <div class="row align-items-center">

                        <div class="col-md-6 mb-2 mb-md-0">

                            <div>
                                <small class="text-muted">
                                    Metode Pembayaran
                                </small>

                                <div class="fw-bold">
                                    {{ ucfirst($order->payment?->metode_pembayaran ?? '-') }}
                                </div>
                            </div>

                            <div class="mt-2">

                                <small class="text-muted">
                                    Status Pembayaran
                                </small>

                                <div class="fw-bold">
                                    {{ ucfirst($order->payment?->status ?? 'pending') }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6 text-md-end">

                            <small class="text-muted d-block">
                                Total Pesanan
                            </small>

                            <h4 class="fw-bold mb-0">
                                Rp{{ number_format($order->total_harga, 0, ',', '.') }}
                            </h4>

                        </div>

                    </div>

                </div>

            </div>

        @endforeach

    @endif

</div>

@endsection
