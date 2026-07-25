<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{<?php<?php

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
            AdminSeeder::class,     // 3. Buat admin
            KategoriSeeder::class,  // 4. Buat kategori
            MenuSeeder::class,      // 5. Buat menu (butuh kategori)
        ]);
    }
}

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
<<<<<<< HEAD
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
=======
            RoleSeeder::class,
            UserSeeder::class,
            KategoriSeeder::class,
            MenuSeeder::class,
            AdminSeeder::class,
>>>>>>> 9886bab0c5c8dc7f6115c38e605048a4d6e53b29
        ]);
    }
}
