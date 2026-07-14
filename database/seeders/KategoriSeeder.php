<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'Bakso',    'deskripsi' => 'Berbagai pilihan bakso segar dan lezat'],
            ['nama_kategori' => 'Mie',      'deskripsi' => 'Mie dengan berbagai topping pilihan'],
            ['nama_kategori' => 'Minuman',  'deskripsi' => 'Minuman segar pelengkap makan'],
            ['nama_kategori' => 'Gorengan', 'deskripsi' => 'Gorengan renyah sebagai pelengkap'],
            ['nama_kategori' => 'Tambahan', 'deskripsi' => 'Topping dan tambahan ekstra'],
        ];

        foreach ($kategoris as $data) {
            Kategori::firstOrCreate(
                ['nama_kategori' => $data['nama_kategori']],
                ['deskripsi' => $data['deskripsi']]
            );
        }

        $this->command->info('✅ Kategori berhasil dibuat! (5 kategori)');
    }
}
