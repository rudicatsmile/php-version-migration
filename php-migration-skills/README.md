# PHP Legacy to Modern Migration Skills

Kumpulan skill untuk membantu AI Agent (seperti Antigravity IDE) dalam migrasi aplikasi native PHP 5.6 ke PHP 8.4.

## Daftar Skill

### 1. php-legacy-to-modern-migration
**Skill inti** — Rencana dan workflow migrasi keseluruhan.

- File utama: [`php-legacy-to-modern-migration/SKILL.md`](php-legacy-to-modern-migration/SKILL.md)
- References:
  - [breaking-changes.md](php-legacy-to-modern-migration/references/breaking-changes.md)
  - [rector-config.md](php-legacy-to-modern-migration/references/rector-config.md)
  - [modern-practices.md](php-legacy-to-modern-migration/references/modern-practices.md)

### 2. php-compatibility-scanner
Scan masalah kompatibilitas menggunakan PHPCompatibility.

- File utama: [`php-compatibility-scanner/SKILL.md`](php-compatibility-scanner/SKILL.md)
- References:
  - [common-issues.md](php-compatibility-scanner/references/common-issues.md)

### 3. php-rector-modernizer
Refactoring otomatis dengan Rector secara aman dan bertahap.

- File utama: [`php-rector-modernizer/SKILL.md`](php-rector-modernizer/SKILL.md)
- References:
  - [rector-configs.md](php-rector-modernizer/references/rector-configs.md)
  - [pitfalls.md](php-rector-modernizer/references/pitfalls.md)

### 4. php-modern-php-practices
Modernisasi struktur, typing, security, dan fitur PHP 8.x setelah upgrade berhasil.

- File utama: [`php-modern-php-practices/SKILL.md`](php-modern-php-practices/SKILL.md)
- References:
  - [composer-setup.md](php-modern-php-practices/references/composer-setup.md)
  - [php84-features.md](php-modern-php-practices/references/php84-features.md)

## Urutan Penggunaan yang Disarankan

1. **php-legacy-to-modern-migration** → Buat rencana keseluruhan
2. **php-compatibility-scanner** → Temukan semua masalah kompatibilitas
3. **php-rector-modernizer** → Perbaiki masalah mekanis secara otomatis
4. **php-modern-php-practices** → Lakukan modernisasi lebih lanjut (Composer, namespaces, types, security, fitur baru)

## Cara Memakai

Salin folder skill yang diinginkan ke direktori skills agent AI Anda, atau berikan isi `SKILL.md` + references sesuai kebutuhan.

---

Dibuat untuk keperluan migrasi aplikasi PHP legacy ke PHP 8.4.
