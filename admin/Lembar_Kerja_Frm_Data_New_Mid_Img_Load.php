<?php
require "Connection.php";
$CrT  = $CrT ?? ($_GET['CrT'] ?? '');
$rIdT = $rIdT ?? ($_GET['rIdT'] ?? '');

if ($CrT == 'Pdf') {
	$SQL = "SELECT file_content, file_type, file_name, file_size FROM tb_lembar_kerja_dokumen WHERE IDT='".$rIdT."'";
	$targetDir = "../simandor/lki_dokumen/";
} else {
	$SQL = "SELECT file_content, file_type, file_name, file_size FROM tb_lembar_kerja_foto_denah WHERE IDT='".$rIdT."'";
	$targetDir = "../simandor/lki_foto/";
}

$data = mysql_query($SQL);
$row = $data ? mysql_fetch_array($data) : null;
$gCont = $row[0] ?? '';
$gType = $row[1] ?? 'image/jpeg';
$nName = $row[2] ?? '';
$nSize = $row[3] ?? 0;

$physFile1 = $targetDir . $rIdT . "xyz" . $nName;
$physFile2 = $targetDir . $nName;

if ($nName != "" && file_exists($physFile1) && is_file($physFile1)) {
	if (!headers_sent()) {
		header("Content-type: $gType");
		header("Content-Length: " . filesize($physFile1));
	}
	readfile($physFile1);
	exit;
} elseif ($nName != "" && file_exists($physFile2) && is_file($physFile2)) {
	if (!headers_sent()) {
		header("Content-type: $gType");
		header("Content-Length: " . filesize($physFile2));
	}
	readfile($physFile2);
	exit;
} elseif (!empty($gCont)) {
	if (!headers_sent()) {
		header("Content-type: $gType");
		header("Content-Length: " . strlen($gCont));
	}
	echo $gCont;
	exit;
} else {
	if (file_exists("Images/admin.gif")) {
		if (!headers_sent()) {
			header("Content-type: image/gif");
		}
		readfile("Images/admin.gif");
	} else {
		header("Content-type: image/gif");
		echo "";
	}
}
?>