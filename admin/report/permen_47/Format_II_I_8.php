<?php
require "../../connfile.php";
require "../../configfile.php";
require "../../functionfile.php";

#Posisi di Surat Pengeluaran (SPPB)
extract($_GET);
$DtA = fGlobal("KdBidangTo:KdBidang:SPPB_Nomor:Nomor:Tanggal:SPPB_Tanggal","tb_mutasi_permohonan","IDT",$gID,"=","",DatabaseSA,$ConSA,"");
$DtA = explode(':',$DtA);
$BiD = $DtA[0];
$BiT = $DtA[1];
$NoM = $DtA[2];
$NoT = $DtA[3];
$TgL = fConvertDateShort($DtA[4]);
$TgS = fConvertDateLongBln($DtA[5]);

$SkB = fGlobal("sub_bidang","tb_bidang_sub","kode",$BiD,"=","",DatabaseSA,$ConSA,"");
$SkP = fGlobal("bidang","tb_bidang","kode",substr($BiD,0,11),"=","",DatabaseSA,$ConSA,"");
$SkP.= "<br> ".$SkB;

$SkBT = fGlobal("sub_bidang","tb_bidang_sub","kode",$BiT,"=","",DatabaseSA,$ConSA,"");
$SkPT.= fGlobal("bidang","tb_bidang","kode",substr($BiT,0,11),"=","",DatabaseSA,$ConSA,"");
$SkBT.= "<br> ".$SkPT;

$DtA = fGlobal("Nm_Pimpinan:Nip_Pimpinan:Jbt_Pimpinan","tb_bidang_sub","kode",$BiD,"=","",DatabaseSA,$ConSA,"");
$DtA = explode(':',$DtA);
$NmB = $DtA[0];
$NiB = $DtA[1];
$JbB = $DtA[2];
if ($JbB==''){$JbB="Silahkan lengkapi data bidang/instalasi...";}
?> 
<body>
<table border="0" width="950" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td style="text-align:right">Format II.I.8</td>
  </tr>
</table>
<table border="0" width="950" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:verdana">SURAT PERINTAH PENYALURAN BARANG (SPPB) </td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri"><?=strtoupper($SkP)?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-family:calibri; text-decoration:underline">Nomor : <?=$NoM?></td>
  </tr>
  
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="font-weight:bold">Dasar Penyaluran Pengeluaran Barang</td>
  </tr>
  <tr valign="top">
    <td>a. Nomor</td>
    <td>:</td>
    <td><?=$NoT?></td>
  </tr>
  <tr valign="top">
    <td>b. Tanggal</td>
    <td>:</td>
    <td><?=$TgL?></td>
  </tr>
  <tr valign="top">
    <td width="130">c. Pihak Yang Meminta</td>
    <td width="20">:</td>
    <td width="800"><?=ucwords(strtolower($SkBT))?></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="950" align="center" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr height="25" style="font-weight:bold; text-align:center">
    <td rowspan="2" style="border:1px solid #000">No</td>
    <td rowspan="2" style="border:1px solid #000">Kode Barang </td>
    <td rowspan="2" style="border:1px solid #000">Nama Barang</td>
    <td rowspan="2" style="border:1px solid #000">Spesifikasi Nama Barang</td>
    <td colspan="2" style="border:1px solid #000">Persetujuan Pengeluaran</td>
    <td rowspan="2" style="border:1px solid #000">Keterangan</td>
  </tr>
  <tr height="25" style="font-weight:bold; text-align:center">
    <td style="border:1px solid #000">Jumlah</td>
    <td style="border:1px solid #000">Satuan</td>
  </tr>
  <tr style="text-align:center">
    <td width="40" style="border:1px solid #000; border-bottom:3px double #000">1</td>
    <td width="120" style="border:1px solid #000; border-bottom:3px double #000">2</td>
    <td width="200" style="border:1px solid #000; border-bottom:3px double #000">3</td>
    <td width="200" style="border:1px solid #000; border-bottom:3px double #000">4</td>
    <td width="80" style="border:1px solid #000; border-bottom:3px double #000">5</td>
    <td width="100" style="border:1px solid #000; border-bottom:3px double #000">7</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">8</td>
  </tr>
	<?php
	$iG=1;
	$mRo3=0;
	$mRo4=0;
	$mRo5=0;
	$nSQ = "SELECT 
	P1.KdPersediaan as A0, 
	P2.Nm_Rek as A1, 
	P3.Nm_Rek as A2, 
	P1.QTY_Usulan_SPB as A3,
	P1.QTY_Stock as A4,
	P1.QTY as A5, 
	P3.Satuan as A6, 
	P1.Keperluan as A7 
	FROM tb_mutasi_permohonan_rinci P1 
	LEFT JOIN ref_rek_90_7_persediaan P2 ON P2.Kd_Rek=left(P1.KdPersediaan,19) 
	LEFT JOIN ref_rek_90_8_persediaan P3 ON P3.Kd_Rek=P1.KdPersediaan 
	WHERE P1.SPPB_Nomor='".$NoM."' ORDER BY P1.Referensi";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs)) 
	{ 
		?>
		<tr height="22">
		<td style="border:1px solid #000; text-align:center"><?=$iG?>.</td>
		<td style="border:1px solid #000; text-align:center"><?=substr($mRo[0],0,19)?></td>
		<td style="border:1px solid #000; padding-left:3px"><?=$mRo[1]?></td>
		<td style="border:1px solid #000; padding-left:3px"><?=$mRo[2]?></td>
		<td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo[5])?></td>
		<td style="border:1px solid #000; text-align:center"><?=$mRo[6]?></td>
		<td style="border:1px solid #000; padding-left:3px"><?=$mRo[7]?></td>
		</tr>
		<?php
		$iG++;
		$mRo5=$mRo5+$mRo[5];
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
	</tr>
	<?php } ?>
  <tr height="22" style="font-weight:bold">
    <td colspan="4" style="border:1px solid #000; text-align:center">Jumlah</td>
    <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo5)?></td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
  </tr>
</table>
<table border="0" width="950" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td width="350">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="350">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><?=$NmIBUK?>, <?=$TgS?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><?=$JbB?></td>
  </tr>
  <tr height="80">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" style="font-weight:bold; text-decoration:underline"><?=$NmB?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">NIP. <?=$NiB?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
