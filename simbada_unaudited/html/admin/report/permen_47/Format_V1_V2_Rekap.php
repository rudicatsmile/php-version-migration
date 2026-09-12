<?
require "../../connfile.php";
require "../../configfile.php";
require "../../functionfile.php";

extract($_GET);
$nSQ = "SELECT IDT as A0,
Nomor as A1,
Tanggal as A2,
KdSkpd as A3,
PI_Nama as A4,
PI_Nip as A5,
PI_PangkatGol as A6,
PI_Jabatan as A7,
PII_Nama as A8,
PII_Nip as A9,
PII_PangkatGol as A10,
PII_Jabatan as A11,
Semester as A12,
Tahun as A13,
Catatan_1 as A14,
Catatan_2 as A15,
Catatan_3 as A16,
Catatan_4 as A17 
FROM tb_rekonsiliasi 
WHERE IDT='$gID'"; 
#echo $nSQ;
$nRs = mysql_query($nSQ); 
while ($mRo = mysql_fetch_array($nRs)) 
{ 
	$g01 = $mRo[1];
	$TgL = $mRo[2];
	$g02v = $mRo[3];
	$gP1Nma = $mRo[4];
	$gP1Nip = $mRo[5];
	$gP1Pkt = $mRo[6];
	$gP1Jab = $mRo[7];
	
	$gP2Nma = $mRo[8];
	$gP2Nip = $mRo[9];
	$gP2Pkt = $mRo[10];
	$gP2Jab = $mRo[11];
	$Sem = $mRo[12];
	$Thn = $mRo[13];
	
	$gCt1  = $mRo[14];
	$gCt2  = $mRo[15];
	$gCt3  = $mRo[16];
	$gCt4  = $mRo[17];
}

if ($Sem==1)
{
	$TgA = $Thn."-01-01";
	$TgB = $Thn."-06-30";
}
else
{
	$TgA = $Thn."-01-01";
	$TgB = $Thn."-12-31";
}

$g02  = fGlobal("bidang","tb_bidang","kode",$g02v,"=","",DatabaseSA,$ConSA,"");
$gAL  = fGlobal("Alamat","tb_bidang","kode",$g02v,"=","",DatabaseSA,$ConSA,"");
if ($gAL==''){$gAL="Alamat..........";}

if ($model=="V3")
{
	$gP3Nma = fGlobal("Nm_Kepala","tb_bidang","kode",$g02v,"=","",DatabaseSA,$ConSA,"");
	$gP3Nip = fGlobal("Nip_Kepala","tb_bidang","kode",$g02v,"=","",DatabaseSA,$ConSA,"");
}
else if ($model=="V4")
{
	$gP3Nma = fGlobal("Nm_Kepala","tb_bidang","kode","24.04.13.01","=","",DatabaseSA,$ConSA,"");
	$gP3Nip = fGlobal("Nip_Kepala","tb_bidang","kode","24.04.13.01","=","",DatabaseSA,$ConSA,"");
}

$fAbpdL  = fGlobal("Anggaran","tb_rekonsiliasi_lampiran_2","Nomor:Sumber_Dana",$g01.":Apbd_L","=:=","",DatabaseSA,$ConSA,"");;
$fAbpdLe = fGlobal("Realisasi","tb_rekonsiliasi_lampiran_2","Nomor:Sumber_Dana",$g01.":Apbd_L","=:=","",DatabaseSA,$ConSA,"");;
$fAbpdLf = 0;
if ($fAbpdL!=0 && $fAbpdLe!=0)
{
$fAbpdLf = ($fAbpdLe/$fAbpdL)*100;
}

$fAbpdT  = fGlobal("Anggaran","tb_rekonsiliasi_lampiran_2","Nomor:Sumber_Dana",$g01.":Apbd_T","=:=","",DatabaseSA,$ConSA,"");;
$fAbpdTe = fGlobal("Realisasi","tb_rekonsiliasi_lampiran_2","Nomor:Sumber_Dana",$g01.":Apbd_T","=:=","",DatabaseSA,$ConSA,"");;
$fAbpdTf = 0;
if ($fAbpdT!=0 && $fAbpdTe!=0)
{
$fAbpdTf = ($fAbpdTe/$fAbpdT)*100;
}

$fLain  = fGlobal("Anggaran","tb_rekonsiliasi_lampiran_2","Nomor:Sumber_Dana",$g01.":Lainnya","=:=","",DatabaseSA,$ConSA,"");;
$fLaine = fGlobal("Realisasi","tb_rekonsiliasi_lampiran_2","Nomor:Sumber_Dana",$g01.":Lainnya","=:=","",DatabaseSA,$ConSA,"");;
$fLainf = 0;
if ($fLain!=0 && $fLaine!=0)
{
$fLainf = ($fLaine/$fLain)*100;
}

?> 
<body>
<table border="0" width="850" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr height="10">
    <td style="text-align:center; font-size:11pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">
	<table border="0" width="100%" cellspacing="0" cellpadding="3" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
	<tr style="text-align:center; font-weight:bold">
	<td rowspan="2" style="border:1px solid #000">No</td>
	<td rowspan="2" style="border:1px solid #000">Uraian</td>
	<td colspan="2" style="border:1px solid #000">Nilai Perolehan </td>
	<td colspan="2" style="border:1px solid #000">Hasil Rekonsiliasi </td>
	<td rowspan="2" style="border:1px solid #000">Keterangan</td>
	</tr>
	<tr style="text-align:center; font-weight:bold">
	<td style="border:1px solid #000">Tambah</td>
	<td style="border:1px solid #000">Kurang</td>
	<td style="border:1px solid #000">Disetujui</td>
	<td style="border:1px solid #000">Perbaikan</td>
	</tr>
	<tr style="text-align:center">
	<td width="25" style="border:1px solid #000; border-bottom:3px double">1</td>
	<td width="330" style="border:1px solid #000; border-bottom:3px double">2</td>
	<td width="110" style="border:1px solid #000; border-bottom:3px double">3</td>
	<td width="110" style="border:1px solid #000; border-bottom:3px double">4</td>
	<td width="65" style="border:1px solid #000; border-bottom:3px double">5</td>
	<td width="65" style="border:1px solid #000; border-bottom:3px double">6</td>
	<td style="border:1px solid #000; border-bottom:3px double">7</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">1.</td>
	  <td style="border:1px solid #000; padding-left:13px">Cara Perolehan</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">a. Pengadaan dari APBD</td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($fAbpdL+$fAbpdT)?></td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:27px">
	  <table border="0" width="80%" cellspacing="0" cellpadding="0" style="border-collapse: collapse; font-family:Calibri; font-size:10pt">
	  <tr>
	  <td width="15"><li></li></td>
	  <td>LRA Aset Lancar</td>
	  <td width="20">Rp.</td>
	  <td width="100" style="text-align:right; padding-right:3px"><?=fConvertToRupiah($fAbpdLe)?></td>
	  </tr>
	  <tr>
	  <td><li></li></td>
	  <td>LRA Aset Tetap</td>
	  <td>Rp.</td>
	  <td style="text-align:right; padding-right:3px"><?=fConvertToRupiah($fAbpdTe)?></td>
	  </tr>
	  </table>	  </td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">b. Hibah</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">c. Pelaksanaan dari perjanjian/kontrak</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">d. Ketentuan peraturan perundang-undangan</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">e. Putusan pengadilan</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">f. Divestasi</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">g. Hasil Inventarisasi</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">h. Hasil tukar menukar</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">i. Pembatalan Pengahapusan</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">j. Perolehan lainnya</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">2.</td>
	  <td style="border:1px solid #000; padding-left:13px">Penggunaan</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">a. Pengalihan atau penyerahan BMD</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<?
	$PggPlusA = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108_mutasi","Kd_UPB_To:Kd_UPB:Tgl_Mutasi:Tgl_Mutasi:Kd_Aset_108",$g02v.".%:".$g02v.".%:".$TgA.":".$TgB.":1.3.1.%","LIKE:NOT LIKE:>=:<=:LIKE","",DatabaseSB,$ConSB,"");
	$PggMinsA = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_UPB_To:Tgl_Mutasi:Tgl_Mutasi:Kd_Aset_108",$g02v.".%:".$g02v.".%:".$TgA.":".$TgB.":1.3.1.%","LIKE:NOT LIKE:>=:<=:LIKE","",DatabaseSB,$ConSB,"");
	?>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:26px"><li>Mutasi SKPD (Kib A)</li></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($PggPlusA)?></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($PggMinsA)?></td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<?
	$PggPlusB = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108_mutasi","Kd_UPB_To:Kd_UPB:Tgl_Mutasi:Tgl_Mutasi:Kd_Aset_108",$g02v.".%:".$g02v.".%:".$TgA.":".$TgB.":1.3.2.%","LIKE:NOT LIKE:>=:<=:LIKE","",DatabaseSB,$ConSB,"");
	$PggMinsB = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_UPB_To:Tgl_Mutasi:Tgl_Mutasi:Kd_Aset_108",$g02v.".%:".$g02v.".%:".$TgA.":".$TgB.":1.3.2.%","LIKE:NOT LIKE:>=:<=:LIKE","",DatabaseSB,$ConSB,"");
	?>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:26px"><li>Mutasi SKPD (Kib B)</li></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($PggPlusB)?></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($PggMinsB)?></td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<?
	$PggPlusC = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108_mutasi","Kd_UPB_To:Kd_UPB:Tgl_Mutasi:Tgl_Mutasi:Kd_Aset_108",$g02v.".%:".$g02v.".%:".$TgA.":".$TgB.":1.3.3.%","LIKE:NOT LIKE:>=:<=:LIKE","",DatabaseSB,$ConSB,"");
	$PggMinsC = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_UPB_To:Tgl_Mutasi:Tgl_Mutasi:Kd_Aset_108",$g02v.".%:".$g02v.".%:".$TgA.":".$TgB.":1.3.3.%","LIKE:NOT LIKE:>=:<=:LIKE","",DatabaseSB,$ConSB,"");
	?>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:26px"><li>Mutasi SKPD (Kib C)</li></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($PggPlusC)?></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($PggMinsC)?></td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<?
	$PggPlusD = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108_mutasi","Kd_UPB_To:Kd_UPB:Tgl_Mutasi:Tgl_Mutasi:Kd_Aset_108",$g02v.".%:".$g02v.".%:".$TgA.":".$TgB.":1.3.4.%","LIKE:NOT LIKE:>=:<=:LIKE","",DatabaseSB,$ConSB,"");
	$PggMinsD = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_UPB_To:Tgl_Mutasi:Tgl_Mutasi:Kd_Aset_108",$g02v.".%:".$g02v.".%:".$TgA.":".$TgB.":1.3.4.%","LIKE:NOT LIKE:>=:<=:LIKE","",DatabaseSB,$ConSB,"");
	?>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:26px"><li>Mutasi SKPD (Kib D)</li></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($PggPlusD)?></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($PggMinsD)?></td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<?
	$PggPlusE = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108_mutasi","Kd_UPB_To:Kd_UPB:Tgl_Mutasi:Tgl_Mutasi:Kd_Aset_108",$g02v.".%:".$g02v.".%:".$TgA.":".$TgB.":1.3.5.%","LIKE:NOT LIKE:>=:<=:LIKE","",DatabaseSB,$ConSB,"");
	$PggMinsE = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_UPB_To:Tgl_Mutasi:Tgl_Mutasi:Kd_Aset_108",$g02v.".%:".$g02v.".%:".$TgA.":".$TgB.":1.3.5.%","LIKE:NOT LIKE:>=:<=:LIKE","",DatabaseSB,$ConSB,"");
	?>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:26px"><li>Mutasi SKPD (Kib E)</li></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($PggPlusE)?></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($PggMinsE)?></td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<?
	$PggPlusF = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108_mutasi","Kd_UPB_To:Kd_UPB:Tgl_Mutasi:Tgl_Mutasi:Kd_Aset_108",$g02v.".%:".$g02v.".%:".$TgA.":".$TgB.":1.3.6.%","LIKE:NOT LIKE:>=:<=:LIKE","",DatabaseSB,$ConSB,"");
	$PggMinsF = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_UPB_To:Tgl_Mutasi:Tgl_Mutasi:Kd_Aset_108",$g02v.".%:".$g02v.".%:".$TgA.":".$TgB.":1.3.6.%","LIKE:NOT LIKE:>=:<=:LIKE","",DatabaseSB,$ConSB,"");
	?>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:26px"><li>Mutasi SKPD (Kib F)</li></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($PggPlusF)?></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($PggMinsF)?></td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">3.</td>
	  <td style="border:1px solid #000; padding-left:13px">Penerimaan Internal Barang Pengguna</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">4.</td>
	  <td style="border:1px solid #000; padding-left:13px">Pengeluaran Internal Barang Pengguna</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<?
	$RekPlus = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108_mutasi","kd_upb:Tgl_Mutasi:Tgl_Mutasi:Kd_Aset_108:Kd_Aset_108_To",$g02v.".%:".$TgA.":".$TgB.":1.5.%:1.3.%","LIKE:>=:<=:LIKE:LIKE","",DatabaseSB,$ConSB,"");
	$RekMins = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108_mutasi","kd_upb:Tgl_Mutasi:Tgl_Mutasi:Kd_Aset_108:Kd_Aset_108_To",$g02v.".%:".$TgA.":".$TgB.":1.3.%:1.5.%","LIKE:>=:<=:LIKE:LIKE","",DatabaseSB,$ConSB,"");
	?>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">5.</td>
	  <td style="border:1px solid #000; padding-left:13px">Reklasifikasi</td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($RekPlus)?></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($RekMins)?></td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">6.</td>
	  <td style="border:1px solid #000; padding-left:13px">Koreksi</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<?
	$SQ = "SELECT ifnull(sum(P1.debet),0) 
	FROM ta_kib_post_108_mutasi P1 
	LEFT JOIN ta_usulan_108 P2 ON P2.Referensi=P1.Ref_Usulan 
	WHERE P1.Kd_UPB LIKE '".$g02v."%' AND (P1.Tgl_Mutasi BETWEEN '".$TgA."' AND '".$TgB."') AND P1.Jns_Mutasi='PH' 
	AND P2.Jenis_Rinci LIKE '__'";
	$nR = mysql_query($SQ);
	$mR = mysql_fetch_array($nR);
	$DelPlus = 0;
	$DelMins = $mR[0];
	
	$SQ = "SELECT ifnull(sum(P1.debet),0) 
	FROM ta_kib_post_108_mutasi P1 
	LEFT JOIN ta_usulan_108 P2 ON P2.Referensi=P1.Ref_Usulan 
	WHERE P1.Kd_UPB LIKE '".$g02v."%' AND (P1.Tgl_Mutasi BETWEEN '".$TgA."' AND '".$TgB."') AND P1.Jns_Mutasi='PH' 
	AND (P2.Jenis_P47='01' OR P2.Jenis_Rinci='02' OR P2.Jenis_Rinci='03' OR P2.Jenis_Rinci='04' OR P2.Jenis_Rinci='06' OR P2.Jenis_Rinci='07')";
	$nR = mysql_query($SQ);
	$mR = mysql_fetch_array($nR);
	$DelPlusA = 0;
	$DelMinsA = $mR[0];
	
	$DelPlusB = 0;
	$DelMinsB = 0;
	
	$DelPlusC = 0;
	$DelMinsC = 0;
	
	$DelPlusD = 0;
	$DelMinsD = 0;
	
	$SQ = "SELECT ifnull(sum(P1.debet),0) 
	FROM ta_kib_post_108_mutasi P1 
	LEFT JOIN ta_usulan_108 P2 ON P2.Referensi=P1.Ref_Usulan 
	WHERE P1.Kd_UPB LIKE '".$g02v."%' AND (P1.Tgl_Mutasi BETWEEN '".$TgA."' AND '".$TgB."') AND P1.Jns_Mutasi='PH' 
	AND (P2.Jenis_P47='05' OR P2.Jenis_Rinci='01')";
	$nR = mysql_query($SQ);
	$mR = mysql_fetch_array($nR);
	$DelPlusE = 0;
	$DelMinsE = $mR[0];
	
	$DelPlusF = $DelPlus - ($DelPlusA+$DelPlusE);
	$DelMinsF = $DelMins - ($DelMinsA+$DelMinsE);
	
	?>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">7.</td>
	  <td style="border:1px solid #000; padding-left:13px">Penghapusan</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:right">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">a. Pemindahtanganan BMD</td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($DelPlusA)?></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($DelMinsA)?></td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">b. Penyerahan atau Pengalihan Status Penggunaan BMD</td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($DelPlusB)?></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($DelMinsB)?></td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">c. Putusan Pengadilan yang telah berkekuatan hukum tetap</td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($DelPlusC)?></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($DelMinsC)?></td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">d. Ketentuan peraturan perundang-undangan</td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($DelPlusD)?></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($DelMinsD)?></td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">e. Pemusnahan</td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($DelPlusE)?></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($DelMinsE)?></td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; padding-left:13px">f. &nbsp;Sebab lain</td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($DelPlusF)?></td>
	  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiah($DelMinsF)?></td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td colspan="7" style="border:1px solid #000; text-align:center">&nbsp;</td>
	  </tr>
	</table>	</td>
  </tr>
  
  <tr>
    <td style="text-align:center; font-size:11pt; font-weight:bold; font-family:calibri">
<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Catatan Hasil Rekonsiliasi :</td>
  </tr>
  
  <tr height="24">
    <td>1.<?=str_repeat('&nbsp;',2).$gCt1?></td>
  </tr>
  
  <tr height="24">
    <td>2.<?=str_repeat('&nbsp;',2).$gCt2?></td>
  </tr>
  <tr height="24">
    <td>3.<?=str_repeat('&nbsp;',2).$gCt3?></td>
  </tr>
  <tr height="24">
    <td>4.<?=str_repeat('&nbsp;',2).$gCt4?></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>	</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:11pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  

  <tr style="font-weight:bold">
    <td>
	<table border="0" width="100%" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
      <tr>
        <td width="280" style="text-align:center; font-weight:bold">PIHAK KEDUA</td>
        <td style="text-align:center">&nbsp;</td>
        <td width="280" style="text-align:center; font-weight:bold">PIHAK PERTAMA</td>
	</tr>
      <tr>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
      </tr>
      <tr>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
      </tr>
      <tr>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
      </tr>
      <tr>
        <td style="text-align:center; text-decoration:underline; font-weight:bold"><?=$gP2Nma?></td>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center; text-decoration:underline; font-weight:bold"><?=$gP1Nma?></td>
      </tr>
      <tr>
        <td style="text-align:center">NIP. <?=$gP2Nip?></td>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">NIP. <?=$gP1Nip?></td>
      </tr>
      <tr>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
      </tr>
	</table>	</td>
  </tr>
  <? if ($model=="V3" || $model=="V4"){?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <? } ?>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<br>