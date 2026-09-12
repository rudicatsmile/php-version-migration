<?php
header('Content-Type: application/json; charset=utf-8');

function respond($statusCode, $payload)
{
    http_response_code($statusCode);
    echo json_encode($payload);
    exit;
}

function getParam($key)
{
    return isset($_GET[$key]) ? trim((string) $_GET[$key]) : '';
}

function columnExists($conn, $table, $column)
{
    $tableEsc = preg_replace('/[^a-zA-Z0-9_]/', '', $table);
    $columnEsc = preg_replace('/[^a-zA-Z0-9_]/', '', $column);
    if ($tableEsc === '' || $columnEsc === '')
        return false;
    $sql = "SHOW COLUMNS FROM `$tableEsc` LIKE '$columnEsc'";
    $res = mysqli_query($conn, $sql);
    if ($res === false)
        return false;
    $exists = mysqli_num_rows($res) > 0;
    mysqli_free_result($res);
    return $exists;
}

function buildUpdateQuery($conn, $table, $pairs, $whereSql)
{
    $setParts = [];
    foreach ($pairs as $col => $spec) {
        if (!columnExists($conn, $table, $col))
            continue;

        $colEsc = preg_replace('/[^a-zA-Z0-9_]/', '', (string) $col);
        if ($colEsc === '')
            continue;

        $isRaw = is_array($spec) && isset($spec['raw']) && $spec['raw'] === true;
        $val = is_array($spec) && array_key_exists('value', $spec) ? $spec['value'] : $spec;

        if ($isRaw) {
            $setParts[] = "`$colEsc`=$val";
        } else {
            $valEsc = mysqli_real_escape_string($conn, (string) $val);
            $setParts[] = "`$colEsc`='$valEsc'";
        }
    }

    if (count($setParts) === 0)
        return '';
    $tableEsc = preg_replace('/[^a-zA-Z0-9_]/', '', $table);
    return "UPDATE `$tableEsc` SET " . implode(', ', $setParts) . " WHERE $whereSql";
}

if ((isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '') !== 'POST') {
    respond(405, ['status' => 0, 'message' => 'Method not allowed']);
}

ini_set('memory_limit', '256M');
ini_set('max_execution_time', '300');
ini_set('upload_max_filesize', '100M');

require_once 'connect.php';

$idt = getParam('idt');
$lat = getParam('lat');
$lng = getParam('lng');

if ($idt === '') {
    respond(400, ['status' => 0, 'message' => 'Parameter idt wajib diisi']);
}
if (!preg_match('/^[0-9A-Za-z_-]{1,64}$/', $idt)) {
    respond(400, ['status' => 0, 'message' => 'Parameter idt tidak valid']);
}
if ($lat !== '' && !is_numeric($lat)) {
    respond(400, ['status' => 0, 'message' => 'Parameter lat tidak valid']);
}
if ($lng !== '' && !is_numeric($lng)) {
    respond(400, ['status' => 0, 'message' => 'Parameter lng tidak valid']);
}

if (!isset($_FILES['image'])) {
    respond(400, ['status' => 0, 'message' => 'File image tidak ditemukan']);
}

$file = $_FILES['image'];
if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
    $err = isset($file['error']) ? (string) $file['error'] : 'No File';
    respond(400, ['status' => 0, 'message' => "Upload error code: $err"]);
}

$maxBytes = 10 * 1024 * 1024;
$fileSize = (int) (isset($file['size']) ? $file['size'] : 0);
if ($fileSize <= 0) {
    respond(400, ['status' => 0, 'message' => 'File kosong atau tidak terbaca']);
}
if ($fileSize > $maxBytes) {
    respond(413, ['status' => 0, 'message' => 'Ukuran file terlalu besar']);
}

$tmpName = (string) (isset($file['tmp_name']) ? $file['tmp_name'] : '');
if ($tmpName === '' || !is_uploaded_file($tmpName)) {
    respond(400, ['status' => 0, 'message' => 'File upload tidak valid']);
}

$originalName = (string) (isset($file['name']) ? $file['name'] : '');
$originalNameSafe = preg_replace('/[^a-zA-Z0-9._-]/', '_', $originalName);

$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($tmpName);
$allowedMimes = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
];
if ($mime === false || !isset($allowedMimes[$mime])) {
    respond(415, ['status' => 0, 'message' => 'Tipe file tidak didukung']);
}
$ext = $allowedMimes[$mime];

// $storageDir = __DIR__ . '/../uploads/sipanda/images/';
$storageDir = "../simandor/images/";
if (!is_dir($storageDir) && !mkdir($storageDir, 0755, true)) {
    respond(500, ['status' => 0, 'message' => 'Gagal menyiapkan folder penyimpanan']);
}

// Generate random string (PHP 5 compatible)
if (function_exists('random_bytes')) {
    $random = bin2hex(random_bytes(8));
} elseif (function_exists('openssl_random_pseudo_bytes')) {
    $random = bin2hex(openssl_random_pseudo_bytes(8));
} else {
    $random = substr(md5(mt_rand()), 0, 16);
}

$timestamp = gmdate('Ymd_His');
$storedName = $idt . 'xyz' . $timestamp . '_' . $random . '.' . $ext;
$storedNameToDB = $timestamp . '_' . $random . '.' . $ext;
$storedPath = $storageDir . $storedName;

if (file_exists($storedPath)) {
    respond(409, ['status' => 0, 'message' => 'File duplikat terdeteksi']);
}

if (!move_uploaded_file($tmpName, $storedPath)) {
    respond(500, ['status' => 0, 'message' => 'Gagal menyimpan file di server']);
}

$sha256 = hash_file('sha256', $storedPath);
$latLng = ($lat !== '' && $lng !== '') ? ($lat . ',' . $lng) : '';

$idtEsc = mysqli_real_escape_string($conn, $idt);
$table = 'ta_kib_108';
$where = "IDT='$idtEsc'";

$updatePairs = [
    'file_name' => $storedNameToDB,
    'file_type' => $mime,
    'file_size' => (string) $fileSize,
    'lat' => $lat,
    'lng' => $lng,
    'lat_lng' => $latLng,
];

$updateSql = buildUpdateQuery($conn, $table, $updatePairs, $where);
if ($updateSql === '') {
    respond(500, ['status' => 0, 'message' => 'Tidak ada kolom yang bisa di-update pada database']);
}

$result = mysqli_query($conn, $updateSql);
if ($result === false) {
    respond(500, [
        'status' => 0,
        'message' => 'Gagal update database',
        'db_error' => mysqli_error($conn),
    ]);
}

respond(200, [
    'status' => 1,
    'message' => 'Data input successfully',
    'idt' => $idt,
    'original_name' => $originalNameSafe,
    'stored_name' => $storedName,
    'mime' => $mime,
    'size' => $fileSize,
    'sha256' => $sha256,
    'timestamp' => gmdate('c'),
]);
