<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache role & permission Spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat permissions
        $permissions = [
            // Menu & Kategori
            'kelola menu',
            'kelola kategori',
            // Order
            'buat order',
            'lihat order',
            'update status order',
            // Laporan (untuk admin)
            'lihat laporan',
            'kelola user',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat roles dan assign permissions
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $kasir = Role::firstOrCreate(['name' => 'kasir']);
        $kasir->givePermissionTo([
            'kelola menu',
            'kelola kategori',
            'buat order',
            'lihat order',
            'update status order',
        ]);

        $pelanggan = Role::firstOrCreate(['name' => 'pelanggan']);
        $pelanggan->givePermissionTo([
            'buat order',
            'lihat order',
        ]);

        $this->command->info('✅ Roles & Permissions berhasil dibuat!');
    }
}
