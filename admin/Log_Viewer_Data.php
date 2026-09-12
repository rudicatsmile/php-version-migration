<?php
/**
 * SIMBADA BMD - AJAX Endpoint for Error Log Viewer
 * Provides JSON data for log entries, filtering, search, and statistics.
 */

require_once "CheckSession.php";
require_once "Connection.php";
require_once "FileFunction.php";
require_once "CheckLogin.php";

// Set header JSON
header('Content-Type: application/json; charset=utf-8');

// Otorisasi: Khusus Administrator (Level <= 1)
if ((int)$Lev > 1) {
    http_response_code(403);
    echo json_encode([
        'status'  => 'error',
        'message' => 'Akses ditolak: Hanya Administrator (Level <= 1) yang diizinkan mengakses data log.',
    ]);
    exit;
}

// Inisialisasi Logger
if (!class_exists('App\Logging\Logger')) {
    require_once dirname(__DIR__) . '/bootstrap.php';
}

$date   = isset($_GET['date']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_GET['date']) ? $_GET['date'] : date('Y-m-d');
$level  = isset($_GET['level']) ? trim($_GET['level']) : 'ALL';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$limit  = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;

try {
    $result = \App\Logging\Logger::parseLogFile($date, $level, $search, $limit);
    $availableDates = \App\Logging\Logger::getAvailableLogDates();
    $filePath = \App\Logging\Logger::getLogFilePath($date);
    $fileSize = $filePath !== null && file_exists($filePath) ? filesize($filePath) : 0;

    echo json_encode([
        'status'         => 'success',
        'date'           => $date,
        'availableDates' => $availableDates,
        'fileSize'       => $fileSize,
        'fileSizeHuman'  => $fileSize > 0 ? round($fileSize / 1024, 2) . ' KB' : '0 B',
        'stats'          => $result['stats'],
        'totalFiltered'  => $result['total'],
        'countReturned'  => count($result['entries']),
        'entries'        => $result['entries'],
    ]);
} catch (\Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'status'  => 'error',
        'message' => 'Gagal memproses data log: ' . $e->getMessage(),
    ]);
}
