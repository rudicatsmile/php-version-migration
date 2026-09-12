<?
require('Connection.php');
extract($_POST);
extract($_GET);
$Smp    = $Simpan;

$gUnT   = $_POST['fUnT'];
$gUnTs  = $_POST['fUnTs'];

if ($Smp=="DeleteRecord")
{
	$DeLIDT   = $_POST['CritIDT'];
	$SQL = "DELETE FROM ref_upb WHERE IDT='".$DeLIDT."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	$URL="Ref_UPB.php?FrmG=".$FrmG."&IdL=".$IdL."&Page=".$Page."&iG=".$iG;
}

$URL="Ref_UPB.php?gUnT=".$gUnT."&gUnTs=".$gUnTs."&FrmG=".$FrmG."&IdL=".$IdL."&Page=".$Page."&iG=".$iG;
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
