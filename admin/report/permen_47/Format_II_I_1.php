<?php
require "../../connfile.php";
require "../../configfile.php";
require "../../functionfile.php";
extract($_GET);
#Posisi di mutasi keluar

#echo $IdT;

$BiD = "";
$Ref = "";
$ReD = "";
$KdP = "";
$DtA = fGlobal("KdBidang:Nomor:Referensi:KdPersediaan:ExpiredDate:Harga:TotalHarga:QTY_Stock:QTY_Usulan:Qty:RefPermohonan","tb_mutasi_rinci","idt",$IdT,"=","",DatabaseSA,$ConSA,"");
if ($DtA)
{
	$DtA = explode(':',$DtA);
	$BiD = substr($DtA[0],0,11);
	$Ref = $DtA[1];
	$ReD = $DtA[2];
	$KdP = $DtA[3];
	$TeD = $DtA[4];
	if ($TeD!='3000-01-01' && $TeD!='0000-00-00')
	{
		$TeD = fConvertDateShort($TeD);
	}
	else
	{
		$TeD =  "-";
	}
	$HrG = $DtA[5];
	$ToT = $DtA[6];
	
	$QtS = $DtA[7];
	$QtU = $DtA[8];
	$QtY = $DtA[9];
	$ReP = $DtA[10];
	
	$KeP = fGlobal("Keperluan","tb_mutasi_permohonan_rinci","Referensi",$ReP,"=","",DatabaseSA,$ConSA,"");
	$SaT = fGlobal("satuan","ref_rek_90_8_persediaan","kd_rek",$KdP,"=","",DatabaseSA,$ConSA,"");
	
	
	$DtB = fGlobal("tanggal:nomor:KdBidangTo:NoPermohonan","tb_mutasi","nomor",$Ref,"=","",DatabaseSA,$ConSA,"");
	$DtB = explode(':',$DtB);
	$TgL = $DtB[0];
	$NoM = $DtB[1];
	$BiT = $DtB[2];
	$NoP = $DtB[3];
	
	if ($NoP!='')
	{
		$DtP = fGlobal("Nomor_Nota:Nomor:Tanggal:SPPB_Nomor:SPPB_Tanggal","tb_mutasi_permohonan","nomor",$NoP,"=","",DatabaseSA,$ConSA,"");
		$DtP = explode(':',$DtP);
		$NotNom = $DtP[0];
		$SpbNom = $DtP[1];
		$SpbTgl = $DtP[2];
		$SppNom = $DtP[3];
		$SppTgl = $DtP[4];
		
		$NotTgl = fGlobal("tanggal","tb_nota_permintaan","nomor",$NotNom,"=","",DatabaseSA,$ConSA,"");
		if ($NotTgl!='3000-01-01'){$NotTgl=fConvertDateShort($NotTgl);}
		if ($SpbTgl!='3000-01-01'){$SpbTgl=fConvertDateShort($SpbTgl);}
		if ($SppTgl!='3000-01-01'){$SppTgl=fConvertDateShort($SppTgl);}
	}
	
	$NmA = fGlobal("Nm_Rek","ref_rek_90_8_persediaan","Kd_Rek",$KdP,"=","",DatabaseSA,$ConSA,"");
	$NmO = fGlobal("Nm_Rek","ref_rek_90_7_persediaan","Kd_Rek",substr($KdP,0,19),"=","",DatabaseSA,$ConSA,"");
  
	$DtC = fGlobal("Bidang:Nm_Kepala:Nip_Kepala:Nm_Pengurus:Nip_Pengurus:Jbt_Pengurus:Nm_Penyimpan:Nip_Penyimpan:Jbt_Penyimpan:Jbt_Kepala:Alamat","tb_bidang","kode",$BiD,"=","",DatabaseSA,$ConSA,"");
	$DtC = explode(':',$DtC);
	$SkP = $DtC[0];
	$NmP = $DtC[1];
	$AlM = $DtC[10];
	$NmG = $DtC[3];
	$NiG = $DtC[4];
	$NmK = fGlobal("Nm_Kepala","tb_bidang","kode","24.04.04.01","=","",DatabaseSA,$ConSA,"");
	
}
?> 
<body>
<table border="0" width="700" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td width="567" style="border:0px"></td>
    <td width="131" style="text-align:right; font-size:10pt; border:0px">Format II.I.1</td>
  </tr>
</table>
<table border="0" width="700" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #000; border-collapse: collapse; font-family:calibri; font-size:10pt">
  <tr>
    <td colspan="8" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">FORMULIR PENYALURAN BMD BERUPA PERSEDIAAN</td>
  </tr>
  <tr>
    <td colspan="8" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri"> PENGGUNA BARANG</td>
  </tr>
  <tr>
    <td colspan="8" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">SKPD : <?=$SkP?></td>
  </tr>
  <tr>
    <td colspan="8" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">PEMERINTAH <?=strtoupper($NmTING." ".$NmDAER)?></td>
  </tr>
  <tr>
    <td colspan="8" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">TAHUN <?=substr($SpbTgl,-4,4)?></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr height="22" style="font-weight:bold">
    <td width="18">&nbsp;</td>
    <td width="27">I.</td>
    <td colspan="3">Unit Pemakai</td>
    <td width="26">&nbsp;</td>
    <td width="358" colspan="2">&nbsp;</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="23">a.</td>
    <td colspan="2">Kuasa Pengguna Barang</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>b.</td>
    <td colspan="2">Pengguna Barang</td>
    <td>:</td>
    <td colspan="2"><?=$NmP?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>c.</td>
    <td colspan="2">Pengelola Barang</td>
    <td>:</td>
    <td colspan="2"><?=$NmK?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>d.</td>
    <td colspan="2">Alamat</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr style="font-weight:bold">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr style="font-weight:bold">
    <td>&nbsp;</td>
    <td>II.</td>
    <td colspan="3">Data Sisa / Saldo Barang Tersedia</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>a.</td>
    <td colspan="2">Kode Barang</td>
    <td>:</td>
    <td colspan="2"><?=substr($KdP,0,19)?></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>b.</td>
    <td colspan="2">Nama Barang</td>
    <td>:</td>
    <td colspan="2"><?=$NmO?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>c.</td>
    <td colspan="2">Spesifikasi Nama Barang</td>
    <td>:</td>
    <td colspan="2"><?=$NmA?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>d.</td>
    <td colspan="2">NUSP</td>
    <td>:</td>
    <td colspan="2"><?=substr($KdP,-5,5)?></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>e.</td>
    <td colspan="2">Tanggal, Bulan, Tahun Kadaluarsa</td>
    <td>:</td>
    <td colspan="2"><?=$TeD?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6"><table border="0" width="500" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
      <tr style="font-weight:bold; text-align:center">
        <td width="57" style="border:1px solid #000">No.</td>
        <td width="120" style="border:1px solid #000">Jumlah Barang<br>
          Tersedia</td>
        <td width="154" style="border:1px solid #000">Harga Satuan<br>
          (Rp)</td>
        <td width="169" style="border:1px solid #000">Nilai Total<br>
          (Rp)</td>
      </tr>
      <tr>
        <td style="border:1px solid #000; text-align:center">1</td>
        <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($QtS)?></td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($HrG)?></td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($QtS*$HrG)?></td>
      </tr>
      
      <tr style="font-weight:bold">
        <td style="border:1px solid #000; text-align:center">Jumlah</td>
        <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($QtS)?></td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($HrG)?></td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($QtS*$HrG)?></td>
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
    <td colspan="3">Data Permintaan Barang </td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>a.</td>
    <td colspan="2">Jumlah</td>
    <td>:</td>
    <td colspan="2"><?=$QtU?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>b.</td>
    <td colspan="2">Satuan</td>
    <td>:</td>
    <td colspan="2"><?=$SaT?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>c.</td>
    <td colspan="2">Pihak yang meminta </td>
    <td>:</td>
    <td colspan="2"><?=$BiT?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>d.</td>
    <td colspan="2">Nama pihak yang meminta </td>
    <td>:</td>
    <td colspan="2"><?=fGlobal("sub_bidang","tb_bidang_sub","kode",$BiT,"=","",DatabaseSA,$ConSA,"")?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>e.</td>
    <td colspan="2">Keperluan</td>
    <td>:</td>
    <td colspan="2"><?=$KeP?></td>
  </tr>
  <tr style="font-weight:bold">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr style="font-weight:bold">
    <td>&nbsp;</td>
    <td>IV.</td>
    <td colspan="3">Data Pengeluaran Penyaluran/Pemakaian</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6">
	<table border="0" width="500" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
	  <tr style="font-weight:bold; text-align:center">
		<td width="57" style="border:1px solid #000">No.</td>
		<td width="120" style="border:1px solid #000">Jumlah Barang<br>Disalurkan</td>
		<td width="154" style="border:1px solid #000">Harga Satuan<br>(Rp)</td>
		<td width="169" style="border:1px solid #000">Nilai Total<br>(Rp)</td>
	  </tr>
        <td style="border:1px solid #000; text-align:center">1</td>
        <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($QtY)?></td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($HrG)?></td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($ToT)?></td>
	  <tr style="font-weight:bold">
	    <td style="border:1px solid #000; text-align:center">Jumlah</td>
        <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($QtY)?></td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($HrG)?></td>
        <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($ToT)?></td>
	    </tr>
	</table>	</td>
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
    <td>V.</td>
    <td colspan="6">Dokumen Sumber Pengeluaran Berita Acara Serah Terima</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>a.</td>
    <td colspan="2">Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=fConvertDateShort($TgL)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>b.</td>
    <td colspan="2">Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NoM?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>c.</td>
    <td colspan="2">Nama Dokumen </td>
    <td>:</td>
    <td colspan="2">Dokumen Mutasi</td>
  </tr>
  
  <tr style="font-weight:bold">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr style="font-weight:bold">
    <td>&nbsp;</td>
    <td>VI.</td>
    <td colspan="3">Dokumen Pendukung Pengeluaran</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>a.</td>
    <td colspan="2">Nota Permintaan Barang </td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>1.</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$NotTgl?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="20">2.</td>
    <td width="226">Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$NotNom?></td>
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
    <td>b.</td>
    <td colspan="2">Surat Permintaan Barang (SPB)</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>1.</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$SpbTgl?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>2.</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$SpbNom?></td>
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
    <td>c.</td>
    <td colspan="2">Surat Perintah Penyaluran Barang (SPPB)</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>1.</td>
    <td>Tanggal, Bulan, Tahun</td>
    <td>:</td>
    <td colspan="2"><?=$SppTgl?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>2.</td>
    <td>Nomor</td>
    <td>:</td>
    <td colspan="2"><?=$SppNom?></td>
  </tr>
  
  
  <tr>
    <td>&nbsp;</td>
    <td style="font-weight:bold">&nbsp;</td>
    <td colspan="3" style="font-weight:bold">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="font-weight:bold">VII.</td>
    <td colspan="3" style="font-weight:bold">Keterangan Tambahan</td>
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
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">NIP</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">Tanggal, Bulan, Tahun Transaksi</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
</table>
