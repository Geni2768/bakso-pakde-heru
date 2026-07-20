{{-- resources/views/kategori/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🗂️ Manajemen Kategori
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            {{-- Alert Notifikasi --}}
            <div id="alert-box" class="hidden mb-4 p-4 rounded-lg text-white text-sm font-medium"></div>

            {{-- Card Utama --}}
            <div class="bg-white shadow rounded-lg overflow-hidden">

                {{-- Header Card --}}
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Daftar Kategori Menu</h3>
                    <button onclick="bukaModalTambah()"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                        + Tambah Kategori
                    </button>
                </div>

                {{-- Tabel Data --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Nama Kategori</th>
                                <th class="px-6 py-3">Deskripsi</th>
                                <th class="px-6 py-3 text-center">Jumlah Menu</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tabel-kategori" class="divide-y divide-gray-100">
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400">
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

    {{-- ===== MODAL TAMBAH / EDIT KATEGORI ===== --}}
    <div id="modal-kategori" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-6">

            <h3 id="modal-title" class="text-lg font-semibold text-gray-800 mb-4">Tambah Kategori</h3>

            <form id="form-kategori" novalidate>
                @csrf
                <input type="hidden" id="kategori-id" value="">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama_kategori" name="nama_kategori"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400"
                        placeholder="Contoh: Bakso, Mie, Minuman...">
                    <p id="error-nama_kategori" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400"
                        placeholder="Deskripsi singkat kategori (opsional)"></textarea>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="tutupModal()"
                        class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 border border-gray-300 rounded-lg">
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
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Hapus Kategori?</h3>
            <p class="text-sm text-gray-500 mb-5">
                Kategori <strong id="nama-hapus"></strong> akan dihapus permanen.
                Pastikan tidak ada menu di kategori ini.
            </p>
            <div class="flex justify-center gap-3">
                <button onclick="tutupModalHapus()"
                    class="px-4 py-2 text-sm border border-gray-300 rounded-lg text-gray-600 hover:text-gray-800">
                    Batal
                </button>
                <button id="btn-konfirmasi-hapus"
                    class="px-5 py-2 text-sm bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    {{-- ===== JAVASCRIPT AJAX ===== --}}
    <script>
        const BASE_URL = '{{ url("/kategori") }}';
        const CSRF    = '{{ csrf_token() }}';
        let hapusId   = null;

        // ─── Load data saat halaman dibuka ───────────────────────
        document.addEventListener('DOMContentLoaded', loadKategori);

        async function loadKategori() {
            try {
                const res  = await fetch(`${BASE_URL}/data`);
                const json = await res.json();
                renderTabel(json.data);
            } catch (e) {
                tampilAlert('Gagal memuat data kategori.', 'error');
            }
        }

        // ─── Render baris tabel ───────────────────────────────────
        function renderTabel(data) {
            const tbody = document.getElementById('tabel-kategori');

            if (!data.length) {
                tbody.innerHTML = `<tr><td colspan="5" class="px-6 py-8 text-center text-gray-400">
                    Belum ada data kategori.</td></tr>`;
                return;
            }

            tbody.innerHTML = data.map((item, i) => `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 text-gray-500">${i + 1}</td>
                    <td class="px-6 py-3 font-medium text-gray-800">${item.nama_kategori}</td>
                    <td class="px-6 py-3 text-gray-500">${item.deskripsi ?? '-'}</td>
                    <td class="px-6 py-3 text-center">
                        <span class="bg-orange-100 text-orange-700 text-xs font-semibold px-2 py-1 rounded-full">
                            ${item.menus_count} menu
                        </span>
                    </td>
                    <td class="px-6 py-3 text-center space-x-2">
                        <button onclick="bukaModalEdit(${item.id})"
                            class="text-blue-500 hover:text-blue-700 text-xs font-medium underline">Edit</button>
                        <button onclick="konfirmasiHapus(${item.id}, '${item.nama_kategori}')"
                            class="text-red-500 hover:text-red-700 text-xs font-medium underline">Hapus</button>
                    </td>
                </tr>
            `).join('');
        }

        // ─── Modal Tambah ─────────────────────────────────────────
        function bukaModalTambah() {
            document.getElementById('modal-title').textContent = 'Tambah Kategori';
            document.getElementById('kategori-id').value = '';
            document.getElementById('nama_kategori').value = '';
            document.getElementById('deskripsi').value = '';
            bersihkanError();
            document.getElementById('modal-kategori').classList.remove('hidden');
        }

        // ─── Modal Edit ───────────────────────────────────────────
        async function bukaModalEdit(id) {
            try {
                const res  = await fetch(`${BASE_URL}/${id}`);
                const json = await res.json();

                document.getElementById('modal-title').textContent = 'Edit Kategori';
                document.getElementById('kategori-id').value       = json.data.id;
                document.getElementById('nama_kategori').value     = json.data.nama_kategori;
                document.getElementById('deskripsi').value         = json.data.deskripsi ?? '';
                bersihkanError();
                document.getElementById('modal-kategori').classList.remove('hidden');
            } catch (e) {
                tampilAlert('Gagal memuat data kategori.', 'error');
            }
        }

        function tutupModal() {
            document.getElementById('modal-kategori').classList.add('hidden');
        }

        // ─── Submit Form (Tambah / Edit) ──────────────────────────
        document.getElementById('form-kategori').addEventListener('submit', async function (e) {
            e.preventDefault();
            bersihkanError();

            const id     = document.getElementById('kategori-id').value;
            const isEdit = id !== '';
            const url    = isEdit ? `${BASE_URL}/${id}` : BASE_URL;
            const method = isEdit ? 'PUT' : 'POST';

            const body = {
                nama_kategori : document.getElementById('nama_kategori').value,
                deskripsi     : document.getElementById('deskripsi').value,
                _token        : CSRF,
            };

            const btn = document.getElementById('btn-simpan');
            btn.disabled    = true;
            btn.textContent = 'Menyimpan...';

            try {
                const res  = await fetch(url, {
                    method,
                    headers: {
                        'Content-Type' : 'application/json',
                        'X-CSRF-TOKEN' : CSRF,
                        'Accept'       : 'application/json',
                    },
                    body: JSON.stringify(body),
                });

                const json = await res.json();

                if (res.ok) {
                    tutupModal();
                    tampilAlert(json.message, 'success');
                    loadKategori();
                } else if (res.status === 422) {
                    // Tampilkan error validasi
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

        // ─── Hapus ───────────────────────────────────────────────
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
                    loadKategori();
                } else {
                    tampilAlert(json.message, 'error');
                }
            } catch (e) {
                tampilAlert('Gagal menghapus kategori.', 'error');
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
