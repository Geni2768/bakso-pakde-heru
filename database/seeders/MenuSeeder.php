<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Data menu realistis sesuai kategori
        $menuData = [
            'Bakso' => [
                ['nama_menu' => 'Bakso Urat',       'harga' => 15000, 'stok' => 50, 'deskripsi' => 'Bakso dengan urat sapi pilihan, kenyal dan gurih'],
                ['nama_menu' => 'Bakso Telur',      'harga' => 18000, 'stok' => 40, 'deskripsi' => 'Bakso berisi telur ayam kampung di dalamnya'],
                ['nama_menu' => 'Bakso Keju',       'harga' => 20000, 'stok' => 30, 'deskripsi' => 'Bakso isi keju mozzarella yang meleleh'],
                ['nama_menu' => 'Bakso Mercon',     'harga' => 17000, 'stok' => 35, 'deskripsi' => 'Bakso super pedas level tinggi, berani coba?'],
                ['nama_menu' => 'Bakso Gepeng',     'harga' => 15000, 'stok' => 45, 'deskripsi' => 'Bakso tipis dan lebar dengan tekstur kenyal'],
                ['nama_menu' => 'Bakso Jumbo',      'harga' => 25000, 'stok' => 20, 'deskripsi' => 'Bakso berukuran besar dengan isian daging melimpah'],
            ],
            'Mie' => [
                ['nama_menu' => 'Mie Ayam',         'harga' => 12000, 'stok' => 30, 'deskripsi' => 'Mie lembut dengan topping ayam cincang berbumbu'],
                ['nama_menu' => 'Mie Ayam Bakso',   'harga' => 15000, 'stok' => 30, 'deskripsi' => 'Kombinasi mie ayam dan bakso pilihan'],
                ['nama_menu' => 'Mie Goreng',       'harga' => 13000, 'stok' => 25, 'deskripsi' => 'Mie goreng kering dengan bumbu spesial Pak Heru'],
                ['nama_menu' => 'Kwetiau Bakso',    'harga' => 14000, 'stok' => 20, 'deskripsi' => 'Kwetiau lebar dengan kuah bakso yang kaya rasa'],
            ],
            'Minuman' => [
                ['nama_menu' => 'Es Teh Manis',     'harga' => 5000,  'stok' => 100, 'deskripsi' => 'Teh manis segar dengan es batu'],
                ['nama_menu' => 'Es Jeruk',         'harga' => 6000,  'stok' => 80,  'deskripsi' => 'Jeruk peras segar dengan es batu'],
                ['nama_menu' => 'Air Mineral',      'harga' => 4000,  'stok' => 50,  'deskripsi' => 'Air mineral botol 600ml'],
                ['nama_menu' => 'Es Teh Tawar',     'harga' => 4000,  'stok' => 100, 'deskripsi' => 'Teh tawar dingin menyegarkan'],
                ['nama_menu' => 'Jus Alpukat',      'harga' => 12000, 'stok' => 20,  'deskripsi' => 'Jus alpukat segar dengan susu coklat'],
            ],
            'Gorengan' => [
                ['nama_menu' => 'Tahu Goreng',      'harga' => 2000, 'stok' => 50, 'deskripsi' => 'Tahu kuning goreng crispy'],
                ['nama_menu' => 'Tempe Goreng',     'harga' => 2000, 'stok' => 50, 'deskripsi' => 'Tempe tipis goreng renyah'],
                ['nama_menu' => 'Bakwan',           'harga' => 2000, 'stok' => 40, 'deskripsi' => 'Bakwan sayur gurih dan renyah'],
            ],
            'Tambahan' => [
                ['nama_menu' => 'Pangsit Rebus',    'harga' => 5000, 'stok' => 40, 'deskripsi' => 'Pangsit isi daging rebus dalam kuah'],
                ['nama_menu' => 'Ceker Ayam',       'harga' => 8000, 'stok' => 25, 'deskripsi' => 'Ceker ayam empuk berbumbu'],
                ['nama_menu' => 'Kerupuk',          'harga' => 2000, 'stok' => 60, 'deskripsi' => 'Kerupuk udang renyah pelengkap'],
            ],
        ];

        foreach ($menuData as $namaKategori => $menus) {
            $kategori = Kategori::where('nama_kategori', $namaKategori)->first();

            if (!$kategori) continue;

            foreach ($menus as $data) {
                Menu::firstOrCreate(
                    [
                        'nama_menu'   => $data['nama_menu'],
                        'kategori_id' => $kategori->id,
                    ],
                    [
                        'deskripsi' => $data['deskripsi'],
                        'harga'     => $data['harga'],
                        'stok'      => $data['stok'],
                        'gambar'    => null,
                        'status'    => 'Tersedia',
                    ]
                );
            }
        }

        $total = Menu::count();
        $this->command->info("✅ Menu berhasil dibuat! (Total: {$total} menu)");
    }
}
