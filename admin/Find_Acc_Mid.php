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
$gSub  = $_GET['gSub'];
$gUpb  = $_GET['gUpb'];
$CrAcc = $_GET['CrAcc'];
$TakeOff = $_GET['TakeOff'];
$gFin  = $_POST['fFind'];

if (isset($_GET['rKib'])) {$rKib  = $_GET['rKib'];}
if (isset($_GET['rIDT'])) {$rIDT  = $_GET['rIDT'];}

if ($TakeOff=="Ya")
{
	if (strtolower(substr($CrAcc,0,16))=="move_account_mid") 
	{
		$gKd  = $_GET['gKd'];
		$gBid = substr($gKd,0,5);
		$gKel = substr($gKd,0,8);
		$gObj = substr($gKd,0,11);
		$gRin = substr($gKd,0,14);
		$gSub = $gKd;
		
		$CrAccG="Move_Account_Mid";
		$URLK = $CrAccG.".php?rKib=".$rKib."&rIDT=".$rIDT."&gBid=".$gBid."&gKel=".$gKel."&gObj=".$gObj."&gRin=".$gRin."&gSub=".$gSub."&IdL=".$_GET['IdL'];
	}
	else 
	{
		$gKd  = $_GET['gKd'];
		$gBid = substr($gKd,0,8);
		$gKel = substr($gKd,0,11);
		$gOBJ = substr($gKd,0,14);
		$gRin = $gKd;
		
		$CrAccG=$CrAcc;
		$URLK = $CrAccG.".php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gBid=".$gBid."&gKel=".$gKel."&gOBJ=".$gOBJ."&gRin=".$gRin;
	}
	
	
	if ($CrAcc=="KIB-A" || $CrAcc=="KIB-B" || $CrAcc=="KIB-C" || $CrAcc=="KIB-D" || $CrAcc=="KIB-E" || $CrAcc=="KIB-F" || $CrAcc=="KIB-G")
		{$gTrGt="MidFrame";}
	if ($CrAcc=="Inventarisasi_KIB-A" || $CrAcc=="Inventarisasi_KIB-B" || $CrAcc=="Inventarisasi_KIB-C" || $CrAcc=="Inventarisasi_KIB-D" || $CrAcc=="Inventarisasi_KIB-E" || $CrAcc=="Inventarisasi_KIB-F" || $CrAcc=="Inventarisasi_KIB-G")
		{$gTrGt="MidFrame";}
	if ($CrAcc=="Form_Asset_A_Mid" || $CrAcc=="Form_Asset_B_Mid" || $CrAcc=="Form_Asset_C_Mid" || $CrAcc=="Form_Asset_D_Mid" || $CrAcc=="Form_Asset_E_Mid" || $CrAcc=="Form_Asset_F_Mid" || $CrAcc=="Form_Asset_G_Mid")
		{$gTrGt="WinFormKIB_Mid";}
	if ($CrAcc=="Move_Account_Mid_A" || $CrAcc=="Move_Account_Mid_B" || $CrAcc=="Move_Account_Mid_C" || $CrAcc=="Move_Account_Mid_D" || $CrAcc=="Move_Account_Mid_E" || $CrAcc=="Move_Account_Mid_F" || $CrAcc=="Move_Account_Mid_G")
		{$gTrGt="WinReplAcc_Mid";}
	?>
	<script language="JavaScript">  	
	this.window.open ('<?=$URLK ?>','<?=$gTrGt?>')
	this.window.focus()
	this.window.document.clear()
	this.window.document.close() 
	this.setTimeout("self.close()",1)
	</script>
	<?php
}

if (($CrAcc=="KIB-A") || ($CrAcc=="Inventarisasi_KIB-A") || ($CrAcc=="Form_Asset_A_Mid") || ($CrAcc=="Move_Account_Mid_A")) {$gCrtXX="01"; $gCrt="1.3.1";}
if (($CrAcc=="KIB-B") || ($CrAcc=="Inventarisasi_KIB-B") || ($CrAcc=="Form_Asset_B_Mid") || ($CrAcc=="Move_Account_Mid_B")) {$gCrtXX="02"; $gCrt="1.3.2";}
if (($CrAcc=="KIB-C") || ($CrAcc=="Inventarisasi_KIB-C") || ($CrAcc=="Form_Asset_C_Mid") || ($CrAcc=="Move_Account_Mid_C")) {$gCrtXX="03"; $gCrt="1.3.3";}
if (($CrAcc=="KIB-D") || ($CrAcc=="Inventarisasi_KIB-D") || ($CrAcc=="Form_Asset_D_Mid") || ($CrAcc=="Move_Account_Mid_D")) {$gCrtXX="04"; $gCrt="1.3.4";}
if (($CrAcc=="KIB-E") || ($CrAcc=="Inventarisasi_KIB-E") || ($CrAcc=="Form_Asset_E_Mid") || ($CrAcc=="Move_Account_Mid_E")) {$gCrtXX="05"; $gCrt="1.3.5";}
if (($CrAcc=="KIB-F") || ($CrAcc=="Inventarisasi_KIB-F") || ($CrAcc=="Form_Asset_F_Mid") || ($CrAcc=="Move_Account_Mid_F")) {$gCrtXX="06"; $gCrt="1.3.6";}
if (($CrAcc=="KIB-G") || ($CrAcc=="Inventarisasi_KIB-G") || ($CrAcc=="Form_Asset_G_Mid") || ($CrAcc=="Move_Account_Mid_G")) {$gCrtXX="07"; $gCrt="1.5.4";}
if (($CrAcc=="KIB-J") || ($CrAcc=="Inventarisasi_KIB-J") || ($CrAcc=="Form_Asset_J_Mid") || ($CrAcc=="Move_Account_Mid_J")) {$gCrtXX="08"; $gCrt="1.5.3";}
?>

<body>
  <div class="table">
  <table width="1165" border="0" align="center" style="border-collapse:collapse">
    <?php
	if ($gFin=="") {$gLimit=" LIMIT 0,50";} else {$gLimit="";}
	$iG=1;
	if (strtolower(substr($CrAcc,0,16))=="move_account_mid") 
	{
		$nSQL= "SELECT * FROM ref_rek_aset108_7 where Kd_Aset LIKE '_._._.__.__.__.___' AND (Kd_Aset LIKE '%".$gFin."%' OR Nm_Aset LIKE '%".$gFin."%') ORDER BY Kd_Aset".$gLimit;
		#echo $nSQL;
	}
	else
	{
		$nSQL= "SELECT * FROM ref_rek_aset108_7 where Kd_Aset LIKE '".$gCrt.".__.__.__.___' AND (Kd_Aset LIKE '%".$gFin."%' OR Nm_Aset LIKE '%".$gFin."%') ORDER BY Kd_Aset".$gLimit;
	}
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			$gKd = $mRo['Kd_Aset'];
			
			#$gK2 =  substr($gKd,0,5);
			#$gK3 =  substr($gKd,0,8);
			#$gK4 =  substr($gKd,0,11);
			
			#$gK3A = substr($gKd,0,8);
			#$gKdA = substr($gKd,0,11);
			
			$gK2 =  substr($gKd,0,8);
			$gK3 =  substr($gKd,0,11);
			$gK4 =  substr($gKd,0,14);
			
			$gK3A = substr($gKd,0,11);
			$gKdA = substr($gKd,0,14);
			
			if ($gK3A != $gK3B)
			{
				$xA = $gK3A;
			} 
			if ($gKdA != $gKdB)
			{
				$xA = $gKdA;
			} 
			$URL = "Find_Acc_Mid.php?TakeOff=Ya&gKd=".$gKd."&CrAcc=".$CrAcc."&rKib=".$rKib."&rIDT=".$rIDT."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&fFind=".$gFin."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
			?>
			<tr <?=fBackCLR($iG)?> title="Klik disini untu melihat Kelompok, Jenis, Objek....!!"> 
			  <td width="119" height="18" valign="top" style="cursor: pointer" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)"><?=$mRo['Kd_Aset']?></td>
			  <td width="1125" valign="top" style="cursor: pointer" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)"><?=$mRo['Nm_Aset']?></td>
			  <td width="79" valign="top"><a href="<?=$URL?>" target="_top" class="ico add">&nbsp;add</a></td>
			</tr>
			<tr style="cursor: pointer" <?=fBackCLR($iG)?> onmouseover="this.style.cursor=&#39;pointer&#39;"> 
			  <td colspan="3" valign="top">
			  <table id="detail<?php echo $iG?>" cellspacing="0" cellpadding="3" border="0" width="100%" style="font-style: italic; color: #808080; display: none;">
				  <tr> 
					<td width="92">&nbsp;</td>
					<td width="70">Objek</td>
					<td width="20">:</td>
					<td>
					  <?php echo fGlobal("Nm_Aset","Ref_Rek_Aset108_4","Kd_Aset",$gK2,"=","","")?>					</td>
				  </tr>
				  <tr> 
					<td>&nbsp;</td>
					<td>Rincian Objek</td>
					<td>:</td>
					<td>
					  <?php echo fGlobal("Nm_Aset","Ref_Rek_Aset108_5","Kd_Aset",$gK3,"=","","")?>					</td>
				  </tr>
				  <tr> 
					<td>&nbsp;</td>
					<td>Sub ROBJ</td>
					<td>:</td>
					<td>
					  <?php echo fGlobal("Nm_Aset","Ref_Rek_Aset108_6","Kd_Aset",$gK4,"=","","")?>					</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>Sub-Sub ROBJ</td>
					<td>:</td>
					<td><a href="<?php echo $URL?>" target="_top">
					  <?php echo $mRo['Nm_Aset']?>
					  </a></td>
				  </tr>
				</table>				</td>
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
      <td width="119" height="18" valign="top" style="font-weight: bold"><?=$xA?></td>
      <td valign="top" style="font-weight: bold"><?=$xB?>&nbsp;</td>
      <td valign="top" style="font-weight: bold">&nbsp;</td>
    </tr>
    <?php } ?>
  </table>
  </div>
</body>
</html>
<?php require('Connection_Close.php');?>
