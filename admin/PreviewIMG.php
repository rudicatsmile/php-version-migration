<?php
require_once "Connection.php";

$rCRT = $_GET['rCRT'] ?? '';
$rIDT = $_GET['rIDT'] ?? '';

// Sanitize IDT to digits only
$rIDT = preg_replace('/[^0-9]/', '', (string)$rIDT);

$gCont = '';
$gType = '';
$nName = '';
$nSize = 0;

if ($rIDT !== '') {
	$query = "SELECT file_content, file_type, file_name, file_size FROM ta_kib_108 WHERE IDT = '" . mysql_real_escape_string($rIDT) . "' LIMIT 1";
	$res = mysql_query($query);
	if ($res && ($data = mysql_fetch_array($res))) {
		$gCont = $data['file_content'] ?? $data[0] ?? '';
		$gType = $data['file_type'] ?? $data[1] ?? '';
		$nName = $data['file_name'] ?? $data[2] ?? '';
		$nSize = (int)($data['file_size'] ?? $data[3] ?? 0);
	}
}

// 1. Cek penyimpanan fisik terlebih dahulu di folder simandor/images/
if ($nName !== '') {
	$prefixedName = $rIDT . "xyz" . $nName;
	$pathWithPrefix = "../simandor/images/" . $prefixedName;
	$pathDirect     = "../simandor/images/" . $nName;

	$targetPath = '';
	if (file_exists($pathWithPrefix) && !is_dir($pathWithPrefix)) {
		$targetPath = $pathWithPrefix;
	} elseif (file_exists($pathDirect) && !is_dir($pathDirect)) {
		$targetPath = $pathDirect;
	}

	if ($targetPath !== '') {
		$mime = !empty($gType) ? $gType : (function_exists('mime_content_type') ? mime_content_type($targetPath) : 'image/jpeg');
		if (!$mime) {
			$mime = 'image/jpeg';
		}
		if (!headers_sent()) {
			header("Content-Type: " . $mime);
			header("Content-Length: " . filesize($targetPath));
		}
		readfile($targetPath);
		exit;
	}

	// 2. Fallback: jika file fisik belum ada di disk, baca dari BLOB database (data legacy)
	if (!empty($gCont)) {
		$mime = !empty($gType) ? $gType : 'image/jpeg';
		if (!headers_sent()) {
			if ($nSize > 0) {
				header("Content-Length: " . $nSize);
			} else {
				header("Content-Length: " . strlen($gCont));
			}
			header("Content-Type: " . $mime);
		}
		echo $gCont;
		exit;
	}
}

// 3. Fallback bila tidak ada image
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
	echo "<div style='font-family:sans-serif; text-align:center; padding:40px; color:#666;'>Foto / dokumen gambar belum diupload.</div>";
}
exit;
