<?php
/**
 * Developer Mode File Inspector & Debug Bar for Simbada BMD
 * Automatically displays active PHP script names, file paths, included files, and execution metrics.
 */

namespace App\Dev;

class DevBar
{
    private static bool $initialized = false;
    private static float $startTime = 0.0;
    private static int $startMemory = 0;
    private static string $rootDir = '';
    private static bool $enabled = false;

    /**
     * Inisialisasi DevBar.
     */
    public static function init(string $environment = 'development', ?bool $forceState = null): void
    {
        if (self::$initialized) {
            return;
        }

        self::$startTime = microtime(true);
        self::$startMemory = memory_get_usage();
        self::$rootDir = dirname(__DIR__, 2);
        self::$initialized = true;

        // Tangani sakelar aktivasi via URL: ?dev_mode=1 / ?dev_mode=0
        if (isset($_GET['dev_mode'])) {
            $val = strtolower(trim((string)$_GET['dev_mode']));
            if ($val === '1' || $val === 'on' || $val === 'true') {
                @setcookie('simbada_dev_mode', '1', time() + (86400 * 30), '/');
                $_COOKIE['simbada_dev_mode'] = '1';
            } elseif ($val === '0' || $val === 'off' || $val === 'false') {
                @setcookie('simbada_dev_mode', '0', time() - 3600, '/');
                unset($_COOKIE['simbada_dev_mode']);
            }
        }

        // Keamanan: Di mode production, DevBar otomatis non-aktif penuh (hard-disabled)
        if ($environment === 'production') {
            self::$enabled = false;
            return;
        }

        // Tentukan status aktif di mode development
        if ($forceState !== null) {
            self::$enabled = $forceState;
        } elseif (isset($_COOKIE['simbada_dev_mode'])) {
            self::$enabled = $_COOKIE['simbada_dev_mode'] === '1';
        } elseif (defined('DEV_MODE')) {
            self::$enabled = (bool)DEV_MODE;
        } else {
            self::$enabled = true; // Default aktif di mode development
        }

        if (self::$enabled && php_sapi_name() !== 'cli') {
            ob_start([self::class, 'handleBuffer']);
        }
    }

    /**
     * Cek apakah DevBar sedang aktif.
     */
    public static function isEnabled(): bool
    {
        return self::$enabled;
    }

    /**
     * Handler Output Buffering: Menempelkan DevBar ke output HTML halaman.
     */
    public static function handleBuffer(string $buffer): string
    {
        if (!self::$enabled || trim($buffer) === '') {
            return $buffer;
        }

        // Jangan suntikkan jika request adalah AJAX (misal: jQuery .load, $.ajax, fetch, XHR)
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            return $buffer;
        }

        // Jangan suntikkan jika response bukan HTML (misal: JSON, PDF, Gambar, Unduhan)
        if (!self::isHtmlResponse($buffer)) {
            return $buffer;
        }

        // Hanya suntikkan jika dokumen memiliki penutup </body> atau </html> (dokumen HTML lengkap, bukan partial/fragment)
        if (stripos($buffer, '</body>') === false && stripos($buffer, '</html>') === false) {
            return $buffer;
        }

        try {
            $barHtml = self::renderBarHtml();
        } catch (\Throwable $e) {
            return $buffer;
        }

        // Cari posisi penyisipan terbaik: tepat sebelum kemunculan TERAKHIR </body> atau </html>
        // yang TIDAK berada di dalam blok <script> atau <style> (menghindari string JS/template)
        $bodyPos = self::findLastValidTagPosition($buffer, '</body>');
        if ($bodyPos !== false) {
            return substr_replace($buffer, $barHtml . '</body>', $bodyPos, strlen('</body>'));
        }

        $htmlPos = self::findLastValidTagPosition($buffer, '</html>');
        if ($htmlPos !== false) {
            return substr_replace($buffer, $barHtml . '</html>', $htmlPos, strlen('</html>'));
        }

        return $buffer;
    }

    /**
     * Mencari posisi kemunculan tag penutup terakhir yang valid (di luar blok <script> dan <style>).
     */
    private static function findLastValidTagPosition(string $buffer, string $tag): int|false
    {
        $offset = strlen($buffer);

        while (($pos = strripos(substr($buffer, 0, $offset), $tag)) !== false) {
            if (!self::isInsideScriptOrStyle($buffer, $pos)) {
                return $pos;
            }
            $offset = $pos;
            if ($offset <= 0) {
                break;
            }
        }

        return false;
    }

    /**
     * Memeriksa apakah posisi tertentu ($pos) berada di dalam blok <script>...</script> atau <style>...</style>.
     */
    private static function isInsideScriptOrStyle(string $buffer, int $pos): bool
    {
        if (preg_match_all('/<(script|style)\b[^>]*>.*?<\/\1>/is', $buffer, $matches, PREG_OFFSET_CAPTURE)) {
            foreach ($matches[0] as $match) {
                $start = (int)$match[1];
                $end = $start + strlen($match[0]);
                if ($pos >= $start && $pos < $end) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Memeriksa apakah buffer berisi dokumen HTML (bukan binary/json/download).
     */
    private static function isHtmlResponse(string $buffer): bool
    {
        // Periksa Content-Type header yang dikirim script
        foreach (headers_list() as $header) {
            if (stripos($header, 'Content-Type:') === 0) {
                $type = strtolower($header);
                // Jika MIME type secara eksplisit non-HTML
                if (
                    strpos($type, 'application/json') !== false ||
                    strpos($type, 'application/pdf') !== false ||
                    strpos($type, 'application/octet-stream') !== false ||
                    strpos($type, 'application/vnd') !== false ||
                    strpos($type, 'image/') !== false ||
                    strpos($type, 'text/plain') !== false ||
                    strpos($type, 'text/css') !== false ||
                    strpos($type, 'text/javascript') !== false
                ) {
                    return false;
                }
            }
        }

        // Cek indikator struktur tag HTML dokumen
        return stripos($buffer, '<html') !== false ||
               stripos($buffer, '<body') !== false ||
               stripos($buffer, '<!doctype') !== false;
    }

    /**
     * Merender antarmuka HTML/CSS/JS DevBar.
     */
    public static function renderBarHtml(): string
    {
        $execTime = round((microtime(true) - self::$startTime) * 1000, 2);
        $peakMem = round(memory_get_peak_usage(true) / 1024 / 1024, 2);

        // Identifikasi skrip utama yang dieksekusi
        $scriptPath = isset($_SERVER['SCRIPT_FILENAME']) ? realpath($_SERVER['SCRIPT_FILENAME']) : '';
        if (empty($scriptPath) && isset($_SERVER['SCRIPT_NAME'])) {
            $scriptPath = realpath(self::$rootDir . '/' . ltrim($_SERVER['SCRIPT_NAME'], '/'));
        }
        if (empty($scriptPath)) {
            $scriptPath = 'Unknown';
        }

        $normRoot = rtrim(str_replace('\\', '/', self::$rootDir), '/');
        $normScript = str_replace('\\', '/', $scriptPath);
        $relPath = str_replace($normRoot . '/', '', $normScript);
        $fileName = basename($scriptPath);

        // Daftar included files
        $includedFiles = get_included_files();
        $cleanIncludes = [];
        foreach ($includedFiles as $inc) {
            $normInc = str_replace('\\', '/', $inc);
            $cleanIncludes[] = str_replace($normRoot . '/', '', $normInc);
        }
        sort($cleanIncludes);

        $incCount = count($cleanIncludes);
        $uniqueId = 'devbar_' . substr(md5(uniqid((string)mt_rand(), true)), 0, 8);

        // Parameter request
        $getMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $getParams = $_GET;
        $postParams = $_POST;

        // Sanitasi password/token sensitif pada preview POST
        foreach (['password', 'pass', 'pwd', 'token', 'accessToken', 'key'] as $sensitiveKey) {
            if (isset($postParams[$sensitiveKey])) {
                $postParams[$sensitiveKey] = '****** [PROTECTED]';
            }
        }

        $getJson = htmlspecialchars(json_encode($getParams, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        $postJson = htmlspecialchars(json_encode($postParams, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        $safeFileName = htmlspecialchars($fileName);
        $slashFileName = addslashes($fileName);
        $safeRelPath = htmlspecialchars($relPath);
        $slashRelPath = addslashes($relPath);
        $safeScriptPath = htmlspecialchars($scriptPath);
        $slashScriptPath = addslashes($scriptPath);
        $safeMethod = htmlspecialchars($getMethod);
        $safeUri = htmlspecialchars($_SERVER['REQUEST_URI'] ?? '');
        $safeAppEnv = htmlspecialchars(defined('APP_ENV') ? APP_ENV : 'development');
        $phpVersion = PHP_VERSION;
        $phpSapi = php_sapi_name();
        $logViewerUrl = htmlspecialchars(strpos($_SERVER['REQUEST_URI'] ?? '', 'admin/') !== false ? 'Log_Viewer.php' : 'admin/Log_Viewer.php');
        $reqCount = count($getParams) + count($postParams);
        $getCount = count($getParams);
        $postCount = count($postParams);

        $includesHtml = '';
        foreach ($cleanIncludes as $idx => $incFile) {
            $itemNum = $idx + 1;
            $safeInc = htmlspecialchars($incFile);
            $includesHtml .= "                                <div class=\"devbar-list-item\">\n";
            $includesHtml .= "                                    <span>{$itemNum}. {$safeInc}</span>\n";
            $includesHtml .= "                                </div>\n";
        }

        return <<<HTML
        <!-- SIMBADA DEVELOPER MODE FILE INSPECTOR -->
        <style>
            #{$uniqueId}_root {
                all: initial;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
                font-size: 11px;
                line-height: 1.4;
                color: #e2e8f0;
                z-index: 2147483647;
                position: fixed;
                bottom: 8px;
                right: 8px;
                box-sizing: border-box;
                direction: ltr;
                text-align: left;
            }
            #{$uniqueId}_root * {
                box-sizing: border-box;
            }
            #{$uniqueId}_pill {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                background: rgba(15, 23, 42, 0.92);
                color: #f8fafc;
                padding: 4px 10px;
                border-radius: 9999px;
                border: 1px solid rgba(59, 130, 246, 0.4);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35);
                backdrop-filter: blur(6px);
                cursor: pointer;
                user-select: none;
                transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            }
            #{$uniqueId}_pill:hover {
                background: rgba(30, 41, 59, 0.98);
                border-color: #3b82f6;
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(0, 0, 0, 0.45);
            }
            #{$uniqueId}_pill .devbar-icon {
                color: #38bdf8;
                font-weight: bold;
                font-size: 12px;
            }
            #{$uniqueId}_pill .devbar-name {
                font-weight: 700;
                color: #ffffff;
                max-width: 220px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            #{$uniqueId}_pill .devbar-meta {
                color: #94a3b8;
                font-size: 10px;
                font-family: monospace;
            }
            #{$uniqueId}_drawer {
                display: none;
                position: fixed;
                bottom: 40px;
                right: 8px;
                width: 480px;
                max-width: calc(100vw - 16px);
                max-height: 80vh;
                background: #0f172a;
                border: 1px solid #334155;
                border-radius: 12px;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5), 0 8px 10px -6px rgba(0, 0, 0, 0.5);
                flex-direction: column;
                overflow: hidden;
                color: #f1f5f9;
            }
            #{$uniqueId}_drawer.show {
                display: flex;
            }
            .devbar-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 10px 14px;
                background: #1e293b;
                border-bottom: 1px solid #334155;
            }
            .devbar-header h4 {
                margin: 0;
                font-size: 12px;
                font-weight: 700;
                color: #38bdf8;
                display: flex;
                align-items: center;
                gap: 6px;
            }
            .devbar-header-close {
                background: none;
                border: none;
                color: #94a3b8;
                font-size: 16px;
                cursor: pointer;
                padding: 0 4px;
                line-height: 1;
            }
            .devbar-header-close:hover { color: #f8fafc; }
            .devbar-tabs {
                display: flex;
                background: #0f172a;
                border-bottom: 1px solid #334155;
                padding: 0 10px;
                gap: 4px;
            }
            .devbar-tab {
                background: none;
                border: none;
                border-bottom: 2px solid transparent;
                color: #94a3b8;
                font-size: 11px;
                font-weight: 600;
                padding: 8px 10px;
                cursor: pointer;
                transition: color 0.15s;
            }
            .devbar-tab:hover { color: #f8fafc; }
            .devbar-tab.active {
                color: #38bdf8;
                border-bottom-color: #38bdf8;
            }
            .devbar-content {
                padding: 12px;
                overflow-y: auto;
                max-height: calc(80vh - 85px);
                font-size: 11px;
            }
            .devbar-tab-panel { display: none; }
            .devbar-tab-panel.active { display: block; }
            .devbar-prop {
                margin-bottom: 10px;
            }
            .devbar-prop-label {
                font-size: 10px;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                color: #64748b;
                font-weight: 700;
                margin-bottom: 3px;
            }
            .devbar-prop-val {
                background: #1e293b;
                padding: 6px 8px;
                border-radius: 6px;
                font-family: monospace;
                word-break: break-all;
                border: 1px solid #334155;
                color: #f8fafc;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 6px;
            }
            .devbar-code {
                background: #1e293b;
                border: 1px solid #334155;
                border-radius: 6px;
                padding: 8px;
                font-family: monospace;
                font-size: 10px;
                max-height: 200px;
                overflow: auto;
                white-space: pre-wrap;
                word-break: break-all;
                color: #a5f3fc;
            }
            .devbar-btn-copy {
                background: #3b82f6;
                color: #fff;
                border: none;
                border-radius: 4px;
                font-size: 9px;
                padding: 2px 6px;
                cursor: pointer;
                white-space: nowrap;
            }
            .devbar-btn-copy:hover { background: #2563eb; }
            .devbar-list-item {
                padding: 4px 6px;
                border-bottom: 1px solid #1e293b;
                font-family: monospace;
                color: #cbd5e1;
                display: flex;
                justify-content: space-between;
            }
            .devbar-list-item:hover { background: #1e293b; }
            .devbar-actions-row {
                display: flex;
                gap: 8px;
                margin-top: 12px;
                padding-top: 10px;
                border-top: 1px solid #334155;
            }
            .devbar-btn-action {
                flex: 1;
                padding: 6px;
                font-size: 10px;
                font-weight: 600;
                border-radius: 6px;
                border: 1px solid #334155;
                background: #1e293b;
                color: #f8fafc;
                cursor: pointer;
                text-align: center;
                text-decoration: none;
            }
            .devbar-btn-action:hover { background: #334155; }
            .devbar-btn-action.danger { color: #f87171; }

            /* Penyesuaian khusus untuk Frame Kecil (misal frame Top 45px / Bot 30px) */
            @media (max-height: 65px) {
                #{$uniqueId}_root {
                    bottom: 2px;
                    right: 4px;
                }
                #{$uniqueId}_pill {
                    padding: 2px 6px;
                    font-size: 9px;
                }
                #{$uniqueId}_pill .devbar-meta {
                    display: none;
                }
                #{$uniqueId}_pill .devbar-name {
                    max-width: 140px;
                }
            }
        </style>

        <div id="{$uniqueId}_root">
            <!-- Collapsed Pill Badge -->
            <div id="{$uniqueId}_pill" title="Developer Mode: Klik untuk rincian file & lingkungan" onclick="devbarToggleDrawer_{$uniqueId}()">
                <span class="devbar-icon">⚡</span>
                <span class="devbar-name">{$safeRelPath}</span>
                <span class="devbar-meta">{$execTime}ms</span>
            </div>

            <!-- Expanded Drawer Panel -->
            <div id="{$uniqueId}_drawer">
                <div class="devbar-header">
                    <h4><span>⚡</span> Simbada Developer Inspector</h4>
                    <button class="devbar-header-close" onclick="devbarToggleDrawer_{$uniqueId}()">&times;</button>
                </div>

                <div class="devbar-tabs">
                    <button class="devbar-tab active" onclick="devbarSwitchTab_{$uniqueId}('overview')">File & Path</button>
                    <button class="devbar-tab" onclick="devbarSwitchTab_{$uniqueId}('includes')">Includes ({$incCount})</button>
                    <button class="devbar-tab" onclick="devbarSwitchTab_{$uniqueId}('request')">Request ({$reqCount})</button>
                    <button class="devbar-tab" onclick="devbarSwitchTab_{$uniqueId}('system')">Sistem</button>
                </div>

                <div class="devbar-content">
                    <!-- Tab 1: Overview File & Path -->
                    <div id="{$uniqueId}_tab_overview" class="devbar-tab-panel active">
                        <div class="devbar-prop">
                            <div class="devbar-prop-label">File Script Utama</div>
                            <div class="devbar-prop-val">
                                <span style="font-weight:bold; color:#38bdf8;">{$safeFileName}</span>
                                <button class="devbar-btn-copy" onclick="devbarCopy_{$uniqueId}('{$slashFileName}')">Salin</button>
                            </div>
                        </div>

                        <div class="devbar-prop">
                            <div class="devbar-prop-label">Path Relatif Workspace</div>
                            <div class="devbar-prop-val">
                                <span>{$safeRelPath}</span>
                                <button class="devbar-btn-copy" onclick="devbarCopy_{$uniqueId}('{$slashRelPath}')">Salin</button>
                            </div>
                        </div>

                        <div class="devbar-prop">
                            <div class="devbar-prop-label">Path Lengkap di Server</div>
                            <div class="devbar-prop-val">
                                <span style="font-size:10px;">{$safeScriptPath}</span>
                                <button class="devbar-btn-copy" onclick="devbarCopy_{$uniqueId}('{$slashScriptPath}')">Salin</button>
                            </div>
                        </div>

                        <div class="devbar-prop">
                            <div class="devbar-prop-label">Konteks Tampilan (Frame Detector)</div>
                            <div class="devbar-prop-val" id="{$uniqueId}_frame_status">
                                Mendeteksi konteks frame...
                            </div>
                        </div>

                        <div class="devbar-prop" style="display:flex; gap:10px;">
                            <div style="flex:1;">
                                <div class="devbar-prop-label">Waktu Eksekusi</div>
                                <div class="devbar-prop-val" style="color:#4ade80;">{$execTime} ms</div>
                            </div>
                            <div style="flex:1;">
                                <div class="devbar-prop-label">Penggunaan Memori</div>
                                <div class="devbar-prop-val" style="color:#facc15;">{$peakMem} MB</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Included Files -->
                    <div id="{$uniqueId}_tab_includes" class="devbar-tab-panel">
                        <div class="devbar-prop-label" style="margin-bottom:6px;">Daftar File yang Di-include ({$incCount} File):</div>
                        <div class="devbar-code" style="max-height:240px;">
{$includesHtml}
                        </div>
                    </div>

                    <!-- Tab 3: Request Params -->
                    <div id="{$uniqueId}_tab_request" class="devbar-tab-panel">
                        <div class="devbar-prop">
                            <div class="devbar-prop-label">Method & URI</div>
                            <div class="devbar-prop-val">{$safeMethod} {$safeUri}</div>
                        </div>
                        <div class="devbar-prop">
                            <div class="devbar-prop-label">GET Parameters ({$getCount})</div>
                            <pre class="devbar-code">{$getJson}</pre>
                        </div>
                        <div class="devbar-prop">
                            <div class="devbar-prop-label">POST Parameters ({$postCount})</div>
                            <pre class="devbar-code">{$postJson}</pre>
                        </div>
                    </div>

                    <!-- Tab 4: System Info -->
                    <div id="{$uniqueId}_tab_system" class="devbar-tab-panel">
                        <div class="devbar-prop">
                            <div class="devbar-prop-label">Versi PHP & SAPI</div>
                            <div class="devbar-prop-val">PHP {$phpVersion} ({$phpSapi})</div>
                        </div>
                        <div class="devbar-prop">
                            <div class="devbar-prop-label">Mode Lingkungan</div>
                            <div class="devbar-prop-val">APP_ENV = {$safeAppEnv}</div>
                        </div>
                        <div class="devbar-prop">
                            <div class="devbar-prop-label">Pencegat Database (mysql_adapter)</div>
                            <div class="devbar-prop-val" style="color:#4ade80;">Aktif (PDO utf8mb4 Engine)</div>
                        </div>

                        <div class="devbar-actions-row">
                            <a href="{$logViewerUrl}" class="devbar-btn-action" target="_blank">
                                🛡️ Buka Log Error
                            </a>
                            <button class="devbar-btn-action danger" onclick="devbarDisableMode_{$uniqueId}()">
                                🛑 Matikan DevBar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            (function() {
                var isInsideFrame = (window !== window.top);
                var frameEl = document.getElementById('{$uniqueId}_frame_status');
                if (frameEl) {
                    if (isInsideFrame) {
                        var frameName = window.name ? ' (name="' + window.name + '")' : '';
                        frameEl.innerHTML = '<span style="color:#38bdf8;">🖼️ Di dalam HTML Frame' + frameName + '</span>';
                    } else {
                        frameEl.innerHTML = '<span style="color:#4ade80;">🖥️ Jendela Utama (Top Window)</span>';
                    }
                }
            })();

            function devbarToggleDrawer_{$uniqueId}() {
                var drawer = document.getElementById('{$uniqueId}_drawer');
                if (drawer) {
                    drawer.classList.toggle('show');
                }
            }

            function devbarSwitchTab_{$uniqueId}(tabName) {
                var root = document.getElementById('{$uniqueId}_root');
                if (!root) return;
                root.querySelectorAll('.devbar-tab').forEach(function(el) {
                    el.classList.remove('active');
                });
                root.querySelectorAll('.devbar-tab-panel').forEach(function(el) {
                    el.classList.remove('active');
                });
                var activeTabBtn = event.target;
                if (activeTabBtn) activeTabBtn.classList.add('active');
                var panel = document.getElementById('{$uniqueId}_tab_' + tabName);
                if (panel) panel.classList.add('active');
            }

            function devbarCopy_{$uniqueId}(text) {
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(text).then(function() {
                        alert('Tersalin ke clipboard: ' + text);
                    });
                } else {
                    var ta = document.createElement('textarea');
                    ta.value = text;
                    document.body.appendChild(ta);
                    ta.select();
                    document.execCommand('copy');
                    document.body.removeChild(ta);
                    alert('Tersalin ke clipboard: ' + text);
                }
            }

            function devbarDisableMode_{$uniqueId}() {
                if (confirm('Matikan Developer Mode? DevBar tidak akan ditampilkan lagi sampai Anda mengaktifkannya kembali via ?dev_mode=1.')) {
                    document.cookie = 'simbada_dev_mode=0; path=/; max-age=0';
                    window.location.href = window.location.pathname + (window.location.search ? window.location.search + '&dev_mode=0' : '?dev_mode=0');
                }
            }
        </script>
        <!-- END SIMBADA DEVELOPER MODE FILE INSPECTOR -->
HTML;
    }
}
