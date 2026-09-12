<?php
require "../../connfile.php";
require "../../configfile.php";
require "../../functionfile.php";
extract($_GET);
#echo $IdT;

$BiD = "";
$Ref = "";
$ReD = "";
$KdP = "";
$DtA = fGlobal("Kd_Bidang:Referensi:ReferensiDetail:Kd_Persediaan:ExpiredDate","tb_pengadaan_rinci_data","idt",$IdT,"=","",DatabaseSA,$ConSA,"");
if ($DtA)
{
	$DtA = explode(':',$DtA);
	$BiD = $DtA[0];
	$Ref = $DtA[1];
	$ReD = $DtA[2];
	$KdP = $DtA[3];
	$TeD = $DtA[4];
	if ($TeD!='3000-01-01' && $TeD!='0000-00-00')
	{
		$TeD = fConvertDateShort($TeD);
	}
	else
	{
		$TeD = "-";
	}
	$DtB = fGlobal("tanggal:nomor","tb_pengadaan","referensi",$Ref,"=","",DatabaseSA,$ConSA,"");
	$DtB = explode(':',$DtB);
	$TgL = $DtB[0];
	
	$NmA = fGlobal("Nm_Rek","ref_rek_90_8_persediaan","Kd_Rek",$KdP,"=","",DatabaseSA,$ConSA,"");
	$NmO = fGlobal("Nm_Rek","ref_rek_90_7_persediaan","Kd_Rek",substr($KdP,0,19),"=","",DatabaseSA,$ConSA,"");
  
	$DtC = fGlobal("Bidang:Nm_Kepala:Nip_Kepala:Nm_Pengurus:Nip_Pengurus:Jbt_Pengurus:Nm_Penyimpan:Nip_Penyimpan:Jbt_Penyimpan:Jbt_Kepala:Alamat","tb_bidang","kode",$BiD,"=","",DatabaseSA,$ConSA,"");
	$DtC = explode(':',$DtC);
	$SkP = $DtC[0];
	$NmP = $DtC[1];
	$AlM = $DtC[10];
	$NmG = $DtC[3];
	$NiG = $DtC[4];
	$NmK = fGlobal("Nm_Kepala","tb_bidang","kode","24.04.04.01","=","",DatabaseSA,$ConSA,"");
	
}
?> 
<body>
<table border="0" width="700" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td width="567"></td>
    <td width="131" style="text-align:right; font-size:11pt; font-weight:bold">Format II.A.1</td>
  </tr>
</table>
<table border="0" width="700" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #000; border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td colspan="7" style="text-align:center; font-size:10pt; font-weight:bold; font-family:verdana">FORMULIR PEROLEHAN / PENERIMAAN BMD </td>
  </tr>
  <tr>
    <td colspan="7" style="text-align:center; font-size:10pt; font-weight:bold; font-family:verdana">ASET LANCAR BERUPA PERSEDIAAN </td>
  </tr>
  <tr>
    <td colspan="7" style="text-align:center; font-size:10pt; font-weight:bold; font-family:verdana"> PENGGUNA BARANG</td>
  </tr>
  <tr>
    <td colspan="7" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">SKPD : <?=$SkP?></td>
  </tr>
  <tr>
    <td colspan="7" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">PEMERINTAH <?=strtoupper($NmTING." ".$NmDAER)?></td>
  </tr>
  <tr>
    <td colspan="7" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">TAHUN <?=substr($TgL,0,4)?></td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr height="22">
    <td width="19">&nbsp;</td>
    <td width="26" style="font-weight:bold">I.</td>
    <td colspan="2" style="font-weight:bold">Unit Pemakai </td>
    <td width="22">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="23">a.</td>
    <td width="224">Kuasa Pengguna Barang </td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>b.</td>
    <td>Pengguna Barang </td>
    <td>:</td>
    <td colspan="2"><?=$NmP?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>c.</td>
    <td>Pengelola Barang </td>
    <td>:</td>
    <td colspan="2"><?=$NmK?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>d.</td>
    <td>Alamat</td>
    <td>:</td>
    <td colspan="2"><?=$AlM?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="font-weight:bold">II.</td>
    <td colspan="2" style="font-weight:bold">Data Barang</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>a.</td>
    <td>Kode Barang </td>
    <td>:</td>
    <td colspan="2"><?=substr($KdP,0,19)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>b.</td>
    <td>Kode Lokasi </td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>c.</td>
    <td>Kode Register Barang </td>
    <td>:</td>
    <td colspan="2"><?=substr($KdP,-5,5)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>d.</td>
    <td>Nama Barang </td>
    <td>:</td>
    <td colspan="2"><?=$NmA?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>e.</td>
    <td>Spesifikasi Nama Barang </td>
    <td>:</td>
    <td colspan="2"><?=LoadJenis($NmO).$NmA?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>f.</td>
    <td>NUSP</td>
    <td>:</td>
    <td colspan="2"><?=$KdP?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>g.</td>
    <td>Merk</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>h.</td>
    <td>Tanggal, Bulan, Tahun Kadaluarsa </td>
    <td>:</td>
    <td colspan="2"><?=$TeD?></td>
  </tr>
  <?php
  $Jb1="checked";
  $Jb2="";
  $Jb3="";
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>i.</td>
    <td>Kondisi Barang </td>
    <td><?=TChek($Jb1,'','25')?></td>
    <td colspan="2">1. Baik </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?=TChek($Jb2,'','25')?></td>
    <td colspan="2">2. Rusak Ringan </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?=TChek($Jb3,'','25')?></td>
    <td colspan="2">3. Rusak Berat atau Usang </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>j.</td>
    <td>Lokasi</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Provinsi</td>
    <td>:</td>
    <td colspan="2"><?=$NmPROV?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Kabupaten / Kota</td>
    <td>:</td>
    <td colspan="2"><?=$NmKNTR?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Kecamatan</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Kelurahan / Desa</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Jalan</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>RT / RW</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>k.</td>
    <td>Spesifikasi Lainnya</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>1. - </td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>2. -</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="font-weight:bold">III.</td>
    <td colspan="2" style="font-weight:bold">Informasi Perolehan / Penerimaan Barang</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <?php
  $Jn1 = "checked";
  $Jn2 = "";
  $Jn3 = "";
  $Jn4 = "";
  $Jn5 = "";
  $Jn6 = "";
  $Jn7 = "";
  $Jn8 = "";
  $Jn9 = "";
  $Jn10= "";
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Cara Perolehan / Penerimaan</td>
    <td><?=TChek($Jn1,'','25')?></td>
    <td width="24">1.</td>
    <td width="360">Pengadaan Barang yang dibeli atau diperoleh atas beban APBD;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?=TChek($Jn2,'','25')?></td>
    <td>2.</td>
    <td>Hibah/sumbangan atau yang sejenis;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?=TChek($Jn3,'','25')?></td>
    <td>3.</td>
    <td>Pelaksanaan dari perjanjian / Kontrak;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?=TChek($Jn4,'','25')?></td>
    <td>4.</td>
    <td>Ketentuan Peraturan Perundang-undangan;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?=TChek($Jn5,'','25')?></td>
    <td>5.</td>
    <td>Putusan Pengadilan;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?=TChek($Jn6,'','25')?></td>
    <td>6.</td>
    <td>Divestasi;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?=TChek($Jn7,'','25')?></td>
    <td>7.</td>
    <td>Hasil Inventarisasi;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?=TChek($Jn8,'','25')?></td>
    <td>8.</td>
    <td>Hasil tukar menukar;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?=TChek($Jn9,'','25')?></td>
    <td>9.</td>
    <td>Pembatalan penghapusan; atau</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?=TChek($Jn10,'','25')?></td>
    <td>10</td>
    <td>Perolehan/Penerimaan Lainnya.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="font-weight:bold">IV.</td>
    <td colspan="2" style="font-weight:bold">Keterangan Tambahan</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Diinput Oleh </td>
    <td>:</td>
    <td colspan="2">Pengurus Barang Pengguna</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Nama</td>
    <td>:</td>
    <td colspan="2"><?=$NmG?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">NIP</td>
    <td>:</td>
    <td colspan="2"><?=$NiG?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
</table>
