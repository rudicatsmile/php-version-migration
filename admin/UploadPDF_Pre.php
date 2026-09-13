<?php require "Connection.php";?>
<?php
$rIdT = $rIdT ?? ($_GET['rIdT'] ?? '');

$query = "SELECT file_content, file_type, file_name, file_size FROM ta_kib_108_pdf where IDT='".$rIdT."'";
$data = mysql_query($query);
$row = $data ? mysql_fetch_array($data) : null;

$gCont = $row[0] ?? '';
$gType = $row[1] ?? 'application/pdf';
$nName = $row[2] ?? '';
$nSize = $row[3] ?? 0;

$targetDir = "../simandor/kib_pdf/";
$physFile1 = $targetDir . $rIdT . "xyz" . $nName;
$physFile2 = $targetDir . $nName;

if ($nName != "" && file_exists($physFile1) && is_file($physFile1)) {
	if (!headers_sent()) {
		header("Content-Type: " . ($gType ?: 'application/pdf'));
		header('Content-Disposition: inline; filename="' . $nName . '"');
		header("Content-Length: " . filesize($physFile1));
		header('Accept-Ranges: bytes');
	}
	readfile($physFile1);
	exit;
} elseif ($nName != "" && file_exists($physFile2) && is_file($physFile2)) {
	if (!headers_sent()) {
		header("Content-Type: " . ($gType ?: 'application/pdf'));
		header('Content-Disposition: inline; filename="' . $nName . '"');
		header("Content-Length: " . filesize($physFile2));
		header('Accept-Ranges: bytes');
	}
	readfile($physFile2);
	exit;
} elseif (!empty($gCont)) {
	if (!headers_sent()) {
		header("Content-Length: " . ($nSize ?: strlen($gCont)));
		header("Content-Type: " . ($gType ?: 'application/pdf'));
		header('Content-Disposition: inline; filename="' . $nName . '"');
		header('Accept-Ranges: bytes');
	}
	echo $gCont;
	exit;
} else {
	echo "<img src='Images/FileLogin_70' height='20' width='20'>";
}
?>
