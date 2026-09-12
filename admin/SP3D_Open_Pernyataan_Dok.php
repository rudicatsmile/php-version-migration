<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$NoM = str_replace('**',' ',$NoM);
#echo $SmS;
if ($SmS=="I"){
	$TgA = $fTH."-01-01";
	$TgB = $fTH."-06-30";
}
else{
	$TgA = $fTH."-01-01";
	$TgB = $fTH."-12-31";
}

$NmJ = fGlobal("Deskripsi","ref_sp3d_jenis","Kode",$JnS,"=","","");
$SldAW = fGlobal("Nilai","ta_sp3d_saldo_awal","Kd_UPB:KdJenis:KdTahap:Tahun",$UpB.":".$JnS.":1:".$fTH,"=:=:=:=","","");

$NmUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$UpB,"=","","");
$nSQL= "SELECT Jbt_Pimpinan, Nm_Pimpinan, Nip_Pimpinan 
FROM ta_upb WHERE Kd_UPB='".$UpB."' AND Tahun='".$fTH."'";
$nRs = mysql_query($nSQL) or die(mysql_error());
$mRo = mysql_fetch_array($nRs);
$JbT = $mRo[0];
$NmA = $mRo[1]; 
$NiP = $mRo[2]; 
$TgC = $eTH."-".substr("0".$eBL,0,2)."-".substr("0".$eHR,0,2);

?>
<table align="center" border="0" width="650" cellspacing="1" style="font-size:10pt; font-family: Calibri; border-collapse: collapse">
<tr>
	<td style="font-size: 12pt; font-weight: bold" align="center">SURAT PERNYATAAN TANGGUNG JAWAB MUTLAK</td>
</tr>
<tr>
	<td style="font-size: 12pt; font-weight: bold" align="center">NOMOR : <?=$NoM?></td>
</tr>
<tr>
  <td style="font-size: 12pt; font-weight: bold" align="center">&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="650" cellspacing="1" style="font-size:11pt; font-family: Calibri; border-collapse: collapse">
<tr height="20">
	<td width="180">Nama Satdik</td>
    <td width="25">:</td>
    <td><?=$NmUPB?></td>
</tr>
<tr height="20">
	<td>Kode Satdik</td>
    <td>:</td>
    <td><?=$UpB?></td>
</tr>
<tr height="20">
  <td>Nomor / Tanggal DPA-SKPD</td>
  <td>:</td>
  <td>-</td>
</tr>
<tr height="20">
  <td>Kegiatan Dana BOS</td>
  <td>:</td>
  <td>-</td>
</tr>
<tr height="20">
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="650" cellspacing="0" cellpadding="0" style="font-size:12pt; font-family:calibri; border-collapse:collapse">
  <td style="text-align:justify">Saya yang bertanda tangan di bawah ini menyatakan bahwa bertanggung jawab secara formal dan material atas kebenaran realisasi penerimaan dan pengeluaran dana BOS serta kebenaran perhitungan dan setoran pajak yang telah dipungut atas penggunaan Dana BOS pada semester <?=$SmS?> tahun anggaran <?=$fTH?> dengan rincian sebagai berikut :</td>
  <tr>
    <td style="text-align:justify">&nbsp;</td>
</table>
<table align="center" border="0" width="650" cellspacing="1" style="font-size:11pt; font-family: Calibri; border-collapse: collapse">
<tr height="10">
	<td width="20" style="">A.</td>
	<td width="280" style="">Saldo Awal Dana BOS&nbsp;&nbsp;( <i><?=$NmJ?></i> )</td>
	<td width="30" style="">Rp.</td>
	<td width="120" style="text-align:right"><?=fConvertToRupiah($SldAW)?></td>
    <td style="">&nbsp;</td>
</tr>
</table>
<?php
$ThP1 = sumNIL($UpB,$fTH,$TgA,$TgB,$JnS,"1","4","");
$ThP2 = sumNIL($UpB,$fTH,$TgA,$TgB,$JnS,"2","4","");
$ThP3 = sumNIL($UpB,$fTH,$TgA,$TgB,$JnS,"3","4","");
$ThP4 = sumNIL($UpB,$fTH,$TgA,$TgB,$JnS,"4","4","");
$ThPT = $ThP1 + $ThP2 + $ThP3 + $ThP4;
?>
<table align="center" border="0" width="650" cellspacing="1" style="font-size:11pt; font-family: Calibri; border-collapse: collapse">
<tr height="10">
	<td width="20" style="">B.</td>
	<td width="280" style="">Penerimaan Dana BOS&nbsp;&nbsp;( <i><?=$NmJ?></i> )</td>
	<td width="30" style="">&nbsp;</td>
	<td width="120" style="text-align:right">&nbsp;</td>
    <td style="">&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="650" cellspacing="1" style="font-size:11pt; font-family: Calibri; border-collapse: collapse">
<tr height="10">
	<td width="20" style="">&nbsp;</td>
	<td width="30" style="">1.</td>
	<td width="300" style="">Tahap I </td>
	<td width="30" style="">Rp.</td>
	<td width="120" style="text-align:right"><?=fConvertToRupiah($ThP1)?></td>
    <td style="">&nbsp;</td>
</tr>
<tr height="10">
  <td style="">&nbsp;</td>
  <td style="">2.</td>
  <td style="">Tahap II </td>
  <td style="">Rp.</td>
  <td style="text-align:right"><?=fConvertToRupiah($ThP2)?></td>
  <td style="">&nbsp;</td>
</tr>
<tr height="10">
  <td style="">&nbsp;</td>
  <td style="">3.</td>
  <td style="">Tahap III </td>
  <td style="">Rp.</td>
  <td style="text-align:right"><?=fConvertToRupiah($ThP3)?></td>
  <td style="">&nbsp;</td>
</tr>
<tr height="10">
  <td style="">&nbsp;</td>
  <td style="">4.</td>
  <td style="">Tahap IV </td>
  <td style="">Rp.</td>
  <td style="text-align:right"><?=fConvertToRupiah($ThP4)?></td>
  <td style="">&nbsp;</td>
</tr>
<tr height="10" style="font-weight:bold">
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
  <td style="">Jumlah Penerimaan</td>
  <td style="border-top:1px solid #000; border-bottom:1px solid #000">Rp.</td>
  <td style="text-align:right; border-top:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiah($ThPT)?></td>
  <td style="">&nbsp;</td>
</tr>
<tr height="10" style="font-weight:bold">
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
</tr>
</table>

<table align="center" border="0" width="650" cellspacing="1" style="font-size:11pt; font-family: Calibri; border-collapse: collapse">
<tr height="10">
	<td width="20" style="">C.</td>
	<td width="280" style="">Pengeluaran Dana BOS&nbsp;&nbsp;( <i><?=$NmJ?></i> )</td>
	<td width="30" style="">&nbsp;</td>
	<td width="120" style="text-align:right">&nbsp;</td>
    <td style="">&nbsp;</td>
</tr>
</table>
<?php
$ThB1 = sumNIL($UpB,$fTH,$TgA,$TgB,$JnS,"%","5.1.1","");
$ThB2 = sumNIL($UpB,$fTH,$TgA,$TgB,$JnS,"%","5.1.2","");
$ThB3 = sumNIL($UpB,$fTH,$TgA,$TgB,$JnS,"%","5.2","");
$ThBT = $ThB1 + $ThB2 + $ThB3;

$ThBS = $ThPT - $ThBT;
?>
<table align="center" border="0" width="650" cellspacing="1" style="font-size:11pt; font-family: Calibri; border-collapse: collapse">
<tr height="10">
	<td width="20" style="">&nbsp;</td>
	<td width="30" style="">1.</td>
	<td width="300" style="">Jenis Belanja Pegawai </td>
	<td width="30" style="">Rp.</td>
	<td width="120" style="text-align:right"><?=fConvertToRupiah($ThB1)?></td>
    <td style="">&nbsp;</td>
</tr>
<tr height="10">
  <td style="">&nbsp;</td>
  <td style="">2.</td>
  <td style="">Jenis Belanja Barang dan Jasa </td>
  <td style="">Rp.</td>
  <td style="text-align:right"><?=fConvertToRupiah($ThB2)?></td>
  <td style="">&nbsp;</td>
</tr>
<tr height="10">
  <td style="">&nbsp;</td>
  <td style="">3.</td>
  <td style="">Jenis Belanja Modal </td>
  <td style="">Rp.</td>
  <td style="text-align:right"><?=fConvertToRupiah($ThB3)?></td>
  <td style="">&nbsp;</td>
</tr>

<tr height="10" style="font-weight:bold">
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
  <td style="">Jumlah Pengeluaran</td>
  <td style="border-top:1px solid #000; border-bottom:1px solid #000">Rp.</td>
  <td style="text-align:right; border-top:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiah($ThBT)?></td>
  <td style="">&nbsp;</td>
</tr>
<tr height="10" style="font-weight:bold">
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="650" cellspacing="1" style="font-size:11pt; font-family: Calibri; border-collapse: collapse">
<tr height="10">
	<td width="20" style="">D.</td>
	<td width="280" style="">Sisa Dana BOS&nbsp;&nbsp;( <i><?=$NmJ?></i> )</td>
	<td width="30" style="">Rp.</td>
	<td width="120" style="text-align:right"><?=fConvertToRupiah($ThBS)?></td>
    <td style="">&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="650" cellspacing="1" style="font-size:11pt; font-family: Calibri; border-collapse: collapse">
<tr height="10">
	<td width="20" style="">&nbsp;</td>
	<td colspan="2" style="">Terdiri atas : </td>
	<td width="30" style="">&nbsp;</td>
	<td width="120" style="text-align:right">&nbsp;</td>
    <td style="">&nbsp;</td>
</tr>
<tr height="10">
  <td style="">&nbsp;</td>
  <td width="30" style="">1.</td>
  <td width="248" style="">Sisa Kas Tunai </td>
  <td style="">Rp.</td>
  <td style="text-align:right">-</td>
  <td style="">&nbsp;</td>
</tr>
<tr height="10">
  <td style="">&nbsp;</td>
  <td style="">2.</td>
  <td style="">Sisa di Bank </td>
  <td style="">Rp.</td>
  <td style="text-align:right">-</td>
  <td style="">&nbsp;</td>
</tr>

<tr height="10" style="font-weight:bold">
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
  <td style="">&nbsp;</td>
</tr>
</table>

<table align="center" border="0" width="650" cellspacing="1" style="font-size:12pt; font-family:calibri; border-collapse: collapse">
<tr height="10">
  <td style="border:0px solid #000; text-align:justify"></td>
</tr>
<tr height="22">
	<td style="border:0px solid #000; text-align:justify">Bukti-bukti atas belanja tersebut pada huruf B disimpan pada Satdik <?=$NmUPB?> untuk kelengkapan administrasi dan keperluan pemeriksaan sesuai peraturan perundang-undangan. Apabila bukti-bukti tersebut tidak benar yang mengakibatkan kerugian daerah, saya bertanggung jawab sepenuhnya atas kerugian daerah dimaksud sesuai kewenangan saya berdasarkan peraturan perundang-undangan.</td>
</tr>
<tr height="10">
	<td style="border:0px solid #000"></td>
</tr>
<tr height="22">
	<td style="border:0px solid #000">Demikian surat pernyataan ini dibuat dengan sebenarnya.</td>
</tr>
</table>
<table align="center" border="0" width="650" cellspacing="1" style="font-size:11pt; font-family: Calibri; border-collapse: collapse">
<tr height="10">
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
</tr>
<tr height="20">
	<td style="width:300px">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="width:300px; text-align:center"><?=$NmIbuk.", ".fConvertDateLongsBln($TgC)?></td>
</tr>
<tr height="20">
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="text-align:center"><?=$JbT?></td>
</tr>
<tr height="50">
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
</tr>
<tr height="20">
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="font-weight:bold; text-align:center; text-decoration:underline"><?=$NmA?></td>
</tr>
<tr height="20">
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="text-align:center">NIP : <?=$NiP?></td>
</tr>
</table>
<?php
function sumNIL($UpB,$fTH,$TgA,$TgB,$fJN,$fSS,$fRK,$fSH)
{
	$SW = "SELECT IfNull(sum(P2.Nilai),0) as JM FROM ta_sp3d P1 LEFT JOIN ta_sp3d_rinci P2 ON P2.Referensi=P1.Referensi 
	WHERE P1.Kd_UPB='".$UpB."' AND P1.Tahun='".$fTH."' AND (P1.Tgl_SP3D BETWEEN '".$TgA."' AND '".$TgB."') AND P1.KdJenis = '".$fJN."' AND P1.KdSesi LIKE '".$fSS."' AND P2.Kd_ReknP90 LIKE '".$fRK."%'";
	if ($fSH) echo $SW."<br>";
	$rs = mysql_query($SW);
	$mR = mysql_fetch_array($rs);
	return $mR[0];
}
?>