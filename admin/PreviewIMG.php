<?php
require_once "Connection.php";

$rCRT = $_GET['rCRT'] ?? '';
$rIDT = $_GET['rIDT'] ?? '';

// Sanitize IDT to digits only
$rIDT = preg_replace('/[^0-9]/', '', (string)$rIDT);

$gType = '';
$nName = '';
$nSize = 0;
$gCont = '';

if ($rIDT !== '') {
	$query = "SELECT file_name, file_type, file_size, file_content FROM ta_kib_108 WHERE IDT = '" . mysql_real_escape_string($rIDT) . "' LIMIT 1";
	$res = mysql_query($query);
	if ($res && ($data = mysql_fetch_array($res))) {
		$nName = trim((string)($data['file_name'] ?? $data[0] ?? ''));
		$gType = trim((string)($data['file_type'] ?? $data[1] ?? ''));
		$nSize = (int)($data['file_size'] ?? $data[2] ?? 0);
		$gCont = trim((string)($data['file_content'] ?? ''));
	}
}

// Cari path file fisik di server berdasarkan file_name (atau file_content jika berisi path/nama)
$targetPath = '';
$candidateFiles = [];

// 1. Kandidat berdasarkan file_name
if ($nName !== '') {
	$candidateFiles[] = "../simandor/images/" . $rIDT . "xyz" . $nName;
	$candidateFiles[] = "../simandor/images/" . $nName;
	$candidateFiles[] = "../" . $nName;
	$candidateFiles[] = $nName;
}

// 2. Kandidat berdasarkan file_content (jika berisi nama/path file fisik, BUKAN data binary)
if ($gCont !== '' && strlen($gCont) < 500 && !preg_match('/[^\x20-\x7E\t\r\n]/', $gCont)) {
	$candidateFiles[] = "../simandor/images/" . $rIDT . "xyz" . $gCont;
	$candidateFiles[] = "../simandor/images/" . $gCont;
	$candidateFiles[] = "../" . $gCont;
	$candidateFiles[] = $gCont;
}

// Cek keberadaan file fisik di disk
foreach ($candidateFiles as $candidate) {
	if ($candidate !== '' && file_exists($candidate) && !is_dir($candidate)) {
		$targetPath = $candidate;
		break;
	}
}

// 3. Jika file fisik ditemukan, tampilkan atau download
if ($targetPath !== '') {
	$mime = !empty($gType) ? $gType : (function_exists('mime_content_type') ? mime_content_type($targetPath) : '');
	if (!$mime || stripos($mime, 'text/') !== false) {
		$ext = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
		$extMap = [
			'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg',
			'png' => 'image/png', 'gif' => 'image/gif',
			'bmp' => 'image/bmp', 'webp' => 'image/webp',
			'pdf' => 'application/pdf'
		];
		$mime = $extMap[$ext] ?? 'image/jpeg';
	}

	$fileBytes = filesize($targetPath);

	if (!headers_sent()) {
		header("Content-Type: " . $mime);
		header("Content-Length: " . $fileBytes);
		if (isset($_GET['download']) && $_GET['download'] == '1') {
			header('Content-Disposition: attachment; filename="' . basename($targetPath) . '"');
		}
	}
	readfile($targetPath);
	exit;
}

// 4. Fallback bila file fisik tidak ditemukan (TIDAK membaca binary dari database)
if (file_exists("Images/FileLogin_70.gif")) {
	if (!headers_sent()) {
		header("Content-Type: image/gif");
	}
	readfile("Images/FileLogin_70.gif");
} elseif (file_exists("Images/Preview.png")) {
	if (!headers_sent()) {
		header("Content-Type: image/png");
	}
	readfile("Images/Preview.png");
} else {
	echo "<div style='font-family:sans-serif; text-align:center; padding:40px; color:#666;'>Foto / dokumen gambar fisik belum diupload atau tidak ditemukan di server.</div>";
}
exit;

