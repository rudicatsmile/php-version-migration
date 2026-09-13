# Migrasi Penyimpanan Gambar Aset KIB (ta_kib_108)

Dokumen ini menjelaskan arsitektur, alur teknis, struktur database, dan panduan operasional atas fitur **Migrasi Penyimpanan Gambar Aset KIB** dari database `LONGBLOB` ke **penyimpanan fisik di server**.

---

## 1. Latar Belakang & Tujuan

Sebelumnya, gambar dan foto dokumen aset pada modul KIB disimpan langsung di dalam database:
- **Tabel**: `ta_kib_108`
- **Field**: `file_content`
- **Tipe Data**: `LONGBLOB`

### Masalah pada Pendekatan Lama:
1. **Ukuran Database Membengkak**: Tabel database menjadi sangat besar dan berat saat di-backup / restore (dump SQL).
2. **Beban Memori PHP & MySQL**: Setiap query yang memuat baris data aset harus mentransfer puluhan hingga ratusan kilobyte data biner gambar ke memori server.
3. **Risiko Bottleneck I/O**: Membaca ribuan BLOB melalui koneksi database lebih lambat dibanding web server menyajikan file statis dari hard drive/SSD.

### Tujuan Perubahan:
1. **Pemisahan Penyimpanan**: Gambar fisik disimpan langsung di sistem berkas (file system) server.
2. **Penyimpanan Ringan di DB**: Database hanya menyimpan metadata file (`file_name`, `file_type`, `file_size`).
3. **Nol Downtime & Backward Compatible**: 2.402 data gambar lama yang masih berupa BLOB tetap dapat tampil normal tanpa rusak.
4. **Kompatibilitas Penuh**: Kompatibel dengan PHP 8.2, 8.3, dan 8.4 serta terintegrasi dengan modul laporan dan API mobile yang sudah ada.

---

## 2. File-File yang Terlibat

### File yang Dimodifikasi:
| File | Peran & Perubahan |
|---|---|
| [`admin/UploadIMG_Mid_.php`](../admin/UploadIMG_Mid_.php) | **Handler Upload & Hapus**: Memvalidasi ekstensi/MIME, memindahkan file fisik via `move_uploaded_file()` ke folder penyimpanan, menghapus file lama saat diganti/dihapus, dan mengupdate database dengan `file_content = ''`. |
| [`admin/UploadIMG_Mid.php`](../admin/UploadIMG_Mid.php) | **Form Upload Antarmuka**: Menambahkan atribut `accept="image/*"`, null-coalescing aman (`$_GET ?? ''`), dan menampilkan info file yang sedang terpasang (nama file & ukuran). |
| [`admin/SourceIMG.php`](../admin/SourceIMG.php) | **Renderer Thumbnail Gambar**: Memeriksa dan menyajikan file fisik dari disk terlebih dahulu (`readfile()`). Jika belum ada di disk, otomatis **fallback** membaca `file_content` dari database. |
| [`admin/PreviewIMG.php`](../admin/PreviewIMG.php) | **Popup Preview Gambar**: Menyajikan gambar ukuran penuh dengan prioritas file fisik dan fallback ke database BLOB, serta penanganan header aman (`headers_sent()`). |

### File Baru:
| File | Peran & Deskripsi |
|---|---|
| [`simandor/images/.htaccess`](../simandor/images/.htaccess) | **Konfigurasi Keamanan Apache**: Mencegah eksekusi script PHP/CGI di dalam folder upload dan menonaktifkan directory browsing (`Options -Indexes`). |
| [`simandor/images/index.html`](../simandor/images/index.html) | **Proteksi Tambahan**: Halaman kosong untuk mencegah direct folder listing pada web server selain Apache. |
| [`scripts/migrate_kib_blob_to_files.php`](../scripts/migrate_kib_blob_to_files.php) | **CLI Tool Migrasi Massal**: Script mandiri untuk mengekspor data BLOB lama ke folder fisik secara bertahap atau sekaligus. |

---

## 3. Lokasi Penyimpanan & Konvensi Penamaan File

### Folder Penyimpanan:
```
simandor/images/
```
*(Dari folder `admin/`, diakses melalui path relatif: `../simandor/images/`)*

> **Catatan Arsitektur**: Folder `simandor/images/` dipilih karena telah digunakan oleh API Simandor mobile (`admin/api/upload_photo.php` & `api/upload_photo_v2.php`) serta dibaca langsung oleh modul laporan KIB (`admin/report/P47_Kibar_*.php` dan `Report_Form_LKI_*.php`).

### Format Penamaan File di Disk:
```
{IDT}xyz{nama_file_unik}.{ext}
```

- **`{IDT}`**: ID primary key dari tabel `ta_kib_108`.
- **`xyz`**: Pembatas standar (separator) yang digunakan oleh seluruh sistem Simbada.
- **`{nama_file_unik}`**: Nama file asli yang telah dibersihkan dan diberi penanda waktu serta hash unik untuk mencegah konflik nama duplikat:
  ```
  {$cleanBase}_{$timestamp}_{$uniqueSuffix}.{$ext}
  ```

*Contoh Nyata*:
- Record IDT: `279`
- Nilai `file_name` di Database: `inventaris_kantor_1789283080_68f0a111.jpg`
- Nama file fisik di disk server: `279xyzinventaris_kantor_1789283080_68f0a111.jpg`

---

## 4. Struktur Database (`ta_kib_108`)

Pada tabel `ta_kib_108`, field terkait file dikelola sebagai berikut:

| Field | Tipe Data | Peran pada Alur Baru |
|---|---|---|
| `file_name` | `varchar(100)` | Menyimpan nama file unik (tanpa prefix `{IDT}xyz`). |
| `file_type` | `varchar(100)` | Menyimpan MIME Type (contoh: `image/jpeg`, `image/png`, `image/gif`). |
| `file_size` | `int(11)` | Menyimpan ukuran byte file fisik di server. |
| `file_content` | `longblob` | **Dikosongkan (`''`) untuk upload baru**. Nilai lama tetap dibiarkan sampai admin menjalankan script migrasi. |

---

## 5. Diagram Alur Kerja (Workflow)

```mermaid
flowchart TD
    subgraph UPLOAD_FLOW["1. Alur Upload / Ganti Gambar"]
        A[Pengguna Memilih File Gambar di Form] --> B[Kirim ke UploadIMG_Mid_.php]
        B --> C{Validasi Ekstensi & MIME}
        C -->|Tidak Valid| D[Tolak Upload & Tampilkan Peringatan]
        C -->|Valid| E[Cari & Hapus File Fisik Lama jika ada]
        E --> F[Pindahkan File ke simandor/images/IDTxyzNamaFile]
        F --> G["UPDATE ta_kib_108 SET file_name=..., file_type=..., file_size=..., file_content=''"]
        G --> H[Tutup Popup & Refresh Window Induk]
    end

    subgraph VIEW_FLOW["2. Alur Penayangan (SourceIMG / PreviewIMG)"]
        I[Permintaan Gambar: rIDT=...] --> J[Cari Data di ta_kib_108]
        J --> K{File Fisik Ada di simandor/images/?}
        K -->|Ya| L["readfile() Langsung dari Disk Server"]
        K -->|Tidak| M{Field file_content Berisi BLOB?}
        M -->|Ya (Legacy Data)| N["Output BLOB dari Database"]
        M -->|Tidak| O["Tampilkan Placeholder Gambar Default"]
    end

    subgraph DELETE_FLOW["3. Alur Penghapusan Gambar"]
        P[Pengguna Klik Tombol 'Hapus Gambar'] --> Q[Kirim Request Simpan=Delete]
        Q --> R["Hapus (unlink) File Fisik di simandor/images/"]
        R --> S["UPDATE ta_kib_108 SET file_name='', file_type='', file_size=0, file_content=''"]
        S --> T[Tutup Popup & Refresh Window Induk]
    end
```

---

## 6. Keamanan & Proteksi Folder

Penyimpanan file fisik dilengkapi dengan sistem pengamanan berlapis:

1. **Proteksi Eksekusi Script (`.htaccess`)**:
   Di dalam folder `simandor/images/.htaccess`, aturan berikut diterapkan:
   ```apache
   # Matikan eksekusi script PHP & CGI
   <FilesMatch "\.(php|php3|php4|php5|php7|php8|phtml|pl|py|jsp|asp|sh|cgi)$">
       Order Deny,Allow
       Deny from all
   </FilesMatch>
   php_flag engine off

   # Matikan directory browsing
   Options -Indexes
   ```
2. **Whitelist Tipe File**:
   Hanya ekstensi gambar yang diizinkan: `jpg`, `jpeg`, `png`, `gif`, `bmp`, `webp`, dan `pdf`.
3. **Sanitasi Nama File**:
   Nama file dibersihkan dari karakter ilegal (`../`, spasi, tanda petik, karakter kontrol) menggunakan regex `[^a-zA-Z0-9_\-]`.
4. **Pencegahan SQL Injection**:
   Parameter `$rIDT` disanitasi menggunakan `preg_replace('/[^0-9]/', '', ...)` sehingga dipastikan hanya memuat angka valid.
5. **Header Safe Rendering**:
   Pengiriman header `Content-Type` dan `Content-Length` dilindungi pemeriksaan `!headers_sent()` guna mencegah timbulnya PHP warning di PHP 8.4.

---

## 7. Panduan Tool Migrasi Massal (CLI)

Untuk memindahkan 2.402 data BLOB legacy yang masih tersimpan di database ke folder fisik, telah disediakan script CLI di [`scripts/migrate_kib_blob_to_files.php`](../scripts/migrate_kib_blob_to_files.php).

### Sintaks Perintah:
```bash
php scripts/migrate_kib_blob_to_files.php [opsi]
```

### Opsi yang Tersedia:
- `--help` : Menampilkan petunjuk penggunaan.
- `--dry-run` : Menjalankan simulasi tanpa menulis file ke disk dan tanpa mengubah database.
- `--limit=N` : Membatasi pemrosesan hanya sebanyak `N` record pertama.
- `--clear-blob` : Mengosongkan field `file_content` di database setelah file berhasil ditulis ke disk.
- `--overwrite` : Menimpa file fisik jika sudah ada di disk.

### Contoh Penggunaan:

1. **Uji Coba / Simulasi 10 Data Pertama**:
   ```powershell
   d:\xampp\php\php.exe scripts/migrate_kib_blob_to_files.php --limit=10 --dry-run
   ```

2. **Migrasi Nyata 100 Data Pertama (Tanpa Hapus BLOB)**:
   ```powershell
   d:\xampp\php\php.exe scripts/migrate_kib_blob_to_files.php --limit=100
   ```

3. **Migrasi Penuh Seluruh Data Sekaligus Mengosongkan BLOB**:
   ```powershell
   d:\xampp\php\php.exe scripts/migrate_kib_blob_to_files.php --clear-blob
   ```

---

## 8. Verifikasi & Pengujian

Fitur ini telah diuji dengan skenario berikut:

1. **Syntax Checking (PHP 8.2 - 8.4)**:
   Seluruh script lolos validasi lint (`php -l`) tanpa error maupun peringatan sintaks.
2. **End-to-End Upload, View, & Delete**:
   - Berhasil mengunggah file gambar uji coba.
   - File tersimpan di `simandor/images/` dengan ukuran sesuai byte aslinya.
   - Database terisi metadata file dan field `file_content` bernilai string kosong.
   - `SourceIMG.php` dan `PreviewIMG.php` menyajikan gambar langsung dari disk.
   - Tombol Delete berhasil menghapus file fisik dari disk dan membersihkan record database.
3. **Pengujian Kompatibilitas Data Lama (Fallback)**:
   - Data aset lama dengan IDT `238496` yang masih berupa BLOB di database berhasil dibaca dan disajikan secara transparan ke layar tanpa perlu migrasi mendadak.
