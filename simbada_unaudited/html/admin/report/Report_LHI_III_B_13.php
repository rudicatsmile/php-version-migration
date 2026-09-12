<?
require('../Connection.php');
require('../FileFunction.php');
extract($_GET);

echo $fKon;

if ($fUpb=='00.00.00.00.00.000')
{
	if ($fSub=='00.00.00.00.00')
	{
		$fUnt = $fUnt;
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
<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:1550; font-family:calibri; text-align:center; font-weight:bold; font-size:11pt">
<tr>
  	<td style="text-align:right">Format : III.B.13&nbsp;</td>
</tr>
<tr>
  	<td>LAPORAN HASIL INVENTARISASI (LHI)</td>
</tr>
<tr>
  	<td>REKAPITULASI BMD KONDISI AKHIR FISIK BARANG SESUDAH INVENTARISASI</td>
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
$tWide = 1550;
require('Report_LHI_III_Head.php');
?>
<table align="center" cellpadding="0" cellspacing="0" border="0" width="1550" style="border-collapse:collapse; font-family:calibri; font-size:9pt">
<tr style="text-align:center; font-weight:bold">
	<td width="30" style="border:1px solid #000">No.</td>
	<td width="100" style="border:1px solid #000">NIBAR</td>
	<td width="60" style="border:1px solid #000">Kode Register</td>
	<td width="120" style="border:1px solid #000">Kode Barang</td>
	<td width="200" style="border:1px solid #000">Nama Barang</td>
	<td width="200" style="border:1px solid #000">Nama Spesifikasi Barang</td>
	<td width="200" style="border:1px solid #000">Merk/Tipe</td>
	<td width="40" style="border:1px solid #000">Jumlah</td>
	<td width="100" style="border:1px solid #000">Satuan Barang</td>
	<td width="120" style="border:1px solid #000">Nilai Perolehan<br>Barang (Rp)</td>
	<td width="80" style="border:1px solid #000">Kondisi Fisik  Sesudah Inventarisasi</td>
	<td style="border:1px solid #000">Keterangan</td>
    <td width="120" style="border:1px solid #000">Petugas Sensus</td>
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
'1' as A7,
SatuanBarang as A8,
ifnull(sum(P3.Debet),0) as A9,
P1.Keterangan as A10,

P1.PetugasSensus_1 as A11,
P1.PetugasSensus_2 as A12,
P1.PetugasSensus_3 as A13,
P1.PetugasSensus_4 as A14,

P1.KondisiBarang as A15 

FROM tb_lembar_kerja P1 
LEFT JOIN ta_kib_108_sensus_2023 P2 ON P2.Referensi=P1.Referensi AND P2.Ref_Group=P1.RefGroup AND P2.Kd_UPB=P1.KdUPB 
LEFT JOIN ta_kib_post_108_sensus_2023 P3 ON P3.Referensi=P2.Referensi AND P3.Kd_UPB=P2.Kd_UPB 
WHERE P1.KdUPB LIKE '".$fUnt."%' AND P2.Tgl_Perolehan NOT LIKE '2023-%' AND P2.Kd_Aset_108 LIKE '".$AsT.".%' 

AND P1.KondisiBarangAsal<>P1.KondisiBarang 
AND P1.KondisiBarangAsal LIKE '".$KoNA."' 
AND P1.KondisiBarang LIKE '".$KoNB."' 

AND P1.KeberadaanBarang='ada' 
AND P1.DataSensusFix='Y' 

GROUP BY P1.Referensi 
ORDER BY P1.Referensi";
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
	  <td style="border:1px solid #000; text-align:center"><?=$mRo[15]?></td>
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
</tr>
</table>
<table align="center" cellpadding="0" cellspacing="0" border="0" width="1550" style="font-family:calibri; font-size:10pt">
  <tr>
    <td width="436">&nbsp;</td>
    <td width="433">&nbsp;</td>
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
