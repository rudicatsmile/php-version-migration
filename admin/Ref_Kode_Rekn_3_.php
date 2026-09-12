<?php
require('Connection.php');
$Smp    = $_POST['Simpan'];
$KdRek1 = $_GET['KdRek1'];
$KdRek2 = $_GET['KdRek2'];
if ($Smp=="DeleteRecord")
	{
	$DeLIDT   = $_POST['CritIDT'];
	$SQL = "DELETE FROM ref_rek_3 WHERE IDT='".$DeLIDT."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	}
$URL="Ref_Kode_Rekn_3.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG']."&KdRek1=".$KdRek1."&KdRek2=".$KdRek2;
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
