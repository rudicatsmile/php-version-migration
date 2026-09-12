<?
require('Connection.php');
$Smp   = $_POST['Simpan'];
$KdAst1= $_GET['KdAst1'];
if ($Smp=="DeleteRecord")
	{
	$DeLIDT   = $_POST['CritIDT'];
	$SQL = "DELETE FROM ref_rek_aset108_3 WHERE IDT='".$DeLIDT."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	}
$URL="Ref_Kode_Aset108_2.php?FrmG=".$_GET['FrmG']."&KdAst1=".$KdAst1."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG'];
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
