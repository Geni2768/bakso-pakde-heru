@extends('layouts.app')

@section('title', 'Kelola Pesanan - Admin')

@section('content')

<div class="container py-4">

    <h1 class="fw-bold mb-2">
        Kelola Pesanan
    </h1>

    <p class="text-muted mb-4">
        Lihat dan kelola seluruh pesanan pelanggan.
    </p>

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

    @forelse($orders as $order)

        <div class="card shadow-sm mb-4">

            <div class="card-header d-flex justify-content-between">

                <strong>
                    Pesanan #{{ $order->id }}
                </strong>

                <span>
                    {{ ucfirst($order->status ?? 'pending') }}
                </span>

            </div>

            <div class="card-body">

                <p>
                    <strong>Nama:</strong>
                    {{ $order->nama_lengkap }}
                </p>

                <p>
                    <strong>WhatsApp:</strong>
                    {{ $order->no_whatsapp }}
                </p>

                <p>
                    <strong>Alamat:</strong>
                    {{ $order->alamat }}
                </p>

                <hr>

                <h5>
                    Detail Pesanan
                </h5>

                @foreach($order->items as $item)

                    <div class="d-flex justify-content-between mb-2">

                        <span>
                            {{ $item->menu?->nama_menu ?? 'Menu telah dihapus' }}
                            ({{ $item->jumlah }}x)
                        </span>

                        <strong>
                            Rp{{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}
                        </strong>

                    </div>

                @endforeach

                <hr>

                <p>
                    <strong>Metode Pembayaran:</strong>
                    {{ ucfirst($order->payment?->metode_pembayaran ?? '-') }}
                </p>

                <p>
                    <strong>Status Pembayaran:</strong>
                    {{ ucfirst($order->payment?->status ?? 'pending') }}
                </p>

                <h4 class="text-danger">
                    Total:
                    Rp{{ number_format($order->total_harga, 0, ',', '.') }}
                </h4>

                <hr>

                <form
                    action="{{ route('admin.orders.updateStatus', $order->id) }}"
                    method="POST"
                >

                    @csrf
                    @method('PATCH')

                    <div class="row g-2">

                        <div class="col-md-8">

                            <select
                                name="status"
                                class="form-select"
                            >

                                <option value="pending">
                                    Menunggu
                                </option>

                                <option value="diproses">
                                    Diproses
                                </option>

                                <option value="selesai">
                                    Selesai
                                </option>

                                <option value="dibatalkan">
                                    Dibatalkan
                                </option>

                            </select>

                        </div>

                        <div class="col-md-4">

                            <button
                                type="submit"
                                class="btn btn-danger w-100"
                            >
                                Update Status
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    @empty

        <div class="alert alert-info">
            Belum ada pesanan dari pelanggan.
        </div>

    @endforelse

</div>

@endsection
