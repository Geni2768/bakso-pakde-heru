@extends('layouts.app')

@section('title', 'Menu - Bakso Pakde Heru')

@section('content')

<style>
    .page-title {
        font-size: 28px;
        font-weight: 800;
        color: #222;
    }

    .page-subtitle {
        color: #777;
        margin-bottom: 25px;
    }

    .search-box {
        margin-bottom: 30px;
    }

    .search-input {
        border-radius: 6px 0 0 6px;
    }

    .search-button {
        background: #d62828;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        border-radius: 0 6px 6px 0;
    }

    .search-button:hover {
        background: #b71c1c;
    }

    .menu-card {
        background: #ffffff;
        border: 1px solid #eeeeee;
        border-radius: 10px;
        overflow: hidden;
        height: 100%;
        transition: 0.2s;
    }

    .menu-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .menu-image {
        width: 100%;
        height: 190px;
        object-fit: cover;
    }

    .no-image {
        width: 100%;
        height: 190px;
        background: #fff1da;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 55px;
    }

    .menu-content {
        padding: 18px;
    }

    .menu-category {
        color: #d62828;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .menu-name {
        font-size: 17px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .menu-description {
        color: #777;
        font-size: 13px;
        min-height: 42px;
        margin-bottom: 10px;
    }

    .menu-price {
        color: #d62828;
        font-size: 17px;
        font-weight: 800;
        margin-bottom: 15px;
    }

    .btn-add-cart {
        width: 100%;
        background: #d62828;
        color: #ffffff;
        border: none;
        padding: 10px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-add-cart:hover {
        background: #b71c1c;
    }

    .btn-add-cart:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .empty-menu {
        background: #ffffff;
        border: 1px solid #eeeeee;
        border-radius: 10px;
        padding: 60px 20px;
        text-align: center;
    }

    .empty-menu-icon {
        font-size: 50px;
        margin-bottom: 15px;
    }

    .empty-menu-title {
        font-size: 20px;
        font-weight: 800;
    }

    .empty-menu-text {
        color: #777;
        margin-top: 5px;
    }

    .btn-danger-custom {
        background: #d62828;
        color: #ffffff;
        border: none;
        text-decoration: none;
        padding: 10px 18px;
        border-radius: 6px;
    }

    .ajax-message {
        display: none;
        margin-bottom: 20px;
    }
</style>

<div class="container">

```
{{-- HEADER --}}

<div class="text-center">

    <h1 class="page-title">
        Menu Bakso
    </h1>

    <p class="page-subtitle">
        Pilih menu favorit kamu dan pesan sekarang.
    </p>

</div>


{{-- PESAN AJAX --}}

<div
    id="ajax-message"
    class="alert alert-success ajax-message"
></div>


{{-- SEARCH --}}

<div class="search-box">

    <form
        action="{{ route('customer.menu') }}"
        method="GET"
    >

        <div class="input-group">

            <input
                type="text"
                name="search"
                class="form-control search-input"
                placeholder="Cari nama menu..."
                value="{{ $search ?? '' }}"
            >

            <button
                type="submit"
                class="search-button"
            >
                🔍 Cari
            </button>

        </div>

    </form>

</div>


{{-- HASIL PENCARIAN --}}

@if(!empty($search))

    <div class="mb-3">

        <span class="text-muted" style="font-size: 13px;">
            Hasil pencarian untuk:
        </span>

        <strong style="font-size: 13px;">
            "{{ $search }}"
        </strong>

        <a
            href="{{ route('customer.menu') }}"
            class="text-danger ms-2"
            style="font-size: 12px;"
        >
            Reset
        </a>

    </div>

@endif


{{-- DAFTAR MENU --}}

@if($menus->count() > 0)

    <div class="row g-4">

        @foreach($menus as $menu)

            <div class="col-6 col-md-4 col-lg-3">

                <div class="menu-card">


                    {{-- GAMBAR --}}

                    @if($menu->gambar)

                        <img
                            src="{{ asset('storage/' . $menu->gambar) }}"
                            alt="{{ $menu->nama_menu }}"
                            class="menu-image"
                        >

                    @else

                        <div class="no-image">
                            🍜
                        </div>

                    @endif


                    {{-- KONTEN --}}

                    <div class="menu-content">


                        {{-- KATEGORI --}}

                        @if($menu->kategori)

                            <div class="menu-category">

                                {{ $menu->kategori->nama_kategori }}

                            </div>

                        @endif


                        {{-- NAMA --}}

                        <div class="menu-name">

                            {{ $menu->nama_menu }}

                        </div>


                        {{-- DESKRIPSI --}}

                        <div class="menu-description">

                            {{ $menu->deskripsi
                                ?? 'Menu lezat khas Bakso Pakde Heru.'
                            }}

                        </div>


                        {{-- HARGA --}}

                        <div class="menu-price">

                            Rp{{ number_format(
                                $menu->harga,
                                0,
                                ',',
                                '.'
                            ) }}

                        </div>


                        {{-- TAMBAH KE KERANJANG AJAX --}}

                        <form
                            action="{{ route('cart.add', $menu->id) }}"
                            method="POST"
                            class="add-cart-form"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn-add-cart"
                            >
                                🛒 Tambah ke Keranjang
                            </button>

                        </form>


                    </div>

                </div>

            </div>

        @endforeach

    </div>

@else


    {{-- MENU KOSONG --}}

    <div class="empty-menu">

        <div class="empty-menu-icon">
            🍜
        </div>

        <div class="empty-menu-title">
            Menu Tidak Ditemukan
        </div>

        <div class="empty-menu-text">
            Maaf, menu yang kamu cari belum tersedia.
        </div>

        @if(!empty($search))

            <a
                href="{{ route('customer.menu') }}"
                class="btn btn-danger-custom mt-3"
            >
                Lihat Semua Menu
            </a>

        @endif

    </div>

@endif
```

</div>

{{-- AJAX TAMBAH KERANJANG --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const forms = document.querySelectorAll('.add-cart-form');

    const messageBox = document.getElementById('ajax-message');


    forms.forEach(function (form) {

        form.addEventListener('submit', function (event) {

            event.preventDefault();


            const button = form.querySelector(
                '.btn-add-cart'
            );


            const originalText = button.innerHTML;


            button.disabled = true;

            button.innerHTML = '⏳ Menambahkan...';


            const formData = new FormData(form);


            fetch(form.action, {

                method: 'POST',

                headers: {

                    'X-Requested-With':
                        'XMLHttpRequest',

                    'Accept':
                        'application/json'

                },

                body: formData

            })


            .then(function (response) {

                if (!response.ok) {

                    throw new Error(
                        'Gagal menambahkan menu.'
                    );

                }

                return response.json();

            })


            .then(function (data) {

                messageBox.textContent =
                    data.message ||
                    'Menu berhasil ditambahkan ke keranjang.';

                messageBox.style.display =
                    'block';


                button.innerHTML =
                    '✅ Ditambahkan';


                setTimeout(function () {

                    messageBox.style.display =
                        'none';

                    button.innerHTML =
                        originalText;

                    button.disabled =
                        false;

                }, 2000);

            })


            .catch(function (error) {

                messageBox.classList.remove(
                    'alert-success'
                );

                messageBox.classList.add(
                    'alert-danger'
                );

                messageBox.textContent =
                    error.message ||
                    'Terjadi kesalahan.';

                messageBox.style.display =
                    'block';


                button.innerHTML =
                    originalText;

                button.disabled =
                    false;

            });

        });

    });

});

</script>

@endsection

