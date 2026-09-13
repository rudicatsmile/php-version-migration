<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
</head>
<?php
$gBdg = $_GET['gBdg'];
$gMLK = $_GET['gMLK'];
$gThA = $_GET['gThA'];
$gThB = $_GET['gThB'];

$rReC = fGlobal("count(*)","ref_rek_aset2","Kd_Aset",$gBdg."%","LIKE","","");
$rMin = (int)substr(fGlobal("Min(Kd_Aset)","ref_rek_aset2","Kd_Aset",$gBdg."%","LIKE","",""),-2,2);
$rMax = (int)substr(fGlobal("Max(Kd_Aset)","ref_rek_aset2","Kd_Aset",$gBdg."%","LIKE","",""),-2,2);
?>
<body>
<table border="0" align="center" width="<?=600+($rReC*110)?>" cellspacing="1" style="font-family: Calibri; font-size: 8pt; border-collapse: collapse" id="table1">
	<tr>
		<td width="1285" align="center" style="font-size: 12pt; font-weight: bold">REKAPITULASI ASET PER KELOEMPOK</td>
	</tr>
	<tr>
		<td width="1285" align="center" style="font-size: 12pt"><span style="font-size: 11pt">Per Tanggal 1 Jan <?php echo $gThA?> s.d 31 Des <?php echo $gThB?></span></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
  </tr>
</table>
<table width="<?=600+($rReC*110)?>" align="center" cellspacing="1" border="1"  bordercolor="#000000" style="border-collapse: collapse; font-family: Calibri; font-size: 9pt">
	<tr>
		<td width="35" align="center" rowspan="2" style="font-weight: bold">NO</td>
		<td width="70" align="center" rowspan="2" style="font-weight: bold">KODE</td>
		<td align="center" rowspan="2" style="font-weight: bold">NAMA UNIT / SUB UNIT</td>
		<?php if ($rReC>0) {?>
		<td colspan="<?=$rReC+1?>" align="center" style="font-weight: bold">KELOMPOK ASET</td>
		<?php } ?>
	</tr>
	<tr>
		<?php for ($i=$rMin; $i<=$rMax; $i++) {?>
		<td width="110" style="font-weight: bold" align="center"><?=fGlobal("Nm_Aset","ref_rek_aset2","Kd_Aset",$gBdg.".".substr("00".$i,-2,2),"=","","")?></td>
		<?php } ?>
		<?php if ($rReC>0) {?>
		<td  align="center" style="font-weight: bold">JUMLAH</td>
		<?php } ?>
	</tr>
	<?php
	$nSQL= "SELECT * FROM ref_unit ORDER BY Kd_Unit";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$iG = 1;
		do
		{
			$xB  = "";
			$rID = $mRo['Kd_Unit'];
			$gID = $mRo['Kd_Unit'];
			$gNM = $mRo['Nm_Unit'];
			ViewR($iG.".",$rID,$gID,$gNM,$rReC,$rMin,$rMax,$gBdg,$gThA,$gThB,$xB);
			$rReD = fGlobal("count(*)","ref_sub_unit","Kd_Sub",$rID."%","LIKE","","");
			if ($rReD>1) {rSubUnit($iG,$rID,$rReC,$rMin,$rMax,$gBdg,$gThA,$gThB);}
			
			$iG++;
		}
		while ($mRo = mysql_fetch_assoc($nRs));
	}
	function rSubUnit($iG,$rID,$rReC,$rMin,$rMax,$gBdg,$gThA,$gThB)
	{
		$nSQB= "SELECT * FROM ref_sub_unit WHERE Kd_Sub LIKE '".$rID.".%' ORDER BY Kd_Sub";
		$nRsB = mysql_query($nSQB) or die(mysql_error());
		$mRoB = mysql_fetch_assoc($nRsB);
		$tRoB = mysql_num_rows($nRsB);
		if ($tRoB > 0)
		{
			$iGG = 1;
			do
			{
				$xB  = "<i>";
				$rID = $mRoB['Kd_Sub'];
				$gID = "";
				$gNM = "- ".$mRoB['Nm_Sub']."";
				ViewR("",$rID,$gID,$gNM,$rReC,$rMin,$rMax,$gBdg,$gThA,$gThB,$xB);
				$iGG++;
			}
			while ($mRoB = mysql_fetch_assoc($nRsB));
		}
	}
	
	function SumAset($gKlp,$gID,$gThA,$gThB)
	{
		$KdAsT = $gKlp;
		$JmlDB = fGlobal("IfNull(sum(debet),0)", "ta_kib_post","Kd_Aset:Kd_Upb:Tanggal:Tanggal:extracom",$gKlp."%:".$gID."%:".$gThA."-01-01:".$gThB."-12-31:N","LIKE:LIKE:>=:<=:=","","");
		$JmlKR = 0;
		return ($JmlDB-$JmlKR);
	}
	?>
	<?php function ViewR($iG,$rID,$gID,$gNM,$gReC,$rMin,$rMax,$gBdg,$gThA,$gThB,$xB) {?>
	<tr>
		<td width="35" style="text-align:center; vertical-align:top"><?=$xB.$iG?></td>
		<td width="74" style="text-align:center; vertical-align:top"><?=$xB.$gID?></td>
		<td style="vertical-align:top"><?=$xB.$gNM?></td>
		<?php for ($i=$rMin; $i<=$rMax; $i++) {?>
			<?php
			$gKlp = $gBdg.".".substr("00".$i,-2,2);
			$gJml = SumAset($gKlp,$rID,$gThA,$gThB);
			$tJml = $tJml + $gJml;
			?>
			<td width="110" style="text-align:right; vertical-align:top"><?=$xB.fConvertToRupiah($gJml)?></td>
		<?php } ?>
		<?php if ($gReC>0) {?>
		<td width="110" style="text-align:right; font-weight: bold"><?=$xB.fConvertToRupiah($tJml)?></td>
		<?php } ?>
	</tr>
	<?php
	}
	?>
	
	<tr>
		<td colspan="3" height="23" align="center" style="font-weight: bold; border-top: 3px double">JUMLAH</td>
		<?php for ($i=$rMin; $i<=$rMax; $i++) {?>
			<?php
			$gKlp = $gBdg.".".substr("00".$i,-2,2);
			$xJml = SumAset($gKlp,"%",$gThA,$gThB);
			$yJml = $yJml + $xJml;
			?>
			<td width="110" style="text-align:right; font-weight: bold; border-top: 3px double"><?=fConvertToRupiah($xJml)?></td>
		<?php } ?>
		<?php if ($rReC>0) {?>
		<td width="110" style="text-align:right; font-weight: bold; border-top: 3px double"><?=fConvertToRupiah($yJml)?></td>
		<?php } ?>
	</tr>
</table>
<p>
</body>
</html>
