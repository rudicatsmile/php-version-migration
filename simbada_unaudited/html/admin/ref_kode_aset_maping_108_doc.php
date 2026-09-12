<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
</head>
<?
$CrT = $_GET['CrT'];
$gKD = $_GET['gKD'];
#echo $gKD;
?>
<body>
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center" style="font-weight:bold; font-family:Calibri, Arial; font-size:11pt; border-collapse: collapse">
  <tr>
    <td width="670">DAFTAR MAPING REKENING ASET</td>
  </tr>
  <tr>
    <td>PERMENDAGRI NOMOR 17 TAHUN 2007 DAN PERMENDAGRI NOMOR 108 TAHUN 2016</td>
  </tr>
  <tr>
    <td><hr size="1"></td>
  </tr>
</table>
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center"  style="font-weight:bold; font-family:Calibri, Arial; font-size:9pt; border-collapse: collapse">
  <? if ($CrT=="BDG" || $CrT=="KEL" || $CrT=="JNS") {?>
  <tr>
    <td>BIDANG</td>
    <td>:</td>
    <td><?=substr($gKD,0,2)." - ".strtoupper(fGlobal("Nm_Aset","Ref_Rek_Aset1","Kd_Aset",substr($gKD,0,2),"=","",""))?></td>
  </tr>
  <? } ?>
  <? if ($CrT=="KEL" || $CrT=="JNS") {?>
  <tr>
    <td>KELOMPOK</td>
    <td>:</td>
    <td><?=substr($gKD,0,5)." - ".strtoupper(fGlobal("Nm_Aset","Ref_Rek_Aset2","Kd_Aset",substr($gKD,0,5),"=","",""))?></td>
  </tr>
  <? } ?>
  <? if ($CrT=="JNS") {?>
  <tr>
    <td>JENIS</td>
    <td>:</td>
    <td><?=substr($gKD,0,8)." - ".strtoupper(fGlobal("Nm_Aset","Ref_Rek_Aset3","Kd_Aset",substr($gKD,0,8),"=","",""))?></td>
  </tr>
  <? } ?>
  <tr>
    <td height="5" width="70"></td>
    <td height="5" width="20"></td>
    <td height="5"></td>
  </tr>
</table><table width="800" border="1" cellspacing="1" cellpadding="1" align="center" style="border-collapse:collapse; font-family:Calibri, Arial; font-size:9pt;">
	<tr height="25">
	  <td colspan="2" style="font-weight:bold; text-align:center">PERMENDAGRI NOMOR 17 TAHUN 2007</td>
	  <td colspan="2" style="font-weight:bold; text-align:center">PERMENDAGRI NOMOR 108 TAHUN 2016</td>
    </tr>
	<tr height="25">
	  <td width="98" style="font-weight:bold; padding-left:5px">KODE</td>
	  <td width="300" style="font-weight:bold; padding-left:5px">URAIAN</td>
	  <td width="100" style="font-weight:bold; padding-left:5px">KODE</td>
	  <td style="font-weight:bold; padding-left:5px">URAIAN</td>
	</tr>
	<?
	#if ($CrT=="BDG") {echo Data_fBID();}
	if ($CrT=="BDG") {echo Data_fKEL($gKD,"");}
	if ($CrT=="KEL") {echo Data_fJNS($gKD,"");}
	if ($CrT=="JNS") {echo Data_fOBJ($gKD,"");}
	function Data_fBID()
	{
		$iGA = 0;
		$SQA = "SELECT * FROM ref_rek_aset1 ORDER BY Kd_Aset";
		echo $SQA;
		$nRA = mysql_query($SQA) or die(mysql_error());
		$mRA = mysql_fetch_assoc($nRA);
		$tRA = mysql_num_rows($nRA);
		if ($tRA > 0)
		{
		do
			{
			$gA = $mRA['Kd_Aset'];
			$gB = strtoupper($mRA['Nm_Aset']);
			$xB = "<b>";
			if ($iGA>0) {gViewRows();}
			gViewData($gA,$gB,$gC,$gD,$xB);
			Data_fKEL($gA,"");
			$iGA++;
			}
			while ($mRA = mysql_fetch_assoc($nRA));	
		}
	}
	
	function Data_fKEL($gBDG,$fSH)
	{
		$iGB = 0;
		$SQB = "SELECT * FROM ref_rek_aset2 WHERE Kd_Aset LIKE '".$gBDG."%' ORDER BY Kd_Aset";
		if ($fSH!="") {echo $SQB."<br>";}
		$nRB = mysql_query($SQB) or die(mysql_error());
		$mRB = mysql_fetch_assoc($nRB);
		$tRB = mysql_num_rows($nRB);
		if ($tRB > 0)
		{
		do
			{
			$gA = $mRB['Kd_Aset'];
			$gB = $mRB['Nm_Aset'];
			$xB="<b>";
			if ($iGB>0) {gViewRows();}
			gViewData($gA,$gB,$gC,$gD,$xB);
			Data_fJNS($gA,"");
			$iGB++;
			}
			while ($mRB = mysql_fetch_assoc($nRB));	
		}
	}
	
	function Data_fJNS($gKEL,$fSH)
	{
		$iGC = 0;
		$SQC="SELECT * FROM ref_rek_aset3 WHERE Kd_Aset LIKE '".$gKEL."%' ORDER BY Kd_Aset";
		if ($fSH!="") {echo $SQC."<br>";}
		$nRC = mysql_query($SQC) or die(mysql_error());
		$mRC = mysql_fetch_assoc($nRC);
		$tRC = mysql_num_rows($nRC);
		if ($tRC > 0)
		{
		do
			{
			$gA = $mRC['Kd_Aset'];
			$gB = $mRC['Nm_Aset'];
			$xB = "<b>";
			if ($iGC>0) {gViewRows();}
			gViewData($gA,$gB,$gC,$gD,$xB);
			Data_fOBJ($gA,"");
			$iGC++;
			}
			while ($mRC = mysql_fetch_assoc($nRC));	
		}
	}
	
	function Data_fOBJ($gJNS,$fSH)
	{
		$iGD = 0;
		$SQD = "SELECT * FROM ref_rek_aset4 WHERE Kd_Aset LIKE '".$gJNS."%' ORDER BY Kd_Aset";
		if ($fSH!="") {echo $SQD."<br>";}
		$nRD = mysql_query($SQD) or die(mysql_error());
		$mRD = mysql_fetch_assoc($nRD);
		$tRD = mysql_num_rows($nRD);
		if ($tRD > 0)
		{
		do
			{
			$gA = $mRD['Kd_Aset'];
			$gB = $mRD['Nm_Aset'];
			$xB = "<b>";
			if ($iGD>0) {gViewRows();}
			gViewData($gA,$gB,$gC,$gD,$xB);
			Data_fRIN($gA,"");
			$iGD++;
			}
			while ($mRD = mysql_fetch_assoc($nRD));	
		}
	}
	function Data_fRIN($gOBJ)
	{
		$SQE="SELECT P1.kd_aset, P1.nm_aset, P2.kd_aset108, P3.nm_aset 
		FROM ref_rek_aset5 P1 
		LEFT JOIN ref_rek_aset5_maping P2 ON P2.kd_aset17=P1.kd_aset 
		LEFT JOIN ref_rek_aset108_7 P3 ON P3.kd_aset=P2.kd_aset108 
		WHERE P1.kd_aset LIKE '".$gOBJ."%' ORDER BY P1.kd_aset";
		if ($fSH!="") {echo $SQE."<br>";}
		$nRE = mysql_query($SQE);
		while ($mRE= mysql_fetch_array($nRE, MYSQL_BOTH))
		{
			$gA = $mRE[0];
			$gB = $mRE[1];
			$gC = $mRE[2];
			$gD = $mRE[3];
			$xB = "";
			if ($iGC>0) {gViewRows();}
			gViewData($gA,$gB,$gC,$gD,$xB);
		}
	}
	?>
	<? function gViewData($dA,$dB,$dC,$dD,$xB) {?>
	<tr>
	  <td style="padding-left:5px"><?=$xB.$dA?></td>
	  <td style="padding-left:5px"><?=$xB.$dB?>&nbsp;</td>
	  <td style="padding-left:5px"><?=$xB.$dC?></td>
	  <td style="padding-left:5px"><?=$xB.$dD?></td>
	</tr>
	<? } ?>
	<? function gViewRows() {?>
	<tr>
	  <td>&nbsp;</td>
	  <td colspan="3">&nbsp;</td>
	</tr>
	<? } ?>
</table>
</body>
</html>
