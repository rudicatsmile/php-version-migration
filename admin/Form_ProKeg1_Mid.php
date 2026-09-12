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
<?php
$rIDO = $_GET['rIDO'];
if ($rIDO!="")
{
	$nSQ = "SELECT * FROM ref_kegiatan WHERE IDO='".$rIDO."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gCod1 = substr($mRo['Id_Referensi'],0,1);
		$gCod2 = substr($mRo['Id_Referensi'],2,2);
		$gCod3 = substr($mRo['Id_Referensi'],5,2);
		$gNma  = $mRo['Nm_Referensi'];
		$ReadO = "readonly";
	}
}
else
{
	$gCod1  = "";
	$gCod2  = "";
	$gCod3  = "XX";
	$ReadO = "";
}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Form_ProKeg1_Mid_.php?IdL=".$_REQUEST['IdL']."&rIDO=".$rIDO ?>">
  <input type="hidden" name="Simpan">
  <table border="0" width="663" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse">
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="490">&nbsp;</td>
    </tr>
    <tr> 
      <td width="24">&nbsp;</td>
      <td width="111">KODE URUSAN</td>
      <td width="25">:</td>
      <td>
	  <input name="fKode1" type="text" class="text" id="fKode1" style="font-family: Calibri; font-size: 11pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" value="<?php echo $gCod1?>" size="1" maxlength="1" <?php echo $ReadO?>/>.
	  <input name="fKode2" type="text" class="text" id="fKode2" style="font-family: Calibri; font-size: 11pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" value="<?php echo $gCod2?>" size="2" maxlength="2" <?php echo $ReadO?>/>.
      <input name="fKode3" type="text" class="text" id="fKode3" style="font-family: Calibri; font-size: 11pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" value="<?php echo $gCod3?>" size="2" maxlength="2" readonly/></td>
    </tr>
    <tr> 
      <td width="24">&nbsp;</td>
      <td width="111">NAMA URUSAN</td>
      <td width="25">:</td>
      <td><input name="fNama" type="text" class="text" id="fNama" style="font-family: Calibri; font-size: 11pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" value="<?php echo $gNma?>" size="56" maxlength="100" /></td>
    </tr>
    <tr> 
      <td width="24">&nbsp;</td>
      <td width="111">&nbsp;</td>
      <td width="25">&nbsp;</td>
      <td style="color:#FF0000"><?php echo $_REQUEST['MsG']?>&nbsp;</td>
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
