<?php
require('Connection.php');
$Smp    = $_POST['Simpan'];
$gUnt   = $_POST['fUnt'];
$gSub   = $_POST['fSub'];
$gUpb   = $_POST['fUpb'];
$gThn   = $_POST['fThn'];
$gExt   = $_POST['fExt'];

$gBid   = $_POST['fBid'];
$gKel   = $_POST['fKel'];
$gOBJ   = $_POST['fOBJ'];
$gRin   = $_POST['fRin'];
$gFin   = $_POST['fFind'];
$fKdBar = $_POST['fKdBar'];
$eMuT   = $_POST['fSdhMutasi'];

if ($Smp == "DeleteRecord") {
	$DeLIDT = $_POST['CritIDT'];
	if ($DeLIDT != "") {
		$gReff  = fGlobal("Referensi", "ta_kib_108", "IDT", $DeLIDT, "=", "", "");
		$gRupb  = fGlobal("Kd_UPB", "ta_kib_108", "IDT", $DeLIDT, "=", "", "");
		if ($gReff != "") {
			#$SQL = "DELETE FROM ta_kib_post_108 WHERE Referensi='".$gReff."' AND Kd_UPB='".$gRupb."'";
			$SQL = "DELETE FROM ta_kib_post_108 WHERE Referensi='" . $gReff . "' AND Kd_UPB LIKE '" . substr($gRupb, 0, 11) . "%'";
			$rst = mysql_query($SQL) or die(mysql_error());
		}
		$SQL = "DELETE FROM ta_kib_108 WHERE IDT='" . $DeLIDT . "'";
		$rst = mysql_query($SQL) or die(mysql_error());
	}
}
$URL = "KIB-C.php?FrmG=" . $_GET['FrmG'] . "&eMuT=" . $eMuT . "&gKdBar=" . $fKdBar . "&gExt=" . $gExt . "&gUnt=" . $gUnt . "&gSub=" . $gSub . "&gUpb=" . $gUpb . "&gThn=" . $gThn . "&gBid=" . $gBid . "&gKel=" . $gKel . "&gOBJ=" . $gOBJ . "&gRin=" . $gRin . "&gFin=" . $gFin . "&IdL=" . $_GET['IdL'];
header("Location: " . $URL);
?>

<?php require('Connection_Close.php'); ?>
