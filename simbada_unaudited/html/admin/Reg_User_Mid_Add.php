<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_new.css" type="text/css" media="all" />
</head>
<?
if (isset($_GET['eIdT'])) {$eIdT = $_GET['eIdT'];} else {$eIdT = "";}
$IdL = $_GET['IdL'];
$ReO = fFindUID($IdL,"Readonly");

if (isset($_GET['gMsG']))  {$MsG   = $_GET['gMsG']; }
if (isset($_GET['gUid']))  {$gUid  = $_GET['gUid']; }
if (isset($_GET['gPasA'])) {$gPasA = $_GET['gPasA'];}
if (isset($_GET['gPasB'])) {$gPasB = $_GET['gPasB'];}
if (isset($_GET['gNmaA'])) {$gNmaA = $_GET['gNmaA'];}
if (isset($_GET['gNmaB'])) {$gNmaB = $_GET['gNmaB'];}
if (isset($_GET['gText'])) {$gText = $_GET['gText'];}

if (isset($_GET['gUnt'])) {$gUnt = $_GET['gUnt'];}
if (isset($_GET['gSub'])) {$gSub = $_GET['gSub'];}
if (isset($_GET['gUpb'])) {$gUpb = $_GET['gUpb'];}
$URLA = "Reg_User_Bot.php?IdL=".$IdL."&eIdT=".$eIdT;

if ($eIdT!="")
{
	$nSQL= "SELECT * FROM ta_user WHERE IDT = '".$eIdT."'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	{
		$gUid  = $mRo['User_ID'];
		$gPasA = base64_decode(base64_decode($mRo['Password']));
		$gPasB = base64_decode(base64_decode($mRo['Password']));
		$gNmaA = $mRo['Full_Name'];;
		$gNmaB = $mRo['Short_Name'];
		$gText = $mRo['Tupoksi'];
		
		$gUnt  = substr($mRo['Kode'],0,11);
		$gSub  = substr($mRo['Kode'],0,14);
		$gUpb  = $mRo['Kode'];
	}
}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Reg_User_Mid_Add_.php?eIdT=".$eIdT."&IdL=".$IdL ?>">
  <input type="hidden" name="fSimpan">
    <table width="650" border="0" cellspacing="3" cellpadding="0" style="font-family:Calibri; font-size:9pt">
      <tr valign="top">
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr valign="top">
        <td width="136" align="left">USER ID </td>
        <td width="456" align="left"><input name="fUid" id="fUid" type="text" style="width:150px" value="<? if (isset($gUid)) {echo $gUid;}?>" /> 
          ** </td>
      </tr>
      <tr valign="top">
        <td width="136" align="left" title="<? echo base64_encode("oecoep76").":".$gPasA?>">PASSWORD</td>
        <td width="456" align="left"><input name="fPasA" id="fPasA" type="Password" class="text" style="width:150px" value="<? if (isset($gPasA)) {echo $gPasA;}?>" /> 
          ** </td>
      </tr>
      <tr valign="top">
        <td width="136" align="left" title="<? echo base64_encode("oecoep76").":".$gPasA?>">RETYPE PASSWORD </td>
        <td width="456" align="left"><input name="fPasB" id="fPasB" type="Password" style="width:150px" class="text" value="<? if (isset($gPasB)) {echo $gPasB;}?>" /> 
          ** </td>
      </tr>
      <tr valign="top">
        <td align="left">NAMA LENGKAP </td>
        <td align="left"><input name="fNmaA" id="fNmaA" type="text" class="text" value="<? if (isset($gNmaA)) {echo $gNmaA;}?>" size="40"/></td>
      </tr>
      <tr valign="top">
        <td align="left">NAMA PANGGILAN </td>
        <td align="left"><input name="fNmaB" id="fNmaB" type="text" class="text" value="<? if (isset($gNmaB)) {echo $gNmaB;}?>" size="40"/></td>
      </tr>
      <tr valign="top">
        <td align="left">UNIT KERJA </td>
        <td align="left">
		<select name="fUnt" tabindex="0" style="width: 400px" <? if ($eIdT=="") { echo "onchange='this.form.submit()'";}?>>
        <?
		if ($eIdT!="")
		{
			$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit WHERE Kd_Unit='".$gUnt."' ORDER BY Kd_Unit";
		}
		else
		{
			$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
		}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUnt=="") {$gUnt=$mRo['Kd_Unit'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Unit']==$gUnt) 
				{
				$sel ="selected";
				$zUnt=$mRo['Kd_Unit'];
				}
				$NmUnit = $mRo['Nm_Unit'];
				if (strlen($NmUnit)>50){
					$NmUnit = substr($NmUnit,0,50)." ....";
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".$NmUnit.'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
      </tr>
      <tr valign="top">
        <td align="left">SUB UNIT KERJA </td>
        <td align="left"><select name="fSub" tabindex="0" style="width: 400px" <? if ($eIdT=="") { echo "onchange='this.form.submit()'";}?>>
          <?
		if ($eIdT!="")
		{
			$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub = '".$gSub."' ORDER BY Kd_Sub";
		}
		else
		{
			$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";
		}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gSub=="") {$gSub=$mRo['Kd_Sub'];}
			if (substr($gSub,0,11)!=$gUnt) {$gSub=$mRo['Kd_Sub'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Sub']==$gSub) 
				{
				$sel ="selected";
				$zSub=$mRo['Kd_Sub'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Sub'].'">'.$mRo['Kd_Sub']." : ".$mRo['Nm_Sub'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
      </tr>
      <tr valign="top">
        <td align="left">UPB</td>
        <td align="left">
		<select name="fUpb" tabindex="0" style="width: 400px" <? if ($eIdT=="") { echo "onchange='this.form.submit()'";}?>>
        <?
		if ($eIdT!="")
		{
			$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb = '".$gUpb."' ORDER BY Kd_Upb";
		}
		else
		{
			$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
		}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUpb=="") {$gUpb = $mRo['Kd_Upb'];}
			if (substr($gUpb,0,14)!=$gSub) {$gUpb = $mRo['Kd_Upb'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Upb']==$gUpb) 
				{
				$sel ="selected";
				$zUpb=$mRo['Kd_Upb'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Upb'].'">'.$mRo['Kd_Upb']." : ".$mRo['Nm_Upb'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
      </tr>
      <tr valign="top">
        <td align="left">DESKRIPSI TUGAS </td>
        <td align="left"><textarea name="fText" cols="40" rows="3"><? if (isset($gText)) {echo $gText;}?></textarea></td>
      </tr>
      <tr valign="top">
        <td align="left">&nbsp;</td>
        <td align="left" style="color:#FF0000"><? if (isset($_GET['gMsG'])) {echo $_GET['gMsG'];}?>&nbsp;</td>
      </tr>
      <tr valign="top">
        <td align="left">&nbsp;</td>
        <td align="left"><input type="button" name="B39" value="SIMPAN" style="width:80px" onclick="P_Save('<?=$ReO?>')"/>
		<input type="button" name="B392" value="RESET" style="width:80px" onclick="P_Reset('<?=$ReO?>')"/></td>
      </tr>
      <tr>
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
</table>
</form>
</body>
</html>
<script language="javascript">
var objfrm=document.myfrm;
function P_Save(xR)
{
	if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
	if (objfrm.fUid.value.length < 7)
	{
		alert("User ID tidak diperbolehkan kurang dari 7 digit..!!");
	}
	else if (objfrm.fPasA.value=="")
	{
		alert("Silahkan Masukan Password ..!!");
	}
	else if (objfrm.fPasB.value=="")
	{
		alert("Silahkan Masukan Retype Password ..!!");
	}
	else if (objfrm.fPasA.value!=objfrm.fPasB.value)
	{
		alert("Retype Password tidak sesuai..!!");
	}
	else
	{
		objfrm.fSimpan.value = "Save";
		objfrm.submit();
	}
}

function P_Reset(xR)
{
	if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
	objfrm.fSimpan.value = "Reset";
	objfrm.submit();
}
</script>

<script language="JavaScript">	
	window.open("<? echo $URLA ?>","WinFormUser_Bot");
</script>

<?php require('Connection_Close.php');?>
