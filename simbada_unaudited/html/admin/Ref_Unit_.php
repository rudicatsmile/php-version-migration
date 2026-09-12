<?
require('Connection.php');
$Smp    = $_POST['Simpan'];
$gBdG   = $_POST['fBdG'];

if ($Smp=="DeleteRecord")
	{
	$DeLIDT   = $_POST['CritIDT'];
	$SQL = "DELETE FROM ref_unit WHERE IDT='".$DeLIDT."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	}
$URL="Ref_Unit.php?gBdG=".$gBdG."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG'];
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
