<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
$rIDT = $_REQUEST['rIDT'];
$nSQ = "SELECT * FROM ta_penghapusan_usulan WHERE IDT='".$rIDT."'";
$nRs = mysql_query($nSQ) or die(mysql_error());
$mRo = mysql_fetch_assoc($nRs);
$tRo = mysql_num_rows($nRs);
if ($tRo > 0)
{
	$gHri  = (int)substr($mRo['Tanggal'],8,10);
	$gBln  = (int)substr($mRo['Tanggal'],5,-3);
	$gThn  = (int)substr($mRo['Tanggal'],0,-6);
	$gRef  = $mRo['Referensi'];
	$gNom  = $mRo['Nomor'];
	$gKet  = $mRo['Keterangan'];
	
	$gUnt  = substr($mRo['Kd_UPB'],0,11);
	$gSub  = substr($mRo['Kd_UPB'],0,14);
	$gUpb  = $mRo['Kd_UPB'];
}

?>
<body>
<table border="0" width="1100" cellspacing="1" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" bordercolor="#000000" align="center">
	<tr>
		<td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold">DAFTAR USULAN BARANG YANG AKAN DIHAPUS</td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
		<td width="76">UNIT</td>
	    <td width="28">:</td>
	    <td width="886"><?=fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",$gUnt,"=","","")?></td>
	</tr>
	<tr>
	  <td>SUB UNIT </td>
	  <td>:</td>
	  <td><?=fGlobal("Nm_Sub","Ref_Sub_Unit","Kd_Sub",$gSub,"=","","")?></td>
  </tr>
	<tr>
	  <td>UPB</td>
	  <td>:</td>
	  <td><?=fGlobal("Nm_UPB","Ref_UPB","Kd_UPB",$gUpb,"=","","")?></td>
  </tr>
	<tr>
		<td>PROVINSI</td>
	    <td>:</td>
	    <td><?=$NmDaer?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
</table>
<table border="1" width="1100" cellspacing="1" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" bordercolor="#000000" align="center">
	<tr>
		<td width="29" style="text-align:center; font-weight:bold">No.</td>
		<td width="163" style="text-align:center; font-weight:bold">Nama Barang </td>
		<td width="77" style="text-align:center; font-weight:bold">No. Kode Barang </td>
		<td width="91" style="text-align:center; font-weight:bold">No. Kode Lokasi </td>
		<td width="150" style="text-align:center; font-weight:bold">Merk/Type</td>
		<td width="105" style="text-align:center; font-weight:bold">Dokumen Kepemilikan </td>
		<td width="65" style="text-align:center; font-weight:bold">Tahun Beli/ Pembelian </td>
		<td width="115" style="text-align:center; font-weight:bold">Harga Perolehan </td>
		<td width="59" style="text-align:center; font-weight:bold">Keadaan Barang (B,KB,RB) </td>
		<td width="193" style="text-align:center; font-weight:bold">Keterangan</td>
	</tr>
	<tr>
		<td style="text-align:center; font-weight:bold">1</td>
		<td style="text-align:center; font-weight:bold">2</td>
		<td style="text-align:center; font-weight:bold">3</td>
		<td style="text-align:center; font-weight:bold">4</td>
		<td style="text-align:center; font-weight:bold">5</td>
		<td style="text-align:center; font-weight:bold">6</td>
		<td style="text-align:center; font-weight:bold">7</td>
		<td style="text-align:center; font-weight:bold">8</td>
		<td style="text-align:center; font-weight:bold">9</td>
		<td style="text-align:center; font-weight:bold">10</td>
	</tr>
	<?php
	$iG = 1;
	$gtNil=0;
	$nSQL= "SELECT * FROM ta_penghapusan_usulan_rinc WHERE Kd_UPB='".$gUpb."' AND Referensi LIKE '".$gRef."' ORDER BY Kd_Aset, No_Register";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			?>
			<tr>
				<td valign="top" align="center"><?=$iG++?>.</td>
				<td valign="top"><?=$mRo['Nm_Aset']?>&nbsp;</td>
				<td valign="top"><?=$mRo['Kd_Aset']?></td>
				<td valign="top"><?=fStrukKdLokasi($mRo['Kd_Pemilik'],$KdProp,$KdKabK,$gUnt,$gSub,$gThn)?></td>
				<td valign="top"><?=$mRo['Uraian']?></td>
				<td valign="top"><?=fGlobal("Nm_Pemilik","Ref_Pemilik","Kd_Pemilik",$mRo['Kd_Pemilik'],"=","","")?></td>
				<td valign="top" align="center"><?=substr($mRo['Tgl_Perolehan'],0,4)?></td>
				<td valign="top" align="right"><?=fConvertToRupiah($mRo['Nilai'])?></td>
				<td valign="top" align="center"><?=$mRo['Kondisi']?></td>
				<td valign="top"><?=$mRo['Alasan']?></td>
			</tr>
			<?php
		}
		while ($mRo = mysql_fetch_assoc($nRs));
	}
	else
	{
	?>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php } ?>
</table>
<table border="0" width="1100" cellspacing="1" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" bordercolor="#000000" align="center">
	<?php require "Dokumen_Footer.php";?>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td width="294" align="center">Mengetahui,</td>
	  <td width="480">&nbsp;</td>
	  <td width="316" align="center"><?php echo $NmIbKt?>, <?=$gHri." ".fNmBulan($gBln)." ".$gThn?></td>
  </tr>
	<tr>
	  <td align="center"><?=$FotA[1]?></td>
	  <td>&nbsp;</td>
	  <td align="center"><?=$FotC[1]?></td>
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
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td align="center" style="font-weight:bold; text-decoration:underline"><?=$FotA[2]?></td>
	  <td>&nbsp;</td>
	  <td align="center" style="font-weight:bold; text-decoration:underline"><?=$FotC[2]?></td>
  </tr>
	<tr>
	  <td align="center">NIP. <?=$FotA[3]?></td>
	  <td>&nbsp;</td>
	  <td align="center">NIP. <?=$FotC[3]?></td>
  </tr>
</table>
</body>
</html>
