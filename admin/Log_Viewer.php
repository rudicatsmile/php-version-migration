<?php
/**
 * SIMBADA BMD - Modern Web-based Error Log Viewer
 * Dedicated dashboard for administrators to inspect, filter, search, download, and clear system logs.
 */

require_once "CheckSession.php";
require_once "Connection.php";
require_once "FileFunction.php";
require_once "CheckLogin.php";

// Pastikan autoloader dan logger aktif
if (!class_exists('App\Logging\Logger')) {
    require_once dirname(__DIR__) . '/bootstrap.php';
}

// 1. Otorisasi: Khusus Administrator (Level <= 1)
if ((int)$Lev > 1) {
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Akses Ditolak - Simbada BMD</title>
        <style>
            body { font-family: system-ui, -apple-system, sans-serif; background: #f8fafc; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
            .box { background: white; padding: 32px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); text-align: center; max-width: 420px; }
            h2 { color: #dc2626; margin-top: 0; }
            p { color: #4b5563; line-height: 1.5; }
            a { display: inline-block; margin-top: 16px; padding: 10px 20px; background: #2563eb; color: white; text-decoration: none; border-radius: 6px; font-weight: 500; }
        </style>
    </head>
    <body>
        <div class="box">
            <h2>Akses Ditolak</h2>
            <p>Halaman Log Error Sistem hanya dapat diakses oleh Administrator (Level &le; 1).</p>
            <a href="Home.php?IdL=<?= htmlspecialchars($eIdL) ?>">Kembali ke Home</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// 2. Tangani Aksi: Unduh File Log Mentah (.log)
if (isset($_GET['action']) && $_GET['action'] === 'download') {
    $targetDate = isset($_GET['date']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_GET['date']) ? $_GET['date'] : date('Y-m-d');
    $filePath = \App\Logging\Logger::getLogFilePath($targetDate);

    if ($filePath !== null && file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: text/plain; charset=utf-8');
        header('Content-Disposition: attachment; filename="simbada-log-' . $targetDate . '.log"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        header('Location: Log_Viewer.php?IdL=' . urlencode($eIdL) . '&date=' . urlencode($targetDate) . '&error=not_found');
        exit;
    }
}

// 3. Tangani Aksi: Bersihkan / Kosongkan Log
$flashMessage = '';
$flashType = 'info';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'clear') {
    $targetDate = isset($_POST['date']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['date']) ? $_POST['date'] : date('Y-m-d');
    if (\App\Logging\Logger::clearLog($targetDate)) {
        $flashMessage = "File log tanggal {$targetDate} berhasil dibersihkan.";
        $flashType = 'success';
    } else {
        $flashMessage = "Gagal membersihkan file log tanggal {$targetDate}.";
        $flashType = 'danger';
    }
}

// 4. Persiapan Data Awal Server-Side
$availableDates = \App\Logging\Logger::getAvailableLogDates();
$selectedDate = isset($_GET['date']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_GET['date']) ? $_GET['date'] : date('Y-m-d');

// Pastikan tanggal terpilih ada di opsi meskipun belum ada file
if (!in_array($selectedDate, $availableDates, true)) {
    array_unshift($availableDates, $selectedDate);
}

$initialData = \App\Logging\Logger::parseLogFile($selectedDate, 'ALL', null, 100);
$stats = $initialData['stats'];
$logFilePath = \App\Logging\Logger::getLogFilePath($selectedDate);
$fileSizeHuman = ($logFilePath !== null && file_exists($logFilePath)) ? round(filesize($logFilePath) / 1024, 2) . ' KB' : '0 B';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Error Sistem - Simbada BMD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --bg-card-subtle: #f1f5f9;
            --border-color: #e2e8f0;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --text-dim: #94a3b8;
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --danger: #dc2626;
            --danger-bg: #fef2f2;
            --warning: #d97706;
            --warning-bg: #fffbeb;
            --purple: #7c3aed;
            --purple-bg: #f5f3ff;
            --info: #0284c7;
            --info-bg: #f0f9ff;
            --success: #16a34a;
            --code-bg: #1e293b;
            --code-text: #f8fafc;
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
        }

        [data-theme="dark"] {
            --bg-body: #090d16;
            --bg-card: #111827;
            --bg-card-subtle: #1f2937;
            --border-color: #374151;
            --text-main: #f9fafb;
            --text-muted: #9ca3af;
            --text-dim: #6b7280;
            --primary: #3b82f6;
            --primary-hover: #60a5fa;
            --danger: #ef4444;
            --danger-bg: rgba(239, 68, 68, 0.15);
            --warning: #f59e0b;
            --warning-bg: rgba(245, 158, 11, 0.15);
            --purple: #a855f7;
            --purple-bg: rgba(168, 85, 247, 0.15);
            --info: #38bdf8;
            --info-bg: rgba(56, 189, 248, 0.15);
            --success: #22c55e;
            --code-bg: #0b0f19;
            --code-text: #e2e8f0;
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.5);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
        }

        * { box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            padding: 24px;
            transition: background-color 0.2s, color 0.2s;
        }

        .container {
            max-width: 1300px;
            margin: 0 auto;
        }

        /* Top Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }
        .header-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .header-title h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .header-badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 9999px;
            background: var(--primary);
            color: #fff;
        }
        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 8px;
            border: 1px solid transparent;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s ease;
        }
        .btn-default {
            background: var(--bg-card);
            color: var(--text-main);
            border-color: var(--border-color);
        }
        .btn-default:hover {
            background: var(--bg-card-subtle);
        }
        .btn-primary {
            background: var(--primary);
            color: #fff;
        }
        .btn-primary:hover {
            background: var(--primary-hover);
        }
        .btn-danger {
            background: var(--danger);
            color: #fff;
        }
        .btn-danger:hover {
            opacity: 0.9;
        }

        /* Flash Alert */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-danger { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px;
            box-shadow: var(--shadow);
            cursor: pointer;
            transition: transform 0.15s, border-color 0.15s;
        }
        .stat-card:hover, .stat-card.active {
            transform: translateY(-2px);
            border-color: var(--primary);
        }
        .stat-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 6px;
        }
        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
        }
        .stat-card.c-all .stat-value { color: var(--text-main); }
        .stat-card.c-db .stat-value { color: var(--danger); }
        .stat-card.c-fatal .stat-value { color: var(--danger); }
        .stat-card.c-exc .stat-value { color: var(--purple); }
        .stat-card.c-warn .stat-value { color: var(--warning); }
        .stat-card.c-info .stat-value { color: var(--info); }

        /* Controls / Filter Toolbar */
        .toolbar {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow);
        }
        .toolbar-left, .toolbar-right {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }
        .form-select, .form-input {
            padding: 8px 12px;
            font-size: 0.875rem;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background-color: var(--bg-card-subtle);
            color: var(--text-main);
            font-family: inherit;
            outline: none;
            transition: border-color 0.15s;
        }
        .form-select:focus, .form-input:focus {
            border-color: var(--primary);
        }
        .search-box {
            position: relative;
            min-width: 260px;
        }
        .search-box input {
            width: 100%;
            padding-left: 32px;
        }
        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-dim);
            font-size: 0.875rem;
        }

        /* Filter Pills */
        .filter-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 20px;
        }
        .pill {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.15s;
        }
        .pill:hover {
            border-color: var(--primary);
            color: var(--primary);
        }
        .pill.active {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        /* Log Entries List */
        .log-meta-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 0.875rem;
            color: var(--text-muted);
        }
        .log-entries {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .log-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px;
            box-shadow: var(--shadow);
            transition: border-color 0.15s;
        }
        .log-card:hover {
            border-color: #94a3b8;
        }
        .log-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }
        .log-badges {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
        }
        .badge {
            font-size: 0.725rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .badge-DATABASE_ERROR { background: var(--danger-bg); color: var(--danger); border: 1px solid var(--danger); }
        .badge-FATAL { background: var(--danger-bg); color: var(--danger); border: 1px solid var(--danger); }
        .badge-FATAL_SHUTDOWN { background: var(--danger-bg); color: var(--danger); border: 1px solid var(--danger); }
        .badge-EXCEPTION { background: var(--purple-bg); color: var(--purple); border: 1px solid var(--purple); }
        .badge-WARNING { background: var(--warning-bg); color: var(--warning); border: 1px solid var(--warning); }
        .badge-INFO { background: var(--info-bg); color: var(--info); border: 1px solid var(--info); }
        .badge-ref { background: var(--bg-card-subtle); color: var(--text-main); font-family: 'JetBrains Mono', monospace; font-size: 0.725rem; border: 1px solid var(--border-color); }

        .log-time {
            font-size: 0.8rem;
            font-family: 'JetBrains Mono', monospace;
            color: var(--text-muted);
        }
        .log-context {
            font-size: 0.8rem;
            font-family: 'JetBrains Mono', monospace;
            color: var(--text-muted);
            background: var(--bg-card-subtle);
            padding: 2px 6px;
            border-radius: 4px;
        }

        .log-message {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-main);
            margin: 0 0 8px 0;
            line-height: 1.4;
            word-break: break-word;
        }
        .log-location {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.775rem;
            color: var(--text-muted);
            margin-bottom: 8px;
            display: inline-block;
            background: var(--bg-card-subtle);
            padding: 3px 8px;
            border-radius: 4px;
        }

        /* Expandable Blocks */
        .collapsible-trigger {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
            cursor: pointer;
            background: none;
            border: none;
            padding: 4px 0;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .collapsible-trigger:hover { text-decoration: underline; }
        .collapsible-content {
            display: none;
            margin-top: 8px;
        }
        .collapsible-content.show {
            display: block;
        }
        .code-block {
            background: var(--code-bg);
            color: var(--code-text);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            padding: 12px;
            border-radius: 8px;
            overflow-x: auto;
            white-space: pre-wrap;
            word-break: break-all;
            margin: 6px 0 0 0;
            border: 1px solid var(--border-color);
        }
        .code-block.sql {
            color: #38bdf8;
        }

        /* Empty State */
        .empty-state {
            background: var(--bg-card);
            border: 1px dashed var(--border-color);
            border-radius: 12px;
            padding: 48px 24px;
            text-align: center;
            color: var(--text-muted);
        }
        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 12px;
        }
        .empty-state h3 {
            margin: 0 0 8px 0;
            color: var(--text-main);
        }

        /* Modal Confirmation */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(2px);
            z-index: 999;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.show { display: flex; }
        .modal {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 24px;
            max-width: 440px;
            width: 90%;
            box-shadow: var(--shadow-lg);
        }
        .modal h3 { margin-top: 0; color: var(--danger); }
        .modal p { color: var(--text-muted); font-size: 0.9rem; line-height: 1.5; }
        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 0.6s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        @media (max-width: 768px) {
            body { padding: 16px; }
            .header { flex-direction: column; align-items: flex-start; }
            .toolbar { flex-direction: column; align-items: stretch; }
            .toolbar-left, .toolbar-right { justify-content: space-between; }
            .search-box { min-width: 100%; }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Top Header -->
    <div class="header">
        <div class="header-title">
            <span style="font-size: 1.75rem;">🛡️</span>
            <div>
                <h1>Log Error Sistem <span class="header-badge">PHP 8.4</span></h1>
                <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 2px;">
                    Simbada BMD — Pemantauan & Investigasi Kesalahan Runtime
                </div>
            </div>
        </div>
        <div class="header-actions">
            <button id="themeToggle" class="btn btn-default" title="Ganti Tema">
                <span id="themeIcon">🌙</span> <span id="themeText">Dark</span>
            </button>
            <a href="Home.php?IdL=<?= htmlspecialchars($eIdL) ?>" class="btn btn-default" title="Kembali ke Dashboard Utama">
                ⬅️ Kembali ke Home
            </a>
        </div>
    </div>

    <!-- Flash Message -->
    <?php if (!empty($flashMessage)): ?>
        <div class="alert alert-<?= $flashType ?>">
            <span><?= htmlspecialchars($flashMessage) ?></span>
            <button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;font-weight:bold;">&times;</button>
        </div>
    <?php endif; ?>

    <!-- Summary Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card c-all active" onclick="setFilterLevel('ALL')">
            <div class="stat-label">Total Catatan</div>
            <div class="stat-value" id="stat-all"><?= $stats['ALL'] ?></div>
        </div>
        <div class="stat-card c-db" onclick="setFilterLevel('DATABASE_ERROR')">
            <div class="stat-label">Database Error</div>
            <div class="stat-value" id="stat-db"><?= $stats['DATABASE_ERROR'] ?></div>
        </div>
        <div class="stat-card c-fatal" onclick="setFilterLevel('FATAL')">
            <div class="stat-label">Fatal Shutdown</div>
            <div class="stat-value" id="stat-fatal"><?= $stats['FATAL'] ?></div>
        </div>
        <div class="stat-card c-exc" onclick="setFilterLevel('EXCEPTION')">
            <div class="stat-label">Exceptions</div>
            <div class="stat-value" id="stat-exc"><?= $stats['EXCEPTION'] ?></div>
        </div>
        <div class="stat-card c-warn" onclick="setFilterLevel('WARNING')">
            <div class="stat-label">Warnings</div>
            <div class="stat-value" id="stat-warn"><?= $stats['WARNING'] ?></div>
        </div>
        <div class="stat-card c-info" onclick="setFilterLevel('INFO')">
            <div class="stat-label">Info / Notice</div>
            <div class="stat-value" id="stat-info"><?= $stats['INFO'] ?></div>
        </div>
    </div>

    <!-- Filter & Action Toolbar -->
    <div class="toolbar">
        <div class="toolbar-left">
            <label style="font-size: 0.85rem; font-weight: 600; color: var(--text-muted);" for="dateSelect">Tanggal:</label>
            <select id="dateSelect" class="form-select" onchange="changeDate(this.value)">
                <?php foreach ($availableDates as $d): ?>
                    <option value="<?= htmlspecialchars($d) ?>" <?= $d === $selectedDate ? 'selected' : '' ?>>
                        <?= htmlspecialchars($d) ?> <?= $d === date('Y-m-d') ? '(Hari ini)' : '' ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="search-box">
                <span class="search-icon">🔍</span>
                <input type="text" id="searchInput" class="form-input" placeholder="Cari pesan, file, RefID, SQL..." oninput="debounceSearch()">
            </div>

            <select id="limitSelect" class="form-select" onchange="changeLimit(this.value)">
                <option value="50">50 Baris</option>
                <option value="100" selected>100 Baris</option>
                <option value="250">250 Baris</option>
                <option value="500">500 Baris</option>
                <option value="0">Tampilkan Semua</option>
            </select>
        </div>

        <div class="toolbar-right">
            <button class="btn btn-default" onclick="fetchLogs()" title="Muat Ulang Log">
                🔄 Segarkan
            </button>
            <a id="btnDownload" href="Log_Viewer.php?IdL=<?= htmlspecialchars($eIdL) ?>&date=<?= htmlspecialchars($selectedDate) ?>&action=download" class="btn btn-primary" title="Unduh file log mentah">
                📥 Unduh .log (<span id="fileSizeBadge"><?= $fileSizeHuman ?></span>)
            </a>
            <button class="btn btn-danger" onclick="openClearModal()" title="Kosongkan log tanggal ini">
                🗑️ Bersihkan
            </button>
        </div>
    </div>

    <!-- Filter Level Pills -->
    <div class="filter-pills">
        <button class="pill active" data-level="ALL" onclick="setFilterLevel('ALL')">Semua Level</button>
        <button class="pill" data-level="DATABASE_ERROR" onclick="setFilterLevel('DATABASE_ERROR')">Database Error</button>
        <button class="pill" data-level="FATAL" onclick="setFilterLevel('FATAL')">Fatal</button>
        <button class="pill" data-level="EXCEPTION" onclick="setFilterLevel('EXCEPTION')">Exception</button>
        <button class="pill" data-level="WARNING" onclick="setFilterLevel('WARNING')">Warning</button>
        <button class="pill" data-level="INFO" onclick="setFilterLevel('INFO')">Info</button>
    </div>

    <!-- Log Entries List Header -->
    <div class="log-meta-bar">
        <div>
            Menampilkan <strong id="lblReturned"><?= count($initialData['entries']) ?></strong> dari <strong id="lblTotal"><?= $initialData['total'] ?></strong> catatan terfilter.
        </div>
        <div id="lblStatus" style="font-size: 0.8rem; color: var(--text-dim);">
            Terakhir dimuat: <?= date('H:i:s') ?>
        </div>
    </div>

    <!-- Log Entries Container -->
    <div id="logList" class="log-entries">
        <?php if (empty($initialData['entries'])): ?>
            <div class="empty-state">
                <div class="empty-state-icon">🎉</div>
                <h3>Tidak Ada Catatan Error</h3>
                <p>Tidak ada log kesalahan yang tercatat pada tanggal <strong><?= htmlspecialchars($selectedDate) ?></strong> atau filter saat ini.</p>
            </div>
        <?php else: ?>
            <?php foreach ($initialData['entries'] as $idx => $entry): ?>
                <?php
                    $lvl = $entry['level'];
                    $badgeClass = 'badge-' . (strpos($lvl, 'FATAL') !== false ? 'FATAL' : $lvl);
                ?>
                <div class="log-card" data-level="<?= htmlspecialchars($lvl) ?>">
                    <div class="log-card-header">
                        <div class="log-badges">
                            <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($lvl) ?></span>
                            <?php if (!empty($entry['ref_id'])): ?>
                                <span class="badge badge-ref">#<?= htmlspecialchars($entry['ref_id']) ?></span>
                            <?php endif; ?>
                            <?php if (!empty($entry['context'])): ?>
                                <span class="log-context"><?= htmlspecialchars($entry['context']) ?></span>
                            <?php endif; ?>
                            <?php if (!empty($entry['ip'])): ?>
                                <span class="log-context">IP: <?= htmlspecialchars($entry['ip']) ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="log-time"><?= htmlspecialchars($entry['timestamp']) ?></div>
                    </div>

                    <div class="log-message"><?= htmlspecialchars($entry['message']) ?></div>

                    <?php if (!empty($entry['location'])): ?>
                        <div class="log-location">📍 <?= htmlspecialchars($entry['location']) ?></div>
                    <?php endif; ?>

                    <?php if (!empty($entry['sql_query'])): ?>
                        <div>
                            <button class="collapsible-trigger" onclick="toggleBlock('sql-<?= $idx ?>')">
                                <span>▶</span> Query SQL Terkait
                            </button>
                            <div id="sql-<?= $idx ?>" class="collapsible-content">
                                <pre class="code-block sql"><?= htmlspecialchars($entry['sql_query']) ?></pre>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($entry['stack_trace'])): ?>
                        <div>
                            <button class="collapsible-trigger" onclick="toggleBlock('trace-<?= $idx ?>')">
                                <span>▶</span> Call Stack Trace
                            </button>
                            <div id="trace-<?= $idx ?>" class="collapsible-content">
                                <pre class="code-block"><?= htmlspecialchars($entry['stack_trace']) ?></pre>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Clear Log Confirmation Modal -->
<div id="clearModal" class="modal-overlay">
    <div class="modal">
        <h3>Konfirmasi Pengosongan Log</h3>
        <p>
            Apakah Anda yakin ingin mengosongkan seluruh isi log error untuk tanggal <strong id="modalDateLabel"><?= htmlspecialchars($selectedDate) ?></strong>?
        </p>
        <p style="color: var(--danger); font-size: 0.8rem;">
            ⚠️ Tindakan ini akan menghapus jejak error pada file log tersebut dan tidak dapat dibatalkan.
        </p>
        <form method="POST" action="Log_Viewer.php?IdL=<?= htmlspecialchars($eIdL) ?>">
            <input type="hidden" name="action" value="clear">
            <input type="hidden" name="date" id="clearDateInput" value="<?= htmlspecialchars($selectedDate) ?>">
            <div class="modal-actions">
                <button type="button" class="btn btn-default" onclick="closeClearModal()">Batal</button>
                <button type="submit" class="btn btn-danger">Ya, Kosongkan Log</button>
            </div>
        </form>
    </div>
</div>

<script>
    // State Aplikasi
    let state = {
        idL: '<?= htmlspecialchars($eIdL) ?>',
        date: '<?= htmlspecialchars($selectedDate) ?>',
        level: 'ALL',
        search: '',
        limit: 100,
        searchTimer: null
    };

    // Dark / Light Theme Toggle dengan LocalStorage
    const themeToggleBtn = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const themeText = document.getElementById('themeText');

    function applyTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            themeIcon.textContent = '☀️';
            themeText.textContent = 'Light';
        } else {
            document.documentElement.removeAttribute('data-theme');
            themeIcon.textContent = '🌙';
            themeText.textContent = 'Dark';
        }
        localStorage.setItem('simbada_log_theme', theme);
    }

    const savedTheme = localStorage.getItem('simbada_log_theme') || 
        (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    applyTheme(savedTheme);

    themeToggleBtn.addEventListener('click', () => {
        const currentTheme = document.documentElement.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
        applyTheme(currentTheme === 'dark' ? 'light' : 'dark');
    });

    // Ubah Tanggal
    function changeDate(val) {
        state.date = val;
        document.getElementById('btnDownload').href = `Log_Viewer.php?IdL=${encodeURIComponent(state.idL)}&date=${encodeURIComponent(state.date)}&action=download`;
        document.getElementById('clearDateInput').value = state.date;
        document.getElementById('modalDateLabel').textContent = state.date;
        fetchLogs();
    }

    // Ubah Level Filter
    function setFilterLevel(level) {
        state.level = level;
        document.querySelectorAll('.pill').forEach(el => {
            el.classList.toggle('active', el.getAttribute('data-level') === level);
        });
        document.querySelectorAll('.stat-card').forEach(el => {
            el.classList.remove('active');
        });
        fetchLogs();
    }

    // Ubah Limit
    function changeLimit(val) {
        state.limit = parseInt(val, 10);
        fetchLogs();
    }

    // Search dengan Debounce (300ms)
    function debounceSearch() {
        clearTimeout(state.searchTimer);
        state.searchTimer = setTimeout(() => {
            state.search = document.getElementById('searchInput').value.trim();
            fetchLogs();
        }, 300);
    }

    // Toggle Expandable Block
    function toggleBlock(id) {
        const el = document.getElementById(id);
        if (!el) return;
        const isShown = el.classList.toggle('show');
        const trigger = el.previousElementSibling;
        if (trigger && trigger.querySelector('span')) {
            trigger.querySelector('span').textContent = isShown ? '▼' : '▶';
        }
    }

    // AJAX Fetch Data Log
    async function fetchLogs() {
        const lblStatus = document.getElementById('lblStatus');
        lblStatus.textContent = 'Memuat data...';

        try {
            const url = `Log_Viewer_Data.php?IdL=${encodeURIComponent(state.idL)}&date=${encodeURIComponent(state.date)}&level=${encodeURIComponent(state.level)}&search=${encodeURIComponent(state.search)}&limit=${encodeURIComponent(state.limit)}`;
            const response = await fetch(url);
            const data = await response.json();

            if (data.status !== 'success') {
                throw new Error(data.message || 'Gagal mengambil data');
            }

            // Update Statistik
            document.getElementById('stat-all').textContent = data.stats.ALL || 0;
            document.getElementById('stat-db').textContent = data.stats.DATABASE_ERROR || 0;
            document.getElementById('stat-fatal').textContent = data.stats.FATAL || 0;
            document.getElementById('stat-exc').textContent = data.stats.EXCEPTION || 0;
            document.getElementById('stat-warn').textContent = data.stats.WARNING || 0;
            document.getElementById('stat-info').textContent = data.stats.INFO || 0;

            document.getElementById('lblReturned').textContent = data.countReturned;
            document.getElementById('lblTotal').textContent = data.totalFiltered;
            document.getElementById('fileSizeBadge').textContent = data.fileSizeHuman;

            // Render Log Cards
            const container = document.getElementById('logList');
            if (!data.entries || data.entries.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">🎉</div>
                        <h3>Tidak Ada Catatan Error</h3>
                        <p>Tidak ada log kesalahan yang tercatat pada tanggal <strong>${escapeHtml(state.date)}</strong> dengan kriteria filter saat ini.</p>
                    </div>
                `;
            } else {
                let html = '';
                data.entries.forEach((entry, idx) => {
                    const normLevel = entry.level.includes('FATAL') ? 'FATAL' : entry.level;
                    const badgeClass = `badge-${normLevel}`;

                    html += `
                        <div class="log-card" data-level="${escapeHtml(entry.level)}">
                            <div class="log-card-header">
                                <div class="log-badges">
                                    <span class="badge ${badgeClass}">${escapeHtml(entry.level)}</span>
                                    ${entry.ref_id ? `<span class="badge badge-ref">#${escapeHtml(entry.ref_id)}</span>` : ''}
                                    ${entry.context ? `<span class="log-context">${escapeHtml(entry.context)}</span>` : ''}
                                    ${entry.ip ? `<span class="log-context">IP: ${escapeHtml(entry.ip)}</span>` : ''}
                                </div>
                                <div class="log-time">${escapeHtml(entry.timestamp)}</div>
                            </div>
                            <div class="log-message">${escapeHtml(entry.message)}</div>
                            ${entry.location ? `<div class="log-location">📍 ${escapeHtml(entry.location)}</div>` : ''}
                            ${entry.sql_query ? `
                                <div>
                                    <button class="collapsible-trigger" onclick="toggleBlock('ajax-sql-${idx}')">
                                        <span>▶</span> Query SQL Terkait
                                    </button>
                                    <div id="ajax-sql-${idx}" class="collapsible-content">
                                        <pre class="code-block sql">${escapeHtml(entry.sql_query)}</pre>
                                    </div>
                                </div>
                            ` : ''}
                            ${entry.stack_trace ? `
                                <div>
                                    <button class="collapsible-trigger" onclick="toggleBlock('ajax-trace-${idx}')">
                                        <span>▶</span> Call Stack Trace
                                    </button>
                                    <div id="ajax-trace-${idx}" class="collapsible-content">
                                        <pre class="code-block">${escapeHtml(entry.stack_trace)}</pre>
                                    </div>
                                </div>
                            ` : ''}
                        </div>
                    `;
                });
                container.innerHTML = html;
            }

            const now = new Date();
            lblStatus.textContent = 'Terakhir dimuat: ' + now.toTimeString().split(' ')[0];
        } catch (err) {
            lblStatus.textContent = 'Error: ' + err.message;
        }
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Modal Control
    function openClearModal() {
        document.getElementById('clearModal').classList.add('show');
    }
    function closeClearModal() {
        document.getElementById('clearModal').classList.remove('show');
    }
    window.addEventListener('click', (e) => {
        if (e.target === document.getElementById('clearModal')) {
            closeClearModal();
        }
    });
</script>

</body>
</html>
