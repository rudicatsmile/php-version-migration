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
if (isset($_GET['rIDT'])) {$rIDT = $_GET['rIDT'];}
if (isset($_GET['CrT'])) {$CrT = $_GET['CrT'];}
$gUnt  = $_GET['gUnt'];
$gNOM  = $_GET['gNOM'];
$gFin  = $_POST['fFind'];
$TakeOff = $_GET['TakeOff'];

if ($TakeOff=="Ya")
{
	$rIDT2 = $_GET['rIDT2'];
	//echo $rIDT2;
	//return false;
	
	$URLK = "Merger_Mid.php?rIDT=".$rIDT."&CrT=".$CrT."&rIDT2=".$rIDT2."&IdL=".$_GET['IdL'];
	$gTrGt= "WinFormMRG_Mid";
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
  <div class="table">
  <table width="1165" border="0" align="center" cellpadding="0" cellspacing="0">
    <?
	
	if ($gFin=="") 
	{
		$gLimit = " LIMIT 0,50";
		$gFindD = "";
	} 
	else 
	{
		$gLimit = " LIMIT 0,250";
		$gFindD = " AND (Kd_Aset_108 LIKE '%$gFin%' OR Nm_Aset LIKE '%$gFin%' OR Referensi LIKE '%$gFin%' OR Keterangan LIKE '%$gFin%')";
	}
	$iG=1;
	
	$rUpB = fGlobalNEW("Kd_UPB","ta_kib_108","IDT",$rIDT,"=","",DatabaseSB,$ConSB,"");
	$rNoN = fGlobalNEW("Referensi","ta_kib_108","IDT",$rIDT,"=","",DatabaseSB,$ConSB,"");
	$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi like '".substr($rNoN,0,3)."%' AND Kd_UPB like '".substr($rUpB,0,11)."%' AND Referensi NOT LIKE '$rNoN' ".$gFindD." ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register ".$gLimit;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			$rIDT2= $mRo['IDT'];
			$rKoD = $mRo['Kd_Aset_108'];
			$rReF = $mRo['Referensi'];
			$rReG = $mRo['No_Register'];
			$rNaM = $mRo['Nm_Aset'];
			$rUrA = $mRo['Keterangan'];
			
			$rNiA = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Crit",$rReF.":SLD","=:=","",DatabaseSB,$ConSB,"");
			$rNiD = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi",$rReF,"=","",DatabaseSB,$ConSB,"");
			$rNiK = 0;//fGlobalNEW("IfNull(sum(Kredit),0)","ta_kib_post_108","Referensi",$rReF,"=","",DatabaseSB,$ConSB,"");
			$rNiB = $rNiD-$rNiK;

			$URL = "Merger_Mid_Find_Mid.php?TakeOff=Ya&rIDT=".$rIDT."&CrT=".$CrT."&rIDT2=".$rIDT2."&IdL=".$_GET['IdL'];
			if ($rNaM=="") {$rNaM = fGlobalNEW("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$rKoD,"=","",DatabaseSB,$ConSB,"");}
			?>
			<tr height="18"> 
			  <td valign="top" width="155" align="left" style="padding-left:2px"><a href="<? echo $URL?>" target="_top"><?=$rKoD.".".$rReG?></a></td>
			  <td valign="top" width="250"><a href="<?=$URL?>" target="_top"><?=$rNaM?></a></td>
			  <td valign="top"><a href="<?=$URL?>" target="_top"><?=$rUrA?></a></td>
			  <td valign="top" width="100" style="text-align:right"><a href="<?=$URL?>" target="_top"><?=fConvertToRupiah($rNiA)?></a></td>
			  <td valign="top" width="100" style="text-align:right; padding-right:2px"><a href="<?=$URL?>" target="_top"><?=fConvertToRupiah($rNiB)?></a></td>
			</tr>
			<?
			$iG++;
		}
		while ($mRo = mysql_fetch_assoc($nRs));	
	}
	?>
  </table>
  </div>
</body>
</html>
<?php require('Connection_Close.php');?>
