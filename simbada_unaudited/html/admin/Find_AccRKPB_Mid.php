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
$IDO  = $_GET['IDO'];
$gUnt  = $_GET['gUnt'];
$gSub  = $_GET['gSub'];
$gUpb  = $_GET['gUpb'];
$CrAcc = $_GET['CrAcc'];
$gFin  = $_GET['fFind'];
$TakeOff = $_GET['TakeOff'];

if ($TakeOff=="Ya")
{
	$gKd = $_GET['gKd'];
	$gNm = fGlobal("Nm_Rek","Ref_Rek_5","Kd_Rek",$gKd,"=","","");
	$SQL = "update ta_rkpbmd_rinci set Rekening='".$gKd."', Nm_Rekening='".$gNm."' WHERE IDO='".$IDO."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	
	$URLK = "RKPBMD_Mid.php?JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
	?>
	<script language="JavaScript">  	
	this.window.open ('<?=$URLK ?>','WinOpenRKPB_Mid')
	this.window.focus()
	this.window.document.clear()
	this.window.document.close() 
	this.setTimeout("self.close()",1)
	</script>
	<?
}
?>

<body>
  <div class="table">
  <table width="1165" border="0" align="center">
    <?
	if ($gFin=="") {$gLimit=" LIMIT 0,50";} else {$gLimit="";}
	$iG=1;
	$nSQL= "SELECT * FROM ref_rek_5 where Kd_Rek LIKE '5.2._.__.__' AND (Kd_Rek LIKE '%".$gFin."%' OR Nm_Rek LIKE '%".$gFin."%') ORDER BY Kd_Rek".$gLimit;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			$gKd = $mRo['Kd_Rek'];
			$gK2 =  substr($gKd,0,3);
			$gK3 =  substr($gKd,0,5);
			$gK4 =  substr($gKd,0,8);
			$URL = "Find_AccRKPB_Mid.php?TakeOff=Ya&gKd=".$gKd."&IDO=".$IDO."&JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
			?>
			<tr title="Klik disini untu melihat Kelompok, Jenis, Objek....!!"> 
		      <td width="102" height="18" valign="top"><a href="<? echo $URL?>" target="_top"><? echo $mRo['Kd_Rek']?></a></td>
		      <td width="1016" valign="top" onclick="$(&#39;#detail<? echo $iG?>&#39;).toggle(&#39;past&#39;);"><a href="<? echo $URL?>" target="_top"><? echo $mRo['Nm_Rek']?>&nbsp;</a></td>
			</tr>
			<tr style="cursor: pointer; " onmouseover="this.style.cursor=&#39;pointer&#39;"> 
			  <td colspan="2" valign="top">
			  <table id="detail<? echo $iG?>" cellspacing="0" cellpadding="3" border="0" width="100%" style="font-style: italic; color: #808080; display: none;">
				  <tr> 
					<td width="92">&nbsp;</td>
					<td width="70">Kelompok</td>
					<td width="20">:</td>
					<td>
					  <? echo fGlobal("Nm_Rek","Ref_Rek_2","Kd_Rek",$gK2,"=","","")?>
					</td>
				  </tr>
				  <tr> 
					<td>&nbsp;</td>
					<td>Jenis</td>
					<td>:</td>
					<td>
					  <? echo fGlobal("Nm_Rek","Ref_Rek_3","Kd_Rek",$gK3,"=","","")?>
					</td>
				  </tr>
				  <tr> 
					<td>&nbsp;</td>
					<td>Objek</td>
					<td>:</td>
					<td>
					  <? echo fGlobal("Nm_Rek","Ref_Rek_4","Kd_Rek",$gK4,"=","","")?>
					</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>Rincian</td>
					<td>:</td>
					<td><a href="<? echo $URL?>" target="_top">
					  <? echo $mRo['Nm_Rek']?>
					  </a></td>
				  </tr>
				</table>
				</td>
			</tr>
			<?
			$gK3B = $gK3A;
			$gKdB = $gKdA;
			$iG++;
		}
		while ($mRo = mysql_fetch_assoc($nRs));	
	}
	?>
    <? function ViewObject($xA,$xB) {?>
    <tr> 
      <td width="102" height="18" valign="top" style="font-weight: bold"><? echo $xA?></td>
      <td width="1016" valign="top" style="font-weight: bold"><? echo $xB?>&nbsp;</td>
    </tr>
    <? } ?>
  </table>
  </div>
</body>
</html>
<?php require('Connection_Close.php');?>
