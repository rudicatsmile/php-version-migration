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
$gUpb = $_GET['gUpb'];
$rIDT = $_GET['rIDT'];
$ReO  = "N";
if ($rIDT!="")
{
	$nSQ = "SELECT * FROM ta_upb WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gThnG = $mRo['Tahun'];
		
		$gPimA = $mRo['Nm_Pimpinan'];
		$gPimB = $mRo['Nip_Pimpinan'];
		$gPimC = $mRo['Jbt_Pimpinan'];

		$gPimD = $mRo['HP_Pimpinan'];
		$gPimE = $mRo['Pin_Pimpinan'];
		$gPimF = $mRo['Ema_Pimpinan'];

		$gPrsA = $mRo['Nm_Pengurus'];
		$gPrsB = $mRo['Nip_Pengurus'];
		$gPrsC = $mRo['Jbt_Pengurus'];

		$gPrsD = $mRo['HP_Pengurus'];
		$gPrsE = $mRo['Pin_Pengurus'];
		$gPrsF = $mRo['Ema_Pengurus'];

		$gPnyA = $mRo['Nm_Penyimpan'];
		$gPnyB = $mRo['Nip_Penyimpan'];
		$gPnyC = $mRo['Jbt_Penyimpan'];
		
		$gPnyD = $mRo['HP_Penyimpan'];
		$gPnyE = $mRo['Pin_Penyimpan'];
		$gPnyF = $mRo['Ema_Penyimpan'];
		
		$gBosA = $mRo['Nm_Bend_BOS'];
		$gBosB = $mRo['Nip_Bend_BOS'];
		$gBosC = $mRo['Jbt_Bend_BOS'];
		
		$gBosD = $mRo['HP_Bend_BOS'];
		$gBosE = $mRo['Pin_Bend_BOS'];
		$gBosF = $mRo['Ema_Bend_BOS'];
	}
}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Form_UPB_Edit_Mid_.php?IdL=".$_REQUEST['IdL']."&rIDT=".$rIDT."&gUpb=".$gUpb?>">
<input type="hidden" name="Simpan">
  <table border="0" width="871" cellpadding="0" style="border-collapse: collapse">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>TAHUN</td>
      <td>:</td>
      <td width="284"><input name="fThn" type="text" class="text" id="fThn" style="width:50px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gThnG?>" size="3" maxlength="4" /></td>
      <td width="89">&nbsp;</td>
      <td width="25">&nbsp;</td>
      <td width="279">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td width="23">&nbsp;</td>
      <td width="136">NAMA PIMPINAN</td>
      <td width="19">:</td>
      <td> <input name="fNm_Pimpinan" type="text" class="text" id="fNm_Pimpinan" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPimA?>" /></td>
      <td>NOMOR HP </td>
      <td>:</td>
      <td><input name="fHp_Pimpinan" type="text" class="text" id="fHp_Pimpinan" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPimD?>" /></td>
    </tr>
    <tr> 
      <td width="23">&nbsp;</td>
      <td width="136">NIP PIMPINAN</td>
      <td width="19">:</td>
      <td><input name="fNip_Pimpinan" type="text" class="text" id="fNip_Pimpinan" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPimB?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="fPin_Pimpinan" type="text" class="text" id="fPin_Pimpinan" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPimE?>" /></td>
    </tr>
    <tr> 
      <td width="23">&nbsp;</td>
      <td width="136">JABATAN PIMPINAN</td>
      <td width="19">:</td>
      <td><input name="fJbt_Pimpinan" type="text" class="text" id="fJbt_Pimpinan" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPimC?>" /></td>
      <td>EMAIL ADDRES  </td>
      <td>:</td>
      <td><input name="fEma_Pimpinan" type="text" class="text" id="fEma_Pimpinan" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPimF?>" /></td>
    </tr>
    <tr> 
      <td width="23">&nbsp;</td>
      <td width="136">&nbsp;</td>
      <td width="19">:</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td width="23">&nbsp;</td>
      <td width="136">NAMA PENGURUS</td>
      <td width="19">:</td>
      <td><input name="fNm_Pengurus" type="text" class="text" id="fNm_Pengurus" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPrsA?>" /></td>
      <td>NOMOR HP </td>
      <td>:</td>
      <td><input name="fHp_Pengurus" type="text" class="text" id="fHp_Pengurus" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPrsD?>" /></td>
    </tr>
    <tr> 
      <td width="23">&nbsp;</td>
      <td width="136">NIP PENGURUS</td>
      <td width="19">:</td>
      <td><input name="fNip_Pengurus" type="text" class="text" id="fNip_Pengurus" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPrsB?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="fPin_Pengurus" type="text" class="text" id="fPin_Pengurus" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPrsE?>" /></td>
    </tr>
    <tr> 
      <td width="23">&nbsp;</td>
      <td width="136">JABATAN PENGURUS</td>
      <td width="19">:</td>
      <td><input name="fJbt_Pengurus" type="text" class="text" id="fJbt_Pengurus" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPrsC?>" /></td>
      <td>EMAIL ADDRES </td>
      <td>:</td>
      <td><input name="fEma_Pengurus" type="text" class="text" id="fEma_Pengurus" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPrsF?>" /></td>
    </tr>
    <tr> 
      <td width="23">&nbsp;</td>
      <td width="136">&nbsp;</td>
      <td width="19">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td width="23">&nbsp;</td>
      <td width="136">NAMA PENYIMPAN</td>
      <td width="19">:</td>
      <td><input name="fNm_Penyimpan" type="text" class="text" id="fNm_Penyimpan" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPnyA?>" /></td>
      <td>NOMOR HP </td>
      <td>:</td>
      <td><input name="fHp_Penyimpan" type="text" class="text" id="fHp_Penyimpan" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPnyD?>" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>NIP PENYIMPAN</td>
      <td>:</td>
      <td><input name="fNip_Penyimpan" type="text" class="text" id="fNip_Penyimpan" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPnyB?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="fPin_Penyimpan" type="text" class="text" id="fPin_Penyimpan" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPnyE?>" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>JABATAN PENGURUS</td>
      <td>:</td>
      <td><input name="fJbt_Penyimpan" type="text" class="text" id="fJbt_Penyimpan" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPnyC?>" /></td>
      <td>EMAIL ADDRES </td>
      <td>:</td>
      <td><input name="fEma_Penyimpan" type="text" class="text" id="fEma_Penyimpan" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPnyF?>" /></td>
    </tr>
    <tr> 
      <td width="23">&nbsp;</td>
      <td width="136">&nbsp;</td>
      <td width="19">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td width="23">&nbsp;</td>
      <td width="136">NAMA BENDAHARA BOS </td>
      <td width="19">:</td>
      <td><input type="text" class="text" name="fNm_BendBOS" id="fNm_BendBOS" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gBosA?>" /></td>
      <td>NOMOR HP </td>
      <td>:</td>
      <td><input type="text" class="text" name="fHp_BendBOS" id="fHp_BendBOS" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gBosD?>" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>NIP BENDAHAR BOS </td>
      <td>:</td>
      <td><input type="text" class="text" name="fNip_BendBOS" id="fNip_BendBOS" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gBosB?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="text" class="text" name="fPin_BendBOS" id="fPin_BendBOS" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gBosE?>" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>JABATAN</td>
      <td>:</td>
      <td><input type="text" class="text" name="fJbt_BendBOS" id="fJbt_BendBOS" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gBosC?>" /></td>
      <td>EMAIL ADDRES </td>
      <td>:</td>
      <td><input type="text" class="text" name="fEma_BendBOS" id="fEma_BendBOS" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gBosF?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="4"><input type="button" name="B39" value="SIMPAN" onclick="P_Save('<?=$ReO?>')" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
        <input type="button" name="B393" value="TUTUP" onclick="P_Tutup()" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />      </td>
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

	function P_Tutup()
	{
		objfrm.Simpan.value = "Close";
		objfrm.target="_top";
		objfrm.submit();
	}
</script>

<?php require('Connection_Close.php');?>
