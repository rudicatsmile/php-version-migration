<?
require('Connection.php');
$Smp  = $_POST['fSimpan'];
$fRB  = $_POST['RB_AR'];
$fAct = $_POST['fAct'];
$fRed = $_POST['fRed'];
$eIdT = $_GET['eIdT'];
$IdL  = $_GET['IdL'];
$Lev  = fFindUID($IdL,"Level");

if ($Lev<=2)
{
	$fCet = $_POST['fCet'];
	$fSen = $_POST['fSen'];
}

if ($Smp=="Save")
	{
		if ($fAct=="ON") {$gAct="Y";} else {$gAct="N";}
		if ($fRed=="ON") {$gRed="Y";} else {$gRed="N";}
		if ($Lev<=2)
		{
			if ($fCet=="ON") {$gCet="Y";} else {$gCet="N";}
			if ($fSen=="ON") {$gSen="Y";} else {$gSen="N";}
		}

		if ($fRB!="")
		{
			$fRBa= substr($fRB,0,1);
			$fRBb= substr($fRB,1,1);
		}
		else
		{
			$fRBa= 4;
			$fRBb= 0;
		}
		if ($Lev<=2)
		{
			$SQL = "UPDATE ta_user SET Level='$fRBa', Admin='$fRBb', Active='$gAct', Readonly='$gRed', Cetak_Barcode='$gCet', User_Sekolah='$gSen' WHERE IDT='".$eIdT."'";
		}
		else
		{
			$SQL = "UPDATE ta_user SET Level='$fRBa', Admin='$fRBb', Active='$gAct', Readonly='$gRed' WHERE IDT='".$eIdT."'";
		}
		$rst = mysql_query($SQL) or die(mysql_error());
		$MsG = "Update Data berhasil...!!";
		
	}
else if ($Smp=="Reset")
	{
		#$SQL = "update ta_user set Level='4', Admin='0', Active='N', Cetak_Barcode='N', User_Sekolah='N' WHERE IDT='".$eIdT."'";
		#$rst = mysql_query($SQL) or die(mysql_error());
		$MsG = "Reset Data User berhasil...!!";
	}
$URL="Reg_User_Mid.php?MsG=".$MsG."&eIdT=".$eIdT."&IdL=".$IdL;
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
