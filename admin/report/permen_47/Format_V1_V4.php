<?php
require "../../connfile.php";
require "../../configfile.php";
require "../../functionfile.php";

extract($_GET);
$nSQ = "SELECT IDT as A0,
Nomor as A1,
Tanggal as A2,
KdSkpd as A3,
PI_Nama as A4,
PI_Nip as A5,
PI_PangkatGol as A6,
PI_Jabatan as A7,
PII_Nama as A8,
PII_Nip as A9,
PII_PangkatGol as A10,
PII_Jabatan as A11,
Semester as A12,
Tahun as A13 
FROM tb_rekonsiliasi 
WHERE IDT='$gID'"; 
#echo $nSQ;
$nRs = mysql_query($nSQ); 
while ($mRo = mysql_fetch_array($nRs)) 
{ 
	$g01 = $mRo[1];
	$TgL = $mRo[2];
	$g02v = $mRo[3];
	$gP1Nma = $mRo[4];
	$gP1Nip = $mRo[5];
	$gP1Pkt = $mRo[6];
	$gP1Jab = $mRo[7];
	
	$gP2Nma = $mRo[8];
	$gP2Nip = $mRo[9];
	$gP2Pkt = $mRo[10];
	$gP2Jab = $mRo[11];
	$Sem = $mRo[12];
	$Thn = $mRo[13];
}


$g02  = fGlobal("bidang","tb_bidang","kode",$g02v,"=","",DatabaseSA,$ConSA,"");
$gAL  = fGlobal("Alamat","tb_bidang","kode",$g02v,"=","",DatabaseSA,$ConSA,"");
if ($gAL==''){$gAL="Alamat..........";}

if ($model=="V3")
{
	$gP3Nma = fGlobal("Nm_Kepala","tb_bidang","kode",$g02v,"=","",DatabaseSA,$ConSA,"");
	$gP3Nip = fGlobal("Nip_Kepala","tb_bidang","kode",$g02v,"=","",DatabaseSA,$ConSA,"");
}
else if ($model=="V4")
{
	$gP3Nma = fGlobal("Nm_Kepala","tb_bidang","kode","24.04.13.01","=","",DatabaseSA,$ConSA,"");
	$gP3Nip = fGlobal("Nip_Kepala","tb_bidang","kode","24.04.13.01","=","",DatabaseSA,$ConSA,"");
}
?> 
<body>
<table border="0" width="600" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td width="567"></td>
    <td width="131" style="text-align:right; font-size:10pt">Format <?=substr($model,0,1).".".substr($model,-1,1)?></td>
  </tr>
</table>
<table border="0" width="600" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #000; border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr height="10">
    <td colspan="6" style="text-align:center; font-size:11pt; font-weight:bold; font-family:calibri"></td>
  </tr>
  <tr>
    <td colspan="6" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">
	<table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse; font-family:Calibri; font-size:9pt">
	<tr>
	  <td width="60" rowspan="3" style="text-align:center"><img src="../../images/logolitle.png" height="40"></td>
	  <td style="font-weight:bold">PEMERINTAH <?=strtoupper($NmTING." ".$NmDAER)?></td>
	</tr>
	<tr>
	  <td style="font-weight:bold"><?=$g02?></td>
	</tr>
	<tr>
	  <td style=" font-family:arial; font-size:8pt"><?=$gAL?></td>
	</tr>
	<tr>
	  <td style="border-bottom:1px  solid #000"></td>
	  <td style="border-bottom:1px  solid #000">&nbsp;</td>
	  </tr>
	</table>	</td>
  </tr>
  <tr>
    <td colspan="6" style="text-align:center; font-size:11pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" style="text-align:center; font-size:11pt; font-weight:bold; font-family:calibri">BERITA ACARA REKONSILIASI</td>
  </tr>
  
  <tr>
    <td colspan="6" style="text-align:center; font-size:10pt; font-family:calibri">Nomor : <?=$g01?></td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" style="padding-left:20px; text-align:justify; padding-right:10px">Pada hari ini <?=funcDayBI(date('l', strtotime($TgL)))?> tanggal <?=(int)substr($TgL,-2,2)?> bulan <?=fNmBulanLong((int)substr($TgL,5,2))?> tahun <?=substr($TgL,0,4)?> bertempat di <?=$NmTING." ".$NmDAER?> yang bertandatangan di bawah ini : </td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr height="22">
    <td width="21">&nbsp;</td>
    <td width="21">I.</td>
    <td width="140">Nama</td>
    <td width="22">:</td>
    <td width="444" colspan="2"><?=$gP1Nma?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>NIP</td>
    <td>:</td>
    <td colspan="2"><?=$gP1Nip?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Pangkat / Gol.</td>
    <td>:</td>
    <td colspan="2"><?=$gP1Pkt?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Jabatan</td>
    <td>:</td>
    <td colspan="2"><?=$gP1Jab?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4" style="text-align:justify; padding-right:10px">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4" style="text-align:justify; padding-right:10px">Dalam hal ini bertindak sebagai <?=rekonsPh1($model)?>, selanjutnya disebut PIHAK PERTAMA. </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>II.</td>
    <td>Nama</td>
    <td>:</td>
    <td colspan="2"><?=$gP2Nma?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>NIP</td>
    <td>:</td>
    <td colspan="2"><?=$gP2Nip?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Pangkat / Gol. </td>
    <td>:</td>
    <td colspan="2"><?=$gP2Pkt?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Jabatan</td>
    <td>:</td>
    <td colspan="2"><?=$gP2Jab?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4" style="text-align:justify; padding-right:10px">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4" style="text-align:justify; padding-right:10px">Dalam hal ini bertindak <?=rekonsPh2($model)?>, selanjutnya disebut PIHAK KEDUA. </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" style="padding-left:20px; text-align:justify; padding-right:10px">PIHAK PERTAMA dan PIHAK KEDUA telah melaksanakan rekonsiliasi data BMD dengan membandingkan data laporan BMD Semester <?=$Sem?> Tahun <?=$Thn?> dengan hasil sebagaimana dalam lampiran.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td colspan="5">Demikian Berita Acara Rekonsiliasi dibuat dengan sebenar-benarnya, untuk dapat dipergunakan dalam rangka mendukung Laporan BMD.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5">&nbsp;</td>
  </tr>
  
  <tr style="font-weight:bold">
    <td colspan="6">
	<table border="0" width="100%" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
      <tr>
        <td width="280" style="text-align:center; font-weight:bold">PIHAK KEDUA</td>
        <td style="text-align:center">&nbsp;</td>
        <td width="280" style="text-align:center; font-weight:bold">PIHAK PERTAMA</td>
	</tr>
      <tr>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
      </tr>
      <tr>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
      </tr>
      <tr>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
      </tr>
      <tr>
        <td style="text-align:center; text-decoration:underline; font-weight:bold"><?=$gP2Nma?></td>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center; text-decoration:underline; font-weight:bold"><?=$gP1Nma?></td>
      </tr>
      <tr>
        <td style="text-align:center">NIP. <?=$gP2Nip?></td>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">NIP. <?=$gP1Nip?></td>
      </tr>
      <tr>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
      </tr>
	</table>
	</td>
  </tr>
  <?php if ($model=="V3" || $model=="V4"){?>
  <tr>
    <td colspan="6">
	<table border="0" width="100%" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
      <?php if ($model=="V3"){?>
	  <tr>
        <td style="text-align:center; font-weight:bold">Mengetahui,<br>Kepala SKPD</td>
      </tr>
	  <?php } ?>
      <?php if ($model=="V4"){?>
	  <tr>
        <td style="text-align:center; font-weight:bold">Mengetahui,<br>Pejabat Penatausahaan Barang</td>
      </tr>
	  <?php } ?>
      <tr>
        <td style="text-align:center">&nbsp;</td>
      </tr>
      <tr>
        <td style="text-align:center">&nbsp;</td>
        </tr>
      <tr>
        <td style="text-align:center">&nbsp;</td>
      </tr>
      <tr>
        <td style="text-align:center; text-decoration:underline; font-weight:bold"><?=$gP3Nma?></td>
      </tr>
      <tr>
        <td style="text-align:center">NIP. <?=$gP3Nip?></td>
      </tr>
      <tr>
        <td style="text-align:center">&nbsp;</td>
      </tr>
	</table>
	</td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
</table>
<br>