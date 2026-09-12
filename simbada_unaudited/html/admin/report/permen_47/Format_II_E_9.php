<?
require('../../Connection.php');
require('../../FileFunction.php');
require("../../CheckLogin.php");

$DatabaseSA = $DatabaseSB ;
$ConSA      = $ConSB;
extract($_GET);

$KdS= "__.__.__.__.__";

if ($rSem==1) 
{
	$TGx = $rThn."-01-01";
	$TGz = $rThn."-06-30";
}
else 
{
	$TGx = $rThn."-06-01";
	$TGz = $rThn."-12-31";
}

$KdSx = "24.04.04.01";
$Vx   = "PENGELOLA BARANG";
$fP1Nma  = fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit",$KdSx,"=","","");
$fP1Nip  = fGlobal("Nip_Pimpinan","ref_unit","Kd_Unit",$KdSx,"=","","");
$fP1Pkt  = fGlobal("Pkt_Pimpinan","ref_unit","Kd_Unit",$KdSx,"=","","");
$fP1Jab  = fGlobal("Jab_Pimpinan","ref_unit","Kd_Unit",$KdSx,"=","","");

?> 
<body>
<table border="0" width="2350" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td style="text-align:right">Format II.E.9</td>
  </tr>
</table>
<table border="0" width="2400" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri">DAFTAR PEMANFAATAN BMD</td>
  </tr>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri">INTRAKOMPTABEL / EKSTRAKOMPTABEL</td>
  </tr>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri">BENTUK PEMANFAATAN <?=strtoupper($nR)?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri; font-size:10pt">KABUPATEN <?=strtoupper($NmDaer)?></td> 
  </tr>
  <tr>
    <td style="text-align:center; font-family:calibri; font-weight:bold; font-size:10pt"><?=strtoupper(NmaSemester($rSem))?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-family:calibri; font-weight:bold; font-size:10pt">TAHUN : <?=$rThn?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="2400" align="center" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:9pt">
  <tr height="25" style="font-weight:bold; text-align:center">
    <td rowspan="3" style="border:1px solid #000">No</td>
    <td rowspan="3" style="border:1px solid #000">Pengguna Barang<br>atau Pengelola Barang</td>
    <td rowspan="3" style="border:1px solid #000">NIBAR</td>
    <td colspan="2" rowspan="2" style="border:1px solid #000">Penggolongan dan Kodefikasi Barang</td>
    <td rowspan="3" style="border:1px solid #000">Spesifikasi<br>Nama Barang</td>
    <td rowspan="3" style="border:1px solid #000">Nilai<br>Perolehan<br>Barang<br>(Rp)</td>
    <td rowspan="3" style="border:1px solid #000">Mitra<br>Pemanfaatan/Pihak<br>Pemanfaatan</td>
    <td rowspan="3" style="border:1px solid #000">Jumlah</td>
    <td rowspan="3" style="border:1px solid #000">Satuan</td>
    <td rowspan="3" style="border:1px solid #000">Lokasi</td>
    <td colspan="3" rowspan="2" style="border:1px solid #000">Jangka Waktu</td>
    <td rowspan="3" style="border:1px solid #000">Peruntukan</td>
    <td rowspan="3" style="border:1px solid #000">Pemanfaatan<br>Tanah dan/atau<br>bangunan</td>
    <td colspan="4" style="border:1px solid #000">Dasar Penggunaan</td>
    <td colspan="3" rowspan="2" style="border:1px solid #000">Dokumen Pendukung<br>Lainnya</td>
    <td rowspan="3" style="border:1px solid #000">Pelaksana<br>Pemanfaatan</td>
    <td rowspan="3" style="border:1px solid #000">Keterangan</td>
  </tr>
  <tr height="25" style="font-weight:bold; text-align:center">
    <td colspan="2" style="border:1px solid #000">Surat Persetujuan</td>
    <td colspan="2" style="border:1px solid #000">Surat Perjanjian</td>
  </tr>
  <tr height="25" style="font-weight:bold; text-align:center">
    <td style="border:1px solid #000">Kode Barang</td>
    <td style="border:1px solid #000">Nama Barang</td>
    <td style="border:1px solid #000">Waktu<br>Pemanfaatan</td>
    <td style="border:1px solid #000">Mulai</td>
    <td style="border:1px solid #000">Berakhir</td>
    <td style="border:1px solid #000">Nomor</td>
    <td style="border:1px solid #000">Tanggal</td>
    <td style="border:1px solid #000">Nomor</td>
    <td style="border:1px solid #000">Tanggal</td>
    <td style="border:1px solid #000">Nama</td>
    <td style="border:1px solid #000">Nomor</td>
    <td style="border:1px solid #000">Tanggal</td>
  </tr>
  <tr style="text-align:center">
    <td width="25" style="border:1px solid #000; border-bottom:3px double #000">(5)</td>
    <td width="150" style="border:1px solid #000; border-bottom:3px double #000">(6)</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">(7)</td>
    <td width="100" style="border:1px solid #000; border-bottom:3px double #000">(8)</td>
    <td width="140" style="border:1px solid #000; border-bottom:3px double #000">(9)</td>
    <td width="140" style="border:1px solid #000; border-bottom:3px double #000">(10)</td>
    <td width="80" style="border:1px solid #000; border-bottom:3px double #000">(11)</td>
    <td width="140" style="border:1px solid #000; border-bottom:3px double #000">(12)</td>
    <td width="50" style="border:1px solid #000; border-bottom:3px double #000">(13)</td>
    <td width="80" style="border:1px solid #000; border-bottom:3px double #000">(14)</td>
    <td width="150" style="border:1px solid #000; border-bottom:3px double #000">(15)</td>
    <td width="70" style="border:1px solid #000; border-bottom:3px double #000">(16)</td>
    <td width="70" style="border:1px solid #000; border-bottom:3px double #000">(17)</td>
    <td width="70" style="border:1px solid #000; border-bottom:3px double #000">(18)</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">(19)</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">(20)</td>
    <td width="100" style="border:1px solid #000; border-bottom:3px double #000">(21)</td>
    <td width="70" style="border:1px solid #000; border-bottom:3px double #000">(22)</td>
    <td width="100" style="border:1px solid #000; border-bottom:3px double #000">(23)</td>
    <td width="70" style="border:1px solid #000; border-bottom:3px double #000">(24)</td>
    <td width="140" style="border:1px solid #000; border-bottom:3px double #000">(25)</td>
    <td width="100" style="border:1px solid #000; border-bottom:3px double #000">(26)</td>
    <td width="70" style="border:1px solid #000; border-bottom:3px double #000">(27)</td>
    <td width="100" style="border:1px solid #000; border-bottom:3px double #000">(28)</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">(29)</td>
  </tr>
	<?
	mysql_select_db(DatabaseSB, $ConSB);
	$iG=1;
		
	$SQb = "SELECT 
	'' as A0,
	P5.Nma_Pimpinan as A1,
	P1.Referensi as A2,
	P2.Kd_Aset_108 as A3,
	P4.Nm_Aset as A4,
	P2.Nm_Aset as A5,
	sum(P3.debet) as A6,
	P1.Mitra as A7,
	P1.Jumlah as A8,
	P1.Satuan as A9,
	P1.Alamat as A10,
	P1.JangkaWaktu as A11,
	P1.MulaiPenggunaan as A12,
	P1.AkhirPenggunaan as A13,
	P1.Peruntukan as A14,
	P1.Tanah as A15,
	P1.SetujuNomor as A16,
	P1.SetujuTanggal as A17,
	P1.JanjiNomor as A18,
	P1.JanjiTanggal as A19,
	P1.DokLainnyaNama as A20,
	P1.DokLainnyaNomor as A21,
	P1.DokLainnyaTanggal as A22,
	P1.Pemanfaat as A23 
	FROM ta_kib_108_p47_pemanfaatan P1 
	LEFT JOIN ta_kib_108 P2 ON P2.Referensi=P1.Referensi AND P2.Ref_Group=P1.RefGroup 
	LEFT JOIN ta_kib_post_108 P3 ON P3.Referensi=P2.Referensi AND P3.Ref_Group=P2.Ref_Group 
	LEFT JOIN ref_rek_aset108_7 P4 ON P4.Kd_Aset=P2.Kd_Aset_108 
	LEFT JOIN ref_unit P5 ON P5.Kd_Unit=left(P2.Kd_UPB,11) 

	WHERE P1.Bentuk ='".$nR."' AND P2.Kd_UPB LIKE '".$KdS."%' AND (P1.Tanggal BETWEEN '".$TGx."' AND '".$TGz."') 
	GROUP BY P1.Referensi, P2.Ref_Group 
	ORDER BY P1.Referensi";
	#echo $SQb;
	$nRb = mysql_query($SQb);
	while ($mRb = mysql_fetch_array($nRb)) 
	{ 
		$x0 = "";
		$x1 = $mRb[1];
		$x2 = $mRb[2];
		$x3 = $mRb[3];
		$x4 = $mRb[4];
		$x5 = $mRb[5];
		$x6 = $mRb[6];
		$x7 = $mRb[7];
		$x8 = $mRb[8];
		$x9 = $mRb[9];
		$x10 = $mRb[10];
		$x11 = $mRb[11];
		$x12 = $mRb[12];
		$x13 = $mRb[13];
		$x14 = $mRb[14];
		$x15 = $mRb[15];
		$x16 = $mRb[16];
		$x17 = $mRb[17];
		$x18 = $mRb[18];
		$x19 = $mRb[19];
		$x20 = $mRb[20];
		$x21 = $mRb[21];
		$x22 = $mRb[22];
		$x23 = $mRb[23];
		
		$xB = "";
		TempRow($iG,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$x20,$x21,$x22,$x23,$xB);
		$iG++;
	}
	
	
	?>
	
	<? function TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$x20,$x21,$x22,$x23,$xB)
	{
	?>
	<tr height="22" style=" font-weight:<?=$xB?>">
	<td style="border:1px solid #000; text-align:center"><?=$x0?>.</td>
	<td style="border:1px solid #000; text-align:center"><?=$x1?></td>
	<td style="border:1px solid #000; text-align:center"><?=$x2?></td>
	<td style="border:1px solid #000; text-align:center"><?=$x3?></td>
	<td style="border:1px solid #000; padding-left:2px"><?=$x4?></td>
	<td style="border:1px solid #000; padding-left:2px"><?=$x5?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($x6)?></td>
	<td style="border:1px solid #000; padding-left:2px"><?=$x7?></td>
	<td style="border:1px solid #000; text-align:center"><?=$x8?></td>
	<td style="border:1px solid #000; text-align:center"><?=$x9?></td>
	<td style="border:1px solid #000; padding-left:2px"><?=$x10?></td>
	<td style="border:1px solid #000; text-align:center"><?=$x11?></td>
	<td style="border:1px solid #000; text-align:center"><?=fConvertDateShort($x12)?></td>
	<td style="border:1px solid #000; text-align:center"><?=fConvertDateShort($x13)?></td>
	<td style="border:1px solid #000; text-align:center"><?=$x14?></td>
	<td style="border:1px solid #000; padding-left:2px"><?=$x15?></td>
	<td style="border:1px solid #000; text-align:center"><?=$x16?></td>
	<td style="border:1px solid #000; text-align:center"><?=fConvertDateShort($x17)?></td>
	<td style="border:1px solid #000; padding-left:2px"><?=$x18?></td>
	<td style="border:1px solid #000; text-align:center"><?=fConvertDateShort($x19)?></td>
	<td style="border:1px solid #000; padding-left:2px"><?=$x20?></td>
	<td style="border:1px solid #000; padding-left:2px"><?=$x21?></td>
	<td style="border:1px solid #000; text-align:center"><?=fConvertDateShort($x22)?></td>
	<td style="border:1px solid #000; padding-left:2px"><?=$x23?></td>
	<td style="border:1px solid #000; padding-left:2px"><?=$x24?></td>
	</tr>
	<?
	}
	?>
	<? function EmptRow()
	{
	?>
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
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<?
	}
	?>
  <tr height="22">
    <td style="border:1px solid #000; text-align:center">&nbsp;</td>
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
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
  </tr>
</table>
<table border="0" width="2400" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td width="500" style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td width="500" style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center"><?=$NmIbuk?>, <?=$Hri." ".fNmBulanLong($Bln)." ".$Thn?></td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center"><?=$Vx?></td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
  <tr height="50">
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center; font-weight:bold; text-decoration:underline"><?=$fP1Nma?></td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">NIP. <?=$fP1Nip?></td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center"><?=$fP1Pkt?></td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
</table>
