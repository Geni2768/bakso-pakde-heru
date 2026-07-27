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
     * Tampilkan halaman daftar menu customer.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $menus = Menu::with('kategori')
            ->when($search, function ($query) use ($search) {
                $query->where(
                    'nama_menu',
                    'like',
                    '%' . $search . '%'
                );
            })
            ->orderBy('nama_menu')
            ->get();

        $kategoris = Kategori::withCount('menus')
            ->orderBy('nama_kategori')
            ->get();

        return view('menu.index', compact(
            'menus',
            'kategoris',
            'search'
        ));
    }


    /**
     * Ambil semua data menu dengan AJAX.
     */
    public function getData(Request $request)
    {
        $query = Menu::with('kategori');

        // Filter kategori
        if ($request->filled('kategori_id')) {
            $query->where(
                'kategori_id',
                $request->kategori_id
            );
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        // Pencarian nama menu
        if ($request->filled('search')) {
            $query->where(
                'nama_menu',
                'like',
                '%' . $request->search . '%'
            );
        }

        $menus = $query
            ->orderBy('nama_menu')
            ->get()
            ->map(function ($menu) {

                return [
                    'id' => $menu->id,

                    'nama_menu' => $menu->nama_menu,

                    'deskripsi' => $menu->deskripsi,

                    'harga' => $menu->harga,

                    'harga_format' =>
                        'Rp ' . number_format(
                            $menu->harga,
                            0,
                            ',',
                            '.'
                        ),

                    'stok' => $menu->stok,

                    'status' => $menu->status,

                    'gambar_url' =>
                        $menu->gambar_url,

                    'kategori_id' =>
                        $menu->kategori_id,

                    'nama_kategori' =>
                        $menu->kategori?->nama_kategori
                        ?? '-',
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $menus,
        ]);
    }


    /**
     * Simpan menu baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'kategori_id' =>
                'required|exists:kategoris,id',

            'nama_menu' =>
                'required|string|max:150',

            'deskripsi' =>
                'nullable|string',

            'harga' =>
                'required|numeric|min:0',

            'stok' =>
                'required|integer|min:0',

            'status' =>
                'required|in:Tersedia,Habis',

            'gambar' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ], [

            'kategori_id.required' =>
                'Kategori wajib dipilih.',

            'kategori_id.exists' =>
                'Kategori tidak valid.',

            'nama_menu.required' =>
                'Nama menu wajib diisi.',

            'harga.required' =>
                'Harga wajib diisi.',

            'harga.numeric' =>
                'Harga harus berupa angka.',

            'stok.required' =>
                'Stok wajib diisi.',

            'gambar.image' =>
                'File harus berupa gambar.',

            'gambar.max' =>
                'Ukuran gambar maksimal 2MB.',
        ]);


        // Upload gambar
        if ($request->hasFile('gambar')) {

            $validated['gambar'] =
                $request->file('gambar')
                    ->store('menus', 'public');
        }


        $menu = Menu::create($validated);

        Cache::forget('menus_all');


        return response()->json([

            'success' => true,

            'message' =>
                'Menu berhasil ditambahkan!',

            'data' =>
                $menu->load('kategori'),

        ], 201);
    }


    /**
     * Ambil satu data menu.
     */
    public function show(Menu $menu)
    {
        return response()->json([

            'success' => true,

            'data' => [

                'id' =>
                    $menu->id,

                'kategori_id' =>
                    $menu->kategori_id,

                'nama_menu' =>
                    $menu->nama_menu,

                'deskripsi' =>
                    $menu->deskripsi,

                'harga' =>
                    $menu->harga,

                'stok' =>
                    $menu->stok,

                'status' =>
                    $menu->status,

                'gambar_url' =>
                    $menu->gambar_url,

            ],

        ]);
    }


    /**
     * Update menu.
     */
    public function update(
        Request $request,
        Menu $menu
    ) {
        $validated = $request->validate([

            'kategori_id' =>
                'required|exists:kategoris,id',

            'nama_menu' =>
                'required|string|max:150',

            'deskripsi' =>
                'nullable|string',

            'harga' =>
                'required|numeric|min:0',

            'stok' =>
                'required|integer|min:0',

            'status' =>
                'required|in:Tersedia,Habis',

            'gambar' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);


        // Jika upload gambar baru
        if ($request->hasFile('gambar')) {

            if ($menu->gambar) {

                Storage::disk('public')
                    ->delete($menu->gambar);
            }

            $validated['gambar'] =
                $request->file('gambar')
                    ->store('menus', 'public');

        } else {

            unset($validated['gambar']);
        }


        $menu->update($validated);

        Cache::forget('menus_all');


        return response()->json([

            'success' => true,

            'message' =>
                'Menu berhasil diperbarui!',

            'data' =>
                $menu->fresh('kategori'),

        ]);
    }


    /**
     * Hapus menu.
     */
    public function destroy(Menu $menu)
    {
        // Hapus gambar
        if ($menu->gambar) {

            Storage::disk('public')
                ->delete($menu->gambar);
        }


        $menu->delete();

        Cache::forget('menus_all');


        return response()->json([

            'success' => true,

            'message' =>
                'Menu berhasil dihapus!',

        ]);
    }
}
