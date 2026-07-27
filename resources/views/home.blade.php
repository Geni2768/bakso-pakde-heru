<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Bakso Pakde Heru
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
            color: #222;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .navbar-custom {
            background: #ffffff;
            border-bottom: 1px solid #eeeeee;
            height: 70px;
        }

        .brand {
            text-decoration: none;
            color: #d62828;
            font-weight: 800;
            font-size: 18px;
            line-height: 18px;
        }

        .brand span {
            display: block;
            font-size: 12px;
            font-style: italic;
        }

        .nav-link-custom {
            text-decoration: none;
            color: #222;
            font-size: 13px;
            margin-left: 25px;
            font-weight: 500;
        }

        .nav-link-custom:hover {
            color: #d62828;
        }

        .btn-login {
            text-decoration: none;
            color: #d62828;
            border: 1px solid #d62828;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 12px;
            margin-left: 22px;
        }

        .btn-login:hover {
            background: #d62828;
            color: #ffffff;
        }

        .btn-register {
            text-decoration: none;
            color: #ffffff;
            background: #d62828;
            padding: 9px 17px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }

        .btn-register:hover {
            background: #b71c1c;
            color: #ffffff;
        }

        .hero {
            margin-top: 40px;
            background: #fff1da;
            border-radius: 12px;
            min-height: 330px;
            padding: 45px 40px;
        }

        .hero-label {
            color: #d62828;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .hero-title {
            font-size: 42px;
            line-height: 1.05;
            font-weight: 800;
            margin-bottom: 18px;
        }

        .hero-text {
            max-width: 520px;
            color: #555;
            line-height: 1.7;
        }

        .btn-order {
            display: inline-block;
            background: #d62828;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 13px;
            margin-top: 15px;
        }

        .btn-order:hover {
            background: #b71c1c;
            color: white;
        }

        .hero-image {
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
            font-size: 14px;
        }

        .menu-section {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .section-title {
            font-size: 21px;
            font-weight: 800;
        }

        .section-title span {
            color: #d62828;
        }

        .btn-see-all {
            text-decoration: none;
            color: #d62828;
            border: 1px solid #d62828;
            padding: 9px 18px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .btn-see-all:hover {
            background: #d62828;
            color: white;
        }

        .menu-card {
            background: #ffffff;
            border: 1px solid #eeeeee;
            border-radius: 10px;
            overflow: hidden;
            height: 100%;
        }

        .menu-image {
            height: 150px;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
        }

        .menu-content {
            padding: 15px;
        }

        .menu-name {
            font-weight: 700;
            font-size: 14px;
        }

        .menu-price {
            color: #d62828;
            font-weight: 700;
            font-size: 13px;
            margin-top: 8px;
        }

        .btn-add {
            width: 100%;
            border: none;
            background: #d62828;
            color: white;
            padding: 8px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 10px;
        }

        .btn-add:hover {
            background: #b71c1c;
        }

        .empty-menu {
            background: #fff3cd;
            border: 1px solid #ffe69c;
            color: #664d03;
            padding: 16px;
            border-radius: 8px;
            font-size: 13px;
        }

        .footer {
            background: #d62828;
            color: white;
            padding: 25px 0;
        }

        .footer-title {
            font-weight: 700;
            font-size: 14px;
        }

        .footer-text {
            font-size: 11px;
            margin: 0;
        }

    </style>

</head>


<body>


{{-- NAVBAR --}}

<nav class="navbar-custom">

    <div class="container h-100">

        <div class="d-flex align-items-center justify-content-between h-100">


            {{-- LOGO --}}

            <a
                href="{{ route('home') }}"
                class="brand"
            >
                🍜 Bakso
                <span>Pakde Heru</span>
            </a>


            {{-- NAVIGATION --}}

            <div class="d-flex align-items-center">

                <a
                    href="{{ route('home') }}"
                    class="nav-link-custom"
                >
                    Beranda
                </a>


                <a
                    href="{{ route('customer.menu') }}"
                    class="nav-link-custom"
                >
                    Menu
                </a>


                <a
                    href="{{ route('cart') }}"
                    class="nav-link-custom"
                >
                    🛒 Keranjang
                </a>


                {{-- LOGIN --}}

                <a
                    href="{{ route('login') }}"
                    class="btn-login"
                >
                    Login
                </a>


                {{-- REGISTER --}}

                <a
                    href="{{ route('register') }}"
                    class="btn-register"
                >
                    Register
                </a>

            </div>

        </div>

    </div>

</nav>



{{-- HERO --}}

<div class="container">

    <section class="hero">

        <div class="row align-items-center">

            <div class="col-md-7">

                <div class="hero-label">
                    🍜 BAKSO PAKDE HERU
                </div>

                <h1 class="hero-title">
                    Bakso Favorit
                    <br>
                    Keluarga
                </h1>

                <p class="hero-text">
                    Enak, murah, hangat dan siap diantar
                    sampai rumah Anda. Nikmati bakso favorit
                    keluarga dengan rasa yang selalu bikin rindu.
                </p>


                <a
                    href="{{ route('customer.menu') }}"
                    class="btn-order"
                >
                    🛍️ Pesan Sekarang
                </a>

            </div>


            <div class="col-md-5">

                <div class="hero-image">
                    🍜
                    <br>
                    Bakso Pakde Heru
                </div>

            </div>

        </div>

    </section>



    {{-- MENU FAVORIT --}}

    <section class="menu-section">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2 class="section-title mb-0">
                🍜 Menu
                <span>Favorit</span>
            </h2>


            <a
                href="{{ route('customer.menu') }}"
                class="btn-see-all"
            >
                Lihat Semua
            </a>

        </div>


        @if($menus->count() > 0)

            <div class="row g-3">

                @foreach($menus as $menu)

                    <div class="col-md-3">

                        <div class="menu-card">

                            <div class="menu-image">

                                @if($menu->gambar)

                                    <img
                                        src="{{ asset(
                                            'storage/' . $menu->gambar
                                        ) }}"
                                        alt="{{ $menu->nama_menu }}"
                                        style="
                                            width: 100%;
                                            height: 100%;
                                            object-fit: cover;
                                        "
                                    >

                                @else

                                    🍜

                                @endif

                            </div>


                            <div class="menu-content">

                                <div class="menu-name">
                                    {{ $menu->nama_menu }}
                                </div>


                                <div class="menu-price">

                                    Rp{{ number_format(
                                        $menu->harga,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </div>


                                <form
                                    action="{{ route(
                                        'cart.add',
                                        $menu->id
                                    ) }}"
                                    method="POST"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn-add"
                                    >
                                        + Tambah
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty-menu">
                Belum ada menu tersedia.
            </div>

        @endif

    </section>

</div>



{{-- FOOTER --}}

<footer class="footer">

    <div class="container">

        <div class="row">

            <div class="col-md-4">

                <div class="footer-title">
                    🍜 Bakso Pakde Heru
                </div>

                <p class="footer-text">
                    Bakso enak, murah, hangat
                    dan siap diantar ke rumah Anda.
                </p>

            </div>


            <div class="col-md-4">

                <div class="footer-title">
                    Alamat
                </div>

                <p class="footer-text">
                    Jl. Ks.tubun No. 12 Sukajadi,
                    tangerang
                </p>

            </div>


            <div class="col-md-4">

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
