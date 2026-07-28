@extends('layouts.app')

@section('title', 'Dashboard Kasir - Bakso Pakde Heru')

@section('content')

<style>
    body {
        background: #fffaf3;
    }

    .kasir-wrapper {
        padding: 30px 0 50px;
    }

    .dashboard-header {
        background: #fff1da;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 25px;
    }

    .dashboard-title {
        font-size: 28px;
        font-weight: 800;
        color: #333;
        margin-bottom: 5px;
    }

    .dashboard-subtitle {
        color: #777;
        margin: 0;
    }

    .stat-card {
        background: #ffffff;
        border: 1px solid #eeeeee;
        border-radius: 12px;
        padding: 20px;
        height: 100%;
        box-shadow: 0 3px 10px rgba(0,0,0,0.04);
    }

    .stat-label {
        color: #777;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .stat-number {
        font-size: 28px;
        font-weight: 800;
        color: #d62828;
    }

    .order-card {
        background: #ffffff;
        border: 1px solid #eeeeee;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.04);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        border-bottom: 1px solid #eeeeee;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }

    .order-id {
        font-size: 18px;
        font-weight: 800;
        color: #333;
    }

    .order-date {
        color: #777;
        font-size: 12px;
    }

    .customer-name {
        font-weight: 700;
        color: #333;
    }

    .customer-info {
        color: #666;
        font-size: 13px;
        line-height: 1.7;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px dashed #eeeeee;
        gap: 15px;
    }

    .item-name {
        font-weight: 600;
        color: #333;
    }

    .item-qty {
        color: #777;
        font-size: 13px;
    }

    .item-price {
        font-weight: 700;
        color: #d62828;
        white-space: nowrap;
    }

    .order-total {
        display: flex;
        justify-content: space-between;
        padding-top: 15px;
        margin-top: 5px;
        font-weight: 800;
        font-size: 17px;
    }

    .payment-info {
        background: #fffaf3;
        border-radius: 8px;
        padding: 12px;
        margin-top: 15px;
        font-size: 13px;
    }

    .status-form {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 15px;
        flex-wrap: wrap;
    }

    .status-select {
        min-width: 180px;
        border-radius: 7px;
        border: 1px solid #ddd;
        padding: 9px 12px;
        font-size: 13px;
    }

    .btn-update {
        background: #d62828;
        color: white;
        border: none;
        padding: 9px 18px;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-update:hover {
        background: #b71c1c;
        color: white;
    }

    .status-badge {
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-diproses {
        background: #cfe2ff;
        color: #084298;
    }

    .status-dikirim {
        background: #d1ecf1;
        color: #0c5460;
    }

    .status-selesai {
        background: #d1e7dd;
        color: #0f5132;
    }

    .status-dibatalkan {
        background: #f8d7da;
        color: #842029;
    }

    .empty-order {
        background: white;
        border: 1px solid #eeeeee;
        border-radius: 12px;
        padding: 50px 20px;
        text-align: center;
        color: #777;
    }

    .empty-icon {
        font-size: 50px;
        margin-bottom: 15px;
    }

    .alert-custom {
        border-radius: 10px;
        font-size: 14px;
    }
</style>


<div class="container kasir-wrapper">

    {{-- HEADER --}}
    <div class="dashboard-header">

        <div class="dashboard-title">
            Dashboard Kasir
        </div>

        <p class="dashboard-subtitle">
            Kelola pesanan pelanggan dan perbarui status pesanan
            Bakso Pakde Heru.
        </p>

    </div>


    {{-- PESAN SUKSES --}}
    @if(session('success'))

        <div class="alert alert-success alert-custom">
            {{ session('success') }}
        </div>

    @endif


    {{-- PESAN ERROR --}}
    @if(session('error'))

        <div class="alert alert-danger alert-custom">
            {{ session('error') }}
        </div>

    @endif


    {{-- VALIDASI ERROR --}}
    @if($errors->any())

        <div class="alert alert-danger alert-custom">

            <strong>Terjadi kesalahan:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- STATISTIK PESANAN --}}
    <div class="row g-3 mb-4">

        {{-- TOTAL --}}
        <div class="col-6 col-md-4 col-lg-2">

            <div class="stat-card">

                <div class="stat-label">
                    Total Pesanan
                </div>

                <div class="stat-number">
                    {{ $totalPesanan ?? 0 }}
                </div>

            </div>

        </div>


        {{-- PENDING --}}
        <div class="col-6 col-md-4 col-lg-2">

            <div class="stat-card">

                <div class="stat-label">
                    Pending
                </div>

                <div class="stat-number">
                    {{ $pending ?? 0 }}
                </div>

            </div>

        </div>


        {{-- DIPROSES --}}
        <div class="col-6 col-md-4 col-lg-2">

            <div class="stat-card">

                <div class="stat-label">
                    Diproses
                </div>

                <div class="stat-number">
                    {{ $diproses ?? 0 }}
                </div>

            </div>

        </div>


        {{-- DIKIRIM --}}
        <div class="col-6 col-md-4 col-lg-2">

            <div class="stat-card">

                <div class="stat-label">
                    Dikirim
                </div>

                <div class="stat-number">
                    {{ $dikirim ?? 0 }}
                </div>

            </div>

        </div>


        {{-- SELESAI --}}
        <div class="col-6 col-md-4 col-lg-2">

            <div class="stat-card">

                <div class="stat-label">
                    Selesai
                </div>

                <div class="stat-number">
                    {{ $selesai ?? 0 }}
                </div>

            </div>

        </div>


        {{-- DIBATALKAN --}}
        <div class="col-6 col-md-4 col-lg-2">

            <div class="stat-card">

                <div class="stat-label">
                    Dibatalkan
                </div>

                <div class="stat-number">
                    {{ $dibatalkan ?? 0 }}
                </div>

            </div>

        </div>

    </div>


    {{-- JUDUL DAFTAR PESANAN --}}
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="fw-bold mb-0">
            Daftar Pesanan Pelanggan
        </h4>

        <span class="text-muted" style="font-size: 13px;">
            {{ $orders->count() }} pesanan
        </span>

    </div>


    {{-- DAFTAR PESANAN --}}
    @forelse($orders as $order)

        <div class="order-card">

            {{-- HEADER PESANAN --}}
            <div class="order-header">

                <div>

                    <div class="order-id">
                        Pesanan #{{ $order->id }}
                    </div>

                    <div class="order-date">
                        {{ $order->created_at
                            ? $order->created_at->format('d M Y, H:i')
                            : '-'
                        }}
                    </div>

                </div>


                {{-- STATUS --}}
                <div>

                    @php
                        $statusClass = match($order->status) {
                            'pending' => 'status-pending',
                            'diproses' => 'status-diproses',
                            'dikirim' => 'status-dikirim',
                            'selesai' => 'status-selesai',
                            'dibatalkan' => 'status-dibatalkan',
                            default => 'status-pending',
                        };
                    @endphp

                    <span class="status-badge {{ $statusClass }}">

                        {{ ucfirst($order->status ?? 'pending') }}

                    </span>

                </div>

            </div>


            {{-- INFORMASI PELANGGAN --}}
            <div class="mb-3">

                <div class="customer-name">
                    👤
                    {{ $order->nama_lengkap
                        ?? $order->user->name
                        ?? 'Pelanggan'
                    }}
                </div>

                <div class="customer-info">

                    📱
                    {{ $order->no_whatsapp ?? '-' }}

                    <br>

                    📍
                    {{ $order->alamat ?? '-' }}

                </div>

            </div>


            {{-- DETAIL ITEM PESANAN --}}
            <div>

                <strong>
                    Detail Pesanan
                </strong>


                @forelse($order->items as $item)

                    <div class="order-item">

                        <div>

                            <div class="item-name">

                                {{ $item->menu->nama_menu
                                    ?? 'Menu dihapus'
                                }}

                            </div>

                            <div class="item-qty">

                                {{ $item->qty ?? 0 }}
                                x
                                Rp{{ number_format(
                                    $item->harga_satuan ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </div>

                        </div>


                        <div class="item-price">

                            Rp{{ number_format(
                                ($item->harga_satuan ?? 0) *
                                ($item->qty ?? 0),
                                0,
                                ',',
                                '.'
                            ) }}

                        </div>

                    </div>

                @empty

                    <div class="text-muted mt-2">
                        Tidak ada detail item pesanan.
                    </div>

                @endforelse

            </div>


            {{-- PEMBAYARAN --}}
            <div class="payment-info">

                <strong>
                    💳 Pembayaran:
                </strong>

                {{ $order->payment->metode_pembayaran
                    ?? '-'
                }}

                <br>

                <strong>
                    Status:
                </strong>

                {{ $order->payment->status
                    ?? '-'
                }}

            </div>


            {{-- TOTAL --}}
            <div class="order-total">

                <span>
                    Total Pesanan
                </span>

                <span style="color:#d62828;">

                    Rp{{ number_format(
                        $order->total_harga ?? 0,
                        0,
                        ',',
                        '.'
                    ) }}

                </span>

            </div>


            {{-- UPDATE STATUS --}}
            <form
                action="{{ route(
                    'kasir.orders.updateStatus',
                    $order->id
                ) }}"
                method="POST"
                class="status-form"
            >

                @csrf

                @method('PATCH')


                <select
                    name="status"
                    class="status-select"
                >

                    <option
                        value="pending"
                        {{ $order->status === 'pending'
                            ? 'selected'
                            : ''
                        }}
                    >
                        Pending
                    </option>

                    <option
                        value="diproses"
                        {{ $order->status === 'diproses'
                            ? 'selected'
                            : ''
                        }}
                    >
                        Diproses
                    </option>

                    <option
                        value="dikirim"
                        {{ $order->status === 'dikirim'
                            ? 'selected'
                            : ''
                        }}
                    >
                        Dikirim
                    </option>

                    <option
                        value="selesai"
                        {{ $order->status === 'selesai'
                            ? 'selected'
                            : ''
                        }}
                    >
                        Selesai
                    </option>

                    <option
                        value="dibatalkan"
                        {{ $order->status === 'dibatalkan'
                            ? 'selected'
                            : ''
                        }}
                    >
                        Dibatalkan
                    </option>

                </select>


                <button
                    type="submit"
                    class="btn-update"
                >
                    🔄 Update Status
                </button>

            </form>

        </div>

    @empty

        {{-- JIKA BELUM ADA PESANAN --}}
        <div class="empty-order">

            <div class="empty-icon">
                📦
            </div>

            <h5 class="fw-bold">
                Belum Ada Pesanan
            </h5>

            <p class="mb-0">
                Saat ini belum ada pesanan pelanggan
                yang masuk ke sistem.
            </p>

        </div>

    @endforelse

</div>

@endsection
