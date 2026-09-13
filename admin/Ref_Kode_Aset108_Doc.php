<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
</head>
<?php
$CrT = $_GET['CrT'];
$gKD = $_GET['gKD'];
?>
<body>
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center" style="font-weight:bold; font-family:Calibri, Arial; font-size:11pt; border-collapse: collapse">
  <tr>
    <td width="670">DAFTAR REKENING ASET</td>
  </tr>
  <tr>
    <td>BERDASARKAN PERMENDAGRI NOMOR 108 TAHUN 2016</td>
  </tr>
  <tr>
    <td><hr size="1"></td>
  </tr>
</table>
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center"  style="font-weight:bold; font-family:Calibri, Arial; font-size:9pt; border-collapse: collapse">
  <?php if ($CrT=="KEL" || $CrT=="JNS" || $CrT=="OBJ" || $CrT=="RIN" || $CrT=="SUB") {?>
  <tr>
    <td>KELOMPOK</td>
    <td>:</td>
    <td><?=substr($gKD,0,3)." - ".strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_2","Kd_Aset",substr($gKD,0,3),"=","",""))?></td>
  </tr>
  <?php } ?>
  <?php if ($CrT=="JNS" || $CrT=="OBJ" || $CrT=="RIN" || $CrT=="SUB") {?>
  <tr>
    <td>JENIS</td>
    <td>:</td>
    <td><?=substr($gKD,0,5)." - ".strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_3","Kd_Aset",substr($gKD,0,5),"=","",""))?></td>
  </tr>
  <?php } ?>
  <?php if ($CrT=="OBJ" || $CrT=="RIN" || $CrT=="SUB") {?>
  <tr>
    <td>OBJEK</td>
    <td>:</td>
    <td><?=substr($gKD,0,8)." - ".strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_4","Kd_Aset",substr($gKD,0,8),"=","",""))?></td>
  </tr>
  <?php } ?>
  <?php if ($CrT=="RIN" || $CrT=="SUB") {?>
  <tr>
    <td>R. OBJEK </td>
    <td>:</td>
    <td><?=substr($gKD,0,11)." - ".strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_5","Kd_Aset",substr($gKD,0,11),"=","",""))?></td>
  </tr>
  <?php } ?>
  <?php if ($CrT=="SUB") {?>
  <tr>
    <td>SUB R. OBJEK </td>
    <td>:</td>
    <td><?=substr($gKD,0,14)." - ".strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_6","Kd_Aset",substr($gKD,0,14),"=","",""))?></td>
  </tr>
  <?php } ?>
  <tr>
    <td height="5" width="80"></td>
    <td height="5" width="20"></td>
    <td height="5"></td>
  </tr>
</table>
<table width="800" border="1" cellspacing="1" cellpadding="1" align="center"  style="font-family:Calibri, Arial; font-size:9pt; border-collapse: collapse">
  <tr style="font-weight:bold; text-align:center">
    <td width="99">KODE</td>
    <td>NAMA REKENING</td>
    <td width="57">UMUR EKONOMIS</td>
    <td width="273">OVERHAUL</td>
  </tr>
  <?php
	if ($CrT=="BDG") {echo Data_fBID();}
	if ($CrT=="KEL") {echo Data_fKEL($gKD,"");}
	if ($CrT=="JNS") {echo Data_fJNS($gKD,"");}
	if ($CrT=="OBJ") {echo Data_fOBJ($gKD,"");}
	if ($CrT=="RIN") {echo Data_fRIN($gKD,"");}
	if ($CrT=="SUB") {echo Data_fSUB($gKD,"");}
	
	function Data_fBID()
	{
		$iGA = 0;
		$SQA = "SELECT * FROM ref_rek_aset108_2 ORDER BY Kd_Aset";
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
			gViewData($gA,$gB,'','',$xB);
			Data_fKEL($gA,"");
			$iGA++;
			}
			while ($mRA = mysql_fetch_assoc($nRA));	
		}
	}
	
	function Data_fKEL($gBDG,$fSH)
	{
		$iGB = 0;
		$SQB = "SELECT * FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '".$gBDG."%' ORDER BY Kd_Aset";
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
			gViewData($gA,$gB,'','',$xB);
			Data_fJNS($gA,"");
			$iGB++;
			}
			while ($mRB = mysql_fetch_assoc($nRB));	
		}
	}
	
	function Data_fJNS($gKEL,$fSH)
	{
		$iGC = 0;
		$SQC="SELECT * FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '".$gKEL."%' ORDER BY Kd_Aset";
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
			gViewData($gA,$gB,'','',$xB);
			Data_fOBJ($gA,"");
			$iGC++;
			}
			while ($mRC = mysql_fetch_assoc($nRC));	
		}
	}
	
	function Data_fOBJ($gJNS,$fSH)
	{
		$iGD = 0;
		$SQD = "SELECT * FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$gJNS."%' ORDER BY Kd_Aset";
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
			gViewData($gA,$gB,'','',$xB);
			Data_fRIN($gA,"");
			$iGD++;
			}
			while ($mRD = mysql_fetch_assoc($nRD));	
		}
	}
	function Data_fRIN($gOBJ)
	{
		$iGE = 0;
		$SQE="SELECT * FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '".$gOBJ."%' ORDER BY Kd_Aset";
		if ($fSH!="") {echo $SQE."<br>";}
		$nRE = mysql_query($SQE) or die(mysql_error());
		$mRE = mysql_fetch_assoc($nRE);
		$tRE = mysql_num_rows($nRE);
		if ($tRE > 0)
		{
		do
			{
			$gA = $mRE['Kd_Aset'];
			$gB = $mRE['Nm_Aset'];
			$xB = "<b>";
			if ($iGE>0) {gViewRows();}
			gViewData($gA,$gB,'','',$xB);
			Data_fSUB($gA,"");
			$iGE++;
			}
			while ($mRE = mysql_fetch_assoc($nRE));	
		}
	}
	function Data_fSUB($gRIN)
	{
		$SQE="SELECT * FROM ref_rek_aset108_7 WHERE Kd_Aset LIKE '".$gRIN."%' ORDER BY Kd_Aset";
		if ($fSH!="") {echo $SQE."<br>";}
		$nRs = mysql_query($SQE) or die(mysql_error());
		while ($mRE = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$gA = $mRE['Kd_Aset'];
			$gB = $mRE['Nm_Aset'];
			$gC = $mRE['Ms_Manfaat'];
			$gD = LoadOverHoul($gA);
			$xB = "";
			if ($iGC>0) {gViewRows();}
			gViewData($gA,$gB,$gC,$gD,$xB);
		}
	}
	?>
  <?php function gViewData($dA,$dB,$dC,$gD,$xB) {?>
  <tr>
    <td style="padding-left:5px"><?=$xB.$dA?></td>
    <td style="padding-left:5px"><?=$xB.$dB?></td>
    <td style="text-align:center"><?php if ($dC>0) {echo $xB.$dC;} else {echo "-";}?></td>
    <td style="text-align:center"><?php if ($gD!='') {echo $xB.$gD;} else {echo "-";}?></td>
  </tr>
  <?php } ?>
  <?php function gViewRows() {?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php } ?>
</table>
</body>
</html>
<?php
function LoadOverHoul($gA)
{
	$eV = "";
	$iGE = 1;
	$SQO="SELECT tA, tB, tUmur FROM ta_masa_manfaat_108 WHERE Kode = '".$gA."' ORDER BY IDT";
	$nR = mysql_query($SQO) or die(mysql_error());
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		if ($iGE==1)
		{
			$eV = $mR[0]."-".$mR[1]."% = ".$mR[2];
		}
		else
		{
			$eV.= "; ".$mR[0]."-".$mR[1]."% = ".$mR[2];
		}
		$iGE++;
	}
	return $eV;
}
?>
