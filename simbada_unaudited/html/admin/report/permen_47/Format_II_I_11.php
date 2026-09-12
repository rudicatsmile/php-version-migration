<?
require "../../connfile.php";
require "../../configfile.php";
require "../../functionfile.php";
extract($_GET);
#Posisi .....

$DtA = fGlobal("KdBidang:Nomor:Tanggal","tb_pemusnahan","IDT",$gID,"=","",DatabaseSA,$ConSA,"");
$DtA = explode(':',$DtA);
$BiD = $DtA[0];
$NoM = $DtA[1];
$TgL = $DtA[2];

$NmPG = fGlobal("Nm_Pengurus","tb_bidang","kode",substr($BiD,0,11),"=","",DatabaseSA,$ConSA,"");
$NiPG = fGlobal("Nip_Pengurus","tb_bidang","kode",substr($BiD,0,11),"=","",DatabaseSA,$ConSA,"");
$JbPG = fGlobal("Jbt_Pengurus","tb_bidang","kode",substr($BiD,0,11),"=","",DatabaseSA,$ConSA,"");

$NmPM = fGlobal("Nm_Kepala","tb_bidang","kode",substr($BiD,0,11),"=","",DatabaseSA,$ConSA,"");
$NiPM = fGlobal("Nip_Kepala","tb_bidang","kode",substr($BiD,0,11),"=","",DatabaseSA,$ConSA,"");

$NmPY = fGlobal("Nm_Penyimpan","tb_bidang","kode",substr($BiD,0,11),"=","",DatabaseSA,$ConSA,"");
$NiPY = fGlobal("Nip_Penyimpan","tb_bidang","kode",substr($BiD,0,11),"=","",DatabaseSA,$ConSA,"");
?> 
<body>
<table border="0" width="650" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri;">
  <tr>
    <td width="567"></td>
    <td width="131" style="text-align:right; font-size:10pt">Format II.I.11</td>
  </tr>
</table>
<table border="0" width="650" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td colspan="5" style="text-align:center; font-size:11pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="text-align:center; font-size:11pt; font-weight:bold; font-family:calibri">BERITA ACARA PERUBAHAN FISIK BMD</td>
  </tr>
  <tr>
    <td colspan="5" style="text-align:center; font-size:11pt; font-family:calibri">Nomor : <?=$NoM?></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="padding-left:20px; text-align:justify; padding-right:10px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada hari ini <?=funcDayBI(date('l', strtotime($TgL)))?> tanggal <?=(int)substr($TgL,-2,2)?> bulan <?=fNmBulanLong((int)substr($TgL,5,2))?> tahun <?=substr($TgL,0,4)?> bertempat di <?=$NmTING." ".$NmDAER?>, telah melakukan pemeriksaan fisik, bahwa terdapat BMD yang rusak berat atau usang, sehingga tidak dapat digunakan dengan rincian sebagi berikut :</td>
  </tr>
  
  <tr height="22">
    <td width="22">&nbsp;</td>
    <td width="22">&nbsp;</td>
    <td width="276">&nbsp;</td>
    <td width="328" colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="5" style="padding-left:20px; text-align:justify"><table border="0" width="620" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:9pt">
      <tr height="24" style="font-weight:bold; text-align:center">
        <td width="30" style="border:1px solid #000">No.</td>
        <td width="70" style="border:1px solid #000">Kode<br>Barang </td>
        <td width="148" style="border:1px solid #000">Nama Barang</td>
        <td width="46" style="border:1px solid #000">NUSP/<br>NIBAR</td>
        <td width="139" style="border:1px solid #000">Spesifikasi<br>Nama Barang </td>
        <td width="54" style="border:1px solid #000">Jumlah</td>
        <td width="71" style="border:1px solid #000">Satuan</td>
        <td style="border:1px solid #000">Ket</td>
      </tr>
      <tr>
        <td style="border:1px solid #000; text-align:center">1</td>
        <td style="border:1px solid #000; text-align:center">2</td>
        <td style="border:1px solid #000; text-align:center">3</td>
        <td style="border:1px solid #000; text-align:center">4</td>
        <td style="border:1px solid #000; text-align:center">5</td>
        <td style="border:1px solid #000; text-align:center">6</td>
        <td style="border:1px solid #000; text-align:center">7</td>
        <td style="border:1px solid #000; text-align:center">8</td>
      </tr>
	<?
	$iG=1; 
	$gNOM = fGlobal("Nomor","tb_pemusnahan","IDT",$gID,"=","",DatabaseSA,$ConSA,""); 
	$gCeK = "";//fGlobal("Status","tb_mutasi","IDT",$gID,"=","",DatabaseSA,$ConSA,""); 
	
	 
	$nSQ="SELECT P1.IDT as A0, 
	P1.KdPersediaan as A1, 
	P2.nm_rek as A2, 
	P1.QTY as A3, 
	P2.Satuan as A4, 
	P1.Referensi as A5,
	P3.nm_rek as A6,
	P1.ReferensiDetailAsal as A7,
	P1.Harga as A8,
	P1.TotalHarga as A9,
	P1.ExpiredDate as A10,
	P1.NoBatch as A11 
	
	FROM tb_pemusnahan_rinci P1  
	LEFT JOIN ref_rek_90_8_persediaan P2 ON P2.kd_rek=P1.KdPersediaan 
	LEFT JOIN ref_rek_90_7_persediaan P3 ON P3.kd_rek=left(P1.KdPersediaan,19) 
	WHERE P1.Nomor='$gNOM' ORDER BY P1.Referensi"; 
	#echo $nSQ;
	$nRs = mysql_query($nSQ); 
	while ($mRo = mysql_fetch_array($nRs)) 
	{ 	
		?>
		<tr>
		<td style="border:1px solid #000; text-align:center"><?=$iG?>.</td>
		<td style="border:1px solid #000; text-align:center"><?=substr($mRo[1],0,19)?></td>
		<td style="border:1px solid #000; padding-left:3px"><?=$mRo[6]?></td>
		<td style="border:1px solid #000; text-align:center"><?=substr($mRo[1],21,10)?></td>
		<td style="border:1px solid #000; padding-left:3px"><?=$mRo[2]?></td>
		<td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo[3])?></td>
		<td style="border:1px solid #000; text-align:center"><?=$mRo[4]?></td>
		<td style="border:1px solid #000">&nbsp;</td>
		</tr>
		<?
		$iG++;
		$mRo3=$mRo3+$mRo[3];
	}
	?>
      <tr style="font-weight:bold">
        <td colspan="5" style="border:1px solid #000; text-align:center">Jumlah</td>
        <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo3)?></td>
        <td style="border:1px solid #000">&nbsp;</td>
        <td style="border:1px solid #000">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">Penyebab BMD rusak berat atau usang dikarenakan alasan :</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>a.</td>
    <td>-</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>b.</td>
    <td>-</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>c</td>
    <td>-</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4" style="padding-right:10px">Demikian berita acara ini dibuat untuk digunakan seperlunya, apabila terdapat kekeliruan akan dilakukan perbaikan sesuai ketentuan</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" style="text-align:center">Menyetujui,</td>
    <td colspan="2" style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" style="text-align:center">Pejabat Penatausahaan<br>Pengguna Barang</td>
    <td colspan="2" style="text-align:center">Pengurus Barang</td>
  </tr>
  <tr style="font-weight:bold">
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr style="font-weight:bold">
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr style="font-weight:bold">
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" align="center" style="text-decoration:underline; font-weight:bold"><?=$NmPY?></td>
    <td colspan="2" align="center" style="text-decoration:underline; font-weight:bold"><?=$NmPG?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" align="center">NIP. <?=$NiPY?> </td>
    <td colspan="2" align="center">NIP. <?=$NiPG?> </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td colspan="4" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4" align="center">Mengetahui,</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4" align="center">Pengguna Barang </td>
  </tr>
  <tr style="font-weight:bold">
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr style="font-weight:bold">
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr style="font-weight:bold">
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td colspan="4" align="center"><?=$NmPM?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4" align="center">NIP. <?=$NiPM?> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  

  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
</table>
