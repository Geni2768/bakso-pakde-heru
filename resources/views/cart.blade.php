@extends('layouts.app')

@section('title', 'Keranjang & Checkout - Bakso Pakde Heru')

@section('content')

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">🛒 Keranjang & Checkout</h1>
        <p class="text-muted">
            Periksa pesanan dan lengkapi data pengiriman.
        </p>
    </div>

    {{-- PESAN ERROR --}}
    @if (session('error'))
        <div class="alert alert-danger">
            <strong>Checkout gagal:</strong>
            {{ session('error') }}
        </div>
    @endif

    {{-- PESAN SUKSES --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- JIKA KERANJANG KOSONG --}}
    @if (empty($cart))

        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">

                <div style="font-size: 60px;">
                    🛒
                </div>

                <h3 class="mt-3">
                    Keranjang Masih Kosong
                </h3>

                <p class="text-muted">
                    Yuk pilih menu favorit kamu terlebih dahulu.
                </p>

                <a
                    href="{{ route('customer.menu') }}"
                    class="btn btn-danger"
                >
                    Lihat Menu
                </a>

            </div>
        </div>

    @else

        <div class="row g-4">

            {{-- DAFTAR PESANAN --}}
            <div class="col-lg-7">

                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">
                            🍜 Detail Pesanan
                        </h4>
                    </div>

                    <div class="card-body">

                        @foreach ($cart as $id => $item)

                            <div class="row align-items-center border-bottom py-3">

                                <div class="col-md-5">

                                    <h5 class="mb-1">
                                        {{ $item['nama'] }}
                                    </h5>

                                    <small class="text-muted">
                                        Harga:
                                        Rp{{ number_format($item['harga'], 0, ',', '.') }}
                                    </small>

                                </div>

                                <div class="col-md-3 mt-2 mt-md-0">

                                    <form
                                        action="{{ route('cart.update', $id) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('PATCH')

                                        <label class="form-label">
                                            Jumlah
                                        </label>

                                        <input
                                            type="number"
                                            name="qty"
                                            value="{{ $item['qty'] }}"
                                            min="1"
                                            class="form-control"
                                            onchange="this.form.submit()"
                                        >

                                    </form>

                                </div>

                                <div class="col-md-3 text-md-end mt-3 mt-md-0">

                                    <strong class="text-danger">

                                        Rp{{
                                            number_format(
                                                $item['harga'] * $item['qty'],
                                                0,
                                                ',',
                                                '.'
                                            )
                                        }}

                                    </strong>

                                </div>

                                <div class="col-md-1 text-md-end mt-3 mt-md-0">

                                    <form
                                        action="{{ route('cart.delete', $id) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Hapus menu ini dari keranjang?')"
                                        >
                                            🗑️
                                        </button>

                                    </form>

                                </div>

                            </div>

                        @endforeach

                        <div class="d-flex justify-content-between align-items-center pt-4">

                            <h4 class="mb-0">
                                Total Pesanan
                            </h4>

                            <h3 class="text-danger mb-0">

                                Rp{{ number_format($total, 0, ',', '.') }}

                            </h3>

                        </div>

                    </div>

                </div>

            </div>


            {{-- FORM CHECKOUT --}}
            <div class="col-lg-5">

                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-dark text-white">

                        <h4 class="mb-0">
                            Checkout Pesanan
                        </h4>

                    </div>

                    <div class="card-body">

                        @auth

                            <div class="alert alert-light border">

                                <strong>
                                    Pesanan atas nama:
                                </strong>

                                <br>

                                {{ auth()->user()->name }}

                                <br>

                                <small class="text-muted">

                                    {{ auth()->user()->email }}

                                </small>

                            </div>

                        @endauth


                        <form
                            action="{{ route('checkout') }}"
                            method="POST"
                        >

                            @csrf


                            {{-- NAMA --}}
                            <div class="mb-3">

                                <label class="form-label">

                                    Nama Lengkap

                                </label>

                                <input
                                    type="text"
                                    name="nama_lengkap"
                                    class="form-control @error('nama_lengkap') is-invalid @enderror"
                                    value="{{ old('nama_lengkap', auth()->user()->name ?? '') }}"
                                    required
                                >

                                @error('nama_lengkap')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>


                            {{-- WHATSAPP --}}
                            <div class="mb-3">

                                <label class="form-label">

                                    No. WhatsApp

                                </label>

                                <input
                                    type="text"
                                    name="no_whatsapp"
                                    class="form-control @error('no_whatsapp') is-invalid @enderror"
                                    value="{{ old('no_whatsapp') }}"
                                    placeholder="Contoh: 081234567890"
                                    required
                                >

                                @error('no_whatsapp')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>


                            {{-- ALAMAT --}}
                            <div class="mb-3">

                                <label class="form-label">

                                    Alamat

                                </label>

                                <textarea
                                    name="alamat"
                                    rows="3"
                                    class="form-control @error('alamat') is-invalid @enderror"
                                    placeholder="Masukkan alamat lengkap"
                                    required
                                >{{ old('alamat') }}</textarea>

                                @error('alamat')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>


                           {{-- PEMBAYARAN --}}
<div class="mb-4">

    <label class="form-label">
        Metode Pembayaran
    </label>

    <select
        name="metode_pembayaran"
        class="form-select @error('metode_pembayaran') is-invalid @enderror"
        required
    >

        <option value="">
            -- Pilih Metode Pembayaran --
        </option>

        <option
            value="cod"
            {{ old('metode_pembayaran') == 'cod' ? 'selected' : '' }}
        >
            Tunai / COD
        </option>

        <option
            value="transfer"
            {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}
        >
            Transfer
        </option>

    </select>

    @error('metode_pembayaran')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


                            {{-- TOTAL --}}
                            <div class="alert alert-warning">

                                <div class="d-flex justify-content-between">

                                    <strong>
                                        Total Bayar
                                    </strong>

                                    <strong>

                                        Rp{{ number_format($total, 0, ',', '.') }}

                                    </strong>

                                </div>

                            </div>


                            {{-- TOMBOL --}}
                            <button
                                type="submit"
                                class="btn btn-danger w-100 py-2"
                            >

                                🍜 Buat Pesanan

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    @endif

</div>

@endsection

