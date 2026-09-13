<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
$rIDT = $_REQUEST['rIDT'] ?? '';
$Sbmt = "";
$gCod = "";
$gNma = "";
$gBid = "";
$gKel = "";
$gJNS = "";
$gOBJ = "";
if ($rIDT!="")
{
	$nSQ = "SELECT * FROM ref_rek_5 WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gCod  = $mRo['Kd_Rek'];
		$gNma  = $mRo['Nm_Rek'];
		$gBid  = substr($gCod,0,1);
		$gKel  = substr($gCod,0,3);
		$gJNS  = substr($gCod,0,5);
		$gOBJ  = substr($gCod,0,8);
	}
}
else
{
	if (!empty($_REQUEST['gBid']))
	{
		$gBid  = $_REQUEST['gBid'];
		$gKel  = $_REQUEST['gKel'] ?? '';
		$gJNS  = $_REQUEST['gJNS'] ?? '';
		$gOBJ  = $_REQUEST['gOBJ'] ?? '';
	}
	else
	{
		$gCod  = $_REQUEST['KdRek4'] ?? '';
		$gBid  = substr($gCod,0,1);
		$gKel  = substr($gCod,0,3);
		$gJNS  = substr($gCod,0,5);
		$gOBJ  = substr($gCod,0,8);
	}
	$gCod  = $gOBJ.".xx";
	$Sbmt  = "onchange='this.form.submit()'";
}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Form_Kode_Rekn5_Mid_.php?FrmG=".($_REQUEST['FrmG'] ?? '')."&IdL=".($_REQUEST['IdL'] ?? '')."&rIDT=".$rIDT ?>">
  <input type="hidden" name="Simpan">
  <table border="0" width="663" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td width="24">&nbsp;</td>
      <td width="93">BIDANG</td>
      <td width="20">:</td>
      <td><select class="boxs" name="fBid" tabindex="0" style="width: 480px" <?php echo $Sbmt?>>
          <?php
		$nSQ = "SELECT Kd_Rek, Nm_Rek FROM ref_rek_1 ORDER by Kd_Rek";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
            if ($gBid!="All")
            {
			if ($gBid=="") {$gBid=$mRo['Kd_Rek'];}
            }
			do
			{
				$sel ="";
				if ($mRo['Kd_Rek']==$gBid) 
				{
				$sel ="selected";
				$zBid=$mRo['Kd_Rek'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Rek'].'">'.$mRo['Kd_Rek']." : ".$mRo['Nm_Rek'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
    </tr>
    <tr> 
      <td width="24">&nbsp;</td>
      <td width="93">KELOMPOK</td>
      <td width="20">:</td>
      <td><select name="fKel" class="boxs" id="fKel" style="width: 480px" tabindex="0" <?php echo $Sbmt?>>
          <?php
		$nSQ = "SELECT Kd_Rek, Nm_Rek FROM ref_rek_2 WHERE Kd_Rek LIKE '".$zBid."._' ORDER BY Kd_Rek";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if (substr($gKel,0,1)!=$zBid) {$gKel=$mRo['Kd_Rek'];}
			if ($gKel=="") {$gKel=$mRo['Kd_Rek'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Rek']==$gKel) 
				{
				$sel ="selected";
				$zKel=$mRo['Kd_Rek'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Rek'].'">'.$mRo['Kd_Rek']." : ".$mRo['Nm_Rek'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
    </tr>
    <tr> 
      <td width="24">&nbsp;</td>
      <td width="93">JENIS</td>
      <td width="20">:</td>
      <td><select name="fJNS" class="boxs" id="fJNS" style="width: 480px" tabindex="0" <?php echo $Sbmt?>>
          <?php
		$nSQ = "SELECT Kd_Rek, Nm_Rek FROM ref_rek_3 WHERE Kd_Rek LIKE '".$zBid.".".substr($zKel,-1)."._' ORDER BY Kd_Rek";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gJNS=="") {$gJNS=$mRo['Kd_Rek'];}
			if (substr($gJNS,0,3)!=$zKel) {$gJNS=$mRo['Kd_Rek'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Rek']==$gJNS) 
				{
				$sel ="selected";
				$zJNS=$mRo['Kd_Rek'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Rek'].'">'.$mRo['Kd_Rek']." : ".$mRo['Nm_Rek'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
    </tr>
    <tr> 
      <td width="24">&nbsp;</td>
      <td width="93">OBJEK</td>
      <td width="20">:</td>
      <td><select class="boxs" name="fOBJ" tabindex="0" style="width: 480px" <?php echo $Sbmt?>>
          <?php
		$nSQ = "SELECT Kd_Rek, Nm_Rek FROM ref_rek_4 WHERE Kd_Rek LIKE '".$gBid.".".substr($zKel,-1).".".substr($zJNS,-1).".__' ORDER BY Kd_Rek";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gOBJ=="") {$gOBJ=$mRo['Kd_Rek'];}
			if (substr($gOBJ,0,5)!=$zJNS) {$gOBJ=$mRo['Kd_Rek'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Rek']==$gOBJ) 
				{
				$sel ="selected";
				$zOBJ=$mRo['Kd_Rek'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Rek'].'">'.$mRo['Kd_Rek']." : ".$mRo['Nm_Rek'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
    </tr>
    <tr> 
      <td width="24">&nbsp;</td>
      <td width="93">KODE ASET</td>
      <td width="20">:</td>
      <td><input name="fKode" type="text" class="text" id="fKode" style="font-family: Calibri; font-size: 11pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" value="<?php echo $gCod?>" size="8" maxlength="11" /></td>
    </tr>
    <tr> 
      <td width="24">&nbsp;</td>
      <td width="93">NAMA ASET</td>
      <td width="20">:</td>
      <td><input name="fNama" type="text" class="text" id="fNama" style="font-family: Calibri; font-size: 11pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" value="<?php echo $gNma?>" size="56" maxlength="100" /></td>
    </tr>
    <tr> 
      <td width="24">&nbsp;</td>
      <td width="93">&nbsp;</td>
      <td width="20">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="button" name="B39" value="SIMPAN" onclick="P_Save('<?=$ReO?>')" style="width: 60px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
        <input type="button" name="B392" value="RESET" onclick="P_Reset('<?=$ReO?>')" style="width: 60px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
        <input type="button" name="B393" value="TUTUP" onclick="P_Tutup()" style="width: 60px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
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
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}

	function P_Reset(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		objfrm.Simpan.value = "Reset";
		objfrm.submit();
	}
	
	function P_Tutup()
	{
		objfrm.Simpan.value = "Close";
		objfrm.target="_top";
		objfrm.submit();
	}
</script>

<?php require('Connection_Close.php');?>
