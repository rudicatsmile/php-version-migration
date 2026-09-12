# Simbada BMD — Migrasi PHP 5.6 ke PHP 8.4

Repository ini berisi kode sumber aplikasi **Simbada BMD** yang telah berhasil dimigrasikan secara menyeluruh dari lingkungan **PHP 5.6** ke **PHP 8.4** modern, dilengkapi dengan **MySQL Compatibility Adapter**, arsitektur **PSR-4 Autoloading**, modul modern berstandar PHP 8, serta sistem **Pencatatan Error Log Terpusat**.

---

## 🚀 Ringkasan Migrasi

Proses migrasi dilakukan dalam 6 tahap terstruktur dengan memindai dan merekayasa lebih dari 2.000 file PHP aktif:

| Aspek / Masalah Legacy | Penanganan di PHP 8.4 | Status |
|---|---|:---:|
| **13.836 panggilan `mysql_*`** | Ditangani transparan via [`mysql_adapter.php`](./mysql_adapter.php) berbasis PDO `utf8mb4` | ✅ Selesai |
| **12.473 short open tags `<?`** | Dikonversi otomatis menjadi `<?php` standar | ✅ Selesai |
| **Fungsi PHP `split()`** | Dikonversi menjadi `explode()` (mempertahankan JS `.split()`) | ✅ Selesai |
| **Fungsi `each()` pada PDF** | Dikonversi menjadi loop `foreach` modern | ✅ Selesai |
| **Sintaks kurung array `$arr{0}`** | Dikonversi menjadi `$arr[0]` | ✅ Selesai |
| **Autoloading & Namespace** | Standar PSR-4 namespace `App\` via [`autoload.php`](./autoload.php) dan Composer | ✅ Selesai |
| **Error Logging Terpusat** | Terintegrasi PHP error, exception, shutdown, dan DB failure via [`src/Logging/Logger.php`](./src/Logging/Logger.php) | ✅ Selesai |

---

## 🛠️ Arsitektur & Komponen Kunci

1. **[`bootstrap.php`](./bootstrap.php)**
   - Entry point global yang memuat autoloader, inisialisasi logger terpusat, penentuan mode lingkungan (`APP_ENV`), dan registrasi database adapter.
2. **[`mysql_adapter.php`](./mysql_adapter.php)**
   - Polyfill tingkat engine yang mengemulasikan seluruh fungsi ekstensi legacy `ext/mysql` menggunakan PDO modern. Mendukung pencegatan query SQL error dan kompatibel penuh dengan skrip prosedural lama.
3. **[`src/`](./src/) — Modul Modern (PHP 8.4)**
   - `App\Logging\Logger`: Logging engine otomatis dengan rotasi harian dan proteksi produksi.
   - `App\Dev\DevBar`: Developer Mode File Inspector yang menampilkan nama file, path lengkap, dan included files di setiap frame secara dinamis.
   - `App\Database\Database`: Database service PDO murni dengan *prepared statements* dan *strict types*.
   - `App\Security\PasswordHasher`: Pengamanan autentikasi dengan `password_hash()` BCRYPT dan fallback backwards-compatible.
   - `App\Models\User`: Model DTO modern dengan Constructor Property Promotion dan `readonly`.
4. **[`admin/Log_Viewer.php`](./admin/Log_Viewer.php)**
   - Dashboard web interaktif di panel Admin untuk memantau, memfilter, mencari, dan mengunduh error log harian.
5. **[`logs/`](./logs/)**
   - Folder penyimpanan log harian (`app-YYYY-MM-DD.log`) yang diamankan dengan `.htaccess` dan `web.config` agar tidak dapat diakses langsung oleh publik.
6. **[`scripts/view_log.php`](./scripts/view_log.php)**
   - Alat bantu CLI untuk membaca dan memantau log error langsung dari terminal.

---

## ⚙️ Persyaratan Sistem

- **PHP Version**: PHP 8.2, PHP 8.3, atau PHP 8.4
- **Ekstensi PHP**: `pdo`, `pdo_mysql`, `mbstring`, `json`, `gd` (opsional untuk gambar/grafik)
- **Database**: MySQL 5.7+ / MariaDB 10.3+
- **Web Server**: Apache 2.4+ / Nginx 1.18+ / IIS

---

## 💻 Panduan Menjalankan Aplikasi

### 1. Konfigurasi Database
Sesuaikan parameter koneksi database pada [`connfile.php`](./connfile.php):
```php
define('HostnameSB', 'localhost');
define('DatabaseSB', 'simbada_barsel_data_2025');
define('UsernameSB', 'root');
define('PasswordSB', 'password_anda');
define('Port', '3306');
```

### 2. Menjalankan Web Server
Arahkan *Document Root* web server (Apache/Nginx) ke direktori root repository ini.

### 3. Mengatur Mode Lingkungan (Environment)
Atur mode lingkungan di [`bootstrap.php`](./bootstrap.php):
```php
// Mode pengembangan (menampilkan detail stack trace):
define('APP_ENV', 'development');

// Mode produksi (menyembunyikan detail teknis, menampilkan Reference ID aman):
define('APP_ENV', 'production');
```

### 4. Memantau Error Log via Terminal
```bash
# Melihat 50 baris log terakhir hari ini
php scripts/view_log.php

# Melihat 100 baris log terakhir
php scripts/view_log.php 100

# Melihat log tanggal tertentu
php scripts/view_log.php 50 2026-09-12
```

---

## 📚 Dokumentasi Lengkap

Dokumentasi arsitektural dan panduan teknis mendalam tersedia pada folder [`docs/`](./docs/):
- **[`docs/database-architecture.md`](./docs/database-architecture.md)** — Keputusan arsitektur MySQL Compatibility Adapter di PHP 8.4.
- **[`docs/panduan-file-kritis-dan-standar-coding.md`](./docs/panduan-file-kritis-dan-standar-coding.md)** — Pemetaan file kritis dan standar penulisan kode baru.
- **[`docs/error-logging-system.md`](./docs/error-logging-system.md)** — Arsitektur dan panduan sistem pencatatan error log terpusat.
- **[`docs/web-based-error-log-viewer.md`](./docs/web-based-error-log-viewer.md)** — Panduan Web-Based Error Log Viewer di panel Admin.
- **[`docs/developer-mode-guide.md`](./docs/developer-mode-guide.md)** — Panduan fitur Developer Mode File Inspector (DevBar).
- **[`php-migration-skills/`](./php-migration-skills/)** — Kumpulan reusable migration skills untuk AI agent.

---

## 📄 Lisensi & Hak Cipta
Hak cipta milik pengembang dan instansi pemilik sistem Simbada BMD.
