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
<form name="popupfrm" method="post" action="<?="P47_Pemanfaatan_.php?BckFrm=".$_GET['BckFrm']."&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL']?>">
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
    <td style="font-weight:bold; text-transform:uppercase">PEMANFAATAN BMD </td>
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
	Tanggal as A1,
	Pemanfaat as A2,
	Jumlah as A3,
	Satuan as A4,
	Mitra as A5,
	Bentuk as A6,
	'' as A7,
	'' as A8,
	'' as A9,
	'' as A10,
	'' as A11,
	Alamat as A12,
	Tanah as A13,
	JangkaWaktu as A14,
	MulaiPenggunaan as A15,
	AkhirPenggunaan as A16,
	Peruntukan as A17,
	SetujuNomor as A18,
	SetujuTanggal as A19,
	JanjiNomor as A20,
	JanjiTanggal as A21,
	DokLainnyaNama as A22,
	DokLainnyaNomor as A23,
	DokLainnyaTanggal as A24 
	
	FROM ta_kib_108_p47_pemanfaatan WHERE Referensi='".$Ref."' AND RefGroup='".$Grp."'";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs))
	{
		$TgL = $mRo[1];
		$TgL = explode("-",$TgL);
		$Hri = $TgL[2];
		$Bln = $TgL[1];
		$Thn = $TgL[0];
		
		$Bentuk = $mRo[6];
		$Pemanfaat = $mRo[2];
		$Mitra = $mRo[5];
		
		$Alamat = $mRo[12];
		$Jumlah = $mRo[3];
		$Satuan = $mRo[4];

		$Tanah = $mRo[13];
		$Waktu = $mRo[14];
		
		$MulaiP = $mRo[15];
		$MulaiP = explode("-",$MulaiP);
		$HriMulai = $MulaiP[2];
		$BlnMulai = $MulaiP[1];
		$ThnMulai = $MulaiP[0];
		
		$AkhirP = $mRo[16];
		$AkhirP = explode("-",$AkhirP);
		$HriAkhir = $AkhirP[2];
		$BlnAkhir = $AkhirP[1];
		$ThnAkhir = $AkhirP[0];
		
		$Peruntukan = $mRo[17];
		$SpBNomor = $mRo[18];
		$SpBT = $mRo[19];
		$SpBT = explode("-",$SpBT);
		$HriSpB = $SpBT[2];
		$BlnSpB = $SpBT[1];
		$ThnSpB = $SpBT[0];
		
		$SpNomor = $mRo[20];
		$SP = $mRo[21];
		$SP = explode("-",$SP);
		$HriSp = $SP[2];
		$BlnSp = $SP[1];
		$ThnSp = $SP[0];
		
		$DokLainNama=$mRo[22];
		$DokLainNomor=$mRo[23];
		$DokLainT = $mRo[24];
		$DokLainT = explode("-",$DokLainT);
		$HriDokLain = $DokLainT[2];
		$BlnDokLain = $DokLainT[1];
		$ThnDokLain = $DokLainT[0];
		
	}
	?>
      <tr height="22">
        <td width="220">Tanggal</td>
        <td width="23">:</td>
        <td>
		<select class="boxs" name="fHri" id="fHri" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$Hri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBln" id="fBln" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$Bln) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThn" id="fThn" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?php
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$Thn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>		</td>
      </tr>
      <tr height="22">
        <td>Bentuk Pemanfaatan </td>
        <td>:</td>
        <td><input type="text" name="fBentuk" id="fBentuk" value="<?=$Bentuk?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td>Mitra Pemanfaatan </td>
        <td>:</td>
        <td><input type="text" name="fMitra" id="fMitra" value="<?=$Mitra?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td>Pemerintah Pusat/Pemerintah Daerah Lainnya</td>
        <td>:</td>
        <td><input type="text" name="fPemanfaat" id="fPemanfaat" value="<?=$Pemanfaat?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td>Alamat</td>
        <td>:</td>
        <td><input type="text" name="fAlamat" id="fAlamat" value="<?=$Alamat?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td>Jumlah</td>
        <td>:</td>
        <td><input type="text" name="fJumlah" id="fJumlah" value="<?=$Jumlah?>" /></td>
      </tr>
      <tr height="22">
        <td>Satuan Barang</td>
        <td>:</td>
        <td><input type="text" name="fSatuan" id="fSatuan" value="<?=$Satuan?>" /></td>
      </tr>
      <tr height="22">
        <td>Tanah yang Digunakan</td>
        <td>:</td>
        <td><input type="text" name="fTanah" id="fTanah" value="<?=$Tanah?>" /></td>
      </tr>
      <tr height="22">
        <td>Jangka Waktu</td>
        <td>:</td>
        <td><input type="text" name="fWaktu" id="fWaktu" value="<?=$Waktu?>" /></td>
      </tr>
      <tr height="22">
        <td>Tanggal, Bulan, Tahun Mulai Penggunaan</td>
        <td>:</td>
        <td>
		<select class="boxs" name="fHriMulai" id="fHriMulai" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriMulai) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnMulai" id="fBlnMulai" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnMulai) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnMulai" id="fThnMulai" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?php
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnMulai) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>		</td>
      </tr>
      <tr height="22">
        <td>Tanggal, Bulan, Tahun Berakhir Penggunaan</td>
        <td>:</td>
        <td>
		<select class="boxs" name="fHriAkhir" id="fHriAkhir" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriAkhir) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnAkhir" id="fBlnAkhir" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnAkhir) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnAkhir" id="fThnAkhir" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?php
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnAkhir) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>		</td>
      </tr>
      <tr height="22">
        <td>Peruntukan</td>
        <td>:</td>
        <td><input type="text" name="fPeruntukan" id="fPeruntukan" value="<?=$Peruntukan?>" /></td>
      </tr>
      
      <tr height="22">
        <td style="font-weight:bold">a. Surat Persetujuan</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Nomor</li></td>
        <td>:</td>
        <td><input type="text" name="fSetujuNomor" id="fSetujuNomor" value="<?=$SpBNomor?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Tanggal</li></td>
        <td>:</td>
        <td>
		<select class="boxs" name="fHriSpB" id="fHriSpB" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriSpB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnSpB" id="fBlnSpB" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnSpB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnSpB" id="fThnSpB" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?php
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnSpB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>		</td>
      </tr>
      <tr height="22">
        <td style="font-weight:bold">b. Surat Perjanjian </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Nomor</li></td>
        <td>:</td>
        <td><input type="text" name="fJanjiNomor" id="fJanjiNomor" value="<?=$SpNomor?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Tanggal</li></td>
        <td>:</td>
        <td>
		<select class="boxs" name="fHriSp" id="fHriSp" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriSp) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnSp" id="fBlnSp" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnSp) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnSp" id="fThnSp" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?php
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnSp) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>		</td>
      </tr>
      
      <tr height="22">
        <td style="font-weight:bold">c. Dokumen Pendukung Lainnya </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Nama Dokumen Pendukung Lainnya</li></td>
        <td>:</td>
        <td><input type="text" name="fDokLainNama" id="fDokLainNama" value="<?=$DokLainNama?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Nomor</li></td>
        <td>:</td>
        <td><input type="text" name="fDokLainNomor" id="fDokLainNomor" value="<?=$DokLainNomor?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Tanggal</li></td>
        <td>:</td>
        <td>
		<select class="boxs" name="fHriDokLain" id="fHriDokLain" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriDokLain) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnDokLain" id="fBlnDokLain" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnDokLain) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnDokLain" id="fThnDokLain" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?php
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnDokLain) {$sel ="selected";}
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