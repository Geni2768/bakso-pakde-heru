<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('kategori')
            ->latest()
            ->get();

        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('menu-admin.index', compact('menus', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('menu-admin.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_menu' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:Tersedia,Habis',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request
                ->file('gambar')
                ->store('menus', 'public');
        }

        Menu::create($validated);

        return redirect()
            ->route('menu-admin.index')
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('menu-admin.edit', compact(
            'menu',
            'kategoris'
        ));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_menu' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:Tersedia,Habis',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {

            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }

            $validated['gambar'] = $request
                ->file('gambar')
                ->store('menus', 'public');
        }

        $menu->update($validated);

        return redirect()
            ->route('menu-admin.index')
            ->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }

        $menu->delete();

        return redirect()
            ->route('menu-admin.index')
            ->with('success', 'Menu berhasil dihapus.');
    }
}
