<?php
require('Connection.php');
require('FileFunction.php');

extract($_GET);
#$Tg1 = $TH1."-".substr("0".$BL1,-2,2)."-".substr("0".$HR1,-2,2);
#$Tg2 = $TH2."-".substr("0".$BL2,-2,2)."-".substr("0".$HR2,-2,2);
#$Tg3 = $TH3."-".substr("0".$BL3,-2,2)."-".substr("0".$HR3,-2,2);
//echo $IdT;
$nSQ = "SELECT 
P2.Nm_Unit as A0,
P3.Nm_Unit as A1,
Referensi as A2,
Tanggal as A3,
Nomor as A4,
Lampiran as A5,
Perihal as A6,
KpdYth as A7,
Sebab as A8,
NmKepala as A9,
JbKepala as A10,
NiKepala as A11 
FROM ta_surat_usulan_mutasi P1 
LEFT JOIN ref_unit P2 ON P2.Kd_Unit=P1.KdUnit 
LEFT JOIN ref_unit P3 ON P3.Kd_Unit=P1.KdUnitKe 

WHERE P1.IDT='".$IdT."'";
$nRs = mysql_query($nSQ);
$mRo = mysql_fetch_array($nRs);
$SkA = $mRo[0];
$SkB = $mRo[1];
$TgL = $mRo[3];
$NoM = $mRo[4];
$LaM = $mRo[5];
$PeR = $mRo[6];
$KpD = $mRo[7];
$SbB = $mRo[8];

$NmA = $mRo[9];
$JaB = $mRo[10];
$NiP = $mRo[11];
?>
<table border="0" align="center" width="600" cellpadding="0" cellspacing="0" style="font-size:10pt; font-family: calibri; border-collapse: collapse">
	<tr>
	  <td width="90" rowspan="4" align="center" style="font-size: 12pt; font-weight: bold"><img src="Images/Logo Litle.gif" height="55" width="45" /></td>
	  <td width="710" align="center" style="font-size: 12pt; font-weight: bold">PEMERINTAH <?=$TiDaer." ".$NmDaer?></td>
	</tr>
	<tr>
	  <td style="font-size: 10pt" align="center"><?=$Almat1?></td>
	</tr>
	<tr>
	  <td style="font-size: 10pt" align="center"><?=$Almat2?></td>
	</tr>
	<tr>
	  <td style="font-size: 10pt" align="center">&nbsp;</td>
	</tr>
	<tr>
	  <td style="font-size: 12pt; font-weight: bold; border-top:2px solid #000000" align="center">&nbsp;</td>
	</tr>
</table>
<table border="0" align="center" width="600" cellpadding="0" cellspacing="0" style="font-size:12pt; font-family: calibri; border-collapse: collapse">
	<tr>
		<td width="67">Nomor</td>
		<td width="24">:</td>
		<td colspan="2"><?=$NoM?></td>
		<td width="163"><?=$NmIbuk?>, <?=fConvertDateLongsBln($TgL)?></td>
	</tr>
	<tr>
	  <td>Lampiran</td>
	  <td>:</td>
	  <td colspan="2"><?=$LaM." (".fNmAngka($LaM).")"?> berkas</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>Perihal</td>
	  <td>:</td>
	  <td colspan="2"><?=$PeR?></td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="2">&nbsp;</td>
	  <td>Kepada Yth.</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="2">&nbsp;</td>
	  <td><?=$KpD?></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="2">&nbsp;</td>
	  <td>di-</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="2">&nbsp;</td>
	  <td align="center">Tempat</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="2">&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="3" style="text-align:justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sehubungan dengan adanya rencana Mutasi Barang Milik Daerah dari <b><?=ucwords(strtolower($SkA))?></b> Kabupaten Hulu Sungai Tengah ke <b><?=ucwords(strtolower($SkB))?></b> Kabupaten Hulu Sungai Tengah, dengan ini kami sampaikan Daftar Usulan Mutasi Barang Milik Daerah dimaksud sebagaimana terlampir. Barang Milik Daerah tersebut kami usulkan untuk mutasi disebabkan karena <?=$SbB?>. </td>
  </tr>
  <tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="3">&nbsp;</td>
  </tr>
  <tr height="30">
	  <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">Sebagai bahan pertimbangan, bersama ini kami lampirkan :</td>
  </tr>
  <tr>
	  <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="28">1.</td>
      <td width="318">Data KIB Barang Milik Daerah yang bersangkutan</td>
      <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>2.</td>
	  <td>Dokumen Foto</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian disampaikan sebagai bahan lebih lanjut, atas perhatiannya diucapkan terimakasih.</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
</table>
<table border="0" align="center" width="600" cellpadding="0" cellspacing="0" style="font-size:11pt; font-family: calibri; border-collapse: collapse">
  <tr>
	  <td width="266">&nbsp;</td>
	  <td width="71">&nbsp;</td>
	  <td align="center"><?=$JaB?></td>
  </tr>
  <tr height="70">
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
  <tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td align="center" style="font-weight:bold; text-decoration:underline"><?=$NmA?></td>
  </tr>
  <tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td align="center">NIP. <?=$NiP?></td>
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
</table>
