<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bakso Pakde Heru</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>

    <style>

        *{
            font-family:'Poppins',sans-serif;
        }

        body{

            background:linear-gradient(135deg,#fff8f2,#fff4ec,#ffffff);

        }

        .login-card{

            background:white;

            border-radius:28px;

            box-shadow:0 20px 60px rgba(0,0,0,.08);

        }

        .btn-login{

            background:#C1121F;

            transition:.3s;

        }

        .btn-login:hover{

            background:#991B1B;

            transform:translateY(-2px);

        }

        .input-login{

            border:2px solid #ececec;

            border-radius:14px;

            padding:14px;

            transition:.25s;

        }

        .input-login:focus{

            border-color:#C1121F;

            box-shadow:0 0 0 4px rgba(193,18,31,.12);

            outline:none;

        }

        .food-shadow{

            filter:drop-shadow(0 20px 40px rgba(0,0,0,.18));

        }

    </style>

</head>

<body>

<div class="min-h-screen flex">

    {{-- Bagian kiri --}}

    <div class="hidden lg:flex lg:w-1/2 bg-[#C1121F] relative overflow-hidden">

        <div class="absolute inset-0 bg-gradient-to-br from-red-700 via-red-600 to-orange-500"></div>

        <div class="relative z-10 flex flex-col justify-center items-center text-white p-14">

            <img src="{{ asset('images/logo.png') }}"
                 class="w-36 mb-8">

            <h1 class="text-5xl font-extrabold text-center leading-tight">

                Bakso Pakde Heru

            </h1>

            <p class="mt-5 text-lg text-center text-red-100 max-w-md">

                Nikmati Bakso Premium dengan cita rasa khas.
                Pesan online lebih mudah, cepat, dan praktis.

            </p>

            <img
                src="{{ asset('images/hero-bakso.png') }}"
                class="w-[470px] mt-10 food-shadow">

        </div>

    </div>

    {{-- Bagian kanan --}}

    <div class="w-full lg:w-1/2 flex items-center justify-center p-10">

        <div class="login-card w-full max-w-lg p-10">

            @yield('content')

        </div>

    </div>

</div>

</body>
</html>
