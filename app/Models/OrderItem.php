@extends('layouts.app')

@section('title', 'Kelola Pesanan - Bakso Pakde Heru')

@section('content')

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="page-title mb-1">
                Kelola Pesanan
            </h1>

            <p class="page-subtitle mb-0">
                Lihat dan kelola seluruh pesanan pelanggan.
            </p>
        </div>

    </div>


    {{-- PESAN SUKSES --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- PESAN ERROR --}}
    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    {{-- JIKA BELUM ADA PESANAN --}}
    @if($orders->isEmpty())

        <div class="empty-menu text-center">

            <div class="empty-menu-icon">
                📦
            </div>

            <div class="empty-menu-title">
                Belum Ada Pesanan
            </div>

            <div class="empty-menu-text">
                Belum ada pesanan yang masuk dari pelanggan.
            </div>

        </div>

    @else

        {{-- DAFTAR PESANAN --}}
        <div class="row g-4">

            @foreach($orders as $order)

                <div class="col-12">

                    <div class="card shadow-sm border-0">

                        {{-- HEADER PESANAN --}}
                        <div class="card-header bg-white p-3">

                            <div class="row align-items-center">

                                <div class="col-md-6">

                                    <h5 class="mb-1">
                                        Pesanan #{{ $order->id }}
                                    </h5>

                                    <div class="text-muted small">

                                        {{ $order->created_at->format(
                                            'd M Y, H:i'
                                        ) }}

                                    </div>

                                </div>


                                <div class="col-md-6 text-md-end mt-2 mt-md-0">

                                    @php

                                        $statusClass = match(
                                            $order->status
                                        ) {

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


                                    <span
                                        class="badge {{ $statusClass }}"
                                    >

                                        {{ ucfirst(
                                            $order->status
                                        ) }}

                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- ISI PESANAN --}}
                        <div class="card-body">

                            {{-- INFORMASI PELANGGAN --}}
                            <div class="mb-3">

                                <h6 class="fw-bold">
                                    Informasi Pelanggan
                                </h6>

                                <div class="text-muted small">

                                    <div>
                                        👤
                                        {{ $order->nama_lengkap }}
                                    </div>

                                    <div>
                                        📱
                                        {{ $order->no_whatsapp }}
                                    </div>

                                    <div>
                                        📍
                                        {{ $order->alamat }}
                                    </div>

                                </div>

                            </div>


                            <hr>


                            {{-- ITEM PESANAN --}}
                            <h6 class="fw-bold mb-3">
                                Detail Pesanan
                            </h6>


                            @foreach($order->items as $item)

                                <div
                                    class="d-flex
                                           justify-content-between
                                           align-items-center
                                           mb-3"
                                >

                                    <div>

                                        <div class="fw-semibold">

                                            {{ $item->menu->nama_menu
                                                ?? 'Menu'
                                            }}

                                        </div>

                                        <div class="text-muted small">

                                            {{ $item->jumlah }}

                                            x

                                            Rp{{ number_format(
                                                $item->harga,
                                                0,
                                                ',',
                                                '.'
                                            ) }}

                                        </div>

                                    </div>


                                    <div class="fw-semibold">

                                        Rp{{ number_format(
                                            $item->jumlah *
                                            $item->harga,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </div>

                                </div>

                            @endforeach


                            <hr>


                            {{-- TOTAL --}}
                            <div
                                class="d-flex
                                       justify-content-between
                                       align-items-center
                                       mb-3"
                            >

                                <span class="fw-bold">
                                    Total Pesanan
                                </span>

                                <span
                                    class="fw-bold
                                           text-danger
                                           fs-5"
                                >

                                    Rp{{ number_format(
                                        $order->total_harga,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </span>

                            </div>


                            {{-- PEMBAYARAN --}}
                            @if($order->payment)

                                <div class="p-3 bg-light rounded mb-3">

                                    <h6 class="fw-bold">
                                        Pembayaran
                                    </h6>

                                    <div class="small">

                                        <div
                                            class="d-flex
                                                   justify-content-between"
                                        >

                                            <span>
                                                Metode
                                            </span>

                                            <strong>
                                                {{ strtoupper(
                                                    $order
                                                        ->payment
                                                        ->metode_pembayaran
                                                ) }}
                                            </strong>

                                        </div>


                                        <div
                                            class="d-flex
                                                   justify-content-between
                                                   mt-2"
                                        >

                                            <span>
                                                Status
                                            </span>

                                            <strong>

                                                {{ ucfirst(
                                                    $order
                                                        ->payment
                                                        ->status
                                                ) }}

                                            </strong>

                                        </div>

                                    </div>

                                </div>

                            @endif


                            {{-- UPDATE STATUS --}}
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

                                    <div class="col-md-8">

                                        <label
                                            class="form-label fw-semibold"
                                        >
                                            Update Status Pesanan
                                        </label>

                                        <select
                                            name="status"
                                            class="form-select"
                                            required
                                        >

                                            <option
                                                value="pending"
                                                @selected(
                                                    $order->status
                                                    === 'pending'
                                                )
                                            >
                                                Pending
                                            </option>

                                            <option
                                                value="diproses"
                                                @selected(
                                                    $order->status
                                                    === 'diproses'
                                                )
                                            >
                                                Diproses
                                            </option>

                                            <option
                                                value="siap"
                                                @selected(
                                                    $order->status
                                                    === 'siap'
                                                )
                                            >
                                                Siap Diambil /
                                                Dikirim
                                            </option>

                                            <option
                                                value="selesai"
                                                @selected(
                                                    $order->status
                                                    === 'selesai'
                                                )
                                            >
                                                Selesai
                                            </option>

                                            <option
                                                value="dibatalkan"
                                                @selected(
                                                    $order->status
                                                    === 'dibatalkan'
                                                )
                                            >
                                                Dibatalkan
                                            </option>

                                        </select>

                                    </div>


                                    <div class="col-md-4">

                                        <button
                                            type="submit"
                                            class="btn btn-danger w-100"
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

        </div>

    @endif

</div>

@endsection
