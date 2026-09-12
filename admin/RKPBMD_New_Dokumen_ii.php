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
extract($_GET);
$UnT = fGlobal("Kd_Unit","ta_rkpbmd_new","IDT",$IdT,"=","","");
$Ref = fGlobal("Referensi","ta_rkpbmd_new","IDT",$IdT,"=","","");

$Thn = fGlobal("Tahun","ta_rkpbmd_new","IDT",$IdT,"=","","");
$Apb = fGlobal("Apbd","ta_rkpbmd_new","IDT",$IdT,"=","","");
$NmT = fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",$UnT,"=","","");

$NmPim = fGlobal("Nma_Pimpinan","ref_unit","kd_unit",$UnT,"=","","");
$NiPim = fGlobal("Nip_Pimpinan","ref_unit","kd_unit",$UnT,"=","","");

$TgC = fGetDate('mday')." / ".fGetDate('mon')." / ".fGetDate('year');
?>
<body onLoad="javascript:window.focus()">

<div align="center">
	<table border="0" width="1800" cellspacing="1" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">USULAN RENCANA KEBUTUHAN PEMELIHARAAN BARANG MILIK DAERAH</td>
		</tr>
		<tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">( RENCANA PEMELIHARAAN )</td>
		</tr>
		<tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">TAHUN <?=$Thn?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: calibri; font-size: 10pt; border-collapse: collapse">
				<tr>
					<td width="135">PEMERINTAH DAERAH</td>
					<td width="19">:</td>
					<td><?=$TiDaer." ".$NmDaer?></td>
				</tr>
				<tr>
				  <td>PENGGUNA BARANG </td>
				  <td>:</td>
				  <td><?=strtoupper($NmT)?></td>
			  </tr>
			</table>
			</td>
		</tr>
		<tr>
			<td>
			<table border="1" width="1800" cellpadding="1" cellspacing="0" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" bordercolor="#000">
				
				<tr height="22">
				  <td width="31" rowspan="2" align="center" style="font-weight: bold">NO</td>
				  <td rowspan="2" align="center" style="font-weight: bold"><p>SKPD</p>				    </td>
				  <td rowspan="2" align="center" style="font-weight: bold">Kode Barang</td>
				  <td rowspan="2" align="center" style="font-weight: bold">Nama Barang</td>
				  <td rowspan="2" align="center" style="font-weight: bold">Satuan</td>
				  <td colspan="2" align="center" style="font-weight: bold">J u m l a h</td>
			      <td rowspan="2" align="center" style="font-weight: bold">Bentuk Pemeliharaan </td>
			      <td colspan="2" align="center" style="font-weight: bold">Program</td>
			      <td colspan="2" align="center" style="font-weight: bold">Kegiatan</td>
			      <td colspan="2" align="center" style="font-weight: bold">Sub Kegiatan </td>
		      </tr>
			  <tr>
				  <td align="center" style="font-weight: bold">Barang Yang<br>Dipelihara </td>
			      <td align="center" style="font-weight: bold">Usulan<br>Pemeliharaan </td>
			      <td align="center" style="font-weight: bold">Kode</td>
			      <td align="center" style="font-weight: bold">Deskripsi</td>
			      <td align="center" style="font-weight: bold">Kode</td>
			      <td align="center" style="font-weight: bold">Deskripsi</td>
			      <td align="center" style="font-weight: bold">Kode</td>
			      <td align="center" style="font-weight: bold">Deskripsi</td>
			  </tr>
			  <tr style="text-align:center">
				<td width="31" style="font-weight: bold; border-bottom: 3px double #000">1</td>
				<td style="font-weight: bold; border-bottom: 3px double #000">2</td>
				<td width="100" style="font-weight: bold; border-bottom: 3px double #000">3</td>
				<td width="200" style="font-weight: bold; border-bottom: 3px double #000">4</td>
				<td width="70" style="font-weight: bold; border-bottom: 3px double #000">5</td>
				<td width="70" style="font-weight: bold; border-bottom: 3px double #000">6</td>
				<td width="70" style="font-weight: bold; border-bottom: 3px double #000">7</td>
				<td width="235" style="font-weight: bold; border-bottom: 3px double #000">8</td>
				<td width="70" style="font-weight: bold; border-bottom: 3px double #000">9</td>
				<td width="200" style="font-weight: bold; border-bottom: 3px double #000">10</td>
				<td width="80" style="font-weight: bold; border-bottom: 3px double #000">11</td>
				<td width="200" style="font-weight: bold; border-bottom: 3px double #000">12</td>
				<td width="90" style="font-weight: bold; border-bottom: 3px double #000">13</td>
				<td width="200" style="font-weight: bold; border-bottom: 3px double #000">14</td>
			  </tr>
				<?php
				$mRo4 = 0;
				$mRo5 = 0;
				$iG=1;
				$nSQ = "SELECT P2.nm_unit, P1.Kd_Rekening, P1.Nm_Rekening, P1.Usulan_Satuan, 
				P1.Usulan_Jumlah,
				P1.UsulanKebthan_Jumlah,
				P1.Nama_Pemeliharaan,
				
				P3.Kd_Program,
				P3.Nm_Program,
				P4.Kd_Kegiatan,
				P4.Nm_Kegiatan,
				P5.Kd_Sub_Kegiatan,
				P5.Nm_Sub_Kegiatan 
				FROM ta_rkpbmd_new_rekening P1 
				LEFT JOIN ref_unit P2 ON P2.kd_unit=P1.kd_unit 
				LEFT JOIN ta_rkpbmd_new_program P3 ON P3.Referensi=P1.Referensi AND P3.Kd_Program=left(P1.Kd_Kegiatan,7) 
				LEFT JOIN ta_rkpbmd_new_kegiatan P4 ON P4.Referensi=P1.Referensi AND P4.Kd_Kegiatan=P1.Kd_Kegiatan 
				LEFT JOIN ta_rkpbmd_new_kegiatan_sub P5 ON P5.Referensi=P1.Referensi AND P5.Kd_Sub_Kegiatan=P1.Kd_Sub_Kegiatan 
				WHERE P1.Referensi='".$Ref."' 
				AND P1.Tahun='".$Thn."' 
				AND P1.Apbd='".$Apb."' 
				ORDER BY P1.Kd_Rekening";
				#echo $nSQ;
				$nRs = mysql_query($nSQ);
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
				
				$eCL="";
				if (($mRo[5]-$mRo[6])!=$mRo[7])
				{
					$eCL="; color:#ff0000";
				}
				?>
					<tr height="22">
					<td style="border-bottom: 1px solid #000; text-align:center"><?=$iG?>.</td>
					<td style="border-bottom: 1px solid #000"><?=$mRo[0]?></td>
					<td style="border-bottom: 1px solid #000; text-align:center"><?=$mRo[1]?></td>
					<td style="border-bottom: 1px solid #000"><?=$mRo[2]?></td>
					<td style="border-bottom: 1px solid #000; text-align:center"><?=$mRo[3]?></td>
					<td style="border-bottom: 1px solid #000; text-align:center"><?=$mRo[4]?></td>
					<td style="border-bottom: 1px solid #000; text-align:center"><?=$mRo[5]?></td>
					<td style="border-bottom: 1px solid #000"><?=$mRo[6]?></td>
					<td style="border-bottom: 1px solid #000; text-align:center"><?=$mRo[7]?></td>
					<td style="border-bottom: 1px solid #000"><?=$mRo[8]?></td>
					<td style="border-bottom: 1px solid #000; text-align:center"><?=$mRo[9]?></td>
					<td style="border-bottom: 1px solid #000"><?=$mRo[10]?></td>
					<td style="border-bottom: 1px solid #000; text-align:center"><?=$mRo[11]?></td>
					<td style="border-bottom: 1px solid #000"><?=$mRo[12]?></td>
					</tr>
				<?php
				$iG++;
				$mRo4 = $mRo4+$mRo[4];
				$mRo5 = $mRo5+$mRo[5];
				}
				?>
			  <tr height="22" style="font-weight:bold; text-align:center">
				  <td colspan="4" style="border-bottom: 1px solid #000">JUMLAH</td>
			      <td style="border-bottom: 1px solid #000">&nbsp;</td>
			      <td style="border-bottom: 1px solid #000"><?=fConvertToRupiahBulat($mRo4)?></td>
			      <td style="border-bottom: 1px solid #000"><?=fConvertToRupiahBulat($mRo5)?></td>
			      <td style="border-bottom: 1px solid #000">&nbsp;</td>
			      <td style="border-bottom: 1px solid #000">&nbsp;</td>
			      <td style="border-bottom: 1px solid #000">&nbsp;</td>
			      <td style="border-bottom: 1px solid #000">&nbsp;</td>
			      <td style="border-bottom: 1px solid #000">&nbsp;</td>
			      <td style="border-bottom: 1px solid #000">&nbsp;</td>
			      <td style="border-bottom: 1px solid #000">&nbsp;</td>
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
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" id="table9">
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230"><?=$NmIbuk?>, <?=$TgC?></td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
					<td width="230" align="center" style="font-weight: bold">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center" style="font-weight: bold" width="230">Pengguna Barang</td>
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
					<td align="center" style="font-weight: bold; text-decoration:underline" width="230"><?=$NmPim?></td>
					<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230">NIP. <?=$NiPim?></td>
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