<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Urutan seeder PENTING — jangan diubah urutannya
     * karena ada foreign key dependency antar tabel.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,      // 1. Buat roles dulu
            UserSeeder::class,      // 2. Buat user (butuh roles)
            KategoriSeeder::class,  // 3. Buat kategori
            MenuSeeder::class,      // 4. Buat menu (butuh kategori)
        ]);
    }
}
