<?
require "Connection.php";
require "FileFunction.php";

extract($_GET);
$gHriA  = "00";   //fGetDate('mday');
$gBlnA  = "00";   //fGetDate('mon');
$gThnA  = "0000"; //fGetDate('year');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<form name="popupfrm" method="post" action="<?="P47_Penggunaan_.php?BckFrm=".$_GET['BckFrm']."&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL']?>">
<input type="hidden" name="fCritP" id="fCritP" style="width:70px" />
<table align="center" border="0" width="990" cellpadding="0" cellspacing="0" style="font-size:10pt; font-family: Calibri; border-collapse:collapse">
	<?
	$Dta = fGlobal("Referensi:Ref_Group","ta_kib_108","IDT",$rIDT,"=","","");
	$Dta = explode(":",$Dta);
	$Ref = $Dta[0];
	$Grp = $Dta[1];
	
	$nSQ = "SELECT IDT as A0,
	Tanggal as A1,
	Pengguna as A2,
	Jumlah as A3,
	Satuan as A4,
	Harga as A5,
	NilaiAkhir as A6,
	DokumenSumber as A7,
	BastNomor as A8,
	BastTanggal as A9,
	SkHapusNomor as A10,
	SkHapusTanggal as A11 
	FROM ta_kib_108_p47_penggunaan_a WHERE Referensi='".$Ref."' AND RefGroup='".$Grp."'";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs))
	{
		$TgL = $mRo[1];
		$TgL = explode("-",$TgL);
		$HriA = $TgL[2];
		$BlnA = $TgL[1];
		$ThnA = $TgL[0];
		
		$Pengguna_A = $mRo[2];
		$Jumlah_A = $mRo[3];
		$Satuan_A = $mRo[4];
		$Harga_A = $mRo[5];
		$NilaiAkhir_A = $mRo[6];
		$DokumenSumber_A = $mRo[7];
		
		$BastNomor_A = $mRo[8];
		$BaTgL = $mRo[9];
		$BaTgL = explode("-",$BaTgL);
		$BaHriA = $BaTgL[2];
		$BaBlnA = $BaTgL[1];
		$BaThnA = $BaTgL[0];
		
		$SkHapusNomor_A = $mRo[10];
		$SkTgL = $mRo[11];
		$SkTgL = explode("-",$SkTgL);
		$SkHriA = $SkTgL[2];
		$SkBlnA = $SkTgL[1];
		$SkThnA = $SkTgL[0];
	}
	?>
  <tr>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
	<td width="30">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="Images/Logo Litle.gif" width="20px" /></td>
    <td style="font-weight:bold; text-transform:uppercase">Penyerahan BMD dari Pengguna Barang kepada<br>
      Gubernur, Bupati/Walikota (A) </td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" style="font-size:9pt; font-family: Calibri; border-collapse:collapse">
      <tr height="22">
        <td width="220">Tanggal</td>
        <td width="23">:</td>
        <td>
		<select class="boxs" name="fHriA" id="fHriA" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriA) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnA" id="fBlnA" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnA) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnA" id="fThnA" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnA) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>
		</td>
        </tr>
      <tr height="22">
        <td>Pengguna Barang yang Menyerahkan</td>
        <td>:</td>
        <td><input type="text" name="fPengguna_A" id="fPengguna_A" value="<?=$Pengguna_A?>" style="width:300px" /></td>
        </tr>
      <tr height="22">
        <td>Jumlah (luas)</td>
        <td>:</td>
        <td><input type="text" name="fJumlah_A" id="fJumlah_A" value="<?=$Jumlah_A?>" /></td>
        </tr>
      <tr height="22">
        <td>Satuan Barang</td>
        <td>:</td>
        <td><input type="text" name="fSatuan_A" id="fSatuan_A" value="<?=$Satuan_A?>" /></td>
      </tr>
      <tr height="22">
        <td>Harga Satuan (Rp)</td>
        <td>:</td>
        <td><input type="text" name="fHarga_A" id="fHarga_A" value="<?=fConvertToRupiah($Harga_A)?>" style=" width:100px; text-align:right" /></td>
      </tr>
      <tr height="22">
        <td>Total Nilai Perolehan (Rp)</td>
        <td>:</td>
        <td><input type="text" name="fNilaiAkhir_A" id="fNilaiAkhir_A" value="<?=fConvertToRupiah($NilaiAkhir_A)?>" style="width:100px; text-align:right" /></td>
      </tr>
      <tr height="22">
        <td>Dokumen Sumber</td>
        <td>:</td>
        <td><input type="text" name="fDokumenSumber_A" id="fDokumenSumber_A" value="<?=$DokumenSumber_A?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="font-weight:bold">Berita Acara Serah Terima</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="22">
        <td style="padding-left:12px"><li>Nomor</li></td>
        <td>:</td>
        <td><input type="text" name="fBastNomor_A" id="fBastNomor_A" value="<?=$BastNomor_A?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:12px"><li>Tanggal</li></td>
        <td>:</td>
        <td>
		<select class="boxs" name="fBaHriA" id="fBaHriA" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$BaHriA) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBaBlnA" id="fBaBlnA" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BaBlnA) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBaThnA" id="fBaThnA" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$BaThnA) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>
		</td>
      </tr>
      <tr height="22">
        <td style="font-weight:bold">SK Penghapusan</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="22">
        <td style="padding-left:12px"><li>Nomor</li></td>
        <td>:</td>
        <td><input type="text" name="fSkHapusNomor_A" id="fSkHapusNomor_A" value="<?=$SkHapusNomor_A?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:12px"><li>Tanggal</li></td>
        <td>:</td>
        <td>
		<select class="boxs" name="fSkHriA" id="fSkHriA" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$SkHriA) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fSkBlnA" id="fSkBlnA" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$SkBlnA) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fSkThnA" id="fSkThnA" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$SkThnA) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>
		</td>
      </tr>
      <tr height="22">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="22">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>
		<input type="button" name="fSave" id="fSave" value="Save"    onclick="p_Save()" style="width:80px; height:20px" />
        <input type="button" name="fReff" id="fReff" value="Refresh" onclick="p_Refr()" style="width:80px; height:20px" />		</td>
      </tr>
      <tr height="22">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>	</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><img src="Images/Logo Litle.gif" width="20px" /></td>
    <td style="font-weight:bold; text-transform:uppercase">Pengalihan Status Penggunaan BMD (B) </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" style="font-size:9pt; font-family: Calibri; border-collapse:collapse">
	<?
	$nSQ = "SELECT IDT as A0,
	Tanggal as A1,
	Pengguna as A2,
	Jumlah as A3,
	Satuan as A4,
	Harga as A5,
	NilaiAkhir as A6,
	DokumenSumber as A7,
	BastNomor as A8,
	BastTanggal as A9,
	SkHapusNomor as A10,
	SkHapusTanggal as A11 
	FROM ta_kib_108_p47_penggunaan_b WHERE Referensi='".$Ref."' AND RefGroup='".$Grp."'";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs))
	{
		$TgL = $mRo[1];
		$TgL = explode("-",$TgL);
		$HriB = $TgL[2];
		$BlnB = $TgL[1];
		$ThnB = $TgL[0];
		
		$Pengguna_B = $mRo[2];
		$Jumlah_B = $mRo[3];
		$Satuan_B = $mRo[4];
		$Harga_B = $mRo[5];
		$NilaiAkhir_B = $mRo[6];
		$DokumenSumber_B = $mRo[7];
		
		$BastNomor_B = $mRo[8];
		$BaTgL = $mRo[9];
		$BaTgL = explode("-",$BaTgL);
		$BaHriB = $BaTgL[2];
		$BaBlnB = $BaTgL[1];
		$BaThnB = $BaTgL[0];
		
		$SkHapusNomor_B = $mRo[10];
		$SkTgL = $mRo[11];
		$SkTgL = explode("-",$SkTgL);
		$SkHriB = $SkTgL[2];
		$SkBlnB = $SkTgL[1];
		$SkThnB = $SkTgL[0];
		
	}
	?>
      <tr height="22">
        <td width="220">Tanggal</td>
        <td width="23">:</td>
        <td>
		<select class="boxs" name="fHriB" id="fHriB" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnB" id="fBlnB" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnB" id="fThnB" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>		</td>
      </tr>
      <tr height="22">
        <td>Pengguna Barang yang Menyerahkan</td>
        <td>:</td>
        <td><input type="text" name="fPengguna_B" id="fPengguna_B" value="<?=$Pengguna_B?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td>Jumlah (luas)</td>
        <td>:</td>
        <td><input type="text" name="fJumlah_B" id="fJumlah_B" value="<?=$Jumlah_B?>" /></td>
      </tr>
      <tr height="22">
        <td>Satuan Barang</td>
        <td>:</td>
        <td><input type="text" name="fSatuan_B" id="fSatuan_B" value="<?=$Satuan_B?>" /></td>
      </tr>
      <tr height="22">
        <td>Harga Satuan (Rp)</td>
        <td>:</td>
        <td><input type="text" name="fHarga_B" id="fHarga_B" value="<?=fConvertToRupiah($Harga_B)?>" style=" width:100px; text-align:right" /></td>
      </tr>
      <tr height="22">
        <td>Total Nilai Perolehan (Rp)</td>
        <td>:</td>
        <td><input type="text" name="fNilaiAkhir_B" id="fNilaiAkhir_B" value="<?=fConvertToRupiah($NilaiAkhir_B)?>" style="width:100px; text-align:right" /></td>
      </tr>
      <tr height="22">
        <td>Dokumen Sumber</td>
        <td>:</td>
        <td><input type="text" name="fDokumenSumber_B" id="fDokumenSumber_B" value="<?=$DokumenSumber_B?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="font-weight:bold">Berita Acara Serah Terima</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="22">
        <td style="padding-left:12px"><li>Nomor</li></td>
        <td>:</td>
        <td><input type="text" name="fBastNomor_B" id="fBastNomor_B" value="<?=$BastNomor_B?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:12px"><li>Tanggal</li></td>
        <td>:</td>
        <td>
		<select class="boxs" name="fBaHriB" id="fBaHriB" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$BaHriB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBaBlnB" id="fBaBlnB" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BaBlnB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBaThnB" id="fBaThnB" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$BaThnB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>		</td>
      </tr>
      <tr height="22">
        <td style="font-weight:bold">SK Penghapusan</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="22">
        <td style="padding-left:12px"><li>Nomor</li></td>
        <td>:</td>
        <td><input type="text" name="fSkHapusNomor_B" id="fSkHapusNomor_B" value="<?=$SkHapusNomor_B?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:12px"><li>Tanggal</li></td>
        <td>:</td>
        <td>
		<select class="boxs" name="fSkHriB" id="fSkHriB" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$SkHriB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fSkBlnB" id="fSkBlnB" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$SkBlnB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fSkThnB" id="fSkThnB" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$SkThnB) {$sel ="selected";}
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
      <tr height="22">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>
		<input type="button" name="fSave" id="fSave" value="Save"    onclick="p_Save()" style="width:80px; height:20px" />
        <input type="button" name="fReff" id="fReff" value="Refresh" onclick="p_Refr()" style="width:80px; height:20px" />		</td>
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
    <td><img src="Images/Logo Litle.gif" width="20px" /></td>
    <td style="font-weight:bold; text-transform:uppercase">Penggunaan Sementara BMD (C) </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" style="font-size:9pt; font-family: Calibri; border-collapse:collapse">
	<?
	$nSQ = "SELECT IDT as A0,
	Tanggal as A1,
	Pengguna as A2,
	Jumlah as A3,
	Satuan as A4,
	'' as A5,
	'' as A6,
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
	SpBupatiNomor as A18,
	SpBupatiTanggal as A19,
	SpNomor as A20,
	SpTanggal as A21,
	DokLainnyaNama as A22,
	DokLainnyaNomor as A23,
	DokLainnyaTanggal as A24 
	
	FROM ta_kib_108_p47_penggunaan_c WHERE Referensi='".$Ref."' AND RefGroup='".$Grp."'";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs))
	{
		$TgL = $mRo[1];
		$TgL = explode("-",$TgL);
		$HriC = $TgL[2];
		$BlnC = $TgL[1];
		$ThnC = $TgL[0];
		
		$Pengguna_C = $mRo[2];
		$Alamat_C = $mRo[12];
		$Jumlah_C = $mRo[3];
		$Satuan_C = $mRo[4];

		$Tanah_C = $mRo[13];
		$Waktu_C = $mRo[14];
		
		$MulaiP = $mRo[15];
		$MulaiP = explode("-",$MulaiP);
		$HriMulaiC = $MulaiP[2];
		$BlnMulaiC = $MulaiP[1];
		$ThnMulaiC = $MulaiP[0];
		
		$AkhirP = $mRo[16];
		$AkhirP = explode("-",$AkhirP);
		$HriAkhirC = $AkhirP[2];
		$BlnAkhirC = $AkhirP[1];
		$ThnAkhirC = $AkhirP[0];
		
		$Peruntukan_C = $mRo[17];
		$SpBNomor_C = $mRo[18];
		$SpBT = $mRo[19];
		$SpBT = explode("-",$SpBT);
		$HriSpBC = $SpBT[2];
		$BlnSpBC = $SpBT[1];
		$ThnSpBC = $SpBT[0];
		
		$SpNomor_C = $mRo[20];
		$SP = $mRo[21];
		$SP = explode("-",$SP);
		$HriSpC = $SP[2];
		$BlnSpC = $SP[1];
		$ThnSpC = $SP[0];
		
		$DokLainNama_C=$mRo[22];
		$DokLainNomor_C=$mRo[23];
		$DokLainT = $mRo[24];
		$DokLainT = explode("-",$DokLainT);
		$HriDokLainC = $DokLainT[2];
		$BlnDokLainC = $DokLainT[1];
		$ThnDokLainC = $DokLainT[0];
		
		/*
		$Harga_C = $mRo[5];
		$NilaiAkhir_C = $mRo[6];
		$DokumenSumber_C = $mRo[7];
		
		$BastNomor_C = $mRo[8];
		$BaTgL = $mRo[9];
		$BaTgL = explode("-",$BaTgL);
		$BaHriC = $BaTgL[2];
		$BaBlnC = $BaTgL[1];
		$BaThnC = $BaTgL[0];
		
		$SkHapusNomor_C = $mRo[10];
		$SkTgL = $mRo[11];
		$SkTgL = explode("-",$SkTgL);
		$SkHriC = $SkTgL[2];
		$SkBlnC = $SkTgL[1];
		$SkThnC = $SkTgL[0];
		*/
		
	}
	?>
      <tr height="22">
        <td width="220">Tanggal</td>
        <td width="23">:</td>
        <td>
		<select class="boxs" name="fHriC" id="fHriC" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriC) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnC" id="fBlnC" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnC) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnC" id="fThnC" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnC) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>		</td>
      </tr>
      <tr height="22">
        <td>Pengguna Barang Sementara</td>
        <td>:</td>
        <td><input type="text" name="fPengguna_C" id="fPengguna_C" value="<?=$Pengguna_C?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td>Alamat</td>
        <td>&nbsp;</td>
        <td><input type="text" name="fAlamat_C" id="fAlamat_C" value="<?=$Alamat_C?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td>Jumlah</td>
        <td>:</td>
        <td><input type="text" name="fJumlah_C" id="fJumlah_C" value="<?=$Jumlah_C?>" /></td>
      </tr>
      <tr height="22">
        <td>Satuan Barang</td>
        <td>:</td>
        <td><input type="text" name="fSatuan_C" id="fSatuan_C" value="<?=$Satuan_C?>" /></td>
      </tr>
      <tr height="22">
        <td>Tanah yang Digunakan</td>
        <td>:</td>
        <td><input type="text" name="fTanah_C" id="fTanah_C" value="<?=$Tanah_C?>" /></td>
      </tr>
      <tr height="22">
        <td>Jangka Waktu</td>
        <td>:</td>
        <td><input type="text" name="fWaktu_C" id="fWaktu_C" value="<?=$Waktu_C?>" /></td>
      </tr>
      <tr height="22">
        <td>Tanggal, Bulan, Tahun Mulai Penggunaan</td>
        <td>:</td>
        <td>
		<select class="boxs" name="fHriMulaiC" id="fHriMulaiC" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriMulaiC) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnMulaiC" id="fBlnMulaiC" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnMulaiC) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnMulaiC" id="fThnMulaiC" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnMulaiC) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>		</td>
      </tr>
      <tr height="22">
        <td>Tanggal, Bulan, Tahun Berakhir Penggunaan</td>
        <td>:</td>
        <td>
		<select class="boxs" name="fHriAkhirC" id="fHriAkhirC" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriAkhirC) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnAkhirC" id="fBlnAkhirC" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnAkhirC) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnAkhirC" id="fThnAkhirC" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnAkhirC) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>		</td>
      </tr>
      <tr height="22">
        <td>Peruntukan</td>
        <td>:</td>
        <td><input type="text" name="fPeruntukan_C" id="fPeruntukan_C" value="<?=$Peruntukan_C?>" /></td>
      </tr>
      
      <tr height="22">
        <td style="font-weight:bold">a. Surat Persetujuan Bupati</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Nomor</li></td>
        <td>:</td>
        <td><input type="text" name="fSpBNomor_C" id="fSpBNomor_C" value="<?=$SpBNomor_C?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Tanggal</li></td>
        <td>:</td>
        <td>
		<select class="boxs" name="fHriSpBC" id="fHriSpBC" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriSpBC) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnSpBC" id="fBlnSpBC" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnSpBC) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnSpBC" id="fThnSpBC" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnSpBC) {$sel ="selected";}
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
        <td><input type="text" name="fSpNomor_C" id="fSpNomor_C" value="<?=$SpNomor_C?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Tanggal</li></td>
        <td>:</td>
        <td>
		<select class="boxs" name="fHriSpC" id="fHriSpC" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriSpC) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnSpC" id="fBlnSpC" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnSpC) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnSpC" id="fThnSpC" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnSpC) {$sel ="selected";}
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
        <td><input type="text" name="fDokLainNama_C" id="fDokLainNama_C" value="<?=$DokLainNama_C?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Nomor</li></td>
        <td>:</td>
        <td><input type="text" name="fDokLainNomor_C" id="fDokLainNomor_C" value="<?=$DokLainNomor_C?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Tanggal</li></td>
        <td>:</td>
        <td>
		<select class="boxs" name="fHriDokLainC" id="fHriDokLainC" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriDokLainC) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fBlnDokLainC" id="fBlnDokLainC" tabindex="0" style="width:90px">
		<option value="00"></option>
		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnDokLainC) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		<select class="boxs" name="fThnDokLainC" id="fThnDokLainC" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnDokLainC) {$sel ="selected";}
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
      <tr height="22">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>
		<input type="button" name="fSave" id="fSave" value="Save"    onclick="p_Save()" style="width:80px; height:20px" />
        <input type="button" name="fReff" id="fReff" value="Refresh" onclick="p_Refr()" style="width:80px; height:20px" />		</td>
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
    <td><img src="Images/Logo Litle.gif" width="20px" /></td>
    <td style="font-weight:bold; text-transform:uppercase">Penggunaan BMD untuk Dioperasikan oleh Pihak Lain (D) </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><table border="0" width="100%" cellpadding="0" cellspacing="0" style="font-size:9pt; font-family: Calibri; border-collapse:collapse">
      <?
	$nSQ = "SELECT IDT as A0,
	Tanggal as A1,
	Pengguna as A2,
	Jumlah as A3,
	Satuan as A4,
	'' as A5,
	'' as A6,
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
	SpBupatiNomor as A18,
	SpBupatiTanggal as A19,
	SpNomor as A20,
	SpTanggal as A21,
	DokLainnyaNama as A22,
	DokLainnyaNomor as A23,
	DokLainnyaTanggal as A24 
	
	FROM ta_kib_108_p47_penggunaan_d WHERE Referensi='".$Ref."' AND RefGroup='".$Grp."'";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs))
	{
		$TgL = $mRo[1];
		$TgL = explode("-",$TgL);
		$HriD = $TgL[2];
		$BlnD = $TgL[1];
		$ThnD = $TgL[0];
		
		$Pengguna_D = $mRo[2];
		$Alamat_D = $mRo[12];
		$Jumlah_D = $mRo[3];
		$Satuan_D = $mRo[4];
		$Tanah_D = $mRo[13];
		$Waktu_D = $mRo[14];
		
		$MulaiP = $mRo[15];
		$MulaiP = explode("-",$MulaiP);
		$HriMulaiD = $MulaiP[2];
		$BlnMulaiD = $MulaiP[1];
		$ThnMulaiD = $MulaiP[0];
		
		$AkhirP = $mRo[16];
		$AkhirP = explode("-",$AkhirP);
		$HriAkhirD = $AkhirP[2];
		$BlnAkhirD = $AkhirP[1];
		$ThnAkhirD = $AkhirP[0];
		
		$Peruntukan_D = $mRo[17];
		$SpBNomor_D = $mRo[18];
		$SpBT = $mRo[19];
		$SpBT = explode("-",$SpBT);
		$HriSpBD = $SpBT[2];
		$BlnSpBD = $SpBT[1];
		$ThnSpBD = $SpBT[0];
		
		$SpNomor_D = $mRo[20];
		$SP = $mRo[21];
		$SP = explode("-",$SP);
		$HriSpD = $SP[2];
		$BlnSpD = $SP[1];
		$ThnSpD = $SP[0];
		
		$DokLainNama_D=$mRo[22];
		$DokLainNomor_D=$mRo[23];
		$DokLainT = $mRo[24];
		$DokLainT = explode("-",$DokLainT);
		$HriDokLainD = $DokLainT[2];
		$BlnDokLainD = $DokLainT[1];
		$ThnDokLainD = $DokLainT[0];
		
		/*
		$Harga_D = $mRo[5];
		$NilaiAkhir_D = $mRo[6];
		$DokumenSumber_D = $mRo[7];
		
		$BastNomor_D = $mRo[8];
		$BaTgL = $mRo[9];
		$BaTgL = explode("-",$BaTgL);
		$BaHriD = $BaTgL[2];
		$BaBlnD = $BaTgL[1];
		$BaThnD = $BaTgL[0];
		
		$SkHapusNomor_D = $mRo[10];
		$SkTgL = $mRo[11];
		$SkTgL = explode("-",$SkTgL);
		$SkHriD = $SkTgL[2];
		$SkBlnD = $SkTgL[1];
		$SkThnD = $SkTgL[0];
		*/
	}
	?>
      <tr height="22">
        <td width="220">Tanggal</td>
        <td width="23">:</td>
        <td><select class="boxs" name="fHriD" id="fHriD" tabindex="0" style="width:45px">
            <option value="00"></option>
            <?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
          </select>
            <select class="boxs" name="fBlnD" id="fBlnD" tabindex="0" style="width:90px">
              <option value="00"></option>
              <?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
            </select>
            <select class="boxs" name="fThnD" id="fThnD" style="width: 60px" tabindex="0">
              <option value="0000"></option>
              <?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
            </select>        </td>
      </tr>
      <tr height="22">
        <td>Pengguna Barang Sementara</td>
        <td>:</td>
        <td><input type="text" name="fPengguna_D" id="fPengguna_D" value="<?=$Pengguna_D?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td>Alamat</td>
        <td>:</td>
        <td><input type="text" name="fAlamat_D" id="fAlamat_D" value="<?=$Alamat_D?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td>Jumlah</td>
        <td>:</td>
        <td><input type="text" name="fJumlah_D" id="fJumlah_D" value="<?=$Jumlah_D?>" /></td>
      </tr>
      <tr height="22">
        <td>Satuan Barang</td>
        <td>:</td>
        <td><input type="text" name="fSatuan_D" id="fSatuan_D" value="<?=$Satuan_D?>" /></td>
      </tr>
      <tr height="22">
        <td>Tanah yang Digunakan</td>
        <td>:</td>
        <td><input type="text" name="fTanah_D" id="fTanah_D" value="<?=$Tanah_D?>" /></td>
      </tr>
      <tr height="22">
        <td>Jangka Waktu</td>
        <td>:</td>
        <td><input type="text" name="fWaktu_D" id="fWaktu_D" value="<?=$Waktu_D?>" /></td>
      </tr>
      <tr height="22">
        <td>Tanggal, Bulan, Tahun Mulai Penggunaan</td>
        <td>:</td>
        <td><select class="boxs" name="fHriMulaiD" id="fHriMulaiD" tabindex="0" style="width:45px">
            <option value="00"></option>
            <?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriMulaiD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
          </select>
            <select class="boxs" name="fBlnMulaiD" id="fBlnMulaiD" tabindex="0" style="width:90px">
              <option value="00"></option>
              <?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnMulaiD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
            </select>
            <select class="boxs" name="fThnMulaiD" id="fThnMulaiD" style="width: 60px" tabindex="0">
              <option value="0000"></option>
              <?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnMulaiD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
            </select>        </td>
      </tr>
      <tr height="22">
        <td>Tanggal, Bulan, Tahun Berakhir Penggunaan</td>
        <td>:</td>
        <td><select class="boxs" name="fHriAkhirD" id="fHriAkhirD" tabindex="0" style="width:45px">
            <option value="00"></option>
            <?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriAkhirD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
          </select>
            <select class="boxs" name="fBlnAkhirD" id="fBlnAkhirD" tabindex="0" style="width:90px">
              <option value="00"></option>
              <?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnAkhirD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
            </select>
            <select class="boxs" name="fThnAkhirD" id="fThnAkhirD" style="width: 60px" tabindex="0">
              <option value="0000"></option>
              <?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnAkhirD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
            </select>        </td>
      </tr>
      <tr height="22">
        <td>Peruntukan</td>
        <td>:</td>
        <td><input type="text" name="fPeruntukan_D" id="fPeruntukan_D" value="<?=$Peruntukan_D?>" /></td>
      </tr>
      <tr height="22">
        <td style="font-weight:bold">a. Surat Persetujuan Bupati</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Nomor</li></td>
        <td>:</td>
        <td><input type="text" name="fSpBNomor_D" id="fSpBNomor_D" value="<?=$SpBNomor_D?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Tanggal</li></td>
        <td>:</td>
        <td><select class="boxs" name="fHriSpBD" id="fHriSpBD" tabindex="0" style="width:45px">
            <option value="00"></option>
            <?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriSpBD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
          </select>
            <select class="boxs" name="fBlnSpBD" id="fBlnSpBD" tabindex="0" style="width:90px">
              <option value="00"></option>
              <?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnSpBD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
            </select>
            <select class="boxs" name="fThnSpBD" id="fThnSpBD" style="width: 60px" tabindex="0">
              <option value="0000"></option>
              <?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnSpBD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
            </select>        </td>
      </tr>
      <tr height="22">
        <td style="font-weight:bold">b. Surat Perjanjian </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Nomor</li></td>
        <td>:</td>
        <td><input type="text" name="fSpNomor_D" id="fSpNomor_D" value="<?=$SpNomor_D?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Tanggal</li></td>
        <td>:</td>
        <td><select class="boxs" name="fHriSpD" id="fHriSpD" tabindex="0" style="width:45px">
            <option value="00"></option>
            <?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriSpD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
          </select>
            <select class="boxs" name="fBlnSpD" id="fBlnSpD" tabindex="0" style="width:90px">
              <option value="00"></option>
              <?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnSpD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
            </select>
            <select class="boxs" name="fThnSpD" id="fThnSpD" style="width: 60px" tabindex="0">
              <option value="0000"></option>
              <?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnSpD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
            </select>        </td>
      </tr>
      <tr height="22">
        <td style="font-weight:bold">c. Dokumen Pendukung Lainnya </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Nama Dokumen Pendukung Lainnya</li></td>
        <td>:</td>
        <td><input type="text" name="fDokLainNama_D" id="fDokLainNama_D" value="<?=$DokLainNama_D?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Nomor</li></td>
        <td>:</td>
        <td><input type="text" name="fDokLainNomor_D" id="fDokLainNomor_D" value="<?=$DokLainNomor_D?>" style="width:300px" /></td>
      </tr>
      <tr height="22">
        <td style="padding-left:25px"><li>Tanggal</li></td>
        <td>:</td>
        <td><select class="boxs" name="fHriDokLainD" id="fHriDokLainD" tabindex="0" style="width:45px">
            <option value="00"></option>
            <?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$HriDokLainD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
          </select>
            <select class="boxs" name="fBlnDokLainD" id="fBlnDokLainD" tabindex="0" style="width:90px">
              <option value="00"></option>
              <?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$BlnDokLainD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
            </select>
            <select class="boxs" name="fThnDokLainD" id="fThnDokLainD" style="width: 60px" tabindex="0">
              <option value="0000"></option>
              <?
		for($nThn=2020; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$ThnDokLainD) {$sel ="selected";}
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
        <input type="button" name="fReff" id="fReff" value="Refresh" onclick="p_Refr()" style="width:80px; height:20px" />
		</td>
      </tr>
	</table>
	</td>
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