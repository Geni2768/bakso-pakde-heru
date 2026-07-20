<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // --- Admin ---
        $admin = User::firstOrCreate(
            ['email' => 'admin@baksopakheru.com'],
            [
                'name'     => 'Admin Bakso Pak Heru',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('admin');

        // --- Kasir (2 akun) ---
        $kasir1 = User::firstOrCreate(
            ['email' => 'kasir1@baksopakheru.com'],
            [
                'name'     => 'Kasir Satu',
                'password' => Hash::make('password'),
            ]
        );
        $kasir1->assignRole('kasir');

        $kasir2 = User::firstOrCreate(
            ['email' => 'kasir2@baksopakheru.com'],
            [
                'name'     => 'Kasir Dua',
                'password' => Hash::make('password'),
            ]
        );
        $kasir2->assignRole('kasir');

        // --- Pelanggan dummy (5 akun pakai Faker) ---
        $pelangganList = [
            ['name' => 'Budi Santoso',   'email' => 'budi@mail.com'],
            ['name' => 'Siti Rahayu',    'email' => 'siti@mail.com'],
            ['name' => 'Ahmad Fauzi',    'email' => 'ahmad@mail.com'],
            ['name' => 'Dewi Lestari',   'email' => 'dewi@mail.com'],
            ['name' => 'Reza Pratama',   'email' => 'reza@mail.com'],
        ];

        foreach ($pelangganList as $data) {
            $pelanggan = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'     => $data['name'],
                    'password' => Hash::make('password'),
                ]
            );
            $pelanggan->assignRole('pelanggan');
        }

        $this->command->info('✅ Users berhasil dibuat!');
        $this->command->table(
            ['Role', 'Email', 'Password'],
            [
                ['Admin',     'admin@baksopakheru.com',  'password'],
                ['Kasir',     'kasir1@baksopakheru.com', 'password'],
                ['Kasir',     'kasir2@baksopakheru.com', 'password'],
                ['Pelanggan', 'budi@mail.com',           'password'],
            ]
        );
    }
}
