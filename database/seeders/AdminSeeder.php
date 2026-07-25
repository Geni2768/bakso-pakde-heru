<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@bakso.com'
            ],
            [
                'name' => 'Administrator',
                'email' => 'admin@bakso.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'no_hp' => '081234567890',
            ]
        );
    }
}
