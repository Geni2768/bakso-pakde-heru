@extends('layouts.app')

@section('content')

<!-- Hero -->
<section class="bg-[#FFF7EA]">
    <div class="max-w-7xl mx-auto px-8 py-12">

        <div class="grid lg:grid-cols-2 gap-10 items-center">

            <div>

                <h1 class="text-6xl font-bold leading-tight text-gray-900">
                    Bakso Favorit
                    <br>
                    Keluarga
                </h1>

                <p class="mt-6 text-xl text-gray-600">
                    Enak, Murah, Hangat dan Siap Diantar
                    sampai rumah Anda.
                </p>

                <div class="mt-10 flex gap-4">

                    <a href="{{ route('menu.index') }}"
                       class="bg-red-600 hover:bg-red-700 duration-300 text-white px-8 py-4 rounded-xl shadow-lg">

                        🍜 Pesan Sekarang

                    </a>

                    <a href="#menu"
                       class="border border-red-600 text-red-600 hover:bg-red-600 hover:text-white duration-300 px-8 py-4 rounded-xl">

                        Lihat Menu

                    </a>

                </div>

            </div>

            <div class="flex justify-center">

                <img src="{{ asset('images/bakso1.png') }}"
                     class="w-[520px] drop-shadow-2xl hover:scale-105 duration-500">

            </div>

        </div>

    </div>
</section>

<!-- Menu Favorit -->

<section id="menu" class="py-16">

<div class="max-w-7xl mx-auto px-8">

<h2 class="text-4xl font-bold mb-10">

Menu Favorit

</h2>

<div class="grid md:grid-cols-4 gap-8">

<!-- CARD -->

<div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl duration-300">

<img src="{{ asset('images/bakso1.png') }}"
class="w-full h-56 object-contain p-4">

<div class="p-6">

<h3 class="font-bold text-xl">

Bakso Urat

</h3>

<p class="text-red-600 font-bold text-2xl mt-3">

Rp15.000

</p>

<button
class="mt-6 w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl">

Tambah

</button>

</div>

</div>

<!-- CARD -->

<div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl duration-300">

<img src="{{ asset('images/bakso2.png') }}"
class="w-full h-56 object-contain p-4">

<div class="p-6">

<h3 class="font-bold text-xl">

Bakso Halus

</h3>

<p class="text-red-600 font-bold text-2xl mt-3">

Rp18.000

</p>

<button
class="mt-6 w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl">

Tambah

</button>

</div>

</div>

<!-- CARD -->

<div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl duration-300">

<img src="{{ asset('images/bakso3.png') }}"
class="w-full h-56 object-contain p-4">

<div class="p-6">

<h3 class="font-bold text-xl">

Bakso Spesial

</h3>

<p class="text-red-600 font-bold text-2xl mt-3">

Rp22.000

</p>

<button
class="mt-6 w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl">

Tambah

</button>

</div>

</div>

<!-- CARD -->

<div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl duration-300">

<img src="{{ asset('images/esteh.png') }}"
class="w-full h-56 object-contain p-4">

<div class="p-6">

<h3 class="font-bold text-xl">

Es Teh

</h3>

<p class="text-red-600 font-bold text-2xl mt-3">

Rp5.000

</p>

<button
class="mt-6 w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl">

Tambah

</button>

</div>

</div>

</div>

</div>

</section>

<!-- Footer -->

<footer class="bg-red-700 text-white mt-20">

<div class="max-w-7xl mx-auto px-8 py-12">

<div class="grid md:grid-cols-3 gap-8">

<div>

<h2 class="text-3xl font-bold">

Bakso Pakde Heru

</h2>

<p class="mt-3">

Jl Mawar No 12 Sukajadi

Bandung

</p>

</div>

<div>

<h2 class="font-bold text-xl">

WhatsApp

</h2>

<p class="mt-4">

0812-3456-7890

</p>

</div>

<div>

<h2 class="font-bold text-xl">

Jam Operasional

</h2>

<p class="mt-4">

09.00 - 21.00 WIB

</p>

</div>

</div>

</div>

</footer>

@endsection
