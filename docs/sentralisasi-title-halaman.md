# Sentralisasi Pengaturan Title Halaman Aplikasi Simbada

Dokumen ini menjelaskan arsitektur, implementasi, dan panduan operasional atas fitur **Sentralisasi Pengaturan Title Halaman** di seluruh aplikasi Simbada.

---

## 1. Latar Belakang & Tujuan

Sebelumnya, judul halaman browser di-hardcode di masing-masing file HTML/PHP dengan teks:
```html
<title>Simbada Kab. Hulu Sungai Tengah</title>
```
Potongan kode ini tersebar di **535 file** dengan total **803 kemunculan** (baik di tag `<head>` maupun di dalam string JavaScript popup window). Jika instansi ingin mengganti nama daerah atau judul aplikasi, harus mengubah ratusan file satu per satu.

### Tujuan Perubahan:
1. **Satu File Pengendali**: Title halaman dikontrol dari **satu file pusat saja**.
2. **Otomatis & Real-time**: Jika title diganti di file pusat, seluruh halaman, frame, popup dialog, dan laporan otomatis berubah tanpa perlu mengubah file lain.
3. **Praktis & Mudah Dirawat**: Tidak mengubah tampilan atau struktur halaman yang sudah ada.
4. **Kompatibilitas Penuh**: Kompatibel dengan PHP 8.2, 8.3, dan 8.4.

---

## 2. File Pusat Pengaturan Title

File pengendali utama aplikasi berada di:
```
admin/AppTitle.php
```

### Isi File `admin/AppTitle.php`:
```php
<?php
/**
 * Konfigurasi Terpusat Title Halaman Aplikasi Simbada
 * 
 * Untuk mengubah title halaman di seluruh aplikasi, cukup ubah nilai konstanta APP_TITLE di bawah ini.
 */

if (!defined('APP_TITLE')) {
    define('APP_TITLE', 'Simbada Kab. Hulu Sungai Tengah');
}

if (!function_exists('app_title')) {
    function app_title() {
        return APP_TITLE;
    }
}
```

### Pointer File Pendukung:
Untuk mendukung pemanggilan dari berbagai folder dengan path yang rapi dan seragam:
1. **Root Pointer**: [`AppTitle.php`](../AppTitle.php) $\rightarrow$ mengarahkan ke `admin/AppTitle.php` untuk file tingkat root (seperti `index.php`).
2. **Report Pointer**: [`admin/report/AppTitle.php`](../admin/report/AppTitle.php) $\rightarrow$ mengarahkan ke `admin/AppTitle.php` untuk modul laporan di folder `admin/report/`.
3. **Integrasi Core**: Otomatis dimuat pada `bootstrap.php`, `connfile.php`, `admin/Connection.php`, dan `admin/FileFunction.php`.

---

## 3. Cara Mengubah Title ke Depannya

Untuk mengubah title aplikasi di seluruh sistem, Anda hanya perlu membuka file:
> **[`admin/AppTitle.php`](../admin/AppTitle.php)**

Lalu ubah baris:
```php
define('APP_TITLE', 'Simbada Kab. Hulu Sungai Tengah');
```
menjadi nama title yang baru, misalnya:
```php
define('APP_TITLE', 'Simbada Kabupaten Barito Selatan');
```
Simpan file tersebut. **Seluruh 535 halaman aplikasi akan langsung menampilkan title baru secara otomatis.**

---

## 4. Rincian Penggantian pada Halaman Aplikasi

Penggantian dilakukan pada **535 file** (total **803 kemunculan**) dengan format:

### A. Tag HTML `<head>`:
```php
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
```

### B. Dialog Popup JavaScript (`txtHTML`):
```javascript
txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head>...";
```

---

## 5. Ringkasan File yang Telah Disesuaikan

- **Total File**: 535 file
  - `admin/*.php`: 529 file (termasuk `Form_Asset_*.php`, `KIB-*.php`, `Find_*.php`, `Backup_Dump_*.php`, dll.)
  - `admin/report/*.php`: 6 file (`P47_Kibar_A.php` s/d `P47_Kibar_F.php`)
  - `index.php`: 1 file di root
- **Daftar Lengkap File**: Tersimpan di manifest [`scripts/title_migration_manifest.json`](../scripts/title_migration_manifest.json).

---

## 6. Hasil Pengujian & Verifikasi

1. **Uji Nilai Default**: Berhasil mencetak `Simbada Kab. Hulu Sungai Tengah`.
2. **Uji Perubahan Dinamis**: Mengubah nilai `APP_TITLE` di `admin/AppTitle.php` langsung mengubah output title di halaman utama, form aset, frame standalone, popup JS, dan laporan.
3. **Uji Linting PHP**: Seluruh file yang dimodifikasi lulus verifikasi sintaks `php -l` tanpa error.
4. **Verifikasi Pencarian**: Pencarian string `<title>Simbada Kab. Hulu Sungai Tengah</title>` di seluruh repository kini menghasilkan **0 kemunculan** di kode aplikasi.
