<?php
require "../../connfile.php";
require "../../configfile.php";
require "../../functionfile.php";

#Posisi di Mutasi Keluar
extract($_GET);
$DtA = fGlobal("KdBidang:KdBidangTo:Nomor:Tanggal:NoPermohonan","tb_mutasi","IDT",$gID,"=","",DatabaseSA,$ConSA,"");
$DtA = explode(':',$DtA);
$BiD = $DtA[0];
$BiT = $DtA[1];
$NoM = $DtA[2];
$TgL = $DtA[3];
$NoP = $DtA[4];

$DtB = fGlobal("SPPB_Nomor:SPPB_Tanggal","tb_mutasi_permohonan","Nomor",$NoP,"=","",DatabaseSA,$ConSA,"");
$DtB = explode(':',$DtB);
$NoB = $DtB[0];
if ($NoB==''){$NoB="-";}
$TgB = $DtB[1];
if ($TgB=='3000-01-01'){$TgB="-";}

$NmPG = fGlobal("Nm_Pengurus","tb_bidang","kode",substr($BiD,0,11),"=","",DatabaseSA,$ConSA,"");
$NiPG = fGlobal("Nip_Pengurus","tb_bidang","kode",substr($BiD,0,11),"=","",DatabaseSA,$ConSA,"");
$JbPG = fGlobal("Jbt_Pengurus","tb_bidang","kode",substr($BiD,0,11),"=","",DatabaseSA,$ConSA,"");

#$NmPT = "-";
#$NiPT = "-";
#$JbPT = "-";

#$NmPG = fGlobal("Nm_Pimpinan","tb_bidang_sub","kode",$BiD,"=","",DatabaseSA,$ConSA,"");
#$NiPG = fGlobal("Nip_Pimpinan","tb_bidang_sub","kode",$BiD,"=","",DatabaseSA,$ConSA,"");
#$JbPG = fGlobal("Jbt_Pimpinan","tb_bidang_sub","kode",$BiD,"=","",DatabaseSA,$ConSA,"");

$NmPT = fGlobal("Nm_Pimpinan","tb_bidang_sub","kode",$BiT,"=","",DatabaseSA,$ConSA,"");
$NiPT = fGlobal("Nip_Pimpinan","tb_bidang_sub","kode",$BiT,"=","",DatabaseSA,$ConSA,"");
$JbPT = fGlobal("Jbt_Pimpinan","tb_bidang_sub","kode",$BiT,"=","",DatabaseSA,$ConSA,"");

?> 
<body>
<table border="0" width="650" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td width="567"></td>
    <td width="131" style="text-align:right; font-size:10pt">Format II.I.9</td>
  </tr>
</table>
<table border="0" width="650" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td colspan="6" style="text-align:center; font-size:11pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" style="text-align:center; font-size:11pt; font-weight:bold; font-family:calibri">BERITA ACARA SERAH TERIMA (BAST)</td>
  </tr>
  <tr>
    <td colspan="6" style="text-align:center; font-size:11pt; font-weight:bold; font-family:calibri">PENYALURAN BARANG PERSEDIAAN</td>
  </tr>
  <tr>
    <td colspan="6" style="text-align:center; font-size:10pt; font-family:calibri">Nomor : <?=$NoM?></td>
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
    <td width="444" colspan="2"><?=$NmPG?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>NIP</td>
    <td>:</td>
    <td colspan="2"><?=$NiPG?></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Pangkat / Gol</td>
    <td>:</td>
    <td colspan="2"><?=$JbPG?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4" style="text-align:justify; padding-right:10px">Dalam hal ini bertindak sebagai <?=ucwords(strtolower($JbPG))?>, selanjutnya disebut PIHAK PERTAMA. </td>
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
    <td colspan="2"><?=$NmPT?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>NIP</td>
    <td>:</td>
    <td colspan="2"><?=$NiPT?></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Pangkat / Gol </td>
    <td>:</td>
    <td colspan="2"><?=$JbPT?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4" style="text-align:justify; padding-right:10px">Dalam hal ini bertindak sebagai penerima BMD berupa barang persediaan, selanjutnya disebut PIHAK KEDUA. </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" style="padding-left:20px; text-align:justify; padding-right:10px">PIHAK PERTAMA telah melakukan serah terima BMD pada PIHAK KEDUA berupa barang persediaan, berdasarkan Surat Perintah Penyaluran Barang (SPPB) Tanggal <?=$TgB?> Nomor : <?=$NoB?> dengan rincian sebagai berikut: </td>
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
    <td colspan="5">
	<table border="0" width="620" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:9pt">
      <tr height="24" style="font-weight:bold; text-align:center">
        <td width="30" style="border:1px solid #000">No.</td>
        <td width="105" style="border:1px solid #000">Kode Barang </td>
        <td style="border:1px solid #000">Nama Barang </td>
        <td width="120" style="border:1px solid #000">Spesifikasi Nama Barang </td>
        <td width="54" style="border:1px solid #000">Jumlah</td>
        <td width="74" style="border:1px solid #000">Satuan</td>
        <td width="86" style="border:1px solid #000">Ket.</td>
      </tr>
      <tr>
        <td style="border:1px solid #000; text-align:center">1</td>
        <td style="border:1px solid #000; text-align:center">2</td>
        <td style="border:1px solid #000; text-align:center">3</td>
        <td style="border:1px solid #000; text-align:center">4</td>
        <td style="border:1px solid #000; text-align:center">5</td>
        <td style="border:1px solid #000; text-align:center">6</td>
        <td style="border:1px solid #000; text-align:center">7</td>
      </tr>
	<?php
	$iG=1; 
	$nSQ="SELECT P1.IDT as A0, 
	P1.KdPersediaan as A1, 
	P2.nm_rek as A2, 
	P1.QTY as A3, 
	P2.Satuan as A4, 
	P1.Referensi as A5,
	P3.nm_rek as A6 
	FROM tb_mutasi_rinci P1  
	LEFT JOIN ref_rek_90_8_persediaan P2 ON P2.kd_rek=P1.KdPersediaan 
	LEFT JOIN ref_rek_90_7_persediaan P3 ON P3.kd_rek=left(P1.KdPersediaan,19) 
	WHERE P1.Nomor='$NoM' ORDER BY P1.Referensi"; 
	$nRs = mysql_query($nSQ); 
	while ($mRo = mysql_fetch_array($nRs)) 
	{ 
		?>
		<tr height="19">
		<td style="border:1px solid #000; text-align:center"><?=$iG?>.</td>
		<td style="border:1px solid #000; text-align:center"><?=substr($mRo[1],0,19)?></td>
		<td style="border:1px solid #000; padding-left:3px"><?=$mRo[6]?></td>
		<td style="border:1px solid #000; padding-left:3px"><?=$mRo[2]?></td>
		<td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo[3])?></td>
		<td style="border:1px solid #000; text-align:center"><?=$mRo[4]?></td>
		<td style="border:1px solid #000; padding-left:3px">-</td>
		</tr>
		<?php
		$iG++;
		$mRo3 = $mRo3+$mRo[3];
	}
	?>
      <tr style="font-weight:bold">
        <td colspan="4" style="border:1px solid #000; text-align:center">Jumlah</td>
        <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo3)?></td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  

  <tr>
    <td>&nbsp;</td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5">Berita acara serah terima ini dibuat sebagai bukti pengeluaran barang persediaan. </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5">&nbsp;</td>
  </tr>
  
  <tr style="font-weight:bold">
    <td colspan="6">
	<table border="0" width="100%" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
      <tr>
        <td width="300" style="text-align:center; font-weight:bold">PIHAK PERTAMA</td>
        <td style="text-align:center">&nbsp;</td>
        <td width="300" style="text-align:center; font-weight:bold">PIHAK KEDUA </td>
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
        <td style="text-align:center; text-decoration:underline; font-weight:bold"><?=$NmPG?></td>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center; text-decoration:underline; font-weight:bold"><?=$NmPT?></td>
      </tr>
      <tr>
        <td style="text-align:center">NIP. <?=$NiPG?></td>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">NIP. <?=$NiPT?></td>
      </tr>
      <tr>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
        <td style="text-align:center">&nbsp;</td>
      </tr>
	</table>	</td>
  </tr>
  


  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
</table>
<br>