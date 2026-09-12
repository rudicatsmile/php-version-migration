<?php
require('connfile.php');
$gSnD = addslashes($_POST['fT1']);
$gAlM = addslashes($_POST['fT3']);
$gDeS = addslashes($_POST['fT4']);

$file_content="";
$file_type="";
$file_size=0;
$file_name = $_FILES['fT2']['name'];
if ($file_name)
{
	$tmp_name  = $_FILES['fT2']['tmp_name'];
	$file_size = $_FILES['fT2']['size'];
	$file_type = $_FILES['fT2']['type'];
	$fp = fopen($tmp_name, 'r');
	$file_content = fread($fp, $file_size) or die("Tidak dapat membaca source file X");
	$file_content = mysql_real_escape_string($file_content) or die("Tidak dapat membaca source file..");
	fclose($fp);
}
if ($file_size > 1000000) {
	$file_content="";
	$file_type="";
	$file_size=0;
}

$mSQL = "INSERT INTO ta_kritik_saran SET 
Sumber='$gSnD',
Alamat='$gAlM',
Deskripsi='$gDeS',
Tampil='N',
photo='$file_content', 
file_type='$file_type', 
file_size='$file_size',
Recorded=now()";
$rst = mysql_query($mSQL) or die(mysql_error());

$URL="index.php";
header("Location: ".$URL);

?>