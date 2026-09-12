<?php
require('Connection.php');
$Smp    = $_POST['Simpan'];
$gUnt   = $_POST['fUnt'];
$gFin   = $_POST['fFind'];
$gThn   = $_POST['fThn'];
$gPR   = $_POST['fPR'];
$gKG   = $_POST['fKG'];
$gSB   = $_POST['fSB'];
$gRK   = $_POST['fRK'];

if ($Smp=="DeleteRecord")
	{
	$DeLIDT = $_POST['CritIDT'];	
	$SQL = "DELETE FROM ta_penerimaan_berkas WHERE IDT='".$DeLIDT."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	}
$URL="Penerimaan_Berkas.php?gPR=".$gPR."&gKG=".$gKG."&gSB=".$gSB."&gRK=".$gRK."&gUnt=".$gUnt."&gThn=".$gThn."&gFin=".$gFin."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
header("Location: ".$URL);
?>
