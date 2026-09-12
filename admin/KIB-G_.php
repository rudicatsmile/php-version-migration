<?php
require('Connection.php');
extract($_POST);
extract($_GET);
$Smp    = $_POST['Simpan'];
$gUnt   = $_POST['fUnt'];
$gSub   = $_POST['fSub'];
$gUpb   = $_POST['fUpb'];
$gRua   = $_POST['fRua'];
$gExt   = $_POST['fExt'];

$gThnA   = $_POST['fThnA'];
$gThn   = $_POST['fThn'];
$gBid   = $_POST['fBid'];
$gKel   = $_POST['fKel'];
$gOBJ   = $_POST['fOBJ'];
$gRin   = $_POST['fRin'];
$gFin   = $_POST['fFind'];
$fMuT   = $_POST['fMuT'];
$eMuT   = $_POST['fSdhMutasi'];

if ($Smp=="DeleteRecord")
	{
		$DeLIDT = $_POST['CritIDT'];
		if ($DeLIDT!=""){
			$gReff  = fGlobal("Referensi","ta_kib_108","IDT",$DeLIDT,"=","","");
			$gRupb  = fGlobal("Kd_UPB","ta_kib_108","IDT",$DeLIDT,"=","","");
			if ($gReff!=""){
				#$SQL = "DELETE FROM ta_kib_post_108 WHERE Referensi='".$gReff."' AND Kd_UPB='".$gRupb."'";
				$SQL = "DELETE FROM ta_kib_post_108 WHERE Referensi='".$gReff."' AND Kd_UPB LIKE '".substr($gRupb,0,11)."%'";
				$rst = mysql_query($SQL) or die(mysql_error());
			}
			$SQL = "DELETE FROM ta_kib_108 WHERE IDT='".$DeLIDT."'";
			$rst = mysql_query($SQL) or die(mysql_error());
		}
	}
$URL="KIB-G.php?FrmG=".$_GET['FrmG']."&eMuT=".$eMuT."&gMuT=".$fMuT."&gExt=".$gExt."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gRua=".$gRua."&gThn=".$gThn."&gThnA=".$gThnA."&gBid=".$gBid."&gKel=".$gKel."&gOBJ=".$gOBJ."&gRin=".$gRin."&gFin=".$gFin."&IdL=".$_GET['IdL'];
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
