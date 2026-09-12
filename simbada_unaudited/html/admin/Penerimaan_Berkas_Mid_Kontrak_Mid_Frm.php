<?php require "Connection.php"?>
<?php require "FileFunction.php"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_mid.css" type="text/css" media="all" />
</head>
<?
if (isset($_GET['gKG'])) {$gKG  = $_GET['gKG'];}
if (isset($_GET['gRK'])) {$gRK  = $_GET['gRK'];}
if (isset($_GET['gID'])) {$gID  = $_GET['gID'];}

//$gTH = date('Y');
//$gBL = date('m');
//$gHR = date('d');

$gDeL = "";
if ($gID)
{
	$nSQ = "SELECT Periode, Nomor, Tanggal, Uraian FROM ta_kontrak WHERE IDT='$gID'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$gNoM = $mRo['Nomor'];
	$gTaG = $mRo['Tanggal'];
	$gTaG = explode("-",$gTaG);
	$gTH = $gTaG[0];
	$gBL = $gTaG[1];
	$gHR = $gTaG[2];
	$gUrA = $mRo['Uraian'];
	$gPrD = $mRo['Periode'];
	$gDeL = fGlobalNEW("IDT","ta_penerimaan_berkas","No_Kontrak:Kd_Kegiatan:Kd_Rek13:Periode",$gNoM.":".$gKG.":".$gRK.":".$gPrD,"=:=:=:=","",DatabaseSB,$ConSB,"");
}
?>
<body>
<form name="myfrm" method="post" action="<?="Penerimaan_Berkas_Mid_Kontrak_Mid_Frm_.php?gID=".$gID."&gKG=".$gKG."&gRK=".$gRK."&IdL=".$_GET['IdL'] ?>">
  <input type="hidden" name="fSimpan">
  <table border="0" align="center" cellpadding="0" cellspacing="0" style="width:770px">
	<tr height="22">
	  <td width="40" valign="top">&nbsp;</td>
	  <td width="133" valign="top">&nbsp;</td>
	  <td width="21" valign="top">&nbsp;</td>
	  <td width="544" valign="top">&nbsp;</td>
	  <td width="32" valign="top"></td>
    </tr>
	<tr height="25">
	  <td valign="top">&nbsp;</td>
	  <td valign="top">PERIODE APBD</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">
	  <? if ($gID) {?>
	  <input name="fPrD" type="text" value="<?=$gPrD?>" readonly style="width:40px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <? } else {?>
	  <select class="boxs" name="fPrD" style="width: 60px">
        <option value=""></option>
        <?
		for($nThn=2015; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$gPrD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
      </select>
	  <? } ?>
	  </td>
	  <td valign="top"></td>
    </tr>
	<tr height="25">
	  <td valign="top">&nbsp;</td>
	  <td valign="top">NOMOR KONTRAK </td>
	  <td valign="top">:</td>
	  <td valign="top"><input name="fNoM" type="text" value="<?=$gNoM?>" <? if ($gDeL) {echo "readonly";}?> style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
	  <td valign="top"></td>
    </tr>
	<tr height="27">
	  <td valign="top">&nbsp;</td>
	  <td valign="top">TANGGAL KONTRAK </td>
	  <td valign="top">:</td>
	  <td valign="top">
	  <select name="fHri" tabindex="0" class="boxs" style="width:50px">
      <option value=""></option>
        <?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHR) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
      </select>
	    &nbsp;
        <select class="boxs" name="fBln" style="width:87px">
          <option value=""></option>
          <?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$gBL) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
        </select>
        &nbsp;
        <select class="boxs" name="fThn" style="width: 60px">
          <option value=""></option>
          <?
		for($nThn=2015; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$gTH) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
        </select></td>
	  <td valign="top"></td>
    </tr>
	<tr height="22">
	  <td valign="top">&nbsp;</td>
	  <td valign="top">URAIAN</td>
	  <td valign="top">:</td>
	  <td valign="top">
	  <textarea name="fUrA" style="border-radius:5px; width:400px; height:80px"><?=$gUrA?></textarea></td>
	  <td valign="top"></td>
    </tr>
	<tr height="22">
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top"><? if (isset($_GET['MsG'])) {echo $_GET['MsG'];}?></td>
	  <td valign="top"></td>
    </tr>
	<tr height="22">
	  <td valign="top">&nbsp;</td>
	  <td valign="top"><a href="<?="Penerimaan_Berkas_Mid_Kontrak_Mid.php?gKG=".$gKG."&gRK=".$gRK."&IdL=".$_GET['IdL']?>" class="ico back">&nbsp;&nbsp;DATA KONTRAK</a></td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">
	  <input type="button" name="B1" value="SAVE"  onclick="P_Save()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
      <input type="button" name="B2" value="RESET"  onclick="P_Reset()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
	  <td valign="top"></td>
    </tr>
	<tr height="22">
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp;</td>
	  <td valign="top"></td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Save()
	{
		if (objfrm.fPrD.value=="") {alert('Silahkan pilih periode APBD...!!'); return false;}
		if (objfrm.fNoM.value=="") {alert('Silahkan isi nomor kontrak...!!'); return false;}
		if (objfrm.fHri.value=="" || objfrm.fBln.value=="" || objfrm.fThn.value=="") {alert('Silahkan tentukan tanggal kontrak...!!'); return false;}
		
		objfrm.fSimpan.value = "Save";
		objfrm.submit();
	}
	function P_Reset()
	{
		objfrm.fSimpan.value = "Reset";
		objfrm.submit();
	}
</script>

