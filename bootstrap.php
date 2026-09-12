<?php
/**
 * Global Bootstrapper for Simbada BMD Application (PHP 8.4)
 * Initializes Autoloading, Error Logging, and Database Compatibility Adapter.
 */

// 1. Load PSR-4 Autoloader
require_once __DIR__ . '/autoload.php';

// 2. Tentukan Mode Lingkungan (development / production)
// Default adalah 'development'. Di server produksi, definisikan define('APP_ENV', 'production');
if (!defined('APP_ENV')) {
    define('APP_ENV', getenv('APP_ENV') ?: 'development');
}

// 3. Inisialisasi Sistem Pencatatan Log Terpusat
if (class_exists('App\Logging\Logger')) {
    \App\Logging\Logger::init(__DIR__ . '/logs', APP_ENV);
}

// 4. Load MySQL PDO Compatibility Adapter
require_once __DIR__ . '/mysql_adapter.php';
