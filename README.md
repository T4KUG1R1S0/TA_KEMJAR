#KELOMPOK TRASH GANG
- MAHABAYUBADRA ARDAYANTA - 152024001
- NUR HAYYU FADILLAH - 152024040
# MediSecure

Sistem Rekam Medis berbasis PHP dan MySQL untuk manajemen pasien, dokter, dan rekam medis.

## Ringkasan

MediSecure adalah aplikasi rekam medis sederhana dengan akses pengguna berperan:
- `admin`: mengelola dokter, pasien, dan melihat statistik.
- `dokter`: melihat data pasien, menambahkan dan melihat rekam medis.
- `pasien`: melihat rekam medis sendiri dan mengunggah hasil laboratorium.

## Fitur utama

- Halaman utama dengan tombol `Login` dan `Register`.
- Registrasi akun pasien baru.
- Login dengan perlindungan CSRF dan batas percobaan login.
- Role-based access control untuk `admin`, `dokter`, dan `pasien`.
- Admin dapat menambah dan menghapus dokter/pasien.
- Dokter dapat membuat dan melihat rekam medis pasien.
- Pasien dapat melihat rekam medis dan mengunggah file hasil lab (PDF/JPG/JPEG/PNG <= 5MB).
- Catatan aktivitas tersimpan di tabel `activity_log`.

## Persyaratan

- PHP 8+
- MySQL / MariaDB
- Web server (Laragon, XAMPP, WAMP, atau serupa)
- Browser modern

## Instalasi

1. Salin atau letakkan folder proyek ke direktori web server Anda.
   - Contoh Laragon: `C:\laragon\www\TA_KEMJAR`

2. Sesuaikan koneksi database di `config/koneksi.php` jika diperlukan:
   ```php
   $conn = mysqli_connect(
       "localhost",
       "root",
       "",
       "medisecure"
   );
   ```

3. Buat database dan import struktur:
   - Menggunakan phpMyAdmin atau MySQL CLI.
   - Jika menggunakan CLI:
     ```bash
     mysql -u root -p < database/database.sql
     ```

4. Pastikan folder `uploads/lab/` ada dan dapat ditulis oleh PHP.
   - Jika belum ada, buat folder manual.

5. Buka aplikasi di browser:
   - `http://localhost/TA_KEMJAR/`

## Penggunaan

1. Buka halaman utama.
2. Daftar sebagai pasien baru atau login jika sudah punya akun.
3. Setelah login:
   - `admin` akan diarahkan ke `admin/dashboard.php`.
   - `dokter` akan diarahkan ke `dokter/dashboard.php`.
   - `pasien` akan diarahkan ke `pasien/dashboard.php`.

### Akses khusus

- `admin`:
  - Kelola dokter (`admin/dokter.php`)
  - Kelola pasien (`admin/pasien.php`)
- `dokter`:
  - Lihat daftar pasien (`dokter/data_pasien.php`)
  - Kelola rekam medis (`dokter/rekam_medis.php`)
- `pasien`:
  - Lihat rekam medis sendiri (`pasien/rekam_medis.php`)
  - Upload hasil lab (`pasien/upload.php`)

## Struktur folder

- `admin/` — halaman dashboard dan manajemen dokter/pasien untuk admin.
- `auth/` — login, register, logout.
- `config/` — konfigurasi koneksi database.
- `database/` — skrip SQL untuk membuat struktur database.
- `dokter/` — halaman untuk pengguna role dokter.
- `middleware/` — middleware otentikasi.
- `pasien/` — halaman untuk pengguna role pasien.
- `assets/` — stylesheet dan resource frontend.
- `uploads/lab/` — tempat penyimpanan file hasil lab pasien.

## Catatan penting

- Password dokter default saat dibuat admin adalah `dokter123`.
- Sistem menggunakan hashing password `password_hash()`.
- Pastikan session PHP aktif pada lingkungan Anda.

## Pengembangan

- Gunakan `assets/css/style.css` untuk mengubah tampilan.
- Tambahkan validasi dan fitur keamanan tambahan jika diperlukan.

---

© 2026 MediSecure
