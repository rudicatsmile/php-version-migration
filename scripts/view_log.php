<?php
/**
 * CLI Log Viewer Helper for Simbada Application.
 * Usage:
 *   php scripts/view_log.php [lines] [date:YYYY-MM-DD]
 * Example:
 *   php scripts/view_log.php 50
 *   php scripts/view_log.php 100 2026-09-12
 */

require_once dirname(__DIR__) . '/bootstrap.php';

$lines = isset($argv[1]) ? (int)$argv[1] : 50;
$date  = isset($argv[2]) ? $argv[2] : date('Y-m-d');
$logFile = dirname(__DIR__) . "/logs/app-{$date}.log";

echo "====================================================================\n";
echo " SIMBADA ERROR LOG VIEWER (Target: {$date})\n";
echo " File: {$logFile}\n";
echo "====================================================================\n\n";

if (!file_exists($logFile)) {
    echo "Tidak ada file log untuk tanggal: {$date}\n";
    echo "Lokasi: {$logFile}\n";
    exit(0);
}

$content = file($logFile);
if ($content === false || empty($content)) {
    echo "File log kosong.\n";
    exit(0);
}

$totalLines = count($content);
$slice = array_slice($content, -$lines);

echo implode("", $slice);
echo "\n--- Menampilkan " . count($slice) . " dari {$totalLines} total baris log ---\n";
