<?php
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');
extract($_GET);

$DtA = fGlobal("Referensi:Kd_Unit","ta_penerimaan_non_apbd","IDT",$IdT,"=","","");	
$DtA = explode(':',$DtA);
$RefNO = $DtA[0];
$gUNTR = $DtA[1];

#echo $IdT."<br>";
#echo $IdTA."<br>";
if ($IdTA=='')
{
	$IdTA = fGlobal("IDT","ta_kib_108_temp","no_pengadaan",$RefNO,"=","","");
}
if ($IdTA!='')
{
	$nSQ = "SELECT 
	Kd_UPB as A0,
	Kd_Aset_108 as A1,
	Nm_Aset_108 as A2,
	Nm_Aset_108_Spesifikasi as A3,
	No_Register as A4,
	Kd_Pemilik as A5,
	Luas_M2 as A6,
	Alamat as A7,
	Hak_Tanah as A8,
	Penggunaan as A9,
	Asal_Usul as A10,
	Harga as A11,
	Keterangan as A12,
	Jumlah_Bidang as A13,
	Nilai_Pengadaan as A14,
	Harga_Satuan as A15,
	Merk as A16,
	Type as A17,
	Ukuran_CC as A18,
	Bahan as A19,
	Nomor_Pabrik as A20,
	Nomor_Rangka as A21,
	Nomor_Mesin as A22,
	Nomor_Polisi as A23,
	Nomor_BPKB as A24,
	Kondisi as A25,
	Masa_Manfaat as A26,
	Jumlah_Unit as A27,
	Bertingkat as A28,
	Beton as A29,
	Luas_Lantai as A30,
	Lokasi as A31,
	Konstruksi as A32,
	Panjang as A33,
	Lebar as A34,
	Luas as A35,
	Jumlah_Ruas as A36,
	Judul as A37,
	Spesifikasi as A38,
	Pencipta as A39,
	Daerah_Asal as A40,
	Jenis as A41,
	Ukuran as A42,
	Tahun as A43,
	Recorded as A44,
	Pencatat as A45,
	Sertifikat as A46,
	Sertifikat_Nomor as A47,
	Sertifikat_Tanggal as A48,
	Dokumen_Nomor as A49,
	Dokumen_Tanggal as A50,
	
	Kode_Tanah as A51,
	Status_Tanah as A52,
	Luas_Tanah as A53,
	Batas_Utara as A54,
	Batas_Selatan as A55,
	Batas_Timur as A56,
	Batas_Barat as A57 
	
	FROM ta_kib_108_temp WHERE IDT = '".$IdTA."'";
	$nRs = mysql_query($nSQ);
	$mRo = mysql_fetch_array($nRs);
	
	$gUNTR = substr($mRo[0],0,11);
	$gSUB  = substr($mRo[0],0,14);
	$gUPB  = $mRo[0];
	
	$gREK3 = substr($mRo[1],0,5);
	$gREK4 = substr($mRo[1],0,8);
	$gREK5 = substr($mRo[1],0,11);
	$gREK6 = substr($mRo[1],0,14);
	$gREK7 = $mRo[1];
	
	$dREK3 = fGlobal("Nm_Aset","ref_rek_aset108_3","Kd_Aset",$gREK3,"=","","");
	$dREK4 = fGlobal("Nm_Aset","ref_rek_aset108_4","Kd_Aset",$gREK4,"=","","");
	$dREK5 = fGlobal("Nm_Aset","ref_rek_aset108_5","Kd_Aset",$gREK5,"=","","");
	$dREK6 = fGlobal("Nm_Aset","ref_rek_aset108_6","Kd_Aset",$gREK6,"=","","");
	$dREK7 = fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$gREK7,"=","","");
	
	$fNmaSP = $mRo[3];
	$fNoRG  = $mRo[4];
	$fMerk  = $mRo[16];
	$fType  = $mRo[17];
	$fNoPB  = $mRo[20];
	$fNoRK  = $mRo[21];
	$fNoMS  = $mRo[22];
	$fNoPL  = $mRo[23];
	$fNoBP  = $mRo[24];
	
	$fAlam  = $mRo[7];
	$fJudu  = $mRo[37];
	$fSpec  = $mRo[38];
	$fCipt  = $mRo[39];
	$fBaha  = $mRo[19];
	$fTahu  = $mRo[43];
	$fB1T   = $mRo[28];
	$fB1B   = $mRo[29];
	
	$fPanj  = $mRo[33];
	$fLeba  = $mRo[34];
	$fLuas  = $mRo[35];
	$fLuasL = $mRo[30];
	
	$fB1C   = $mRo[46];
	$fSrNom = $mRo[47];
	$fSrTgl = $mRo[48];
	if ($fSrTgl==''){$fSrTgl = "0000-00-00";}
	
	$fDoNom = $mRo[49];
	$fDoTgl = $mRo[50];
	if ($fDoTgl==''){$fDoTgl = "0000-00-00";}
	
	$fGuna = $mRo[9];
	$fKdTnh  = $mRo[51];
	$fStTnh  = $mRo[52];
	$fLuTnh  = $mRo[53];
	$fHkTnh  = $mRo[8];
	$fLtTnh  = $mRo[31];
	$fLtTnhU = $mRo[54];
	$fLtTnhS = $mRo[55];
	$fLtTnhT = $mRo[56];
	$fLtTnhB = $mRo[57];
	$fMemo  = $mRo[12];
}

$dUNTR = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNTR,"=","","");
if ($gSUB!='') {$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");}
if ($gUPB!='') {$dUPB = fGlobal("Nm_Upb","ref_upb","Kd_Upb",$gUPB,"=","","");}

$fB1Ta=""; $fB1Tb="";
if ($fB1T=='Bertingkat')
{
	$fB1Ta="checked";
}
else
{
	$fB1Tb="checked";
}

$fB1Ba=""; $fB1Bb="";
if ($fB1B=='Beton')
{
	$fB1Ba="checked";
}
else
{
	$fB1Bb="checked";
}

$fB1Ca=""; $fB1Cb="";
if ($fB1C=='Ada')
{
	$fB1Ca="checked";
}
else
{
	$fB1Cb="checked";
}

?>
<table align="center" border="0" width="1000" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-family:calibri; font-size:10pt">
  <tr>
    <td width="88">&nbsp;</td>
    <td width="132">&nbsp;</td>
    <td width="24">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="187">&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Unit</td>
    <td>:</td>
    <td colspan="2">
	<input name="fUNTR" id="fUNTR" type="text" value="<?=$gUNTR?>" readonly style="padding-left:3px; width:105px"/>
	<input name="dUNTR" id="dUNTR" type="text" value="<?=$dUNTR?>" readonly style="padding-left:3px; width:400px"/>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Sub Unit </td>
    <td>:</td>
    <td colspan="2">
	<input name="fSUB" id="fSUB" type="text" value="<?=$gSUB?>" readonly style="padding-left:3px; width:105px"/>
	<input name="dSUB" id="dSUB" type="text" value="<?=$dSUB?>" onClick="showSUB('','<?=$_GET['IdL']?>')" style="padding-left:3px; width:400px"/>
	<div id="subMstCri" class="Unit0Cri">
		<div id="subDiv1Cri" class="Unit1Cri"></div>
		<div id="subDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>UPB</td>
    <td>:</td>
    <td colspan="2">
	<input name="fUPB" id="fUPB" type="text" value="<?=$gUPB?>" readonly style="padding-left:3px; width:105px"/>
	<input name="dUPB" id="dUPB" type="text" value="<?=$dUPB?>" onClick="showUPB('','<?=$_GET['IdL']?>')" style="padding-left:3px; width:400px"/>
	<div id="upbMstCri" class="Unit0Cri">
		<div id="upbDiv1Cri" class="Unit1Cri"></div>
		<div id="upbDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Jenis</td>
    <td>:</td>
    <td colspan="2">
	<input name="fREK3" id="fREK3" type="text" value="<?=$gREK3?>" readonly style="padding-left:3px; width:105px"/>
	<input name="dREK3" id="dREK3" type="text" value="<?=$dREK3?>" readonly onClick="showREKN3('','<?=$_GET['IdL']?>')" style="padding-left:3px; width:400px"/>
	<div id="rekn3MstCri" class="Unit0Cri">
		<div id="rekn3Div1Cri" class="Unit1Cri"></div>
		<div id="rekn3Div2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Objek</td>
    <td>:</td>
    <td colspan="2">
	<input name="fREK4" id="fREK4" type="text" value="<?=$gREK4?>" readonly style="padding-left:3px; width:105px"/>
	<input name="dREK4" id="dREK4" type="text" value="<?=$dREK4?>" readonly onClick="showREKN4('','<?=$_GET['IdL']?>')" style="padding-left:3px; width:400px"/>
	<div id="rekn4MstCri" class="Unit0Cri">
		<div id="rekn4Div1Cri" class="Unit1Cri"></div>
		<div id="rekn4Div2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Rincian Objek </td>
    <td>:</td>
    <td colspan="2">
	<input name="fREK5" id="fREK5" type="text" value="<?=$gREK5?>" readonly style="padding-left:3px; width:105px"/>
	<input name="dREK5" id="dREK5" type="text" value="<?=$dREK5?>" readonly onClick="showREKN5('','<?=$_GET['IdL']?>')" style="padding-left:3px; width:400px"/>
	<div id="rekn5MstCri" class="Unit0Cri">
		<div id="rekn5Div1Cri" class="Unit1Cri"></div>
		<div id="rekn5Div2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Sub ROBJ </td>
    <td>:</td>
    <td colspan="2">
	<input name="fREK6" id="fREK6" type="text" value="<?=$gREK6?>" readonly style="padding-left:3px; width:105px"/>
	<input name="dREK6" id="dREK6" type="text" value="<?=$dREK6?>" readonly onClick="showREKN6('','<?=$_GET['IdL']?>')" style="padding-left:3px; width:400px"/>
	<div id="rekn6MstCri" class="Unit0Cri">
		<div id="rekn6Div1Cri" class="Unit1Cri"></div>
		<div id="rekn6Div2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Sub Sub ROBJ</td>
    <td>:</td>
    <td colspan="2">
	<input name="fREK7" id="fREK7" type="text" value="<?=$gREK7?>" readonly style="padding-left:3px; width:105px"/>
	<input name="dREK7" id="dREK7" type="text" value="<?=$dREK7?>" readonly onClick="showREKN7('','','<?=$_GET['IdL']?>')" style="padding-left:3px; width:370px"/>
	<input type="button" name="BtnGO" id="BtnGO" value="..." onclick="showREKN7('','YA','<?=$_GET['IdL']?>')" style="width:26px; height:21px" />
	<div id="rekn7MstCri" class="Unit0Cri">
		<div id="rekn7Div1Cri" class="Unit1Cri"></div>
		<div id="rekn7Div2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Register</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fNoRG" id="fNoRG" value="<?=$fNoRG?>" style="width:100px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Nama Barang </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fNmaSP" id="fNmaSP" value="<?=$fNmaSP?>" style="width:350px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr height="24">
    <td>&nbsp;</td>
    <td>Merk</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fMerk" id="fMerk" value="<?=$fMerk?>" style="width:350px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Type</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fType" id="fType" value="<?=$fType?>" style="width:350px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr height="24">
    <td>&nbsp;</td>
    <td>Nomor Pabrik </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fNoPB" id="fNoPB" value="<?=$fNoPB?>" style="width:350px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Nomor Rangka </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fNoRK" id="fNoRK" value="<?=$fNoRK?>" style="width:350px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Nomor Mesin </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fNoMS" id="fNoMS" value="<?=$fNoMS?>" style="width:350px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Nomor BPKB </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fNoBP" id="fNoBP" value="<?=$fNoBP?>" style="width:350px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Nomor Polisi </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fNoPL" id="fNoPL" value="<?=$fNoPL?>" style="width:350px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr height="24">
    <td>&nbsp;</td>
    <td> Alamat</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fAlam" id="fAlam" value="<?=$fAlam?>" style="width:350px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Judul</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fJudu" id="fJudu" value="<?=$fJudu?>" style="width:350px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Pencipta</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fCipt" id="fCipt" value="<?=$fCipt?>" style="width:350px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Spesifikasi</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fSpec" id="fSpec" value="<?=$fSpec?>" style="width:350px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Bahan</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fBaha" id="fBaha" value="<?=$fBaha?>" style="width:350px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Tahun Cetak </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fTahu" id="fTahu" value="<?=$fTahu?>" style="width:40px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr height="24">
    <td>&nbsp;</td>
    <td>Konstruksi</td>
    <td>:</td>
    <td colspan="2">
	<label><input name="fB1T" id="fB1T" <?=$fB1Ta?> type="radio" value="Bertingkat" />Bertingkat</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label><input name="fB1T" id="fB1T" <?=$fB1Tb?> type="radio" value="Tidak" />Tidak</label>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>:</td>
    <td colspan="2">
	<label><input name="fB1B" id="fB1B" <?=$fB1Ba?> type="radio" value="Beton" />Beton</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label><input name="fB1B" id="fB1B" <?=$fB1Bb?> type="radio" value="Tidak" />Tidak</label>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Panjang</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fPanj" id="fPanj" value="<?=$fPanj?>" style="width:80px; background:#fff" /> (m)</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Lebar</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fLeba" id="fLeba" value="<?=$fLeba?>" style="width:80px; background:#fff" /> (m)</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Luas</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fLuas" id="fLuas" value="<?=$fLuas?>" style="width:80px; background:#fff" /> (m<sup>2</sup>)</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Luas Lantai </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fLuasL" id="fLuasL" value="<?=$fLuasL?>" style="width:80px; background:#fff" /> (m<sup>2</sup>)</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Sertifikat</td>
    <td>:</td>
    <td colspan="2">
	<label><input name="fB1C" id="fB1C" <?=$fB1Ca?> type="radio" value="Ada" />Ada</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label><input name="fB1C" id="fB1C" <?=$fB1Cb?> type="radio" value="Tidak Ada" />Tidak Ada</label>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:0px">&nbsp;</td>
    <td>&nbsp;</td>
    <td>Nomor</td>
    <td><input type="text" name="fSrNom" id="fSrNom" value="<?=$fSrNom?>" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:0px">&nbsp;</td>
    <td>&nbsp;</td>
    <td>Tanggal</td>
    <td><input type="text" name="fSrTgl" id="fSrTgl" value="<?=$fSrTgl?>" style="width:80px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr height="24">
    <td>&nbsp;</td>
    <td>Dokumen</td>
    <td>:</td>
    <td>Nomor</td>
    <td><input type="text" name="fDoNom" id="fDoNom" value="<?=$fDoNom?>" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Tanggal</td>
    <td><input type="text" name="fDoTgl" id="fDoTgl" value="<?=$fDoTgl?>" style="width:80px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Dipergunaan Untuk </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fGuna" id="fGuna" value="<?=$fGuna?>" style="width:311px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Kode Tanah </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fKdTnh" id="fKdTnh" value="<?=$fKdTnh?>" style="width:311px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Status Tanah </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fStTnh" id="fStTnh" value="<?=$fStTnh?>" style="width:311px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Luas Tanah </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fLuTnh" id="fLuTnh" value="<?=$fLuTnh?>" style="width:80px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Hak Tanah </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fHkTnh" id="fHkTnh" value="<?=$fHkTnh?>" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Letak Tanah </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fLtTnh" id="fLtTnh" value="<?=$fLtTnh?>" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Batas Tanah </td>
    <td>:</td>
    <td width="71">Utara</td>
    <td width="498"><input type="text" name="fLtTnhU" id="fLtTnhU" value="<?=$fLtTnhU?>" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Selatan</td>
    <td><input type="text" name="fLtTnhS" id="fLtTnhS" value="<?=$fLtTnhS?>" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Timur</td>
    <td><input type="text" name="fLtTnhT" id="fLtTnhT" value="<?=$fLtTnhT?>" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Barat</td>
    <td><input type="text" name="fLtTnhB" id="fLtTnhB" value="<?=$fLtTnhB?>" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr height="24">
    <td>&nbsp;</td>
    <td>Keterangan</td>
    <td>:</td>
    <td colspan="2" rowspan="3"><textarea style="width:311px; height:50px" name="fMemo" id="fMemo"><?=$fMemo?></textarea></td>
    <td></td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td></td>
  </tr>
  
  <tr height="24">
    <td>&nbsp;</td>
    <td>Satuan Barang </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fSatBR" id="fSatBR" value="<?=$fSatBR?>" readonly style="width:123px; background:#ccc" />&nbsp;(buah, unit, dll)</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Jumlah Barang </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fJmlBR" id="fJmlBR" value="<?=$fJmlBR?>" readonly style="width:40px; background:#ccc" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Harga Satuan (Rp) </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fHrgBR" id="fHrgBR" value="<?=$fHrgBR?>" readonly style="width:123px; background:#ccc" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Nilai Total (Rp) </td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fTotBR" id="fTotBR" value="<?=$fTotBR?>" readonly style="width:123px; background:#ccc" /></td>
    <td></td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">
	<input type="button" name="BtnSave" id="BtnSave" value="Save" onclick="saveDataAset('<?=$ReO?>','<?=$JnsNon?>','<?=$IdT?>','<?=$IdTA?>','<?=$IdL?>')" style="width:80px; height:21px" />
	<!--input type="button" name="BtnRese" id="BtnRese" value="Reset" onclick="formAddAset('','<?=$ReO?>','<?=$JnsNon?>','<?=$IdT?>','','<?=$IdL?>')" style="width:80px; height:21px" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
	<input type="button" name="BtnRese" id="BtnRese" value="Posting Ke Aset" onclick="formPosting('','<?=$ReO?>','<?=$JnsNon?>','<?=$IdT?>','','<?=$IdL?>')" style="width:120px; height:21px" />	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
