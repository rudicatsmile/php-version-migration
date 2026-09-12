<?
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');
extract($_GET);

$fRef = "XXXXX/NONAPBD/".$UnT."/".$ThN;

$TgL   = date('d/m/Y');
$TgKo  = date('00/00/0000');
$TgBA  = date('00/00/0000');
$DokTg = date('00/00/0000');
$DokPTg= date('00/00/0000');

if ($IdT!='')
{	
	$DtA = fGlobal("Referensi:Tanggal:JenisNonApbd:Kd_Unit:Sumber_Dana:Id_Rekanan:Nm_Kontrak:No_Kontrak:Tg_Kontrak:No_BAST:Tg_BAST:Dokumen_Nama:Dokumen_Nomor:Dokumen_Tanggal:No_BAHI:Tg_BAHI:DokPendukung_Nama:DokPendukung_Nomor:DokPendukung_Tanggal:Dasar_Hukum:Penyebab_Perolehan:Memo:JumlahBarang:SatuanBarang:HargaSatuan:TotalNilai:Recorded:Pencatat","ta_penerimaan_non_apbd","IdT",$IdT,"=","","");	
	$DtA = explode(':',$DtA);
	$fRef   = $DtA[0]; #
	$TgL    = $DtA[1];
	$JnsN   = $DtA[2];
	$KdUn   = $DtA[3];
	$Sumb   = $DtA[4];
	$IdRe   = $DtA[5];
	$NmKo   = $DtA[6];
	$NoKo   = $DtA[7];
	$TgKo   = $DtA[8]; #
	$NoBA   = $DtA[9];
	$TgBA   = $DtA[10]; #
	$DokNm  = $DtA[11];
	$DokNo  = $DtA[12];
	$DokTg  = $DtA[13]; #
	$NoBH   = $DtA[14];
	$TgBH   = $DtA[15]; #
	$DokPNm = $DtA[16];
	$DokPNo = $DtA[17];
	$DokPTg = $DtA[18]; #
	$DsrHuk = $DtA[19];
	$PybbP  = $DtA[20];
	$Memo   = $DtA[21];
	$JmlBr  = $DtA[22];
	$StnBr  = $DtA[23];
	$HrgSt  = $DtA[24];
	$HrgBt  = $DtA[25];
	$Rcrdd  = $DtA[26];
	$Pnctt  = $DtA[27];
	
	$TgL = fConvertDateShort($TgL);
	$TgBA = fConvertDateShort($TgBA);
	$DokPTg = fConvertDateShort($DokPTg);
	
	$IdTA = fGlobal("IDT","ta_kib_108_temp","no_pengadaan",$fRef,"=","","");
}

$NmaP  = fGlobal("Full_Name","ta_user","User_ID",$Pnctt,"=","","");
$NipP  = "-";
$ReC   = fConvertDateShort(substr($Rcrdd,0,10))." ".substr($Rcrdd,-8,8);

$fB1a="";
$fB1b="";
$fB1c="";
if ($Sumb=="Sumbangan")
{
	$fB1b="checked";
}
else if ($Sumb=="Lainnya")
{
	$fB1c="checked";
}
else
{
	$fB1a="checked";
}

?>
<table align="center" border="0" width="1000" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-family:calibri; font-size:10pt">
  <tr>
    <td width="165">&nbsp;</td>
    <td width="25">&nbsp;</td>
    <td width="25">&nbsp;</td>
    <td width="140">&nbsp;</td>
    <td width="20">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:13px"><li>&nbsp;</td>
    <td colspan="2">Referensi</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fRef" id="fRef" value="<?=$fRef?>" readonly style="width:240px; background:#e2fae2" /></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr height="35" style="font-weight:bold">
    <td>&nbsp;</td>
    <td>1.</td>
    <td colspan="5">Informasi Pencatatan Perolehan/Penerimaan</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>a.</td>
    <td>Sumber Dana</td>
    <td>:</td>
    <td colspan="2">
	<label><input name="fRadB" id="fRadB" <?=$fB1a?> type="radio" value="Hibah"/>Hibah</label>&nbsp;&nbsp;
	<label><input name="fRadB" id="fRadB" <?=$fB1b?> type="radio" value="Sumbangan"/>Sumbangan</label>&nbsp;&nbsp;
	<label><input name="fRadB" id="fRadB" <?=$fB1c?> type="radio" value="Lainnya"/>Lainnya</label>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>b.</td>
    <td>Pihak Pemberi Hibah</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fPiHA" id="fPiHA" value="<?=$IdRe?>" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>c.</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fTgL" id="fTgL" value="<?=$TgL?>" style="width:90px; text-align:center" />&nbsp;&nbsp;(tgl/bln/thn)</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>d.</td>
    <td>Perolehan/penerimaan</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="padding-left:13px"><li>Jumlah Barang</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fJmLB" id="fJmLB" value="<?=$JmlBr?>" style="width:40px; background:#fff; text-align:center" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="padding-left:13px"><li>Satuan Barang</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fSaTB" id="fSaTB" value="<?=$StnBr?>" style="width:100px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="padding-left:13px"><li>Harga Satuan (Rp)</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fHrGB" id="fHrGB" value="<?=fConvertToRupiah($HrgSt)?>" style="width:100px; background:#fff; text-align:right; padding-right:3px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="padding-left:13px"><li>Total Nilai (Rp)</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fHrGT" id="fHrGT"  readonly value="<?=fConvertToRupiah($HrgBt)?>" style="width:100px; background:#e2fae2; text-align:right; padding-right:3px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="50" style="font-weight:bold">
    <td>&nbsp;</td>
    <td>2.</td>
    <td colspan="5">Dokumen Sumber Perolehan/Penerimaan<br>Berita Acara Serah Terima Hibah/sumbangan atau yang sejenis</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:13px"><li>Nomor</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fNoBA" id="fNoBA" value="<?=$NoBA?>" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:13px"><li>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fTgBA" id="fTgBA" value="<?=$TgBA?>" style="width:90px; text-align:center" />&nbsp;&nbsp;(tgl/bln/thn)</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24" style="font-weight:bold">
    <td>&nbsp;</td>
    <td>3.</td>
    <td colspan="5">Dokumen Pendukung Lainnya</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:13px"><li>Nama Dokumen</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fDokPNm" id="fDokPNm" value="<?=$DokPNm?>" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:13px"><li>Nomor</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fDokPNo" id="fDokPNo" value="<?=$DokPNo?>" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:13px"><li>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fDokPTg" id="fDokPTg" value="<?=$DokPTg?>" style="width:90px; text-align:center" />&nbsp;&nbsp;(tgl/bln/thn)</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:13px"><li></td>
    <td colspan="2">Diinput oleh</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fUID" id="fUID" value="<?=$UID?>" readonly style="width:240px; background:#e2fae2" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Nama</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fKt1221688" id="fKt1221688" value="<?=$NmaP?>" readonly style="width:240px; background:#e2fae2" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">NIP</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fKt1221689" id="fKt1221689" value="<?=$NipP?>" readonly style="width:240px; background:#e2fae2" /></td>
    <td><a href="#" onClick="formCetakDok('Format_II_A_12','<?=$IdT?>','800','400','<?=$IdL?>'); return false" class="ico docu">&nbsp;&nbsp;Format II.A.12</a></td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Recorded</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="fKt12216810" id="fKt12216810" value="<?=$NmaP?>" readonly style="width:240px; background:#e2fae2" /></td>
    <td><a href="#" onClick="<? if ($IdT==''){ ?> alert('Error choice...!!'); return false; <? } else {?>formAddAset('','<?=$ReO?>','<?=$JnsNon?>','<?=$IdT?>','<?=$IdTA?>','<?=$IdL?>'); return false;<? } ?>" class="ico add">&nbsp;&nbsp;Form ASET</a></td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5">
	<input type="button" name="BtnSave" id="BtnSave" value="Save" onclick="saveDATA('<?=$ReO?>','<?=$JnsNon?>','<?=$IdT?>','<?=$IdL?>')" style="width:80px; height:21px" />
	<input type="button" name="BtnRese" id="BtnRese" value="Reset" onclick="formAddItem('reset','<?=$ReO?>','<?=$JnsNon?>','','<?=$IdL?>')" style="width:80px; height:21px" />	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
