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
<?php
$gUnt  = $_GET['gUnt'];
$gNOM  = $_GET['gNOM'];

$gFin  = $_POST['fFind'];
$TakeOff = $_GET['TakeOff'];

if ($TakeOff=="Ya")
{
	$gRin = $_GET['KdA'];
	$URLK = "Pengadaan_Mid.php?gRin=".$gRin."&gNOM=".$gNOM."&gUnt=".$gUnt."&IdL=".$_GET['IdL'];
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
	return false;
}
?>

<body>
  <div class="table">
  <table width="1165" border="0" align="center" cellpadding="0" cellspacing="0">
    <?php
	if ($gFin=="") 
	{
		$gLimit = " LIMIT 0,50";
		$gFindD = "";
	} 
	else 
	{
		$gLimit = " LIMIT 0,250";
		$gFindD = " AND (Kd_Aset LIKE '%$gFin%' OR Nm_Aset LIKE '%$gFin%')";
	}
	$iG=1;
	$nSQL= "SELECT * FROM ref_rek_aset5 ".$gFindD." ORDER BY Kd_Aset ".$gLimit;
	$nSQL= "SELECT * FROM ref_rek_aset108_7 WHERE Kd_Aset NOT LIKE '1.5%' ".$gFindD." ORDER BY Kd_Aset ".$gLimit;
	
	#echo $nSQL;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			$KdA = $mRo['Kd_Aset'];
			$URL = "Pengadaan_Mid_Aset_Mid.php?TakeOff=Ya&KdA=".$KdA."&gNOM=".$gNOM."&gUnt=".$gUnt."&IdL=".$_GET['IdL'];
			?>
			<tr height="18"> 
			  <td width="100" valign="top"><a href="<?php echo $URL?>" target="_top"><?=$mRo['Kd_Aset']?></a></td>
			  <td valign="top"><a href="<?php echo $URL?>" target="_top"><?=$mRo['Nm_Aset']?>&nbsp;</a></td>
			  <td width="10" valign="top">&nbsp;</td>
			  <td width="400" valign="top"><a href="<?php echo $URL?>" target="_top">
			  <?=fGlobalNEW("Nm_Aset","ref_rek_aset108_4","Kd_Aset",substr($mRo['Kd_Aset'],0,8),"=","",DatabaseSB,$ConSB,"")?>&nbsp;/&nbsp;
			  <?=fGlobalNEW("Nm_Aset","ref_rek_aset108_5","Kd_Aset",substr($mRo['Kd_Aset'],0,11),"=","",DatabaseSB,$ConSB,"")?>&nbsp;/&nbsp;
			  <?=fGlobalNEW("Nm_Aset","ref_rek_aset108_6","Kd_Aset",substr($mRo['Kd_Aset'],0,14),"=","",DatabaseSB,$ConSB,"")
			  ?></a>
			  </td>
			</tr>
			<?php
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
