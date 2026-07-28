@extends('layouts.app')

@section('title', 'Kelola Kategori - Bakso Pakde Heru')

@section('content')

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">📂 Kelola Kategori</h2>
            <p class="text-muted mb-0">
                Tambah, lihat, dan hapus kategori menu Bakso Pakde Heru.
            </p>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            ← Kembali
        </a>
    </div>


    {{-- PESAN SUKSES --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- PESAN ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- ERROR VALIDASI --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row g-4">

        {{-- FORM TAMBAH KATEGORI --}}
        <div class="col-md-4">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        ➕ Tambah Kategori
                    </h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('kategori.store') }}" method="POST">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                Nama Kategori
                            </label>

                            <input
                                type="text"
                                name="nama_kategori"
                                class="form-control"
                                placeholder="Contoh: Bakso"
                                value="{{ old('nama_kategori') }}"
                                required
                            >

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            💾 Simpan Kategori
                        </button>

                    </form>

                </div>

            </div>

        </div>


        {{-- DAFTAR KATEGORI --}}
        <div class="col-md-8">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        📋 Daftar Kategori
                    </h5>
                </div>

                <div class="card-body p-0">

                    @if(isset($kategoris) && $kategoris->count() > 0)

                        <div class="table-responsive">

                            <table class="table table-hover mb-0 align-middle">

                                <thead class="table-light">

                                    <tr>
                                        <th width="80">No</th>
                                        <th>Nama Kategori</th>
                                        <th width="150">Jumlah Menu</th>
                                        <th width="150">Aksi</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($kategoris as $kategori)

                                        <tr>

                                            <td>
                                                {{ $loop->iteration }}
                                            </td>

                                            <td>
                                                <strong>
                                                    {{ $kategori->nama_kategori }}
                                                </strong>
                                            </td>

                                            <td>

                                                <span class="badge bg-info text-dark">
                                                    {{ $kategori->menus_count ?? $kategori->menus->count() ?? 0 }}
                                                    Menu
                                                </span>

                                            </td>

                                            <td>

                                                <form
                                                    action="{{ route('kategori.destroy', $kategori->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm btn-danger"
                                                    >
                                                        🗑️ Hapus
                                                    </button>

                                                </form>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="text-center py-5">

                            <div style="font-size: 60px;">
                                📂
                            </div>

                            <h5 class="fw-bold mt-3">
                                Belum Ada Kategori
                            </h5>

                            <p class="text-muted">
                                Silakan tambahkan kategori menu terlebih dahulu.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
