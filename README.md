# Sistem Booking Lapangan Futsal Online

Proyek web apps untuk manajemen pemesanan lapangan futsal. Dibangun menggunakan arsitektur Monolith (Blade) dan menyediakan RESTful API.

## 1. Spesifikasi Sistem
- **Framework:** Laravel 11.x / 10.x
- **Database:** MySQL
- **Authentication:** Laravel Breeze (Web) & Laravel Sanctum (API)
- **Styling:** Tailwind CSS

## 2. Entity Relationship Diagram (ERD) & Relasi Database
- **Users Table:** `id`, `name`, `email`, `password`, `role` (admin/user), `timestamps`.
- **Fields Table:** `id`, `name`, `price_per_hour`, `timestamps`.
- **Bookings Table:** `id`, `user_id` (Foreign Key), `field_id` (Foreign Key), `start_time`, `end_time`, `status` (pending/confirmed/cancelled), `timestamps`.
- **Aturan Relasi:**
  - `User` memiliki banyak `Booking` (One-to-Many).
  - `Field` memiliki banyak `Booking` (One-to-Many).
  - Penghapusan data `User` atau `Field` akan menghapus data `Booking` terkait (Cascade on Delete).

## 3. Flow Sistem (Alur Kerja)
1. **Registrasi & Login:** Pengguna membuat akun dan masuk ke dalam sistem.
2. **Otorisasi Role:** - Jika pengguna adalah `Admin`, sistem mengarahkan ke Admin Dashboard untuk mengelola data lapangan dan menyetujui pemesanan.
   - Jika pengguna adalah `User` (Customer), sistem mengarahkan ke User Dashboard.
3. **Proses Pemesanan:** Customer memilih lapangan, menentukan jam mulai dan jam selesai.
4. **Validasi Sistem:** Sistem secara otomatis mengecek database. Jika terdapat jadwal yang tumpang tindih (bentrok) pada lapangan dan waktu yang sama, sistem akan menolak pesanan.
5. **Konfirmasi:** Jika jadwal tersedia, pesanan masuk dengan status `pending`. Admin kemudian dapat mengubah status menjadi `confirmed` atau `cancelled`.

## 4. Dokumentasi RESTful API
Akses API membutuhkan Bearer Token yang didapatkan dari proses login.

| Endpoint | Method | Role | Keterangan |
|----------|--------|------|------------|
| `/api/login` | POST | All | Autentikasi dan generate token Sanctum. |
| `/api/fields` | GET | Auth | Menampilkan daftar seluruh lapangan futsal. |
| `/api/fields` | POST | Admin | Menambah data lapangan baru. |
| `/api/bookings` | POST | Auth | Membuat pesanan baru dengan validasi bentrok jadwal. |

## 5. Cara Menjalankan Proyek Lokal
1. Clone repositori ini: `git clone <url-repo-anda>`
2. Install library: `composer install`
3. Salin file environment: `cp .env.example .env`
4. Generate key: `php artisan key:generate`
5. Atur konfigurasi database di `.env`
6. Migrasi tabel: `php artisan migrate`
7. Jalankan server: `php artisan serve`
8. Jalankan kompilasi CSS: `npm install && npm run dev`