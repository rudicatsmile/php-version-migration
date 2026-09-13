<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_mid.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
$gUnt  = $_GET['gUnt'];
$gFin  = $_GET['fnD'];

if (isset($_GET['gPR'])) {$gPR  = $_GET['gPR'];} else {$gPR  = "";}
if (isset($_GET['gKG'])) {$gKG  = $_GET['gKG'];} else {$gKG  = "";}
if (isset($_GET['gSB'])) {$gSB  = $_GET['gSB'];} else {$gSB  = "";}
if (isset($_GET['gRK'])) {$gRK  = $_GET['gRK'];} else {$gRK  = "";}
if (isset($_GET['gYN'])) {$gYN  = $_GET['gYN'];} else {$gYN  = "N";}

$TakeOff = $_GET['TakeOff'];

if ($TakeOff=="Ya")
{
	$gNOM = $_GET['gNOM'];
	$URLK = "Pengadaan_Mid.php?gUnt=".$gUnt."&gNOM=".$gNOM."&IdL=".$_GET['IdL'];
	
	$gTrGt="WinFormPNG_Mid";
	?>
	<script language="JavaScript">
	this.window.open ('<?php echo $URLK ?>','<?=$gTrGt?>')
	this.window.focus()
	this.window.document.clear()
	this.window.document.close() 
	this.setTimeout("self.close()",1)
	</script>
	<?php
}
?>

<body>
  <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
    <?php
	if ($gFin=="") 
	{
		$gLimit = " LIMIT 0,200";
		$gFindD = "";
	} 
	else 
	{
		$gLimit = "";
		$gFindD = " AND (Nomor LIKE '%$gFin%' OR No_Kontrak LIKE '%$gFin%' OR Uraian LIKE '%$gFin%')";
	}
	
	if ($gYN=="") {
		$SyYN = "%";
	}
	else {
		$SyYN = $gYN;
	}
		
	if ($gPR=="") 
	{
		$SyTKG = "%";
	}
	else 
	{
		if ($gKG=="") 
		{
			$SyTKG = $gPR."%";
		}
		else 
		{
			if ($gSB=="") 
			{
				$SyTKG = $gKG."%";
			}
			else
			{
				$SyTKG = $gSB;
			}
		}
	}
	
	if ($gRK=="") {
		$SyTRK = "%";
	} 
	else {
		$SyTRK = $gRK;
	}
		
	$iG=1;
	$nSQL= "SELECT * FROM ta_penerimaan_berkas WHERE Kd_SubKegiatan LIKE '$SyTKG' AND Kd_Rek13 LIKE '$SyTRK' AND Proses LIKE '$SyYN' AND Kd_Unit = '".$gUnt."' ".$gFindD." ORDER BY Tanggal, Nomor ".$gLimit;
	#echo $nSQL;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			$gNOM = $mRo['Nomor'];
			$gNIL = $mRo['Nilai'];
			$gVaL = fGlobalNEW("IfNull(sum(Nilai),0)","ta_pengadaan","No_Berkas",$gNOM,"=","",DatabaseSB,$ConSB,"");
			if (($gNIL-$gVaL)>0) {$gCLR="0000FF";}
			else if (($gNIL-$gVaL)<0) {$gCLR="FF0000";}
			else {$gCLR="000";}
			
			//$mRo['CritBayar']
			
			$CrTB = str_replace("UangMuka","Uang Muka",$mRo['CritBayar']);
			$CrTT = $mRo['CritBayar_Termin'];
			if ($CrTB=="Termin") {$CrTB.="-".$CrTT;}
			if ($CrTB=="Pelunasan") {$CrTB ="100% (".$CrTB.")";}
				
			$URL  = "Pengadaan_Mid_Mid.php?TakeOff=Ya&gNOM=".$gNOM."&gUnt=".$gUnt."&IdL=".$_GET['IdL'];
			?>
			<tr height="18"> 
			  <td width="70" valign="top" style="border-bottom: 1px dotted #999999"><a href="<?php echo $URL?>" target="_top"><?=fConvertDateShort($mRo['Tanggal'])?></a></td>
			  <td width="140" valign="top" style="border-bottom: 1px dotted #999999"><a href="<?php echo $URL?>" target="_top"><?=$mRo['Nomor']?></a></td>
			  <td width="80" valign="top" style="border-bottom: 1px dotted #999999; text-align:center; padding-right:10px"><a href="<?php echo $URL?>" target="_top"><?=$CrTB?></a></td>
			  <td width="64" valign="top" style="border-bottom: 1px dotted #999999; text-align:center"><a href="<?php echo $URL?>" target="_top"><?=str_replace("Y","<i>sudah</i>",str_replace("N","<i><u><b>belum</b></u></i>",$mRo['Proses']))?></a></td>
			  <td width="80" valign="top" style="border-bottom: 1px dotted #999999; text-align:right; padding-right:10px"><a href="<?php echo $URL?>" target="_top"><?=fConvertToRupiah($mRo['Nilai'])?></a></td>
			  <td width="80" valign="top" style="border-bottom: 1px dotted #999999; text-align:right; padding-right:10px"><a href="<?php echo $URL?>" target="_top"><?=fConvertToRupiah($gVaL)?></a></td>
			  <td width="80" valign="top" style="border-bottom: 1px dotted #999999; text-align:right; padding-right:10px"><a href="<?php echo $URL?>" target="_top"><font color="#<?=$gCLR?>"><?=fConvertToRupiah($mRo['Nilai']-$gVaL)?></font></a></td>
			  <td valign="top" style="border-bottom: 1px dotted #999999"><a href="<?php echo $URL?>" target="_top"><?=$mRo['Nm_Kegiatan']."<br> (<i>".$mRo['Nm_Rek13']."</i>)"?></a></td>
			  <td width="20" valign="top">&nbsp;</td>
			</tr>
			<?php
			$iG++;
		}
		while ($mRo = mysql_fetch_assoc($nRs));	
	}
	?>
  </table>
</body>
</html>
<?php require('Connection_Close.php');?>
