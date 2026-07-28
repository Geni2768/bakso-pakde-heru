@extends('layouts.app')

@section('title', 'Tambah Menu - Bakso Pakde Heru')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                🍜 Tambah Menu
            </h2>

            <p class="text-muted mb-0">
                Tambahkan menu baru ke Bakso Pakde Heru.
            </p>
        </div>

        <a href="/menu-admin"
           class="btn btn-secondary">

            ← Kembali

        </a>

    </div>


    {{-- TAMPILKAN ERROR --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Data belum benar:</strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4 p-md-5">

            <form action="/menu-admin"
                  method="POST">

                @csrf


                {{-- KATEGORI --}}
                <div class="mb-3">

                    <label for="kategori_id"
                           class="form-label fw-bold">

                        Kategori

                    </label>

                    <select name="kategori_id"
                            id="kategori_id"
                            class="form-select"
                            required>

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        @foreach ($kategoris as $kategori)

                            <option
                                value="{{ $kategori->id }}"
                                @selected(
                                    old('kategori_id') == $kategori->id
                                )
                            >

                                {{ $kategori->nama_kategori }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- NAMA MENU --}}
                <div class="mb-3">

                    <label for="nama_menu"
                           class="form-label fw-bold">

                        Nama Menu

                    </label>

                    <input type="text"
                           name="nama_menu"
                           id="nama_menu"
                           class="form-control"
                           value="{{ old('nama_menu') }}"
                           placeholder="Contoh: Bakso Mercon"
                           required>

                </div>


                {{-- DESKRIPSI --}}
                <div class="mb-3">

                    <label for="deskripsi"
                           class="form-label fw-bold">

                        Deskripsi

                    </label>

                    <textarea name="deskripsi"
                              id="deskripsi"
                              class="form-control"
                              rows="4"
                              placeholder="Masukkan deskripsi menu">

{{ old('deskripsi') }}</textarea>

                </div>


                <div class="row">

                    {{-- HARGA --}}
                    <div class="col-md-6">

                        <div class="mb-3">

                            <label for="harga"
                                   class="form-label fw-bold">

                                Harga

                            </label>

                            <input type="number"
                                   name="harga"
                                   id="harga"
                                   class="form-control"
                                   value="{{ old('harga') }}"
                                   min="0"
                                   placeholder="Contoh: 15000"
                                   required>

                        </div>

                    </div>


                    {{-- STOK --}}
                    <div class="col-md-6">

                        <div class="mb-3">

                            <label for="stok"
                                   class="form-label fw-bold">

                                Stok

                            </label>

                            <input type="number"
                                   name="stok"
                                   id="stok"
                                   class="form-control"
                                   value="{{ old('stok', 0) }}"
                                   min="0"
                                   required>

                        </div>

                    </div>

                </div>


                {{-- STATUS --}}
                <div class="mb-4">

                    <label for="status"
                           class="form-label fw-bold">

                        Status

                    </label>

                    <select name="status"
                            id="status"
                            class="form-select"
                            required>

                        <option value="Tersedia"
                            @selected(
                                old('status', 'Tersedia')
                                === 'Tersedia'
                            )>

                            Tersedia

                        </option>

                        <option value="Habis"
                            @selected(
                                old('status') === 'Habis'
                            )>

                            Habis

                        </option>

                    </select>

                </div>


                {{-- TOMBOL --}}
                <div class="d-flex gap-2">

                    <button type="submit"
                            class="btn btn-primary">

                        💾 Simpan Menu

                    </button>

                    <a href="/menu-admin"
                       class="btn btn-outline-secondary">

                        Batal

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
