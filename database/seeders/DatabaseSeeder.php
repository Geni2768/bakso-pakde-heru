<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Menu;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        User::updateOrCreate(
            [
                'email' => 'admin@gmail.com',
            ],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | KATEGORI
        |--------------------------------------------------------------------------
        */

        $kategoriBakso = Kategori::firstOrCreate(
            [
                'nama_kategori' => 'Bakso',
            ]
        );

        $kategoriMie = Kategori::firstOrCreate(
            [
                'nama_kategori' => 'Mie',
            ]
        );

        $kategoriMinuman = Kategori::firstOrCreate(
            [
                'nama_kategori' => 'Minuman',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | MENU
        |--------------------------------------------------------------------------
        */

        Menu::updateOrCreate(
            [
                'nama_menu' => 'Bakso Urat',
            ],
            [
                'kategori_id' => $kategoriBakso->id,
                'deskripsi' => 'Bakso urat lezat dengan kuah gurih khas Bakso Pakde Heru.',
                'harga' => 15000,
                'stok' => 20,
                'status' => 'Tersedia',
            ]
        );


        Menu::updateOrCreate(
            [
                'nama_menu' => 'Bakso Biasa',
            ],
            [
                'kategori_id' => $kategoriBakso->id,
                'deskripsi' => 'Bakso sapi lembut dengan kuah kaldu gurih dan nikmat.',
                'harga' => 12000,
                'stok' => 20,
                'status' => 'Tersedia',
            ]
        );


        Menu::updateOrCreate(
            [
                'nama_menu' => 'Bakso Komplit',
            ],
            [
                'kategori_id' => $kategoriBakso->id,
                'deskripsi' => 'Bakso komplit dengan mie, tahu, dan pelengkap lainnya.',
                'harga' => 18000,
                'stok' => 15,
                'status' => 'Tersedia',
            ]
        );


        Menu::updateOrCreate(
            [
                'nama_menu' => 'Mie Ayam',
            ],
            [
                'kategori_id' => $kategoriMie->id,
                'deskripsi' => 'Mie ayam dengan topping ayam gurih dan lezat.',
                'harga' => 13000,
                'stok' => 15,
                'status' => 'Tersedia',
            ]
        );


        Menu::updateOrCreate(
            [
                'nama_menu' => 'Mie Ayam Bakso',
            ],
            [
                'kategori_id' => $kategoriMie->id,
                'deskripsi' => 'Perpaduan mie ayam lezat dengan bakso pilihan.',
                'harga' => 17000,
                'stok' => 15,
                'status' => 'Tersedia',
            ]
        );


        Menu::updateOrCreate(
            [
                'nama_menu' => 'Es Teh',
            ],
            [
                'kategori_id' => $kategoriMinuman->id,
                'deskripsi' => 'Es teh manis segar untuk menemani makanan kamu.',
                'harga' => 5000,
                'stok' => 30,
                'status' => 'Tersedia',
            ]
        );


        Menu::updateOrCreate(
            [
                'nama_menu' => 'Es Jeruk',
            ],
            [
                'kategori_id' => $kategoriMinuman->id,
                'deskripsi' => 'Minuman jeruk segar dan menyegarkan.',
                'harga' => 7000,
                'stok' => 30,
                'status' => 'Tersedia',
            ]
        );


        Menu::updateOrCreate(
            [
                'nama_menu' => 'Air Mineral',
            ],
            [
                'kategori_id' => $kategoriMinuman->id,
                'deskripsi' => 'Air mineral dingin.',
                'harga' => 4000,
                'stok' => 30,
                'status' => 'Tersedia',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | SELESAI
        |--------------------------------------------------------------------------
        */

        $this->command->info('Data admin, kategori, dan menu berhasil dibuat!');
    }
}
