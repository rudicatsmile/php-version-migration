<?php
require "Connection.php";
require('FileFunction.php');
$CrT  = $CrT ?? ($_GET['CrT'] ?? '');
$rIdT = $rIdT ?? ($_GET['rIdT'] ?? '');

if ($CrT == 'Img')
{
	$query = "SELECT file_content, file_type, file_name, file_size FROM tb_lembar_kerja_foto_denah WHERE IDT='".$rIdT."'";
	$data = mysql_query($query);
	$row = $data ? mysql_fetch_array($data) : null;
	$gCont = $row[0] ?? '';
	$gType = $row[1] ?? 'image/jpeg';
	$nName = $row[2] ?? '';
	$nSize = $row[3] ?? 0;

	$targetDir = "../simandor/lki_foto/";
	$physFile1 = $targetDir . $rIdT . "xyz" . $nName;
	$physFile2 = $targetDir . $nName;

	if ($nName != "" && file_exists($physFile1) && is_file($physFile1)) {
		if (!headers_sent()) {
			header("Content-length: " . filesize($physFile1));
			header("Content-type: " . $gType);
		}
		readfile($physFile1);
		exit;
	} elseif ($nName != "" && file_exists($physFile2) && is_file($physFile2)) {
		if (!headers_sent()) {
			header("Content-length: " . filesize($physFile2));
			header("Content-type: " . $gType);
		}
		readfile($physFile2);
		exit;
	} elseif (!empty($gCont)) {
		if (!headers_sent()) {
			header("Content-length: " . ($nSize ?: strlen($gCont)));
			header("Content-type: " . $gType);
		}
		echo $gCont;
		exit;
	}
}
else if ($CrT == 'Pdf')
{
	$query = "SELECT file_content, file_type, file_name, file_size FROM tb_lembar_kerja_dokumen WHERE IDT='".$rIdT."'";
	$data = mysql_query($query);
	$row = $data ? mysql_fetch_array($data) : null;
	$gCont = $row[0] ?? '';
	$gType = $row[1] ?? 'application/pdf';
	$nName = $row[2] ?? '';
	$nSize = $row[3] ?? 0;

	$targetDir = "../simandor/lki_dokumen/";
	$physFile1 = $targetDir . $rIdT . "xyz" . $nName;
	$physFile2 = $targetDir . $nName;

	if ($nName != "" && file_exists($physFile1) && is_file($physFile1)) {
		if (!headers_sent()) {
			header("Content-type: " . ($gType ?: 'application/pdf'));
			header('Content-disposition: inline; filename="' . $nName . '"');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . filesize($physFile1));
			header('Accept-Ranges: bytes');
		}
		readfile($physFile1);
		exit;
	} elseif ($nName != "" && file_exists($physFile2) && is_file($physFile2)) {
		if (!headers_sent()) {
			header("Content-type: " . ($gType ?: 'application/pdf'));
			header('Content-disposition: inline; filename="' . $nName . '"');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . filesize($physFile2));
			header('Accept-Ranges: bytes');
		}
		readfile($physFile2);
		exit;
	} elseif (!empty($gCont)) {
		if (!headers_sent()) {
			header("Content-type: " . ($gType ?: 'application/pdf'));
			header('Content-disposition: inline; filename="' . $nName . '"');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . ($nSize ?: strlen($gCont)));
			header('Accept-Ranges: bytes');
		}
		echo $gCont;
		exit;
	}
}
else if ($CrT=='Smd')
{
	?>
	<style>
	body {
	text-align:center;
	vertical-align:middle;
	margin-top:20pt;
	
	}
	</style>
	<?php
	$nName = fGlobal("file_name","ta_kib_108","IDT",$rIdT,"=","","");
	echo "<img src='simandor/images/".$rIdT."xyz".$nName."' style='width:600px' />";
}
else
{
	echo "<img src='Images/FileLogin_70' height='20' width='20'>";
}
?>
