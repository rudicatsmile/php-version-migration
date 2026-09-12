<?php

declare(strict_types=1);

namespace App\Security;

class PasswordHasher
{
    /**
     * Membuat hash password modern menggunakan BCRYPT.
     */
    public static function hash(string $plainPassword): string
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }

    /**
     * Memverifikasi password masukan pengguna.
     * Mendukung verifikasi modern password_hash() serta fallback aman untuk legacy double-base64.
     */
    public static function verify(string $plainPassword, string $storedHash): bool
    {
        // 1. Cek format hash password modern (dimulai dengan $2y$, $argon2id$, dll.)
        if (str_starts_with($storedHash, '$')) {
            return password_verify($plainPassword, $storedHash);
        }

        // 2. Fallback untuk password legacy (double base64 encode dari aplikasi PHP 5.6)
        $legacyHash = base64_encode(base64_encode($plainPassword));
        return hash_equals($legacyHash, $storedHash);
    }

    /**
     * Memeriksa apakah password masih menggunakan format legacy atau algoritma lama
     * sehingga perlu di-rehash ke format modern saat login berhasil.
     */
    public static function needsRehash(string $storedHash): bool
    {
        if (!str_starts_with($storedHash, '$')) {
            return true; // Masih legacy base64
        }
        return password_needs_rehash($storedHash, PASSWORD_DEFAULT);
    }
}
