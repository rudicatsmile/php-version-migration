<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
</head>
<?php
$CrT = $_GET['CrT'] ?? '';
$gKD = $_GET['gKD'] ?? '';
?>
<body>
<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" style="font-weight:bold; font-family:Calibri, Arial; font-size:11pt; border-collapse: collapse">
  <tr>
    <td width="670">DAFTAR REKENING ASET</td>
  </tr>
  <tr>
    <td>BERDASARKAN PERMENDAGRI NOMOR 17 TAHUN 2007</td>
  </tr>
  <tr>
    <td><hr size="1"></td>
  </tr>
</table>
<table width="670" border="0" cellspacing="0" cellpadding="0" align="center"  style="font-weight:bold; font-family:Calibri, Arial; font-size:9pt; border-collapse: collapse">
  <?php if ($CrT=="KEL" || $CrT=="JNS" || $CrT=="OBJ" || $CrT=="RIN") {?>
  <tr>
    <td>BIDANG</td>
    <td>:</td>
    <td><?=substr($gKD,0,2)." - ".strtoupper(fGlobal("Nm_Aset","Ref_Rek_Aset1","Kd_Aset",substr($gKD,0,2),"=","",""))?></td>
  </tr>
  <?php } ?>
  <?php if ($CrT=="JNS" || $CrT=="OBJ" || $CrT=="RIN") {?>
  <tr>
    <td>KELOMPOK</td>
    <td>:</td>
    <td><?=substr($gKD,0,5)." - ".strtoupper(fGlobal("Nm_Aset","Ref_Rek_Aset2","Kd_Aset",substr($gKD,0,5),"=","",""))?></td>
  </tr>
  <?php } ?>
  <?php if ($CrT=="OBJ" || $CrT=="RIN") {?>
  <tr>
    <td>JENIS</td>
    <td>:</td>
    <td><?=substr($gKD,0,8)." - ".strtoupper(fGlobal("Nm_Aset","Ref_Rek_Aset3","Kd_Aset",substr($gKD,0,8),"=","",""))?></td>
  </tr>
  <?php } ?>
  <?php if ($CrT=="RIN") {?>
  <tr>
    <td>OBJEK</td>
    <td>:</td>
    <td><?=substr($gKD,0,11)." - ".strtoupper(fGlobal("Nm_Aset","Ref_Rek_Aset4","Kd_Aset",substr($gKD,0,11),"=","",""))?></td>
  </tr>
  <?php } ?>
  <tr>
    <td height="5" width="70"></td>
    <td height="5" width="20"></td>
    <td height="5"></td>
  </tr>
</table><table width="670" border="1" cellspacing="1" cellpadding="1" align="center"  style="font-family:Calibri, Arial; font-size:9pt; border-collapse: collapse">
	<tr>
	  <td width="98" style="font-weight:bold">KODE</td>
	  <td style="font-weight:bold">URAIAN</td>
	</tr>
	<?php
	if ($CrT=="BDG") {echo Data_fBID();}
	if ($CrT=="KEL") {echo Data_fKEL($gKD,"");}
	if ($CrT=="JNS") {echo Data_fJNS($gKD,"");}
	if ($CrT=="OBJ") {echo Data_fOBJ($gKD,"");}
	if ($CrT=="RIN") {echo Data_fRIN($gKD,"");}
	function Data_fBID()
	{
		$iGA = 0;
		$SQA = "SELECT * FROM ref_rek_aset1 ORDER BY Kd_Aset";
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
			gViewData($gA,$gB,$xB);
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
			gViewData($gA,$gB,$xB);
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
			gViewData($gA,$gB,$xB);
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
			gViewData($gA,$gB,$xB);
			Data_fRIN($gA,"");
			$iGD++;
			}
			while ($mRD = mysql_fetch_assoc($nRD));	
		}
	}
	function Data_fRIN($gOBJ, $fSH = "")
	{
		$iGE = 0;
		$SQE="SELECT * FROM ref_rek_aset5 WHERE Kd_Aset LIKE '".$gOBJ."%' ORDER BY Kd_Aset";
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
			$xB = "";
			if ($iGE>0) {gViewRows();}
			gViewData($gA,$gB,$xB);
			$iGE++;
			}
			while ($mRE = mysql_fetch_assoc($nRE));	
		}
	}
	?>
	<?php function gViewData($dA,$dB,$xB) {?>
	<tr>
	  <td style="vertical-align:top"><?=$xB.$dA?></td>
	  <td style="vertical-align:top"><?=$xB.$dB?>&nbsp;</td>
	</tr>
	<?php } ?>
	<?php function gViewRows() {?>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<?php } ?>
</table>
</body>
</html>
