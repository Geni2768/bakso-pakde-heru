<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Dashboard Admin - Bakso Pakde Heru
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

        .dashboard {
            padding: 35px 0;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h1 {
            font-size: 26px;
            font-weight: 800;
        }

        .welcome span {
            color: #d62828;
        }

        .welcome p {
            color: #777;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid #eeeeee;
            border-radius: 10px;
            padding: 22px;
            height: 100%;
        }

        .stat-icon {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .stat-title {
            color: #777;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .stat-number {
            color: #222;
            font-size: 24px;
            font-weight: 800;
        }

        .menu-card {
            background: #ffffff;
            border: 1px solid #eeeeee;
            border-radius: 10px;
            padding: 25px;
            height: 100%;
        }

        .menu-icon {
            font-size: 35px;
            margin-bottom: 12px;
        }

        .menu-title {
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .menu-text {
            color: #777;
            font-size: 13px;
            line-height: 1.6;
        }

        .btn-custom {
            display: inline-block;
            background: #d62828;
            color: #ffffff;
            text-decoration: none;
            padding: 9px 17px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            border: none;
        }

        .btn-custom:hover {
            background: #b71c1c;
            color: #ffffff;
        }

        .logout-btn {
            border: none;
            background: none;
            color: #d62828;
            font-size: 13px;
            padding: 0;
        }

        .logout-btn:hover {
            color: #b71c1c;
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


            <div class="d-flex align-items-center gap-3">

                <span class="text-muted">
                    Admin
                </span>


                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="m-0"
                >

                    @csrf

                    <button
                        type="submit"
                        class="logout-btn"
                    >
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </nav>


    {{-- DASHBOARD --}}

    <main class="dashboard">

        <div class="container">


            {{-- WELCOME --}}

            <div class="welcome">

                <h1>
                    Dashboard
                    <span>Admin</span>
                </h1>

                <p>
                    Selamat datang,
                    <strong>
                        {{ auth()->user()->name }}
                    </strong>.
                    Kelola seluruh sistem Bakso Pakde Heru dari halaman ini.
                </p>

            </div>


            {{-- STATISTIK --}}

            <div class="row g-3 mb-4">


                {{-- TOTAL MENU --}}

                <div class="col-md-3">

                    <div class="stat-card">

                        <div class="stat-icon">
                            🍜
                        </div>

                        <div class="stat-title">
                            Total Menu
                        </div>

                        <div class="stat-number">
                            {{ $totalMenu }}
                        </div>

                    </div>

                </div>


                {{-- TOTAL KATEGORI --}}

                <div class="col-md-3">

                    <div class="stat-card">

                        <div class="stat-icon">
                            🗂️
                        </div>

                        <div class="stat-title">
                            Total Kategori
                        </div>

                        <div class="stat-number">
                            {{ $totalKategori }}
                        </div>

                    </div>

                </div>


                {{-- TOTAL PESANAN --}}

                <div class="col-md-3">

                    <div class="stat-card">

                        <div class="stat-icon">
                            📦
                        </div>

                        <div class="stat-title">
                            Total Pesanan
                        </div>

                        <div class="stat-number">
                            {{ $totalOrder }}
                        </div>

                    </div>

                </div>


                {{-- TOTAL PELANGGAN --}}

                <div class="col-md-3">

                    <div class="stat-card">

                        <div class="stat-icon">
                            👥
                        </div>

                        <div class="stat-title">
                            Total Pelanggan
                        </div>

                        <div class="stat-number">
                            {{ $totalCustomer }}
                        </div>

                    </div>

                </div>


            </div>


            {{-- PENDAPATAN --}}

            <div class="row mb-4">

                <div class="col-md-12">

                    <div class="stat-card">

                        <div class="stat-icon">
                            💰
                        </div>

                        <div class="stat-title">
                            Total Pendapatan
                        </div>

                        <div class="stat-number">

                            Rp{{ number_format(
                                $totalIncome,
                                0,
                                ',',
                                '.'
                            ) }}

                        </div>

                    </div>

                </div>

            </div>


            {{-- MENU ADMIN --}}

            <h5 class="fw-bold mb-3">
                Kelola Sistem
            </h5>


            <div class="row g-4">


                {{-- KELOLA MENU --}}

                <div class="col-md-4">

                    <div class="menu-card">

                        <div class="menu-icon">
                            🍜
                        </div>

                        <div class="menu-title">
                            Kelola Menu
                        </div>

                        <p class="menu-text">
                            Tambah, edit, hapus, dan kelola
                            daftar menu makanan dan minuman.
                        </p>

                        <a
                            href="{{ route('menu-admin.index') }}"
                            class="btn-custom"
                        >
                            Kelola Menu
                        </a>

                    </div>

                </div>


                {{-- KELOLA KATEGORI --}}

                <div class="col-md-4">

                    <div class="menu-card">

                        <div class="menu-icon">
                            🗂️
                        </div>

                        <div class="menu-title">
                            Kelola Kategori
                        </div>

                        <p class="menu-text">
                            Tambah, edit, dan hapus kategori
                            menu Bakso Pakde Heru.
                        </p>

                        <a
                            href="{{ route('kategori.index') }}"
                            class="btn-custom"
                        >
                            Kelola Kategori
                        </a>

                    </div>

                </div>


                {{-- KELOLA PESANAN --}}

                <div class="col-md-4">

                    <div class="menu-card">

                        <div class="menu-icon">
                            📦
                        </div>

                        <div class="menu-title">
                            Kelola Pesanan
                        </div>

                        <p class="menu-text">
                            Lihat dan kelola seluruh pesanan
                            yang masuk dari pelanggan.
                        </p>

                        <a
                            href="{{ route('admin.orders.index') }}"
                            class="btn-custom"
                        >
                            Lihat Pesanan
                        </a>

                    </div>

                </div>


            </div>


        </div>

    </main>


</body>

</html>
