# Dokumentasi Migrasi PHP 8.4 (Simbada BMD)

Folder ini berisi dokumentasi teknis, keputusan arsitektur, dan panduan pengembang terkait proyek migrasi aplikasi Simbada BMD dari **PHP 5.6 ke PHP 8.4**.

---

## Daftar Dokumen:

1. **[`database-architecture.md`](./database-architecture.md)**
   - **Judul**: *Architectural Decision Record (ADR): Penggunaan MySQL Compatibility Adapter di PHP 8.4*
   - **Isi**: Latar belakang 13.836 panggilan `mysql_*`, perbandingan risiko (Adapter vs direct rewrite `mysqli`/`PDO`), cara kerja internal [mysql_adapter.php](../mysql_adapter.php), dan roadmap refactoring bertahap.

2. **[`panduan-file-kritis-dan-standar-coding.md`](./panduan-file-kritis-dan-standar-coding.md)**
   - **Judul**: *Panduan File Kritis & Standar Coding PHP 8.4 (Simbada BMD)*
   - **Isi**: 
     - Pemetaan file-file paling kritis berdasarkan perannya (Koneksi Database, Helper/Function Umum, Core System, File Berisiko Tinggi, dan File Konfigurasi).
     - Aturan pembuatan file baru / fitur baru.
     - 4 Risiko fatal jika memaksakan gaya lama di file baru.
     - 4 Standar coding modern yang diwajibkan untuk fitur baru (Strict types, PDO Prepared Statements, OOP di `src/`, dan fitur modern PHP 8).

3. **[`error-logging-system.md`](./error-logging-system.md)**
   - **Judul**: *Sistem Pencatatan Error Log Terpusat (PHP 8.2 - 8.4)*
   - **Isi**:
     - Arsitektur sistem error logging terpusat, pengamanan folder `logs/`.
     - Mekanisme penangkapan PHP Errors, Uncaught Exceptions, Fatal Shutdowns, dan Database Query Errors.
     - Konfigurasi mode `development` vs `production` (tampilan aman + Reference ID pelacakan).
     - Panduan CLI `scripts/view_log.php` dan cara memantau log error harian.

4. **[`web-based-error-log-viewer.md`](./web-based-error-log-viewer.md)**
   - **Judul**: *Panduan Web-Based Error Log Viewer (Panel Admin)*
   - **Isi**:
     - Arsitektur visual dashboard antarmuka log di `admin/Log_Viewer.php`.
     - Aturan hak akses dan keamanan khusus Administrator (`$Lev <= 1`).
     - Panduan penggunaan fitur: Statistik harian, filter tanggal & level, pencarian instan (Live Search), tema Dark/Light, unduh file `.log`, dan pengosongan log dengan modal konfirmasi.
     - Diagram alur penanganan insiden error dari pengguna lapangan hingga debugging presisi menggunakan Reference ID.

5. **[`developer-mode-guide.md`](./developer-mode-guide.md)**
   - **Judul**: *Panduan Fitur Developer Mode File Inspector (DevBar)*
   - **Isi**:
     - Solusi pelacakan file PHP aktif pada arsitektur frame dan popup Simbada BMD.
     - Mekanisme otomatis penempelan badge floating via output buffering handler.
     - Penjelasan informasi: Nama skrip, path relatif & absolut, deteksi konteks frame, daftar included files, metrik waktu/memori, dan parameter request.
     - 3 Metode aktivasi/deaktivasi mudah (parameter URL `?dev_mode=1`, tombol DevBar, atau konfigurasi `bootstrap.php`).
     - Jaminan keamanan di lingkungan produksi (*Zero Leak*).

6. **[`migrasi-penyimpanan-gambar-kib.md`](./migrasi-penyimpanan-gambar-kib.md)**
   - **Judul**: *Migrasi Penyimpanan Gambar Aset KIB (ta_kib_108)*
   - **Isi**:
     - Latar belakang pemindahan gambar dari database `LONGBLOB` (`file_content`) ke file fisik server.
     - Lokasi penyimpanan di `simandor/images/` dan konvensi penamaan `{IDT}xyz{nama_file}`.
     - Pemetaan field database (`file_name`, `file_type`, `file_size`, `file_content = ''`).
     - Diagram alur upload baru, penayangan gambar dengan fallback otomatis data legacy, dan proses hapus (unlink).
     - Pengamanan folder `.htaccess` (nonaktifkan script PHP/CGI dan directory listing).
     - Panduan CLI migrasi data lama: `scripts/migrate_kib_blob_to_files.php`.
