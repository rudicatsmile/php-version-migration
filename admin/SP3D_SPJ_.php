<?php
require('Connection.php');
require('FileFunction.php');
extract($_POST);
extract($_GET);

$fSave = $fSave ?? ($_POST['fSave'] ?? ($_GET['fSave'] ?? ''));
$UplIdT = $UplIdT ?? ($_POST['UplIdT'] ?? ($_GET['UplIdT'] ?? ''));
$fUPB = $fUPB ?? ($_POST['fUPB'] ?? ($_GET['fUPB'] ?? ''));
$FrmG = $FrmG ?? ($_POST['FrmG'] ?? ($_GET['FrmG'] ?? ''));
$IdL  = $IdL ?? ($_POST['IdL'] ?? ($_GET['IdL'] ?? ''));

if ($fSave == 'Upload' && isset($_FILES['imgfile']) && $_FILES['imgfile']['error'] === UPLOAD_ERR_OK)
{
	$orig_name  = basename($_FILES['imgfile']['name']);
	$clean_name = preg_replace('/[^a-zA-Z0-9_.-]/', '_', $orig_name);
	$tmp_name   = $_FILES['imgfile']['tmp_name'];
	$file_size  = (int)$_FILES['imgfile']['size'];
	$file_type  = $_FILES['imgfile']['type'] ?? 'application/octet-stream';

	$targetDir = "../simandor/spj/";
	if (!is_dir($targetDir)) {
		@mkdir($targetDir, 0755, true);
	}

	$gRA = fGlobal("Referensi", "ta_sp3d_spj_rinci", "IDT", $UplIdT, "=", "", "");
	if ($gRA != '')
	{
		$nSQL = "INSERT INTO ta_sp3d_spj_rinci_file SET 
		Referensi='$gRA',
		Kd_UPB='$fUPB',
		Memo='x-x-x',
		file_content='', 
		file_name='$clean_name', 
		file_type='$file_type', 
		file_size='$file_size'";
		$nRs = mysql_query($nSQL);
		$newIDT = mysql_insert_id();

		$destFile = $targetDir . $newIDT . "xyz" . $clean_name;
		move_uploaded_file($tmp_name, $destFile);
	}
	$URL = "SP3D_SPJ.php?FrmG=" . $FrmG . "&gUPB=" . $fUPB . "&IdL=" . $IdL;
	header("Location: " . $URL);
	exit;
}
?>