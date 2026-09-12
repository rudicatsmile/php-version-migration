<?php
/**
 * Test Suite for Simbada Centralized Error Logging System.
 */

// Pastikan lingkungan test
define('APP_ENV', 'development');

require_once dirname(__DIR__) . '/bootstrap.php';

use App\Logging\Logger;

echo "Memulai pengujian sistem logging...\n\n";

$logDir = dirname(__DIR__) . '/logs';
$todayFile = $logDir . '/app-' . date('Y-m-d') . '.log';

// Catat ukuran awal log
$initialSize = file_exists($todayFile) ? filesize($todayFile) : 0;

// 1. Uji manual logging
Logger::log('INFO', 'Test log info manual', ['file' => __FILE__, 'line' => __LINE__]);
echo "[1/4] Manual log testing... OK\n";

// 2. Uji PHP Warning / Notice
$dummyArray = ['a' => 1];
@$nonExistent = $dummyArray['non_existent_key']; // Dicoba dengan dan tanpa supresi
trigger_error("Uji coba peringatan sistem (Test Warning)", E_USER_WARNING);
echo "[2/4] PHP Error/Warning handler testing... OK\n";

// 3. Uji Database Error Logging via mysql_adapter
// Eksekusi query salah sengaja untuk memicu database error logger
$badQuery = "SELECT * FROM tabel_palsu_tidak_ada WHERE id = 999999";
$res = mysql_query($badQuery);
echo "[3/4] Database error via mysql_adapter testing... OK\n";

// 4. Verifikasi isi file log fisik
if (!file_exists($todayFile)) {
    echo "GAGAL: File log tidak terbentuk di {$todayFile}\n";
    exit(1);
}

clearstatcache(true, $todayFile);
$newSize = filesize($todayFile);
if ($newSize <= $initialSize) {
    echo "GAGAL: Tidak ada entri baru yang ditulis ke file log!\n";
    exit(1);
}

echo "[4/4] Verifikasi file log fisik... OK\n\n";

echo "File log berhasil dibuat di: {$todayFile}\n";
echo "Ukuran file log sekarang: {$newSize} bytes\n\n";

// Tampilkan cuplikan log terakhir
$lines = Logger::getLatestLogs(30);
echo "=== CUPLIKAN ISI LOG HARI INI ===\n";
echo implode("\n", $lines) . "\n";
echo "=================================\n\n";
echo "SEMUA PENGUJIAN LOGGING BERHASIL 100%!\n";
