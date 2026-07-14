<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriFactory extends Factory
{
    protected $model = Kategori::class;

    public function definition(): array
    {
        // Kategori spesifik bakso — lebih realistis daripada faker random
        $kategoriList = [
            ['nama' => 'Bakso',    'deskripsi' => 'Berbagai pilihan bakso segar dan lezat'],
            ['nama' => 'Mie',      'deskripsi' => 'Mie dengan berbagai topping pilihan'],
            ['nama' => 'Minuman',  'deskripsi' => 'Minuman segar pelengkap makan'],
            ['nama' => 'Gorengan', 'deskripsi' => 'Gorengan renyah sebagai pelengkap'],
            ['nama' => 'Tambahan', 'deskripsi' => 'Topping dan tambahan ekstra'],
        ];

        $item = $this->faker->unique()->randomElement($kategoriList);

        return [
            'nama_kategori' => $item['nama'],
            'deskripsi'     => $item['deskripsi'],
        ];
    }
}
