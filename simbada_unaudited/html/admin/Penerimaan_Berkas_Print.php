<?
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";
?>
<html>
<head>
<title>Simbada</title>
</head>
<?
$gIdT = $_GET['gIdT'];
if ($gIdT)
{
	$nSQ = "SELECT * FROM ta_penerimaan_berkas WHERE IDT='$gIdT'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gTGL  = $mRo['Tanggal'];
		$gPER  = $mRo['Periode'];
		$gNOM1 = $mRo['Nomor'];
		$gNOMN = $mRo['NomorNew'];
		
		$gUnt  = $mRo['Kd_Unit'];
		$mSKD  = $mRo['Id_Satker'];
		$nSKD  = $mRo['Nm_Satker'];
		$gPR   = $mRo['Kd_Program'];
		$mPR   = $mRo['Nm_Program'];
		$gKG   = $mRo['Kd_Kegiatan'];
		$mKG   = $mRo['Nm_Kegiatan'];
		
		$gSB   = $mRo['Kd_SubKegiatan'];
		$mSB   = $mRo['Nm_SubKegiatan'];
		
		$gNOM2 = $mRo['No_Kontrak'];
		$gNOM3 = $mRo['No_Berita_Acara'];
		$gTGLB = $mRo['Tg_Berita_Acara'];
		$gTGLK = $mRo['Tg_Kontrak'];
		
		$gRK   = $mRo['Kd_Rek13'];
		$mRK   = $mRo['Nm_Rek13'];
		 
		$gKET  = $mRo['Uraian'];
		$nTHN  = $mRo['Periode'];
		$nAGG  = $mRo['Perubahan'];
		$gAGG  = $mRo['Anggaran']; 
		$gPRS  = $mRo['Proses']; 
		$gNIL  = $mRo['Nilai']; 
		$gITM  = $mRo['JmlItem']; 
		$gREK  = $mRo['Kd_Rek13']; 
		
	}
}
?>
<? require "Dokumen_Footer_Pengadaan.php";?>
<body>
	<table border="0" align="center" width="700" cellspacing="1" style="border:0px solid #000000; border-bottom:0px solid #000000; font-size: 8pt; font-family: calibri; border-collapse: collapse">
	<tr>
	  <td width="94" rowspan="8" style="font-size: 12pt; font-weight: bold; text-align:center"><img src="Images/logopemda.png" height="70px"/>&nbsp;</td>
	  <td width="484" style="font-size: 12pt; font-weight: bold; text-align:center">&nbsp;</td>
	  <td width="110" style="font-size: 12pt; font-weight: bold; text-align:center">&nbsp;</td>
	</tr>
	<tr>
	  <td style="font-size: 11pt; font-weight: bold; text-align:center">
	  SURAT KETERANGAN TELAH MENERIMA SALINAN BUKTI ADMINISTRASI<br>DALAM RANGKA PENCATATAN ASET SKPD TA <?=$gPER?>	  </td>
	  <td style="font-size: 11pt; font-weight: bold; text-align:center">&nbsp;</td>
	  </tr>
	<tr>
	  <td style="font-size: 11pt; font-weight: bold; text-align:center"><?=strtoupper($nSKD)?></td>
	  <td style="font-size: 11pt; font-weight: bold; text-align:center">&nbsp;</td>
	  </tr>
	<tr>
	  <td style="font-size: 11pt; text-align:center; text-decoration:underline">Nomor : <?=$gNOMN?></td>
	  <td style="font-size: 11pt; text-align:center">&nbsp;</td>
	  </tr>
	<tr height="20">
	  <td style="font-size: 11pt; font-weight: bold; text-align:center">&nbsp;</td>
	  <td style="font-size: 11pt; font-weight: bold; text-align:center">&nbsp;</td>
	</tr>
	<tr height="20">
	  <td style="font-size: 11pt; font-weight: bold; text-align:center">&nbsp;</td>
	  <td style="font-size: 11pt; font-weight: bold; text-align:center">&nbsp;</td>
	  </tr>
	</table>
<table width="700" align="center" cellpadding="0" cellspacing="0" style="border-left:0px solid #000000; border-right:0px solid #000000; border-collapse:collapse; font-family:calibri; font-size:11pt">
  <tr height="23">
    <td colspan="4">Saya yang bertanda tangan di bawah ini :</td>
  </tr>
  <tr height="23">
    <td width="25">&nbsp;</td>
    <td width="78">Nama</td>
    <td width="27">:</td>
    <td><? if ($FotC[2]=='') {echo "<i>Nama Pengurus Barang Isi di form unit kerja</i>";} else {echo $FotC[2];}?></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td>NIP</td>
    <td>:</td>
    <td><?=$FotC[3]?></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td>Jabatan</td>
    <td>:</td>
    <td><?=$FotC[1]?></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="700" align="center" cellpadding="0" cellspacing="0" style="border-left:0px solid #000000; border-right:0px solid #000000; border-collapse:collapse; font-family:calibri; font-size:11pt">
  <tr height="23">
    <td colspan="4">Telah melakukan pencatatan atas penerimaan aset/persediaan yang diperoleh melalui DPPA <?=strtoupper($nSKD)?> dengan keterangan sebagai berikut :</td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td>Program</td>
    <td>:</td>
    <td><?=$mPR?></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td>Kegiatan</td>
    <td>:</td>
    <td><?=$mKG?></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td>Sub Kegiatan </td>
    <td>:</td>
    <td><?=$mSB?></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td>Belanja</td>
    <td>:</td>
    <td><?=$mRK?></td>
  </tr>
  <tr height="23">
    <td width="25">&nbsp;</td>
    <td width="230">Uraian Pengadaan</td>
    <td width="27">:</td>
    <td><?=$gKET?></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td>Jenis Barang</td>
    <td>:</td>
    <td><?=$mRK?></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td>Jumlah Barang</td>
    <td>:</td>
    <td><?=$gITM?></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td>Nilai Perolehan</td>
    <td>:</td>
    <td><?=fConvertToRupiah($gNIL)?>,-</td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td>Nomor Surat Pesanan/Kontrak</td>
    <td>:</td>
    <td><?=$gNOM2?></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td>Tanggal Surat Pesanan/Kontrak</td>
    <td>:</td>
    <td><?=fConvertDateLongsBln($gTGLK)?></td>
  </tr>
  <!--tr height="23">
    <td>&nbsp;</td>
    <td>Nomor BAST / Penerimaan Barang</td>
    <td>:</td>
    <td><?=$gNOM3?></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td>Tanggal BAST / Penerimaan Barang</td>
    <td>:</td>
    <td><?=fConvertDateLongsBln($gTGLB)?></td>
  </tr-->
  <tr height="23">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="700" align="center" cellpadding="0" cellspacing="0" style="border-left:0px solid #000000; border-right:0px solid #000000; border-collapse:collapse; font-family:calibri; font-size:11pt">
  <tr height="23">
    <td>Demikian surat keterangan ini diterbitkan untuk digunakan sebagaimana mestinya.</td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" align="center"  width="700" cellspacing="1" style="border:0px solid #000000; font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table6">
	<tr>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td width="71" align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
  </tr>
	<tr height="50">
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center" width="319"><?=$NmIbKt.", ".fConvertDateLongsBln($gTGL)?></td>
		<td align="center" width="14">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
		<td width="230" align="center" style="font-weight: bold">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center" style="font-weight: bold" width="319"><?=strtoupper($FotC[1])?><br>
	  <?=strtoupper($nSKD)?></td>
		<td align="center" style="font-weight: bold" width="14">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center" width="319">&nbsp;</td>
		<td align="center" width="14">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center" width="319">&nbsp;</td>
		<td align="center" width="14">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center" width="319">&nbsp;</td>
		<td align="center" width="14">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
		<td width="230" align="center" style="font-weight: bold">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center" style="font-weight: bold; text-decoration:underline" width="319"><?=$FotC[2]?></td>
		<td align="center" style="font-weight: bold" width="14">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center" width="319">NIP. <?=$FotC[3]?></td>
		<td align="center" width="14">&nbsp;</td>
	</tr>
	<tr>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
  </tr>
</table>
</body>
</html>
