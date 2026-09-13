# Panduan Eksekusi Migrasi Gambar BLOB ke File Fisik Server

Panduan praktis ini ditujukan bagi Administrator atau Pengembang untuk menjalankan script migrasi gambar aset KIB ([`scripts/migrate_kib_blob_to_files.php`](../scripts/migrate_kib_blob_to_files.php)) dari tipe data `LONGBLOB` di database MySQL ke sistem berkas (file system) di server.

---

## 1. Ikhtisar & Manfaat

| Parameter | Keterangan |
|---|---|
| **Script CLI** | [`scripts/migrate_kib_blob_to_files.php`](../scripts/migrate_kib_blob_to_files.php) |
| **Sumber Data** | Tabel `ta_kib_108` (field `file_content` bertipe `LONGBLOB`) |
| **Target Penyimpanan** | Folder `simandor/images/` |
| **Format File di Disk** | `{IDT}xyz{nama_file}` |
| **Estimasi Data Lama** | ~2.402 record foto aset |

### Mengapa Migrasi Ini Perlu Dijalankan?
1. **Meringankan Ukuran Database**: Mengecilkan ukuran file dump/backup MySQL secara drastis dari ratusan megabyte menjadi hitungan megabyte.
2. **Kinerja Halaman Lebih Cepat**: Gambar disajikan langsung oleh web server (Apache/Nginx) dari disk tanpa membebani memory engine MySQL.
3. **Mencegah Memory Exhaustion**: Menghindari beban alokasi RAM besar saat mengekspor laporan aset atau menampilkan galeri foto.

---

## 2. Prasyarat Sebelum Menjalankan

1. **Service MySQL Aktif**: Pastikan database MySQL di XAMPP Control Panel dalam keadaan **Running**.
2. **Ketersediaan Ruang Disk**: Pastikan partisi hard disk (Drive `D:\`) memiliki ruang kosong minimal 1-2 GB untuk menampung seluruh file foto yang diekstrak.
3. **Backup Database (Sangat Disarankan)**:
   Sebelum menjalankan proses pengosongan BLOB (`--clear-blob`), lakukan dump database terlebih dahulu sebagai langkah mitigasi:
   ```bash
   mysqldump -u root simbada_barsel_data_2025 ta_kib_108 > backup_ta_kib_108_sebelum_migrasi.sql
   ```

---

## 3. Opsi & Parameter Perintah

Script dijalankan menggunakan PHP CLI dengan struktur perintah:
```bash
php scripts/migrate_kib_blob_to_files.php [opsi]
```

Daftar parameter yang tersedia:

| Opsi | Tipe | Deskripsi |
|---|---|---|
| `--help` | Flag | Menampilkan panduan bantuan dan daftar opsi yang tersedia. |
| `--dry-run` | Flag | **Mode simulasi aman**. Membaca database dan mencetak rencana proses ke layar tanpa menulis file fisik dan tanpa mengubah database. |
| `--limit=N` | Nilai Angka | Membatasi proses hanya untuk `N` record pertama (contoh: `--limit=50`). |
| `--clear-blob` | Flag | Mengosongkan isi field `file_content` (`file_content = ''`) di database setelah file berhasil ditulis ke disk server. |
| `--overwrite` | Flag | Menimpa (overwrite) file jika file dengan nama tersebut sudah ada di folder `simandor/images/`. |

---

## 4. Prosedur Eksekusi Langkah-demi-Langkah (Best Practice)

Ikuti 5 tahapan berurutan di bawah ini untuk memastikan migrasi berjalan tanpa kendala:

### Langkah 1: Buka Terminal & Pindah ke Direktori Project
Buka **PowerShell** atau **Command Prompt**, lalu arahkan ke root direktori proyek:
```powershell
cd d:\xampp\htdocs\migration-php-v2
```

---

### Langkah 2: Uji Coba Simulasi (Dry Run)
Jalankan simulasi untuk 10 record pertama guna memastikan koneksi database dan pembacaan record bekerja normal:
```powershell
d:\xampp\php\php.exe scripts/migrate_kib_blob_to_files.php --limit=10 --dry-run
```
**Ekspektasi Output:**
```
========================================================
 MIGRASI GAMBAR ta_kib_108 KE PENYIMPANAN FISIK
========================================================
Folder Target  : D:\xampp\htdocs\migration-php-v2\simandor\images
Mode Simulasi  : YA (Dry Run)
...
[1] DRY-RUN OK: IDT #238496 -> 238496xyzWhatsApp Image 2023-03-27 at 09.35.22.jpeg (72106 bytes)
...
RINGKASAN PROSES:
Berhasil       : 10
Gagal / Error  : 0
```

---

### Langkah 3: Migrasi Sampel Nyata (50 File Pertama)
Tuliskan 50 file pertama ke disk fisik, **tanpa mengosongkan BLOB** di database (field `file_content` tetap utuh):
```powershell
d:\xampp\php\php.exe scripts/migrate_kib_blob_to_files.php --limit=50
```
Setelah selesai, periksa folder `d:\xampp\htdocs\migration-php-v2\simandor\images\` di File Explorer untuk memastikan file-file gambar tersebut terbentuk dengan benar dan dapat dibuka normal.

---

### Langkah 4: Eksekusi Migrasi Penuh (Seluruh Gambar)
Jalankan migrasi untuk seluruh 2.402 record foto tanpa batas limit:
```powershell
d:\xampp\php\php.exe scripts/migrate_kib_blob_to_files.php
```
> **Catatan Resiliensi**: Jika koneksi terputus atau Anda menekan `Ctrl + C` di tengah proses, Anda dapat menjalankan kembali perintah ini kapan saja. Script akan otomatis mendeteksi file yang sudah ada di disk dan menandainya dengan status **SKIP**, sehingga tidak akan terjadi proses ganda.

---

### Langkah 5: Pengosongan BLOB di Database (Opsional & Final)
Setelah Anda memverifikasi bahwa gambar pada aplikasi web (form aset, kartu inventaris, dan laporan KIB) tampil normal dari file fisik, Anda dapat menjalankan perintah ini untuk **mengosongkan data BLOB di database** agar ukuran database menyusut maksimal:
```powershell
d:\xampp\php\php.exe scripts/migrate_kib_blob_to_files.php --clear-blob
```

---

## 5. Pertanyaan yang Sering Diajukan (FAQ & Troubleshooting)

#### Q1: Apakah aplikasi web akan error jika migrasi belum selesai dijalankan?
**Tidak.** File [`admin/SourceIMG.php`](../admin/SourceIMG.php) dan [`admin/PreviewIMG.php`](../admin/PreviewIMG.php) sudah dilengkapi mekanisme **Dual-Lookup Fallback**:
- Jika file fisik ada di disk server, tampilkan file fisik.
- Jika file fisik belum ada di disk (belum dimigrasikan), otomatis membaca dari data BLOB database lama.

#### Q2: Bagaimana jika nama file asli dari beberapa aset sama (misal sama-sama bernama `foto.jpg`)?
**Sangat aman.** Script menggunakan format penamaan standar `{IDT}xyz{nama_file}`. Karena `IDT` adalah primary key (nomor urut unik unik untuk setiap record), tidak akan ada benturan nama file di dalam folder `simandor/images/`.

#### Q3: Muncul pesan `Gagal Tulis File` saat eksekusi?
Periksa izin akses folder (permission) pada direktori `simandor/images/`. Pastikan user Windows memiliki hak tulis (*write permission*) pada folder tersebut.

#### Q4: Bagaimana cara menjalankan ulang jika ada file gambar yang rusak atau kosong (0 bytes)?
Gunakan opsi `--overwrite`:
```powershell
d:\xampp\php\php.exe scripts/migrate_kib_blob_to_files.php --overwrite
```
Script akan menimpa file yang ada di disk dengan isi BLOB dari database.
