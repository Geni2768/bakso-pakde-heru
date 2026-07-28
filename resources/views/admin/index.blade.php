@extends('layouts.app')

@section('title', 'Kelola Pesanan - Bakso Pakde Heru')

@section('content')

<div class="container py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="fw-bold">Kelola Pesanan</h2>
        <p class="text-muted">
            Lihat dan kelola seluruh pesanan pelanggan.
        </p>
    </div>

    {{-- PESAN SUKSES --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- PESAN ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- JIKA BELUM ADA PESANAN --}}
    @if($orders->isEmpty())

        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">

                <div style="font-size: 60px;">📦</div>

                <h4 class="fw-bold mt-3">
                    Belum Ada Pesanan
                </h4>

                <p class="text-muted">
                    Belum ada pesanan yang masuk dari pelanggan.
                </p>

            </div>
        </div>

    @else

        {{-- DAFTAR PESANAN --}}
        @foreach($orders as $order)

            @php
                $statusClass = match($order->status) {
                    'pending' => 'bg-warning text-dark',
                    'diproses' => 'bg-info text-dark',
                    'siap' => 'bg-primary text-white',
                    'selesai' => 'bg-success text-white',
                    'dibatalkan' => 'bg-danger text-white',
                    default => 'bg-secondary text-white',
                };
            @endphp

            <div class="card border-0 shadow-sm mb-4">

                {{-- HEADER PESANAN --}}
                <div class="card-header bg-white py-3">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Pesanan #{{ $order->id }}
                            </h5>

                            <small class="text-muted">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </small>
                        </div>

                        <span class="badge {{ $statusClass }} px-3 py-2">
                            {{ ucfirst($order->status) }}
                        </span>

                    </div>

                </div>

                {{-- ISI PESANAN --}}
                <div class="card-body">

                    <div class="row g-4">

                        {{-- INFORMASI PELANGGAN --}}
                        <div class="col-md-5">

                            <h6 class="fw-bold mb-3">
                                Informasi Pelanggan
                            </h6>

                            <p class="mb-2">
                                👤
                                <strong>{{ $order->nama_lengkap }}</strong>
                            </p>

                            <p class="mb-2">
                                📱
                                {{ $order->no_whatsapp }}
                            </p>

                            <p class="mb-2">
                                📍
                                {{ $order->alamat }}
                            </p>

                        </div>

                        {{-- ITEM PESANAN --}}
                        <div class="col-md-7">

                            <h6 class="fw-bold mb-3">
                                Detail Pesanan
                            </h6>

                            @foreach($order->items as $item)

                                <div class="d-flex justify-content-between border-bottom py-2">

                                    <div>
                                        <strong>
                                            {{ $item->menu->nama_menu ?? 'Menu' }}
                                        </strong>

                                        <br>

                                        <small class="text-muted">
                                            {{ $item->jumlah }}
                                            x
                                            Rp{{ number_format($item->harga, 0, ',', '.') }}
                                        </small>
                                    </div>

                                    <strong>
                                        Rp{{ number_format($item->jumlah * $item->harga, 0, ',', '.') }}
                                    </strong>

                                </div>

                            @endforeach

                            <div class="d-flex justify-content-between mt-3">

                                <strong>
                                    Total Pesanan
                                </strong>

                                <strong class="text-primary">
                                    Rp{{ number_format($order->total_harga, 0, ',', '.') }}
                                </strong>

                            </div>

                        </div>

                    </div>

                    <hr>

                    {{-- PEMBAYARAN --}}
                    @if($order->payment)

                        <div class="mb-4">

                            <h6 class="fw-bold mb-3">
                                Pembayaran
                            </h6>

                            <div class="row">

                                <div class="col-md-6">
                                    <span class="text-muted">
                                        Metode
                                    </span>

                                    <br>

                                    <strong>
                                        {{ strtoupper($order->payment->metode_pembayaran) }}
                                    </strong>
                                </div>

                                <div class="col-md-6">
                                    <span class="text-muted">
                                        Status
                                    </span>

                                    <br>

                                    <strong>
                                        {{ ucfirst($order->payment->status) }}
                                    </strong>
                                </div>

                            </div>

                        </div>

                    @endif

                    {{-- UPDATE STATUS --}}
                    <div>

                        <h6 class="fw-bold mb-3">
                            Update Status Pesanan
                        </h6>

                        <form
                            action="{{ route('admin.orders.updateStatus', $order->id) }}"
                            method="POST"
                            class="row g-2"
                        >

                            @csrf
                            @method('PATCH')

                            <div class="col-md-8">

                                <select
                                    name="status"
                                    class="form-select"
                                    required
                                >

                                    <option
                                        value="pending"
                                        {{ $order->status === 'pending' ? 'selected' : '' }}
                                    >
                                        Pending
                                    </option>

                                    <option
                                        value="diproses"
                                        {{ $order->status === 'diproses' ? 'selected' : '' }}
                                    >
                                        Diproses
                                    </option>

                                    <option
                                        value="siap"
                                        {{ $order->status === 'siap' ? 'selected' : '' }}
                                    >
                                        Siap Diambil / Dikirim
                                    </option>

                                    <option
                                        value="selesai"
                                        {{ $order->status === 'selesai' ? 'selected' : '' }}
                                    >
                                        Selesai
                                    </option>

                                    <option
                                        value="dibatalkan"
                                        {{ $order->status === 'dibatalkan' ? 'selected' : '' }}
                                    >
                                        Dibatalkan
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-4">

                                <button
                                    type="submit"
                                    class="btn btn-primary w-100"
                                >
                                    💾 Update Status
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        @endforeach

    @endif

</div>

@endsection
