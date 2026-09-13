<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_mid.css" type="text/css" media="all" />
<!--script type="text/javascript" src="js/jquery-1.8.2.min.js"></script-->
</head>
<?php
$IDO  = $_GET['IDO'];
$zUpb = $_GET['zUpb'];
$zKeg = $_GET['zKeg'];
$zThn = $_GET['zThn'];
$gFin  = $_POST['fFind'];
$TakeOff = $_GET['TakeOff'];

if ($TakeOff=="Ya")
{
	$gKd = $_GET['gKd'];
	$gNm = fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$gKd,"=","","");
	$SQL = "update ta_rkbmd set Kd_Aset='".$gKd."', Nm_Aset='".$gNm."' WHERE IDO='".$IDO."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	
	$URLK = "RKBMD_Mid.php?JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
	?>
	<script language="JavaScript"> 
	//alert('ccccc'); return false;
	this.window.open ('<?=$URLK ?>','WinOpenRKB_Mid')
	this.window.focus()
	//this.window.document.clear()
	this.window.document.close() 
	this.setTimeout("self.close()",1)
	</script>
	<?php
	return false;
}
?>

<body>
  <div class="table">
  <table width="1165" border="0" align="center">
    <?php
	if ($gFin=="") {$gLimit=" LIMIT 0,50";} else {$gLimit="";}
	$iG=1;
	$nSQL= "SELECT * FROM ref_rek_aset5 where (Kd_Aset LIKE '%".$gFin."%' OR Nm_Aset LIKE '%".$gFin."%') AND Kd_Aset NOT LIKE '07%' ORDER BY Kd_Aset".$gLimit;
	#echo $nSQL;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			$gKd = $mRo['Kd_Aset'];
			$gK2 =  substr($gKd,0,5);
			$gK3 =  substr($gKd,0,8);
			$gK4 =  substr($gKd,0,11);
			
			$gK3A = substr($gKd,0,8);
			$gKdA = substr($gKd,0,11);
			if ($gK3A != $gK3B)
			{
				$xA = $gK3A;
			} 
			if ($gKdA != $gKdB)
			{
				$xA = $gKdA;
			} 
			$URL = "Find_AccRKB_Mid.php?TakeOff=Ya&gKd=".$gKd."&IDO=".$IDO."&JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
			#$URL = "RKBMD_Mid_.php?TakeOff=Ya&gKd=".$gKd."&IDO=".$IDO."&JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
			?>
			<tr title="Klik disini untu melihat Kelompok, Jenis, Objek....!!"> 
			  
      <td width="102" height="18" valign="top"><a href="<?php echo $URL?>" target="_top">
        <?php echo $mRo['Kd_Aset']?>
        </a></td>
			  
      <td width="1016" valign="top" onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;);"><a href="<?php echo $URL?>" target="_top">
        <?php echo $mRo['Nm_Aset']?>
        &nbsp;</a></td>
			</tr>
			<tr style="cursor: pointer; " onmouseover="this.style.cursor=&#39;pointer&#39;"> 
			  <td colspan="2" valign="top">
			  <table id="detail<?php echo $iG?>" cellspacing="0" cellpadding="3" border="0" width="100%" style="font-style: italic; color: #808080; display: none;">
				  <tr> 
					<td width="92">&nbsp;</td>
					<td width="70">Kelompok</td>
					<td width="20">:</td>
					<td>
					  <?php echo fGlobal("Nm_Aset","Ref_Rek_Aset2","Kd_Aset",$gK2,"=","","")?>
					</td>
				  </tr>
				  <tr> 
					<td>&nbsp;</td>
					<td>Jenis</td>
					<td>:</td>
					<td>
					  <?php echo fGlobal("Nm_Aset","Ref_Rek_Aset3","Kd_Aset",$gK3,"=","","")?>
					</td>
				  </tr>
				  <tr> 
					<td>&nbsp;</td>
					<td>Objek</td>
					<td>:</td>
					<td>
					  <?php echo fGlobal("Nm_Aset","Ref_Rek_Aset4","Kd_Aset",$gK4,"=","","")?>
					</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>Rincian</td>
					<td>:</td>
					<td><a href="<?php echo $URL?>" target="_top">
					  <?php echo $mRo['Nm_Aset']?>
					  </a></td>
				  </tr>
				</table>
				</td>
			</tr>
			<?php
			$gK3B = $gK3A;
			$gKdB = $gKdA;
			$iG++;
		}
		while ($mRo = mysql_fetch_assoc($nRs));	
	}
	?>
    <?php function ViewObject($xA,$xB) {?>
    <tr> 
      <td width="102" height="18" valign="top" style="font-weight: bold"><?php echo $xA?></td>
      <td width="1016" valign="top" style="font-weight: bold"><?php echo $xB?>&nbsp;</td>
    </tr>
    <?php } ?>
  </table>
  </div>
</body>
</html>
<?php require('Connection_Close.php');?>
