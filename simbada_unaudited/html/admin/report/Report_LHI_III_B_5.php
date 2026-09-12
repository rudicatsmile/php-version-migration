<?
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
<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:2250px; font-family:calibri; text-align:center; font-weight:bold; font-size:11pt">
<tr>
  	<td style="text-align:right">Format : III.B.5&nbsp;</td>
</tr>
<tr>
  	<td>LAPORAN HASIL INVENTARISASI (LHI)</td>
</tr>
<tr>
  	<td>REKAPITULASI BMD DALAM DIGUNAKAN OLEH PEGAWAI PEMERINTAH DAERAH YANG BERSANGKUTAN</td>
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
<?
$tWide = 2250;
require('Report_LHI_III_Head.php');
?>
<table align="center" cellpadding="0" cellspacing="0" border="0" width="2250" style="border-collapse:collapse; font-family:calibri; font-size:9pt">
<tr height="18" style="text-align:center; font-weight:bold">
	<td rowspan="3" style="border:1px solid #000">No.</td>
	<td rowspan="3" style="border:1px solid #000">NIBAR</td>
	<td rowspan="3" style="border:1px solid #000">Kode Register</td>
	<td rowspan="3" style="border:1px solid #000">Kode Barang</td>
	<td rowspan="3" style="border:1px solid #000">Nama Barang</td>
	<td rowspan="3" style="border:1px solid #000">Nama Spesifikasi Barang</td>
	<td rowspan="3" style="border:1px solid #000">Merk/Tipe</td>
	<td rowspan="3" style="border:1px solid #000">Jumlah</td>
	<td rowspan="3" style="border:1px solid #000">Satuan Barang</td>
	<td rowspan="3" style="border:1px solid #000">Nilai Perolehan<br>Barang (Rp)</td>
	<td rowspan="3" style="border:1px solid #000">Alamat</td>
	<td colspan="6" style="border:1px solid #000">Pemakai</td>
	<td rowspan="3" style="border:1px solid #000">Keterangan</td>
    <td rowspan="3" style="border:1px solid #000">Petugas Sensus</td>
</tr>
<tr height="18" style="text-align:center; font-weight:bold">
  <td rowspan="2" style="border:1px solid #000">Nama Pemakai</td>
  <td rowspan="2" style="border:1px solid #000">Status Pemakai</td>
  <td colspan="2" style="border:1px solid #000">BAST Pemakaian</td>
  <td colspan="2" style="border:1px solid #000">Surat Izin Penghunian </td>
  </tr>
<tr height="18" style="text-align:center; font-weight:bold">
  <td style="border:1px solid #000">Ada</td>
  <td style="border:1px solid #000">Tidak Ada </td>
  <td style="border:1px solid #000">Ada</td>
  <td style="border:1px solid #000">Tidak Ada</td>
</tr>
<tr height="18" style="text-align:center">
  <td width="30" style="border:1px solid #000">1</td>
  <td width="100" style="border:1px solid #000">2</td>
  <td width="60" style="border:1px solid #000">3</td>
  <td width="100" style="border:1px solid #000">4</td>
  <td width="200" style="border:1px solid #000">5</td>
  <td width="200" style="border:1px solid #000">6</td>
  <td width="120" style="border:1px solid #000">7</td>
  <td width="40" style="border:1px solid #000">8</td>
  <td width="100" style="border:1px solid #000">9</td>
  <td width="110" style="border:1px solid #000">10</td>
  <td width="200" style="border:1px solid #000">11</td>
  <td width="180" style="border:1px solid #000">12</td>
  <td width="180" style="border:1px solid #000">13</td>
  <td width="60" style="border:1px solid #000">14</td>
  <td width="60" style="border:1px solid #000">15</td>
  <td width="60" style="border:1px solid #000">16</td>
  <td width="60" style="border:1px solid #000">17</td>
  <td style="border:1px solid #000">18</td>
  <td width="150" style="border:1px solid #000">19</td>
</tr>
<?
$iG=1;
$mRo7 = 0;
$mRo9 = 0;


$nSQ = "SELECT 
'' as A0,
P1.Referensi as A1,
P2.No_Register as A2,
P2.Kd_Aset_108 as A3,
'' as A4,
P2.Nm_Aset as A5,
concat('Merk : ',P2.Merk, '<br>Tipe : ',P2.Type) as A6,
KeberadaanBarang_tidakada_jmlh as A7,
SatuanBarang as A8,
ifnull(sum(P3.Debet),0) as A9,
P1.Keterangan as A10,

P1.PetugasSensus_1 as A11,
P1.PetugasSensus_2 as A12,
P1.PetugasSensus_3 as A13,
P1.PetugasSensus_4 as A14,

P2.Alamat as A15,
P2.Lokasi as A16,

P1.PenggunaanBarang as A17,
P5.PD_NmKuasaPenggunaLainnya as A18,
P5.PD_NmPemakai as A19,
P5.PD_StatusPemakai as A20,
P5.PD_BastPemakaian as A21,
P5.PD_SuratIzin as A22 

FROM tb_lembar_kerja P1 
LEFT JOIN ta_kib_108_sensus_2023 P2 ON P2.Referensi=P1.Referensi AND P2.Ref_Group=P1.RefGroup AND P2.Kd_UPB=P1.KdUPB 
LEFT JOIN ta_kib_post_108_sensus_2023 P3 ON P3.Referensi=P2.Referensi AND P3.Kd_UPB=P2.Kd_UPB 
LEFT JOIN tb_lembar_kerja_merupakan_biaya_atribusi P4 ON P4.Referensi=P1.Referensi AND P4.KdUPB=P1.KdUPB 
LEFT JOIN tb_lembar_kerja_penggunaan P5 ON P5.Referensi=P1.Referensi AND P5.KdUPB=P1.KdUPB 
WHERE P1.KdUPB LIKE '".$fUnt."%' AND P2.Tgl_Perolehan NOT LIKE '2023-%' AND P2.Kd_Aset_108 LIKE '".$AsT.".%' 
AND P1.KondisiBarangAsal LIKE '".$KoNA."' AND P1.KondisiBarang LIKE '".$KoNB."' 

AND KeberadaanBarang='ada' 
AND P1.MerupakanAtribusi like '%' 
AND P1.DataSensusFix='Y' 

GROUP BY P1.Referensi 
ORDER BY P1.Referensi";
#AND P1.MerupakanAtribusi_induk='tidakdiketahui' 
#echo $nSQ;
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$Ptg  = "";
	$Ptg1 = $mRo[11];
	$Ptg2 = $mRo[12];
	$Ptg3 = $mRo[13];
	$Ptg4 = $mRo[14];
	if ($Ptg1!=''){$Ptg = fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$Ptg1,"=","","");}
	if ($Ptg2!=''){$Ptg.= '<br>'.fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$Ptg2,"=","","");}
	if ($Ptg3!=''){$Ptg.= '<br>'.fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$Ptg3,"=","","");}
	if ($Ptg4!=''){$Ptg.= '<br>'.fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$Ptg4,"=","","");}
	
	$Alm = $mRo[15];
	if ($Alm==''){$Alm = $mRo[16];}
	
	$Pgg = $mRo[17];
	$Co12 = "";
	$Co13 = "";
	$Co14 = "";
	$Co15 = "";
	$Co16 = "";
	$Co17 = "";
	if ($Pgg=='PD')
	{
		$Co12 = $mRo[19];
		$Co13 = $mRo[20];
		if ($mRo[21]=='ada') {$Co14 = "x";}
		if ($mRo[21]=='tidakada') {$Co15 = "x";}
		
		if ($mRo[22]=='ada') {$Co16 = "x";}
		if ($mRo[22]=='tidakada') {$Co17 = "x";}
	}
	?>
	<tr height="22">
	  <td style="border:1px solid #000; text-align:center"><?=$iG?>.</td>
	  <td style="border:1px solid #000; text-align:center"><?=$mRo[1]?></td>
	  <td style="border:1px solid #000; text-align:center"><?=$mRo[2]?></td>
	  <td style="border:1px solid #000; text-align:center"><?=$mRo[3]?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$mRo[3],"=","","")?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$mRo[5]?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$mRo[6]?></td>
	  <td style="border:1px solid #000; text-align:center"><?=$mRo[7]?></td>
	  <td style="border:1px solid #000; text-align:center"><?=$mRo[8]?></td>
	  <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[9])?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$Alm?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$Co12?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$Co13?></td>
	  <td style="border:1px solid #000; text-align:center"><?=$Co14?></td>
	  <td style="border:1px solid #000; text-align:center"><?=$Co15?></td>
	  <td style="border:1px solid #000; text-align:center"><?=$Co16?></td>
	  <td style="border:1px solid #000; text-align:center"><?=$Co17?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$mRo[10]?></td>
	  <td style="border:1px solid #000; padding-left:2px"><?=$Ptg?></td>
	</tr>
	<?
	$iG++;
	$mRo7 = $mRo7 + $mRo[7];
	$mRo9 = $mRo9 + $mRo[9];
}
?>
<? if ($iG==1){?>
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
</tr>
<? } ?>
<tr height="26" style="text-align:center; font-weight:bold">
  <td colspan="7" style="border:1px solid #000">Jumlah</td>
  <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo7)?></td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo9)?></td>
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
</table>
<table align="center" cellpadding="0" cellspacing="0" border="0" width="2250" style="font-family:calibri; font-size:10pt">
  <tr>
    <td width="436">&nbsp;</td>
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
  <?
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
