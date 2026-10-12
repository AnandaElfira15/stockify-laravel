# Stockify — Inventory Management System

## 1. Deskripsi Proyek

Stockify adalah aplikasi web untuk mengelola persediaan barang. Project ini dikembangkan menggunakan Laravel sebagai kelanjutan dari Inventory Management System pada Pertemuan 4.

Aplikasi ini membantu pengguna mengelola produk, kategori, supplier, pergerakan stok, laporan, dan akun pengguna.

## 2. Teknologi yang Digunakan

- PHP 8.2
- Laravel
- MySQL
- Composer
- Blade Template Engine
- Eloquent ORM
- XAMPP
- Git dan GitHub

## 3. Fitur Aplikasi

- Login dan logout.
- Hak akses Admin dan Staff.
- Dashboard informasi persediaan.
- CRUD produk dan kategori.
- Pengelolaan supplier.
- Pencatatan barang masuk dan barang keluar.
- Riwayat pergerakan stok.
- Laporan persediaan.
- Pencarian, filter, sorting, dan pagination produk.
- Validasi input formulir.
- Manajemen pengguna khusus Admin.

## 4. Arsitektur MVC

Project ini menggunakan pola MVC (Model, View, Controller).

- **Model:** Mengelola data dan interaksi dengan database melalui Eloquent ORM.
- **View:** Menampilkan antarmuka aplikasi menggunakan Blade.
- **Controller:** Memproses request, menjalankan logika aplikasi, dan menentukan response.

Alur request aplikasi:

Browser → Route → Controller → Model → Database → Response.

## 5. Persyaratan Sistem

- PHP 8.2 atau versi yang kompatibel dengan project.
- Composer.
- MySQL.
- Git.
- XAMPP atau lingkungan server PHP dan MySQL yang sesuai.

## 6. Cara Instalasi

### A. Clone repository

```bash
git clone https://github.com/AnandaElfira15/stockify-laravel.git
cd stockify-laravel
```

### B. Instal dependensi

```bash
composer install
```

### C. Siapkan file environment

Salin `.env.example` menjadi `.env`, lalu jalankan:

```bash
php artisan key:generate
```

### D. Siapkan database

Buat database kosong melalui phpMyAdmin. Nama database harus sesuai dengan `DB_DATABASE` pada file `.env`.

Contoh konfigurasi:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stockify_laravel
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan konfigurasi jika pengaturan MySQL berbeda.

### E. Jalankan migration dan seeder

Untuk database baru yang masih kosong:

```bash
php artisan migrate --seed
```

Perintah ini membuat tabel yang belum tersedia dan menjalankan seeder untuk mengisi data awal.

### F. Jalankan aplikasi

```bash
php artisan serve
```

Buka aplikasi melalui:

http://127.0.0.1:8000

## 7. Pengujian

Jalankan pengujian otomatis menggunakan:

```bash
php artisan test
```

Pada pengujian terakhir, 3 tes berhasil dengan 4 assertions. Pengujian tersebut mencakup pengalihan pengunjung yang belum login dan akses halaman login. Pengujian ini belum mencakup seluruh fitur CRUD secara otomatis.

## 8. Screenshot Aplikasi

Screenshot aplikasi disimpan di folder `Screenshot/` pada repository jika file tersebut tersedia, untuk menunjukkan tampilan dan pengujian aplikasi.

## 9. Repository

GitHub: https://github.com/AnandaElfira15/stockify-laravel

## 10. Tujuan Pengembangan

Pengembangan ini bertujuan menerapkan konsep Laravel, termasuk routing, controller, model, relasi Eloquent, migration, factory, seeder, Blade, validasi formulir, dan pengelolaan data persediaan.

Pengembangan dari Pertemuan 4 ke Pertemuan 5 dilakukan dengan mempertahankan fungsi utama sistem persediaan barang.