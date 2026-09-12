<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Simbada Kab. Hulu Sungai Tengah</title>
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
			<td style="font-size: 11pt; font-weight: bold" align="center">RENCANA KEBUTUHAN BARANG MILIK DAERAH (RKBMD)</td>
		</tr>
		<tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">TAHUN <?php echo $zThn?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table8">
				<tr>
					<td width="74">UNIT KERJA </td>
					<td width="16">:</td>
					<td width="1096"><?php echo fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",substr($zUpb,0,11),"=","","")?></td>
				</tr>
				<tr>
					<td width="74">SUB UNIT </td>
					<td width="16">:</td>
					<td><?php echo fGlobal("Nm_Sub","Ref_Sub_Unit","Kd_Sub",substr($zUpb,0,14),"=","","")?></td>
				</tr>
				<tr>
					<td width="74">UPB</td>
					<td width="16">:</td>
					<td><?php echo fGlobal("Nm_UPB","Ref_UPB","Kd_Upb",$zUpb,"=","","")?></td>
				</tr>
				<!--tr>
					<td width="74">Urusan</td>
					<td width="16">:</td>
					<td><?php echo fGlobal("Nm_Referensi","Ref_Kegiatan","Id_Referensi",substr($zKeg,0,7),"=","","")?></td>
				</tr-->
				<tr>
					<td width="74">PROGRAM</td>
					<td width="16">:</td>
					<td><?=strtoupper(fGlobal("nmProgram","ta_apbd_program_skpd","idProgram",substr($zKeg,0,15),"=","",""))?></td>
				</tr>
				<tr>
					<td width="74">KEGIATAN</td>
					<td width="16">:</td>
					<td><?=strtoupper(fGlobal("nmKegiatan","ta_apbd_kegiatan_skpd","idKegiatan",$zKeg,"=","",""))?></td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
			<td>
			<table border="1" width="100%" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" bordercolor="#000000">
				<tr>
					<td width="33" style="font-weight: bold" align="center">No</td>
					<td width="269" style="font-weight: bold" align="center">
					Nama/Jenis Barang</td>
					<td width="128" style="font-weight: bold" align="center">Merk / Type</td>
					<td width="106" style="font-weight: bold" align="center">
					Ukuran</td>
					<td width="46" style="font-weight: bold" align="center">Jumlah</td>
					<td width="87" style="font-weight: bold" align="center">Satuan</td>
					<td width="87" style="font-weight: bold" align="center">
					<table border="0" width="100%" cellpadding="0" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse">
						<tr>
							<td align="center">Harga Satuan</td>
						</tr>
						<tr>
							<td align="center">(Rp)</td>
						</tr>
					</table>					</td>
					<td width="89" align="center" style="font-weight: bold">
					<table border="0" width="100%" cellpadding="0" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse">
						<tr>
							<td align="center">Jumlah</td>
						</tr>
						<tr>
							<td align="center">(Rp)</td>
						</tr>
					</table>					</td>
					<td style="font-weight: bold" align="center" width="99">
					<table border="0" width="100%" cellpadding="0" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse">
						<tr>
							<td align="center">Kode</td>
						</tr>
						<tr>
							<td align="center">Rekening</td>
						</tr>
					</table>					</td>
					<td style="font-weight: bold" align="center" width="188">
					Keterangan</td>
				</tr>
				<tr>
					<td width="33" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
					1</td>
					<td width="269" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
					2</td>
					<td width="128" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
					3</td>
					<td width="106" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
					4</td>
					<td width="46" align="center" style="font-weight: bold; border-bottom: 3px double #000000">
					5</td>
					<td width="87" align="center" style="font-weight: bold; border-bottom: 3px double #000000">6</td>
					<td width="87" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
					7</td>
					<td style="font-weight: bold; border-bottom: 3px double #000000" align="center">
					8</td>
					<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="99">
					9</td>
					<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="188">
					10</td>
				</tr>
				<?php
				$gTotal=0;
				$SQL="SELECT * FROM ta_rkbmd WHERE Kd_Upb='".$zUpb."' AND Kd_Kegiatan='".$zKeg."' AND Tahun='".$zThn."' ORDER BY IDO";
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
						<tr height="22">
							<td width="33" valign="top" align="center" height="20"><?php echo $iG?>.</td>
							<td width="269" valign="top" height="20"><?php echo $mRo['Nm_Aset']?></td>
							<td width="128" valign="top" height="20"><?php echo $mRo['Merk_Type']?></td>
							<td width="106" valign="top" height="20"><?php echo $mRo['Ukuran']?></td>
							<td width="46" height="20" align="center" valign="top"><?php if ($mRo['Qty']> 0) {echo $mRo['Qty'];}?></td>
							<td width="87" height="20" align="center" valign="top"><?php echo $nStn?></td>
							<td width="87" valign="top" align="right" height="20"><?php if ($mRo['Harga']> 0) {echo fConvertToRupiah($mRo['Harga']);}?></td>
							<td valign="top" align="right" height="20"><?php if ($mRo['Jumlah']> 0) {echo fConvertToRupiah($mRo['Jumlah']);}?></td>
							<td valign="top" align="center" height="20" width="99"><?php echo $mRo['Kd_Aset']?></td>
							<td valign="top" height="20" width="188"><?php echo $mRo['Deskripsi']?>&nbsp;</td>
						</tr>
						<?php
						$gTotal=$gTotal+$mRo['Jumlah'];
						$iG++;
						}
					while ($mRo = mysql_fetch_assoc($nRs));	
						
				}		
				else
				{
				?>
				<tr>
					<td width="33" height="20">&nbsp;</td>
					<td width="269" height="20">&nbsp;</td>
					<td width="128" height="20">&nbsp;</td>
					<td width="106" height="20">&nbsp;</td>
					<td width="46" height="20">&nbsp;</td>
					<td width="87" height="20">&nbsp;</td>
					<td width="87" height="20">&nbsp;</td>
					<td height="20">&nbsp;</td>
					<td height="20" width="99">&nbsp;</td>
					<td height="20" width="188">&nbsp;</td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td colspan="7" align="center" style="font-weight: bold; border-top: 3px double #000000">
					TOTAL</td>
					<td align="right" style="font-weight: bold; border-top: 3px double #000000"><?php echo fConvertToRupiah($gTotal)?></td>
					<td align="right" style="font-weight: bold; border-top: 3px double #000000" width="99">&nbsp;</td>
					<td align="right" style="font-weight: bold; border-top: 3px double #000000" width="188">&nbsp;</td>
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
					<td align="center" width="230"><?=$NmIbuk?>,&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
					<td align="center" width="230">&nbsp;</td>
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
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>

</body>

</html>