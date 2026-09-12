<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_mid.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?
extract($_GET);
extract($_POST);

$gIdT;
$gFin  = $fFind;
$TakeOff = $TakeOff;

if ($TakeOff=="Ya")
{
	$gNOM;
	$SQ="UPDATE ta_penerimaan_berkas SET CritBayar_LinkUangMuka='$gNOM' WHERE IDT='$gIdT'";
	$nRs = mysql_query($SQ) or die(mysql_error());
	
	$URLK = "Penerimaan_Berkas_Mid.php?gIdT=".$gIdT."&IdL=".$IdL;
	$gTrGt="WinFormKIB_Mid";
	?>
	<script language="JavaScript">  	
	this.window.open ('<? echo $URLK ?>','<?=$gTrGt?>')
	this.window.focus()
	this.window.document.clear()
	this.window.document.close() 
	this.setTimeout("self.close()",1)
	</script>
	<?
	return false;
}
?>

<body>
<table width="1165" border="0" align="center" cellpadding="0" cellspacing="0">
<?
$nR13 = fGlobalNEW("Kd_Rek13","ta_penerimaan_berkas","IDT",$gIdT,"=","",DatabaseSB,$ConSB,"");
$nK13 = fGlobalNEW("Kd_Kegiatan","ta_penerimaan_berkas","IDT",$gIdT,"=","",DatabaseSB,$ConSB,"");

if ($gFin=="") 
{
	$gLimit = " LIMIT 0,50";
	$gFindD = "";
} 
else 
{
	$gLimit = " LIMIT 0,250";
	$gFindD = " AND (Kd_Kegiatan LIKE '%$gFin%' OR Nm_Kegiatan LIKE '%$gFin%' OR No_Kontrak LIKE '%$gFin%' OR Uraian LIKE '%$gFin%' OR Nilai LIKE '%$gFin%' OR No_Berita_Acara LIKE '%$gFin%')";
}

$iG=1;
$nSQL= "SELECT Nomor, No_Kontrak, Nilai, Pros, Uraian FROM ta_penerimaan_berkas WHERE Kd_Kegiatan='$nK13' AND Kd_Rek13='$nR13' AND CritBayar='UangMuka' ".$gFindD." ORDER BY Tanggal, Nomor ".$gLimit;
$nRs = mysql_query($nSQL) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gNOM = $mRo[0];
	$URL  = "Penerimaan_Berkas_Mid_UM_Mid.php?TakeOff=Ya&gNOM=".$gNOM."&gIdT=".$gIdT."&IdL=".$_GET['IdL'];
	?>
	<tr height="18"> 
	  <td valign="top" width="140"><a href="<? echo $URL?>" target="_top"><?=$mRo[0]?></a></td>
	  <td valign="top" width="120"><a href="<? echo $URL?>" target="_top"><?=$mRo[1]?></a></td>
	  <td valign="top" width="95" style="text-align:right; padding-right:15px"><a href="<? echo $URL?>" target="_top"><?=fConvertToRupiah($mRo[2])?></a></td>
	  <td width="10" valign="top">&nbsp;</td>
	  <td valign="top"><a href="<? echo $URL?>" target="_top"><?=$mRo[4]?></a>
	  </td>
	</tr>
	<?
	$iG++;
}
?>
</table>
</body>
</html>
