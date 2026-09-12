<?php
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";
ini_set('max_execution_time', 300);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
extract($_GET);
#echo $rBrk;
if ($gUnt=="All"){
	$gNmUNT = "SEMUA";
	$gNmSUB = "SEMUA";
	$gNmUPB = "SEMUA";
	$gKdUPB = "24.04.__.__.__.___";	
}
else{
	$gNmUNT = strtoupper(fGlobal("nm_unit","ref_unit","kd_unit",$gUnt,"=","",""));
	if ($gSub=="All"){
		$gNmSUB = "SEMUA";
		$gNmUPB = "SEMUA";	
		$gKdUPB = "24.04.".substr($gUnt,-5,5).".__.___";	
	}
	else{
		$gNmSUB = strtoupper(fGlobal("nm_sub","ref_sub_unit","kd_sub",$gSub,"=","",""));
		if ($gUpb=="All"){
			$gNmUPB = "SEMUA";	
			$gKdUPB = "24.04.".substr($gUnt,-5,5).".".substr($gSub,-2,2).".___";	
		}
		else{
			$gNmUPB = strtoupper(fGlobal("nm_upb","ref_upb","kd_upb",$gUpb,"=","",""));
			$gKdUPB = "24.04.".substr($gUnt,-5,5).".".substr($gSub,-2,2).".".substr($gUpb,-3,3);	
		}
	}
}

#echo $gBid."<br>";
#echo $gKel."<br>";
#echo $gJns."<br>";
#echo $gOBJ."<br>";
#echo $gRin."<br>";

if ($gBid=="All"){
	$gNmBID = "Semua";
	$gNmKEL = "Semua";
	$gNmJNS = "Semua";
	$gNmOBJ = "Semua";
	$gNmRIN = "Semua";
	$KdAset = "__.__.__.__.___";
}
else {
	$gNmBID = strtoupper(fGlobal("nm_aset","ref_rek_aset1","kd_aset",$gBid,"=","",""));
	if ($gKel=="All"){
		$gNmKEL = "Semua";
		$gNmJNS = "Semua";
		$gNmOBJ = "Semua";
		$gNmRIN = "Semua";
		$KdAset = $gBid.".__.__.__.___";
	}
	else{
		$gNmKEL = strtoupper(fGlobal("nm_aset","ref_rek_aset2","kd_aset",$gKel,"=","",""));
		if ($gJns=="All"){
			$gNmJNS = "Semua";
			$gNmOBJ = "Semua";
			$gNmRIN = "Semua";
			$KdAset = $gBid.".".substr($gKel,-2,2).".__.__.___";
		}
		else{
			$gNmJNS = strtoupper(fGlobal("nm_aset","ref_rek_aset3","kd_aset",$gJns,"=","",""));
			if ($gOBJ=="All"){
				$gNmOBJ = "Semua";
				$gNmRIN = "Semua";
				$KdAset = $gBid.".".substr($gKel,-2,2).".".substr($gJns,-2,2).".__.___";
			}
			else{
				$gNmOBJ = strtoupper(fGlobal("nm_aset","ref_rek_aset4","kd_aset",$gOBJ,"=","",""));
				if ($gRin=="All"){
					$gNmRIN = "Semua";
					$KdAset = $gBid.".".substr($gKel,-2,2).".".substr($gJns,-2,2).".".substr($gOBJ,-2,2).".___";
				}
				else{
					$gNmRIN = strtoupper(fGlobal("nm_aset","ref_rek_aset5","kd_aset",$gRin,"=","",""));
					$KdAset = $gBid.".".substr($gKel,-2,2).".".substr($gJns,-2,2).".".substr($gOBJ,-2,2).".".substr($gRin,-3,3);
				}
			}
		}
	}
}
?>
<table align="center" border="0" width="1300" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
<tr>
	<td style="font-size: 12pt; font-weight: bold" align="center">KARTU INVENTARIS BARANG (KIB)</td>
</tr>
<tr>
	<td style="font-size: 10pt; font-weight: bold" align="center">PENGADAAN ASET</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="1300" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
<tr>
	<td width="80">UNIT KERJA</td>
	<td width="25">:</td>
	<td width="350"><?=$gNmUNT?></td>
    <td width="30">&nbsp;</td>
    <td width="90">BIDANG</td>
    <td width="25">:</td>
    <td><?=$gNmBID?></td>
  </tr>
<tr>
  <td>SUB UNIT </td>
  <td>:</td>
  <td><?=$gNmSUB?></td>
  <td>&nbsp;</td>
  <td>KELOMPOK</td>
  <td>:</td>
  <td><?=$gNmKEL?></td>
</tr>
<tr>
  <td>UPB</td>
  <td>:</td>
  <td><?=$gNmUPB?></td>
  <td>&nbsp;</td>
  <td>JENIS</td>
  <td>:</td>
  <td><?=$gNmJNS?></td>
</tr>
<tr>
  <td>TAHUN</td>
  <td>:</td>
  <td><?=$gThN?></td>
  <td>&nbsp;</td>
  <td>OBJEK</td>
  <td>:</td>
  <td><?=$gNmOBJ?></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>RINCIAN OBJEK </td>
  <td>:</td>
  <td><?=$gNmRIN?></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="1300" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
<tr height="23" style="text-align:center; font-weight:bold">
	<td width="25" rowspan="2" style="border:1px solid #000">NO</td>
	<td width="85" rowspan="2" style="border:1px solid #000">REFERENSI</td>
	<td width="80" rowspan="2" style="border:1px solid #000">KODE</td>
	<td width="50" rowspan="2" style="border:1px solid #000">REGISTER</td>
	<td width="260" rowspan="2" style="border:1px solid #000">NAMA ASET</td>
	<td width="65" rowspan="2" style="border:1px solid #000">TANGGAL</td>
	<td colspan="3" style="border:1px solid #000">N I L A I</td>
	<td rowspan="2" style="border:1px solid #000">KETERANGAN</td>
</tr>
<tr height="23" style="text-align:center; font-weight:bold">
  <td width="100" style="border:1px solid #000">PEROLEHAN<br>BARU</td>
  <td width="100" style="border:1px solid #000">ATRIBUSI</td>
  <td width="100" style="border:1px solid #000">TOTAL</td>
</tr>
<tr style="text-align:center; font-weight:bold">
  <td style="border:1px solid #000; border-bottom:3px double #000">1</td>
  <td style="border:1px solid #000; border-bottom:3px double #000">2</td>
  <td style="border:1px solid #000; border-bottom:3px double #000">3</td>
  <td style="border:1px solid #000; border-bottom:3px double #000">4</td>
  <td style="border:1px solid #000; border-bottom:3px double #000">5</td>
  <td style="border:1px solid #000; border-bottom:3px double #000">6</td>
  <td style="border:1px solid #000; border-bottom:3px double #000">7</td>
  <td style="border:1px solid #000; border-bottom:3px double #000">8</td>
  <td style="border:1px solid #000; border-bottom:3px double #000">9=7+8</td>
  <td style="border:1px solid #000; border-bottom:3px double #000">10</td>
</tr>
<?php
$iG=1;
$nSQ="select Referensi, Ref_History, No_Register, Tanggal, Kd_UPB, Kd_Aset, Keterangan FROM ta_kib_post 
WHERE Kd_UPB LIKE '$gKdUPB' 
AND Kd_Aset LIKE '$KdAset' 
AND Tanggal LIKE '".$gThN."-%-%' AND ReValue = 'N' 
GROUP BY Referensi, Ref_History,Left(Kd_UPB,11) 
ORDER BY Kd_UPB, Kd_Aset,Tanggal";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$x1=""; $x2=""; $x3=""; $x4=""; $x5=""; $x6=""; $x7=""; $x8=""; $x9=""; $x10=""; 
	if ($iG>1 && $rBrk=="YA"){blankRows();}
	
	$rRef = $mRo['Referensi'];
	$rReh = $mRo['Ref_History'];
	$rUpb = $mRo['Kd_UPB'];
	$rCrT = $mRo['Crit'];
	
	$rTB = CekRefToNmTbl($rRef);
	if ($rTB=="e" || $rTB=="g"){
		$nSLD = fGlobal("IfNull(sum(debet),0)","ta_kib_post","referensi:ref_history:kd_upb:crit:tanggal",$rRef.":".$rReh.":".substr($rUpb,0,11)."%:SLD:".$gThN."-%-%","=:=:LIKE:=:LIKE","","");
		$nINV = fGlobal("IfNull(sum(debet),0)","ta_kib_post","referensi:ref_history:kd_upb:crit:tanggal",$rRef.":".$rReh.":".substr($rUpb,0,11)."%:INV:".$gThN."-%-%","=:=:LIKE:=:LIKE","","");
	}
	else{
		$nSLD = fGlobal("IfNull(sum(debet),0)","ta_kib_post","referensi:kd_upb:crit:tanggal",$rRef.":".substr($rUpb,0,11)."%:SLD:".$gThN."-%-%","=:LIKE:=:LIKE","","");
		$nINV = fGlobal("IfNull(sum(debet),0)","ta_kib_post","referensi:kd_upb:crit:tanggal",$rRef.":".substr($rUpb,0,11)."%:INV:".$gThN."-%-%","=:LIKE:=:LIKE","","");
	}
	$nNIL = $nSLD + $nINV;
	
	$NmAB = "";
	if ($rTB=="e" || $rTB=="g"){
		$nSW="select * from ta_kib_".CekRefToNmTbl($rRef)." WHERE Referensi='".$rRef."' AND Ref_Mutasi='".$rReh."' AND Kd_UPB LIKE '".substr($rUpb,0,11)."%'";
	}
	else{
		$nSW="select * from ta_kib_".CekRefToNmTbl($rRef)." WHERE Referensi='".$rRef."' AND Kd_UPB LIKE '".substr($rUpb,0,11)."%'";
	}
	$nRw = mysql_query($nSW);
	while ($mRw = mysql_fetch_array($nRw, MYSQL_BOTH))
	{
		$NmAB = $mRw['Nm_Aset'];
	}
	
	$tSLD = $tSLD + $nSLD;
	$tINV = $tINV + $nINV;
	$tNIL = $tNIL + $nNIL;
	
	$mRoK = $mRo['Keterangan'];
	$bR = "";
	if ($mRoK!=""){
		$bR = "<br>";
	}
	$rTMB="";
	if ($gNmUNT == "SEMUA"){
		$rTMB=$bR.strtolower("<i>(".fGlobal("nm_unit","ref_unit","kd_unit",substr($rUpb,0,11),"=","","")).")";
	}
	$x1  = $iG;
	$x2  = $mRo['Referensi'];
	$x3  = $mRo['Kd_Aset'];
	$x4  = $mRo['No_Register'];
	$x5  = $NmAB;
	$x6  = $mRo['Tanggal'];
	$x7  = $nSLD;
	$x8  = $nINV;
	$x9  = $nNIL;
	$x10 = $mRo['Keterangan'].$rTMB;

	$bold="normal";
	if ($rBrk=="YA"){
		$x10 = "";
		$bold="bold";
	}
	
	viewDATA($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$bold);
	if ($rBrk=="YA"){
		breakDATA($NmAB,$rTMB,$rRef,$rReh,$rUpb,$gThN,$rTB,"");
	}
	$iG++;
}	
	
function breakDATA($NmAB,$rTMB,$rRef,$rReh,$rUpb,$gThN,$rTB,$sh)
{
	$bold="normal";
	#if ($rTB=="e" || $rTB=="g"){
	#	$nSLD = fGlobal("IfNull(sum(debet),0)","ta_kib_post","referensi:ref_history:kd_upb:crit:tanggal",$rRef.":".$rReh.":".substr($rUpb,0,11)."%:SLD:".$gThN."-%-%","=:=:LIKE:=:LIKE","","");
	#	$nINV = fGlobal("IfNull(sum(debet),0)","ta_kib_post","referensi:ref_history:kd_upb:crit:tanggal",$rRef.":".$rReh.":".substr($rUpb,0,11)."%:INV:".$gThN."-%-%","=:=:LIKE:=:LIKE","","");
	#}
	#else{
	#	$nSLD = fGlobal("IfNull(sum(debet),0)","ta_kib_post","referensi:kd_upb:crit:tanggal",$rRef.":".substr($rUpb,0,11)."%:SLD:".$gThN."-%-%","=:LIKE:=:LIKE","","");
	#	$nINV = fGlobal("IfNull(sum(debet),0)","ta_kib_post","referensi:kd_upb:crit:tanggal",$rRef.":".substr($rUpb,0,11)."%:INV:".$gThN."-%-%","=:LIKE:=:LIKE","","");
	#}
	
	if ($rTB=="e" || $rTB=="g"){
		$nSW="select * FROM ta_kib_post WHERE Referensi='".$rRef."' AND ref_history='".$rRef."' AND Kd_UPB LIKE '".substr($rUpb,0,11)."%' AND Tanggal LIKE '".$gThN."-%-%' ORDER BY Referensi";
	}
	else{
		$nSW="select * FROM ta_kib_post WHERE Referensi='".$rRef."' AND Kd_UPB LIKE '".substr($rUpb,0,11)."%' AND Tanggal LIKE '".$gThN."-%-%' ORDER BY Referensi";
	}
	$nR = mysql_query($nSW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$rC  = $mR['Crit'];
		$x2  = $mR['Referensi'];
		$x3  = $mR['Kd_Aset'];
		$x4  = $mR['No_Register'];
		$x5  = $NmAB;
		$x6  = $mR['Tanggal'];
		if ($rC=="SLD"){
			$mSLD = $mR['Debet'];
			$mINV = 0;
		}
		else{
			$mSLD = 0;
			$mINV = $mR['Debet'];
		}
		
		$x7  = $mSLD;
		$x8  = $mINV;
		$x9  = $mR['Debet'];
		
		$x10 = $mR['Keterangan'].$rTMB;
		viewDATA($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$bold);
	}
}

?>
<?php


function viewDATA($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$bold)
{
?>
<tr height="20" style="vertical-align:top; font-weight:<?=$bold?>">
  <td style="border-left:1px solid #000; border-bottom:1px solid #000; border-right:1px solid #000; text-align:center"><?=$x1?></td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; text-align:center"><?=$x2?></td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; text-align:center"><?=$x3?></td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; text-align:center"><?=$x4?></td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; padding-left:3px"><?=$x5?></td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; text-align:center"><?=fConvertDateShort($x6)?></td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; padding-left:3px; text-align:right"><?php if($x7==0){echo "-";}else{echo fConvertToRupiah($x7);}?></td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; padding-left:3px; text-align:right"><?php if($x8==0){echo "-";}else{echo fConvertToRupiah($x8);}?></td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; padding-left:3px; text-align:right"><?php if($x9==0){echo "-";}else{echo fConvertToRupiah($x9);}?></td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; padding-left:3px"><?=$x10?></td>
</tr>
<?php 	
}
?>
<?php function blankRows(){?>
<tr>
  <td style="border-left:1px solid #000; border-bottom:1px solid #000; border-right:1px solid #000; text-align:center">&nbsp;</td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; text-align:center">&nbsp;</td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; text-align:center">&nbsp;</td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; text-align:center">&nbsp;</td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; padding-left:3px">&nbsp;</td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; text-align:center">&nbsp;</td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; padding-left:3px; text-align:right">&nbsp;</td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; padding-left:3px; text-align:right">&nbsp;</td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; padding-left:3px; text-align:right">&nbsp;</td>
  <td style="border-bottom:1px solid #000; border-right:1px solid #000; padding-left:3px">&nbsp;</td>
</tr>
<?php } ?>
<tr height="23" style="font-weight:bold">
  <td colspan="6" style="border:1px solid #000; border-top:3px double #000; text-align:center">T O T A L</td>
  <td style="border:1px solid #000; border-top:3px double #000; padding-left:3px; text-align:right"><?php if($tSLD==0){echo "-";}else{echo fConvertToRupiah($tSLD);}?></td>
  <td style="border:1px solid #000; border-top:3px double #000; padding-left:3px; text-align:right"><?php if($tINV==0){echo "-";}else{echo fConvertToRupiah($tINV);}?></td>
  <td style="border:1px solid #000; border-top:3px double #000; padding-left:3px; text-align:right"><?php if($tNIL==0){echo "-";}else{echo fConvertToRupiah($tNIL);}?></td>
  <td style="border:1px solid #000; border-top:3px double #000">&nbsp;</td>
</tr>
</table>
<br>
</body>

</html>

