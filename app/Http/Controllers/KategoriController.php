<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KategoriController extends Controller
{
    /**
     * Tampilkan halaman daftar kategori.
     * Data diambil via AJAX dari method index().
     */
    public function index()
    {
        return view('kategori.index');
    }

    /**
     * Ambil semua data kategori (dipanggil AJAX).
     * Menggunakan cache untuk efisiensi query.
     */
    public function getData()
    {
        $kategoris = Cache::remember('kategoris_all', 300, function () {
            return Kategori::withCount('menus')
                           ->orderBy('nama_kategori')
                           ->get();
        });

        return response()->json([
            'success' => true,
            'data'    => $kategoris,
        ]);
    }

    /**
     * Simpan kategori baru (dipanggil AJAX).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategoris,nama_kategori',
            'deskripsi'     => 'nullable|string|max:255',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori sudah ada.',
            'nama_kategori.max'      => 'Nama kategori maksimal 100 karakter.',
        ]);

        $kategori = Kategori::create($validated);

        // Hapus cache agar data terbaru tampil
        Cache::forget('kategoris_all');

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan!',
            'data'    => $kategori,
        ], 201);
    }

    /**
     * Ambil data satu kategori untuk form edit (dipanggil AJAX).
     */
    public function show(Kategori $kategori)
    {
        return response()->json([
            'success' => true,
            'data'    => $kategori,
        ]);
    }

    /**
     * Update kategori (dipanggil AJAX).
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategoris,nama_kategori,' . $kategori->id,
            'deskripsi'     => 'nullable|string|max:255',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori sudah digunakan.',
        ]);

        $kategori->update($validated);

        Cache::forget('kategoris_all');

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui!',
            'data'    => $kategori,
        ]);
    }

    /**
     * Hapus kategori (dipanggil AJAX).
     */
    public function destroy(Kategori $kategori)
    {
        // Cek apakah kategori masih digunakan
        if ($kategori->menus()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak bisa dihapus karena masih memiliki menu!',
            ], 422);
        }

        $kategori->delete();

        Cache::forget('kategoris_all');

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus!',
        ]);
    }
}
