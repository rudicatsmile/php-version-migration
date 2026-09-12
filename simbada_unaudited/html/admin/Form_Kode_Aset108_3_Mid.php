<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?
extract($_POST);
extract($_GET);
$rIDT = $rIDT;
$Sbmt  = "";
if ($rIDT!="")
{
	$nSQ = "SELECT * FROM ref_rek_aset108_4 WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gCod  = $mRo['Kd_Aset'];
		$gNma  = $mRo['Nm_Aset'];
		$gBid  = substr($gCod,0,3);
		$gKel  = substr($gCod,0,5);
	}
}
else
{
	if ($gBid!="")
	{
		$gBid  = $gBid;
		$gKel  = $gKel;
	}
	else
	{
		$gCod  = $KdAst2;
		$gBid  = substr($gCod,0,3);
		$gKel  = substr($gCod,0,5);
	}
	$gCod  = $gKel.".xx";
	$gUMR  = 0;
	$Sbmt  = "onchange='this.form.submit()'";
}

//echo $gKel;
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Form_Kode_Aset108_3_Mid_.php?IdL=".$IdL."&rIDT=".$rIDT ?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="fDL">
  
  <table border="0" width="663" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse">
    <tr> 
      <td width="24">&nbsp;</td>
      <td width="130">&nbsp;</td>
      <td width="20">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>BIDANG</td>
      <td>:</td>
      <td><select class="boxs" name="fBid" tabindex="0" style="width: 480px" <? echo $Sbmt?>>
          <?
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_2 ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
            if ($gBid!="All")
            {
			if ($gBid=="") {$gBid=$mRo['Kd_Aset'];}
            }
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gBid) 
				{
				$sel ="selected";
				$zBid=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>KELOMPOK</td>
      <td>:</td>
      <td><select name="fKel" class="boxs" id="fKel" style="width: 480px" tabindex="0" <? echo $Sbmt?>>
          <?
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '".$zBid."._' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			if (substr($gKel,0,3)!=$zBid) {$gKel=$mRo[0];}
			if ($gKel=="") {$gKel=$mRo[0];}
			$sel ="";
			if ($mRo[0]==$gKel) 
			{
			$sel ="selected";
			$zKel=$mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo[1].'</option>';
		}
	  ?>
        </select></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>KODE OBJEK </td>
      <td>:</td>
      <td><input name="fKode" type="text" class="text" id="fKode" style="font-family: Calibri; font-size: 11pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" value="<? echo $gCod?>" size="5" maxlength="8" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>NAMA OBJEK </td>
      <td>:</td>
      <td><input name="fNama" type="text" class="text" id="fNama" style="font-family: Calibri; font-size: 11pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" value="<? echo $gNma?>" size="56" maxlength="100" /></td>
    </tr>
    
    
    <tr> 
      <td width="24">&nbsp;</td>
      <td width="130">&nbsp;</td>
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
	function P_Add(xR)
	{
		if (xR=='') {alert('Data belum disimpan..!!'); return false;}
		objfrm.Simpan.value = "Add";
		objfrm.submit();
	}

	function P_Dell(xR)
	{
		var AN = confirm("Delete record..?!!");
		if (AN)
		{
			objfrm.fDL.value = xR;
			objfrm.Simpan.value = "DelItem";
			objfrm.submit();
		}
	}
	
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
