<?php
require "../../connfile.php";
require "../../configfile.php";
require "../../functionfile.php";
extract($_GET);
#Posisi di mutasi

$NmSK = fGlobal("bidang","tb_bidang","kode",$SkP,"=","",DatabaseSA,$ConSA,"");
$NmPG = fGlobal("Nm_Kepala","tb_bidang","kode",$SkP,"=","",DatabaseSA,$ConSA,"");
$BiDG = fGlobal("sub_bidang","tb_bidang_sub","kode",$BiD,"=","",DatabaseSA,$ConSA,"");

$TgA = $Th1."-".substr('0'.$Bl1,-2,2)."-".substr('0'.$Hr1,-2,2);
$TgB = $Th2."-".substr('0'.$Bl2,-2,2)."-".substr('0'.$Hr2,-2,2);

?> 
<body>
<table border="0" width="1300" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td style="text-align:right">Format II.I.3</td>
  </tr>
</table>
<table border="0" width="1300" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:verdana">BUKU PENERIMAAN PERSEDIAAN</td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:verdana">SKPD : <?=$NmSK?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:verdana">PEMERINTAH <?=strtoupper($NmTING." ".$NmDAER)?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-family:calibri">Periode : <?=fConvertDateShortBln($TgA)." s.d ".fConvertDateShortBln($TgB)?></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  
  <tr>
    <td width="160">Kuasa Pengguna Barang</td>
    <td width="26">:</td>
    <td>-</td>
  </tr>
  <tr>
    <td>Pengguna Barang </td>
    <td>:</td>
    <td><?=$NmPG?></td>
  </tr>
  <tr>
    <td>Bidang</td>
    <td>:</td>
    <td><?=$BiDG?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="1300" align="center" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:9pt">
  <tr height="25" style="font-weight:bold; text-align:center">
    <td rowspan="2" style="border:1px solid #000">No</td>
    <td colspan="3" style="border:1px solid #000">BAST</td>
    <td rowspan="2" style="border:1px solid #000">Kode Barang</td>
    <td rowspan="2" style="border:1px solid #000">Nama Barang </td>
    <td colspan="2" style="border:1px solid #000">Spesifikasi  Barang</td>
    <td rowspan="2" style="border:1px solid #000">Jumlah</td>
    <td rowspan="2" style="border:1px solid #000">Harga<br>Satuan<br>(Rp)</td>
    <td rowspan="2" style="border:1px solid #000">Satuan<br>Barang</td>
    <td rowspan="2" style="border:1px solid #000">Nilai<br>Total<br>(Rp)</td>
    <td rowspan="2" style="border:1px solid #000">Ket.</td>
  </tr>
  <tr height="25" style="font-weight:bold; text-align:center">
    <td style="border:1px solid #000">Tanggal</td>
    <td style="border:1px solid #000">Nomor</td>
    <td style="border:1px solid #000">Nama</td>
    <td style="border:1px solid #000">NUSP</td>
    <td style="border:1px solid #000">Spesifikasi<br>Nama Barang</td>
  </tr>
  <tr style="text-align:center">
    <td width="30" style="border:1px solid #000; border-bottom:3px double #000">1</td>
    <td width="65" style="border:1px solid #000; border-bottom:3px double #000">2</td>
    <td width="110" style="border:1px solid #000; border-bottom:3px double #000">3</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">4</td>
    <td width="110" style="border:1px solid #000; border-bottom:3px double #000">5</td>
    <td width="200" style="border:1px solid #000; border-bottom:3px double #000">6</td>
    <td width="60" style="border:1px solid #000; border-bottom:3px double #000">7</td>
    <td width="120" style="border:1px solid #000; border-bottom:3px double #000">8</td>
    <td width="60" style="border:1px solid #000; border-bottom:3px double #000">9</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">10</td>
    <td width="80" style="border:1px solid #000; border-bottom:3px double #000">11</td>
    <td width="100" style="border:1px solid #000; border-bottom:3px double #000">12</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">13</td>
  </tr>
	<?php
	$iG=1;
	$nSQ = "SELECT 
	P1.Tanggal as A0,
	P1.Nomor as A1,
	P1.Catatan as A2,
	P2.KdPersediaan as A3, 
	P3.Nm_Rek as A4,
	P4.Nm_Rek as A5,
	P2.QTY as A6,
	P2.Harga as A7,
	P2.TotalHarga as A8,
	P5.Sub_Bidang as A9,
	P4.Satuan as A10 
	FROM tb_mutasi P1 
	LEFT JOIN tb_mutasi_rinci P2 ON P2.Nomor=P1.Nomor 
	LEFT JOIN ref_rek_90_7_persediaan P3 ON P3.Kd_Rek=left(P2.KdPersediaan,19) 
	LEFT JOIN ref_rek_90_8_persediaan P4 ON P4.Kd_Rek=P2.KdPersediaan 
	LEFT JOIN tb_bidang_sub P5 ON P5.Kode=P1.KdBidang 
	WHERE P1.KdBidangTo='".$BiD."' AND (P1.Tanggal BETWEEN '$TgA' AND '$TgB') ORDER BY P1.Nomor";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs)) 
	{ 
	
	?>
  <tr height="24">
    <td style="border:1px solid #000; text-align:center"><?=$iG?>.</td>
    <td style="border:1px solid #000; text-align:center"><?=fConvertDateShort($mRo[0])?></td>
    <td style="border:1px solid #000; text-align:center"><?=$mRo[1]?></td>
    <td style="border:1px solid #000; text-align:center">Dokumen Mutasi</td>
    <td style="border:1px solid #000; text-align:center"><?=substr($mRo[3],0,19)?></td>
    <td style="border:1px solid #000; padding-left:3px"><?=$mRo[5]?></td>
    <td style="border:1px solid #000; text-align:center"><?=substr($mRo[3],-5,5)?></td>
    <td style="border:1px solid #000; padding-left:3px"><?=$mRo[4]?></td>
    <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo[6])?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[7])?></td>
    <td style="border:1px solid #000; text-align:center"><?=$mRo[10]?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[8])?></td>
    <td style="border:1px solid #000; padding-left:3px">Mutasi Dari <?=$mRo[9]?></td>
  </tr>
  	<?php
		$iG++;
		$mRo6 = $mRo6+$mRo[6];
		$mRo8 = $mRo8+$mRo[8];
	}
  ?>
  <?php if ($iG==1){?>
  <tr height="50">
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
  <tr height="24" style="font-weight:bold">
    <td colspan="8" style="border:1px solid #000; text-align:center">T o t a l</td>
    <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo6)?></td>
    <td style="border:1px solid #000; text-align:center">-</td>
    <td style="border:1px solid #000; text-align:center">-</td>
    <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo8)?></td>
    <td style="border:1px solid #000">&nbsp;</td>
  </tr>
</table>
