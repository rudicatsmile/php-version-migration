<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<?php require "Import_KIB_Reader.php"?>
<?php
ini_set('max_execution_time', 600);
$gPCT= $UID."-ImpXLS";
$gUnt= $_GET['gUnt'];
$gSub= $_GET['gSub'];
$gUpb= $_GET['gUpb'];
$gThn= $_GET['gThn'];
$gKib= $_GET['gKib'];
$gIDT= $_GET['gIDT'];
$fL  = $_GET['fL'];

$gNmF= fGlobal("Nm_File","ta_upload_excel","IDT",$gIDT,"=","","");
$data = new Spreadsheet_Excel_Reader();		// ExcelFile($filename, $encoding);
$data->setOutputEncoding('CP1251');			// Set output Encoding.
$data->read('xls_file/kib_'.strtolower($gKib).'_xls_file/'.$gNmF);
error_reporting(E_ALL ^ E_NOTICE);

require "Import_KIB_Display_".strtoupper($gKib)."_.php";

//Update status
if ($fL==''){
	$SQ = "UPDATE ta_upload_excel SET Imported='Y' WHERE IDT='".$gIDT."'";
	$rs = mysql_query($SQ) or die(mysql_error());
	
	$SQ = "TRUNCATE TABLE ta_kib_108_import_test";
	$rs = mysql_query($SQ) or die(mysql_error());
	
	$SQ = "TRUNCATE TABLE ta_kib_post_108_import_test";
	$rs = mysql_query($SQ) or die(mysql_error());
	
	$MSG = "Proses import data berhasil...!!";
}
else{
	$MSG = "Proses TEST import data berhasil...!!";
}

$URL="Import_KIB_Source.php?MSG=".$MSG."&gIDT=".$gIDT."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gKib=".$gKib."&IdL=".$_GET['IdL'];
header("Location: ".$URL);
?>