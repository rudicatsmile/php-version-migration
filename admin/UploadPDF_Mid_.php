<?php
require "Connection.php";
require "FileFunction.php";
extract($_GET);
#$ReG = fGlobal("Referensi","ta_kib_".substr($crt,0,1),"IDT",$rIdT,"=","","");
$ReG = fGlobal("Referensi","ta_kib_108","IDT",$rIdT,"=","","");

$targetDir = "../simandor/kib_pdf/";
if (!is_dir($targetDir)) {
	@mkdir($targetDir, 0755, true);
}

$simpan = $_POST['Simpan'] ?? '';
$gIdT = $gIdT ?? ($_POST['gIdT'] ?? ($_GET['gIdT'] ?? ''));
$rIdT = $rIdT ?? ($_POST['rIdT'] ?? ($_GET['rIdT'] ?? ''));
$crt  = $crt ?? ($_POST['crt'] ?? ($_GET['crt'] ?? ''));
$IdL  = $IdL ?? ($_POST['IdL'] ?? ($_GET['IdL'] ?? ''));

if ($simpan == "Upload" && isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK)
{
	$orig_name = basename($_FILES['file']['name']);
	$clean_name = preg_replace('/[^a-zA-Z0-9_.-]/', '_', $orig_name);
	$tmp_name   = $_FILES['file']['tmp_name'];
	$file_size  = (int)$_FILES['file']['size'];
	$file_type  = $_FILES['file']['type'] ?? 'application/pdf';

	if (!empty($gIdT))
	{
		// Ambil file lama jika ada dan hapus
		$oldFile = fGlobal("file_name", "ta_kib_108_pdf", "IDT", $gIdT, "=", "", "");
		if ($oldFile) {
			$oldPath1 = $targetDir . $gIdT . "xyz" . $oldFile;
			$oldPath2 = $targetDir . $oldFile;
			if (file_exists($oldPath1)) { @unlink($oldPath1); }
			if (file_exists($oldPath2)) { @unlink($oldPath2); }
		}

		$destFile = $targetDir . $gIdT . "xyz" . $clean_name;
		move_uploaded_file($tmp_name, $destFile);

		$nSQL = "UPDATE ta_kib_108_pdf SET 
		file_content='', 
		file_name='$clean_name', 
		file_type='$file_type', 
		file_size='$file_size' WHERE IDT='".$gIdT."'";
		mysql_query($nSQL) or die(mysql_error());
	} 
	else 
	{
		$nSQL = "INSERT INTO ta_kib_108_pdf SET 
		Referensi='$ReG', 
		file_content='', 
		file_name='$clean_name', 
		file_type='$file_type', 
		file_size='$file_size'";
		mysql_query($nSQL) or die(mysql_error());
		$newIdT = mysql_insert_id();

		$destFile = $targetDir . $newIdT . "xyz" . $clean_name;
		move_uploaded_file($tmp_name, $destFile);
	}
	
	CloseWin($crt, $rIdT, $IdL);
}
if ($simpan == "Delete")
{
	if (!empty($gIdT))
	{
		$oldFile = fGlobal("file_name", "ta_kib_108_pdf", "IDT", $gIdT, "=", "", "");
		if ($oldFile) {
			$oldPath1 = $targetDir . $gIdT . "xyz" . $oldFile;
			$oldPath2 = $targetDir . $oldFile;
			if (file_exists($oldPath1)) { @unlink($oldPath1); }
			if (file_exists($oldPath2)) { @unlink($oldPath2); }
		}

		$nSQL = "DELETE FROM ta_kib_108_pdf WHERE IDT='".$gIdT."'";
		mysql_query($nSQL) or die(mysql_error());
	}
	CloseWin($crt, $rIdT, $IdL);
}

function CloseWin($crt,$rIdT,$IdL)
{
	$URL="Form_Asset_".strtoupper($crt)."_Mid.php?rIDT=".$rIdT."&IdL=".$IdL;
	?>
	<script language='JavaScript'>
	this.window.open('<?=$URL?>','WinFormKIB_Mid');
	this.window.focus();
	this.window.document.clear();
	this.window.document.close();
	this.setTimeout('self.close()',1);
	</script>
	<?php
}
?>
