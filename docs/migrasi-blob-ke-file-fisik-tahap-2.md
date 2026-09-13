# Migrasi Database BLOB ke File Fisik Server (Tahap 2)

Dokumen ini menjelaskan arsitektur, alur teknis, struktur database, serta panduan operasional atas fitur **Migrasi Database BLOB ke Penyimpanan File Fisik Server** pada 4 tabel berikut:
1. `tb_lembar_kerja_foto_denah` (Foto & Denah Lembar Kerja)
2. `tb_lembar_kerja_dokumen` (Dokumen PDF Lembar Kerja)
3. `ta_sp3d_spj_rinci_file` (Bukti SPJ SP3D)
4. `ta_kib_108_pdf` (Dokumen Lampiran PDF KIB 108)

---

## 1. Latar Belakang & Tujuan

Sebelumnya, file gambar dan dokumen biner pada keempat modul di atas disimpan langsung di dalam database:
- **Field Penyimpanan**: `file_content` bertipe `LONGBLOB`
- **Total Record BLOB**:
  - `tb_lembar_kerja_foto_denah`: **26.365 record**
  - `tb_lembar_kerja_dokumen`: **121 record**
  - `ta_sp3d_spj_rinci_file`: **3.404 record**
  - `ta_kib_108_pdf`: **46 record**
  - **Total Keseluruhan**: **29.936 record biner**

### Tujuan Migrasi:
1. **Meringankan Ukuran Database**: Menghilangkan puluhan gigabyte data biner dari MySQL database, mempercepat backup database dump SQL, dan meringankan RAM database server.
2. **Streaming Efisien (I/O Disk)**: Web server membaca langsung file fisik dari hard drive / SSD menggunakan `readfile()` dengan HTTP streaming headers (`Content-Length`, `Content-Disposition`, `Accept-Ranges: bytes`).
3. **Nol Downtime & 100% Backward Compatible**: Seluruh penampil (*viewer/loader*) tetap memiliki **mekanisme fallback** ke data biner `file_content` di database jika file fisik belum diekspor.
4. **Keamanan Direktori**: Mencegah eksekusi script liar (PHP/shell) di folder upload menggunakan `.htaccess` dan `index.html`.
5. **Kompatibilitas PHP 8.4**: Seluruh file handler dibersihkan dari fungsi-fungsi deprecated dan null variable notices (`?? ''`).

---

## 2. Pemetaan Tabel & Direktori Penyimpanan Fisik

Mengikuti standar Simbada pada `simandor/images/`, dibuat subfolder khusus dan terpisah di bawah `simandor/`:

| No | Nama Tabel | Modul Aplikasi | Lokasi Folder Fisik | Format File di Disk |
|---|---|---|---|---|
| 1 | `tb_lembar_kerja_foto_denah` | Lembar Kerja LKI (Foto & Denah) | `simandor/lki_foto/` | `{$IDT}xyz{$cleanFileName}` |
| 2 | `tb_lembar_kerja_dokumen` | Lembar Kerja LKI (Dokumen PDF) | `simandor/lki_dokumen/` | `{$IDT}xyz{$cleanFileName}` |
| 3 | `ta_sp3d_spj_rinci_file` | SPJ SP3D (Foto/Kwitansi) | `simandor/spj/` | `{$IDT}xyz{$cleanFileName}` |
| 4 | `ta_kib_108_pdf` | Lampiran Dokumen KIB 108 | `simandor/kib_pdf/` | `{$IDT}xyz{$cleanFileName}` |

Setiap folder penyimpanan dilengkapi dengan:
- `.htaccess` yang mematikan eksekusi script (`<FilesMatch "\.(php|...)$"> Deny from all </FilesMatch>`) dan mematikan directory browsing (`Options -Indexes`).
- `index.html` kosong untuk proteksi tambahan pada web server non-Apache.

---

## 3. Daftar File yang Terlibat

### A. Modul Dokumen KIB PDF (`ta_kib_108_pdf`)
- [`admin/UploadPDF_Mid_.php`](../admin/UploadPDF_Mid_.php): Handler upload dan delete. Upload memindahkan file fisik ke `simandor/kib_pdf/` dan mengisi `file_content = ''`. Delete menghapus file fisik di disk sebelum `DELETE FROM ta_kib_108_pdf`.
- [`admin/UploadPDF_Pre.php`](../admin/UploadPDF_Pre.php): Viewer preview PDF. Membaca dari `simandor/kib_pdf/` via `readfile()`. Jika belum ada, otomatis fallback membaca BLOB database.

### B. Modul SPJ SP3D (`ta_sp3d_spj_rinci_file`)
- [`admin/SP3D_SPJ_.php`](../admin/SP3D_SPJ_.php): Handler upload bukti SPJ.
- [`admin/SP3D_SPJ_Frm_.php`](../admin/SP3D_SPJ_Frm_.php): Handler upload form SPJ aset.
- [`admin/SP3D_SPJ_Data_Mid_Upl_Mid_Src.php`](../admin/SP3D_SPJ_Data_Mid_Upl_Mid_Src.php): Viewer thumbnail foto SPJ.
- [`admin/SP3D_SPJ_Data_Mid_Upl_Mid_Vie.php`](../admin/SP3D_SPJ_Data_Mid_Upl_Mid_Vie.php): Viewer foto/dokumen SPJ ukuran penuh.
- [`admin/SP3D_SPJ_Frm_Spjaset_Mid_Upl_Mid_Src.php`](../admin/SP3D_SPJ_Frm_Spjaset_Mid_Upl_Mid_Src.php): Viewer thumbnail form SPJ aset.
- [`admin/SP3D_SPJ_Frm_Spjaset_Mid_Upl_Mid_Vie.php`](../admin/SP3D_SPJ_Frm_Spjaset_Mid_Upl_Mid_Vie.php): Viewer ukuran penuh form SPJ aset.
- [`admin/SP3D_SPJ_Data_Mid_Upl_Mid_Rem.php`](../admin/SP3D_SPJ_Data_Mid_Upl_Mid_Rem.php): Handler delete bukti SPJ (unlink file fisik + query DELETE).
- [`admin/SP3D_SPJ_Frm_Spjaset_Mid_Upl_Mid_Rem.php`](../admin/SP3D_SPJ_Frm_Spjaset_Mid_Upl_Mid_Rem.php): Handler delete form SPJ aset (unlink file fisik + query DELETE).

### C. Modul Lembar Kerja LKI (`tb_lembar_kerja_foto_denah` & `tb_lembar_kerja_dokumen`)
- [`admin/Lembar_Kerja_Frm_Data_New_Mid_Img_Upload.php`](../admin/Lembar_Kerja_Frm_Data_New_Mid_Img_Upload.php): Upload foto atau PDF ke `simandor/lki_foto/` atau `simandor/lki_dokumen/`.
- [`admin/Lembar_Kerja_Frm_Img_Upload.php`](../admin/Lembar_Kerja_Frm_Img_Upload.php): Pembersihan pembacaan biner yang tidak terpakai pada modul LKI.
- [`admin/Lembar_Kerja_Frm_Img_Load.php`](../admin/Lembar_Kerja_Frm_Img_Load.php): Stream foto/dokumen LKI dengan prioritas file fisik dan fallback ke database.
- [`admin/Lembar_Kerja_Frm_Img_View_Tabel.php`](../admin/Lembar_Kerja_Frm_Img_View_Tabel.php): Preview modal foto & dokumen PDF LKI dari disk atau fallback database.
- [`admin/Lembar_Kerja_Frm_Data_New_Mid_Img_Load.php`](../admin/Lembar_Kerja_Frm_Data_New_Mid_Img_Load.php): Stream thumbnail aset baru Lembar Kerja.
- [`admin/Lembar_Kerja_Frm_Data_New_Mid_Img_View.php`](../admin/Lembar_Kerja_Frm_Data_New_Mid_Img_View.php): Modal preview aset baru Lembar Kerja.
- [`admin/Lembar_Kerja_Frm_Data_New_Mid_Img_Remove.php`](../admin/Lembar_Kerja_Frm_Data_New_Mid_Img_Remove.php): Handler hapus foto/dokumen aset baru Lembar Kerja.
- [`admin/Lembar_Kerja_Frm_Img_Remove_Tabel.php`](../admin/Lembar_Kerja_Frm_Img_Remove_Tabel.php): Handler hapus foto/dokumen LKI tabel.

### D. CLI Migration Script & Proteksi Baru
- [`scripts/migrate_all_blobs_to_files.php`](../scripts/migrate_all_blobs_to_files.php): Tool CLI migrasi batch data lama dari DB ke file fisik.
- [`simandor/lki_foto/.htaccess`](../simandor/lki_foto/.htaccess) & [`index.html`](../simandor/lki_foto/index.html)
- [`simandor/lki_dokumen/.htaccess`](../simandor/lki_dokumen/.htaccess) & [`index.html`](../simandor/lki_dokumen/index.html)
- [`simandor/spj/.htaccess`](../simandor/spj/.htaccess) & [`index.html`](../simandor/spj/index.html)
- [`simandor/kib_pdf/.htaccess`](../simandor/kib_pdf/.htaccess) & [`index.html`](../simandor/kib_pdf/index.html)

---

## 4. Panduan Menjalankan Script Migrasi Data Lama (CLI)

Script `scripts/migrate_all_blobs_to_files.php` dapat dijalankan melalui terminal / command prompt.

### A. Melihat Bantuan Opsi:
```bash
php scripts/migrate_all_blobs_to_files.php --help
```

### B. Simulasi Migrasi Tanpa Mengubah Apa Pun (Dry-Run):
Gunakan opsi `--dry-run` untuk melihat pratinjau record dan memastikan file path valid:
```bash
# Simulasi 10 record pada semua tabel
php scripts/migrate_all_blobs_to_files.php --table=all --limit=10 --dry-run

# Simulasi seluruh record tabel SPJ
php scripts/migrate_all_blobs_to_files.php --table=ta_sp3d_spj_rinci_file --dry-run
```

### C. Ekspor File Fisik (Mempertahankan BLOB di DB):
File diekspor ke folder fisik, namun field `file_content` di database **belum dikosongkan**:
```bash
# Migrasi seluruh tabel KIB PDF (46 record)
php scripts/migrate_all_blobs_to_files.php --table=ta_kib_108_pdf

# Migrasi seluruh tabel Dokumen LKI (121 record)
php scripts/migrate_all_blobs_to_files.php --table=tb_lembar_kerja_dokumen

# Migrasi bertahap SPJ (contoh: 500 record pertama)
php scripts/migrate_all_blobs_to_files.php --table=ta_sp3d_spj_rinci_file --limit=500
```

### D. Ekspor File Fisik dan Kosongkan BLOB di DB (`--clear-blob`):
Jika ingin mengosongkan field `file_content` di database untuk menghemat ruang disk MySQL:
```bash
# Contoh untuk tabel KIB PDF
php scripts/migrate_all_blobs_to_files.php --table=ta_kib_108_pdf --clear-blob

# Contoh untuk seluruh tabel sekaligus
php scripts/migrate_all_blobs_to_files.php --table=all --clear-blob
```

---

## 5. Ringkasan Hasil Pengujian (End-to-End Verification)

Pengujian komprehensif telah dijalankan mencakup seluruh siklus hidup file (create, stream physical, fallback legacy blob, dan delete physical unlink):

```
========================================================
HASIL PENGUJIAN: 28 PASS, 0 FAIL (100% SUKSES)
========================================================
1. Folder Fisik & File Proteksi (.htaccess + index.html):
   - simandor/lki_foto/    : [PASS]
   - simandor/lki_dokumen/ : [PASS]
   - simandor/spj/         : [PASS]
   - simandor/kib_pdf/     : [PASS]
2. Fallback Pembacaan BLOB DB Lama (Backward Compatibility):
   - tb_lembar_kerja_foto_denah : [PASS]
   - tb_lembar_kerja_dokumen    : [PASS]
   - ta_sp3d_spj_rinci_file     : [PASS]
   - ta_kib_108_pdf             : [PASS]
3. Streaming File Fisik & Unlink Delete:
   - UploadPDF_Pre.php / UploadPDF_Mid_.php                     : [PASS]
   - SP3D_SPJ_Data_Mid_Upl_Mid_Src.php / Rem.php                : [PASS]
   - Lembar_Kerja_Frm_Img_Load.php / Remove_Tabel.php           : [PASS]
   - Lembar_Kerja_Frm_Img_View_Tabel.php / Img_Remove.php       : [PASS]
```
Semua file PHP yang dimodifikasi lolos verifikasi sintaks PHP (`php -l`) tanpa error maupun peringatan.
