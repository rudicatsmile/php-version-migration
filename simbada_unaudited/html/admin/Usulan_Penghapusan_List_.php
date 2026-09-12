<?
require('Connection.php');
require('FileFunction.php');

$Smp   = $_POST['Simpan'];
$gUnt  = $_POST['fUnt'];
$gSub  = $_POST['fSub'];
$gUpb  = $_POST['fUpb'];

if ($Smp=="DeleteRecord")
{
	$DeLIDT = $_REQUEST['CritIDT'];
	$DeLREF = fGlobal("Referensi","ta_penghapusan_usulan","IDT",$DeLIDT,"=","","");

	$SQL = "DELETE FROM ta_penghapusan_usulan_rinc WHERE Referensi='".$DeLREF."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	
	$SQL = "DELETE FROM ta_penghapusan_usulan WHERE IDT='".$DeLIDT."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	
	$URL="Usulan_Penghapusan_List.php?FrmG=".$_REQUEST['FrmG']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&IdL=".$_REQUEST['IdL'];
	header("Location: ".$URL);
}
else
{
	$URL="Usulan_Penghapusan_List.php?FrmG=".$_REQUEST['FrmG']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&IdL=".$_REQUEST['IdL'];
	header("Location: ".$URL);
}
?>

<?php require('Connection_Close.php');?>
