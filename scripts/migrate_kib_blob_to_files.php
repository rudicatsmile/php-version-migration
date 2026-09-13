<?php
/**
 * CLI Script: Migrasi gambar ta_kib_108 dari LONGBLOB (file_content) ke file fisik di simandor/images/
 * 
 * Penggunaan:
 *   php scripts/migrate_kib_blob_to_files.php [opsi]
 * 
 * Opsi:
 *   --dry-run       : Jalankan simulasi tanpa menulis file ke disk atau mengubah database
 *   --clear-blob    : Kosongkan field file_content setelah berhasil disimpan ke disk
 *   --limit=N       : Batasi proses sejumlah N record (contoh: --limit=100)
 *   --overwrite     : Tulis ulang file jika sudah ada di disk
 *   --help          : Tampilkan bantuan ini
 */

if (php_sapi_name() !== 'cli') {
    die("Script ini hanya dapat dijalankan melalui CLI (Command Line Interface).\n");
}

ini_set('memory_limit', '512M');
set_time_limit(0);

// Parse CLI options
$options = getopt('', ['dry-run', 'clear-blob', 'limit::', 'overwrite', 'help']);

if (isset($options['help'])) {
    echo <<<HELP
Migrasi Gambar ta_kib_108 dari BLOB ke File Fisik
==================================================
Penggunaan:
  php scripts/migrate_kib_blob_to_files.php [opsi]

Opsi:
  --dry-run       Simulasi tanpa menulis file atau mengubah database
  --clear-blob    Kosongkan field file_content di DB setelah file berhasil ditulis ke disk
  --limit=N       Batasi proses ke N record pertama
  --overwrite     Timpa file jika sudah ada di folder fisik
  --help          Tampilkan bantuan ini

Contoh:
  php scripts/migrate_kib_blob_to_files.php --limit=10 --dry-run
  php scripts/migrate_kib_blob_to_files.php --clear-blob

HELP;
    exit(0);
}

$isDryRun = isset($options['dry-run']);
$clearBlob = isset($options['clear-blob']);
$overwrite = isset($options['overwrite']);
$limit = isset($options['limit']) ? (int)$options['limit'] : 0;

$rootDir = dirname(__DIR__);
$targetDir = $rootDir . DIRECTORY_SEPARATOR . 'simandor' . DIRECTORY_SEPARATOR . 'images';

if (!is_dir($targetDir)) {
    if (!$isDryRun) {
        if (!mkdir($targetDir, 0755, true)) {
            die("ERROR: Gagal membuat folder target: $targetDir\n");
        }
    }
}

// Koneksi ke Database
require_once $rootDir . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'Connection.php';

echo "========================================================\n";
echo " MIGRASI GAMBAR ta_kib_108 KE PENYIMPANAN FISIK\n";
echo "========================================================\n";
echo "Folder Target  : $targetDir\n";
echo "Mode Simulasi  : " . ($isDryRun ? "YA (Dry Run)" : "TIDAK (Live Migration)") . "\n";
echo "Kosongkan BLOB : " . ($clearBlob ? "YA" : "TIDAK (BLOB dipertahankan)") . "\n";
echo "Timpa File     : " . ($overwrite ? "YA" : "TIDAK") . "\n";
if ($limit > 0) {
    echo "Batas Record   : $limit\n";
}
echo "--------------------------------------------------------\n";

$sqlCount = "SELECT COUNT(*) FROM ta_kib_108 WHERE file_content IS NOT NULL AND LENGTH(file_content) > 0";
$resCount = mysql_query($sqlCount);
$rowCount = $resCount ? mysql_fetch_array($resCount) : [0];
$totalToMigrate = (int)$rowCount[0];

echo "Total record dengan BLOB terdeteksi: $totalToMigrate\n\n";

if ($totalToMigrate === 0) {
    echo "Tidak ada record BLOB yang perlu dimigrasi.\n";
    exit(0);
}

$query = "SELECT IDT, file_name, file_type, file_size, file_content FROM ta_kib_108 WHERE file_content IS NOT NULL AND LENGTH(file_content) > 0 ORDER BY IDT ASC";
if ($limit > 0) {
    $query .= " LIMIT " . $limit;
}

$result = mysql_query($query);
if (!$result) {
    die("ERROR Query: " . mysql_error() . "\n");
}

$processed = 0;
$successCount = 0;
$skippedCount = 0;
$errorCount = 0;

while ($row = mysql_fetch_assoc($result)) {
    $processed++;
    $idt = $row['IDT'];
    $rawName = trim((string)$row['file_name']);
    $content = $row['file_content'];
    $type = (string)$row['file_type'];

    if (empty($rawName)) {
        // Tentukan ekstensi dari tipe mime
        $ext = 'jpg';
        if (stripos($type, 'png') !== false) {
            $ext = 'png';
        } elseif (stripos($type, 'gif') !== false) {
            $ext = 'gif';
        } elseif (stripos($type, 'pdf') !== false) {
            $ext = 'pdf';
        }
        $rawName = "asset_" . $idt . "." . $ext;
    }

    // Standard naming convention: {IDT}xyz{rawName}
    $physicalName = $idt . "xyz" . $rawName;
    $physicalPath = $targetDir . DIRECTORY_SEPARATOR . $physicalName;

    if (file_exists($physicalPath) && !$overwrite && filesize($physicalPath) > 0) {
        $skippedCount++;
        echo "[$processed] SKIP (Sudah ada): IDT #$idt -> $physicalName\n";

        if ($clearBlob && !$isDryRun) {
            mysql_query("UPDATE ta_kib_108 SET file_content = '', file_name = '" . mysql_real_escape_string($rawName) . "' WHERE IDT = " . (int)$idt);
        }
        continue;
    }

    if ($isDryRun) {
        $successCount++;
        echo "[$processed] DRY-RUN OK: IDT #$idt -> $physicalName (" . strlen($content) . " bytes)\n";
        continue;
    }

    // Tulis data ke file fisik
    $bytesWritten = file_put_contents($physicalPath, $content);
    if ($bytesWritten === false) {
        $errorCount++;
        echo "[$processed] GAGAL TULIS FILE: IDT #$idt -> $physicalPath\n";
        continue;
    }

    // Update database
    $safeName = mysql_real_escape_string($rawName);
    $fileSize = (int)$bytesWritten;

    if ($clearBlob) {
        $updateSql = "UPDATE ta_kib_108 SET file_name = '$safeName', file_size = $fileSize, file_content = '' WHERE IDT = " . (int)$idt;
    } else {
        $updateSql = "UPDATE ta_kib_108 SET file_name = '$safeName', file_size = $fileSize WHERE IDT = " . (int)$idt;
    }

    $updRes = mysql_query($updateSql);
    if (!$updRes) {
        $errorCount++;
        echo "[$processed] GAGAL UPDATE DB: IDT #$idt -> " . mysql_error() . "\n";
    } else {
        $successCount++;
        echo "[$processed] SUKSES: IDT #$idt -> $physicalName ($bytesWritten bytes)\n";
    }
}

echo "--------------------------------------------------------\n";
echo "RINGKASAN PROSES:\n";
echo "Total Diproses : $processed\n";
echo "Berhasil       : $successCount\n";
echo "Dilewati (Skip): $skippedCount\n";
echo "Gagal / Error  : $errorCount\n";
echo "========================================================\n";
