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
$rIDT = $_REQUEST['rIDT'];

$nSQ = "SELECT * FROM ta_penghapusan_usulan WHERE IDT='".$rIDT."'";
$nRs = mysql_query($nSQ) or die(mysql_error());
$mRo = mysql_fetch_assoc($nRs);
$tRo = mysql_num_rows($nRs);
if ($tRo > 0)
{
	$gREF  = $mRo['Referensi'];
	$gTGL  = fConvertDateShort($mRo['Tanggal']);
	$gNMR  = $mRo['Nomor'];
	$gNIL  = fGlobal("IfNull(sum(Nilai),0)","ta_penghapusan_usulan_rinc","Referensi",$gREF,"=","","");
	
	$gSTA  = $mRo['Status'];
	$gNoSK = $mRo['No_SK'];
	$rHri  = (int)substr($mRo['Tgl_SK'],8,10);
	$rBln  = (int)substr($mRo['Tgl_SK'],5,-3);
	$rThn  = (int)substr($mRo['Tgl_SK'],0,-6);
	$gCTT  = $mRo['Catatan_Stat'];
}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Form_Status_Usulan_Mid_.php?rIDT=".$rIDT."&gThn=".$_REQUEST['gThn']."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL'] ?>">
<input type="hidden" name="Simpan">
<table border="0" width="530" cellspacing="2" style="font-family: Calibri; font-size:9pt; border-collapse: collapse">
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td width="17">&nbsp;</td>
		<td width="123">TANGGAL USULAN </td>
	    <td width="376"><input name="fTGL" type="text" class="text" id="fTGL" readonly style="font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gTGL?>" size="30" maxlength="100" /></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>NOMOR USULAN </td>
	  <td><input name="fNMR" type="text" class="text" id="fNMR" readonly style="font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gNMR?>" size="30" maxlength="100" /></td>
    </tr>
	
	<tr>
	  <td>&nbsp;</td>
	  <td>NILAI  </td>
	  <td><input name="fNIL" type="text" class="text" id="fNIL" readonly style="text-align: right; font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo fConvertToRupiah($gNIL)?>" size="30" maxlength="100" /></td>
    </tr>
	<tr>
	  <td colspan="3">&nbsp;</td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
		<td>STATUS USULAN </td>
		<td>
		<select name="fSTA" style="width:200px; font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" tabindex="0">
        <option <? if ($gSTA=="") {echo "selected";}?> value=""></option>
        <option <? if ($gSTA=="DISETUJUI") {echo "selected";}?> value="DISETUJUI">DISETUJUI</option>
        <option <? if ($gSTA=="DITOLAK") {echo "selected";}?> value="DITOLAK">DITOLAK</option>
		</select>		</td>
	</tr>
	
	<tr>
	  <td>&nbsp;</td>
	  <td> NOMOR SK </td>
	  <td><input name="fNoSK" type="text" class="text" id="fNoSK" style="font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gNoSK?>" size="30" maxlength="100" /></td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>TANGGAL SK </td>
	  <td>
		<select class="boxs" name="fHri" tabindex="0">
		<option value="0"></option>
		<?
		for($nHri=1; $nHri<=31; $nHri++)
		{
		$sel ="";
		if ($nHri==$rHri) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		&nbsp;
		<select class="boxs" name="fBln" tabindex="0">
		<option value="0"></option>
		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
		$sel ="";
		if ($nBln==$rBln) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		&nbsp;
		<select class="boxs" name="fThn" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?
		for($nThn=2030; $nThn>=1900; $nThn--)
		{
		$sel ="";
		if ($nThn==$rThn) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>
</td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>CATATAN</td>
	  <td><textarea name="fCTT" cols="55" rows="4" id="fCTT" style="font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"><? echo $gCTT ?></textarea></td>
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
		var AN = confirm("Simpan data..?!!");
		if (AN)
		{
		objfrm.Simpan.value = "Save";
		objfrm.submit();
		}
	}
	
	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
	}
</script>

<?php require('Connection_Close.php');?>
