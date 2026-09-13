<?php

declare(strict_types=1);

namespace App\Logging;

use Throwable;

class Logger
{
    private static string $logDir = '';
    private static string $environment = 'development';
    private static bool $isInitialized = false;

    /**
     * Inisialisasi sistem logging dan pasang global handlers.
     * Kompatibel penuh dengan PHP 8.2, 8.3, 8.4 dan versi transisi.
     */
    public static function init(string $logDir, string $environment = 'development', ?bool $displayErrors = null): void
    {
        if (self::$isInitialized) {
            return;
        }

        self::$logDir = rtrim($logDir, '/\\');
        self::$environment = strtolower($environment);

        if (!is_dir(self::$logDir)) {
            @mkdir(self::$logDir, 0755, true);
        }

        // Konfigurasi PHP error display sesuai opsi eksplisit atau mode environment
        if ($displayErrors !== null) {
            $showErrors = $displayErrors ? '1' : '0';
            ini_set('display_errors', $showErrors);
            ini_set('display_startup_errors', $showErrors);
            ini_set('log_errors', '1');
            error_reporting(E_ALL);
        } elseif (self::$environment === 'production') {
            ini_set('display_errors', '0');
            ini_set('display_startup_errors', '0');
            ini_set('log_errors', '1');
            error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
        } else {
            ini_set('display_errors', '1');
            ini_set('display_startup_errors', '1');
            ini_set('log_errors', '1');
            error_reporting(E_ALL);
        }

        // Daftarkan global handlers
        set_error_handler([self::class, 'handleError']);
        set_exception_handler([self::class, 'handleException']);
        register_shutdown_function([self::class, 'handleShutdown']);

        self::$isInitialized = true;
    }

    /**
     * Menangani PHP errors (Warning, Notice, Deprecated, dll).
     */
    public static function handleError(int $errno, string $errstr, string $errfile, int $errline): bool
    {
        // Hormati operator supresi '@' jika digunakan
        if (!(error_reporting() & $errno)) {
            return false;
        }

        switch ($errno) {
            case E_ERROR:
            case E_USER_ERROR:
                $level = 'ERROR';
                break;
            case E_WARNING:
            case E_USER_WARNING:
                $level = 'WARNING';
                break;
            case E_NOTICE:
            case E_USER_NOTICE:
                $level = 'NOTICE';
                break;
            case E_DEPRECATED:
            case E_USER_DEPRECATED:
                $level = 'DEPRECATED';
                break;
            default:
                $level = 'PHP_ERROR (' . $errno . ')';
                break;
        }

        self::writeEntry($level, $errstr, [
            'file' => $errfile,
            'line' => $errline,
        ]);

        // Jika error fatal user, hentikan proses
        if ($errno === E_USER_ERROR) {
            if (self::$environment === 'production') {
                self::renderProductionErrorPage();
            }
            exit(1);
        }

        return false;
    }

    /**
     * Menangani Uncaught Exceptions / Throwables.
     */
    public static function handleException(Throwable $e): void
    {
        $refId = substr(md5(uniqid((string)mt_rand(), true)), 0, 8);

        self::writeEntry('UNCAUGHT_EXCEPTION', $e->getMessage(), [
            'ref_id'    => $refId,
            'class'     => get_class($e),
            'code'      => $e->getCode(),
            'file'      => $e->getFile(),
            'line'      => $e->getLine(),
            'trace'     => $e->getTraceAsString(),
        ]);

        if (self::$environment === 'production') {
            self::renderProductionErrorPage($refId);
        } else {
            echo "<div style='background:#f8d7da; color:#721c24; padding:20px; border:1px solid #f5c6cb; font-family:sans-serif; margin:20px;'>";
            echo "<h3>[Development Mode] Uncaught Exception</h3>";
            echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
            echo "<p><strong>Class:</strong> " . get_class($e) . "</p>";
            echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . " on line <strong>" . $e->getLine() . "</strong></p>";
            echo "<pre style='background:#fff; padding:10px; border:1px solid #ccc; overflow-x:auto;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
            echo "</div>";
        }
        exit(1);
    }

    /**
     * Menangani Fatal Errors pada akhir eksekusi (E_ERROR, E_PARSE, Memory Limit).
     */
    public static function handleShutdown(): void
    {
        $error = error_get_last();
        if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR], true)) {
            $refId = substr(md5(uniqid((string)mt_rand(), true)), 0, 8);

            self::writeEntry('FATAL_SHUTDOWN', $error['message'], [
                'ref_id' => $refId,
                'file'   => $error['file'],
                'line'   => $error['line'],
            ]);

            if (self::$environment === 'production') {
                self::renderProductionErrorPage($refId);
            }
        }
    }

    /**
     * Menangani pencatatan Database Query Error secara terstruktur.
     */
    public static function logDatabaseError(string $query, string $error, int $errno = 0, ?string $file = null, ?int $line = null): void
    {
        if ($file === null || $line === null) {
            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 6);
            foreach ($trace as $step) {
                if (isset($step['file']) && strpos($step['file'], 'mysql_adapter.php') === false && strpos($step['file'], 'Logger.php') === false) {
                    $file = $step['file'];
                    $line = isset($step['line']) ? $step['line'] : 0;
                    break;
                }
            }
        }

        self::writeEntry('DATABASE_ERROR', "Query Failed: {$error} (Errno: {$errno})", [
            'query' => trim($query),
            'file'  => $file !== null ? $file : 'unknown',
            'line'  => $line !== null ? $line : 0,
        ]);
    }

    /**
     * Menulis log kustom secara manual.
     *
     * @param array<string, mixed> $context
     */
    public static function log(string $level, string $message, array $context = []): void
    {
        self::writeEntry(strtoupper($level), $message, $context);
    }

    /**
     * Format dan tulis entri ke file harian logs/app-YYYY-MM-DD.log.
     *
     * @param array<string, mixed> $context
     */
    private static function writeEntry(string $level, string $message, array $context = []): void
    {
        if (empty(self::$logDir)) {
            self::$logDir = dirname(__DIR__, 2) . '/logs';
        }

        $dateStr = date('Y-m-d');
        $timeStr = date('Y-m-d H:i:s');
        $logFile = self::$logDir . '/app-' . $dateStr . '.log';

        // Deteksi konteks request
        $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'CLI';
        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : (isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '-');
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';

        $entry = "================================================================================\n";
        $entry .= "[{$timeStr}] [{$level}] [{$method} {$uri}] [IP: {$ip}]\n";
        if (isset($context['ref_id'])) {
            $entry .= "Ref ID   : #{$context['ref_id']}\n";
        }
        $entry .= "Message  : {$message}\n";

        if (isset($context['file'])) {
            $entry .= "Location : {$context['file']}:" . (isset($context['line']) ? $context['line'] : 0) . "\n";
        }

        if (isset($context['query'])) {
            $entry .= "SQL Query: {$context['query']}\n";
        }

        if (isset($context['trace'])) {
            $entry .= "Stack Trace:\n{$context['trace']}\n";
        }
        $entry .= "================================================================================\n\n";

        @file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);
    }

    /**
     * Tampilan error umum dan aman untuk mode produksi.
     */
    private static function renderProductionErrorPage(string $refId = ''): void
    {
        if (ob_get_level() > 0) {
            @ob_end_clean();
        }

        http_response_code(500);
        echo "<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Terjadi Gangguan Sistem</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f8f9fa; color: #333; display: flex; align-items: center; justify-content: center; min-height: 80vh; margin: 0; }
        .card { background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); max-width: 500px; text-align: center; border-top: 4px solid #dc3545; }
        h2 { color: #dc3545; margin-top: 0; }
        p { color: #6c757d; line-height: 1.6; }
        .ref { font-family: monospace; background: #e9ecef; padding: 4px 8px; border-radius: 4px; color: #495057; font-size: 13px; display: inline-block; margin-top: 10px; }
        .btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #007bff; color: #fff; text-decoration: none; border-radius: 4px; font-weight: bold; }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class='card'>
        <h2>Mohon Maaf, Terjadi Kesalahan Sistem</h2>
        <p>Permintaan Anda saat ini tidak dapat diproses oleh server. Tim teknis telah menerima notifikasi insiden ini.</p>";
        if ($refId !== '') {
            echo "<div class='ref'>ID Referensi: #{$refId}</div>";
        }
        echo "<br>
        <a href='index.php' class='btn'>Kembali ke Beranda</a>
    </div>
</body>
</html>";
    }

    /**
     * Membaca N baris terakhir dari file log hari ini.
     *
     * @return array<int, string>
     */
    public static function getLatestLogs(int $maxLines = 50, ?string $date = null): array
    {
        $dateStr = $date !== null ? $date : date('Y-m-d');
        $logFile = self::getLogDirectory() . '/app-' . $dateStr . '.log';

        if (!file_exists($logFile)) {
            return [];
        }

        $lines = @file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return [];
        }

        return array_slice($lines, -$maxLines);
    }

    /**
     * Mendapatkan direktori log saat ini.
     */
    public static function getLogDirectory(): string
    {
        if (empty(self::$logDir)) {
            self::$logDir = dirname(__DIR__, 2) . '/logs';
        }
        return self::$logDir;
    }

    /**
     * Mendapatkan daftar tanggal file log yang tersedia (diurutkan dari yang terbaru).
     *
     * @return array<int, string>
     */
    public static function getAvailableLogDates(): array
    {
        $dir = self::getLogDirectory();
        if (!is_dir($dir)) {
            return [];
        }

        $files = glob($dir . '/app-*.log');
        if ($files === false || empty($files)) {
            return [];
        }

        $dates = [];
        foreach ($files as $file) {
            $base = basename($file);
            if (preg_match('/^app-(\d{4}-\d{2}-\d{2})\.log$/', $base, $m)) {
                $dates[] = $m[1];
            }
        }

        rsort($dates);
        return $dates;
    }

    /**
     * Mengambil path file log berdasarkan tanggal yang divalidasi.
     */
    public static function getLogFilePath(string $date): ?string
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return null;
        }

        $file = self::getLogDirectory() . "/app-{$date}.log";
        return file_exists($file) ? $file : null;
    }

    /**
     * Mem-parse isi file log tanggal tertentu menjadi daftar entri terstruktur.
     *
     * @return array{entries: array<int, array<string, mixed>>, stats: array<string, int>, total: int}
     */
    public static function parseLogFile(string $date, ?string $levelFilter = null, ?string $search = null, int $limit = 100): array
    {
        $stats = [
            'ALL' => 0,
            'DATABASE_ERROR' => 0,
            'FATAL' => 0,
            'EXCEPTION' => 0,
            'WARNING' => 0,
            'INFO' => 0,
        ];

        $filePath = self::getLogFilePath($date);
        if ($filePath === null) {
            return ['entries' => [], 'stats' => $stats, 'total' => 0];
        }

        $raw = @file_get_contents($filePath);
        if ($raw === false || trim($raw) === '') {
            return ['entries' => [], 'stats' => $stats, 'total' => 0];
        }

        // Pecah berdasarkan pembatas blok log
        $rawBlocks = explode("================================================================================", $raw);
        $allEntries = [];

        foreach ($rawBlocks as $block) {
            $block = trim($block);
            if (empty($block)) {
                continue;
            }

            $entry = [
                'timestamp'   => '',
                'level'       => 'INFO',
                'context'     => '',
                'ip'          => '',
                'ref_id'      => '',
                'message'     => '',
                'location'    => '',
                'sql_query'   => '',
                'stack_trace' => '',
                'raw'         => $block,
            ];

            $lines = explode("\n", $block);
            $readingTrace = false;
            $traceLines = [];

            foreach ($lines as $line) {
                $trimmed = trim($line);

                if ($readingTrace) {
                    $traceLines[] = $line;
                    continue;
                }

                // Header line format: [2026-09-12 18:42:53] [LEVEL] [METHOD URI] [IP: 127.0.0.1]
                if (preg_match('/^\[(.*?)\]\s+\[(.*?)\]\s+\[(.*?)\](?:\s+\[IP:\s+(.*?)\])?/', $trimmed, $m)) {
                    $entry['timestamp'] = $m[1];
                    $entry['level']     = strtoupper($m[2]);
                    $entry['context']   = $m[3];
                    $entry['ip']        = isset($m[4]) ? $m[4] : '';
                    continue;
                }

                if (preg_match('/^Ref ID\s*:\s*#(.*)$/i', $trimmed, $m)) {
                    $entry['ref_id'] = trim($m[1]);
                } elseif (preg_match('/^Message\s*:\s*(.*)$/i', $trimmed, $m)) {
                    $entry['message'] = trim($m[1]);
                } elseif (preg_match('/^Location\s*:\s*(.*)$/i', $trimmed, $m)) {
                    $entry['location'] = trim($m[1]);
                } elseif (preg_match('/^SQL Query\s*:\s*(.*)$/i', $trimmed, $m)) {
                    $entry['sql_query'] = trim($m[1]);
                } elseif (stripos($trimmed, 'Stack Trace:') === 0) {
                    $readingTrace = true;
                }
            }

            if (!empty($traceLines)) {
                $entry['stack_trace'] = trim(implode("\n", $traceLines));
            }

            // Normalisasi level ke grup statistik
            $normLevel = $entry['level'];
            if (strpos($normLevel, 'FATAL') !== false) {
                $normLevel = 'FATAL';
            } elseif ($normLevel === 'NOTICE' || $normLevel === 'DEPRECATED') {
                $normLevel = 'WARNING';
            }

            $stats['ALL']++;
            if (isset($stats[$normLevel])) {
                $stats[$normLevel]++;
            }

            $allEntries[] = $entry;
        }

        // Urutkan dari yang terbaru (reverse chronological)
        $allEntries = array_reverse($allEntries);

        // Filter Level
        $filtered = [];
        $levelFilter = $levelFilter !== null ? strtoupper(trim($levelFilter)) : 'ALL';
        $search = $search !== null ? trim($search) : '';

        foreach ($allEntries as $item) {
            if ($levelFilter !== 'ALL') {
                $itemLevel = $item['level'];
                if ($levelFilter === 'FATAL' && strpos($itemLevel, 'FATAL') === false) {
                    continue;
                } elseif ($levelFilter === 'WARNING' && $itemLevel !== 'WARNING' && $itemLevel !== 'NOTICE' && $itemLevel !== 'DEPRECATED') {
                    continue;
                } elseif ($levelFilter !== 'FATAL' && $levelFilter !== 'WARNING' && $itemLevel !== $levelFilter) {
                    continue;
                }
            }

            if ($search !== '') {
                $searchContent = $item['message'] . ' ' . $item['location'] . ' ' . $item['ref_id'] . ' ' . $item['sql_query'] . ' ' . $item['context'] . ' ' . $item['ip'];
                if (stripos($searchContent, $search) === false) {
                    continue;
                }
            }

            $filtered[] = $item;
        }

        $totalFiltered = count($filtered);
        if ($limit > 0 && $totalFiltered > $limit) {
            $filtered = array_slice($filtered, 0, $limit);
        }

        return [
            'entries' => $filtered,
            'stats'   => $stats,
            'total'   => $totalFiltered,
        ];
    }

    /**
     * Mengosongkan file log tertentu secara aman.
     */
    public static function clearLog(string $date): bool
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return false;
        }

        $file = self::getLogDirectory() . "/app-{$date}.log";
        if (!file_exists($file)) {
            return true;
        }

        $res = @file_put_contents($file, '', LOCK_EX);
        return $res !== false;
    }
}

