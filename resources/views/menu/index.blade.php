@extends('layouts.admin')

@section('title','Kelola Menu')

@section('content')

<div class="p-8">


    <!-- HEADER -->

    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Kelola Menu
            </h1>

            <p class="text-gray-500 text-sm mt-1">
                Kelola daftar menu Bakso Pakde Heru
            </p>
        </div>


        <button
        class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-xl shadow">

            <i class="fa fa-plus mr-2"></i>
            Tambah Menu

        </button>

    </div>




    <!-- SEARCH -->

    <div class="mb-8">

        <div class="relative max-w-md">


            <input
            type="text"
            placeholder="Cari menu..."
            class="w-full rounded-xl border-gray-200 shadow-sm px-5 py-3 pl-12 focus:ring-red-500 focus:border-red-500">


            <i class="fa fa-search absolute left-4 top-4 text-gray-400"></i>


        </div>


    </div>





    <!-- CARD MENU -->

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">


        @foreach($menu as $item)


        <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden">


            <!-- FOTO -->

            <div class="h-52 bg-gray-100">


                @if($item->image)

                <img 
                src="{{ asset('storage/'.$item->image) }}"
                class="w-full h-full object-cover">


                @else


                <div class="h-full flex items-center justify-center">

                    <i class="fa fa-image text-5xl text-gray-300"></i>

                </div>


                @endif


            </div>





            <!-- DETAIL -->

            <div class="p-5">


                <div class="flex justify-between">


                    <h2 class="font-bold text-lg text-gray-800">

                        {{ $item->nama_menu }}

                    </h2>


                </div>




                <p class="text-sm text-gray-400 mt-1">

                    {{ $item->kategori->nama_kategori ?? '-' }}

                </p>




                <p class="text-red-600 font-bold text-lg mt-3">

                    Rp {{number_format($item->harga,0,',','.')}}

                </p>





                <div class="flex gap-3 mt-5">


                    <button
                    class="flex-1 py-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50">


                        <i class="fa fa-pen mr-1"></i>

                        Edit


                    </button>



                    <button
                    class="flex-1 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">


                        <i class="fa fa-trash mr-1"></i>

                        Hapus


                    </button>


                </div>



            </div>



        </div>


        @endforeach



    </div>


</div>


@endsection
