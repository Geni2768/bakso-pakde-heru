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
            background: #fafafa;
            color: #222;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .navbar-pakde {
            background: #ffffff;
            border-bottom: 1px solid #eeeeee;
            height: 70px;
        }

        .brand-pakde {
            color: #d62828;
            font-size: 18px;
            font-weight: 800;
            text-decoration: none;
        }

        .brand-pakde span {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: #d62828;
        }

        .nav-link-pakde {
            color: #333;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            margin-left: 24px;
            padding: 8px 0;
        }

        .nav-link-pakde:hover {
            color: #d62828;
        }

        .nav-link-pakde.active {
            color: #d62828;
            border-bottom: 2px solid #d62828;
        }

        .cart-link {
            position: relative;
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -12px;
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

        .btn-login {
            border: 1px solid #d62828;
            color: #d62828;
            border-radius: 5px;
            font-size: 11px;
            padding: 7px 14px;
            text-decoration: none;
            margin-left: 20px;
        }

        .btn-login:hover {
            background: #d62828;
            color: white;
        }

        .btn-register {
            background: #d62828;
            color: white;
            border-radius: 5px;
            font-size: 11px;
            padding: 8px 14px;
            text-decoration: none;
            margin-left: 8px;
        }

        .btn-register:hover {
            background: #b71c1c;
            color: white;
        }

        .btn-logout {
            border: none;
            background: transparent;
            color: #d62828;
            font-size: 11px;
            font-weight: 600;
            margin-left: 20px;
        }

        .main-content {
            min-height: calc(100vh - 70px);
        }

        .footer-pakde {
            background: #d62828;
            color: white;
            padding: 20px 0;
            margin-top: 40px;
        }

        .footer-title {
            font-size: 14px;
            font-weight: 700;
        }

        .footer-text {
            font-size: 11px;
            margin: 0;
        }

    </style>

</head>


<body>


{{-- NAVBAR --}}

<nav class="navbar-pakde">

    <div class="container h-100">

        <div class="d-flex align-items-center justify-content-between h-100">

            {{-- LOGO --}}

            <a
                href="{{ route('home') }}"
                class="brand-pakde"
            >
                🍜 Bakso
                <span>Pakde Heru</span>
            </a>


            {{-- MENU --}}

            <div class="d-flex align-items-center">

                <a
                    href="{{ route('home') }}"
                    class="nav-link-pakde"
                >
                    Beranda
                </a>


                <a
                    href="{{ route('customer.menu') }}"
                    class="nav-link-pakde"
                >
                    Menu
                </a>


                <a
                    href="{{ route('cart') }}"
                    class="nav-link-pakde cart-link"
                >

                    Keranjang

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

                </a>


                @auth

                    <a
                        href="{{ route('customer.orders') }}"
                        class="nav-link-pakde"
                    >
                        Pesanan Saya
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="btn-login"
                    >
                        Login
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="btn-register"
                    >
                        Register
                    </a>

                @endauth


                @auth

                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        class="d-inline"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn-logout"
                        >
                            Logout
                        </button>

                    </form>

                @endauth

            </div>

        </div>

    </div>

</nav>


{{-- KONTEN HALAMAN --}}

<main class="main-content">

    @yield('content')

</main>


{{-- FOOTER --}}

<footer class="footer-pakde">

    <div class="container">

        <div class="row">

            <div class="col-md-4 mb-3">

                <div class="footer-title">
                    🍜 Bakso Pakde Heru
                </div>

                <p class="footer-text">
                    Bakso enak, murah, hangat
                    dan siap diantar ke rumah Anda.
                </p>

            </div>


            <div class="col-md-4 mb-3">

                <div class="footer-title">
                    Alamat
                </div>

                <p class="footer-text">
                    Jl. Mawar No. 12 Sukajadi
                    Bandung, Jawa Barat
                </p>

            </div>


            <div class="col-md-4 mb-3">

                <div class="footer-title">
                    WhatsApp
                </div>

                <p class="footer-text">
                    0812-3456-7890
                </p>

            </div>

        </div>

    </div>

</footer>


</body>

</html>
