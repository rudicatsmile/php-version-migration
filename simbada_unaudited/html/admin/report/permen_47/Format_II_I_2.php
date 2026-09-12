<?
require "../../connfile.php";
require "../../configfile.php";
require "../../functionfile.php";
extract($_GET);
#Posisi di ...
$DtA = fGlobal("KdBidang:Nomor:Tanggal","tb_pemusnahan","IDT",$gID,"=","",DatabaseSA,$ConSA,"");
$DtA = explode(':',$DtA);
$BiD = substr($DtA[0],0,11);
$NoM = $DtA[1];
$TgL = $DtA[2];

$DtC = fGlobal("Bidang:Nm_Kepala:Nip_Kepala:Nm_Pengurus:Nip_Pengurus:Jbt_Pengurus:Nm_Penyimpan:Nip_Penyimpan:Jbt_Penyimpan:Jbt_Kepala:Alamat","tb_bidang","kode",$BiD,"=","",DatabaseSA,$ConSA,"");
$DtC = explode(':',$DtC);
$SkP = $DtC[0];
$NmP = $DtC[1];
$AlM = $DtC[10];
$NmG = $DtC[3];
$NiG = $DtC[4];
$NmK = fGlobal("Nm_Kepala","tb_bidang","kode","24.04.04.01","=","",DatabaseSA,$ConSA,"");

?> 
<body>
<?
$nSQ="SELECT P1.IDT as A0, 
P1.KdPersediaan as A1, 
P2.nm_rek as A2, 
P1.QTY as A3, 
P2.Satuan as A4, 
P1.Referensi as A5,
P3.nm_rek as A6,
P1.Harga as A7,
P1.TotalHarga as A8 
FROM tb_pemusnahan_rinci P1  
LEFT JOIN ref_rek_90_8_persediaan P2 ON P2.kd_rek=P1.KdPersediaan 
LEFT JOIN ref_rek_90_7_persediaan P3 ON P3.kd_rek=left(P1.KdPersediaan,19) 
WHERE P1.Nomor='$NoM' ORDER BY P1.Referensi"; 
$nRs = mysql_query($nSQ); 
while ($mRo = mysql_fetch_array($nRs)) 
{
?>
<table border="0" width="700" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td width="567"></td>
    <td width="131" style="text-align:right">Format II.I.2</td>
  </tr>
</table>
<table border="0" width="700" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td colspan="8" style="text-align:center; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8" style="text-align:center; font-weight:bold; font-family:calibri">FORMULIR PENGURANGAN BMD BERUPA PERSEDIAAN KARENA RUSAK BERAT ATAU USANG</td>
  </tr>
  <tr>
    <td colspan="8" style="text-align:center; font-weight:bold; font-family:calibri">PENGGUNA BARANG</td>
  </tr>
  <tr>
    <td colspan="8" style="text-align:center; font-weight:bold; font-family:calibri">SKPD : <?=$SkP?></td>
  </tr>
  <tr>
    <td colspan="8" style="text-align:center; font-weight:bold; font-family:calibri">PEMERINTAH <?=strtoupper($NmTING." ".$NmDAER)?></td>
  </tr>
  <tr>
    <td colspan="8" style="text-align:center; font-weight:bold; font-family:calibri">TAHUN <?=substr($TgL,0,4)?></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr height="22" style="font-weight:bold">
    <td width="18">&nbsp;</td>
    <td width="27">I.</td>
    <td colspan="3">Unit Pemakai </td>
    <td width="26">&nbsp;</td>
    <td width="358" colspan="2">&nbsp;</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="23">a.</td>
    <td colspan="2">Kuasa Pengguna Barang </td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>b.</td>
    <td colspan="2">Pengguna Barang </td>
    <td>:</td>
    <td colspan="2"><?=$NmP?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>c.</td>
    <td colspan="2">Pengelola Barang </td>
    <td>:</td>
    <td colspan="2"><?=$NmK?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>d.</td>
    <td colspan="2">Alamat</td>
    <td>:</td>
    <td colspan="2"><?=$AlM?></td>
  </tr>
  <tr style="font-weight:bold">
    <td>&nbsp;</td>
    <td>II.</td>
    <td colspan="3">Data Barang Rusak Berat atau Usang</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>a.</td>
    <td colspan="2">Kode Barang </td>
    <td>:</td>
    <td colspan="2"><?=substr($mRo[1],0,19)?></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>b.</td>
    <td colspan="2">Nama Barang </td>
    <td>:</td>
    <td colspan="2"><?=$mRo[6]?></td></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>c.</td>
    <td colspan="2">Spesifikasi Nama Barang </td>
    <td>:</td>
    <td colspan="2"><?=$mRo[2]?></td></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>d.</td>
    <td colspan="2">NUSP</td>
    <td>:</td>
    <td colspan="2"><?=substr($mRo[1],-5,5)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6"><table border="0" width="500" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
      <tr style="font-weight:bold; text-align:center">
        <td width="57" style="border:1px solid #000">No.</td>
        <td width="73" style="border:1px solid #000">Jumlah</td>
        <td width="116" style="border:1px solid #000">Satuan<br>Barang </td>
        <td width="124" style="border:1px solid #000">Harga Satuan<br>
          (Rp)</td>
        <td width="130" style="border:1px solid #000">Nilai Total<br>
          (Rp)</td>
      </tr>
      <tr>
        <td style="border:1px solid #000; text-align:center">1.</td>
        <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo[3])?></td>
        <td style="border:1px solid #000; text-align:center"><?=$mRo[4]?></td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[7])?></td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[8])?></td>
      </tr>
      <tr>
        <td style="border:1px solid #000">&nbsp;</td>
        <td style="border:1px solid #000; text-align:center">&nbsp;</td>
        <td style="border:1px solid #000; text-align:center">&nbsp;</td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
      </tr>
      <tr style="font-weight:bold">
        <td style="border:1px solid #000; text-align:center">Jumlah</td>
        <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo[3])?></td>
        <td style="border:1px solid #000; text-align:center">&nbsp;</td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[7])?></td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[8])?></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr style="font-weight:bold">
    <td>&nbsp;</td>
    <td>III.</td>
    <td colspan="3">Dokumen Sumber </td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>a.</td>
    <td colspan="2">Berita Acara Perubahan fisik </td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">1. Tanggal, Bulan, Tahun </td>
    <td>:</td>
    <td colspan="2"><?=fConvertDateLongBln($TgL)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">2. Nomor </td>
    <td>:</td>
    <td colspan="2"><?=$NoM?></td>
  </tr>
  
  
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="20">&nbsp;</td>
    <td width="226">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  
  <tr>
    <td>&nbsp;</td>
    <td style="font-weight:bold">IV.</td>
    <td colspan="3" style="font-weight:bold">Keterangan</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">Diinput Oleh </td>
    <td>:</td>
    <td colspan="2">Pengurus Barang Pengguna</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">Nama</td>
    <td>:</td>
    <td colspan="2"><?=$NmG?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">NIP</td>
    <td>:</td>
    <td colspan="2"><?=$NiG?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">Tanggal, Bulan, Tahun Transaksi</td>
    <td>:</td>
    <td colspan="2"><?=fConvertDateLongBln($TgL)?></td>
  </tr>
  
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
</table>
<br><br><br>
<? } ?>