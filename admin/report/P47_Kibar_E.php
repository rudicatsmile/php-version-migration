<?php
require "../Connection.php";
require "../FileFunction.php";

ini_set('max_execution_time', 300);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
extract($_GET);
$mRo67 = fGlobal("file_name","ta_kib_108","IDT",$IdT,"=","","");
$DtA = fGlobal("referensi:kd_upb","ta_kib_108","IDT",$IdT,"=","","");
$DtA = explode(':',$DtA);
$ref = $DtA[0];
$upb = $DtA[1];
$unt = substr($upb,0,11);

$kua = "-";
$pgg = fGlobal("nma_pimpinan","ref_unit","kd_unit",$unt,"=","","");
$pgl = fGlobal("nma_pimpinan","ref_unit","kd_unit","24.04.04.01","=","","");
$alm = "-";

$nSQ = "select 
P1.Kd_Aset_108 as A0,
'-' as A1,
P1.No_Register as A2,
P2.Nm_Aset as A3,
P1.Nm_Aset as A4,
P1.Luas_M2 as A5,
ifnull(sum(P3.debet),0) as A6,
ifnull(sum(P3.debet),0) as A7,
P1.Kondisi as A8,
P1.alamat as A9,
P1.lat_lng as A10,
P1.Sertifikat_Nomor as A11,
P1.Sertifikat_Tanggal as A12,
P1.Hak_Tanah as A13,
P1.Batas_Utara as A14,
P1.Batas_Timur as A15,
P1.Batas_Selatan as A16,
P1.Batas_Barat as A17,
P1.Asal_Usul as A18,
P1.Tgl_Perolehan as A19 
FROM ta_kib_108 P1 
LEFT JOIN ref_rek_aset108_7 P2 ON P2.kd_aset=P1.kd_aset_108 
LEFT JOIN ta_kib_post_108 P3 ON P3.referensi=P1.referensi AND P3.kd_upb=P1.kd_upb 
WHERE P1.IDT='".$IdT."' GROUP BY P1.referensi";
#echo $nSQ;
$nRs = mysql_query($nSQ);
$mRo = mysql_fetch_array($nRs);
$KdB = $mRo[0];
$KdL = $mRo[1];
$KdR = $mRo[2];
$NmB = $mRo[3];
$NmS = $mRo[4];
$LuA = $mRo[5];
$NiS = $mRo[6];
$NiP = $mRo[7];
$KoN = $mRo[8];
if ($KoN==''){$KoN="B";}
$AlA = $mRo[9];
$KoR = $mRo[10];
$SerN = $mRo[11];
$SerT = $mRo[12];
$NmaH = $mRo[13];

$BtsU = $mRo[14];
$BtsT = $mRo[15];
$BtsS = $mRo[16];
$BtsB = $mRo[17];

$CraP = $mRo[18];
$TglP = $mRo[19];
?>
<table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:calibri; font-size:10pt; width:1000px; border-collapse:collapse; border:0px solid #000">
<tr>
	<td>&nbsp;</td>
	<td width="100" style="text-align:right; font-weight:bold">Format II.N.5</td>
</tr>
</table>
<table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:calibri; font-size:10pt; width:1000px; border-collapse:collapse; border:1px solid #000">
<tr height="5">
	<td width="220"></td>
	<td></td>
	<td width="220"></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>
	<table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:calibri; font-size:10pt; width:240px; border-collapse:collapse; border:0px solid #000">
	<tr height="7">
		<td width="232" style="border-left:1px solid #000; border-top:1px solid #000; border-right:1px solid #000"></td>
	    <td></td>
	</tr>
	<tr>
		<td style="border-left:1px solid #000; border-right:1px solid #000; padding-left:20px">NIBAR : <?=$ref?></td>
	    <td>&nbsp;</td>
	</tr>
	<tr height="7">
		<td style="border-left:1px solid #000; border-bottom:1px solid #000; border-right:1px solid #000"></td>
	    <td></td>
	</tr>
	</table>  </td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td style="font-weight:bold; text-align:center; font-size:11pt">KARTU IDENTITAS BARANG (KIBAR)</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td style="font-weight:bold; text-align:center; font-size:11pt">ASET TETAP LAINNYA </td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td style="font-weight:bold; text-align:center; font-size:11pt">KUASA PENGGUNA BARANG, PENGGUNA BARANG ATAU PENGELOLA BARANG</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td style="font-weight:bold; text-align:center; font-size:11pt">KABUPATEN <?=$NmDaer?></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td style="font-weight:bold; text-align:center">&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr height="25">
  <td colspan="3" style="border-top:1px solid #000; border-bottom:1px solid #000; text-align:center; font-weight:bold; background:#ccc">I. UNIT PEMAKAI</td>
</tr>
<tr>
  <td colspan="3">
	<table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:calibri; font-size:10pt; width:100%; border-collapse:collapse">
	<tr>
		<td width="260">&nbsp;</td>
	    <td width="20">&nbsp;</td>
	    <td width="230" style="border-right:1px solid #000">&nbsp;</td>
	    <td rowspan="6" align="center">
		<?php if ($mRo67!='') {?>
		<img src="../simandor/images/<?=$IdT."xyz".$mRo67?>" height="140" width="115" style="border:1px #000 solid" />
		<?php } ?>
		</td>
	</tr>
	<tr>
		<td style="border-top:1px solid #000; padding-left:10px">1. Kuasa Pengguna Barang</td>
	    <td style="border-top:1px solid #000; text-align:center">:</td>
	    <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$kua?></td>
	    </tr>
	<tr>
		<td style="border-top:1px solid #000; padding-left:10px">2. Pengguna Barang </td>
	    <td style="border-top:1px solid #000; text-align:center">:</td>
	    <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$pgg?></td>
	    </tr>
	<tr>
	  <td style="border-top:1px solid #000; padding-left:10px">3. Pengelola Barang </td>
	  <td style="border-top:1px solid #000; text-align:center">:</td>
	  <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$pgl?></td>
	  </tr>
	<tr>
	  <td style="border-top:1px solid #000; padding-left:10px">4. Alamat</td>
	  <td style="border-top:1px solid #000; text-align:center">:</td>
	  <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$alm?></td>
	  </tr>
	<tr>
	  <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
	  <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
	  <td style="border-top:1px solid #000; border-right:1px solid #000; text-align:center">&nbsp;</td>
	  </tr>
	</table>  </td>
</tr>
<tr height="25">
  <td colspan="3" style="border-top:1px solid #000; border-bottom:1px solid #000; text-align:center; font-weight:bold; background:#ccc">II. DATA BARANG</td>
</tr>
<tr>
  <td colspan="3"><table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:calibri; font-size:10pt; width:100%; border-collapse:collapse">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td style="border-right:1px solid #000">&nbsp;</td>
      <td colspan="3" style="padding-left:10px">&nbsp;</td>
    </tr>
    <tr>
      <td width="260" style="border-top:1px solid #000; padding-left:10px">1. Kode Barang</td>
      <td width="20" style="border-top:1px solid #000; text-align:center">:</td>
      <td width="220" style="border-top:1px solid #000; border-right:1px solid #000"><?=$KdB?></td>
      <td width="220" style="border-top:1px solid #000; padding-left:10px">14. Lokasi </td>
      <td width="20" style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">2. Kode Lokasi </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$KdL?></td>
      <td style="border-top:1px solid #000; padding-left:30px">a. Provinsi </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$NmProv?>
      </td>
    </tr>
    
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">3. Kode Register Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$KdR?></td>
      <td style="border-top:1px solid #000; padding-left:30px">b. Kabupaten / Kota </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$NmDaer?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">4. Nama Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$NmB?></td>
      <td style="border-top:1px solid #000; padding-left:30px">c. Kecamatan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">5. Spesifikasi Nama Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$NmS?></td>
      <td style="border-top:1px solid #000; padding-left:30px">d. Kelurahan / Desa </td>
      <td style="border-top:1px solid #000; padding-left:10px">:</td>
      <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
    </tr>
    
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">6. Jumlah Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">e. Jalan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">7. Satuan Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">f. RT / RW </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">8. Harga Satuan Perolehan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:10px">15. Spesifikasi Lainnya </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">9. Nilai Perolehan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">a. -</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">10. Sisa Masa Manfaat</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">b. - </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">11. Akumulasi Penyusutan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:10px">20. Informasi Transaksi Terakhir</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">12. Nilai Buku</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">a. Jenis Informasi </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">13. Kondisi Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">b. Tanggal Transaksi Input</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    
    

    
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000; text-align:center">&nbsp;</td>
      <td colspan="3" style="border-top:1px solid #000">&nbsp;</td>
    </tr>
  </table></td>
</tr>
<tr height="25">
  <td colspan="3" style="border-top:1px solid #000; border-bottom:1px solid #000; text-align:center; font-weight:bold; background:#ccc">III. INFORMASI PENERIMAAN AWAL BARANG</td>
</tr>
<tr>
  <td colspan="3">
  <table border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:calibri; font-size:10pt; width:100%; border-collapse:collapse">
    <tr>
      <td width="270">&nbsp;</td>
      <td width="20">&nbsp;</td>
      <td></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">1. Cara Perolehan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$CraP?></td>
      </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">2. Tanggal, Bulan, Tahun Perolehan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=fConvertDateLongsBln($TglP)?></td>
      </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">3. Jumlah (Luas)</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=fConvertToRupiahBulat($LuA)?> m<sup>2</sup></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">4. Satuan Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">Bidang</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">5. Harga Satuan Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=fConvertToRupiah($NiS)?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">6. Nilai Total Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=fConvertToRupiah($NiP)?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">7. Biaya Atribusi</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" style="border-top:1px solid #000">
	    <table cellpadding="0" cellspacing="0" style=" width:100%; border-collapse:collapse; font-family:calibri; font-size:10pt">
	      <tr style="text-align:center; font-weight:bold">
	        <td width="100" style="border-bottom:0px solid #000">&nbsp;</td>
	        <td width="39" style="border-left:1px solid #000; border-bottom:1px solid #000">No</td>
	        <td width="117" style="border-left:1px solid #000; border-bottom:1px solid #000">Tanggal Transaksi Input</td>
	        <td width="250" style="border-left:1px solid #000; border-bottom:1px solid #000">Jenis Biaya Atribusi</td>
	        <td width="113" style="border-left:1px solid #000; border-bottom:1px solid #000">Nilai Biaya Atribusi (Rp)</td>
	        <td style="border-left:1px solid #000; border-bottom:0px solid #000">&nbsp;</td>
	      </tr>
	      <tr>
	        <td style="border-bottom:0px solid #000">&nbsp;</td>
	        <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
	        <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
	        <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
	        <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
	        <td style="border-left:1px solid #000; border-bottom:0px solid #000">&nbsp;</td>
	      </tr>
	      <tr>
	        <td style="border-bottom:0px solid #000">&nbsp;</td>
	        <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
	        <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
	        <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
	        <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
	        <td style="border-left:1px solid #000; border-bottom:0px solid #000">&nbsp;</td>
	      </tr>
	      <tr>
	        <td style="text-align:center">&nbsp;</td>
	        <td colspan="3" style="border-left:1px solid #000; text-align:center">Jumlah Total Nilai Atribusi (Rp)</td>
	        <td style="border-left:1px solid #000">&nbsp;</td>
	        <td style="border-left:1px solid #000">&nbsp;</td>
	      </tr>
	     </table></td>
      </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">8. Nilai Perolehan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=fConvertToRupiah($NiP)?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">9. Harga Satuan Perolehan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=fConvertToRupiah($NiP)?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">10. Pihak yang menyerahkan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">-</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">11. Dokumen sumber perolehan </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">-</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">Nama Dokumen Sumber </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">-</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">a. Nomor </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">-</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">b. Tanggal </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">-</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">12. Dokumen Pendukung Lainnya </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">-</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">a. Nama dokumen pendukung lainnya </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">-</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">(1) Nomor </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">-</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">(2) Tanggal </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">-</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">b. dst.</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">-</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
  </table></td>
</tr>
<tr height="25">
  <td colspan="3" style="border-top:1px solid #000; border-bottom:1px solid #000; text-align:center; font-weight:bold; background:#ccc">IV. INFORMASI PENGGUNAAN</td>
</tr>
	<?php
	$Dta = fGlobal("Referensi:Ref_Group","ta_kib_108","IDT",$IdT,"=","","");
	$Dta = explode(":",$Dta);
	$Ref = $Dta[0];
	$Grp = $Dta[1];
	
	#A
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
		$TgLA = $mRo[1];
		$Pengguna_A = $mRo[2];
		$Jumlah_A = $mRo[3];
		$Satuan_A = $mRo[4];
		$Harga_A = $mRo[5];
		$NilaiAkhir_A = $mRo[6];
		$DokumenSumber_A = $mRo[7];
		
		$BastNomor_A = $mRo[8];
		$BaTgLA = $mRo[9];
		
		$SkHapusNomor_A = $mRo[10];
		$SkTgLA = $mRo[11];
	}
	
	#B
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
		$TgLB = $mRo[1];
		
		$Pengguna_B = $mRo[2];
		$Jumlah_B = $mRo[3];
		$Satuan_B = $mRo[4];
		$Harga_B = $mRo[5];
		$NilaiAkhir_B = $mRo[6];
		$DokumenSumber_B = $mRo[7];
		
		$BastNomor_B = $mRo[8];
		$BaTgLB = $mRo[9];
		
		$SkHapusNomor_B = $mRo[10];
		$SkTgLB = $mRo[11];
	}
	
	#C
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
		$TgLC = $mRo[1];
		
		$Pengguna_C = $mRo[2];
		$Alamat_C = $mRo[12];
		$Jumlah_C = $mRo[3];
		$Tanah_C = $mRo[13];
		$Waktu_C = $mRo[14];
		
		$MulaiP_C = $mRo[15];
		$AkhirP_C = $mRo[16];
		
		$Peruntukan_C = $mRo[17];
		$SpBNomor_C = $mRo[18];
		$SpBTgl_C = $mRo[19];
		
		$SpNomor_C = $mRo[20];
		$SpTgl_C= $mRo[21];
		
		$DokLainNama_C=$mRo[22];
		$DokLainNomor_C=$mRo[23];
		$DokLainTgl_C = $mRo[24];
		
		$Satuan_C = $mRo[4];
		#$Harga_C = $mRo[5];
		#$NilaiAkhir_C = $mRo[6];
		#$DokumenSumber_C = $mRo[7];
		
		#$BastNomor_C = $mRo[8];
		#$BaTgL_C = $mRo[9];
		
		#$SkHapusNomor_C = $mRo[10];
		#$SkTgL_C = $mRo[11];
	}	
	
	#D
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
		$TgLD = $mRo[1];
		
		$Pengguna_D = $mRo[2];
		$Alamat_D = $mRo[12];
		$Jumlah_D = $mRo[3];
		$Tanah_D = $mRo[13];
		
		$Waktu_D = $mRo[14];
		$MulaiP_D = $mRo[15];
		$AkhirP_D = $mRo[16];
		
		$Peruntukan_D = $mRo[17];
		$SpBNomor_D = $mRo[18];
		$SpBTgl_D = $mRo[19];
		
		$SpNomor_D = $mRo[20];
		$SpTgl_D= $mRo[21];
		
		$DokLainNama_D=$mRo[22];
		$DokLainNomor_D=$mRo[23];
		$DokLainTgl_D= $mRo[24];
		
		$Satuan_D = $mRo[4];
		#$Harga_D = $mRo[5];
		#$NilaiAkhir_D = $mRo[6];
		#$DokumenSumber_D = $mRo[7];
		
		#$BastNomor_D = $mRo[8];
		#$BaTgL_D = $mRo[9];
		
		#$SkHapusNomor_D = $mRo[10];
		#$SkTgL_D = $mRo[11];
		
	}	
?>
<tr>
  <td colspan="3"><table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:calibri; font-size:10pt; width:100%; border-collapse:collapse">
    <tr>
      <td colspan="6" style="padding-left:10px">Periode Transaksi per Tanggal
        <?=fConvertDateShort($TgLA)?>
        s/d
        <?=fConvertDateShort($TgLD)?></td>
    </tr>
    <tr>
      <td width="260" style="border-top:1px solid #000; padding-left:10px">1.&nbsp;&nbsp;&nbsp;Tanggal Input Transaksi</td>
      <td width="20" style="border-top:1px solid #000; text-align:center">:</td>
      <td width="220" style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td width="230" style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td width="20" style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" style="border-top:1px solid #000; border-right:1px solid #000; padding-left:30px">a. Penyerahan BMD dari Pengguna Barang kepada Gubernur, Bupati/Walikota</td>
      <td style="border-top:1px solid #000; padding-left:30px">b. Pengalihan Status Penggunaan BMD</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">1) Pengguna Barang yang Menyerahkan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Pengguna_A?></td>
      <td style="border-top:1px solid #000; padding-left:45px">1) Pengguna Barang atau Pengelola Barang yang menyerahkan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$Pengguna_B?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">2) Jumlah (luas)</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Jumlah_A?></td>
      <td style="border-top:1px solid #000; padding-left:45px">2) Jumlah (Luas) </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$Jumlah_B?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">3) Satuan Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Satuan_A?></td>
      <td style="border-top:1px solid #000; padding-left:45px">3) Satuan Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$Satuan_B?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">4) Harga Satuan (Rp)</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Harga_A?></td>
      <td style="border-top:1px solid #000; padding-left:45px">4) Harga Satuan (Rp)</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$Harga_B?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">5) Total Nilai Perolehan (Rp)</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$NilaiAkhir_A?></td>
      <td style="border-top:1px solid #000; padding-left:45px">5) Total Nilai Perolehan (Rp)</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$NilaiAkhir_B?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">6) Akumulasi Nilai Penyusutan (Rp)</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">6) Akumulasi Nilai Penyusutan (Rp) </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">7) Nilai Buku (Rp) </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">7) Nilai Buku (Rp)</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">8) Dokumen Sumber</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$DokumenSumber_A?></td>
      <td style="border-top:1px solid #000; padding-left:45px">8) Dokumen Sumber</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000"><?=$DokumenSumber_B?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:60px">a) Berita Acara Serah Terima</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:60px">a) Berita Acara Serah Terima</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:75px">(1) Nomor</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$BastNomor_A?></td>
      <td style="border-top:1px solid #000; padding-left:75px">(1) Nomor</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$BastNomor_B?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:75px">(2) Tanggal</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=fConvertDateShort($BaTgLA)?></td>
      <td style="border-top:1px solid #000; padding-left:75px">(2) Tanggal</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=fConvertDateShort($BaTgLB)?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:60px">b) SK Penghapusan</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:60px">b) SK Penghapusan</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:75px">(1) Nomor</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$SkHapusNomor_A?></td>
      <td style="border-top:1px solid #000; padding-left:75px">(1) Nomor</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$SkHapusNomor_B?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:75px">(2) Tanggal</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=fConvertDateShort($SkTgLA)?></td>
      <td style="border-top:1px solid #000; padding-left:75px">(2) Tanggal</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=fConvertDateShort($SkTgLB)?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">c.&nbsp;&nbsp;Penggunaan Sementara BMD</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">d. Penggunaan BMD untuk Dioperasikan oleh Pihak Lain</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">1) Pengguna Barang Sementara</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Pengguna_C?></td>
      <td style="border-top:1px solid #000; padding-left:45px">1) Pengguna Barang Sementara</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$Pengguna_D?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">2) Alamat</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Alamat_C?></td>
      <td style="border-top:1px solid #000; padding-left:45px">2) Alamat</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$Alamat_D?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">3) Jumlah</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Jumlah_C?></td>
      <td style="border-top:1px solid #000; padding-left:45px">3) Jumlah</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$Jumlah_D?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">4) Satuan Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Satuan_C?></td>
      <td style="border-top:1px solid #000; padding-left:45px">4) Satuan Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$Satuan_D?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">5) Tanah yang Digunakan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Tanah_C?></td>
      <td style="border-top:1px solid #000; padding-left:45px">5) Tanah yang Digunakan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$Tanah_D?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">6) Jangka Waktu</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Waktu_C?></td>
      <td style="border-top:1px solid #000; padding-left:45px">6) Jangka Waktu</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$Waktu_D?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">7) Tanggal, Bulan, Tahun Mulai Penggunaan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=fConvertDateShort($MulaiP_C)?></td>
      <td style="border-top:1px solid #000; padding-left:45px">7) Tanggal, Bulan, Tahun Mulai Penggunaan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=fConvertDateShort($MulaiP_D)?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">8) Tanggal, Bulan, Tahun Berakhir Penggunaan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=fConvertDateShort($AkhirP_C)?></td>
      <td style="border-top:1px solid #000; padding-left:45px">8) Tanggal, Bulan, Tahun Berakhir Penggunaan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=fConvertDateShort($AkhirP_D)?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">9) Peruntukan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Peruntukan_C?></td>
      <td style="border-top:1px solid #000; padding-left:45px">9) Peruntukan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$Peruntukan_D?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">10) Dasar Penggunaan</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">10) Dasar Penggunaan</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:68px">a) Surat Persetujuan Bupati</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:68px">a) Surat Keputusan Bupati</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:82px">(1) Nomor</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$SpBNomor_C?></td>
      <td style="border-top:1px solid #000; padding-left:82px">(1) Nomor</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$SpBNomor_D?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:82px">(2) Tanggal</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=fConvertDateShort($SpBTgl_C)?></td>
      <td style="border-top:1px solid #000; padding-left:82px">(2) Tanggal</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=fConvertDateShort($SpBTgl_D)?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:68px">b) Surat Perjanjian </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:68px">b) Surat Perjanjian </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:82px">(1) Nomor</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$SpNomor_C?></td>
      <td style="border-top:1px solid #000; padding-left:82px">(1) Nomor</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$SpNomor_D?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:82px">(2) Tanggal</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=fConvertDateShort($SpTgl_C)?></td>
      <td style="border-top:1px solid #000; padding-left:82px">(2) Tanggal</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=fConvertDateShort($SpTgl_D)?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">11) Dokumen Pendukung Lainnya </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">11) Dokumen Pendukung Lainnya </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:68px">a) Nama Dokumen Pendukung Lainnya</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$DokLainNama_C?></td>
      <td style="border-top:1px solid #000; padding-left:68px">a) Nama Dokumen Pendukung Lainnya</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$DokLainNama_D?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:82px">(1) Nomor</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$DokLainNomor_C?></td>
      <td style="border-top:1px solid #000; padding-left:82px">(1) Nomor</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$DokLainNomor_D?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:82px">(2) Tanggal</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=fConvertDateShort($DokLainTgl_C)?></td>
      <td style="border-top:1px solid #000; padding-left:82px">(2) Tanggal</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=fConvertDateShort($DokLainTgl_D)?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:68px">b) dst.</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">-</td>
      <td style="border-top:1px solid #000; padding-left:68px">b) dst.</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">-</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">2.&nbsp;&nbsp;&nbsp;Tanggal Transaksi Input</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=fConvertDateShort($TgLD)?></td>
      <td style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:68px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:68px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
  </table></td>
</tr>
<tr height="25">
  <td colspan="3" style="border-top:1px solid #000; border-bottom:1px solid #000; text-align:center; font-weight:bold; background:#ccc">V. INFORMASI PENERIMAAN BARANG INTERNAL PENGGUNA BARANG</td>
</tr>
<tr>
  <td colspan="3">
  <table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:calibri; font-size:10pt; width:100%; border-collapse:collapse">
    <tr>
      <td colspan="6" style="border-top:0px solid #000; padding-left:10px">Periode Transaksi per Tanggal ...... s/d ......</td>
      </tr>
    <tr>
      <td width="260" style="border-top:1px solid #000; padding-left:10px">1.&nbsp;&nbsp;&nbsp;Tanggal Transaksi Input </td>
      <td width="20" style="border-top:1px solid #000; text-align:center">:</td>
      <td width="220" style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td width="230" style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td width="20" style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">a. Bentuk Penerimaan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">i. Dokumen Sumber Penerimaan </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">b. Jumlah Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">Berita Acara Serah Terima </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">c. Satuan Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">(1) Nomor</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">d. Harga Satuan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">(2) Tanggal</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">e. Total Nilai Perolehan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">j. Dokumen pendukung lainnya </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">f. Akumulasi Penyusutan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">1) Nama dokumen pendukung lainnya </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">g. Nilai Buku (Rp)</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:60px">(a) Nomor </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">h. Pihak yang Menyerahkan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:60px">(b) Tanggal </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">2) dst.</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">2. Tanggal Transaksi Input </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
  </table>  </td>
</tr>
<tr height="25">
  <td colspan="3" style="border-top:1px solid #000; border-bottom:1px solid #000; text-align:center; font-weight:bold; background:#ccc">VI. INFORMASI PENGELUARAN BARANG INTERNAL PENGGUNA BARANG</td>
</tr>
<tr>
  <td colspan="3"><table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:calibri; font-size:10pt; width:100%; border-collapse:collapse">
    <tr>
      <td colspan="6" style="border-top:0px solid #000; padding-left:10px">Periode Transaksi per Tanggal ........ s/d .........</td>
      </tr>
    <tr>
      <td width="250" style="border-top:1px solid #000; padding-left:10px">1.&nbsp;&nbsp;&nbsp;Tanggal Transaksi Input </td>
      <td width="20" style="border-top:1px solid #000; text-align:center">:</td>
      <td width="230" style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td width="230" style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td width="20" style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">a. Bentuk Pengeluaran </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">i. Dokumen Sumber Penerimaan </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">b. Jumlah Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">Berita Acara Serah Terima </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">c. Satuan Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">(1) Nomor</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">d. Harga Satuan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">(2) Tanggal</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">e. Total Nilai Perolehan (Rp) </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">j. Dokumen pendukung lainnya </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">f. Akumulasi Nilai Penyusutan (Rp) </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">1) Nama dokumen pendukung lainnya </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">g. Nilai Buku (Rp)</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:60px">(a) Nomor </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">h. Pihak yang Menerima </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:60px">(b) Tanggal </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">2) dst.</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">2. Tanggal Transaksi Input </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
  </table></td>
</tr>
<tr height="25">
  <td colspan="3" style="border-top:1px solid #000; border-bottom:1px solid #000; text-align:center; font-weight:bold; background:#ccc">VII. INFORMASI PEMANFAATAN</td>
</tr>
<?php
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
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs))
	{
		$TgL = $mRo[1];
		$Bentuk = $mRo[6];
		$Pemanfaat = $mRo[2];
		$Mitra = $mRo[5];
		$Alamat = $mRo[12];
		$Jumlah = $mRo[3];
		$Satuan = $mRo[4];
		$Tanah = $mRo[13];
		$Waktu = $mRo[14];
		$MulaiP = $mRo[15];
		$AkhirP = $mRo[16];
		$Peruntukan = $mRo[17];
		$SpBNomor = $mRo[18];
		$SpBTanggal = $mRo[19];
		$SpNomor = $mRo[20];
		$SpTanggal= $mRo[21];
		$DokLainNama = $mRo[22];
		$DokLainNomor= $mRo[23];
		$DokLainTanggal = $mRo[24];
	}
?>
<tr>
  <td colspan="3"><table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:calibri; font-size:10pt; width:100%; border-collapse:collapse">
    <tr>
      <td colspan="6" style="border-top:0px solid #000; padding-left:10px">Periode Transaksi per Tanggal ........ s/d .........</td>
    </tr>
    <tr>
      <td width="260" style="border-top:1px solid #000; padding-left:10px">1.&nbsp;&nbsp;&nbsp;Tanggal Transaksi Input </td>
      <td width="20" style="border-top:1px solid #000; text-align:center">:</td>
      <td width="220" style="border-top:1px solid #000; border-right:1px solid #000"><?=$TgL?></td>
      <td width="230" style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td width="20" style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">a. Bentuk Pemanfaatan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Bentuk?></td>
      <td style="border-top:1px solid #000; padding-left:30px">l. Dasar Pemanfaatan</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">b. Mitra Pemanfaatan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Mitra?></td>
      <td style="border-top:1px solid #000; padding-left:45px">1. Surat Persetujuan </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">c. Pemerintah Pusat/Pemerintah Daerah Lainnya</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Pemanfaat?></td>
      <td style="border-top:1px solid #000; padding-left:60px">a) Nomor</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$SpBNomor?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">d. Alamat</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Alamat?></td>
      <td style="border-top:1px solid #000; padding-left:60px">b) Tanggal</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$SpBTanggal?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">e. Jumlah </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Jumlah?></td>
      <td style="border-top:1px solid #000; padding-left:45px">2. Surat Perjanjian </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">f. Satuan Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Satuan?></td>
      <td style="border-top:1px solid #000; padding-left:60px">a) Nomor </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$SpNomor?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">g. Jangka Waktu </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Waktu?></td>
      <td style="border-top:1px solid #000; padding-left:60px">b) Tanggal </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$SpTanggal?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">h. Tanggal, Bulan, Tahun Mulai Perjanjian</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$MulaiP?></td>
      <td style="border-top:1px solid #000; padding-left:30px">m. Dokumen Pendukung Lainnya </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">i. Tanggal, Bulan, Tahun Berakhir Perjanjian</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$AkhirP?></td>
      <td style="border-top:1px solid #000; padding-left:45px">1) Nama Dokumen Pendukung Lainnya</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$DokLainNama?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">j. Peruntukan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000"><?=$Peruntukan?></td>
      <td style="border-top:1px solid #000; padding-left:60px">a) Nomor</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$DokLainNomor?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:60px">b) Tanggal</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000"><?=$DokLainTanggal?></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">2) dst.</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">-</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">2. Tanggal Transaksi Input </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
  </table></td>
</tr>
<tr height="25">
  <td colspan="3" style="border-top:1px solid #000; border-bottom:1px solid #000; text-align:center; font-weight:bold; background:#ccc">VIII. INFORMASI REKLASIFIKASI</td>
</tr>
<tr>
  <td colspan="3"><table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:calibri; font-size:10pt; width:100%; border-collapse:collapse">
    <tr>
      <td colspan="6" style="border-top:0px solid #000; padding-left:10px">Periode Transaksi per Tanggal ........ s/d .........</td>
      </tr>
    <tr>
      <td width="260" style="border-top:1px solid #000; padding-left:10px">1.&nbsp;&nbsp;&nbsp;Tanggal Transaksi Input </td>
      <td width="20" style="border-top:1px solid #000; text-align:center">:</td>
      <td width="220" style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td width="230" style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td width="20" style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">a. Data Sebelum Reklasifikasi </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:15px">d. Dokumen Sumber Reklasifikasi </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">1) Kode Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">Nama Dokumen</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">2) Nama Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">(1) Nomor</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">3) Kode Register Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">(2) Tanggal</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">4) Spesifikasi Nama Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:15px">e. Dokumen Pendukung Lainnya </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">b. Data Setelah Reklasifikasi </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">1) Nama Dokumen Pendukung Lainnya </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">1) Kode Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">(a) Nomor </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">2) Nama Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">(b) Tanggal </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">3) Kode Register Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">2) dst. </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">c. Penyebab Reklasifikasi </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:60px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">2. Tanggal Transaksi Input </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
  </table></td>
</tr>
<tr height="25">
  <td colspan="3" style="border-top:1px solid #000; border-bottom:1px solid #000; text-align:center; font-weight:bold; background:#ccc">IX. INFORMASI KOREKSI</td>
</tr>
<tr>
  <td colspan="3"><table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:calibri; font-size:10pt; width:100%; border-collapse:collapse">
    <tr>
      <td colspan="6" style="border-top:0px solid #000; padding-left:10px">Periode Transaksi per Tanggal ........ s/d .........</td>
      </tr>
    <tr>
      <td width="260" style="border-top:1px solid #000; padding-left:10px">1.&nbsp;&nbsp;&nbsp;Tanggal Transaksi Input </td>
      <td width="20" style="border-top:1px solid #000; text-align:center">:</td>
      <td width="220" style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td width="220" style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td width="25" style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">a. Jenis Koreksi </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:15px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">b. Informasi Koreksi Nilai Barang </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6" style="border-top:1px solid #000">
        <table cellpadding="0" cellspacing="0" style=" width:100%; border-collapse:collapse; font-family:calibri; font-size:10pt">
          <tr style="text-align:center; font-weight:bold">
            <td width="50" style="border-bottom:0px solid #000">&nbsp;</td>
            <td width="30" style="border-left:1px solid #000; border-bottom:1px solid #000">No</td>
            <td width="275" style="border-left:1px solid #000; border-bottom:1px solid #000">Uraian</td>
            <td width="152" style="border-left:1px solid #000; border-bottom:1px solid #000">Sebelum (Rp)</td>
            <td width="152" style="border-left:1px solid #000; border-bottom:1px solid #000">Sesudah (Rp)</td>
            <td width="152" style="border-left:1px solid #000; border-bottom:1px solid #000">Selisih (Rp) </td>
            <td style="border-left:1px solid #000; border-bottom:0px solid #000">&nbsp;</td>
          </tr>
          <tr>
            <td style="border-bottom:0px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000; text-align:center">1.</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000; padding-left:3px">Masa Manfaat </td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:0px solid #000">&nbsp;</td>
          </tr>
          <tr>
            <td style="border-bottom:0px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000; text-align:center">2.</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000; padding-left:3px">Sisa Masa Manfaat </td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:0px solid #000">&nbsp;</td>
          </tr>
          <tr>
            <td style="border-bottom:0px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000; text-align:center">3.</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000; padding-left:3px">Nilai Perolehan (Rp) </td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:0px solid #000">&nbsp;</td>
          </tr>
          <tr>
            <td style="border-bottom:0px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000; text-align:center">4.</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000; padding-left:3px">Akumulasi Nilai Penyusutan (Rp) </td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:0px solid #000">&nbsp;</td>
          </tr>
          <tr>
            <td style="border-bottom:0px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000; text-align:center">5.</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000; padding-left:3px">Nilai Buku (Rp) </td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:0px solid #000">&nbsp;</td>
          </tr>
          <tr>
            <td style="">&nbsp;</td>
            <td style="border-left:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">c. Informasi Data Pencatatan Ganda </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">1) Kuasa Pengguna Barang Lainnya, Pangguna Barang Lainnya atau Pengelola Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">6) Spesifikasi Nama Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">2) Kode Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">7) Nilai Perolehan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">3) Kode Lokasi</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">8) Spesifikasi Data Laiinya</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">4) Kode Register Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">9). .................</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">5) Nama Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">10) .................</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">d. Informasi Koreksi Data Spesifikasi Barang Sebelum Koreksi</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:60px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">1) Lokasi </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">2) Data Spesifikasi Lainnya</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:60px">a. Provinsi</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">a) Luas / Ukuran </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:60px">b. Kabupaten/Kota</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">b. dst. </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    
    <tr>
      <td style="border-top:1px solid #000; padding-left:60px">c. Kecamatan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:60px">d. Kelurahan/Desa</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:60px">e. Jalan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:60px">f. RT/RW</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">e. Informasi Koreksi Lainnya</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">1) Alasan Koreksi Lainnya</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">3) Informasi Setelah Koreksi Lainnya</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">2) Informasi Sebelum Koreksi Lainnya</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:60px">a).</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:60px">a).</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:60px">b).</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:60px">b).</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">4) Informasi Nilai Koreksi Lainnnya</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6" style="border-top:1px solid #000">
	    <table align="center" cellpadding="0" cellspacing="0" style="width:90%; border-collapse:collapse; font-family:calibri; font-size:10pt">
          <tr style="text-align:center; font-weight:bold">
            <td width="30" style="border-left:1px solid #000; border-bottom:1px solid #000">No</td>
            <td width="275" style="border-left:1px solid #000; border-bottom:1px solid #000">Uraian</td>
            <td width="152" style="border-left:1px solid #000; border-bottom:1px solid #000">Sebelum (Rp)</td>
            <td width="152" style="border-left:1px solid #000; border-bottom:1px solid #000">Sesudah (Rp)</td>
            <td width="152" style="border-left:1px solid #000; border-bottom:1px solid #000; border-right:1px solid #000">Selisih (Rp) </td>
            </tr>
          <tr>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-bottom:1px solid #000; border-right:1px solid #000">&nbsp;</td>
            </tr>
          <tr>
            <td style="border-left:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000">&nbsp;</td>
            <td style="border-left:1px solid #000; border-right:1px solid #000">&nbsp;</td>
            </tr>
        </table>		</td>
      </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">f. Dokumen Sumber Reklasifikasi</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">g. Dokumen Pendukung Lainnya</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">Nama Dokumen</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">1) Nama Dokumen Pendukung Lainnya</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">a) Nomor </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:60px">a) Nomor </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">b) Tanggal </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:60px">b) Tanggal </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">2) dst.. </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">2. Tanggal Transaksi Input</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
  </table></td>
</tr>
<tr height="25">
  <td colspan="3" style="border-top:1px solid #000; border-bottom:1px solid #000; text-align:center; font-weight:bold; background:#ccc">X. INFORMASI PENAMBAHAN MASA MANFAAT ATAU KAPASITAS MANFAAT</td>
</tr>
<tr>
  <td colspan="3"><table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:calibri; font-size:10pt; width:100%; border-collapse:collapse">
    <tr>
      <td colspan="6" style="border-top:0px solid #000; padding-left:10px">Periode Transaksi per Tanggal ........ s/d .........</td>
      </tr>
    <tr>
      <td width="260" style="border-top:1px solid #000; padding-left:10px">1.&nbsp;&nbsp;&nbsp;Tanggal Transaksi Input </td>
      <td width="20" style="border-top:1px solid #000; text-align:center">:</td>
      <td width="220" style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td width="220" style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td width="20" style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">a. Data Barang Awal / Induk </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:15px">c. Nilai Barang Setelah Penambahan</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">1) Nilai Perolehan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">Biaya Perbaikan/Biaya Pengeluaran Setelah Perolehan</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">2) Jumlah Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">1) Nilai Perolehan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">3) Satuan Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">2) Jumlah Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">b. Informasi Nilai Biaya Perbaikan/Biaya Pengeluaran (Nilai Kapitalisasi)</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">3) Satuan Barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">1) Spesifikasi Nama Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">4) Harga Satuan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">2) Tanggal, Bulan, Tahun Perolehan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">3) Biaya Perbaikan/Biaya Pengeluaran/nilai kapitalisasi (Rp)</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">4) Jumlah Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:60px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:45px">5) Satuan Barang</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:60px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    
    
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">2. Tanggal Transaksi Input </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
  </table></td>
</tr>

<tr height="25">
  <td colspan="3" style="border-top:1px solid #000; border-bottom:1px solid #000; text-align:center; font-weight:bold; background:#ccc">XI. INFORMASI PENGHAPUSAN</td>
</tr>
<tr>
  <td colspan="3"><table border="0" align="center" cellpadding="0" cellspacing="0" style=" font-family:calibri; font-size:10pt; width:100%; border-collapse:collapse">
    <tr>
      <td colspan="6" style="border-top:0px solid #000; padding-left:10px">Periode Transaksi per Tanggal ........ s/d .........</td>
      </tr>
    <tr>
      <td width="260" style="border-top:1px solid #000; padding-left:10px">1.&nbsp;&nbsp;&nbsp;Tanggal Transaksi Input </td>
      <td width="20" style="border-top:1px solid #000; text-align:center">:</td>
      <td width="220" style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td width="220" style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td width="20" style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">a. Penyebab Penghapusan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:15px">j. SK Penghapusan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">b. Penerima Penyerahan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">1) Nomor </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">c. Jumlah </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">2) Tanggal </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">d. Satuan barang </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:15px">k. Dokumen Pendukung Lainnya </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">e. Nilai Perolehan </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">1) Nama Dokumen Pendukung Lainnya </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">f. Akumulasi nilai penyusutan</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">a) Nomor </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">g. Nilai Buku</td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">b) Tanggal </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">h. Cara Pemindahtanganan</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:30px">i. Jenis Penghapusan Karena Sebab Lain </td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">2) dst. </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">2. Tanggal Transaksi Input </td>
      <td style="border-top:1px solid #000; text-align:center">:</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:30px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000; padding-left:10px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000; border-right:1px solid #000">&nbsp;</td>
      <td style="border-top:1px solid #000; padding-left:45px">&nbsp;</td>
      <td style="border-top:1px solid #000; text-align:center">&nbsp;</td>
      <td style="border-top:1px solid #000">&nbsp;</td>
    </tr>
  </table></td>
</tr>
<tr height="20">
  <td colspan="3" style="border-top:1px solid #000; border-bottom:1px solid #000; text-align:center; font-weight:bold; background:#ccc">XIII. KETERANGAN</td>
</tr>
<tr>
  <td colspan="3" style="padding-left:30">1.</td>
</tr>
<tr>
  <td colspan="3" style="border-top:1px solid #000; padding-left:30">2.</td>
</tr>
<tr>
  <td colspan="3" style="border-top:1px solid #000">&nbsp;</td>
</tr>
</table>
