<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $SmS;
if ($SmS=="I"){
	$TgA = $fTH."-01-01";
	$TgB = $fTH."-06-30";
}
else{
	$TgA = $fTH."-07-01";
	$TgB = $fTH."-12-31";
}


$NmUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$UpB,"=","","");

$nSQL= "SELECT Jbt_Pimpinan, Nm_Pimpinan, Nip_Pimpinan,
Jbt_Bend_BOS, Nm_Bend_BOS, Nip_Bend_BOS 
FROM ta_upb WHERE Kd_UPB='".$UpB."' AND Tahun='".$fTH."'";
$nRs = mysql_query($nSQL) or die(mysql_error());
$mRo = mysql_fetch_array($nRs);
$JbT = $mRo[0];
$NmA = $mRo[1]; 
$NiP = $mRo[2]; 

$JbTB = $mRo[3];
$NmAB = $mRo[4]; 
$NiPB = $mRo[5]; 
$TgC = $eTH."-".substr("0".$eBL,0,2)."-".substr("0".$eHR,0,2);

?>
<table align="center" border="0" width="700" cellspacing="1" style="font-size:10pt; font-family: Calibri; border-collapse: collapse">
<tr>
	<td style="font-size: 12pt; font-weight: bold" align="center">REKAPITULASI PEMBELIAN BARANG MILLK DAERAH DARI DANA BOS</td>
</tr>
<tr>
	<td style="font-size: 11pt; font-weight: bold" align="center">SEMESTER <?=$SmS?> TAHUN ANGGARAN <?=$fTH?></td>
</tr>
<tr>
  <td style="font-size: 12pt; font-weight: bold" align="center">&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="700" cellspacing="1" style="font-size:11pt; font-family: Calibri; border-collapse: collapse">
<tr height="20">
	<td width="130">Nama Sekolah</td>
	<td width="30">:</td>
	<td><?=$NmUPB?></td>
</tr>
<tr height="20">
	<td>Desa/Kelurahan</td>
	<td>:</td>
	<td>-</td>
</tr>
<tr height="20">
  <td>Kecamatan</td>
  <td>:</td>
  <td>-</td>
</tr>
<tr height="20">
  <td>Kabupaten/Kota</td>
  <td>:</td>
  <td>-</td>
</tr>
<tr height="20">
  <td>Provinsi</td>
  <td>:</td>
  <td>-</td>
</tr>
<tr height="10">
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="700" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-family: Calibri; font-size:10pt">
  <tr style="text-align:center; font-weight:bold">
    <td width="35" style="border:1px solid #000">NO</td>
    <td style="border:1px solid #000">NAMA BARANG MILIK DAERAH </td>
    <td width="60" style="border:1px solid #000">JUMLAH<br>UNIT</td>
    <td width="100" style="border:1px solid #000">HARGA<br>SATUAN<br>(Rp) </td>
    <td width="110" style="border:1px solid #000">JUMLAH<br>(Rp) </td>
  </tr>
  <tr style="text-align:center">
    <td style="border:1px solid #000; border-bottom:3px double #000">1</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">2</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">3</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">4</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">5 (3x4)</td>
  </tr>
	<?php
	$iG=1;
	$mRo2 = 0;
	$mRo4 = 0;
	$nSQL= "SELECT P2.Nm_Aset_108, P2.Nm_Aset, P2.JmlSatuan, P2.Harga, P2.Total 
	FROM ta_sp3d_spj P1 
	JOIN ta_sp3d_spj_rinci P2 ON P2.Referensi_SPJ=P1.Referensi
	WHERE P1.Kd_UPB='".$UpB."' AND P1.Tahun='".$fTH."' AND (P1.Tgl_BAST BETWEEN '".$TgA."' AND '".$TgB."') ORDER BY P1.Tgl_BAST, P2.Nm_Aset_108";
	#echo $nSQL;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs))
	{
	?>
	<tr height="20">
	<td style="border:1px solid #000; text-align:center"><?=$iG?>.</td>
	<td style="border:1px solid #000; padding-left:3px"><?=$mRo[0]."<br><i>".$mRo[1]."</i>"?></td>
	<td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo[2])?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[3])?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[4])?></td>
	</tr>
	<?php
	$mRo2 = $mRo2 + $mRo[2];
	$mRo4 = $mRo4 + $mRo[4];
	$iG++;
	}
	?>

  <tr height="25" style="font-weight:bold">
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:center">JUMLAH</td>
    <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo2)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo4)?></td>
  </tr>
</table>
<table align="center" border="0" width="700" cellspacing="1" style="font-size:11pt; font-family: Calibri; border-collapse: collapse">
<tr height="10">
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
</tr>
<tr height="20">
  <td style="width:300px; text-align:center">&nbsp;</td>
  <td style="">&nbsp;</td>
  <td style="width:300px; text-align:center"><?=$NmIbuk.", ".fConvertDateLongsBln($TgC)?></td>
</tr>
<tr height="20">
	<td style="width:300px; text-align:center">Mengetahui,</td>
	<td style="">&nbsp;</td>
	<td style="width:300px; text-align:center">&nbsp;</td>
</tr>
<tr height="20">
	<td style="text-align:center"><?=$JbT?></td>
	<td style="">&nbsp;</td>
	<td style="text-align:center"><?=$JbTB?></td>
</tr>
<tr height="50">
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
</tr>
<tr height="20">
	<td style="font-weight:bold; text-align:center; text-decoration:underline"><?=$NmA?></td>
	<td style="">&nbsp;</td>
	<td style="font-weight:bold; text-align:center; text-decoration:underline"><?=$NmAB?></td>
</tr>
<tr height="20">
	<td style="text-align:center">NIP : <?=$NiP?></td>
	<td style="">&nbsp;</td>
	<td style="text-align:center">NIP : <?=$NiPB?></td>
</tr>
</table>
<?php
function sumNIL($UpB,$fTH,$TgA,$TgB,$fJN,$fRK,$fSH)
{
	$SW = "SELECT IfNull(sum(P2.Nilai),0) as JM FROM ta_sp3d P1 LEFT JOIN ta_sp3d_rinci P2 ON P2.Referensi=P1.Referensi 
	WHERE P1.Kd_UPB='".$UpB."' AND P1.Tahun='".$fTH."' AND (P1.Tgl_SP3D BETWEEN '".$TgA."' AND '".$TgB."') AND P1.KdJenis LIKE '".$fJN."' AND P2.Kd_ReknP90 LIKE '".$fRK."%'";
	if ($fSH) echo $SW."<br>";
	$rs = mysql_query($SW);
	$mR = mysql_fetch_array($rs);
	return $mR[0];
}
?>