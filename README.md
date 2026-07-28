# 🍜 Bakso Pakde Heru

## Sistem Informasi Pemesanan, Kasir, dan Manajemen Menu Berbasis Web

Bakso Pakde Heru adalah aplikasi web berbasis Laravel yang dikembangkan sebagai Proyek Akhir Semester (UAS) mata kuliah Pemrograman Web II.

Sistem ini dirancang untuk membantu pelanggan melihat menu, mencari makanan, menambahkan menu ke keranjang, melakukan checkout, dan melihat riwayat pesanan. Aplikasi juga menyediakan halaman khusus untuk Admin dan Kasir agar proses pengelolaan menu, kategori, pembayaran, dan pesanan dapat dilakukan dengan lebih mudah.

Aplikasi menerapkan sistem autentikasi dan otorisasi berdasarkan role menggunakan Laravel Middleware. Setiap pengguna memiliki hak akses yang berbeda sesuai dengan perannya.


## 👥 Anggota Kelompok

1. Maria Geni Anita Mare
2. Novriadi Naibahi
3. Theobaldus S. Ngaban


## 🎯 Tujuan

Aplikasi ini bertujuan untuk:

- Memudahkan pelanggan melihat dan mencari menu.
- Memudahkan pelanggan melakukan pemesanan makanan.
- Menyediakan fitur keranjang dan checkout.
- Membantu kasir mengelola pesanan pelanggan.
- Membantu admin mengelola menu dan kategori.
- Menerapkan autentikasi dan hak akses berdasarkan role.
- Menerapkan konsep Laravel dalam pengembangan aplikasi web.



## 👤 Role Pengguna

Aplikasi memiliki tiga jenis pengguna:

### 1. Admin

Admin memiliki akses untuk:

- Melihat Dashboard Admin.
- Melihat jumlah menu, kategori, dan pesanan.
- Menambah, melihat, mengubah, dan menghapus menu.
- Menambah dan menghapus kategori.
- Melihat seluruh pesanan pelanggan.
- Mengubah status pesanan.

### 2. Kasir

Kasir memiliki akses untuk:

- Melihat Dashboard Kasir.
- Melihat data pesanan.
- Mengelola dan memperbarui status pesanan.

### 3. Pelanggan

Pelanggan memiliki akses untuk:

- Registrasi akun.
- Login dan logout.
- Melihat daftar menu.
- Mencari menu secara otomatis.
- Menambahkan menu ke keranjang.
- Mengubah jumlah menu pada keranjang.
- Menghapus menu dari keranjang.
- Melakukan checkout.
- Memilih metode pembayaran.
- Melihat riwayat pesanan.

## 🔐 Autentikasi dan Otorisasi

Aplikasi menggunakan Laravel Authentication untuk proses:

- Registrasi.
- Login.
- Logout.
- Pengelolaan session pengguna.

Pembatasan hak akses dilakukan di sisi server menggunakan Laravel Middleware.

Role yang digunakan:

```text
admin
kasir
pelanggan

## Hak Cipta

© 2026 Maria Geni Anita Mare, Novriadi Naibahi, dan Theobaldus S. Ngaban.  
Semua hak cipta dilindungi.

Project ini dibuat untuk keperluan akademik sebagai Proyek Akhir Semester (UAS).
