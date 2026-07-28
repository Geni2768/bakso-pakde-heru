@extends('layouts.app')

@section('title', 'Dashboard Admin - Bakso Pakde Heru')

@section('content')

<div class="container py-5">

    {{-- HEADER --}}
    <div class="mb-5">
        <h1 class="fw-bold">Dashboard Admin</h1>

        <p class="text-muted">
            Selamat datang di halaman administrasi Bakso Pakde Heru.
        </p>
    </div>

    {{-- PESAN --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- INFORMASI ADMIN --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">

            <span class="badge bg-danger mb-2">
                Admin
            </span>

            <h3 class="fw-bold">
                Halo, {{ auth()->user()->name }}!
            </h3>

            <p class="text-muted mb-0">
                Kelola menu, kategori, dan pesanan pelanggan melalui dashboard ini.
            </p>

        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-4 mb-5">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">

                    <div class="fs-1">🍜</div>

                    <p class="text-muted mb-1">
                        Total Menu
                    </p>

                    <h2 class="fw-bold">
                        {{ \App\Models\Menu::count() }}
                    </h2>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">

                    <div class="fs-1">📂</div>

                    <p class="text-muted mb-1">
                        Total Kategori
                    </p>

                    <h2 class="fw-bold">
                        {{ \App\Models\Kategori::count() }}
                    </h2>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">

                    <div class="fs-1">📦</div>

                    <p class="text-muted mb-1">
                        Total Pesanan
                    </p>

                    <h2 class="fw-bold">
                        {{ \App\Models\Order::count() }}
                    </h2>

                </div>
            </div>
        </div>

    </div>

    {{-- MENU ADMIN --}}
    <div class="row g-4">

        {{-- KELOLA MENU --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="fs-1 mb-3">🍜</div>

                    <h5 class="fw-bold">
                        Kelola Menu
                    </h5>

                    <p class="text-muted">
                        Tambah, edit, hapus, dan kelola menu makanan
                        Bakso Pakde Heru.
                    </p>

                    <a href="/menu-admin"
                       class="btn btn-primary w-100">

                        Kelola Menu

                    </a>

                </div>

            </div>
        </div>

        {{-- KELOLA KATEGORI --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="fs-1 mb-3">📂</div>

                    <h5 class="fw-bold">
                        Kelola Kategori
                    </h5>

                    <p class="text-muted">
                        Kelola kategori menu yang tersedia
                        di Bakso Pakde Heru.
                    </p>

                    <a href="/kategori"
                       class="btn btn-warning w-100">

                        Kelola Kategori

                    </a>

                </div>

            </div>
        </div>

        {{-- KELOLA PESANAN --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="fs-1 mb-3">📦</div>

                    <h5 class="fw-bold">
                        Kelola Pesanan
                    </h5>

                    <p class="text-muted">
                        Lihat dan kelola pesanan pelanggan
                        yang masuk.
                    </p>

                    <a href="/admin/orders"
                       class="btn btn-success w-100">

                        Kelola Pesanan

                    </a>

                </div>

            </div>
        </div>

    </div>

</div>

@endsection
