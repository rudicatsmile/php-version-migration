<?php
require('../../Connection.php');
require('../../FileFunction.php');
require("../../CheckLogin.php");
extract($_GET);

function fNmDesk($nX)
{
	$Nm= array ('','Kode sub kegiatan','Uraian sub kegiatan',' 	Kode belanja','Uraian belanja','Kode barang','Nama barang','Spesifikasi nama barang','Tgl, Bulan, Tahun Perolehan','Jumlah Barang','Harga Satuan Barang','Biaya Atribusi');
	return $Nm[$nX];
}

$nSQ = " SELECT P1.Nomor as A0, P1.Kd_Unit as A1, P1.Tanggal as A2,
P1.Pencatat as A3,
P1.Recorded as A4 
FROM ta_pengadaan P1 
WHERE P1.IDT ='".$IdT."'";
#echo $nSQ."<br>";
$nRs = mysql_query($nSQ) or die(mysql_error());
$mRo = mysql_fetch_array($nRs, MYSQL_BOTH);
$NoM = $mRo[0];
$KdU = $mRo[1];
$ThN = $mRo[2];

$NmSkP = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$KdU,"=","","");
$NmaPm = fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit",$KdU,"=","","");
$NmPgB = "-";

$DtA = fGlobal("TglVerifikasi:JbtVerifikator:NmaVerifikator:NipVerifikator","ta_pengadaan_verifikator","nomor",$NoM,"=","","");	
$DtA = explode(":",$DtA);

$fVrTg = $DtA [0];
$fVrJb = $DtA [1];
$fVrNm = $DtA [2];
$fVrNi = $DtA [3];

?> 
<body>
<table border="0" width="670" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td width="567"></td>
    <td width="131" style="text-align:right; font-size:10pt">Format II.A.11.1</td>
  </tr>
</table>
<table border="0" width="670" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">PEMERINTAH <?=strtoupper($TiDaer." ".$NmDaer)?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri"><?=$NmSkP?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">LEMBAR VERIFIKASI</td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">HASIL PEMBUKUAN PENGADAAN BMD </td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">TAHUN <?=substr($ThN,0,4)?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr style="font-size:10pt; font-family:calibri">
    <td width="137">Kuasa Pengguna Barang</td>
    <td width="27" style="text-align:center">:</td>
    <td width="506"><?=$NmPgB?></td>
  </tr>
  <tr style="font-size:10pt; font-family:calibri">
    <td>Pengguna Barang</td>
    <td style="text-align:center">:</td>
    <td><?=$NmaPm?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:8pt; font-weight:bold; font-family:verdana">&nbsp;</td>
  </tr>
</table>
<table align="center" border="0" width="670" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-family:calibri; font-size:10pt">
  <tr height="20" style="text-align:center; font-weight:bold">
    <td width="41" rowspan="2" style="border:1px #000 solid">No.</td>
    <td width="209" rowspan="2" style="border:1px #000 solid">Uraian</td>
    <td width="72" rowspan="2" style="border:1px #000 solid">Sesuai</td>
    <td colspan="2" style="border:1px #000 solid">Tidak Sesuai </td>
    <td width="281" rowspan="2" style="border:1px #000 solid">Keterangan</td>
  </tr>
  <tr height="20" style="text-align:center; font-weight:bold">
    <td width="61" style="border:1px #000 solid"><img src='../../css/images/newokey.gif' width="10" height="14"></td>
    <td width="66" style="border:1px #000 solid">Jumlah</td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":1","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm1= $DtA[1];
	$fKt1= $DtA[2];
	$fB1a = "";
	$fB1b = "";
	if ($fB=='Y') {$fB1a = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	else {$fB1b = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	?>
  <tr height="24">
    <td style="text-align:center; border:1px #000 solid">1.</td>
    <td style="border:1px #000 solid; padding-left:2px"><?=fNmDesk(1)?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB1a?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB1b?></td>
    <td style="border:1px #000 solid; text-align:center"><?php if ($fJm1!=0) {echo $fJm1;}?></td>
    <td style="border:1px #000 solid; padding-left:2px"><?=$fKt1?></td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":2","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm2= $DtA[1];
	$fKt2= $DtA[2];
	$fB2a = "";
	$fB2b = "";
	if ($fB=='Y') {$fB2a = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	else {$fB2b = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	?>
  <tr height="24">
    <td style="border:1px #000 solid; text-align:center">2.</td>
    <td style="border:1px #000 solid; padding-left:2px"><?=fNmDesk(2)?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB2a?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB2b?></td>
	<td style="border:1px #000 solid; text-align:center"><?php if ($fJm2!=0) {echo $fJm2;}?></td>
    <td style="border:1px #000 solid; padding-left:2px"><?=$fKt2?></td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":3","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm3= $DtA[1];
	$fKt3= $DtA[2];
	$fB3a = "";
	$fB3b = "";
	if ($fB=='Y') {$fB3a = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	else {$fB3b = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	?>
  <tr height="24">
    <td style="border:1px #000 solid; text-align:center">3.</td>
    <td style="border:1px #000 solid; padding-left:2px"><?=fNmDesk(3)?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB3a?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB3b?></td>
	<td style="border:1px #000 solid; text-align:center"><?php if ($fJm3!=0) {echo $fJm3;}?></td>
    <td style="border:1px #000 solid; padding-left:2px"><?=$fKt3?></td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":4","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm4= $DtA[1];
	$fKt4= $DtA[2];
	$fB4a = "";
	$fB4b = "";
	if ($fB=='Y') {$fB4a = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	else {$fB4b = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	?>
  <tr height="24">
    <td style="border:1px #000 solid; text-align:center">4.</td>
    <td style="border:1px #000 solid; padding-left:2px"><?=fNmDesk(4)?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB4a?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB4b?></td>
	<td style="border:1px #000 solid; text-align:center"><?php if ($fJm4!=0) {echo $fJm4;}?></td>
    <td style="border:1px #000 solid; padding-left:2px"><?=$fKt4?></td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":5","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm5= $DtA[1];
	$fKt5= $DtA[2];
	$fB5a = "";
	$fB5b = "";
	if ($fB=='Y') {$fB5a = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	else {$fB5b = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	?>
  <tr height="24">
    <td style="border:1px #000 solid; text-align:center">5.</td>
    <td style="border:1px #000 solid; padding-left:2px"><?=fNmDesk(5)?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB5a?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB5b?></td>
	<td style="border:1px #000 solid; text-align:center"><?php if ($fJm5!=0) {echo $fJm5;}?></td>
    <td style="border:1px #000 solid; padding-left:2px"><?=$fKt5?></td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":6","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm6= $DtA[1];
	$fKt6= $DtA[2];
	$fB6a = "";
	$fB6b = "";
	if ($fB=='Y') {$fB6a = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	else {$fB6b = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	?>
  <tr height="24">
    <td style="border:1px #000 solid; text-align:center">6.</td>
    <td style="border:1px #000 solid; padding-left:2px"><?=fNmDesk(6)?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB6a?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB6b?></td>
	<td style="border:1px #000 solid; text-align:center"><?php if ($fJm6!=0) {echo $fJm6;}?></td>
    <td style="border:1px #000 solid; padding-left:2px"><?=$fKt6?></td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":7","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm7= $DtA[1];
	$fKt7= $DtA[2];
	$fB7a = "";
	$fB7b = "";
	if ($fB=='Y') {$fB7a = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	else {$fB7b = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	?>
  <tr height="24">
    <td style="border:1px #000 solid; text-align:center">7.</td>
    <td style="border:1px #000 solid; padding-left:2px"><?=fNmDesk(7)?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB7a?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB7b?></td>
	<td style="border:1px #000 solid; text-align:center"><?php if ($fJm7!=0) {echo $fJm7;}?></td>
    <td style="border:1px #000 solid; padding-left:2px"><?=$fKt7?></td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":8","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm8= $DtA[1];
	$fKt8= $DtA[2];
	$fB8a = "";
	$fB8b = "";
	if ($fB=='Y') {$fB8a = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	else {$fB8b = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	?>
  <tr height="24">
    <td style="border:1px #000 solid; text-align:center">8.</td>
    <td style="border:1px #000 solid; padding-left:2px"><?=fNmDesk(8)?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB8a?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB8b?></td>
	<td style="border:1px #000 solid; text-align:center"><?php if ($fJm8!=0) {echo $fJm8;}?></td>
    <td style="border:1px #000 solid; padding-left:2px"><?=$fKt8?></td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":9","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm9= $DtA[1];
	$fKt9= $DtA[2];
	$fB9a = "";
	$fB9b = "";
	if ($fB=='Y') {$fB9a = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	else {$fB9b = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	?>
  <tr height="24">
    <td style="border:1px #000 solid; text-align:center">9.</td>
    <td style="border:1px #000 solid; padding-left:2px"><?=fNmDesk(9)?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB9a?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB9b?></td>
	<td style="border:1px #000 solid; text-align:center"><?php if ($fJm9!=0) {echo $fJm9;}?></td>
    <td style="border:1px #000 solid; padding-left:2px"><?=$fKt9?></td>
  </tr>
	<?php
	$DtA   = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":10","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fB    = $DtA[0];
	$fJm10 = $DtA[1];
	$fKt10 = $DtA[2];
	$fB10a = "";
	$fB10b = "";
	if ($fB=='Y') {$fB10a = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	else {$fB10b = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	?>
  <tr height="24">
    <td style="border:1px #000 solid; text-align:center">10.</td>
    <td style="border:1px #000 solid; padding-left:2px"><?=fNmDesk(10)?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB10a?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB10b?></td>
	<td style="text-align:center"><?php if ($fJm10!=0) {echo $fJm10;}?></td>
    <td style="border:1px #000 solid; padding-left:2px"><?=$fKt10?></td>
  </tr>
	<?php
	$DtA   = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":11","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fB    = $DtA[0];
	$fJm11 = $DtA[1];
	$fKt11 = $DtA[2];
	$fB11a = "";
	$fB11b = "";
	if ($fB=='Y') {$fB11a = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	else {$fB11b = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	?>
  <tr height="24">
    <td style="border:1px #000 solid; text-align:center">11.</td>
    <td style="border:1px #000 solid; padding-left:2px"><?=fNmDesk(11)?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB11a?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB11b?></td>
	<td style="border:1px #000 solid; text-align:center"><?php if ($fJm11!=0) {echo $fJm11;}?></td>
    <td style="border:1px #000 solid; padding-left:2px"><?=$fKt11?></td>
  </tr>
	<?php
	$DtA   = fGlobal("Sesuai:Jumlah:Keterangan:Deskripsi","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":12a","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fB    = $DtA[0];
	$fDs12a = $DtA[3];
	$fB12aa = "";
	$fB12ab = "";
	if ($fDs12a!='')
	{
		$fJm12a = $DtA[1];
		$fKt12a = $DtA[2];
		if ($fB=='Y') {$fB12aa = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
		else {$fB12ab = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	}
	?>
  <tr height="24">
    <td style="border:1px #000 solid; text-align:center">12.</td>
    <td style="border:1px #000 solid; padding-left:2px">a.&nbsp;&nbsp;&nbsp;<?=$fDs12a?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB12aa?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB12ab?></td>
	<td style="border:1px #000 solid; text-align:center"><?php if ($fJm12a!=0) {echo $fJm12a;}?></td>
    <td style="border:1px #000 solid; padding-left:2px"><?=$fKt12a?></td>
  </tr>
	<?php
	$DtA   = fGlobal("Sesuai:Jumlah:Keterangan:Deskripsi","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":12b","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fB    = $DtA[0];
	$fDs12b = $DtA[3];
	$fB12ba = "";
	$fB12bb = "";
	if ($fDs12b!='')
	{
		$fJm12b = $DtA[1];
		$fKt12b = $DtA[2];
		if ($fB=='Y') {$fB12ba = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
		else {$fB12bb = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	}
	?>
  <tr height="24">
    <td style="border:1px #000 solid; text-align:center">&nbsp;</td>
    <td style="border:1px #000 solid; padding-left:2px">b.&nbsp;&nbsp;&nbsp;<?=$fDs12b?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB12ba?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB12bb?></td>
	<td style="border:1px #000 solid; text-align:center"><?php if ($fJm12b!=0) {echo $fJm12b;}?></td>
    <td style="border:1px #000 solid; padding-left:2px"><?=$fKt12b?></td>
  </tr>
	<?php
	$DtA   = fGlobal("Sesuai:Jumlah:Keterangan:Deskripsi","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":12c","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fB    = $DtA[0];
	$fDs12c = $DtA[3];
	$fB12ca = "";
	$fB12cb = "";
	if ($fDs12c!='')
	{
		$fJm12c = $DtA[1];
		$fKt12c = $DtA[2];
		if ($fB=='Y') {$fB12ca = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
		else {$fB12cb = "<img src='../../css/images/newokey.gif' width='10' height='14'>";}
	}
	?>
  <tr height="24">
    <td style="border:1px #000 solid; text-align:cente">&nbsp;</td>
    <td style="border:1px #000 solid; padding-left:2px">c.&nbsp;&nbsp;&nbsp;<?=$fDs12c?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB12ca?></td>
    <td style="border:1px #000 solid; text-align:center"><?=$fB12cb?></td>
	<td style="border:1px #000 solid; text-align:center"><?php if ($fJm12c!=0) {echo $fJm12c;}?></td>
    <td style="border:1px #000 solid; padding-left:2px"><?=$fKt12c?></td>
  </tr>
</table>
<table align="center" border="0" width="670" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-family:calibri; font-size:10pt">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="55">Catatan:</td>
    <td width="653">&nbsp;</td>
  </tr>
	<?php
	$DtA   = fGlobal("Deskripsi","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":Ct1","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fCt1  = $DtA[0];
	if ($fCt1!='')
	{
	?>
  <tr height="20">
	<td colspan="2"><li><?=$fCt1?></td>
	  </tr>
	<?php
	}
	
	$DtA   = fGlobal("Deskripsi","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":Ct2","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fCt2  = $DtA[0];
	if ($fCt2!='')
	{
	?>
  <tr height="20">
	<td colspan="2"><li><?=$fCt2?></td>
	  </tr>
	<?php
	$DtA   = fGlobal("Deskripsi","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":Ct3","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fCt3  = $DtA[0];
	}
	if ($fCt3!='')
	{
	?>
  <tr height="20">
    <td colspan="2"><li><?=$fCt3?></td>
  </tr>
  <?php
  }
  ?>
  <tr height="5">
    <td></td>
    <td></td>
  </tr>
</table>
<table align="center" border="0" width="670" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-family:calibri; font-size:10pt">
  <tr>
    <td width="300">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="300" style="text-align:center"><?=$NmIbuk?>, <?=fConvertDateShort($fVrTg)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="text-align:center; font-weight:bold">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="text-align:center; font-weight:bold"><?=$fVrJb?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="text-align:center; font-weight:bold; text-decoration:underline"><?=$fVrNm?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="text-align:center">NIP. <?=$fVrNi?></td>
  </tr>
</table>

