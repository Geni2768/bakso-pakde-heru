<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Tampilkan halaman daftar menu.
     * Kirim daftar kategori untuk filter & dropdown form.
     */
    public function index()
    {
        // Eager loading: ambil kategori beserta jumlah menunya sekaligus
        $kategoris = Kategori::withCount('menus')->orderBy('nama_kategori')->get();

        return view('menu.index', compact('kategoris'));
    }

    /**
     * Ambil semua data menu dengan eager loading kategori (dipanggil AJAX).
     * Support filter by kategori dan status.
     */
    public function getData(Request $request)
    {
        $query = Menu::with('kategori'); // eager loading — cegah N+1

        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter pencarian nama
        if ($request->filled('search')) {
            $query->where('nama_menu', 'like', '%' . $request->search . '%');
        }

        $menus = $query->orderBy('nama_menu')->get()->map(function ($menu) {
            return [
                'id'             => $menu->id,
                'nama_menu'      => $menu->nama_menu,
                'deskripsi'      => $menu->deskripsi,
                'harga'          => $menu->harga,
                'harga_format'   => 'Rp ' . number_format($menu->harga, 0, ',', '.'),
                'stok'           => $menu->stok,
                'status'         => $menu->status,
                'gambar_url'     => $menu->gambar_url,
                'kategori_id'    => $menu->kategori_id,
                'nama_kategori'  => $menu->kategori?->nama_kategori ?? '-',
            ];
        });

        return response()->json([
            'success' => true,
            'data'    => $menus,
        ]);
    }

    /**
     * Simpan menu baru dengan upload gambar (dipanggil AJAX).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_menu'   => 'required|string|max:150',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'status'      => 'required|in:Tersedia,Habis',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists'   => 'Kategori tidak valid.',
            'nama_menu.required'   => 'Nama menu wajib diisi.',
            'harga.required'       => 'Harga wajib diisi.',
            'harga.numeric'        => 'Harga harus berupa angka.',
            'stok.required'        => 'Stok wajib diisi.',
            'gambar.image'         => 'File harus berupa gambar.',
            'gambar.max'           => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')
                                            ->store('menus', 'public');
        }

        $menu = Menu::create($validated);
        Cache::forget('menus_all');

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil ditambahkan!',
            'data'    => $menu->load('kategori'),
        ], 201);
    }

    /**
     * Ambil data satu menu untuk form edit (dipanggil AJAX).
     */
    public function show(Menu $menu)
    {
        return response()->json([
            'success' => true,
            'data'    => [
                'id'           => $menu->id,
                'kategori_id'  => $menu->kategori_id,
                'nama_menu'    => $menu->nama_menu,
                'deskripsi'    => $menu->deskripsi,
                'harga'        => $menu->harga,
                'stok'         => $menu->stok,
                'status'       => $menu->status,
                'gambar_url'   => $menu->gambar_url,
            ],
        ]);
    }

    /**
     * Update data menu (dipanggil AJAX).
     * Mendukung replace gambar lama.
     */
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_menu'   => 'required|string|max:150',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'status'      => 'required|in:Tersedia,Habis',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Jika ada gambar baru, hapus gambar lama dan upload yang baru
        if ($request->hasFile('gambar')) {
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $validated['gambar'] = $request->file('gambar')
                                            ->store('menus', 'public');
        } else {
            // Pertahankan gambar lama
            unset($validated['gambar']);
        }

        $menu->update($validated);
        Cache::forget('menus_all');

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil diperbarui!',
            'data'    => $menu->fresh('kategori'),
        ]);
    }

    /**
     * Hapus menu beserta gambarnya (dipanggil AJAX).
     */
    public function destroy(Menu $menu)
    {
        // Hapus file gambar dari storage
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }

        $menu->delete();
        Cache::forget('menus_all');

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil dihapus!',
        ]);
    }
}
