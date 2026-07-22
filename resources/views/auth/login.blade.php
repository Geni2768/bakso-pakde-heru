@extends('layouts.guest')

@section('content')

<div class="text-center mb-8">

    <img src="{{ asset('images/logo.png') }}"
         class="w-24 mx-auto mb-5">

    <h1 class="text-4xl font-extrabold text-red-700">

        Selamat Datang

    </h1>

    <p class="text-gray-500 mt-2">

        Login untuk melanjutkan ke Bakso Pakde Heru

    </p>

</div>

@if(session('status'))

<div class="mb-5 rounded-xl bg-green-100 text-green-700 p-4">

    {{ session('status') }}

</div>

@endif

@if ($errors->any())

<div class="mb-5 rounded-xl bg-red-100 border border-red-200 p-4">

    <ul class="text-red-600 text-sm list-disc ml-5">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form method="POST" action="{{ route('login') }}">

    @csrf

    {{-- EMAIL --}}

    <div class="mb-5">

        <label class="block font-semibold mb-2">

            Email

        </label>

        <div class="relative">

            <i class="fa-solid fa-envelope absolute left-4 top-4 text-gray-400"></i>

            <input
                name="email"
                type="email"
                value="{{ old('email') }}"
                required
                autofocus
                class="input-login w-full pl-11"
                placeholder="Masukkan Email">

        </div>

    </div>

    {{-- PASSWORD --}}

    <div class="mb-3">

        <label class="block font-semibold mb-2">

            Password

        </label>

        <div class="relative">

            <i class="fa-solid fa-lock absolute left-4 top-4 text-gray-400"></i>

            <input
                id="password"
                name="password"
                type="password"
                required
                class="input-login w-full pl-11 pr-12"
                placeholder="Masukkan Password">

            <button
                type="button"
                onclick="togglePassword()"
                class="absolute right-4 top-4">

                <i id="eyeIcon"
                   class="fa-solid fa-eye text-gray-500"></i>

            </button>

        </div>

    </div>

    <div class="flex justify-between items-center mb-6">

        <label class="flex items-center gap-2">

            <input
                type="checkbox"
                name="remember">

            <span class="text-sm">

                Ingat Saya

            </span>

        </label>

        @if(Route::has('password.request'))

        <a
            href="{{ route('password.request') }}"
            class="text-red-600 text-sm font-semibold">

            Lupa Password?

        </a>

        @endif

    </div>

    <button
        class="btn-login w-full py-4 rounded-xl text-white font-bold text-lg">

        <i class="fa-solid fa-right-to-bracket mr-2"></i>

        Login

    </button>

</form>

<div class="mt-8 text-center">

    Belum punya akun?

    <a href="{{ route('register') }}"
       class="font-bold text-red-600">

        Daftar Sekarang

    </a>

</div>

<div class="mt-8 text-center">

    <p class="text-gray-400 text-sm">

        © {{ date('Y') }} Bakso Pakde Heru

    </p>

</div>

<script>

function togglePassword(){

    let password=document.getElementById("password");

    let eye=document.getElementById("eyeIcon");

    if(password.type==="password"){

        password.type="text";

        eye.classList.replace("fa-eye","fa-eye-slash");

    }else{

        password.type="password";

        eye.classList.replace("fa-eye-slash","fa-eye");

    }

}

</script>

@endsection
