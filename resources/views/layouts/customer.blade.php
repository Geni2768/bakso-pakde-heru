<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Bakso Pakde Heru')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        *{
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#FFF8EE;
        }

        .navbar{
            background:#fff;
            box-shadow:0 3px 18px rgba(0,0,0,.06);
        }

        .menu-link{
            position:relative;
            transition:.3s;
        }

        .menu-link:hover{
            color:#dc2626;
        }

        .menu-link::after{
            content:'';
            position:absolute;
            left:0;
            bottom:-6px;
            width:0%;
            height:2px;
            background:#dc2626;
            transition:.3s;
        }

        .menu-link:hover::after{
            width:100%;
        }

        .btn-red{
            background:#dc2626;
            color:white;
            transition:.3s;
        }

        .btn-red:hover{
            background:#b91c1c;
        }

        footer{
            background:#991b1b;
        }
    </style>

</head>

<body>

<!-- ===================== NAVBAR ===================== -->

<nav class="navbar sticky top-0 z-50">

<div class="max-w-7xl mx-auto px-6">

<div class="flex justify-between items-center h-20">

<!-- Logo -->

<a href="{{ route('home') }}" class="flex items-center gap-3">

<img
src="{{ asset('images/logo.png') }}"
alt="Logo"
class="w-10 h-10 object-contain">

<div>

<h2 class="font-bold text-xl text-red-700">

Bakso Pakde Heru

</h2>

<p class="text-xs text-gray-500">

Bakso Favorit Keluarga

</p>

</div>

</a>

<!-- Menu -->

<div class="hidden lg:flex items-center gap-8 text-[15px]">

<a href="{{ route('home') }}"
class="menu-link">

Home

</a>

<a href="#menu"
class="menu-link">

Menu

</a>

<a href="#footer"
class="menu-link">

Kontak

</a>

@auth

<a href="{{ route('cart') }}"
class="relative">

<i class="fa-solid fa-cart-shopping text-xl"></i>

@if(count(session('cart', [])) > 0)

<span
class="absolute -top-2 -right-3 bg-red-600 text-white rounded-full px-2 py-0.5 text-[10px]">

{{ count(session('cart', [])) }}

</span>

@endif

</a>

<span class="font-semibold">

{{ auth()->user()->name }}

</span>

<form method="POST"
action="{{ route('logout') }}">

@csrf

<button
class="btn-red px-5 py-2 rounded-xl shadow">

Logout

</button>

</form>

@else

<a href="{{ route('login') }}"
class="border border-red-600 text-red-600 px-5 py-2 rounded-xl hover:bg-red-50 transition">

Login

</a>

<a href="{{ route('register') }}"
class="btn-red px-5 py-2 rounded-xl shadow">

Register

</a>

@endauth

</div>

<!-- Mobile -->

<div class="lg:hidden">

<button>

<i class="fa-solid fa-bars text-xl"></i>

</button>

</div>

</div>

</div>

</nav>

<!-- ===================== CONTENT ===================== -->

<main>

@yield('content')

</main>

<!-- ===================== FOOTER ===================== -->

<footer id="footer" class="text-white mt-16">

<div class="max-w-7xl mx-auto px-6 py-10">

<div class="grid md:grid-cols-3 gap-10">

<div>

<h2 class="text-2xl font-bold">

Bakso Pakde Heru

</h2>

<p class="mt-3 text-red-100 leading-7">

Bakso hangat dengan cita rasa khas, dibuat dari bahan pilihan dan siap menemani waktu makan Anda.

</p>

</div>

<div>

<h3 class="font-semibold text-lg mb-3">

Alamat

</h3>

<p>

Jl. Mawar No.12 Sukajadi

</p>

<p>

Bandung

</p>

</div>

<div>

<h3 class="font-semibold text-lg mb-3">

Kontak

</h3>

<p class="mb-2">

<i class="fa-solid fa-phone mr-2"></i>

0812-3456-7890

</p>

<p>

<i class="fa-brands fa-whatsapp mr-2"></i>

WhatsApp

</p>

</div>

</div>

<hr class="border-red-600 my-8">

<div class="text-center text-red-100 text-sm">

© {{ date('Y') }} Bakso Pakde Heru. All Rights Reserved.

</div>

</div>

</footer>

</body>

</html>
