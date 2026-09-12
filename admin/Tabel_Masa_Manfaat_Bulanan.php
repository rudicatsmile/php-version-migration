<?php
require "Connection.php";
require "FileFunction.php";

$Ref = $_GET['ref'];
$upb = $_GET['upb'];
$rTH = $_GET['rTH'];

$DTA = fGlobalNEW("Kd_Aset_108:Kd_UPB","ta_kib_post_108","Referensi:Kd_UPB",$Ref.":".$upb."%","=:LIKE","",DatabaseSB,$ConSB,"");
if ($DTA==""){$DTA = fGlobalNEW("Kd_Aset_108:Kd_UPB","ta_kib_post_108_mutasi","Referensi:Kd_UPB",$Ref.":".$upb."%","=:LIKE","",DatabaseSB,$ConSB,"");}
if ($DTA){
	$DTA = explode(":",$DTA);
	$KdA = $DTA[0];
	$KdU = $DTA[1];
}

$gUnt  = substr($KdU,0,11);
$frHri = date('d');
$frBln = date('m');
$frThn = date('Y');
$TgM = fGlobalNEW("Tgl_Mutasi","ta_kib_108","Referensi:Kd_UPB",$Ref.":".$upb."%","=:LIKE","",DatabaseSB,$ConSB,"");
$TgP = fGlobalNEW("Tgl_Perolehan","ta_kib_108","Referensi:Kd_UPB",$Ref.":".$upb."%","=:LIKE","",DatabaseSB,$ConSB,"");
?>
<table border="0" align="center" width="1330" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td style="font-size: 12pt; font-weight: bold" align="center">TABEL PENYUSUTAN &amp; MASA MANFAAT </td>
</tr>
<tr>
  <td style="font-size: 11pt; font-weight: bold" align="center">UNIT KERJA : <?=strtoupper(fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",substr($KdU,0,11),"=","",DatabaseSB,$ConSB,""))?></td>
</tr>
<tr>
  <td style="font-size: 10pt; font-weight: bold" align="center">PER 31 DESEMBER <?=$rTH?></td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
</table>
<table border="0" align="center" width="1340" cellspacing="1" style="font-size: 8pt; font-weight:bold; font-family: Calibri; border-collapse: collapse">
<tr>
  <td width="69">BIDANG</td>
  <td width="13">:</td>
  <td width="394"><?=substr($KdA,0,5)?>&nbsp;-&nbsp;<?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset",substr($KdA,0,5),"=","",DatabaseSB,$ConSB,""))?></td>
  <td width="105">REFERENSI</td>
  <td width="19">:</td>
  <td><?=$Ref?></td>
</tr>
<tr>
  <td>KELOMPOK</td>
  <td>:</td>
  <td><?=substr($KdA,0,8)?>&nbsp;-&nbsp;<?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_4","Kd_Aset",substr($KdA,0,8),"=","",DatabaseSB,$ConSB,""))?></td>
  <td>NAMA BARANG</td>
  <td>:</td>
  <td><?=fGlobalNEW("nm_aset","ta_kib_108","Referensi",$Ref,"=","",DatabaseSB,$ConSB,"")?></td>
</tr>
<tr>
  <td>JENIS</td>
  <td>:</td>
  <td><?=substr($KdA,0,11)?>&nbsp;-&nbsp;<?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_5","Kd_Aset",substr($KdA,0,11),"=","",DatabaseSB,$ConSB,""))?></td>
  <td>UMUR EKONOMIS</td>
  <td>:</td>
  <td><?=findMasaManfaat($KdA,DatabaseSB,$ConSB)?> TAHUN</td>
</tr>
<tr>
  <td>OBJEK</td>
  <td>:</td>
  <td><?=substr($KdA,0,14)?>&nbsp;-&nbsp;<?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_6","Kd_Aset",substr($KdA,0,14),"=","",DatabaseSB,$ConSB,""))?></td>
  <td>TANGGAL PEROLEHAN </td>
  <td>:</td>
  <td><?php if ($TgP!='0000-00-00') {echo fConvertDateShort($TgP);} else {echo '-';}?></td>
</tr>
<tr>
  <td>RINCIAN</td>
  <td>:</td>
  <td><?=substr($KdA,0,18)?>&nbsp;-&nbsp;<?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_7","Kd_Aset",substr($KdA,0,18),"=","",DatabaseSB,$ConSB,""))?></td>
  <td>TANGGAL MUTASI </td>
  <td>:</td>
  <td><?php if ($TgM!='0000-00-00') {echo fConvertDateShort($TgM);} else {echo '-';}?></td>
</tr>

<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td colspan="4">&nbsp;</td>
</tr>
</table>
<!--###-->
<table border="0" align="center" width="1330" cellspacing="0" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td width="25" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">No</td>
  <td width="50" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Tahun<br>Pelaporan</td>
  <td width="50" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Tahun<br>Awal</td>
  <td width="50" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Keadaan<br>Barang</td>
  <td width="90" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Harga</td>
  <td width="100" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Nilai<br>Perolehan</td>
  <td width="60" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Kode<br>Umur</td>
  <td width="30" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Rank</td>
  <td width="50" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Tahun<br>Akhir</td>
  <td width="54" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Prosentase<br>Atribusi<br>(%)</td>
  <td width="54" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Prosentase<br>Overhoul<br>( % )</td>
  <td colspan="5" style="text-align:center; font-weight:bold; border:1px #000000 solid">( Bulan )</td>
  <td width="100" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Nilai<br>Buku Awal</td>
  <td width="100" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Nilai<br>Penyusutan</td>
  <td width="100" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Nilai<br>Akumulasi<br>Penyusutan </td>
  <td rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Nilai<br>Buku Akhir</td>
</tr>
<tr>
  <td width="50" style="text-align:center; font-weight:bold; border:1px #000000 solid">Masa<br>Manfaat</td>
  <td width="50" style="text-align:center; font-weight:bold; border:1px #000000 solid">Umur<br>Bertambah</td>
  <td width="50" style="text-align:center; font-weight:bold; border:1px #000000 solid">Umur<br>Awal</td>
  <td width="50" style="text-align:center; font-weight:bold; border:1px #000000 solid">Umur Telah Dilalui</td>
  <td width="50" style="text-align:center; font-weight:bold; border:1px #000000 solid">Sisa<br>Umur</td>
</tr>

<tr height="20" style="background:#CCCCFF">
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">1</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">2</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">3</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">4</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">5</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">6</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">7</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">8</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">9</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">10</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">11</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">12</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">13</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">14</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">15</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">16</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">17</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">18</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">19</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">20</td>
</tr>
<?php
$iG=1;
$yCL4  = 0;
$yCL6  = 0;
$yCL8h = 0;
$yCL11 = 0;
$yCL11h= 0;
$yCL12 = 0;
$yCL13 = 0;
$yCL14 = 0;

$nSQ ="SELECT IDT as A0,
Referensi as A1,
PerLap as A2,
Tahun as A3,
'Baik' as A4,
Harga as A5,
Nilai_Perolehan as A6,
Kd_Aset_108 as A7,
IndexData as A8,
Tahun_Akhir as A9,
Prosentase_Awal as A10,
Prosentase as A11,
Umur as A12,
Umur_Tambah as A13,
Umur_Awal as A14,
Umur_Terpakai as A15,
Umur_Sisa as A16,
Nilai_Buku_Awal as A17,
Penyusutan as A18,
Penyusutan_Akumulasi as A19,
Nilai_Buku_Akhir as A20,
Uraian as A21,
Kd_Umur as A22 
FROM ta_kib_post_penyusutan_108 WHERE Referensi = '$Ref' AND PerLap <='$rTH' ORDER BY IndexData";

$nSQ ="SELECT IDT as A0,
Referensi as A1,
PerLap as A2,
Tahun as A3,
'Baik' as A4,
Harga as A5,
Nilai_Perolehan as A6,
Kd_Aset_108 as A7,
IndexData as A8,
Tahun_Akhir as A9,
Prosentase_Awal as A10,
Prosentase as A11,
Umur as A12,
Umur_Tambah as A13,
Umur_Awal as A14,
Umur_Terpakai as A15,
Umur_Sisa as A16,
Nilai_Buku_Awal as A17,
Penyusutan as A18,
Penyusutan_Akumulasi as A19,
Nilai_Buku_Akhir as A20,
Uraian as A21,
Kd_Umur as A22 
FROM ta_kib_post_penyusutan_108 WHERE Referensi = '$Ref' AND PerLap <='$rTH' ORDER BY IndexData";
#echo $nSQ;
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	?>
	<tr height="25">
	  <td style="text-align:center; border:1px #000000 solid"><?=$iG?></td>
	  <td style="text-align:center; border:1px #000000 solid; font-weight:bold"><?=$mRo[2]?></td>
	  <td style="text-align:center; border:1px #000000 solid"><?=$mRo[3]?></td>
	  <td style="text-align:center; border:1px #000000 solid"><?=$mRo[4]?></td>
	  <td style="text-align:right; border:1px #000000 solid; padding-right:2px"><?=fConvertToRupiahBulat($mRo[5])?></td>
	  <td style="text-align:right; border:1px #000000 solid; padding-right:2px"><?=fConvertToRupiahBulat($mRo[6])?></td>
	  <td style="text-align:center; border:1px #000000 solid"><?=substr($mRo[7],0,11)?></td>
	  <td style="text-align:center; border:1px #000000 solid"><?=$mRo[8]?></td>
	  <td style="text-align:center; border:1px #000000 solid"><?=$mRo[9]?></td>
	  <td style="text-align:right; border:1px #000000 solid; text-align:center"><?php if ($mRo[10]>0) {echo fConvertToRupiahBulat($mRo[10]);} else {echo "-";}?></td>
	  <td style="text-align:right; border:1px #000000 solid; text-align:center"><?php if ($mRo[11]>0) {echo fConvertToRupiahBulat($mRo[11]);} else {echo "-";}?></td>
	  <td style="text-align:center; border:1px #000000 solid"><?=$mRo[12]?></td>
	  <td style="text-align:center; border:1px #000000 solid"><?php if ($mRo[13]>0) {echo $mRo[13];} else {echo "-";}?></td>
	  <td style="text-align:center; border:1px #000000 solid"><?php if ($mRo[14]>0) {echo $mRo[14];} else {echo "-";}?></td>
	  <td style="text-align:center; border:1px #000000 solid"><?php if ($mRo[15]>0) {echo $mRo[15];} else {echo "-";}?></td>
	  <td style="text-align:center; border:1px #000000 solid"><?php if ($mRo[16]>0) {echo $mRo[16];} else {echo "-";}?></td>
	  <td style="text-align:right; border:1px #000000 solid; padding-right:2px"><?=fConvertToRupiahBulat($mRo[17])?></td>
	  <td style="text-align:right; border:1px #000000 solid; padding-right:2px"><?=fConvertToRupiahBulat($mRo[18])?></td>
	  <td style="text-align:right; border:1px #000000 solid; padding-right:2px"><?=fConvertToRupiahBulat($mRo[19])?></td>
	  <td style="text-align:right; border:1px #000000 solid; padding-right:2px"><?=fConvertToRupiahBulat($mRo[20])?></td>
  </tr>

	<?php
	$tRo5 = $tRo5 + $mRo[5];
	$tRo6 = $mRo[6];
	$tRo15= $tRo15 + $mRo[15];
	$tRo16= $mRo[16];
	$tRo18= $tRo18 + $mRo[18];
	$mRo18= $mRo[18];
	$tRo19= $mRo[19];
	$tRo20= $mRo[20];
	
	$mRo18 = $mRo[18];
	$iG++;
}
?>
<tr height="30">
  <td colspan="4" style="text-align:center; font-weight:bold; border:1px #000000 solid; border-top:3px #000000 double">T O T A L</td>
  <td style="font-weight:bold; text-align:right; border:1px #000000 solid; border-top:3px #000000 double; padding-right:2px"><?=fConvertToRupiahBulat($tRo5)?></td>
  <td style="font-weight:bold; text-align:right; border:1px #000000 solid; border-top:3px #000000 double; padding-right:2px"><?=fConvertToRupiahBulat($tRo6)?></td>
  <td colspan="8" style="font-weight:bold; text-align:center; border:1px #000000 solid; border-top:3px #000000 double">&nbsp;</td>
  <td style="font-weight:bold; text-align:center; border:1px #000000 solid; border-top:3px #000000 double"><?php if ($tRo15>0) {echo $tRo15;} else {echo "-";}?></td>
  <td style="font-weight:bold; text-align:center; border:1px #000000 solid; border-top:3px #000000 double"><?php if ($tRo16>0) {echo $tRo16;} else {echo "-";}?></td>
  <td style="font-weight:bold; text-align:right; border:1px #000000 solid; border-top:3px #000000 double; padding-right:2px">-</td>
  <td style="font-weight:bold; text-align:right; border:1px #000000 solid; border-top:3px #000000 double; padding-right:2px"><!--?=fConvertToRupiahBulat($mRo18)?-->-</td>
  <td style="font-weight:bold; text-align:right; border:1px #000000 solid; border-top:3px #000000 double; padding-right:2px"><?=fConvertToRupiahBulat($tRo19)?></td>
  <td style="font-weight:bold; text-align:right; border:1px #000000 solid; border-top:3px #000000 double; padding-right:2px"><?=fConvertToRupiahBulat($tRo20)?></td>
</tr>
</table>
<table border="0" align="center" width="1340" cellspacing="1" style="font-size: 8pt; font-family: Calibri; font-style:italic; border-collapse: collapse">
<tr>
  <td valign="top">REF: <?=$Ref?></td>
</tr>
</table>
<table border="0" align="center" width="1340" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td valign="top" width="400">
	<table border="0" align="center" width="400" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse">
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td width="24">a.</td>
	  <td width="204"> Nilai Perolehan</td>
	  <td width="18">=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tRo5)?></td>
	  </tr>
	<tr>
	  <td>b.</td>
	  <td>Beban Penyusutan Tahun <?=$rTH?></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($mRo18)?></td>
	  </tr>
	<tr>
	  <td>c.</td>
	  <td>Koreksi di LPE </td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tRo18-$mRo18)?></td>
	  </tr>
	<tr>
	  <td>d.</td>
	  <td>Akumulasi Penyusutan <i>( b + c )</i></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tRo18)?></td>
	  </tr>
	<tr>
	  <td>e.</td>
	  <td>Nilai Akhir Buku <i>( a - d )</td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tRo5-$tRo18)?></td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	</table>
  </td>
  <td width="40">&nbsp;</td>
  <td><?php require "Lap_Bottom.php"?></td>
</tr>
</table>
