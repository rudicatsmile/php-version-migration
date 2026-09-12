<?php
require('Connection.php');
require('FileFunction.php');

$Smp    = $_POST['Simpan'];
$gUnt   = $_POST['fUnt'];

$gBid   = $_POST['fBid'];
$gFin   = $_POST['fFind'];
$gThn   = $_POST['fThn'];
$gSem   = $_POST['fSem'];
$gAst   = $_POST['fAst'];
$gPR   = $_POST['fPR'];
$gKG   = $_POST['fKG'];
$gSB   = $_POST['fSB'];
$gRK   = $_POST['fRK'];
$gUT   = $_POST['fUT'];

$gPer   = $_POST['fPer'];
$gApb   = $_POST['fApb'];

if ($Smp=="DeleteRecord")
{
	$DeLIDT = $_POST['CritIDT'];
	$gNOM = fGlobalNEW("Nomor","ta_pengadaan","IDT",$DeLIDT,"=","",DatabaseSB,$ConSB,"");
	$gBPN = fGlobalNEW("Aset","ta_pengadaan","IDT",$DeLIDT,"=","",DatabaseSB,$ConSB,"");
	$rNOM = fGlobalNEW("No_Berkas","ta_pengadaan","IDT",$DeLIDT,"=","",DatabaseSB,$ConSB,"");
	$rUPB = fGlobalNEW("Kd_Unit","ta_pengadaan","IDT",$DeLIDT,"=","",DatabaseSB,$ConSB,"");
	
	if ($gBPN=="Baru")
	{
		$gRin = fGlobalNEW("Kd_Aset","ta_pengadaan","IDT",$DeLIDT,"=","",DatabaseSB,$ConSB,"");
		if ($gRin)
		{
			$gTmp = strtolower(fNmHuruf((int)substr($gRin,0,2)));
			if ($gTmp)
			{
				if ($gNOM!="")
				{
					$SQL = "DELETE FROM ta_kib_108 WHERE No_Pengadaan='".$gNOM."' AND Kd_UPB LIKE '".$rUPB."%'";
					$rst = mysql_query($SQL) or die(mysql_error());
					
					$SQL = "DELETE FROM ta_kib_108_temp WHERE No_Pengadaan='".$gNOM."' AND Kd_UPB LIKE '".$rUPB."%'";
					$rst = mysql_query($SQL) or die(mysql_error());
					
					$SQL = "DELETE FROM ta_kib_post_108 WHERE No_Pengadaan='".$gNOM."' AND Kd_UPB LIKE '".$rUPB."%'";
					$rst = mysql_query($SQL) or die(mysql_error());
					
					$SQL = "DELETE FROM ta_kib_group WHERE No_Pengadaan='".$gNOM."' AND Kd_UPB LIKE '".$rUPB."%'";
					$rst = mysql_query($SQL) or die(mysql_error());
				}
			}
		}
	}
	else	//Penambahan Nilai
	{
		if ($gNOM!=""){
			$SQL = "DELETE FROM ta_kib_global_temp WHERE No_Pengadaan='".$gNOM."' AND Kd_UPB LIKE '".$rUPB."%'";
			$rst = mysql_query($SQL) or die(mysql_error());
			
			$SQL = "DELETE FROM ta_kib_post_108 WHERE No_Pengadaan='".$gNOM."' AND Kd_UPB LIKE '".$rUPB."%'";
			$rst = mysql_query($SQL) or die(mysql_error());
		}
	}
	
	$SQL = "DELETE FROM ta_pengadaan WHERE IDT='".$DeLIDT."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	
	$SQL = "DELETE FROM ta_pengadaan_rinci WHERE Nomor='".$gNOM."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	
	$SQL = "UPDATE ta_penerimaan_berkas SET Proses='N' WHERE Nomor='$rNOM'";
	$rst = mysql_query($SQL) or die(mysql_error());
	
}
$URL="Pengadaan.php?gUT=".$gUT."&gPer=".$gPer."&gApb=".$gApb."&gPR=".$gPR."&gKG=".$gKG."&gSB=".$gSB."&gRK=".$gRK."&gUnt=".$gUnt."&gThn=".$gThn."&gSem=".$gSem."&gAst=".$gAst."&gFin=".$gFin."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
header("Location: ".$URL);
?>
