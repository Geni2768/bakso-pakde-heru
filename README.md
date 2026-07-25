<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 9886bab0c5c8dc7f6115c38e605048a4d6e53b29
# 🍜 Bakso Pakde Heru — Sistem Kasir & Manajemen Menu

Aplikasi web kasir untuk usaha bakso **Pakde Heru** berbasis Laravel 11.
Menggantikan sistem manual dengan sistem digital multi-role yang efisien.

---# 🍜 Bakso Pakde Heru — Sistem Kasir & Manajemen Menu

Aplikasi web kasir untuk usaha bakso **Pakde Heru** berbasis Laravel 11.
Menggantikan sistem manual dengan sistem digital multi-role yang efisien.

## Anggota Kelompok

- Maria Geni Anita Mare
- Novriadi Naibaho
- Theobaldus S. Ngaban

## Deskripsi

Aplikasi ini dibuat untuk memenuhi tugas UAS Pemrograman Web II. Sistem digunakan untuk memesan menu Bakso Pakde Heru secara online dengan tiga hak akses, yaitu Admin, Kasir, dan Pelanggan.

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
git clone <repo-url> bakso-pakde-heru
cd bakso-pakde-heru
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
DB_DATABASE=bakso_pakde_heru
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Buat Database

```sql
CREATE DATABASE bakso_pakde_heru;
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
| Admin | admin@baksopakdeheru.com | password |
| Kasir 1 | kasir1@baksopakdeheru.com | password |
| Kasir 2 | kasir2@baksopakdeheru.com | password |
| Pelanggan | budi@mail.com | password |

---

## Lisensi

Project ini dibuat untuk keperluan UAS Pemrograman Web II.

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
git clone <repo-url> bakso-pakde-heru
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
DB_DATABASE=bakso_pakde_heru
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Buat Database

```sql
CREATE DATABASE bakso_pakde_heru;
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
| Admin | admin@baksopakdeheru.com | password |
| Kasir 1 | kasir1@baksopakdeheru.com | password |
| Kasir 2 | kasir2@baksopakdeheru.com | password |
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
<<<<<<< HEAD
=======
# 🍜 Bakso Pakde Heru

Sistem Penjualan Kantin Berbasis Web menggunakan Laravel.

## Anggota Kelompok

- Maria Geni Anita Mare
- Novriadi Naibaho
- Theobaldus S. Ngaban

## Deskripsi

Aplikasi ini dibuat untuk memenuhi tugas UAS Pemrograman Web II. Sistem digunakan untuk memesan menu Bakso Pakde Heru secara online dengan dua hak akses, yaitu Admin dan Pelanggan.

## Fitur

### Admin
- Login
- Dashboard
- CRUD Kategori
- CRUD Menu
- Kelola Pesanan
- Laporan

### Pelanggan
- Register & Login
- Melihat Menu
- Keranjang
- Checkout
- Riwayat Pesanan

## Teknologi

- Laravel 13
- PHP 8.2
- MySQL / SQLite
- Bootstrap 5
- Vite

## Cara Menjalankan

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```

## Lisensi

Project ini dibuat untuk keperluan UAS Pemrograman Web II.

>>>>>>> 9d723fef31be6d43e2575f0c2ce6d2f979123178
=======
>>>>>>> 9886bab0c5c8dc7f6115c38e605048a4d6e53b29
