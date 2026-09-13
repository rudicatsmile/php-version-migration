<?php
require('Connection.php');
require('FileFunction.php');
$CrT  = $CrT ?? ($_GET['CrT'] ?? '');
$rIdT = $rIdT ?? ($_GET['rIdT'] ?? '');
$AsT  = $AsT ?? ($_GET['AsT'] ?? '');
$ReO  = $ReO ?? ($_GET['ReO'] ?? '');
$IdT  = $IdT ?? ($_GET['IdT'] ?? '');
$IdL  = $IdL ?? ($_GET['IdL'] ?? '');

if ($CrT == 'Img')
{
	$TbL = "tb_lembar_kerja_foto_denah";
	$targetDir = "../simandor/lki_foto/";
}
else
{
	$TbL = "tb_lembar_kerja_dokumen";
	$targetDir = "../simandor/lki_dokumen/";
}

if (!empty($rIdT)) {
	$oldFile = fGlobal("file_name", $TbL, "IDT", $rIdT, "=", "", "");
	if ($oldFile) {
		$f1 = $targetDir . $rIdT . "xyz" . $oldFile;
		$f2 = $targetDir . $oldFile;
		if (file_exists($f1)) { @unlink($f1); }
		if (file_exists($f2)) { @unlink($f2); }
	}
	$SQ = "DELETE FROM $TbL WHERE IDT='".$rIdT."'";
	$rs = mysql_query($SQ);
}
?>
<script languange="javascript">
showLKI('refr','<?=$AsT?>','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>');
</script>