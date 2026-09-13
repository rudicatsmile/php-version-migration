<?php
require('Connection.php');
require('FileFunction.php');
$rIdT = $rIdT ?? ($_GET['rIdT'] ?? '');
$eIdT = $eIdT ?? ($_GET['eIdT'] ?? '');
$IdL  = $IdL ?? ($_GET['IdL'] ?? '');

if (!empty($rIdT)) {
	$oldFile = fGlobal("file_name", "ta_sp3d_spj_rinci_file", "IDT", $rIdT, "=", "", "");
	if ($oldFile) {
		$targetDir = "../simandor/spj/";
		$f1 = $targetDir . $rIdT . "xyz" . $oldFile;
		$f2 = $targetDir . $oldFile;
		if (file_exists($f1)) { @unlink($f1); }
		if (file_exists($f2)) { @unlink($f2); }
	}
	$nSQ = "DELETE FROM ta_sp3d_spj_rinci_file WHERE IDT='$rIdT'";
	$nRs = mysql_query($nSQ);
}
?>
<script type="text/javascript">
	//showREF('<?=$CrT?>','<?=$gIdT?>','<?=$IdL?>');
	showUPLOAD('refr','<?=$eIdT?>','','<?=$IdL?>');
</script>
