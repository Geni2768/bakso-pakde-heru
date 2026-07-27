# 🍜 Bakso Pakde Heru

## Sistem Informasi Pemesanan, Kasir, dan Manajemen Menu Berbasis Web

Bakso Pakde Heru merupakan aplikasi web berbasis Laravel yang dikembangkan sebagai Proyek Akhir Semester (UAS). Aplikasi ini dibuat untuk membantu proses digitalisasi pengelolaan usaha kuliner, mulai dari pengelolaan menu dan kategori, pemesanan pelanggan, pengelolaan pesanan oleh kasir, hingga pengelolaan sistem oleh admin.

Sistem ini menerapkan konsep multi-role, sehingga setiap pengguna memiliki hak akses dan fitur yang berbeda sesuai dengan perannya.

## Anggota Kelompok

1. Maria Geni Anita Mare
2. Novriadi Naibahi
3. Theobaldus S. Ngaban

## Tujuan Pengembangan

Pengembangan sistem Bakso Pakde Heru bertujuan untuk:

- Membantu pelanggan melihat daftar menu yang tersedia.
- Memudahkan pelanggan melakukan pemesanan makanan dan minuman.
- Menyediakan fitur keranjang untuk mengelola pesanan sebelum checkout.
- Membantu kasir mengelola dan memperbarui status pesanan pelanggan.
- Membantu admin mengelola data pengguna dan sistem.
- Mengelola data menu dan kategori secara terstruktur.
- Menerapkan sistem autentikasi dan pembagian hak akses berdasarkan role.
- Mengurangi proses pengelolaan pesanan secara manual.
- Meningkatkan efisiensi pengelolaan usaha kuliner secara digital.

## Role dan Hak Akses Pengguna

Sistem memiliki tiga jenis role utama:

 Role dan Hak Akses 
 Admin  Mengelola sistem, pengguna, menu, kategori, dan melihat pengelolaan data secara keseluruhan. 
 Kasir  Mengelola pesanan pelanggan dan memperbarui status pesanan. 
 Pelanggan Melihat menu, mencari menu, menambahkan produk ke keranjang, melakukan checkout, dan melihat riwayat pesanan. 

## Fitur Utama Sistem

### 1. Autentikasi

Sistem menyediakan fitur:

- Login
- Register
- Logout
- Pembagian role pengguna
- Proteksi halaman berdasarkan role
- Hak akses Admin
- Hak akses Kasir
- Hak akses Pelanggan

### 2. Manajemen Menu

Fitur manajemen menu digunakan untuk mengelola daftar makanan dan minuman yang tersedia.

Fitur yang tersedia:

- Menampilkan daftar menu
- Menambahkan menu
- Mengubah menu
- Menghapus menu
- Menampilkan detail menu
- Pencarian menu
- Pengelompokan menu berdasarkan kategori
- Upload gambar menu
- Menampilkan harga menu
- Menampilkan deskripsi menu

### 3. Manajemen Kategori

Admin dan kasir dapat mengelola kategori menu.

Contoh kategori:

- Bakso
- Mie
- Minuman

Fitur:

- Menampilkan kategori
- Menambahkan kategori
- Mengubah kategori
- Menghapus kategori
- Menampilkan jumlah menu pada setiap kategori

Pengelolaan kategori menggunakan teknologi AJAX atau Fetch API, sehingga proses CRUD dapat dilakukan tanpa harus memuat ulang seluruh halaman.

### 4. Keranjang Belanja

Pelanggan dapat:

- Menambahkan menu ke keranjang.
- Melihat isi keranjang.
- Menghapus item dari keranjang.
- Melakukan checkout.
- Melihat total harga pesanan.

### 5. Pemesanan

Pelanggan dapat melakukan pemesanan melalui sistem.

Alur pemesanan:

Pelanggan
↓
Melihat Menu
↓
Memilih Menu
↓
Tambah ke Keranjang
↓
Melihat Keranjang
↓
Checkout
↓
Pesanan Dibuat
↓
Kasir Memproses Pesanan
↓
Status Pesanan Diperbarui
↓
Pesanan Selesai

### 6. Dashboard Kasir

Dashboard kasir digunakan untuk membantu kasir dalam mengelola pesanan pelanggan.

Fitur yang tersedia:

- Melihat total pesanan.
- Melihat jumlah pesanan berdasarkan status.
- Melihat data pelanggan.
- Melihat detail item pesanan.
- Melihat informasi pembayaran.
- Memperbarui status pesanan.

Status pesanan yang tersedia:

- Pending
- Diproses
- Dikirim
- Selesai
- Dibatalkan

### 7. Dashboard Admin

Dashboard admin digunakan sebagai pusat pengelolaan sistem.

Admin dapat mengelola:

- Data pengguna.
- Data menu.
- Data kategori.
- Data pesanan.
- Data sistem sesuai dengan hak akses admin.

### 8. Dashboard Pelanggan

Pelanggan memiliki dashboard yang digunakan untuk mengakses fitur pemesanan.

Pelanggan dapat:

- Melihat menu.
- Mencari menu.
- Melihat detail menu.
- Menambahkan menu ke keranjang.
- Melakukan checkout.
- Melihat pesanan yang telah dibuat.
- Melihat riwayat pesanan.

## Teknologi yang Digunakan

Aplikasi Bakso Pakde Heru dikembangkan menggunakan teknologi berikut:

- Laravel
- PHP
- MySQL
- Blade Template
- Tailwind CSS
- Bootstrap
- JavaScript
- AJAX
- Fetch API
- Spatie Laravel Permission
- Vite

## Struktur Sistem

Struktur utama aplikasi:

app
├── Http
│   └── Controllers
├── Models

database
├── migrations
├── seeders
└── factories

resources
├── views
├── css
└── js

routes
└── web.php

public
└── storage

## Database

Database digunakan untuk menyimpan data yang berkaitan dengan sistem Bakso Pakde Heru.

Data utama yang digunakan dalam sistem meliputi:

- Users
- Roles
- Permissions
- Menu
- Kategori
- Orders
- Order Items
- Payments

Relasi antar data digunakan untuk menghubungkan menu dengan kategori, pesanan dengan pelanggan, pesanan dengan detail item, serta pesanan dengan pembayaran.

## AJAX dan Fetch API

Sistem menggunakan AJAX dan Fetch API pada beberapa fitur pengelolaan data.

Implementasi AJAX digunakan untuk:

- Menampilkan data kategori.
- Menambahkan kategori.
- Mengubah kategori.
- Menghapus kategori.
- Mengambil detail kategori.
- Menampilkan data menu.
- Mengelola data tanpa melakukan reload halaman secara keseluruhan.

Penggunaan AJAX bertujuan untuk membuat sistem lebih interaktif dan meningkatkan pengalaman pengguna.

## Sistem Hak Akses

Sistem menggunakan konsep Role-Based Access Control (RBAC) untuk mengatur hak akses pengguna.

Setiap pengguna mendapatkan akses sesuai dengan role yang dimiliki.

Admin memiliki akses pengelolaan sistem secara keseluruhan.

Kasir memiliki akses untuk mengelola pesanan pelanggan dan memperbarui status pesanan.

Pelanggan memiliki akses untuk melihat menu, mengelola keranjang, melakukan checkout, dan melihat pesanan.

## Cara Menjalankan Aplikasi

Clone repository:

git clone https://github.com/Geni2768/bakso-pakde-heru.git

Masuk ke folder project:

cd bakso-pakde-heru

Install dependency Laravel:

composer install

Install dependency frontend:

npm install

Buat file environment:

cp .env.example .env

Generate application key:

php artisan key:generate

Atur konfigurasi database pada file .env.

Jalankan migration:

php artisan migrate

Jalankan seeder:

php artisan db:seed

Buat storage link:

php artisan storage:link

Build frontend:

npm run build

Jalankan aplikasi:

php artisan serve

Aplikasi dapat diakses melalui:

http://127.0.0.1:8000

## Akun Pengguna

Akun pengguna dapat digunakan sesuai dengan data yang tersedia pada database atau hasil proses seeding.

Role yang tersedia:

Admin

Kasir

Pelanggan

## Tujuan Akhir Sistem

Dengan adanya aplikasi Bakso Pakde Heru, proses pengelolaan usaha kuliner dapat dilakukan secara lebih terstruktur dan digital.

Pelanggan dapat melakukan pemesanan dengan lebih mudah, kasir dapat mengelola pesanan secara terorganisir, dan admin dapat mengelola data sistem melalui satu aplikasi.

Aplikasi ini dikembangkan sebagai Proyek Akhir Semester (UAS) dengan menerapkan konsep Laravel, database, autentikasi, multi-role, CRUD, AJAX, dan pengelolaan transaksi pemesanan.
