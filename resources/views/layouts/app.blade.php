<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Bakso Pakde Heru')
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
            color: #333;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .navbar-custom {
            background: #ffffff;
            border-bottom: 1px solid #eeeeee;
            height: 70px;
        }

        .navbar-brand {
            color: #d62828 !important;
            font-weight: 700;
            font-size: 18px;
            line-height: 1.1;
        }

        .navbar-brand span {
            display: block;
            color: #d62828;
            font-size: 14px;
            font-style: italic;
        }

        .nav-link {
            color: #333 !important;
            font-size: 13px;
            font-weight: 500;
            margin-left: 10px;
            padding: 8px 10px !important;
        }

        .nav-link:hover {
            color: #d62828 !important;
        }

        .btn-danger-custom {
            background: #d62828;
            border: none;
            color: white;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            padding: 9px 16px;
        }

        .btn-danger-custom:hover {
            background: #b71c1c;
            color: white;
        }

        .btn-outline-danger-custom {
            color: #d62828;
            border: 1px solid #d62828;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            padding: 8px 16px;
        }

        .btn-outline-danger-custom:hover {
            background: #d62828;
            color: white;
        }

        .cart-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #d62828;
            color: white;
            font-size: 9px;
            width: 17px;
            height: 17px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-wrapper {
            position: relative;
            display: inline-block;
        }

        .user-name {
            color: #333;
            font-size: 13px;
            font-weight: 600;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            font-size: 13px;
        }

        .dropdown-item:hover {
            background: #fff3e0;
            color: #d62828;
        }

        .main-content {
            min-height: calc(100vh - 140px);
        }

        .footer {
            background: #d62828;
            color: white;
            margin-top: 50px;
            padding: 25px 0;
        }

        .footer-title {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .footer-text {
            font-size: 12px;
            margin-bottom: 3px;
        }

        .alert {
            font-size: 13px;
            border-radius: 8px;
        }

        @media (max-width: 991px) {

            .navbar-custom {
                height: auto;
                padding: 10px 0;
            }

            .navbar-nav {
                padding-top: 10px;
            }

            .nav-link {
                margin-left: 0;
            }

            .btn-danger-custom {
                display: inline-block;
                margin-top: 8px;
            }

        }

    </style>

</head>


<body>


{{-- NAVBAR --}}

<nav class="navbar navbar-expand-lg navbar-custom">

    <div class="container">


        {{-- LOGO --}}

        <a
            class="navbar-brand"
            href="{{ route('home') }}"
        >
            🍜 Bakso
            <span>Pakde Heru</span>
        </a>



        {{-- TOGGLE MOBILE --}}

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>



        {{-- MENU NAVBAR --}}

        <div
            class="collapse navbar-collapse"
            id="navbarMenu"
        >

            <ul class="navbar-nav ms-auto align-items-lg-center">


                {{-- HOME --}}

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="{{ route('home') }}"
                    >
                        Beranda
                    </a>

                </li>



                {{-- MENU --}}

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="{{ route('customer.menu') }}"
                    >
                        Menu
                    </a>

                </li>



                {{-- KERANJANG --}}

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="{{ route('cart') }}"
                    >

                        <span class="cart-wrapper">

                            🛒

                            @php

                                $cartCount = collect(
                                    session('cart', [])
                                )->sum('qty');

                            @endphp


                            @if($cartCount > 0)

                                <span class="cart-badge">
                                    {{ $cartCount }}
                                </span>

                            @endif

                        </span>

                        Keranjang

                    </a>

                </li>



                {{-- USER SUDAH LOGIN --}}

                @auth


                    {{-- PESANAN SAYA UNTUK PELANGGAN --}}

                    @if(auth()->user()->role === 'pelanggan')

                        <li class="nav-item">

                            <a
                                class="nav-link"
                                href="{{ route('customer.orders') }}"
                            >
                                Pesanan Saya
                            </a>

                        </li>

                    @endif



                    {{-- ADMIN --}}

                    @if(auth()->user()->role === 'admin')

                        <li class="nav-item">

                            <a
                                class="nav-link"
                                href="{{ route('admin.dashboard') }}"
                            >
                                Dashboard Admin
                            </a>

                        </li>

                    @endif



                    {{-- KASIR --}}

                    @if(auth()->user()->role === 'kasir')

                        <li class="nav-item">

                            <a
                                class="nav-link"
                                href="{{ route('kasir.dashboard') }}"
                            >
                                Dashboard Kasir
                            </a>

                        </li>

                    @endif



                    {{-- USER DROPDOWN --}}

                    <li class="nav-item dropdown">

                        <a
                            class="nav-link dropdown-toggle user-name"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                        >
                            👤 {{ auth()->user()->name }}
                        </a>


                        <ul class="dropdown-menu dropdown-menu-end">


                            <li>

                                <a
                                    class="dropdown-item"
                                    href="{{ route('dashboard') }}"
                                >
                                    Dashboard
                                </a>

                            </li>


                            <li>

                                <hr class="dropdown-divider">

                            </li>


                            <li>

                                <form
                                    method="POST"
                                    action="{{ route('logout') }}"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="dropdown-item"
                                    >
                                        Logout
                                    </button>

                                </form>

                            </li>


                        </ul>

                    </li>


                @else


                    {{-- LOGIN --}}

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="{{ route('login') }}"
                        >
                            Login
                        </a>

                    </li>



                    {{-- REGISTER --}}

                    <li class="nav-item">

                        <a
                            class="btn btn-danger-custom ms-lg-2"
                            href="{{ route('register') }}"
                        >
                            Register
                        </a>

                    </li>


                @endauth


            </ul>

        </div>

    </div>

</nav>



{{-- NOTIFIKASI --}}

<div class="container mt-3">


    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif



    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


</div>



{{-- KONTEN HALAMAN --}}

<main class="main-content">

    @yield('content')

</main>



{{-- FOOTER --}}

<footer class="footer">

    <div class="container">

        <div class="row">


            <div class="col-md-4 mb-3">

                <div class="footer-title">
                    🍜 Bakso Pakde Heru
                </div>

                <div class="footer-text">
                    Bakso enak, murah, hangat,
                    dan siap diantar sampai rumah.
                </div>

            </div>



            <div class="col-md-4 mb-3">

                <div class="footer-title">
                    Alamat
                </div>

                <div class="footer-text">
                    Jl. Mawar No. 12 Sukajadi
                </div>

                <div class="footer-text">
                    Bandung, Jawa Barat
                </div>

            </div>



            <div class="col-md-4 mb-3">

                <div class="footer-title">
                    Kontak
                </div>

                <div class="footer-text">
                    WhatsApp: 0812-3456-7890
                </div>

                <div class="footer-text">
                    Jam: 09.00 - 21.00 WIB
                </div>

            </div>


        </div>


        <hr>


        <div class="text-center footer-text">

            © {{ date('Y') }}
            Bakso Pakde Heru.
            Semua Hak Dilindungi.

        </div>


    </div>

</footer>



{{-- BOOTSTRAP JS --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
></script>


@stack('scripts')


</body>

</html>
