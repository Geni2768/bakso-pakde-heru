@extends('layouts.admin')

@section('content')

<div class="p-6 bg-gray-50 min-h-screen">


    <!-- Header -->
    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Dashboard Admin
            </h1>

            <p class="text-gray-500 mt-1">
                Selamat datang kembali di Bakso Pakde Heru 🍜
            </p>
        </div>


        <div class="bg-white px-5 py-3 rounded-xl shadow flex items-center gap-3">

            <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-white font-bold">
                A
            </div>

            <div>
                <p class="font-semibold text-gray-800">
                    Admin
                </p>

                <p class="text-xs text-gray-500">
                    Administrator
                </p>
            </div>

        </div>


    </div>




    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">


        <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-red-600">

            <p class="text-gray-500">
                Total Menu
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $totalMenu ?? 0 }}
            </h2>

            <span class="text-sm text-red-600">
                Menu tersedia
            </span>

        </div>




        <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-orange-500">

            <p class="text-gray-500">
                Total Pesanan
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $totalOrder ?? 0 }}
            </h2>

            <span class="text-sm text-orange-500">
                Semua transaksi
            </span>

        </div>




        <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-green-500">

            <p class="text-gray-500">
                Pendapatan
            </p>

            <h2 class="text-3xl font-bold mt-2">
                Rp {{ number_format($totalIncome ?? 0,0,',','.') }}
            </h2>

            <span class="text-sm text-green-600">
                Total pemasukan
            </span>

        </div>




        <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-blue-500">

            <p class="text-gray-500">
                Pelanggan
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $totalCustomer ?? 0 }}
            </h2>

            <span class="text-sm text-blue-600">
                User terdaftar
            </span>

        </div>



    </div>





    <!-- Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


        <!-- Grafik -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">

            <div class="flex justify-between">

                <h2 class="font-bold text-xl">
                    Grafik Penjualan
                </h2>


                <span class="text-sm text-gray-400">
                    Tahun {{ date('Y') }}
                </span>

            </div>



            <div class="mt-8 h-52 flex items-center justify-center bg-gray-50 rounded-xl">

                <p class="text-gray-400">
                    Grafik transaksi akan tampil disini
                </p>

            </div>


        </div>





        <!-- Menu Terlaris -->
        <div class="bg-white rounded-2xl shadow p-6">


            <h2 class="font-bold text-xl mb-5">
                Menu Favorit 🍜
            </h2>


            <div class="space-y-4">


                <div class="flex justify-between items-center">

                    <div>
                        <p class="font-semibold">
                            Bakso Special
                        </p>

                        <p class="text-sm text-gray-400">
                            Terjual 120
                        </p>
                    </div>

                    <span class="text-red-600">
                        🔥
                    </span>

                </div>



                <div class="flex justify-between items-center">

                    <div>
                        <p class="font-semibold">
                            Bakso Urat
                        </p>

                        <p class="text-sm text-gray-400">
                            Terjual 90
                        </p>
                    </div>

                    <span class="text-red-600">
                        🔥
                    </span>

                </div>



                <div class="flex justify-between items-center">

                    <div>
                        <p class="font-semibold">
                            Es Teh
                        </p>

                        <p class="text-sm text-gray-400">
                            Terjual 75
                        </p>
                    </div>

                    <span class="text-red-600">
                        🔥
                    </span>

                </div>



            </div>


        </div>


    </div>





    <!-- Recent Order -->

    <div class="bg-white rounded-2xl shadow p-6 mt-6">


        <h2 class="font-bold text-xl mb-5">
            Pesanan Terbaru
        </h2>



        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="border-b">

                    <tr>

                        <th class="py-3">
                            Pelanggan
                        </th>

                        <th>
                            Pesanan
                        </th>

                        <th>
                            Status
                        </th>

                    </tr>

                </thead>



                <tbody>


                    <tr class="border-b">

                        <td class="py-3">
                            Maria
                        </td>

                        <td>
                            Bakso Komplit
                        </td>

                        <td>

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                Selesai
                            </span>

                        </td>

                    </tr>



                </tbody>


            </table>


        </div>



    </div>



</div>


@endsection
