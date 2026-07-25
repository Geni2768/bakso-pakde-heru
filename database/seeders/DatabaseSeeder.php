<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{<?php

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

<<<<<<< HEAD
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
=======
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
>>>>>>> 9d723fef31be6d43e2575f0c2ce6d2f979123178
        ]);
    }
}
