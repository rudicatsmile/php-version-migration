<?php
require('../Connection.php');
require('../FileFunction.php');
extract($_GET);

if ($fUpb=='00.00.00.00.00.000')
{
	if ($fSub=='00.00.00.00.00')
	{
		if ($fUnt=='00.00.00.00')
		{
			$fUnt = '__.__.__.__';
		}
		else
		{
			$fUnt = $fUnt;
		}
	}
	else
	{
		$fUnt = $fSub;
	}
}
else
{
	$fUnt = $fUpb;
}

require('Report_LHI_III_Config.php');
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:2450px; font-family:calibri; text-align:center; font-weight:bold; font-size:11pt">
<tr>
  	<td style="text-align:right">Format : III.B.11&nbsp;</td>
</tr>
<tr>
  	<td>LAPORAN HASIL INVENTARISASI (LHI)</td>
</tr>
<tr>
  	<td>REKAPITULASI BMD BELUM TERCATAT</td>
</tr>
<tr>
  	<td><?=$NmA?></td>
</tr>
<tr>
	<td><?=$TiDaer." ".$NmDaer?></td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
</table>
<?php
$tWide = 2450;
require('Report_LHI_III_Head.php');
?>
<table align="center" cellpadding="0" cellspacing="0" border="0" width="2450" style="border-collapse:collapse; font-family:calibri; font-size:9pt">
<tr height="20" style="text-align:center; font-weight:bold">
	<td rowspan="2" style="border:1px solid #000">No.</td>
	<td rowspan="2" style="border:1px solid #000">Kode Barang</td>
	<td rowspan="2" style="border:1px solid #000">Nama Barang</td>
	<td rowspan="2" style="border:1px solid #000">Nama Spesifikasi Barang</td>
	<td rowspan="2" style="border:1px solid #000">Kode Register </td>
	<td rowspan="2" style="border:1px solid #000">Merk/Tipe</td>
	<td rowspan="2" style="border:1px solid #000">Nomor Polisi</td>
	<td rowspan="2" style="border:1px solid #000">Nomor Rangka</td>
	<td rowspan="2" style="border:1px solid #000">Nomor Mesin</td>
	<td rowspan="2" style="border:1px solid #000">Jumlah</td>
	<td rowspan="2" style="border:1px solid #000">Satuan Barang</td>
	<td rowspan="2" style="border:1px solid #000">Harga Satuan<br>Barang (Rp)</td>
	<td rowspan="2" style="border:1px solid #000">Nilai Perolehan<br>Barang (Rp)</td>
	<td rowspan="2" style="border:1px solid #000">Tanggal, Bulan, Tahun Perolehan</td>
	<td rowspan="2" style="border:1px solid #000">Alamat</td>
	<td rowspan="2" style="border:1px solid #000">Dasar Perolehan </td>
	<td colspan="3" style="border:1px solid #000">Kondisi Barang</td>
	<td rowspan="2" style="border:1px solid #000">Keterangan</td>
    <td width="120" rowspan="2" style="border:1px solid #000">Petugas Sensus</td>
</tr>
<tr height="20" style="text-align:center; font-weight:bold">
  <td style="border:1px solid #000">B</td>
  <td style="border:1px solid #000">RR</td>
  <td style="border:1px solid #000">RB</td>
</tr>

<tr height="20" style="text-align:center">
  <td width="30" style="border:1px solid #000">1</td>
  <td width="100" style="border:1px solid #000">2</td>
  <td width="180" style="border:1px solid #000">3</td>
  <td width="180" style="border:1px solid #000">4</td>
  <td width="75" style="border:1px solid #000">5</td>
  <td width="120" style="border:1px solid #000">6</td>
  <td width="100" style="border:1px solid #000">7</td>
  <td width="150" style="border:1px solid #000">8</td>
  <td width="150" style="border:1px solid #000">9</td>
  <td width="40" style="border:1px solid #000">10</td>
  <td width="100" style="border:1px solid #000">11</td>
  <td width="110" style="border:1px solid #000">12</td>
  <td width="110" style="border:1px solid #000">13</td>
  <td width="70" style="border:1px solid #000">14</td>
  <td width="200" style="border:1px solid #000">15</td>
  <td width="200" style="border:1px solid #000">16</td>
  <td width="50" style="border:1px solid #000">17</td>
  <td width="50" style="border:1px solid #000">18</td>
  <td width="50" style="border:1px solid #000">19</td>
  <td style="border:1px solid #000">20</td>
  <td width="120" style="border:1px solid #000">21</td>
</tr>
<?php
$iG=1;
$mRo7 = 0;
$mRo9 = 0;


$nSQ = "SELECT 
'' as A0,
Referensi as A1,
KdBarang as A2,
NmBarang as A3,
NmBarang_Spec as A4,
KdRegister as A5,
concat('Merk : ',Merk, '<br>Tipe : ', Type) as A6,

NoPolisi as A7,
NoRangka as A8,
NoMesin as A9,

JmlBarang as A10,
SatuanBarang as A11,
HargaSatuan as A12,
NilaiPerolehan as A13,

TglPerolehan as A14,

Alamat as A15,
DasarPencatatan as A16,
KondisiBarang as A17,
'' as A18,
'' as A19,
Keterangan as A20,

PetugasSensus_1 as A21,
PetugasSensus_2 as A22,
PetugasSensus_3 as A23,
PetugasSensus_4 as A24 

FROM tb_lembar_kerja_belum_tercatat 
WHERE KdUPB LIKE '".$fUnt."%' AND KdBarang LIKE '".$AsT.".%' AND DataSensusFix LIKE '%' 
ORDER BY Referensi";
#echo $nSQ;
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$Ptg  = "";
	$Ptg1 = $mRo[21];
	$Ptg2 = $mRo[22];
	$Ptg3 = $mRo[23];
	$Ptg4 = $mRo[24];
	if ($Ptg1!=''){$Ptg = fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$Ptg1,"=","","");}
	if ($Ptg2!=''){$Ptg.= '<br>'.fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$Ptg2,"=","","");}
	if ($Ptg3!=''){$Ptg.= '<br>'.fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$Ptg3,"=","","");}
	if ($Ptg4!=''){$Ptg.= '<br>'.fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$Ptg4,"=","","");}
	
	$t17 = "";
	$t18 = "";
	$t19 = "";
	$Kon = $mRo[17];
	$tIMG = "<img src='../css/images/newokey.gif' style='width:12px; height:12px'/>";
	if ($Kon=='B') {$t17 = $tIMG;}
	if ($Kon=='RR'){$t18 = $tIMG;}
	if ($Kon=='RB'){$t19 = $tIMG;}
	?>
	<tr height="22">
	  <td style="border:1px solid #000; text-align:center"><?=$iG?>.</td>
	  <td style="border:1px solid #000; text-align:center"><?=$mRo[2]?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$mRo[3]?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$mRo[4]?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$mRo[5]?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$mRo[6]?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$mRo[7]?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$mRo[8]?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$mRo[9]?></td>
	  <td style="border:1px solid #000; text-align:center"><?=$mRo[10]?></td>
	  <td style="border:1px solid #000; text-align:center"><?=$mRo[11]?></td>
	  <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=$mRo[12]?></td>
	  <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[13])?></td>
	  <td style="border:1px solid #000; text-align:center"><?=fConvertDateShort($mRo[14])?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$mRo[15]?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$mRo[16]?></td>
	  <td style="border:1px solid #000; text-align:center"><?=$t17?></td>
	  <td style="border:1px solid #000; text-align:center"><?=$t18?></td>
	  <td style="border:1px solid #000; text-align:center"><?=$t19?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$mRo[20]?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$Ptg?></td>
	</tr>
	<?php
	$iG++;
	$mRo10 = $mRo10 + $mRo[10];
	$mRo13 = $mRo13 + $mRo[13];
}
?>
<?php if ($iG==1){?>
<tr height="22">
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
</tr>
<?php } ?>
<tr height="26" style="text-align:center; font-weight:bold">
  <td colspan="9" style="border:1px solid #000">Jumlah</td>
  <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo10)?></td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
  <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo13)?></td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
</tr>
</table>
<table align="center" cellpadding="0" cellspacing="0" border="0" width="2450" style="font-family:calibri; font-size:10pt">
  <tr>
    <td width="481">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="481">&nbsp;</td>
  </tr>
  <tr height="20">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr height="20">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><?=$NmIbuk?>, <?=$fHR." ".fNmBulan((int)$fBL)." ".$fTH?></td>
  </tr>
  
  <tr height="20">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">Pengguna Barang, </td>
  </tr>
  <tr height="70">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php
  $Nma = fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit",substr($fUnt,0,11),"=","","");
  $LeN = strlen($Nma);
  #echo $LeN."<br>";
  
  $TxT = 0;
  if ($LeN < 45){
  	$TxT = (45-$LeN)/2;
  }
  $TxT = (int)$TxT;
  #echo $TxT."<br>";
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" style="font-weight:bold; text-decoration:underline"><?=str_repeat('&nbsp;',$TxT)?><?=fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit",substr($fUnt,0,11),"=","","")?><?=str_repeat('&nbsp;',$TxT)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">NIP. <?=fGlobal("Nip_Pimpinan","ref_unit","Kd_Unit",substr($fUnt,0,11),"=","","")?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
