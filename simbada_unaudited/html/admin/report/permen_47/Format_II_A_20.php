<?
require('../../Connection.php');
require('../../FileFunction.php');
require("../../CheckLogin.php");
extract($_GET);

$DtA = fGlobal("Referensi:Tanggal:JenisNonApbd:Kd_Unit:Sumber_Dana:Id_Rekanan:Nm_Kontrak:No_Kontrak:Tg_Kontrak:No_BAST:Tg_BAST:Dokumen_Nama:Dokumen_Nomor:Dokumen_Tanggal:No_BAHI:Tg_BAHI:DokPendukung_Nama:DokPendukung_Nomor:DokPendukung_Tanggal:Dasar_Hukum:Penyebab_Perolehan:Memo:JumlahBarang:SatuanBarang:HargaSatuan:TotalNilai:Pencatat","ta_penerimaan_non_apbd","IdT",$IdT,"=","","");	
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
$Pnctt  = $DtA[26];

$ThN   = substr($TgL,0,4);
$NmSkP = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$KdUn,"=","","");	
$PcM   = fGlobal("Full_Name","ta_user","User_ID",$Pnctt,"=","","");
$NipP  = "-";
$Rcrdd = fGlobal("Recorded","ta_penerimaan_non_apbd","IdT",$IdT,"=","","");	
$ReC   = fConvertDateShort(substr($Rcrdd,0,10))." ".substr($Rcrdd,-8,8);

$TgL    = fConvertDateShort($TgL);
$TgBA   = fConvertDateShort($TgBA);
$TgKo   = fConvertDateShort($TgKo);
$DokTg  = fConvertDateShort($DokTg);
$DokPTg = fConvertDateShort($DokPTg);

?>
<body>
<table border="0" width="670" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td width="567"></td>
    <td width="131" style="text-align:right; font-size:10pt">Format II.A.20</td>
  </tr>
</table>
<table border="0" width="670" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">FORMULIR CARA PEROLEHAN / PENERIMAAN BMD </td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">PEROLEHAN/PENERIMAAN LAINNYA</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri"> PENGGUNA BARANG</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri"><?=$NmSkP?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">PEMERINTAH <?=strtoupper($TiDaer." ".$NmDaer)?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">TAHUN <?=substr($ThN,0,4)?></td>
  </tr>
  <tr>
    <td>
	<table align="center" border="0" width="670" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-family:calibri; font-size:10pt">
      <tr>
        <td width="59">&nbsp;</td>
        <td width="32">&nbsp;</td>
        <td width="28">&nbsp;</td>
        <td width="200">&nbsp;</td>
        <td width="23">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr height="35" style="font-weight:bold">
        <td>&nbsp;</td>
        <td>1.</td>
        <td colspan="5">Informasi Pencatatan Perolehan/Penerimaan</td>
      </tr>
      
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>a.</td>
        <td>Penyebab Perolehan/Penerimaan</td>
        <td>:</td>
        <td colspan="2"><?=$IdRe?></td>
        </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>b.</td>
        <td>Tanggal, Bulan, Tahun</td>
        <td>:</td>
        <td colspan="2"><?=$TgL?></td>
        </tr>
      <tr height="24">

        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>c.</td>
        <td>Perolehan/penerimaan</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><li>Jumlah Barang</td>
        <td>:</td>
        <td colspan="2"><?=$JmlBr?></td>
        </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><li>Satuan Barang</td>
        <td>:</td>
        <td colspan="2"><?=$StnBr?></td>
        </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><li>Harga Satuan (Rp)</td>
        <td>:</td>
        <td colspan="2"><?=fConvertToRupiah($HrgSt)?></td>
        </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><li>Total Nilai (Rp)</td>
        <td>:</td>
        <td colspan="2"><?=fConvertToRupiah($HrgBt)?></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        </tr>
      <tr style="font-weight:bold">
        <td>&nbsp;</td>
        <td>2.</td>
        <td colspan="5">Dokumen Sumber Perolehan/Penerimaan</td>
      </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>a.</td>
        <td>Dasar Pembatalan Penghapusan</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><li>Nama Dokumen</td>
        <td>:</td>
        <td colspan="2"><?=$DokNm?></td>
      </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><li>Nomor</td>
        <td>:</td>
        <td colspan="2"><?=$DokNo?></td>
        </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><li>Tanggal, Bulan, Tahun</td>
        <td>:</td>
        <td colspan="2"><?=$DokTg?></td>
      </tr>
      
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr height="24" style="font-weight:bold">
        <td>&nbsp;</td>
        <td>3.</td>
        <td colspan="5">Dokumen Pendukung Lainnya</td>
        </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2"><li>Nama Dokumen</td>
        <td>:</td>
        <td colspan="2"><?=$DokPNm?></td>
        </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2"><li>Nomor</td>
        <td>:</td>
        <td colspan="2"><?=$DokPNo?></td>
        </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2"><li>Tanggal, Bulan, Tahun</td>
        <td>:</td>
        <td colspan="2"><?=$DokPTg?></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td><li></td>
        <td colspan="2">Diinput oleh</td>
        <td>:</td>
        <td colspan="2"><?=$Pnctt?></td>
        </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">Nama</td>
        <td>:</td>
        <td colspan="2"><?=$PcM?></td>
        </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">NIP</td>
        <td>:</td>
        <td colspan="2"><?=$NipP?></td>
        </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">Tanggal, Bulan, Tahun Transaksi</td>
        <td>:</td>
        <td colspan="2"><?=$ReC?></td>
        </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        </tr>
      <tr height="24">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
