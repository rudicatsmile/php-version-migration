<?
require('Connection.php');
$Smp   = $_POST['Simpan'];
$gUnt  = $_POST['fUnt'];
$gFin  = $_POST['fFind'];
$gThn  = $_POST['fThn'];
$gPR   = $_POST['fPR'];
$gKG   = $_POST['fKG'];
$gSB   = $_POST['fSB'];
$gRK   = $_POST['fRK'];
$gPer  = $_POST['fPer'];
$gApb  = $_POST['fApb'];
$gUT   = $_POST['fUT'];


if ($Smp=="DeleteRecord")
	{
	$DeLIDT = $_POST['CritIDT'];	
	$SQL = "DELETE FROM ta_penerimaan_berkas WHERE IDT='".$DeLIDT."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	}
$URL="Penerimaan_Berkas.php?gUT=".$gUT."&gPer=".$gPer."&gApb=".$gApb."&gPR=".$gPR."&gKG=".$gKG."&gSB=".$gSB."&gRK=".$gRK."&gUnt=".$gUnt."&gThn=".$gThn."&gFin=".$gFin."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
header("Location: ".$URL);
?>
