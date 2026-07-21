@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-red-600">
        <h5 class="text-gray-500 text-sm">Total Menu</h5>
        <h2 class="text-3xl font-bold mt-2">{{ \App\Models\Menu::count() }}</h2>
    </div>

    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-600">
        <h5 class="text-gray-500 text-sm">Total Kategori</h5>
        <h2 class="text-3xl font-bold mt-2">{{ \App\Models\Kategori::count() }}</h2>
    </div>

    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-600">
        <h5 class="text-gray-500 text-sm">Total Order</h5>
        <h2 class="text-3xl font-bold mt-2">{{ \App\Models\Order::count() }}</h2>
    </div>

    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-yellow-500">
        <h5 class="text-gray-500 text-sm">Pendapatan</h5>
        <h2 class="text-3xl font-bold mt-2">
            Rp {{ number_format(\App\Models\Payment::sum('amount'),0,',','.') }}
        </h2>
    </div>

</div>

<div class="bg-white rounded-xl shadow mt-8">

    <div class="p-5 border-b">
        <h3 class="font-bold text-lg">
            Pesanan Terbaru
        </h3>
    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

            <tr>

                <th class="p-3 text-left">No</th>
                <th class="p-3 text-left">Pelanggan</th>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-left">Status</th>

            </tr>

            </thead>

            <tbody>

            @forelse(\App\Models\Order::latest()->take(10)->get() as $order)

                <tr class="border-b">

                    <td class="p-3">{{ $loop->iteration }}</td>

                    <td class="p-3">
                        {{ $order->customer_name ?? '-' }}
                    </td>

                    <td class="p-3">
                        {{ $order->created_at->format('d M Y') }}
                    </td>

                    <td class="p-3">

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                            {{ $order->status }}

                        </span>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4" class="text-center p-6">

                        Belum ada pesanan.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
