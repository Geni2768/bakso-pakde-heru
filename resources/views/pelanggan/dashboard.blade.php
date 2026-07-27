<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Dashboard Pelanggan - Bakso Pakde Heru</title>

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

        .nav-link {
            font-size: 13px;
            color: #333;
            text-decoration: none;
        }

        .nav-link:hover {
            color: #d62828;
        }

        .dashboard {
            padding: 40px 0;
        }

        .welcome-card {
            background: #fff1da;
            border-radius: 12px;
            padding: 35px;
        }

        .welcome-title {
            font-size: 28px;
            font-weight: 800;
        }

        .welcome-title span {
            color: #d62828;
        }

        .welcome-text {
            color: #666;
            margin-top: 10px;
        }

        .menu-card {
            background: white;
            border: 1px solid #eeeeee;
            border-radius: 10px;
            padding: 25px;
            height: 100%;
        }

        .menu-icon {
            font-size: 35px;
            margin-bottom: 15px;
        }

        .menu-title {
            font-weight: 700;
            margin-bottom: 8px;
        }

        .menu-text {
            color: #777;
            font-size: 13px;
            min-height: 60px;
        }

        .btn-custom {
            background: #d62828;
            color: white;
            border: none;
            text-decoration: none;
            display: inline-block;
            padding: 10px 18px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-custom:hover {
            background: #b71c1c;
            color: white;
        }

        .btn-outline-custom {
            color: #d62828;
            border: 1px solid #d62828;
            background: transparent;
            text-decoration: none;
            display: inline-block;
            padding: 10px 18px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-outline-custom:hover {
            background: #d62828;
            color: white;
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
                href="{{ route('home') }}"
                class="brand"
            >
                🍜 Bakso Pakde Heru
            </a>


            <div class="d-flex align-items-center gap-3">

                <a
                    href="{{ route('home') }}"
                    class="nav-link"
                >
                    Home
                </a>


                <a
                    href="{{ route('customer.menu') }}"
                    class="nav-link"
                >
                    Menu
                </a>


                <a
                    href="{{ route('cart') }}"
                    class="nav-link"
                >
                    🛒 Keranjang
                </a>


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

            <div class="welcome-card mb-4">

                <div class="welcome-title">

                    Halo,

                    <span>
                        {{ auth()->user()->name }}
                    </span>

                    👋

                </div>


                <p class="welcome-text mb-3">

                    Selamat datang di Dashboard Pelanggan
                    Bakso Pakde Heru.

                    Silakan pilih menu yang ingin kamu lakukan.

                </p>


                <a
                    href="{{ route('customer.menu') }}"
                    class="btn-custom"
                >
                    🍜 Lihat Menu Bakso
                </a>

            </div>


            {{-- MENU DASHBOARD --}}

            <div class="row g-4">


                {{-- PESAN BAKSO --}}

                <div class="col-md-4">

                    <div class="menu-card">

                        <div class="menu-icon">
                            🍜
                        </div>

                        <div class="menu-title">
                            Pesan Bakso
                        </div>

                        <p class="menu-text">

                            Lihat berbagai menu bakso
                            yang tersedia dan pesan
                            makanan favoritmu.

                        </p>

                        <a
                            href="{{ route('customer.menu') }}"
                            class="btn-custom"
                        >
                            Lihat Menu
                        </a>

                    </div>

                </div>


                {{-- KERANJANG --}}

                <div class="col-md-4">

                    <div class="menu-card">

                        <div class="menu-icon">
                            🛒
                        </div>

                        <div class="menu-title">
                            Keranjang Saya
                        </div>

                        <p class="menu-text">

                            Periksa makanan yang sudah
                            kamu pilih sebelum melakukan
                            checkout.

                        </p>

                        <a
                            href="{{ route('cart') }}"
                            class="btn-custom"
                        >
                            Buka Keranjang
                        </a>

                    </div>

                </div>


                {{-- PESANAN SAYA --}}

                <div class="col-md-4">

                    <div class="menu-card">

                        <div class="menu-icon">
                            📦
                        </div>

                        <div class="menu-title">
                            Pesanan Saya
                        </div>

                        <p class="menu-text">

                            Lihat riwayat dan status
                            pesanan yang sudah kamu
                            buat.

                        </p>

                        <a
                            href="{{ route('customer.orders') }}"
                            class="btn-outline-custom"
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
