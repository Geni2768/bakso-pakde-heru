<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Kelola Pesanan - Bakso Pakde Heru
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #fffaf3;
            font-size: 14px;
        }

        .navbar-custom {
            background: #ffffff;
            border-bottom: 1px solid #eeeeee;
        }

        .brand {
            color: #d62828;
            text-decoration: none;
            font-weight: 800;
            font-size: 18px;
        }

        .page {
            padding: 35px 0;
        }

        .page-title {
            font-size: 26px;
            font-weight: 800;
        }

        .page-subtitle {
            color: #777;
            margin-bottom: 30px;
        }

        .order-card {
            background: #ffffff;
            border: 1px solid #eeeeee;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
        }

        .order-id {
            font-weight: 800;
            color: #d62828;
            font-size: 18px;
        }

        .order-info {
            color: #666;
            font-size: 13px;
            margin-top: 8px;
        }

        .empty-box {
            background: #ffffff;
            border: 1px solid #eeeeee;
            border-radius: 10px;
            padding: 50px 20px;
            text-align: center;
        }

        .empty-icon {
            font-size: 45px;
            margin-bottom: 15px;
        }

        .empty-title {
            font-weight: 700;
            font-size: 18px;
        }

        .empty-text {
            color: #777;
            margin-top: 5px;
        }

        .btn-custom {
            background: #d62828;
            color: #ffffff;
            text-decoration: none;
            padding: 9px 17px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            border: none;
        }

        .btn-custom:hover {
            background: #b71c1c;
            color: #ffffff;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-diproses {
            background: #cff4fc;
            color: #055160;
        }

        .status-dikirim {
            background: #cfe2ff;
            color: #084298;
        }

        .status-selesai {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-dibatalkan {
            background: #f8d7da;
            color: #842029;
        }

    </style>

</head>


<body>


    {{-- NAVBAR --}}

    <nav class="navbar-custom">

        <div class="container py-3 d-flex justify-content-between align-items-center">

            <a
                href="{{ route('admin.dashboard') }}"
                class="brand"
            >
                🍜 Bakso Pakde Heru
            </a>


            <a
                href="{{ route('admin.dashboard') }}"
                class="btn-custom"
            >
                ← Kembali ke Dashboard
            </a>

        </div>

    </nav>


    {{-- HALAMAN --}}

    <main class="page">

        <div class="container">


            {{-- HEADER --}}

            <h1 class="page-title">
                Kelola Pesanan
            </h1>

            <p class="page-subtitle">
                Lihat seluruh pesanan yang masuk dari pelanggan.
            </p>


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


            {{-- DAFTAR PESANAN --}}

            @forelse($orders as $order)

                @php

                    $status = strtolower(
                        $order->status ?? 'pending'
                    );

                    $statusClass = match($status) {

                        'diproses' => 'status-diproses',

                        'dikirim' => 'status-dikirim',

                        'selesai' => 'status-selesai',

                        'dibatalkan' => 'status-dibatalkan',

                        default => 'status-pending',

                    };

                    $statusLabel = match($status) {

                        'pending' => 'Menunggu',

                        'diproses' => 'Diproses',

                        'dikirim' => 'Dikirim',

                        'selesai' => 'Selesai',

                        'dibatalkan' => 'Dibatalkan',

                        default => ucfirst($status),

                    };

                @endphp


                <div class="order-card">


                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                        <div class="order-id">
                            Pesanan #{{ $order->id }}
                        </div>


                        <span class="status-badge {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>

                    </div>


                    <div class="order-info">

                        Nama Pelanggan:

                        <strong>
                            {{ $order->nama_lengkap ?? '-' }}
                        </strong>

                    </div>


                    <div class="order-info">

                        WhatsApp:

                        <strong>
                            {{ $order->no_whatsapp ?? '-' }}
                        </strong>

                    </div>


                    <div class="order-info">

                        Alamat:

                        <strong>
                            {{ $order->alamat ?? '-' }}
                        </strong>

                    </div>


                    <div class="order-info">

                        Total:

                        <strong>
                            Rp{{ number_format(
                                $order->total_harga ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}
                        </strong>

                    </div>


                    <div class="order-info">

                        Dibuat:

                        {{ $order->created_at
                            ? $order->created_at->format('d M Y H:i')
                            : '-'
                        }}

                    </div>


                    {{-- DETAIL ITEM --}}

                    @if($order->items && $order->items->count() > 0)

                        <hr>

                        <div class="order-info">

                            <strong>
                                Detail Pesanan:
                            </strong>

                        </div>


                        <ul class="mt-2 mb-3">

                            @foreach($order->items as $item)

                                <li>

                                    {{ $item->menu->nama_menu ?? 'Menu telah dihapus' }}

                                    -

                                    {{ $item->jumlah }} x

                                    Rp{{ number_format(
                                        $item->harga,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </li>

                            @endforeach

                        </ul>

                    @endif


                    {{-- FORM UPDATE STATUS --}}

                    <hr>

                    <form
                        action="{{ route(
                            'admin.orders.updateStatus',
                            $order
                        ) }}"
                        method="POST"
                        class="row g-2 align-items-end"
                    >

                        @csrf

                        @method('PATCH')


                        <div class="col-md-8">

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
                                    {{ $status === 'pending' ? 'selected' : '' }}
                                >
                                    Menunggu
                                </option>

                                <option
                                    value="diproses"
                                    {{ $status === 'diproses' ? 'selected' : '' }}
                                >
                                    Diproses
                                </option>

                                <option
                                    value="dikirim"
                                    {{ $status === 'dikirim' ? 'selected' : '' }}
                                >
                                    Dikirim
                                </option>

                                <option
                                    value="selesai"
                                    {{ $status === 'selesai' ? 'selected' : '' }}
                                >
                                    Selesai
                                </option>

                                <option
                                    value="dibatalkan"
                                    {{ $status === 'dibatalkan' ? 'selected' : '' }}
                                >
                                    Dibatalkan
                                </option>

                            </select>

                        </div>


                        <div class="col-md-4">

                            <button
                                type="submit"
                                class="btn-custom w-100"
                            >
                                Update Status
                            </button>

                        </div>

                    </form>


                </div>


            @empty


                {{-- BELUM ADA PESANAN --}}

                <div class="empty-box">

                    <div class="empty-icon">
                        📦
                    </div>

                    <div class="empty-title">
                        Belum Ada Pesanan
                    </div>

                    <div class="empty-text">
                        Saat ini belum ada pesanan dari pelanggan.
                    </div>

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="btn-custom mt-3"
                    >
                        Kembali ke Dashboard
                    </a>

                </div>


            @endforelse


        </div>

    </main>


</body>

</html>
