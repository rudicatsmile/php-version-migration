<?
require('Connection.php');
$Smp    = $_POST['Simpan'];
$IdRef1 = $_GET['IdRef1'];
$IdRef2 = $_GET['IdRef2'];
if ($Smp=="DeleteRecord")
	{
	$DeLIDT   = $_POST['CritIDT'];
	$SQL = "DELETE FROM ref_kegiatan WHERE IDO='".$DeLIDT."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	}
$URL="Ref_ProKeg_3.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&IdRef1=".$IdRef1."&IdRef2=".$IdRef2;
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
