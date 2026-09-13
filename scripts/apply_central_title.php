<?php
/**
 * CLI Tool: Mengganti seluruh hardcode title 'Simbada Kab. Hulu Sungai Tengah'
 * menjadi pemanggilan terpusat 'AppTitle.php'
 */

if (php_sapi_name() !== 'cli') {
    die("Hanya dapat dijalankan via CLI.\n");
}

$rootDir = dirname(__DIR__);
$adminDir = $rootDir . DIRECTORY_SEPARATOR . 'admin';

echo "========================================================\n";
echo " PROSES SENTRALISASI TITLE HALAMAN SIMBADA\n";
echo "========================================================\n";

$targetPattern = '<title>Simbada Kab. Hulu Sungai Tengah</title>';
$replacement   = '<title><?php require_once \'AppTitle.php\'; echo APP_TITLE; ?></title>';

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($adminDir));
$modifiedFiles = 0;
$totalReplaced = 0;
$syntaxErrors  = 0;
$filesList = [];

foreach ($iterator as $file) {
    if (!$file->isFile()) continue;
    $filePath = $file->getPathname();
    $ext = strtolower($file->getExtension());
    if (!in_array($ext, ['php', 'html', 'htm'])) continue;

    $content = file_get_contents($filePath);
    if (strpos($content, $targetPattern) === false) continue;

    $count = substr_count($content, $targetPattern);
    $newContent = str_replace($targetPattern, $replacement, $content);

    // Tulis konten baru
    file_put_contents($filePath, $newContent);
    $modifiedFiles++;
    $totalReplaced += $count;
    $filesList[] = [
        'path' => str_replace('\\', '/', substr($filePath, strlen($rootDir) + 1)),
        'count' => $count
    ];

    // Lint check jika ekstensi php
    if ($ext === 'php') {
        $cmd = 'd:\\xampp\\php\\php.exe -l "' . $filePath . '" 2>&1';
        exec($cmd, $lintOutput, $retCode);
        if ($retCode !== 0) {
            echo "[-] SYNTAX ERROR pada {$filePath}: " . implode("\n", $lintOutput) . "\n";
            // Revert back
            file_put_contents($filePath, $content);
            $syntaxErrors++;
        }
        $lintOutput = [];
    }

    if ($modifiedFiles % 50 === 0) {
        echo "  Memproses: {$modifiedFiles} file... ({$totalReplaced} kemunculan diganti)\r";
    }
}

echo "\n";
echo "========================================================\n";
echo " RINGKASAN HASIL\n";
echo "========================================================\n";
echo "Total File Dimodifikasi : {$modifiedFiles} file\n";
echo "Total Kemunculan Diganti: {$totalReplaced} tag <title>\n";
echo "Syntax Errors           : {$syntaxErrors}\n";
echo "========================================================\n";

// Simpan manifest file yang diubah
$manifest = [
    'date' => date('Y-m-d H:i:s'),
    'total_files' => $modifiedFiles,
    'total_replaced' => $totalReplaced,
    'files' => $filesList
];
file_put_contents($rootDir . '/scripts/title_migration_manifest.json', json_encode($manifest, JSON_PRETTY_PRINT));
echo "Manifest tersimpan di: scripts/title_migration_manifest.json\n";
