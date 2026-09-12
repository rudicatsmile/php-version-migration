<?
require('Connection.php');
$Smp    = $_POST['Simpan'];
$gUnt   = $_POST['fUnt'];
$gSub   = $_POST['fSub'];
$gUpb   = $_POST['fUpb'];
$gThn   = $_POST['fThn'];

$gBid   = $_POST['fBid'];
$gKel   = $_POST['fKel'];
$gOBJ   = $_POST['fOBJ'];
$gRin   = $_POST['fRin'];
$gRad   = $_POST['radioKAPI'];
$gFin   = $_POST['fFind'];
$gSD    = $_POST['fSD'];
#echo $gSD;
#return false;

if ($Smp=="DeleteRecord")
	{
		$DeLIDT = $_POST['CritIDT'];
		if ($DeLIDT!=""){
			$gReff  = fGlobal("Referensi","Ta_KIB_108","IDT",$DeLIDT,"=","","");
			if ($gReff!=""){
				#$SQL = "DELETE FROM ta_kib_post_108 WHERE Referensi='".$gReff."' AND Kd_UPB='".$gRupb."'";
				$SQL = "DELETE FROM ta_kib_post_108 WHERE Referensi='".$gReff."' AND Kd_UPB LIKE '".substr($gRupb,0,11)."%'";
				$rst = mysql_query($SQL) or die(mysql_error());
			}
			$SQL = "DELETE FROM ta_kib_108 WHERE IDT='".$DeLIDT."'";
			$rst = mysql_query($SQL) or die(mysql_error());
		}
	}
$URL="KIB-F.php?FrmG=".$_GET['FrmG']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gBid=".$gBid."&gKel=".$gKel."&gOBJ=".$gOBJ."&gRin=".$gRin."&gFin=".$gFin."&gRad=".$gRad."&gSD=".$gSD."&IdL=".$_GET['IdL'];
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
