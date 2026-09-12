<?php
require "Connection.php";
require "FileFunction.php";

extract($_GET);
$gHri  = "00";   //fGetDate('mday');
$gBln  = "00";   //fGetDate('mon');
$gThn  = "0000"; //fGetDate('year');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<form name="popupfrm" method="post" action="<?="P47_Pengamanan_.php?BckFrm=".$_GET['BckFrm']."&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL']?>">
<input type="hidden" name="fCritP" id="fCritP" style="width:70px" />
<table align="center" border="0" width="990" cellpadding="0" cellspacing="0" style="font-size:10pt; font-family: Calibri; border-collapse:collapse">

  <tr>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
	<td width="30">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="Images/Logo Litle.gif" width="20px" /></td>
    <td style="font-weight:bold; text-transform:uppercase">PEMAKAIAN</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" style="font-size:9pt; font-family: Calibri; border-collapse:collapse">
	<?php
	$Dta = fGlobal("Referensi:Ref_Group","ta_kib_108","IDT",$rIDT,"=","","");
	$Dta = explode(":",$Dta);
	$Ref = $Dta[0];
	$Grp = $Dta[1];
	
	$nSQ = "SELECT IDT as A0,
	Tanggal_p as A1,
	Nama_p as A2,
	Status_p as A3,
	Jabatan_p as A4,
	Identitas_p as A5,
	
	BastNomor_p as A6,
	BastTanggal_p as A7,
	
	Tanggal_k as A8,
	Nama_k as A9,
	Identitas_k as A10,
	Alamat_k as A11,
	Penyebab_k as A12,
	BastNomor_k as A13,
	BastTanggal_k as A14 
	
	FROM ta_kib_108_p47_pengamanan WHERE Referensi='".$Ref."' AND RefGroup='".$Grp."'";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs))
	{
		$TgLP = $mRo[1];
		$TgLP = explode("-",$TgLP);
		$HriP = $TgLP[2];
		$BlnP = $TgLP[1];
		$ThnP = $TgLP[0];
		
		$NamaP = $mRo[2];
		$StatusP = $mRo[3];
		$JabatanP = $mRo[4];
		$IdentitasP = $mRo[5];
		$BastNomorP = $mRo[6];
		
		$BastP = $mRo[7];
		$BastP = explode("-",$BastP);
		$HriBastP = $BastP[2];
		$BlnBastP = $BastP[1];
		$ThnBastP = $BastP[0];
		
		$TgLK = $mRo[8];
		$TgLK = explode("-",$TgLK);
		$HriK = $TgLK[2];
		$BlnK = $TgLK[1];
		$ThnK = $TgLK[0];
		
		$NamaK = $mRo[9];
		$IdentitasK = $mRo[10];
		$AlamatK = $mRo[11];
		$PenyebabK = $mRo[12];
		$BastNomorK = $mRo[13];
		
		$BastK = $mRo[14];
		$BastK = explode("-",$BastK);
		$HriBastK = $BastK[2];
		$BlnBastK = $BastK[1];
		$ThnBastK = $BastK[0];
	}
	?>
      <tr height="22">
        <td width="220">Tanggal</td>
        <td width="23">:</td>
        <td>
		<select class="boxs" name="fHriP" id="fHriP" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriP) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnP" id="fBlnP" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnP) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnP" id="fThnP" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?php
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnP) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>		</td>
      </tr>
      <tr height="22">
        <td>Nama Pemakai </td>
        <td>:</td>
        <td><input type="text" name="fNamaP" id="fNamaP" value="<?=$NamaP?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td>Status Pemakai </td>
        <td>:</td>
        <td><input type="text" name="fStatusP" id="fStatusP" value="<?=$StatusP?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td>Jabatan Pemakai </td>
        <td>:</td>
        <td><input type="text" name="fJabatanP" id="fJabatanP" value="<?=$JabatanP?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td>Nomor Identitas Pemakai </td>
        <td>:</td>
        <td><input type="text" name="fIdentitasP" id="fIdentitasP" value="<?=$IdentitasP?>" style="width:300px" /></td>
      </tr>
      

      <tr height="22">
        <td style="font-weight:bold">Berita Acara Serah Terima Pemakaian</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Nomor</li></td>
        <td>:</td>
        <td><input type="text" name="fBastNomorP" id="fBastNomorP" value="<?=$BastNomorP?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Tanggal</li></td>
        <td>:</td>
        <td>
		<select class="boxs" name="fHriBastP" id="fHriBastP" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriBastP) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnBastP" id="fBlnBastP" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnBastP) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnBastP" id="fThnBastP" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?php
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnBastP) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>		</td>
      </tr>
      


      <tr height="22">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="Images/Logo Litle.gif" width="20px" /></td>
    <td style="font-weight:bold; text-transform:uppercase">PENGEMBALIAN</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><table border="0" width="100%" cellpadding="0" cellspacing="0" style="font-size:9pt; font-family: Calibri; border-collapse:collapse">
      <tr height="22">
        <td width="220">Tanggal</td>
        <td width="23">:</td>
        <td>
		<select class="boxs" name="fHriK" id="fHriK" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriK) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnK" id="fBlnK" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnK) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnK" id="fThnK" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?php
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnK) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>		</td>
      </tr>
      <tr height="22">
        <td width="220">Nama Pemakai </td>
        <td width="23">:</td>
        <td><input type="text" name="fNamaK" id="fNamaK" value="<?=$NamaK?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td>Nomor Identitas Pemakai </td>
        <td>:</td>
        <td><input type="text" name="fIdentitasK" id="fIdentitasK" value="<?=$IdentitasK?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td>Alamat Pemakai</td>
        <td>:</td>
        <td><input type="text" name="fAlamatK" id="fAlamatK" value="<?=$AlamatK?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td>Penyebab Pengembalian/Penyerahan</td>
        <td>:</td>
        <td><input type="text" name="fPenyebabK" id="fPenyebabK" value="<?=$PenyebabK?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="font-weight:bold">Berita Acara Serah Terima Pengembalian</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Nomor</li></td>
        <td>:</td>
        <td><input type="text" name="fBastNomorK" id="fBastNomorK" value="<?=$BastNomorK?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Tanggal</li></td>
        <td>:</td>
        <td><select class="boxs" name="fHriBastK" id="fHriBastK" tabindex="0" style="width:45px">
            <option value="00"></option>
            <?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriBastK) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
          </select>
            <select class="boxs" name="fBlnBastK" id="fBlnBastK" tabindex="0" style="width:90px">
              <option value="00"></option>
              <?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnBastK) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
            </select>
            <select class="boxs" name="fThnBastK" id="fThnBastK" style="width: 60px" tabindex="0">
              <option value="0000"></option>
              <?php
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnBastK) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
            </select>        </td>
      </tr>
      
      <tr height="22">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" style="font-size:9pt; font-family: Calibri; border-collapse:collapse">
      <tr height="22">
        <td width="220"><a href="<?="Form_Asset_".$BckFrm."_Mid.php?rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL']?>" class="ico back">&nbsp;Back To Aset</a></td>
        <td width="23">&nbsp;</td>
        <td>
		<input type="button" name="fSave" id="fSave" value="Save"    onclick="p_Save()" style="width:80px; height:20px" />
        <input type="button" name="fReff" id="fReff" value="Refresh" onclick="p_Refr()" style="width:80px; height:20px" />		</td>
      </tr>
	</table>	</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</html>
<script language="javascript">
	myfrm=document.popupfrm;
	function p_Save()
	{
		$("#fCritP").val('Save');
		myfrm.submit();
	}
	
	function p_Refr()
	{
		$("#fCritP").val('Refr');
		myfrm.submit();
	}
</script>