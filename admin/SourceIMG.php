<?php
require_once "Connection.php";

$rCRT = $_GET['rCRT'] ?? '';
$rIDT = $_GET['rIDT'] ?? '';

// Sanitize IDT to digits only
$rIDT = preg_replace('/[^0-9]/', '', (string)$rIDT);

$gType = '';
$nName = '';
$gCont = '';

if ($rIDT !== '') {
	$query = "SELECT file_name, file_type, file_size, file_content FROM ta_kib_108 WHERE IDT = '" . mysql_real_escape_string($rIDT) . "' LIMIT 1";
	$res = mysql_query($query);
	if ($res && ($data = mysql_fetch_array($res))) {
		$nName = trim((string)($data['file_name'] ?? $data[0] ?? ''));
		$gType = trim((string)($data['file_type'] ?? $data[1] ?? ''));
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

// 3. Jika file fisik ditemukan, tampilkan ke browser
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

	if (!headers_sent()) {
		header("Content-Type: " . $mime);
		header("Content-Length: " . filesize($targetPath));
		header("Cache-Control: public, max-age=86400");
		if (isset($_GET['action']) && $_GET['action'] === 'download') {
			header('Content-Disposition: attachment; filename="' . basename($targetPath) . '"');
		}
	}
	readfile($targetPath);
	exit;
}

// 4. Fallback placeholder bila file fisik tidak ditemukan (TIDAK membaca binary dari database)
if (file_exists("Images/FileLogin_14.gif")) {
	if (!headers_sent()) {
		header("Content-Type: image/gif");
	}
	readfile("Images/FileLogin_14.gif");
} elseif (file_exists("Images/Preview.png")) {
	if (!headers_sent()) {
		header("Content-Type: image/png");
	}
	readfile("Images/Preview.png");
} else {
	if (!headers_sent()) {
		header("Content-Type: image/gif");
	}
	echo base64_decode("R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7");
}
exit;

