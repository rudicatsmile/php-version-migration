<?php
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
$gFin   = $_POST['fFind'];

$URL="Inventarisasi_KIB-E.php?FrmG=".$_GET['FrmG']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gBid=".$gBid."&gKel=".$gKel."&gOBJ=".$gOBJ."&gRin=".$gRin."&gFin=".$gFin."&IdL=".$_GET['IdL'];
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
