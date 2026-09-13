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
$zKeg = $_GET['zKeg'];
$zUpb = $_GET['zUpb'];
$zThn = $_GET['zThn'];
?>
<body onLoad="javascript:window.focus()">

<div align="center">
	<table border="0" width="1200" cellspacing="1" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
			<td style="font-size: 12pt; font-weight: bold" align="center">PEMERINTAH <?php echo $TiDaer." ".$NmDaer?></td>
		</tr>
		<tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">RENCANA KEBUTUHAN PEMELIHARAAN BARANG MILIK DAERAH (RKPBMD)</td>
		</tr>
		<tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">TAHUN <?php echo $zThn?></td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" style="font-family: Calibri; font-size: 9pt; font-weight: bold; border-collapse: collapse" id="table8">
				<tr>
					<td width="74">Unit Kerja</td>
					<td width="16">:</td>
					<td width="1096"><?php echo fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",substr($zUpb,0,11),"=","","")?></td>
				</tr>
				<tr>
					<td width="74">Sub Unit</td>
					<td width="16">:</td>
					<td><?php echo fGlobal("Nm_Sub","Ref_Sub_Unit","Kd_Sub",substr($zUpb,0,14),"=","","")?></td>
				</tr>
				<tr>
					<td width="74">UPB</td>
					<td width="16">:</td>
					<td><?php echo fGlobal("Nm_UPB","Ref_UPB","Kd_Upb",$zUpb,"=","","")?></td>
				</tr>
				<tr>
					<td width="74">Urusan</td>
					<td width="16">:</td>
					<td><?php echo fGlobal("Nm_Referensi","Ref_Kegiatan","Id_Referensi",substr($zKeg,0,7),"=","","")?></td>
				</tr>
				<tr>
					<td width="74">Program</td>
					<td width="16">:</td>
					<td><?php echo fGlobal("Nm_Referensi","Ref_Kegiatan","Id_Referensi",substr($zKeg,0,10),"=","","")?></td>
				</tr>
				<tr>
					<td width="74">Kegiatan</td>
					<td width="16">:</td>
					<td><?php echo fGlobal("Nm_Referensi","Ref_Kegiatan","Id_Referensi",$zKeg,"=","","")?></td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" bordercolor="#000000">
				<tr>
					<td width="2%" style="border:1px solid #000000; font-weight: bold" align="center">
					No</td>
					<td width="15%" style="border:1px solid #000000; font-weight: bold" align="center">
					Nama Barang</td>
					<td width="20%" style="border:1px solid #000000; font-weight: bold" align="center">
					Uraian Pemeliharaan</td>
					<td width="9%" style="border:1px solid #000000; font-weight: bold" align="center">
					Lokasi</td>
					<td width="10%" style="border:1px solid #000000; font-weight: bold" align="center">
					<table border="0" width="100%" cellpadding="0" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse">
						<tr>
							<td align="center">Kode</td>
						</tr>
						<tr>
							<td align="center">Barang</td>
						</tr>
					</table>
					</td>
					<td width="5%" style="border:1px solid #000000; font-weight: bold" align="center">
					<table border="0" width="100%" cellpadding="0" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse">
						<tr>
							<td align="center">Jumlah</td>
						</tr>
						<tr>
							<td align="center">Barang</td>
						</tr>
					</table>
					</td>
					<td width="7%" style="border:1px solid #000000; font-weight: bold" align="center">
					<table border="0" width="100%" cellpadding="0" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse">
						<tr>
							<td align="center">Harga</td>
						</tr>
						<tr>
							<td align="center">Satuan</td>
						</tr>
					</table>
					</td>
					<td width="8%" style="border:1px solid #000000; font-weight: bold" align="center">
					<table border="0" width="100%" cellpadding="0" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse">
						<tr>
							<td align="center">Jumlah</td>
						</tr>
						<tr>
							<td align="center">Biaya</td>
						</tr>
					</table>
					</td>
					<td width="5%" style="border:1px solid #000000; font-weight: bold" align="center">
					<table border="0" width="100%" cellpadding="0" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse">
						<tr>
							<td align="center">Kode</td>
						</tr>
						<tr>
							<td align="center">Rekening</td>
						</tr>
					</table>
					</td>
					<td style="border:1px solid #000000; font-weight: bold" align="center" width="15%">
					Keterangan</td>
				</tr>
				<tr>
					<td width="2%" style="border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; font-weight: bold; border-bottom: 3px double #000000" align="center">
					1</td>
					<td width="15%" style="border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; font-weight: bold; border-bottom: 3px double #000000" align="center">
					2</td>
					<td width="20%" style="border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; font-weight: bold; border-bottom: 3px double #000000" align="center">
					3</td>
					<td width="9%" style="border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; font-weight: bold; border-bottom: 3px double #000000" align="center">
					4</td>
					<td width="10%" style="border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; font-weight: bold; border-bottom: 3px double #000000" align="center">
					5</td>
					<td width="5%" style="border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; font-weight: bold; border-bottom: 3px double #000000" align="center">
					6</td>
					<td width="7%" style="border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; font-weight: bold; border-bottom: 3px double #000000" align="center">
					7</td>
					<td width="8%" style="border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; font-weight: bold; border-bottom: 3px double #000000" align="center">
					8</td>
					<td width="5%" style="border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; font-weight: bold; border-bottom: 3px double #000000" align="center">
					9</td>
					<td style="border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; font-weight: bold; border-bottom: 3px double #000000" align="center" width="15%">
					10</td>
				</tr>
				<?php
				$gTotal=0;
				$SQL="SELECT * FROM ta_rkpbmd WHERE Kd_Upb='".$zUpb."' AND Kd_Kegiatan='".$zKeg."' AND Tahun='".$zThn."' ORDER BY IDO";
				$nRs = mysql_query($SQL) or die(mysql_error());
				$mRo = mysql_fetch_assoc($nRs);
				$tRo = mysql_num_rows($nRs);
				if ($tRo > 0)
				{
					$iG=1;
					do
						{
						$nStn=$mRo['Satuan'];
						$nStn=str_replace("m2","m<sup>2</sup>",$nStn);
						$nStn=str_replace("M2","m<sup>2</sup>",$nStn);
						$nStn=str_replace("m3","m<sup>3</sup>",$nStn);
						$nStn=str_replace("M3","m<sup>3</sup>",$nStn);
						?>
						<tr>
							<td width="2%" valign="top" align="center" height="20" style="border: 1px solid #000000"><?php echo $iG?>.</td>
							<td width="15%" valign="top" height="20" style="border:1px solid #000000; font-weight: bold"><?php echo $mRo['Nm_Aset']?></td>
							<td width="20%" valign="top" height="20" style="border: 1px solid #000000">&nbsp;</td>
							<td width="9%" valign="top" height="20" style="border: 1px solid #000000">&nbsp;</td>
							<td width="10%" valign="top" height="20" style="border: 1px solid #000000"><?php echo $mRo['Kd_Aset']?></td>
							<td width="5%" valign="top" align="center" height="20" style="border: 1px solid #000000">&nbsp;</td>
							<td width="7%" valign="top" align="right" height="20" style="border: 1px solid #000000">&nbsp;</td>
							<td width="8%" valign="top" align="right" height="20" style="border: 1px solid #000000">&nbsp;</td>
							<td width="5%" valign="top" align="right" height="20" style="border: 1px solid #000000">&nbsp;</td>
							<td valign="top" align="right" height="20" width="15%" style="border: 1px solid #000000">&nbsp;</td>
						</tr>
						<?php
						$rSQL="select * from ta_rkpbmd_rinci where Referensi='".$mRo['Referensi']."' order by IDO";
						$rnRs = mysql_query($rSQL) or die(mysql_error());
						$rmRo = mysql_fetch_assoc($rnRs);
						$rtRo = mysql_num_rows($rnRs);
						if ($rtRo > 0)
						{
							do
							{
							?>
							<tr>
								<td width="2%" valign="top" align="center" height="20" style="font-style: italic; border-left: 1px solid #000000; border-right: 1px solid #000000"></td>
								<td width="15%" valign="top" height="20" style="font-style: italic; border-left: 1px solid #000000; border-right: 1px solid #000000"></td>
								<td width="20%" valign="top" height="20" style="font-style: italic; border: 1px solid #000000"><?php echo $rmRo['Deskripsi']?></td>
								<td width="9%" valign="top" height="20" style="font-style: italic; border: 1px solid #000000"><?php echo $rmRo['Lokasi']?></td>
								<td width="10%" valign="top" height="20" style="font-style: italic; border: 1px solid #000000"></td>
								<td width="5%" valign="top" align="center" height="20" style="font-style: italic; border: 1px solid #000000"><?php if ($rmRo['Qty']> 0) {echo $rmRo['Qty'];}?></td>
								<td width="7%" valign="top" align="right" height="20" style="font-style: italic; border: 1px solid #000000"><?php if ($rmRo['Harga']> 0) {echo fConvertToRupiah($rmRo['Harga']);}?></td>
								<td width="8%" valign="top" align="right" height="20" style="font-style: italic; border: 1px solid #000000"><?php if ($rmRo['Jumlah']> 0) {echo fConvertToRupiah($rmRo['Jumlah']);}?></td>
								<td width="5%" valign="top" align="center" height="20" style="font-style: italic; border: 1px solid #000000"><?php echo $rmRo['Rekening']?></td>
								<td valign="top" height="20" style="font-style: italic; border: 1px solid #000000" width="15%"><?php echo $rmRo['Nama_Rekening']?></td>
							</tr>
							<?php
							$gTotal=$gTotal+$rmRo['Jumlah'];
							}
							while ($rmRo = mysql_fetch_assoc($rnRs));	
						}
						$iG++;
					}
					while ($mRo = mysql_fetch_assoc($nRs));	
				}
				else
				{
				?>
				<tr>
					<td width="2%" height="20" style="border: 1px solid #000000">&nbsp;</td>
					<td width="15%" height="20" style="border: 1px solid #000000">&nbsp;</td>
					<td width="20%" height="20" style="border: 1px solid #000000">&nbsp;</td>
					<td width="9%" height="20" style="border: 1px solid #000000">&nbsp;</td>
					<td width="10%" height="20" style="border: 1px solid #000000">&nbsp;</td>
					<td width="5%" height="20" style="border: 1px solid #000000">&nbsp;</td>
					<td width="7%" height="20" align="right" style="border: 1px solid #000000">&nbsp;</td>
					<td width="8%" height="20" style="border: 1px solid #000000">&nbsp;</td>
					<td width="5%" height="20" style="border: 1px solid #000000">&nbsp;</td>
					<td height="20" width="15%" style="border: 1px solid #000000">&nbsp;</td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td width="837" align="right" style="border-left:1px solid #000000; border-right:1px solid #000000; border-bottom:1px solid #000000; font-weight: bold; border-top: 3px double #000000" colspan="7">
					TOTAL</td>
					<td width="8%" align="right" style="border-left:1px solid #000000; border-right:1px solid #000000; border-bottom:1px solid #000000; font-weight: bold; border-top: 3px double #000000"><?php echo fConvertToRupiah($gTotal)?></td>
					<td align="center" style="border-left:1px solid #000000; border-right:1px solid #000000; border-bottom:1px solid #000000; font-weight: bold; border-top: 3px double #000000" colspan="2">&nbsp;

					</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" id="table9">
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230">Palangka Raya, </td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
					<td width="230" align="center" style="font-weight: bold">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center" style="font-weight: bold" width="230"></td>
					<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230">&nbsp;</td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230">&nbsp;</td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230">&nbsp;</td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
					<td width="230" align="center" style="font-weight: bold">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center" style="font-weight: bold" width="230"></td>
					<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230">NIP. </td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td height="19">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>

</body>

</html>