<?php
require "Connection.php";
$CrT  = $CrT ?? ($_GET['CrT'] ?? '');
$rIdT = $rIdT ?? ($_GET['rIdT'] ?? '');

if ($CrT == 'Img') {
	$TbL = "tb_lembar_kerja_foto_denah";
	$targetDir = "../simandor/lki_foto/";
} else {
	$TbL = "tb_lembar_kerja_dokumen";
	$targetDir = "../simandor/lki_dokumen/";
}

$query = "SELECT file_content, file_type, file_name, file_size FROM ".$TbL." where IDT='".$rIdT."'";
$data = mysql_query($query);
$row = $data ? mysql_fetch_array($data) : null;
$gCont = $row[0] ?? '';
$gType = $row[1] ?? 'image/jpeg';
$nName = $row[2] ?? '';
$nSize = $row[3] ?? 0;

$physFile1 = $targetDir . $rIdT . "xyz" . $nName;
$physFile2 = $targetDir . $nName;

if ($nName != "" && file_exists($physFile1) && is_file($physFile1)) {
	if (!headers_sent()) {
		header("Content-length: " . filesize($physFile1));
		header("Content-type: " . $gType);
		if (stripos($gType, 'pdf') !== false) {
			header('Content-disposition: inline; filename="' . $nName . '"');
		}
	}
	readfile($physFile1);
	exit;
} elseif ($nName != "" && file_exists($physFile2) && is_file($physFile2)) {
	if (!headers_sent()) {
		header("Content-length: " . filesize($physFile2));
		header("Content-type: " . $gType);
		if (stripos($gType, 'pdf') !== false) {
			header('Content-disposition: inline; filename="' . $nName . '"');
		}
	}
	readfile($physFile2);
	exit;
} elseif (!empty($gCont)) {
	if (!headers_sent()) {
		header("Content-length: " . ($nSize ?: strlen($gCont)));
		header("Content-type: " . $gType);
		if (stripos($gType, 'pdf') !== false) {
			header('Content-disposition: inline; filename="' . $nName . '"');
		}
	}
	echo $gCont;
	exit;
} else {
	echo "<img src='Images/FileLogin_70' height='20' width='20'>";
}
?>
