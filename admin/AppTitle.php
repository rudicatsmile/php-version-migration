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
