@extends('layouts.app')

@section('title', 'Kelola Pesanan - Bakso Pakde Heru')

@section('content')

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">📦 Kelola Pesanan</h2>
            <p class="text-muted mb-0">
                Lihat dan kelola seluruh pesanan pelanggan.
            </p>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-outline-primary">
            ← Dashboard
        </a>
    </div>


    {{-- PESAN SUKSES --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- PESAN ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- JIKA BELUM ADA PESANAN --}}
    @if($orders->isEmpty())

        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">

                <div style="font-size: 70px;">
                    📦
                </div>

                <h4 class="fw-bold mt-3">
                    Belum Ada Pesanan
                </h4>

                <p class="text-muted">
                    Belum ada pesanan yang masuk dari pelanggan.
                </p>

                <a href="{{ route('customer.menu') }}"
                   class="btn btn-primary">
                    Lihat Menu
                </a>

            </div>
        </div>

    @else

        {{-- JUMLAH PESANAN --}}
        <div class="alert alert-info mb-4">
            <strong>{{ $orders->count() }}</strong>
            pesanan ditemukan.
        </div>


        {{-- DAFTAR PESANAN --}}
        @foreach($orders as $order)

            @php

                $statusClass = match($order->status) {

                    'pending' =>
                        'bg-warning text-dark',

                    'diproses' =>
                        'bg-info text-dark',

                    'siap' =>
                        'bg-primary',

                    'selesai' =>
                        'bg-success',

                    'dibatalkan' =>
                        'bg-danger',

                    default =>
                        'bg-secondary',
                };

            @endphp


            <div class="card border-0 shadow-sm mb-4">

                {{-- HEADER PESANAN --}}
                <div class="card-header bg-white py-3">

                    <div class="row align-items-center">

                        <div class="col-md-6">

                            <h5 class="fw-bold mb-1">
                                🧾 Pesanan #{{ $order->id }}
                            </h5>

                            <small class="text-muted">

                                @if($order->created_at)

                                    {{ $order->created_at->format('d M Y, H:i') }}

                                @endif

                            </small>

                        </div>


                        <div class="col-md-6 text-md-end mt-2 mt-md-0">

                            <span class="badge {{ $statusClass }} px-3 py-2">

                                {{ ucfirst($order->status) }}

                            </span>

                        </div>

                    </div>

                </div>


                {{-- ISI PESANAN --}}
                <div class="card-body">

                    <div class="row g-4">


                        {{-- INFORMASI PELANGGAN --}}
                        <div class="col-lg-5">

                            <div class="border rounded p-3 h-100">

                                <h6 class="fw-bold mb-3">
                                    👤 Informasi Pelanggan
                                </h6>

                                <div class="mb-2">

                                    <strong>Nama:</strong><br>

                                    {{ $order->nama_lengkap ?? '-' }}

                                </div>

                                <div class="mb-2">

                                    <strong>No. WhatsApp:</strong><br>

                                    {{ $order->no_whatsapp ?? '-' }}

                                </div>

                                <div>

                                    <strong>Alamat:</strong><br>

                                    {{ $order->alamat ?? '-' }}

                                </div>

                            </div>

                        </div>


                        {{-- DETAIL PESANAN --}}
                        <div class="col-lg-7">

                            <div class="border rounded p-3">

                                <h6 class="fw-bold mb-3">
                                    🍜 Detail Pesanan
                                </h6>


                                @forelse($order->items as $item)

                                    <div class="d-flex justify-content-between
                                                align-items-center
                                                border-bottom
                                                py-2">

                                        <div>

                                            <div class="fw-bold">

                                                {{ $item->menu->nama_menu ?? 'Menu' }}

                                            </div>

                                            <small class="text-muted">

                                                {{ $item->jumlah }}

                                                x

                                                Rp{{ number_format($item->harga, 0, ',', '.') }}

                                            </small>

                                        </div>


                                        <strong>

                                            Rp{{ number_format(
                                                $item->jumlah * $item->harga,
                                                0,
                                                ',',
                                                '.'
                                            ) }}

                                        </strong>

                                    </div>

                                @empty

                                    <p class="text-muted mb-0">
                                        Tidak ada item pesanan.
                                    </p>

                                @endforelse


                                {{-- TOTAL --}}
                                <div class="d-flex justify-content-between
                                            align-items-center
                                            mt-3">

                                    <strong>
                                        Total Pesanan
                                    </strong>

                                    <strong class="text-primary fs-5">

                                        Rp{{ number_format(
                                            $order->total_harga,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- PEMBAYARAN --}}
                    @if($order->payment)

                        <div class="border rounded p-3 mt-4">

                            <h6 class="fw-bold mb-3">
                                💳 Pembayaran
                            </h6>

                            <div class="row">

                                <div class="col-md-6">

                                    <strong>
                                        Metode Pembayaran
                                    </strong>

                                    <p class="mb-0">

                                        {{ strtoupper(
                                            $order->payment->metode_pembayaran
                                        ) }}

                                    </p>

                                </div>


                                <div class="col-md-6">

                                    <strong>
                                        Status Pembayaran
                                    </strong>

                                    <p class="mb-0">

                                        <span class="badge bg-secondary">

                                            {{ ucfirst(
                                                $order->payment->status
                                            ) }}

                                        </span>

                                    </p>

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- UPDATE STATUS --}}
                    <div class="border rounded p-3 mt-4 bg-light">

                        <h6 class="fw-bold mb-3">
                            🔄 Update Status Pesanan
                        </h6>

                        <form
                            action="{{ route(
                                'admin.orders.updateStatus',
                                $order->id
                            ) }}"
                            method="POST"
                        >

                            @csrf

                            @method('PATCH')


                            <div class="row g-2 align-items-end">

                                <div class="col-md-9">

                                    <label class="form-label">
                                        Status Pesanan
                                    </label>

                                    <select
                                        name="status"
                                        class="form-select"
                                        required
                                    >

                                        <option
                                            value="pending"
                                            {{ $order->status === 'pending'
                                                ? 'selected'
                                                : '' }}
                                        >
                                            Pending
                                        </option>

                                        <option
                                            value="diproses"
                                            {{ $order->status === 'diproses'
                                                ? 'selected'
                                                : '' }}
                                        >
                                            Diproses
                                        </option>

                                        <option
                                            value="siap"
                                            {{ $order->status === 'siap'
                                                ? 'selected'
                                                : '' }}
                                        >
                                            Siap Diambil / Dikirim
                                        </option>

                                        <option
                                            value="selesai"
                                            {{ $order->status === 'selesai'
                                                ? 'selected'
                                                : '' }}
                                        >
                                            Selesai
                                        </option>

                                        <option
                                            value="dibatalkan"
                                            {{ $order->status === 'dibatalkan'
                                                ? 'selected'
                                                : '' }}
                                        >
                                            Dibatalkan
                                        </option>

                                    </select>

                                </div>


                                <div class="col-md-3">

                                    <button
                                        type="submit"
                                        class="btn btn-primary w-100"
                                    >
                                        💾 Update Status
                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        @endforeach

    @endif

</div>

@endsection
