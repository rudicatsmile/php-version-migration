<?php
require('../../Connection.php');
require('../../FileFunction.php');
require("../../CheckLogin.php");
extract($_GET);

$ThN   = $Thn;
$NmSkP = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$KdS,"=","","");	
$TgD   = $HriA." ".fNmBulanLong($BlnA)." ".$ThnA;

#$DokPTg = fConvertDateShort($DokPTg);

$fP1NmaA  = fGlobal("Nm_Pengurus","ref_unit","Kd_Unit",$KdS,"=","","");
$fP1NmaB  = fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit",$KdS,"=","","");

if ($RdB=='V1')
{
	$Vx = "KUASA PENGGUNA BARANG";
	$fP1Nma  = fGlobal("Nm_Pengurus","ref_unit","Kd_Unit",$KdS,"=","","");
	$fP1Nip  = fGlobal("Nip_Pengurus","ref_unit","Kd_Unit",$KdS,"=","","");
	$fP1Pkt  = fGlobal("Pkt_Pengurus","ref_unit","Kd_Unit",$KdS,"=","","");
	$fP1Jab  = fGlobal("Jbt_Pengurus","ref_unit","Kd_Unit",$KdS,"=","","");
}
if ($RdB=='V2')
{
	$Vx = "PENGGUNA BARANG";
	$fP1Nma  = fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit",$KdS,"=","","");
	$fP1Nip  = fGlobal("Nip_Pimpinan","ref_unit","Kd_Unit",$KdS,"=","","");
	$fP1Pkt  = fGlobal("Pkt_Pimpinan","ref_unit","Kd_Unit",$KdS,"=","","");
	$fP1Jab  = fGlobal("Jab_Pimpinan","ref_unit","Kd_Unit",$KdS,"=","","");
}
if ($RdB=='V3')
{
	$KdSx = "24.04.13.04";
	$Vx   = "PENGELOLA BARANG";
	$fP1Nma  = fGlobal("Nm_Pengurus","ref_unit","Kd_Unit",$KdSx,"=","","");
	$fP1Nip  = fGlobal("Nip_Pengurus","ref_unit","Kd_Unit",$KdSx,"=","","");
	$fP1Pkt  = fGlobal("Pkt_Pengurus","ref_unit","Kd_Unit",$KdSx,"=","","");
	$fP1Jab  = fGlobal("Jbt_Pengurus","ref_unit","Kd_Unit",$KdSx,"=","","");
}

?>
<body>
<table border="0" width="2200" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td width="567"></td>
    <td width="131" style="text-align:right; font-size:10pt">Format II.L.6</td>
  </tr>
</table>
<table border="0" width="2200" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">DAFTAR PENGGUNAAN/PEMAKAIAN BMD GEDUNG DAN BANGUNAN BERUPA RUMAH NEGARA</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri"><?=$Vx?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri"><?=$NmSkP?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">PEMERINTAH <?=strtoupper($TiDaer." ".$NmDaer)?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">TAHUN <?=substr($ThN,0,4)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="2200" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:10pt">  
  <tr>
    <td width="160">Kuasa Pengguna Barang</td>
    <td width="20">:</td>
    <td><?=$fP1NmaA?></td>
  </tr>
  <tr>
    <td>Pengguna Barang</td>
    <td>:</td>
    <td><?=$fP1NmaB?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="2200" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:10pt">
  
  <tr style="text-align:center; font-weight:bold">
    <td rowspan="3" style="border:1px solid #000">No.</td>
    <td rowspan="3" style="border:1px solid #000">NIBAR</td>
    <td rowspan="3" style="border:1px solid #000">Kode<br>Barang</td>
    <td rowspan="3" style="border:1px solid #000">Nama Barang</td>
    <td rowspan="3" style="border:1px solid #000">Spesifikasi Nama <br>Barang</td>
    <td rowspan="3" style="border:1px solid #000">Lokasi / Alamat</td>
    <td colspan="5" style="border:1px solid #000">Pemakai</td>
    <td colspan="4" style="border:1px solid #000">Dokumen Sumber<br>Penggunaan</td>
    <td colspan="3" style="border:1px solid #000">Dokumen Pendukung<br>Lainnya</td>
    <td rowspan="3" style="border:1px solid #000">Keterangan</td>
  </tr>
  <tr style="text-align:center; font-weight:bold">
    <td rowspan="2" style="border:1px solid #000">Nama Pemakai</td>
    <td rowspan="2" style="border:1px solid #000">Status Pemakai</td>
    <td rowspan="2" style="border:1px solid #000">Jabatan</td>
    <td rowspan="2" style="border:1px solid #000">Nomor Identitas<br>Pemakai</td>
    <td rowspan="2" style="border:1px solid #000">Alamat</td>
    <td colspan="2" style="border:1px solid #000">Surat Ijin<br>Penghunian (SIP)</td>
    <td colspan="2" style="border:1px solid #000">BAST Pemakaian</td>
    <td rowspan="2" style="border:1px solid #000">Nama</td>
    <td rowspan="2" style="border:1px solid #000">Nomor</td>
    <td rowspan="2" style="border:1px solid #000">Tanggal</td>
  </tr>
  <tr style="text-align:center; font-weight:bold">
    <td style="border:1px solid #000">Nomor</td>
    <td style="border:1px solid #000">Tanggal</td>
    <td style="border:1px solid #000">Nomor</td>
    <td style="border:1px solid #000">Tanggal</td>
  </tr>
  <tr style="text-align:center">
    <td width="30" style="border:1px solid #000; border-bottom:3px double #000">1</td>
    <td width="95" style="border:1px solid #000; border-bottom:3px double #000">2</td>
    <td width="100" style="border:1px solid #000; border-bottom:3px double #000">3</td>
    <td width="170" style="border:1px solid #000; border-bottom:3px double #000">4</td>
    <td width="170" style="border:1px solid #000; border-bottom:3px double #000">5</td>
    <td width="150" style="border:1px solid #000; border-bottom:3px double #000">6</td>
    <td width="120" style="border:1px solid #000; border-bottom:3px double #000">7</td>
    <td width="120" style="border:1px solid #000; border-bottom:3px double #000">8</td>
    <td width="120" style="border:1px solid #000; border-bottom:3px double #000">9</td>
    <td width="100" style="border:1px solid #000; border-bottom:3px double #000">10</td>
    <td width="150" style="border:1px solid #000; border-bottom:3px double #000">11</td>
    <td width="120" style="border:1px solid #000; border-bottom:3px double #000">12</td>
    <td width="65" style="border:1px solid #000; border-bottom:3px double #000">13</td>
    <td width="120" style="border:1px solid #000; border-bottom:3px double #000">14</td>
    <td width="65" style="border:1px solid #000; border-bottom:3px double #000">15</td>
    <td width="120" style="border:1px solid #000; border-bottom:3px double #000">16</td>
    <td width="120" style="border:1px solid #000; border-bottom:3px double #000">17</td>
    <td width="65" style="border:1px solid #000; border-bottom:3px double #000">18</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">19</td>
  </tr>
  <?php
	$iG=1;
	$SQL ="SELECT P1.No_Register as A0,
	P1.Referensi as A1,
	P1.Kd_Aset_108 as A2,
	P2.Nm_Aset as A3,
	P1.Nm_Aset as A4,
	P1.Alamat as A5,
	P1.Lokasi as A6,
	P1.Pemegang as A7 
	FROM ta_kib_108 P1 
	LEFT JOIN ref_rek_aset108_7 P2 ON P2.Kd_Aset=P1.Kd_Aset_108 
	WHERE Kd_UPB LIKE '".$KdS."%' AND Kd_Aset_108 LIKE '1.3.3.%' AND Pemegang<>'' 
	ORDER BY P1.Referensi";
	#echo $SQL;
	$nRo = mysql_query($SQL);
	while ($mRo = mysql_fetch_array($nRo))
	{ 
		$x0 = "";
		$x1 = $mRo[1];
		$x2 = $mRo[2];
		$x3 = $mRo[3];
		$x4 = $mRo[4];
		$x5 = $mRo[5];
		$x6 = $mRo[6];
		$x7 = $mRo[7];
		$x8 = $mRo[8];
  ?>
  <tr height="19">
    <td style="border:1px solid #000; text-align:center"><?=$iG?>.</td>
    <td style="border:1px solid #000; text-align:center"><?=$x1?></td>
    <td style="border:1px solid #000; text-align:center"><?=$x2?></td>
    <td style="border:1px solid #000; padding-left:2px"><?=$x3?></td>
    <td style="border:1px solid #000; padding-left:2px"><?=$x4?></td>
    <td style="border:1px solid #000; padding-left:2px"><?=$x6?></td>
    <td style="border:1px solid #000; padding-left:2px"><?=$x7?></td>
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
	<?php
		$iG++;
	}
	?>
	<?php	if ($iG==1){?>
  <tr height="100">
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
  <tr>
    <td colspan="19" style="border:1px solid #000">&nbsp;</td>
  </tr>
</table>
<table border="0" width="2200" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:10pt">  
  <tr style="text-align:center">
    <td width="500">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="500">&nbsp;</td>
  </tr>
  <tr height="30" style="text-align:center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?=$NmIbuk.", ".$TgD?></td>
  </tr>
  <tr style="text-align:center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?=$Vx?></td>
  </tr>
  <tr height="70" style="text-align:center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr style="text-align:center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="font-weight:bold; text-decoration:underline"><?=$fP1Nma?></td>
  </tr>
  <tr style="text-align:center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>NIP. <?=$fP1Nip?></td>
  </tr>
  <tr style="text-align:center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="font-size:9pt"><?=$fP1Pkt?></td>
  </tr>
  <tr style="text-align:center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
