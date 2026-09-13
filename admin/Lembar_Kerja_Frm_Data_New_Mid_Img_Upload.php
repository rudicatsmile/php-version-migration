<?php
require('Connection.php');
require('FileFunction.php');
$data = array();
extract($_GET);
extract($_POST);

$CrT = $CrT ?? ($_GET['CrT'] ?? ($_POST['CrT'] ?? ''));
$IdT = $IdT ?? ($_GET['IdT'] ?? ($_POST['IdT'] ?? ''));
$ReO = $ReO ?? ($_GET['ReO'] ?? ($_POST['ReO'] ?? ''));
$IdL = $IdL ?? ($_GET['IdL'] ?? ($_POST['IdL'] ?? ''));

if ($CrT == 'Img') {
	$fileInput = $_FILES['imgfile'] ?? null;
	$TbL = 'tb_lembar_kerja_foto_denah';
	$targetDir = "../simandor/lki_foto/";
} else {
	$fileInput = $_FILES['imgfile2'] ?? null;
	$TbL = 'tb_lembar_kerja_dokumen';
	$targetDir = "../simandor/lki_dokumen/";
}

if ($fileInput && isset($fileInput['error']) && $fileInput['error'] === UPLOAD_ERR_OK) {
	if (!is_dir($targetDir)) {
		@mkdir($targetDir, 0755, true);
	}

	$orig_name  = basename($fileInput['name']);
	$clean_name = preg_replace('/[^a-zA-Z0-9_.-]/', '_', $orig_name);
	$tmp_name   = $fileInput['tmp_name'];
	$file_size  = (int)$fileInput['size'];
	$file_type  = $fileInput['type'] ?? 'application/octet-stream';

	$eRf = fGlobal("Referensi", "tb_lembar_kerja_belum_tercatat", "IDT", $IdT, "=", "", "");
	$eRg = '';
	$eUp = fGlobal("KdUPB", "tb_lembar_kerja_belum_tercatat", "IDT", $IdT, "=", "", "");

	$SQ = "INSERT INTO $TbL SET 
	Referensi='".$eRf."',
	RefGroup='".$eRg."',
	KdUPB='".$eUp."',
	file_content='', 
	file_name='".$clean_name."', 
	file_type='".$file_type."', 
	file_size='".$file_size."'";
	$rs = mysql_query($SQ);
	$newIDT = mysql_insert_id();

	$destFile = $targetDir . $newIDT . "xyz" . $clean_name;
	move_uploaded_file($tmp_name, $destFile);
}
?>
<script languange="javascript">
NewAset('refr','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>');
</script>