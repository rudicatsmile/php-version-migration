<?php
require('../../Connection.php');
require('../../FileFunction.php');
require("../../CheckLogin.php");
extract($_GET);

$nSQ = "SELECT 
P1.Nomor as A0, 
P1.Kd_Unit as A1, 
P1.Tanggal as A2,
P1.Pencatat as A3,
P1.Recorded as A4,
P1.Kd_SubKegiatan as A5,
P1.Nm_SubKegiatan as A6,
P1.Kd_Rek13 as A7,
P1.Nm_Rek13 as A8,
P2.No_Kontrak as A9,
P2.Tg_Kontrak as A10,
P2.No_Berita_Acara as A11,
P2.Tg_Berita_Acara as A12 

FROM ta_pengadaan P1 
LEFT JOIN ta_penerimaan_berkas P2 ON P2.Nomor=P1.No_Berkas 
WHERE P1.IDT ='".$IdT."'";
$nRs = mysql_query($nSQ) or die(mysql_error());
$mRo = mysql_fetch_array($nRs, MYSQL_BOTH);
$NoM = $mRo[0];
$KdU = $mRo[1];
$ThN = $mRo[2];
$PcT = $mRo[3];
$Jns = substr($mRo[7],0,3);
$nKon = $mRo[9];
$tKon = $mRo[10];
$nBas = $mRo[11];
$tBas = $mRo[12];

$KdSub = array();
$NmSub = array();
$KdRek = array();
$NmRek = array();
$JmBar = array();
$StBar = array();
$HrBar = array();
$ToNil = array();

$BasT = array();

$KdSub[1] = "-";
$NmSub[1] = "-";
$KdRek[1] = "-";
$NmRek[1] = "-";
$ToNil[1] = "-";
$JmBar[1] = "-";
$StBar[1] = "-";
$HrBar[1] = "-";
$NBasT[1] = "-";
$TBasT[1] = "-";
$NKonT[1] = "-";
$TKonT[1] = "-";
$NBasT[1] = "-";
$TBasT[1] = "-";
$PKonT[1] = "-";
$NKonT[1] = "-";
$TKonT[1] = "-";
$PKuiT[1] = "-";
$NKuiT[1] = "-";
$TKuiT[1] = "-";
$PSpkT[1] = "-";
$NSpkT[1] = "-";
$TSpkT[1] = "-";
$PSPrT[1] = "-";
$NSPrT[1] = "-";
$TSPrT[1] = "-";
$PSPsT[1] = "-";
$NSPsT[1] = "-";
$TSPsT[1] = "-";

$NLaiT[1] = "-";
$TLaiT[1] = "-";
$TLaiN[1] = "-";

$KdSub[2] = "-";
$NmSub[2] = "-";
$KdRek[2] = "-";
$NmRek[2] = "-";
$ToNil[2] = "-";
$JmBar[2] = "-";
$StBar[2] = "-";
$HrBar[2] = "-";
$NBasT[2] = "-";
$TBasT[2] = "-";
$NKonT[2] = "-";
$TKonT[2] = "-";
$NBasT[2] = "-";
$TBasT[2] = "-";
$PKonT[2] = "-";
$NKonT[2] = "-";
$TKonT[2] = "-";
$PKuiT[2] = "-";
$NKuiT[2] = "-";
$TKuiT[2] = "-";
$PSpkT[2] = "-";
$NSpkT[2] = "-";
$TSpkT[2] = "-";
$PSPrT[2] = "-";
$NSPrT[2] = "-";
$TSPrT[2] = "-";
$PSPsT[2] = "-";
$NSPsT[2] = "-";
$TSPsT[2] = "-";

$NLaiT[2] = "-";
$TLaiT[2] = "-";
$TLaiN[2] = "-";

$KdSub[3] = "-";
$NmSub[3] = "-";
$KdRek[3] = "-";
$NmRek[3] = "-";
$ToNil[3] = "-";
$JmBar[3] = "-";
$StBar[3] = "-";
$HrBar[3] = "-";
$NBasT[3] = "-";
$TBasT[3] = "-";
$NKonT[3] = "-";
$TKonT[3] = "-";
$NBasT[3] = "-";
$TBasT[3] = "-";
$PKonT[3] = "-";
$NKonT[3] = "-";
$TKonT[3] = "-";
$PKuiT[3] = "-";
$NKuiT[3] = "-";
$TKuiT[3] = "-";
$PSpkT[3] = "-";
$NSpkT[3] = "-";
$TSpkT[3] = "-";
$PSPrT[3] = "-";
$NSPrT[3] = "-";
$TSPrT[3] = "-";
$PSPsT[3] = "-";
$NSPsT[3] = "-";
$TSPsT[3] = "-";
$NLaiT[3] = "-";
$TLaiT[3] = "-";
$TLaiN[3] = "-";

$ToNi = fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","no_pengadaan",$NoM,"=","","");
$JmBr = fGlobal("count(*)","ta_kib_108","no_pengadaan",$NoM,"=","","");

if ($Jns=='5.2')
{
	$KdSub[1] = $mRo[5];
	$NmSub[1] = $mRo[6];
	$KdRek[1] = $mRo[7];
	$NmRek[1] = $mRo[8];
	$ToNil[1] = fConvertToRupiahBulat($ToNi);
	$JmBar[1] = fConvertToRupiahBulat($JmBr);
	$StBar[1] = "-";
	if ($ToNi!=0){$HrBar[1] = fConvertToRupiahBulat($ToNi/$JmBr);}
	
	$NBasT[1] = $nBas;
	$TBasT[1] = fConvertDateLongsBln($tBas);
	$NKonT[1] = $nKon;
	$TKonT[1] = fConvertDateLongsBln($tKon);
	
}
else if ($Jns=='5.1')
{
	$KdSub[2] = $mRo[5];
	$NmSub[2] = $mRo[6];
	$KdRek[2] = $mRo[7];
	$NmRek[2] = $mRo[8];
	$ToNil[2] = fConvertToRupiahBulat($ToNi);
	$JmBar[2] = fConvertToRupiahBulat($JmBr);
	$StBar[2] = "-";
	if ($ToNi!=0){$HrBar[2] = fConvertToRupiahBulat($ToNi/$JmBr);}
	
	$NBasT[2] = $nBas;
	$TBasT[2] = fConvertDateLongsBln($tBas);
	$NKonT[2] = $nKon;
	$TKonT[2] = fConvertDateLongsBln($tKon);
}
else
{
	$KdSub[3] = $mRo[5];
	$NmSub[3] = $mRo[6];
	$KdRek[3] = $mRo[7];
	$NmRek[3] = $mRo[8];
	$ToNil[3] = fConvertToRupiahBulat($ToNi);
	$JmBar[3] = fConvertToRupiahBulat($JmBr);
	$StBar[3] = "-";
	if ($ToNi!=0){$HrBar[3] = fConvertToRupiahBulat($ToNi/$JmBr);}
	
	$NBasT[3] = $nBas;
	$TBasT[3] = fConvertDateLongsBln($tBas);
	$NKonT[3] = $nKon;
	$TKonT[3] = fConvertDateLongsBln($tKon);
}


$PcM= fGlobal("Full_Name","ta_user","User_ID",$PcT,"=","","");
$ReC = fConvertDateShort(substr($mRo[4],0,10))." ".substr($mRo[4],-8,8);

$NmSkP= fGlobal("Nm_Unit","ref_unit","Kd_Unit",$KdU,"=","","");
?> 
<body>
<table border="0" width="670" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td width="567"></td>
    <td width="131" style="text-align:right; font-size:10pt">Format II.A.11</td>
  </tr>
</table>
<table border="0" width="670" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td colspan="11" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">FORMULIR CARA PEROLEHAN / PENERIMAAN BMD </td>
  </tr>
  <tr>
    <td colspan="11" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">PENGADAAN BARANG YANG DIBELI ATAU DIPEROLEH ATAS BEBAN APBD </td>
  </tr>
  <tr>
    <td colspan="11" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri"> PENGGUNA BARANG</td>
  </tr>
  <tr>
    <td colspan="11" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri"><?=$NmSkP?></td>
  </tr>
  <tr>
    <td colspan="11" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">PEMERINTAH <?=strtoupper($TiDaer." ".$NmDaer)?></td>
  </tr>
  <tr>
    <td colspan="11" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">TAHUN <?=substr($ThN,0,4)?></td>
  </tr>
  <tr>
    <td colspan="11">&nbsp;</td>
  </tr>
  <tr height="22">
    <td width="14">&nbsp;</td>
    <td width="20" style="font-weight:bold">1.</td>
    <td colspan="9" style="font-weight:bold">Informasi Perolehan/Penerimaan Barang </td>
  </tr>
  <tr height="22" style="font-weight:bold">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="19">a.</td>
    <td colspan="8">Diperoleh atas beban APBD dari Belanja Modal</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="17">1)</td>
    <td colspan="7">Belanja atas Pengadaan Barang</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">a)</td>
    <td colspan="6">Kegiatan dan Rekening Anggaran Belanja Daerah</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="23">(1)</td>
    <td colspan="2">Kode Sub Kegiatan</td>
    <td width="23">:</td>
    <td width="406" colspan="2"><?=$KdSub[1]?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Nama Sub Kegiatan</td>
    <td>:</td>
    <td colspan="2"><?=$NmSub[1]?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(3)</td>
    <td colspan="2">Kode Belanja Daerah</td>
    <td>:</td>
    <td colspan="2"><?=$KdRek[1]?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(4)</td>
    <td colspan="2">Uraian Akun Belanja Daerah</td>
    <td>:</td>
    <td colspan="2"><?=$NmRek[1]?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>b)</td>
    <td colspan="3">Jumlah Barang</td>
    <td>:</td>
    <td colspan="2"><?=$JmBar[1]?></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>c)</td>
    <td colspan="3">Satuan Barang</td>
    <td>:</td>
    <td colspan="2"><?=$StBar[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>d)</td>
    <td colspan="3">Harga Satuan (Rp)</td>
    <td>:</td>
    <td colspan="2"><?=$HrBar[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>e)</td>
    <td colspan="3">Total Nilai Barang (Rp)</td>
    <td>:</td>
    <td colspan="2"><?=$ToNil[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>f)</td>
    <td colspan="6">Berita Acara Serah Terima Barang Pekerjaan</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="2">Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NBasT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TBasT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>g)</td>
    <td colspan="3">Bentuk Kontrak</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="5">Bukti Pembelian/Pembayaran</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2"><?=$PKonT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NKonT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TKonT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Kuitansi</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2"><?=$PKuiT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NKuiT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TKuiT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(3)</td>
    <td colspan="2">Surat Perintah Kerja</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2"><?=$PSpkT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NSpkT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TSpkT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(4)</td>
    <td colspan="2">Surat Perjanjian</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2"><?=$PSPrT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NSPrT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TSPrT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(5)</td>
    <td colspan="2">Surat Pesanan</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2"><?=$PSPsT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NSPsT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TSPsT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>h)</td>
    <td colspan="3">Dokumen Pendukung Lainnya</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="2">Nama Dokumen</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(a)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$NLaiT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><?=$TLaiT[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">.....................</td>
    <td>:</td>
    <td colspan="2"><?=$TLaiN[1]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="17">2)</td>
    <td colspan="7">Belanja atas Biaya Atribusi</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>a)</td>
    <td colspan="6">Kegiatan dan Rekening Anggaran Belanja Daerah</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="23">(1)</td>
    <td colspan="2">Kode Sub Kegiatan</td>
    <td width="23">:</td>
    <td width="406" colspan="2">-</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Nama Sub Kegiatan</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(3)</td>
    <td colspan="2">Kode Belanja Daerah</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(4)</td>
    <td colspan="2">Uraian Akun Belanja Daerah</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>  
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(5)</td>
    <td colspan="5">Jenis dan Nilai Biaya Atribusi</td>
  </tr>  
  
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td>...........</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td>...........</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>b)</td>
    <td colspan="6">Berita Acara Serah Terima Pekerjaan</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="2">Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>c)</td>
    <td colspan="6">Bentuk Kontrak</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="5">Bukti Pembelian/Pembayaran</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Kuitansi</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(3)</td>
    <td colspan="2">Surat Perintah Kerja</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(4)</td>
    <td colspan="2">Surat Perjanjian</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(5)</td>
    <td colspan="2">Surat Pesanan</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>d)</td>
    <td colspan="3">Dokumen Pendukung Lainnya</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="2">Nama Dokumen</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(a)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">.....................</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr height="22" style="font-weight:bold">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="19">b.</td>
    <td colspan="8">Pengadaan APBD dari Belanja Operasi </td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="17">1)</td>
    <td colspan="7">Belanja atas Pengadaan Barang</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">a)</td>
    <td colspan="6">Kegiatan dan Rekening Anggaran Belanja Daerah</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="23">(1)</td>
    <td colspan="2">Kode Sub Kegiatan</td>
    <td width="23">:</td>
    <td width="406" colspan="2"><?=$KdSub[2]?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Nama Sub Kegiatan</td>
    <td>:</td>
    <td colspan="2"><?=$NmSub[2]?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(3)</td>
    <td colspan="2">Kode Belanja Daerah</td>
    <td>:</td>
    <td colspan="2"><?=$KdRek[2]?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(4)</td>
    <td colspan="2">Uraian Akun Belanja Daerah</td>
    <td>:</td>
    <td colspan="2"><?=$NmRek[2]?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>b)</td>
    <td colspan="3">Jumlah Barang</td>
    <td>:</td>
    <td colspan="2"><?=$JmBar[2]?></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>c)</td>
    <td colspan="3">Satuan Barang</td>
    <td>:</td>
    <td colspan="2"><?=$StBar[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>d)</td>
    <td colspan="3">Harga Satuan (Rp)</td>
    <td>:</td>
    <td colspan="2"><?=$HrBar[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>e)</td>
    <td colspan="3">Total Nilai Barang (Rp)</td>
    <td>:</td>
    <td colspan="2"><?=$ToNil[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>f)</td>
    <td colspan="6">Berita Acara Serah Terima Barang Pekerjaan</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="2">Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NBasT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TBasT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>g)</td>
    <td colspan="3">Bentuk Kontrak:</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="5">Bukti Pembelian/Pembayaran</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2"><?=$PKonT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NKonT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TKonT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Kuitansi</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2"><?=$PKuiT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NKuiT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TKuiT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(3)</td>
    <td colspan="2">Surat Perintah Kerja</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2"><?=$PSpkT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NSpkT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TSpkT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(4)</td>
    <td colspan="2">Surat Perjanjian</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2"><?=$PSPrT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NSPrT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TSPrT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(5)</td>
    <td colspan="2">Surat Pesanan</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2"><?=$PSPsT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NSPsT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TSPsT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>h)</td>
    <td colspan="3">Dokumen Pendukung Lainnya</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="2">Nama Dokumen</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(a)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NLaiT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TLaiT[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">.....................</td>
    <td>:</td>
    <td colspan="2"><?=$TLaiN[2]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="17">2)</td>
    <td colspan="7">Belanja atas Biaya Atribusi</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>a)</td>
    <td colspan="6">Kegiatan dan Rekening Anggaran Belanja Daerah</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="23">(1)</td>
    <td colspan="2">Kode Sub Kegiatan</td>
    <td width="23">:</td>
    <td width="406" colspan="2">-</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Nama Sub Kegiatan</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(3)</td>
    <td colspan="2">Kode Belanja Daerah</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(4)</td>
    <td colspan="2">Uraian Akun Belanja Daerah</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>  
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(5)</td>
    <td colspan="5">Jenis dan Nilai Biaya Atribusi</td>
  </tr>  
  
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td>...........</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td>...........</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>b)</td>
    <td colspan="6">Berita Acara Serah Terima Pekerjaan</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="2">Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>c)</td>
    <td colspan="6">Bentuk Kontrak</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="5">Bukti Pembelian/Pembayaran</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Kuitansi</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(3)</td>
    <td colspan="2">Surat Perintah Kerja</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(4)</td>
    <td colspan="2">Surat Perjanjian</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(5)</td>
    <td colspan="2">Surat Pesanan</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>d)</td>
    <td colspan="3">Dokumen Pendukung Lainnya</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="2">Nama Dokumen</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(a)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">.....................</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr height="22" style="font-weight:bold">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="19">c.</td>
    <td colspan="8">Pengadaan APBD dari Belanja Tak Terduga </td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="17">1)</td>
    <td colspan="7">Belanja atas Pengadaan Barang</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">a)</td>
    <td colspan="6">Kegiatan dan Rekening Anggaran Belanja Daerah</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="23">(1)</td>
    <td colspan="2">Kode Sub Kegiatan</td>
    <td width="23">:</td>
    <td width="406" colspan="2"><?=$KdSub[3]?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Nama Sub Kegiatan</td>
    <td>:</td>
    <td colspan="2"><?=$NmSub[3]?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(3)</td>
    <td colspan="2">Kode Belanja Daerah</td>
    <td>:</td>
    <td colspan="2"><?=$KdRek[3]?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(4)</td>
    <td colspan="2">Uraian Akun Belanja Daerah</td>
    <td>:</td>
    <td colspan="2"><?=$NmRek[3]?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>b)</td>
    <td colspan="3">Jumlah Barang</td>
    <td>:</td>
    <td colspan="2"><?=$JmBar[3]?></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>c)</td>
    <td colspan="3">Satuan Barang</td>
    <td>:</td>
    <td colspan="2"><?=$StBar[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>d)</td>
    <td colspan="3">Harga Satuan (Rp)</td>
    <td>:</td>
    <td colspan="2"><?=$HrBar[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>e)</td>
    <td colspan="3">Total Nilai Barang (Rp)</td>
    <td>:</td>
    <td colspan="2"><?=$ToNil[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>f)</td>
    <td colspan="6">Berita Acara Serah Terima Barang Pekerjaan</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="2">Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NBasT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TBasT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>g)</td>
    <td colspan="3">Bentuk Kontrak</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="5">Bukti Pembelian/Pembayaran</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2"><?=$PKonT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NKonT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TKonT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Kuitansi</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2"><?=$PKuiT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NKuiT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TKuiT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(3)</td>
    <td colspan="2">Surat Perintah Kerja</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2"><?=$PSpkT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NSpkT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TSpkT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(4)</td>
    <td colspan="2">Surat Perjanjian</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2"><?=$PSPrT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NSPrT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TSPrT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(5)</td>
    <td colspan="2">Surat Pesanan</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2"><?=$PSPsT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NSPsT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TSPsT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>h)</td>
    <td colspan="3">Dokumen Pendukung Lainnya</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="2">Nama Dokumen</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(a)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NLaiT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$TLaiT[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">.....................</td>
    <td>:</td>
    <td colspan="2"><?=$TLaiN[3]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="17">2)</td>
    <td colspan="7">Belanja atas Biaya Atribusi</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>a)</td>
    <td colspan="6">Kegiatan dan Rekening Anggaran Belanja Daerah</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="23">(1)</td>
    <td colspan="2">Kode Sub Kegiatan</td>
    <td width="23">:</td>
    <td width="406" colspan="2">-</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Nama Sub Kegiatan</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(3)</td>
    <td colspan="2">Kode Belanja Daerah</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(4)</td>
    <td colspan="2">Uraian Akun Belanja Daerah</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>  
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(5)</td>
    <td colspan="5">Jenis dan Nilai Biaya Atribusi</td>
  </tr>  
  
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td>...........</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td>...........</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>b)</td>
    <td colspan="6">Berita Acara Serah Terima Pekerjaan</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="2">Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>c)</td>
    <td colspan="6">Bentuk Kontrak</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="5">Bukti Pembelian/Pembayaran</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">Kuitansi</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(3)</td>
    <td colspan="2">Surat Perintah Kerja</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(4)</td>
    <td colspan="2">Surat Perjanjian</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(5)</td>
    <td colspan="2">Surat Pesanan</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="22">(a)</td>
    <td width="162">Nama Penyedia</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(c)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>d)</td>
    <td colspan="3">Dokumen Pendukung Lainnya</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(1)</td>
    <td colspan="2">Nama Dokumen</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(a)</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(b)</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>(2)</td>
    <td colspan="2">.....................</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td style="font-weight:bold">2.</td>
    <td colspan="6" style="font-weight:bold">Informasi Nomor Register dan NIBAR</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="9">
	<table align="left" width="350" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-family:calibri; font-size:9pt">
	<tr height="18" style="text-align:center; font-weight:bold">
      <td width="40" style="border:1px #000000 solid">No</td>
      <td style="border:1px #000000 solid">No. Register</td>
      <td width="180" style="border:1px #000000 solid">NIBAR</td>
	</tr>
	<?php
	$iG=1;
	$nSQ = " SELECT P1.No_Register, P1.Referensi 
	FROM ta_kib_108 P1 
	WHERE P1.No_Pengadaan ='".$NoM."' ORDER BY P1.IDT";
	#echo $nSQ."<br>";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
	?>
	<tr height="18">
      <td style="border:1px #000000 solid; text-align:center"><?=$iG?>.</td>
      <td style="border:1px #000000 solid; text-align:center"><?=$mRo[0]?></td>
      <td style="border:1px #000000 solid; text-align:center"><?=$mRo[1]?></td>
	</tr>
	<?php
		$iG++;
	}
	?>
	</table>	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="9">&nbsp;</td>
  </tr>
  
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Diinput Oleh </td>
    <td>:</td>
    <td colspan="2"><?=$PcT?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Nama</td>
    <td>:</td>
    <td colspan="2"><?=$PcM?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">NIP</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Tanggal, Bulan, Tahun Transaksi</td>
    <td>:</td>
    <td colspan="2"><?=$ReC?></td>
  </tr>
  
  
  <tr>
    <td colspan="11">&nbsp;</td>
  </tr>
</table>
