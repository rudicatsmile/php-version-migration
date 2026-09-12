<?
require('Connection.php');
$Smp   = $_POST['Simpan'];
$KdAst1= $_GET['KdAst1'];
$KdAst2= $_GET['KdAst2'];
$KdAst3= $_GET['KdAst3'];
$KdAst4= $_GET['KdAst4'];

if ($Smp=="DeleteRecord")
	{
	$DeLIDT   = $_POST['CritIDT'];
	$SQL = "DELETE FROM ref_rek_aset5 WHERE IDT='".$DeLIDT."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	}
$URL="Ref_Kode_Aset_5.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG']."&KdAst1=".$KdAst1."&KdAst2=".$KdAst2."&KdAst3=".$KdAst3."&KdAst4=".$KdAst4;
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
