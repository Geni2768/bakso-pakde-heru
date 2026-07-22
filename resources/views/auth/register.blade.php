@extends('layouts.guest')

@section('content')

<div class="text-center mb-8">

    <h1 class="text-3xl font-bold text-red-600">
        Buat Akun Baru
    </h1>

    <p class="text-gray-500 mt-2">
        Daftar untuk mulai memesan Bakso Pakde Heru
    </p>

</div>

@if ($errors->any())

<div class="mb-5 rounded-xl bg-red-100 border border-red-200 p-4">

    <ul class="list-disc ml-5 text-red-600 text-sm">

        @foreach ($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form method="POST" action="{{ route('register') }}">

    @csrf

    <!-- Nama -->

    <div class="mb-4">

        <label class="font-semibold block mb-2">

            Nama Lengkap

        </label>

        <div class="relative">

            <i class="fa-solid fa-user absolute left-4 top-4 text-gray-400"></i>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                class="input-login w-full pl-11"
                placeholder="Masukkan nama lengkap">

        </div>

    </div>

    <!-- Email -->

    <div class="mb-4">

        <label class="font-semibold block mb-2">

            Email

        </label>

        <div class="relative">

            <i class="fa-solid fa-envelope absolute left-4 top-4 text-gray-400"></i>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                class="input-login w-full pl-11"
                placeholder="Masukkan email">

        </div>

    </div>

    <!-- No HP -->

    <div class="mb-4">

        <label class="font-semibold block mb-2">

            Nomor HP

        </label>

        <div class="relative">

            <i class="fa-solid fa-phone absolute left-4 top-4 text-gray-400"></i>

            <input
                type="text"
                name="no_hp"
                value="{{ old('no_hp') }}"
                class="input-login w-full pl-11"
                placeholder="08xxxxxxxxxx">

        </div>

    </div>

    <!-- Password -->

    <div class="mb-4">

        <label class="font-semibold block mb-2">

            Password

        </label>

        <div class="relative">

            <i class="fa-solid fa-lock absolute left-4 top-4 text-gray-400"></i>

            <input
                id="password"
                type="password"
                name="password"
                required
                class="input-login w-full pl-11 pr-11"
                placeholder="Password">

            <button
                type="button"
                onclick="showPassword('password','eye1')"
                class="absolute right-4 top-4">

                <i id="eye1" class="fa-solid fa-eye"></i>

            </button>

        </div>

    </div>

    <!-- Konfirmasi -->

    <div class="mb-6">

        <label class="font-semibold block mb-2">

            Konfirmasi Password

        </label>

        <div class="relative">

            <i class="fa-solid fa-lock absolute left-4 top-4 text-gray-400"></i>

            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                class="input-login w-full pl-11 pr-11"
                placeholder="Ulangi password">

            <button
                type="button"
                onclick="showPassword('password_confirmation','eye2')"
                class="absolute right-4 top-4">

                <i id="eye2" class="fa-solid fa-eye"></i>

            </button>

        </div>

    </div>

    <button
        class="btn-login text-white w-full py-4 rounded-xl font-semibold">

        Daftar Sekarang

    </button>

</form>

<div class="text-center mt-6">

    Sudah punya akun?

    <a href="{{ route('login') }}"
       class="text-red-600 font-semibold">

        Login

    </a>

</div>

<script>

function showPassword(id,icon){

    let input=document.getElementById(id);

    let eye=document.getElementById(icon);

    if(input.type==="password"){

        input.type="text";

        eye.classList.replace("fa-eye","fa-eye-slash");

    }else{

        input.type="password";

        eye.classList.replace("fa-eye-slash","fa-eye");

    }

}

</script>

@endsection
