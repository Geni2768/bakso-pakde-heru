<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    protected $model = Menu::class;

    /**
     * Data menu realistis berdasarkan kategori bakso.
     */
    private array $menuData = [
        'Bakso' => [
            ['nama' => 'Bakso Urat',       'harga' => 15000],
            ['nama' => 'Bakso Telur',      'harga' => 18000],
            ['nama' => 'Bakso Keju',       'harga' => 20000],
            ['nama' => 'Bakso Mercon',     'harga' => 17000],
            ['nama' => 'Bakso Gepeng',     'harga' => 15000],
            ['nama' => 'Bakso Jumbo',      'harga' => 25000],
        ],
        'Mie' => [
            ['nama' => 'Mie Ayam',         'harga' => 12000],
            ['nama' => 'Mie Ayam Bakso',   'harga' => 15000],
            ['nama' => 'Mie Goreng',       'harga' => 13000],
            ['nama' => 'Kwetiau Bakso',    'harga' => 14000],
        ],
        'Minuman' => [
            ['nama' => 'Es Teh',           'harga' => 5000],
            ['nama' => 'Es Jeruk',         'harga' => 6000],
            ['nama' => 'Air Mineral',      'harga' => 4000],
            ['nama' => 'Es Teh Manis',     'harga' => 5000],
            ['nama' => 'Jus Alpukat',      'harga' => 12000],
        ],
        'Gorengan' => [
            ['nama' => 'Tahu Goreng',      'harga' => 2000],
            ['nama' => 'Tempe Goreng',     'harga' => 2000],
            ['nama' => 'Bakwan',           'harga' => 2000],
        ],
        'Tambahan' => [
            ['nama' => 'Pangsit Rebus',    'harga' => 5000],
            ['nama' => 'Ceker Ayam',       'harga' => 8000],
            ['nama' => 'Kerupuk',          'harga' => 2000],
        ],
    ];

    public function definition(): array
    {
        // Ambil kategori yang sudah ada di database
        $kategori = Kategori::inRandomOrder()->first();
        $namaKategori = $kategori?->nama_kategori ?? 'Bakso';

        // Pilih menu sesuai kategori, atau fallback ke Bakso
        $pilihanMenu = $this->menuData[$namaKategori] ?? $this->menuData['Bakso'];
        $menu = $this->faker->randomElement($pilihanMenu);

        return [
            'kategori_id' => $kategori?->id ?? 1,
            'nama_menu'   => $menu['nama'],
            'deskripsi'   => $this->faker->sentence(8),
            'harga'       => $menu['harga'],
            'stok'        => $this->faker->numberBetween(10, 100),
            'gambar'      => null,
            'status'      => $this->faker->randomElement(['Tersedia', 'Tersedia', 'Tersedia', 'Habis']),
            // Peluang Tersedia lebih tinggi (3:1)
        ];
    }
}
