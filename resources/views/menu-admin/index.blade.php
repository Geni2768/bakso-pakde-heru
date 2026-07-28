@extends('layouts.app')

@section('title', 'Kelola Menu - Bakso Pakde Heru')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">🍜 Kelola Menu</h2>
            <p class="text-muted mb-0">
                Kelola daftar menu Bakso Pakde Heru.
            </p>
        </div>

        <a href="{{ route('menu-admin.create') }}"
           class="btn btn-primary">
            + Tambah Menu
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">

        <div class="card-body">

            @if($menus->isEmpty())

                <div class="text-center py-5">

                    <div style="font-size: 60px;">
                        🍜
                    </div>

                    <h4 class="fw-bold mt-3">
                        Belum Ada Menu
                    </h4>

                    <p class="text-muted">
                        Silakan tambahkan menu pertama.
                    </p>

                    <a href="{{ route('menu-admin.create') }}"
                       class="btn btn-primary">
                        + Tambah Menu
                    </a>

                </div>

            @else

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-dark">

                            <tr>
                                <th>No</th>
                                <th>Menu</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                        @foreach($menus as $menu)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $menu->nama_menu }}
                                    </strong>

                                    @if($menu->deskripsi)
                                        <br>
                                        <small class="text-muted">
                                            {{ $menu->deskripsi }}
                                        </small>
                                    @endif
                                </td>

                                <td>
                                    {{ $menu->kategori->nama_kategori ?? '-' }}
                                </td>

                                <td>
                                    Rp{{ number_format($menu->harga, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $menu->stok }}
                                </td>

                                <td>

                                    @if($menu->status === 'Tersedia')

                                        <span class="badge bg-success">
                                            Tersedia
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Habis
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route('menu-admin.edit', $menu) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('menu-admin.destroy', $menu) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                            Hapus
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection
