# 🍜 Bakso Pakde Heru

Sistem Penjualan Kantin Berbasis Web menggunakan Laravel.

## Anggota Kelompok

- Maria Geni Anita Mare
- Riadi Naibaho
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

