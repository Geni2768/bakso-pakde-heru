<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KategoriController extends Controller
{
    /**
     * Halaman Kelola Kategori
     */
    public function index()
    {
        $kategoris = Kategori::withCount('menus')
            ->orderBy('nama_kategori')
            ->get();

        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Data kategori untuk AJAX/API
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
            'data' => $kategoris,
        ]);
    }

    /**
     * Tambah kategori baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                'unique:kategoris,nama_kategori',
            ],
            'deskripsi' => [
                'nullable',
                'string',
                'max:255',
            ],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter.',
        ]);

        Kategori::create($validated);

        Cache::forget('kategoris_all');

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Detail kategori
     */
    public function show(Kategori $kategori)
    {
        return view('kategori.show', compact('kategori'));
    }

    /**
     * Halaman edit kategori
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                'unique:kategoris,nama_kategori,' . $kategori->id,
            ],
            'deskripsi' => [
                'nullable',
                'string',
                'max:255',
            ],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan.',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter.',
        ]);

        $kategori->update($validated);

        Cache::forget('kategoris_all');

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori
     */
    public function destroy(Kategori $kategori)
    {
        // Cek apakah kategori masih digunakan oleh menu
        if ($kategori->menus()->count() > 0) {
            return redirect()
                ->route('kategori.index')
                ->with('error', 'Kategori tidak bisa dihapus karena masih memiliki menu!');
        }

        $kategori->delete();

        Cache::forget('kategoris_all');

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
