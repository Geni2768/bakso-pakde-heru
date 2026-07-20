{{-- resources/views/menu/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🍜 Manajemen Menu
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- Alert --}}
            <div id="alert-box" class="hidden mb-4 p-4 rounded-lg text-white text-sm font-medium"></div>

            {{-- Card Utama --}}
            <div class="bg-white shadow rounded-lg overflow-hidden">

                {{-- Header + Filter --}}
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <h3 class="text-lg font-semibold text-gray-700">Daftar Menu Bakso Pak Heru</h3>
                        <button onclick="bukaModalTambah()"
                            class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                            + Tambah Menu
                        </button>
                    </div>

                    {{-- Filter Bar --}}
                    <div class="flex flex-wrap gap-3 mt-4">
                        <input type="text" id="filter-search" placeholder="Cari nama menu..."
                            class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 w-48"
                            oninput="loadMenu()">

                        <select id="filter-kategori"
                            class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400"
                            onchange="loadMenu()">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>

                        <select id="filter-status"
                            class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400"
                            onchange="loadMenu()">
                            <option value="">Semua Status</option>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Habis">Habis</option>
                        </select>
                    </div>
                </div>

                {{-- Tabel --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3">Gambar</th>
                                <th class="px-4 py-3">Nama Menu</th>
                                <th class="px-4 py-3">Kategori</th>
                                <th class="px-4 py-3 text-right">Harga</th>
                                <th class="px-4 py-3 text-center">Stok</th>
                                <th class="px-4 py-3 text-center">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tabel-menu" class="divide-y divide-gray-100">
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-400">
                                    <svg class="animate-spin h-5 w-5 mx-auto mb-2 text-orange-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                    </svg>
                                    Memuat data...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- ===== MODAL TAMBAH / EDIT MENU ===== --}}
    <div id="modal-menu" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-lg max-h-screen overflow-y-auto p-6">

            <h3 id="modal-title" class="text-lg font-semibold text-gray-800 mb-5">Tambah Menu</h3>

            <form id="form-menu" enctype="multipart/form-data" novalidate>
                @csrf
                <input type="hidden" id="menu-id" value="">

                {{-- Kategori --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select id="kategori_id" name="kategori_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                    <p id="error-kategori_id" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>

                {{-- Nama Menu --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Menu <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama_menu" name="nama_menu"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400"
                        placeholder="Contoh: Bakso Urat, Mie Ayam...">
                    <p id="error-nama_menu" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="2"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400"
                        placeholder="Deskripsi singkat menu..."></textarea>
                </div>

                {{-- Harga & Stok --}}
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Harga (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="harga" name="harga" min="0"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400"
                            placeholder="15000">
                        <p id="error-harga" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Stok <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="stok" name="stok" min="0"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400"
                            placeholder="50">
                        <p id="error-stok" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>
                </div>

                {{-- Upload Gambar --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Menu</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400"
                        onchange="previewGambar(event)">
                    <p class="text-gray-400 text-xs mt-1">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                    <p id="error-gambar" class="text-red-500 text-xs mt-1 hidden"></p>
                    <img id="preview-gambar" src="" alt="Preview" class="mt-2 h-24 w-24 object-cover rounded-lg hidden">
                </div>

                {{-- Status --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Habis">Habis</option>
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="tutupModal()"
                        class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:text-gray-800">
                        Batal
                    </button>
                    <button type="submit" id="btn-simpan"
                        class="px-5 py-2 text-sm bg-orange-500 hover:bg-orange-600 text-white rounded-lg font-medium transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== MODAL KONFIRMASI HAPUS ===== --}}
    <div id="modal-hapus" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-sm mx-4 p-6 text-center">
            <div class="text-4xl mb-3">🗑️</div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Hapus Menu?</h3>
            <p class="text-sm text-gray-500 mb-5">
                Menu <strong id="nama-hapus"></strong> akan dihapus permanen beserta gambarnya.
            </p>
            <div class="flex justify-center gap-3">
                <button onclick="tutupModalHapus()"
                    class="px-4 py-2 text-sm border border-gray-300 rounded-lg text-gray-600">Batal</button>
                <button id="btn-konfirmasi-hapus"
                    class="px-5 py-2 text-sm bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    {{-- ===== JAVASCRIPT AJAX ===== --}}
    <script>
        const BASE_URL = '{{ url("/menu") }}';
        const CSRF     = '{{ csrf_token() }}';
        let hapusId    = null;

        // ─── Load saat halaman dibuka ─────────────────────────────
        document.addEventListener('DOMContentLoaded', loadMenu);

        async function loadMenu() {
            const search    = document.getElementById('filter-search').value;
            const kategori  = document.getElementById('filter-kategori').value;
            const status    = document.getElementById('filter-status').value;

            const params = new URLSearchParams({ search, kategori_id: kategori, status });

            try {
                const res  = await fetch(`${BASE_URL}/data?${params}`);
                const json = await res.json();
                renderTabel(json.data);
            } catch (e) {
                tampilAlert('Gagal memuat data menu.', 'error');
            }
        }

        // ─── Render tabel ─────────────────────────────────────────
        function renderTabel(data) {
            const tbody = document.getElementById('tabel-menu');

            if (!data.length) {
                tbody.innerHTML = `<tr><td colspan="7" class="px-6 py-8 text-center text-gray-400">
                    Tidak ada menu ditemukan.</td></tr>`;
                return;
            }

            tbody.innerHTML = data.map(item => `
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <img src="${item.gambar_url}" alt="${item.nama_menu}"
                            class="h-12 w-12 object-cover rounded-lg border border-gray-200"
                            onerror="this.src='{{ asset('images/no-image.png') }}'">
                    </td>
                    <td class="px-4 py-3">
                        <div class="font-medium text-gray-800">${item.nama_menu}</div>
                        <div class="text-xs text-gray-400 truncate max-w-xs">${item.deskripsi ?? ''}</div>
                    </td>
                    <td class="px-4 py-3 text-gray-600">${item.nama_kategori}</td>
                    <td class="px-4 py-3 text-right font-semibold text-gray-800">${item.harga_format}</td>
                    <td class="px-4 py-3 text-center">${item.stok}</td>
                    <td class="px-4 py-3 text-center">
                        <span class="text-xs font-semibold px-2 py-1 rounded-full ${
                            item.status === 'Tersedia'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-600'
                        }">
                            ${item.status}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center space-x-2">
                        <button onclick="bukaModalEdit(${item.id})"
                            class="text-blue-500 hover:text-blue-700 text-xs font-medium underline">Edit</button>
                        <button onclick="konfirmasiHapus(${item.id}, '${item.nama_menu}')"
                            class="text-red-500 hover:text-red-700 text-xs font-medium underline">Hapus</button>
                    </td>
                </tr>
            `).join('');
        }

        // ─── Preview gambar sebelum upload ────────────────────────
        function previewGambar(event) {
            const file    = event.target.files[0];
            const preview = document.getElementById('preview-gambar');
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            }
        }

        // ─── Modal Tambah ─────────────────────────────────────────
        function bukaModalTambah() {
            document.getElementById('modal-title').textContent = 'Tambah Menu';
            document.getElementById('form-menu').reset();
            document.getElementById('menu-id').value = '';
            document.getElementById('preview-gambar').classList.add('hidden');
            bersihkanError();
            document.getElementById('modal-menu').classList.remove('hidden');
        }

        // ─── Modal Edit ───────────────────────────────────────────
        async function bukaModalEdit(id) {
            try {
                const res  = await fetch(`${BASE_URL}/${id}`);
                const json = await res.json();
                const d    = json.data;

                document.getElementById('modal-title').textContent = 'Edit Menu';
                document.getElementById('menu-id').value      = d.id;
                document.getElementById('kategori_id').value  = d.kategori_id;
                document.getElementById('nama_menu').value    = d.nama_menu;
                document.getElementById('deskripsi').value    = d.deskripsi ?? '';
                document.getElementById('harga').value        = d.harga;
                document.getElementById('stok').value         = d.stok;
                document.getElementById('status').value       = d.status;

                const preview = document.getElementById('preview-gambar');
                if (d.gambar_url) {
                    preview.src = d.gambar_url;
                    preview.classList.remove('hidden');
                } else {
                    preview.classList.add('hidden');
                }

                bersihkanError();
                document.getElementById('modal-menu').classList.remove('hidden');
            } catch (e) {
                tampilAlert('Gagal memuat data menu.', 'error');
            }
        }

        function tutupModal() {
            document.getElementById('modal-menu').classList.add('hidden');
        }

        // ─── Submit Form (gunakan FormData untuk support upload file) ──
        document.getElementById('form-menu').addEventListener('submit', async function (e) {
            e.preventDefault();
            bersihkanError();

            const id     = document.getElementById('menu-id').value;
            const isEdit = id !== '';
            const url    = isEdit ? `${BASE_URL}/${id}` : BASE_URL;

            // FormData diperlukan agar file gambar bisa dikirim
            const formData = new FormData();
            formData.append('_token',      CSRF);
            formData.append('kategori_id', document.getElementById('kategori_id').value);
            formData.append('nama_menu',   document.getElementById('nama_menu').value);
            formData.append('deskripsi',   document.getElementById('deskripsi').value);
            formData.append('harga',       document.getElementById('harga').value);
            formData.append('stok',        document.getElementById('stok').value);
            formData.append('status',      document.getElementById('status').value);

            const gambarFile = document.getElementById('gambar').files[0];
            if (gambarFile) formData.append('gambar', gambarFile);

            // Catatan: route update menu pakai POST (bukan PUT) karena FormData
            // tidak support method PUT dengan file. Method override sudah dihandle di route.

            const btn = document.getElementById('btn-simpan');
            btn.disabled    = true;
            btn.textContent = 'Menyimpan...';

            try {
                const res  = await fetch(url, {
                    method : 'POST',
                    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                    body   : formData,
                });

                const json = await res.json();

                if (res.ok) {
                    tutupModal();
                    tampilAlert(json.message, 'success');
                    loadMenu();
                } else if (res.status === 422) {
                    Object.entries(json.errors).forEach(([field, messages]) => {
                        const el = document.getElementById(`error-${field}`);
                        if (el) { el.textContent = messages[0]; el.classList.remove('hidden'); }
                    });
                } else {
                    tampilAlert(json.message ?? 'Terjadi kesalahan.', 'error');
                }
            } catch (e) {
                tampilAlert('Koneksi gagal. Coba lagi.', 'error');
            } finally {
                btn.disabled    = false;
                btn.textContent = 'Simpan';
            }
        });

        // ─── Hapus ────────────────────────────────────────────────
        function konfirmasiHapus(id, nama) {
            hapusId = id;
            document.getElementById('nama-hapus').textContent = nama;
            document.getElementById('modal-hapus').classList.remove('hidden');
        }

        function tutupModalHapus() {
            document.getElementById('modal-hapus').classList.add('hidden');
            hapusId = null;
        }

        document.getElementById('btn-konfirmasi-hapus').addEventListener('click', async function () {
            if (!hapusId) return;

            try {
                const res  = await fetch(`${BASE_URL}/${hapusId}`, {
                    method : 'DELETE',
                    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                });
                const json = await res.json();

                tutupModalHapus();

                if (json.success) {
                    tampilAlert(json.message, 'success');
                    loadMenu();
                } else {
                    tampilAlert(json.message, 'error');
                }
            } catch (e) {
                tampilAlert('Gagal menghapus menu.', 'error');
            }
        });

        // ─── Helper ───────────────────────────────────────────────
        function bersihkanError() {
            document.querySelectorAll('[id^="error-"]').forEach(el => {
                el.textContent = '';
                el.classList.add('hidden');
            });
        }

        function tampilAlert(pesan, tipe) {
            const box = document.getElementById('alert-box');
            box.textContent = pesan;
            box.className   = `mb-4 p-4 rounded-lg text-white text-sm font-medium ${
                tipe === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
            box.classList.remove('hidden');
            setTimeout(() => box.classList.add('hidden'), 3500);
        }
    </script>
</x-app-layout>
