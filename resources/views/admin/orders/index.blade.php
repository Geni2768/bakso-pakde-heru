@extends('layouts.app')

@section('title', 'Kelola Pesanan - Admin')

@section('content')

<div class="container py-4">

    <div class="mb-4">
        <h1 class="fw-bold">Kelola Pesanan</h1>
        <p class="text-muted">
            Lihat dan kelola seluruh pesanan pelanggan.
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($orders->count() > 0)

        @foreach($orders as $order)

            @php
                $status = strtolower($order->status ?? 'pending');
            @endphp

            <div class="card mb-4 shadow-sm">

                <div class="card-header bg-white d-flex justify-content-between align-items-center">

                    <div>
                        <strong>
                            Pesanan #{{ $order->id }}
                        </strong>

                        <div class="text-muted small">
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>

                    <span class="badge bg-secondary">
                        {{ ucfirst($status) }}
                    </span>

                </div>

                <div class="card-body">

                    <h5 class="fw-bold mb-3">
                        Informasi Pelanggan
                    </h5>

                    <p class="mb-1">
                        <strong>Nama:</strong>
                        {{ $order->nama_lengkap }}
                    </p>

                    <p class="mb-1">
                        <strong>WhatsApp:</strong>
                        {{ $order->no_whatsapp }}
                    </p>

                    <p class="mb-4">
                        <strong>Alamat:</strong>
                        {{ $order->alamat }}
                    </p>

                    <h5 class="fw-bold mb-3">
                        Item Pesanan
                    </h5>

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($order->items as $item)

                                    <tr>

                                        <td>
                                            {{ $item->menu->nama_menu ?? 'Menu telah dihapus' }}
                                        </td>

                                        <td>
                                            {{ $item->jumlah }}
                                        </td>

                                        <td>
                                            Rp{{ number_format($item->harga, 0, ',', '.') }}
                                        </td>

                                        <td>
                                            Rp{{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    <div class="border-top pt-3 mt-3">

                        <p>
                            <strong>Metode Pembayaran:</strong>
                            {{ ucfirst($order->payment->metode_pembayaran ?? '-') }}
                        </p>

                        <p>
                            <strong>Status Pembayaran:</strong>
                            {{ ucfirst($order->payment->status ?? 'pending') }}
                        </p>

                    </div>

                </div>

                <div class="card-footer bg-white">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="text-muted">
                                Total Pesanan
                            </div>

                            <div class="fs-4 fw-bold text-danger">
                                Rp{{ number_format($order->total_harga, 0, ',', '.') }}
                            </div>

                        </div>

                        <form
                            action="{{ route('admin.orders.update', $order->id) }}"
                            method="POST"
                            class="d-flex gap-2"
                        >

                            @csrf

                            @method('PATCH')

                            <select
                                name="status"
                                class="form-select"
                            >

                                <option
                                    value="pending"
                                    {{ $status === 'pending' ? 'selected' : '' }}
                                >
                                    Menunggu
                                </option>

                                <option
                                    value="diproses"
                                    {{ $status === 'diproses' ? 'selected' : '' }}
                                >
                                    Diproses
                                </option>

                                <option
                                    value="selesai"
                                    {{ $status === 'selesai' ? 'selected' : '' }}
                                >
                                    Selesai
                                </option>

                                <option
                                    value="dibatalkan"
                                    {{ $status === 'dibatalkan' ? 'selected' : '' }}
                                >
                                    Dibatalkan
                                </option>

                            </select>

                            <button
                                type="submit"
                                class="btn btn-danger"
                            >
                                Update Status
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @endforeach

    @else

        <div class="text-center py-5">

            <div style="font-size: 50px;">
                📦
            </div>

            <h4 class="fw-bold mt-3">
                Belum Ada Pesanan
            </h4>

            <p class="text-muted">
                Saat ini belum ada pesanan dari pelanggan.
            </p>

        </div>

    @endif

</div>

@endsection
