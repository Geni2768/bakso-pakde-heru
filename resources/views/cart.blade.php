@extends('layouts.app')

@section('title', 'Keranjang - Bakso Pakde Heru')

@section('content')

<style>
    .cart-page {
        padding: 30px 0 50px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 800;
        color: #292929;
        margin-bottom: 5px;
    }

    .page-subtitle {
        font-size: 13px;
        color: #777;
        margin-bottom: 25px;
    }

    .cart-card {
        background: #ffffff;
        border: 1px solid #eeeeee;
        border-radius: 10px;
        overflow: hidden;
    }

    .cart-header {
        padding: 16px 20px;
        border-bottom: 1px solid #eeeeee;
        font-size: 15px;
        font-weight: 700;
    }

    .cart-item {
        padding: 15px 20px;
        border-bottom: 1px solid #eeeeee;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-image {
        width: 75px;
        height: 75px;
        object-fit: cover;
        border-radius: 8px;
        background: #fff3df;
    }

    .cart-no-image {
        width: 75px;
        height: 75px;
        border-radius: 8px;
        background: #fff3df;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
    }

    .cart-name {
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .cart-price {
        font-size: 12px;
        color: #777;
    }

    .cart-subtotal {
        font-size: 14px;
        font-weight: 700;
        color: #d62828;
    }

    .quantity-form {
        display: flex;
        align-items: center;
    }

    .quantity-input {
        width: 55px;
        height: 32px;
        border: 1px solid #dddddd;
        border-radius: 5px;
        text-align: center;
        font-size: 12px;
    }

    .btn-update {
        height: 32px;
        margin-left: 5px;
        padding: 0 10px;
        border: 1px solid #d62828;
        background: white;
        color: #d62828;
        border-radius: 5px;
        font-size: 11px;
        font-weight: 600;
    }

    .btn-update:hover {
        background: #d62828;
        color: white;
    }

    .btn-delete {
        border: none;
        background: transparent;
        color: #dc3545;
        font-size: 12px;
        padding: 5px;
    }

    .btn-delete:hover {
        color: #a71d2a;
    }

    .summary-card {
        background: #ffffff;
        border: 1px solid #eeeeee;
        border-radius: 10px;
        padding: 20px;
        position: sticky;
        top: 90px;
    }

    .summary-title {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        margin-bottom: 12px;
    }

    .summary-total {
        border-top: 1px solid #eeeeee;
        padding-top: 15px;
        margin-top: 15px;
        display: flex;
        justify-content: space-between;
        font-size: 16px;
        font-weight: 800;
        color: #d62828;
    }

    .btn-checkout {
        width: 100%;
        background: #d62828;
        border: none;
        color: white;
        padding: 11px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 700;
        margin-top: 20px;
    }

    .btn-checkout:hover {
        background: #b71c1c;
        color: white;
    }

    .btn-back {
        width: 100%;
        background: white;
        border: 1px solid #d62828;
        color: #d62828;
        padding: 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 10px;
    }

    .btn-back:hover {
        background: #d62828;
        color: white;
    }

    .empty-cart {
        background: white;
        border: 1px solid #eeeeee;
        border-radius: 10px;
        padding: 60px 20px;
        text-align: center;
    }

    .empty-icon {
        font-size: 50px;
        margin-bottom: 10px;
    }

    .empty-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .empty-text {
        color: #777;
        font-size: 13px;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {

        .cart-item {
            padding: 15px;
        }

        .cart-image,
        .cart-no-image {
            width: 60px;
            height: 60px;
        }

        .cart-subtotal {
            margin-top: 10px;
        }

        .summary-card {
            position: static;
            margin-top: 20px;
        }
    }
</style>


<div class="cart-page">

    <div class="container">


        {{-- HEADER --}}

        <div class="text-center">

            <h1 class="page-title">
                Keranjang Saya
            </h1>

            <p class="page-subtitle">
                Periksa pesanan kamu sebelum melakukan checkout.
            </p>

        </div>


        {{-- JIKA KERANJANG KOSONG --}}

        @if(empty($cart))

            <div class="empty-cart">

                <div class="empty-icon">
                    🛒
                </div>

                <div class="empty-title">
                    Keranjang Masih Kosong
                </div>

                <div class="empty-text">
                    Yuk pilih menu favorit kamu terlebih dahulu.
                </div>

                <a
                    href="{{ route('customer.menu') }}"
                    class="btn btn-danger-custom"
                >
                    🍜 Lihat Menu
                </a>

            </div>


        @else


            <div class="row g-4">


                {{-- DAFTAR ITEM --}}

                <div class="col-lg-8">

                    <div class="cart-card">

                        <div class="cart-header">
                            🛒 Daftar Pesanan
                        </div>


                        @foreach($cart as $id => $item)

                            <div class="cart-item">

                                <div class="row align-items-center g-3">


                                    {{-- GAMBAR --}}

                                    <div class="col-auto">

                                        @if(!empty($item['gambar']))

                                            <img
                                                src="{{ asset(
                                                    'storage/' .
                                                    $item['gambar']
                                                ) }}"
                                                alt="{{ $item['nama'] }}"
                                                class="cart-image"
                                            >

                                        @else

                                            <div class="cart-no-image">
                                                🍜
                                            </div>

                                        @endif

                                    </div>


                                    {{-- NAMA DAN HARGA --}}

                                    <div class="col">

                                        <div class="cart-name">
                                            {{ $item['nama'] }}
                                        </div>

                                        <div class="cart-price">

                                            Rp{{ number_format(
                                                $item['harga'],
                                                0,
                                                ',',
                                                '.'
                                            ) }}

                                            / item

                                        </div>

                                    </div>


                                    {{-- JUMLAH --}}

                                    <div class="col-md-auto">

                                        <form
                                            action="{{ route(
                                                'cart.update',
                                                $id
                                            ) }}"
                                            method="POST"
                                            class="quantity-form"
                                        >

                                            @csrf

                                            @method('PATCH')

                                            <input
                                                type="number"
                                                name="qty"
                                                value="{{ $item['qty'] }}"
                                                min="1"
                                                class="quantity-input"
                                            >

                                            <button
                                                type="submit"
                                                class="btn-update"
                                            >
                                                Update
                                            </button>

                                        </form>

                                    </div>


                                    {{-- SUBTOTAL --}}

                                    <div class="col-md-auto">

                                        <div class="cart-subtotal">

                                            Rp{{ number_format(
                                                $item['harga']
                                                *
                                                $item['qty'],
                                                0,
                                                ',',
                                                '.'
                                            ) }}

                                        </div>

                                    </div>


                                    {{-- HAPUS --}}

                                    <div class="col-auto">

                                        <form
                                            action="{{ route(
                                                'cart.delete',
                                                $id
                                            ) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn-delete"
                                                onclick="
                                                    return confirm(
                                                        'Hapus menu ini dari keranjang?'
                                                    )
                                                "
                                            >
                                                🗑️ Hapus
                                            </button>

                                        </form>

                                    </div>


                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>


                {{-- RINGKASAN --}}

                <div class="col-lg-4">

                    <div class="summary-card">

                        <div class="summary-title">
                            Ringkasan Pesanan
                        </div>


                        @php

                            $totalItem = collect(
                                $cart
                            )->sum('qty');

                        @endphp


                        <div class="summary-row">

                            <span>
                                Total Item
                            </span>

                            <strong>
                                {{ $totalItem }}
                            </strong>

                        </div>


                        <div class="summary-row">

                            <span>
                                Jumlah Menu
                            </span>

                            <strong>
                                {{ count($cart) }}
                            </strong>

                        </div>


                        <div class="summary-total">

                            <span>
                                Total
                            </span>

                            <span>
                                Rp{{ number_format(
                                    $total,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </span>

                        </div>


                        {{-- CHECKOUT --}}

                        @auth

                            {{-- PAKAI KOLOM ROLE LANGSUNG, TIDAK PAKAI hasRole() --}}

                            @if(auth()->user()->role === 'pelanggan')

                                <a
                                    href="#checkout"
                                    class="btn btn-checkout"
                                    onclick="
                                        document
                                        .getElementById(
                                            'checkout'
                                        )
                                        .scrollIntoView({
                                            behavior: 'smooth'
                                        });
                                        return false;
                                    "
                                >
                                    💳 Lanjut Checkout
                                </a>

                            @else

                                <div class="alert alert-warning mt-3 mb-0">

                                    Hanya pelanggan yang dapat
                                    melakukan checkout.

                                </div>

                            @endif

                        @else

                            <a
                                href="{{ route('login') }}"
                                class="btn btn-checkout"
                            >
                                🔐 Login untuk Checkout
                            </a>

                        @endauth


                        <a
                            href="{{ route('customer.menu') }}"
                            class="btn btn-back"
                        >
                            ← Kembali ke Menu
                        </a>

                    </div>

                </div>

            </div>


            {{-- CHECKOUT FORM --}}

            @auth

                {{-- PAKAI KOLOM ROLE LANGSUNG, TIDAK PAKAI hasRole() --}}

                @if(auth()->user()->role === 'pelanggan')

                    <div
                        id="checkout"
                        class="row mt-4"
                    >

                        <div class="col-lg-8">

                            <div class="cart-card">

                                <div class="cart-header">
                                    📦 Data Pengiriman & Pembayaran
                                </div>


                                <div class="p-4">

                                    <form
                                        action="{{ route(
                                            'checkout'
                                        ) }}"
                                        method="POST"
                                    >

                                        @csrf


                                        {{-- NAMA --}}

                                        <div class="mb-3">

                                            <label
                                                class="form-label"
                                                style="
                                                    font-size: 13px;
                                                    font-weight: 600;
                                                "
                                            >
                                                Nama Lengkap
                                            </label>

                                            <input
                                                type="text"
                                                name="nama_lengkap"
                                                class="form-control"
                                                value="{{ auth()->user()->name }}"
                                                required
                                            >

                                        </div>


                                        {{-- WHATSAPP --}}

                                        <div class="mb-3">

                                            <label
                                                class="form-label"
                                                style="
                                                    font-size: 13px;
                                                    font-weight: 600;
                                                "
                                            >
                                                Nomor WhatsApp
                                            </label>

                                            <input
                                                type="text"
                                                name="no_whatsapp"
                                                class="form-control"
                                                placeholder="Contoh: 081234567890"
                                                required
                                            >

                                        </div>


                                        {{-- ALAMAT --}}

                                        <div class="mb-3">

                                            <label
                                                class="form-label"
                                                style="
                                                    font-size: 13px;
                                                    font-weight: 600;
                                                "
                                            >
                                                Alamat Pengiriman
                                            </label>

                                            <textarea
                                                name="alamat"
                                                class="form-control"
                                                rows="3"
                                                placeholder="Masukkan alamat lengkap..."
                                                required
                                            ></textarea>

                                        </div>


                                        {{-- PEMBAYARAN --}}

                                        <div class="mb-3">

                                            <label
                                                class="form-label"
                                                style="
                                                    font-size: 13px;
                                                    font-weight: 600;
                                                "
                                            >
                                                Metode Pembayaran
                                            </label>

                                            <select
                                                name="metode_pembayaran"
                                                class="form-select"
                                                required
                                            >

                                                <option value="">
                                                    Pilih pembayaran
                                                </option>

                                                <option value="cod">
                                                    COD
                                                </option>

                                                <option value="transfer">
                                                    Transfer Bank
                                                </option>

                                            </select>

                                        </div>


                                        {{-- SUBMIT --}}

                                        <button
                                            type="submit"
                                            class="btn btn-danger-custom w-100"
                                        >
                                            ✅ Buat Pesanan
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @endif

            @endauth

        @endif

    </div>

</div>

@endsection
