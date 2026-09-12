<?
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
Tahun as A13,
Catatan_1 as A14,
Catatan_2 as A15,
Catatan_3 as A16,
Catatan_4 as A17 
FROM tb_rekonsiliasi 
WHERE IDT='$gID'"; 
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
	$gSem  = $mRo[12];
	$gThn  = $mRo[13];
	
	$gCt1  = $mRo[14];
	$gCt2  = $mRo[15];
	$gCt3  = $mRo[16];
	$gCt4  = $mRo[17];
}

$g02  = fGlobal("bidang","tb_bidang","kode",$g02v,"=","",DatabaseSA,$ConSA,"");
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

if ($model=='V3')
{
	$KL1 = "Laporan BMD<br>Pengguna<br>Barang (Rp)";
	$KL2 = "Neraca SKPD<br>(Rp)";
}
if ($model=='V4')
{
	$KL1 = "Laporan BMD<br>Pemerintah<br>Daerah (Rp)";
	$KL2 = "Neraca<br>Pemerintah<br>Daerah (Rp)";
}

if ($crt=='AWAL')
{
	$TG = $gThn."-01-01"; 
	$gTgBM = $gThn."-01-01"; 
}
else
{
	if ($gSem==1)
	{
		$gTgBM = $gThn."-06-30"; 
	}
	else
	{
		$gTgBM = $gThn."-12-31"; 
	}
}
$KdB = $g02v;
$KdR = "1.1.12.01.03.001.01.01094";
$KdR = "%";

$Awal = 0;
if ($KdB!='')
{
 	if ($crt=='AWAL')
	{
		$gDT = fGlobal("f_111:f_131:f_132:f_133:f_134:f_135:f_136:f_137:f_151:f_152:f_153:f_154:f_155:f_156","tb_rekonsiliasi_lampiran_1","Nomor",$g01,"=","",DatabaseSA,$ConSA,"");
		$gDT = explode(':',$gDT);
		$f111 = $gDT[0];
		$f131 = $gDT[1];
		$f132 = $gDT[2];
		$f133 = $gDT[3];
		$f134 = $gDT[4];
		$f135 = $gDT[5];
		$f136 = $gDT[6];
		$f137 = $gDT[7];
		
		$f151 = $gDT[8];
		$f152 = $gDT[9];
		$f153 = $gDT[10];
		$f154 = $gDT[11];
		$f155 = $gDT[12];
		$f156 = $gDT[13];
	}
	else
	{
		$gDT = fGlobal("f_111e:f_131e:f_132e:f_133e:f_134e:f_135e:f_136e:f_137e:f_151e:f_152e:f_153e:f_154e:f_155e:f_156e","tb_rekonsiliasi_lampiran_1","Nomor",$g01,"=","",DatabaseSA,$ConSA,"");
		$gDT = explode(':',$gDT);
		$f111 = $gDT[0];
		$f131 = $gDT[1];
		$f132 = $gDT[2];
		$f133 = $gDT[3];
		$f134 = $gDT[4];
		$f135 = $gDT[5];
		$f136 = $gDT[6];
		$f137 = $gDT[7];
		
		$f151 = $gDT[8];
		$f152 = $gDT[9];
		$f153 = $gDT[10];
		$f154 = $gDT[11];
		$f155 = $gDT[12];
		$f156 = $gDT[13];
	}
}

?>
<table border="0" width="700" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td></td>
    <td width="60" style="font-weight:bold">Lampiran</td>
    <td width="18">&nbsp;</td>
    <td width="150">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td>Nomor</td>
    <td>:</td>
    <td><?=$g01?></td>
  </tr>
  <tr>
    <td></td>
    <td>Tanggal</td>
    <td>:</td>
    <td><?=fConvertDateLongBln($TgL)?></td>
  </tr>
</table>
<table border="0" width="700" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:11pt">
  
  <tr>
    <td style="text-align:center; font-size:11pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:11pt; font-weight:bold; font-family:calibri">BERITA ACARA REKONSILIASI</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:11pt; font-weight:bold; font-family:calibri">SALDO <?=$crt?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:11pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
</table>
<table border="0" width="700" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr style="text-align:center; font-weight:bold">
    <td rowspan="2" style=" border:1px solid #000">No.</td>
    <td rowspan="2" style=" border:1px solid #000">Uraian</td>
    <td colspan="2" style=" border:1px solid #000; text-transform:capitalize">Saldo <?=strtolower($crt)?> Per <?=fConvertDateShort($gTgBM)?></td>
    <td rowspan="2" style=" border:1px solid #000">Perbedaan<br>(Rp)</td>
  </tr>
  <tr style="text-align:center; font-weight:bold">
    <td style=" border:1px solid #000"><?=$KL1?></td>
    <td style=" border:1px solid #000"><?=$KL2?></td>
  </tr>
  <tr style="text-align:center">
    <td width="30" style="border:1px solid #000; border-bottom:3px double #000">1</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">2</td>
    <td width="130" style="border:1px solid #000; border-bottom:3px double #000">3</td>
    <td width="130" style="border:1px solid #000; border-bottom:3px double #000">4</td>
    <td width="130" style="border:1px solid #000; border-bottom:3px double #000">5</td>
  </tr>
  <tr height="22" style="font-weight:bold">
    <td style=" border:1px solid #000; text-align:center">A</td>
    <td style=" border:1px solid #000; padding-left:5px">ASET LANCAR</td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22">
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000; padding-left:15px">Persediaan</td>
    <td style=" border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($f111)?></td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22">
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22" style="font-weight:bold">
    <td style=" border:1px solid #000; text-align:center">B</td>
    <td style=" border:1px solid #000; padding-left:5px">ASET TETAP</td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22">
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000; padding-left:5px">1. Tanah</td>
    <td style=" border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($f131)?></td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22">
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000; padding-left:5px">2. Peralatan dan Mesin</td>
    <td style=" border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($f132)?></td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22">
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000; padding-left:5px">3. Gedung dan Bangunan</td>
    <td style=" border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($f133)?></td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22">
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000; padding-left:5px">4. Jalan, Jaringan dan Irigasi</td>
    <td style=" border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($f134)?></td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22">
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000; padding-left:5px">5. Aset Tetap Lainnya</td>
    <td style=" border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($f135)?></td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22">
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000; padding-left:5px">6. Konstruksi Dalam Pengerjaan</td>
    <td style=" border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($f136)?></td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22">
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000; padding-left:5px">7. Akumulasi Penyusutan</td>
    <td style=" border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($f137)?></td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22" style="font-weight:bold">
    <td style=" border:1px solid #000; text-align:center">C</td>
    <td style=" border:1px solid #000; padding-left:5px">ASET LAINNYA</td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22">
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000; padding-left:5px">1. Kemitraan dengan Pihak Ketiga</td>
    <td style=" border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($f152)?></td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22">
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000; padding-left:5px">2. Aset Tidak Berwujud</td>
    <td style=" border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($f153)?></td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22">
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000; padding-left:5px">3. Aset Lain-lain</td>
    <td style=" border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($f154)?></td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22">
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000; padding-left:5px">4. Akumulasi Amortisasi Aset Tidak Berwujud</td>
    <td style=" border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($f155)?></td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="22">
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000; padding-left:5px">5. Akumulasi Penyusutan Aset Lainnya</td>
    <td style=" border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($f156)?></td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
  
  <tr>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
    <td style=" border:1px solid #000">&nbsp;</td>
  </tr>
</table>
<table border="0" width="700" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Penjelasan terjadinya perbedaan :</td>
  </tr>
  
  <tr height="24">
    <td>1.<?=str_repeat('&nbsp;',2).$gCt1?></td>
  </tr>
  <tr height="24">
    <td>2.<?=str_repeat('&nbsp;',2).$gCt2?></td>
  </tr>
  <tr height="24">
    <td>3.<?=str_repeat('&nbsp;',2).$gCt3?></td>
  </tr>
  <tr height="24">
    <td>4.<?=str_repeat('&nbsp;',2).$gCt4?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <?
  if ($crt=='AKHIR')
  {
  ?>
  <tr>
    <td>
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
	</table>	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<table border="0" width="100%" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
      <? if ($model=="V3"){?>
	  <tr>
        <td style="text-align:center; font-weight:bold">Mengetahui,<br>Kepala SKPD</td>
      </tr>
	  <? } ?>
      <? if ($model=="V4"){?>
	  <tr>
        <td style="text-align:center; font-weight:bold">Mengetahui,<br>Pejabat Penatausahaan Barang</td>
      </tr>
	  <? } ?>
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
	</table>	</td>
  </tr>
  <? } ?>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
