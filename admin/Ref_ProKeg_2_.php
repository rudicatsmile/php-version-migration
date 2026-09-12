<?php
require('Connection.php');
$Smp    = $_POST['Simpan'];
$IdRef1 = $_GET['IdRef1'];
if ($Smp=="DeleteRecord")
	{
	$DeLIDT   = $_POST['CritIDT'];
	$SQL = "DELETE FROM ref_kegiatan WHERE IDO='".$DeLIDT."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	}
$URL="Ref_ProKeg_2.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG']."&IdRef1=".$IdRef1;
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
