# 🍜 Bakso Pak Heru — Sistem Kasir & Manajemen Menu

Aplikasi web kasir untuk usaha bakso **Pak Heru** berbasis Laravel 11.
Menggantikan sistem manual dengan sistem digital multi-role yang efisien.

---

## 👥 Role Pengguna

| Role | Akses |
|------|-------|
| **Admin** | Semua fitur + kelola user + laporan |
| **Kasir** | Kelola menu, kategori, dan transaksi |
| **Pelanggan** | Lihat menu dan riwayat pesanan |

---

## ⚙️ Tech Stack

- **Framework**: Laravel 11
- **Auth**: Laravel Breeze (Blade + Alpine.js)
- **RBAC**: Spatie Laravel Permission
- **Database**: MySQL
- **Frontend**: Blade + Tailwind CSS + AJAX (Fetch API)

---

## 🚀 Instalasi

### 1. Clone & Install

```bash
git clone <repo-url> bakso-pak-heru
cd bakso-pak-heru
composer install
npm install && npm run build
```

### 2. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:
```env
DB_DATABASE=bakso_pak_heru
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Buat Database

```sql
CREATE DATABASE bakso_pak_heru;
```

### 4. Jalankan Migration & Seeder

```bash
php artisan migrate
php artisan db:seed
```

### 5. Link Storage (untuk gambar menu)

```bash
php artisan storage:link
```

### 6. Jalankan Server

```bash
php artisan serve
```

Akses: `http://localhost:8000`

---

## 🔑 Akun Default (Setelah Seeder)

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@baksopakheru.com | password |
| Kasir 1 | kasir1@baksopakheru.com | password |
| Kasir 2 | kasir2@baksopakheru.com | password |
| Pelanggan | budi@mail.com | password |

---

## 📁 Struktur File Utama

```
app/
├── Http/Controllers/
│   ├── KategoriController.php   ← CRUD Kategori (AJAX)
│   └── MenuController.php       ← CRUD Menu + Upload Gambar (AJAX)
├── Models/
│   ├── Kategori.php             ← Relasi hasMany Menu
│   ├── Menu.php                 ← Eager loading $with=['kategori']
│   ├── Order.php
│   ├── OrderItem.php
│   └── Payment.php

database/
├── migrations/
│   ├── ..._create_kategoris_table.php
│   ├── ..._create_menus_table.php
│   ├── ..._create_orders_table.php
│   ├── ..._create_order_items_table.php
│   └── ..._create_payments_table.php
├── seeders/
│   ├── DatabaseSeeder.php
│   ├── RoleSeeder.php
│   ├── UserSeeder.php
│   ├── KategoriSeeder.php
│   └── MenuSeeder.php
└── factories/
    ├── KategoriFactory.php
    └── MenuFactory.php

resources/views/
├── kategori/index.blade.php    ← CRUD Kategori (AJAX + Modal)
└── menu/index.blade.php        ← CRUD Menu (AJAX + Modal + Upload)

routes/web.php                  ← Routes dengan middleware role
```

---

## 🔒 Middleware & Akses Kontrol

Route CRUD menu dan kategori dilindungi middleware Spatie:

```php
Route::middleware(['role:kasir|admin'])->group(function () {
    // Hanya kasir dan admin yang bisa akses
});
```

---

## 📊 Fitur Teknis

| Fitur | Implementasi |
|-------|-------------|
| **Eager Loading** | `$with = ['kategori']` di Model Menu — cegah N+1 |
| **Caching** | `Cache::remember()` 5 menit untuk data kategori |
| **AJAX** | Fetch API — semua CRUD tanpa reload halaman |
| **Upload Gambar** | Storage Laravel (`storage/app/public/menus`) |
| **Validasi** | Laravel FormRequest + tampil error inline |
| **RBAC** | Spatie Permission dengan roles & permissions |

---

## 🤝 Pembagian Tim

| Anggota | Tugas |
|---------|-------|
| **[Nama Lo]** | Migration, Seeder, CRUD Menu & Kategori, Eager Loading |
| **[Anggota 2]** | Auth multi-role, Middleware, Dashboard Admin |
| **[Anggota 3]** | Fitur Kasir, Transaksi, Laporan, UI Pelanggan |
