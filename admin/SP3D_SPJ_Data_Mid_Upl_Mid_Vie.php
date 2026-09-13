<?php
require "Connection.php";
$rIdT = $rIdT ?? ($_GET['rIdT'] ?? '');

$SQL = "SELECT file_content, file_type, file_name, file_size FROM ta_sp3d_spj_rinci_file where IDT='".$rIdT."'";
$data = mysql_query($SQL);
$row = $data ? mysql_fetch_array($data) : null;
$gCont = $row[0] ?? '';
$gType = $row[1] ?? 'image/jpeg';
$nName = $row[2] ?? '';
$nSize = $row[3] ?? 0;

$targetDir = "../simandor/spj/";
$physFile1 = $targetDir . $rIdT . "xyz" . $nName;
$physFile2 = $targetDir . $nName;

if ($nName != "" && file_exists($physFile1) && is_file($physFile1)) {
	if (!headers_sent()) {
		header("Content-type: $gType");
		header("Content-Length: " . filesize($physFile1));
		if (stripos($gType, 'pdf') !== false) {
			header('Content-Disposition: inline; filename="' . $nName . '"');
		}
	}
	readfile($physFile1);
	exit;
} elseif ($nName != "" && file_exists($physFile2) && is_file($physFile2)) {
	if (!headers_sent()) {
		header("Content-type: $gType");
		header("Content-Length: " . filesize($physFile2));
		if (stripos($gType, 'pdf') !== false) {
			header('Content-Disposition: inline; filename="' . $nName . '"');
		}
	}
	readfile($physFile2);
	exit;
} elseif (!empty($gCont)) {
	if (!headers_sent()) {
		header("Content-length: " . ($nSize ?: strlen($gCont)));
		header("Content-type: $gType");
		if (stripos($gType, 'pdf') !== false) {
			header('Content-Disposition: inline; filename="' . $nName . '"');
		}
	}
	echo $gCont;
	exit;
} else {
	if (file_exists("Images/FileLogin_14.gif")) {
		if (!headers_sent()) {
			header("Content-type: image/gif");
		}
		readfile("Images/FileLogin_14.gif");
	} else {
		header("Content-type: image/gif");
		echo "";
	}
}
?>