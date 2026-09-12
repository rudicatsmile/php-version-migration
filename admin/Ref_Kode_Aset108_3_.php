<?php
require('Connection.php');
$Smp    = $_POST['Simpan'];
$KdAst1 = $_GET['KdAst1'];
$KdAst2 = $_GET['KdAst2'];
if ($Smp=="DeleteRecord")
	{
	$DeLIDT   = $_POST['CritIDT'];
	$SQL = "DELETE FROM ref_rek_aset108_4 WHERE IDT='".$DeLIDT."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	}
$URL="Ref_Kode_Aset108_3.php?FrmG=".$_GET['FrmG']."&Page=".$_GET['Page']."&iG=".$_GET['iG']."&KdAst1=".$KdAst1."&KdAst2=".$KdAst2."&IdL=".$_GET['IdL'];
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
