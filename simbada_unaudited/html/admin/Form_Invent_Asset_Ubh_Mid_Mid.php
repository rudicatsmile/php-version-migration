<?
require "CheckSession.php";
require "Connection.php";
require "Connection_Simkada.php";
require "FileFunction.php";
require "CheckLogin.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_mid.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?
//$gUnt  = $_GET['gUnt'];
$rRef  = $_GET['rRef'];
$rKib  = $_GET['rKib'];
$gFin  = $_POST['fFind'];
$TakeOff = $_GET['TakeOff'];

if ($TakeOff=="Ya")
{
	$gNOM = $_GET['gNOM'];
	$URLK = "Form_Invent_Asset_Ubh_Mid.php?gNOM=".$gNOM."&rIDT=".$rIDT."&rRef=".$rRef."&rKib=".$rKib."&IdL=".$_GET['IdL'];
	
	$gTrGt="WinFormUBH_Mid";
	?>
	<script language="JavaScript">  	
	this.window.open ('<? echo $URLK ?>','<?=$gTrGt?>')
	this.window.focus()
	this.window.document.clear()
	this.window.document.close() 
	this.setTimeout("self.close()",1)
	</script>
	<?
}

if ($rRef)
{
	$nSQ = "SELECT Kd_UPB, Kd_Aset FROM ta_".strtolower($rKib)." WHERE Referensi = '".$rRef."'";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gUnt = substr($mRo[0],0,11);
		$gAst = $mRo[1];
	}
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
		$gLimit = "";
		$gFindD = " AND (Nomor LIKE '%$gFin%' OR No_Faktur LIKE '%$gFin%')";
	}
	$iG=1;
	$nSQL= "SELECT Tanggal, Nomor, Faktur_Nomor, Nm_Aset, Uraian FROM ta_pengadaan WHERE Kd_Unit = '".$gUnt."' AND Kd_Aset='".$gAst."' AND SPP='Y' ".$gFindD." ORDER BY Tanggal, Nomor ".$gLimit;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gNOM= $mRo[1];
		$gSPP = fGlobalNEW("IfNull(sum(Jumlah),0)","daftar_spp","Pengadaan",$mRo[1],"=","",DatabaseSA,$ConSA,"");;
		$URL = "Form_Invent_Asset_Ubh_Mid_Mid.php?TakeOff=Ya&gNOM=".$gNOM."&rIDT=".$rIDT."&rRef=".$rRef."&rKib=".$rKib."&IdL=".$_GET['IdL'];
		?>
		<tr height="18"> 
		  <td width="70" valign="top" style="padding-left:5px"><a href="<? echo $URL?>" target="_top"><?=fConvertDateShort($mRo[0])?></a></td>
		  <td width="120" valign="top"><a href="<? echo $URL?>" target="_top"><?=$mRo[1]?>&nbsp;</a></td>
		  <td width="120" valign="top"><a href="<? echo $URL?>" target="_top"><?=$mRo[2]?></a></td>
		  <td width="150" valign="top"><a href="<? echo $URL?>" target="_top"><?=$mRo[3]?></a></td>
		  <td valign="top"><a href="<? echo $URL?>" target="_top"><?=$mRo[4]?></a></td>
		  <td width="100" valign="top" style="text-align:right; padding-right:10px"><a href="<? echo $URL?>" target="_top"><?=fConvertToRupiah($gSPP)?></a></td>
		</tr>
		<?
		$iG++;
	}
	?>
  </table>
  </div>
</body>
</html>
<?php require('Connection_Close.php');?>
