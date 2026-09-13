<?php
/**
 * CLI Script: Migrasi BLOB (file_content) ke file fisik di folder simandor/
 * Mendukung 4 tabel:
 * 1. tb_lembar_kerja_foto_denah -> simandor/lki_foto/
 * 2. tb_lembar_kerja_dokumen    -> simandor/lki_dokumen/
 * 3. ta_sp3d_spj_rinci_file     -> simandor/spj/
 * 4. ta_kib_108_pdf             -> simandor/kib_pdf/
 *
 * Penggunaan:
 *   php scripts/migrate_all_blobs_to_files.php [opsi]
 *
 * Opsi:
 *   --table=N       : Tabel yang ingin dimigrasi (all, tb_lembar_kerja_foto_denah, tb_lembar_kerja_dokumen, ta_sp3d_spj_rinci_file, ta_kib_108_pdf) [default: all]
 *   --dry-run       : Jalankan simulasi tanpa menulis file ke disk atau mengubah database
 *   --clear-blob    : Kosongkan field file_content setelah berhasil disimpan ke disk
 *   --limit=N       : Batasi proses sejumlah N record per tabel (contoh: --limit=100)
 *   --overwrite     : Tulis ulang file jika sudah ada di disk
 *   --help          : Tampilkan bantuan ini
 */

if (php_sapi_name() !== 'cli') {
    die("Script ini hanya dapat dijalankan melalui CLI (Command Line Interface).\n");
}

ini_set('memory_limit', '1024M');
set_time_limit(0);

$options = getopt('', ['table::', 'dry-run', 'clear-blob', 'limit::', 'overwrite', 'help']);

if (isset($options['help'])) {
    echo <<<HELP
Migrasi Database BLOB ke File Fisik Server
==================================================
Penggunaan:
  php scripts/migrate_all_blobs_to_files.php [opsi]

Opsi:
  --table=NAME    Pilih tabel: all | tb_lembar_kerja_foto_denah | tb_lembar_kerja_dokumen | ta_sp3d_spj_rinci_file | ta_kib_108_pdf (default: all)
  --dry-run       Simulasi tanpa menulis file ke disk atau mengubah database
  --clear-blob    Kosongkan field file_content di DB setelah file berhasil ditulis ke disk
  --limit=N       Batasi proses ke N record per tabel
  --overwrite     Timpa file jika sudah ada di folder fisik
  --help          Tampilkan panduan ini

Contoh:
  php scripts/migrate_all_blobs_to_files.php --table=all --limit=10 --dry-run
  php scripts/migrate_all_blobs_to_files.php --table=ta_kib_108_pdf --clear-blob
  php scripts/migrate_all_blobs_to_files.php --table=tb_lembar_kerja_dokumen --clear-blob

HELP;
    exit(0);
}

$isDryRun   = isset($options['dry-run']);
$clearBlob  = isset($options['clear-blob']);
$overwrite  = isset($options['overwrite']);
$limit      = isset($options['limit']) ? (int)$options['limit'] : 0;
$selTable   = isset($options['table']) ? trim($options['table']) : 'all';

$rootDir = dirname(__DIR__);

// Koneksi ke Database Simbada
require_once $rootDir . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'Connection.php';

// Definisi tabel dan folder tujuan
$tableConfigs = [
    'tb_lembar_kerja_foto_denah' => [
        'folder' => 'simandor' . DIRECTORY_SEPARATOR . 'lki_foto',
        'label'  => 'Foto & Denah Lembar Kerja (tb_lembar_kerja_foto_denah)',
        'default_ext' => 'jpg'
    ],
    'tb_lembar_kerja_dokumen' => [
        'folder' => 'simandor' . DIRECTORY_SEPARATOR . 'lki_dokumen',
        'label'  => 'Dokumen Lembar Kerja (tb_lembar_kerja_dokumen)',
        'default_ext' => 'pdf'
    ],
    'ta_sp3d_spj_rinci_file' => [
        'folder' => 'simandor' . DIRECTORY_SEPARATOR . 'spj',
        'label'  => 'File Rinci SPJ SP3D (ta_sp3d_spj_rinci_file)',
        'default_ext' => 'jpg'
    ],
    'ta_kib_108_pdf' => [
        'folder' => 'simandor' . DIRECTORY_SEPARATOR . 'kib_pdf',
        'label'  => 'Dokumen PDF KIB 108 (ta_kib_108_pdf)',
        'default_ext' => 'pdf'
    ],
];

if ($selTable !== 'all') {
    if (!isset($tableConfigs[$selTable])) {
        die("ERROR: Tabel '{$selTable}' tidak dikenal. Pilihan: " . implode(', ', array_keys($tableConfigs)) . " atau all.\n");
    }
    $targetTables = [$selTable => $tableConfigs[$selTable]];
} else {
    $targetTables = $tableConfigs;
}

echo "====================================================================\n";
echo " MIGRASI PENYIMPANAN BLOB DATABASE KE FILE FISIK SERVER\n";
echo "====================================================================\n";
echo "Waktu Mulai    : " . date('Y-m-d H:i:s') . "\n";
echo "Mode Simulasi  : " . ($isDryRun ? "YA (Dry Run)" : "TIDAK (Live Migration)") . "\n";
echo "Kosongkan BLOB : " . ($clearBlob ? "YA" : "TIDAK (BLOB dipertahankan)") . "\n";
echo "Timpa File     : " . ($overwrite ? "YA" : "TIDAK") . "\n";
if ($limit > 0) {
    echo "Batas Record   : $limit per tabel\n";
}
echo "Tabel Dipilih  : " . ($selTable === 'all' ? 'Semua (4 tabel)' : $selTable) . "\n";
echo "====================================================================\n\n";

$grandTotalMigrated = 0;
$grandTotalSkipped  = 0;
$grandTotalBytes    = 0;
$grandTotalErrors   = 0;

foreach ($targetTables as $tblName => $cfg) {
    $targetDir = $rootDir . DIRECTORY_SEPARATOR . $cfg['folder'];
    if (!is_dir($targetDir)) {
        if (!$isDryRun) {
            if (!mkdir($targetDir, 0755, true)) {
                echo "[-] ERROR: Gagal membuat folder target: $targetDir\n";
                $grandTotalErrors++;
                continue;
            }
        }
    }

    echo ">>> MEMPROSES TABEL: " . $cfg['label'] . "\n";
    echo "    Folder Target: " . $cfg['folder'] . "\n";

    $sqlCount = "SELECT COUNT(*) FROM `{$tblName}` WHERE file_content IS NOT NULL AND LENGTH(file_content) > 0";
    $resCount = mysql_query($sqlCount);
    $rowCount = $resCount ? mysql_fetch_array($resCount) : [0];
    $totalRecords = (int)$rowCount[0];

    echo "    Total record BLOB terdeteksi: " . number_format($totalRecords, 0, ',', '.') . "\n";

    if ($totalRecords === 0) {
        echo "    -> Tidak ada record BLOB pada tabel ini. Lanjut.\n\n";
        continue;
    }

    $query = "SELECT IDT, file_name, file_type, file_size, file_content FROM `{$tblName}` WHERE file_content IS NOT NULL AND LENGTH(file_content) > 0 ORDER BY IDT ASC";
    if ($limit > 0) {
        $query .= " LIMIT " . $limit;
    }

    $result = mysql_query($query);
    if (!$result) {
        echo "[-] ERROR Query pada tabel {$tblName}: " . mysql_error() . "\n\n";
        $grandTotalErrors++;
        continue;
    }

    $migrated = 0;
    $skipped  = 0;
    $errors   = 0;
    $bytes    = 0;
    $counter  = 0;
    $totalToProcess = ($limit > 0 && $limit < $totalRecords) ? $limit : $totalRecords;

    while ($row = mysql_fetch_assoc($result)) {
        $counter++;
        $id          = $row['IDT'];
        $rawName     = $row['file_name'];
        $fileType    = $row['file_type'];
        $fileContent = $row['file_content'];

        if (empty($fileContent)) {
            $skipped++;
            continue;
        }

        // Tentukan nama file yang aman
        if (!empty($rawName)) {
            $cleanName = preg_replace('/[^a-zA-Z0-9_.-]/', '_', basename($rawName));
        } else {
            $cleanName = "file_" . $id . "." . $cfg['default_ext'];
        }

        $destFileName = $id . "xyz" . $cleanName;
        $destPath     = $targetDir . DIRECTORY_SEPARATOR . $destFileName;

        if (file_exists($destPath) && !$overwrite) {
            $skipped++;
            // Jika user memilih clear-blob walaupun file sudah ada di disk
            if ($clearBlob && !$isDryRun) {
                mysql_query("UPDATE `{$tblName}` SET file_content='' WHERE IDT='{$id}'");
            }
            continue;
        }

        $contentLen = strlen($fileContent);

        if (!$isDryRun) {
            $written = file_put_contents($destPath, $fileContent);
            if ($written === false) {
                echo "    [!] ERROR: Gagal menulis file IDT #{$id} ke {$destFileName}\n";
                $errors++;
                continue;
            }

            if ($clearBlob) {
                $updRes = mysql_query("UPDATE `{$tblName}` SET file_content='' WHERE IDT='{$id}'");
                if (!$updRes) {
                    echo "    [!] WARNING: Gagal mengosongkan BLOB IDT #{$id}: " . mysql_error() . "\n";
                }
            }
        }

        $migrated++;
        $bytes += $contentLen;

        if ($counter % 250 === 0 || $counter === $totalToProcess) {
            $pct = round(($counter / $totalToProcess) * 100, 1);
            $mbWritten = round($bytes / 1024 / 1024, 2);
            $mem = round(memory_get_usage() / 1024 / 1024, 1);
            echo "    Progres: {$counter}/{$totalToProcess} ({$pct}%) | Berhasil: {$migrated} ({$mbWritten} MB) | Skip: {$skipped} | RAM: {$mem} MB\r";
        }
    }

    echo "\n";
    $mbTotal = round($bytes / 1024 / 1024, 2);
    echo "    -> Selesai {$cfg['label']}:\n";
    echo "       Berhasil diekspor : {$migrated} file ({$mbTotal} MB)\n";
    echo "       Dilewati (Skip)   : {$skipped} file\n";
    echo "       Gagal (Error)     : {$errors} file\n\n";

    $grandTotalMigrated += $migrated;
    $grandTotalSkipped  += $skipped;
    $grandTotalBytes    += $bytes;
    $grandTotalErrors   += $errors;
}

$grandMb = round($grandTotalBytes / 1024 / 1024, 2);
echo "====================================================================\n";
echo " RINGKASAN MIGRASI KESELURUHAN\n";
echo "====================================================================\n";
echo "Total File Diekspor : {$grandTotalMigrated} file ({$grandMb} MB)\n";
echo "Total File Dilewati : {$grandTotalSkipped} file\n";
echo "Total File Gagal    : {$grandTotalErrors} file\n";
echo "Waktu Selesai       : " . date('Y-m-d H:i:s') . "\n";
echo "====================================================================\n";
if ($isDryRun) {
    echo "CATATAN: Ini adalah mode simulasi (--dry-run). Tidak ada file yang ditulis ke disk dan database tidak diubah.\n";
}
