# Bakso Pakde Heru

## Sistem Informasi Pemesanan, Kasir, dan Manajemen Menu Berbasis Web

Bakso Pakde Heru adalah aplikasi web berbasis Laravel yang dikembangkan sebagai Proyek Akhir Semester (UAS). Sistem ini dibuat untuk membantu digitalisasi proses usaha kuliner, mulai dari pengelolaan menu dan kategori, pemesanan pelanggan, hingga pengelolaan pesanan oleh kasir dan admin.

## Anggota Kelompok

1. Maria Geni Anita Mare
2. Novriadi Naibahi
3. Theobaldus S. Ngaban

## Tujuan

Aplikasi ini bertujuan untuk:

- Memudahkan pelanggan melihat dan mencari menu.
- Memudahkan pelanggan melakukan pemesanan.
- Menyediakan fitur keranjang dan checkout.
- Membantu kasir mengelola pesanan pelanggan.
- Membantu admin mengelola data sistem.
- Menerapkan autentikasi dan hak akses berdasarkan role.

## Role Pengguna

### Admin
- Mengelola sistem.
- Mengelola pengguna.
- Mengelola menu dan kategori.
- Mengakses fitur administrasi sistem.

### Kasir
- Melihat pesanan pelanggan.
- Mengelola pesanan.
- Memperbarui status pesanan.

### Pelanggan
- Melihat menu.
- Mencari menu.
- Menambahkan menu ke keranjang.
- Melakukan checkout.
- Melihat pesanan dan status pesanan.

## Fitur Utama

### Autentikasi
- Login
- Register
- Logout
- Multi-role
- Proteksi akses berdasarkan role

### Manajemen Menu
- Menampilkan menu
- Menambahkan menu
- Mengedit menu
- Menghapus menu
- Melihat detail menu
- Pencarian menu
- Kategori menu
- Upload gambar menu

### Manajemen Kategori
- Menampilkan kategori
- Menambahkan kategori
- Mengedit kategori
- Menghapus kategori
- Menampilkan jumlah menu berdasarkan kategori
- CRUD menggunakan AJAX / Fetch API

### Pemesanan Pelanggan
- Melihat menu
- Menambahkan menu ke keranjang
- Melihat keranjang
- Menghapus item keranjang
- Checkout
- Melihat riwayat pesanan

### Dashboard Kasir
- Melihat daftar pesanan pelanggan
- Melihat detail pesanan
- Melihat informasi pembayaran
- Memperbarui status pesanan

Status pesanan yang tersedia:

- Pending
- Diproses
- Dikirim
- Selesai
- Dibatalkan

## Alur Sistem

Pelanggan
→ Melihat Menu
→ Memilih Menu
→ Menambahkan ke Keranjang
→ Checkout
→ Pesanan Dibuat
→ Kasir Memproses Pesanan
→ Status Pesanan Diperbarui
→ Pesanan Selesai

## Teknologi yang Digunakan

- Laravel
- PHP
- MySQL / SQLite
- Blade Template
- Tailwind CSS
- JavaScript
- AJAX / Fetch API
- Spatie Laravel Permission
- Vite


## Struktur Sistem

- `app/` - Model, Controller, dan komponen aplikasi
- `database/` - Migration, Seeder, dan Factory
- `resources/views/` - Tampilan halaman aplikasi
- `routes/web.php` - Routing aplikasi
- `public/` - Asset publik
- `storage/` - Penyimpanan file dan gambar

## Hak Cipta

© 2026 Maria Geni Anita Mare, Novriadi Naibahi, dan Theobaldus S. Ngaban.  
Semua hak cipta dilindungi.

Project ini dibuat untuk keperluan akademik sebagai Proyek Akhir Semester (UAS).
