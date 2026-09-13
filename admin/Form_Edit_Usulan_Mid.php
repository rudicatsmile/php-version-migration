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
$rIDT = $_REQUEST['rIDT'];
$gIDT = $_REQUEST['gIDT'];

$nSQ = "SELECT * FROM ta_penghapusan_usulan_rinc WHERE IDT='".$gIDT."'";
$nRs = mysql_query($nSQ) or die(mysql_error());
$mRo = mysql_fetch_assoc($nRs);
$tRo = mysql_num_rows($nRs);
if ($tRo > 0)
{
	$gREF  = $mRo['Ref_Aset'];
	$gKDB  = $mRo['Kd_Aset'];
	$gREG  = $mRo['No_Register'];
	if ($mRo['Nm_Aset']=="") {$gNMA = fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
	else {$gNMA = $mRo['Nm_Aset'];}
	$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi",$gREF,"=","","");
	$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi",$gREF,"=","","");
	if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;}
	else {$gAKH=$gNIa;}
	
	$gALS  = $mRo['Alasan'];
	$gKET  = $mRo['Keterangan'];
}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Form_Edit_Usulan_Mid_.php?gIDT=".$gIDT."&rIDT=".$rIDT."&IdL=".$_REQUEST['IdL'] ?>">
<input type="hidden" name="Simpan">
<table border="0" width="631" cellspacing="2" style="font-family: Calibri; font-size:9pt; border-collapse: collapse">
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td width="17">&nbsp;</td>
		<td width="149">KODE BARANG </td>
	  <td width="451"><input name="fKOD" type="text" class="text" id="fKOD" readonly style="font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gKDB?>" size="20" maxlength="100" /></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>NOMOR REGISTER </td>
	  <td><input name="fREG" type="text" class="text" id="fREG" readonly style="font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gREG?>" size="20" maxlength="100" /></td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
		<td>NAMA BARANG </td>
		<td><input name="fNMA" type="text" class="text" id="fNMA" readonly style="font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gNMA?>" size="68" maxlength="100" /></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>NILAI</td>
	  <td><input name="fNIL" type="text" class="text" id="fNIL" readonly style="text-align: right; font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo fConvertToRupiah($gAKH)?>" size="20" maxlength="100" /></td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
		<td>ALASAN PENGHAPUSAN </td>
		<td>
		<select name="fALS" style="width:430px; font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" tabindex="0">
        <option value="0"></option>
		<?php
		$nSQ = "SELECT * FROM ref_alasan ORDER BY Kd_Alasan";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			do
			{
				$sel ="";
				if ($mRo['Kd_Alasan']==$gALS) 
				{
				$sel ="selected";
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Alasan'].'">'.$mRo['Ur_Alasan'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
                        </select></td>
	</tr>
	
	<tr>
	  <td>&nbsp;</td>
		<td>KETERANGAN</td>
		<td><textarea name="fKET" cols="68" rows="4" id="fKET" style="font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"><?php echo $gKET ?></textarea></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="button" name="B1" value="SIMPAN" onclick="P_Save('<?=$ReO?>')" style="width: 90px; height: 20px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
      <input type="button" name="B12" value="TUTUP" onclick="P_Close()" style="width: 90px; height: 20px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
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
	
	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
	}
</script>

<?php require('Connection_Close.php');?>
