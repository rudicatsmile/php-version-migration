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
extract($_GET);
$UnT = fGlobal("Kd_Unit","ta_rpbmd_new","IDT",$IdT,"=","","");
$Thn = fGlobal("Tahun","ta_rpbmd_new","IDT",$IdT,"=","","");
$Ref = fGlobal("Referensi","ta_rpbmd_new","IDT",$IdT,"=","","");
$NmT = fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",$UnT,"=","","");

$NmPim = fGlobal("Nma_Pimpinan","ref_unit","kd_unit",$UnT,"=","","");
$NiPim = fGlobal("Nip_Pimpinan","ref_unit","kd_unit",$UnT,"=","","");
?>
<body onLoad="javascript:window.focus()">

<div align="center">
	<table border="0" width="2100" cellspacing="1" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">RENCANA PEMINDAH TANGANAN BARANG MILIK DAERAH</td>
		</tr>
		<!--tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">PENGGUNA BARANG / KUASA PENGGUNA BARANG</td>
		</tr-->
		<tr>
			<td style="font-size: 11pt; font-weight: bold" align="center"><?=strtoupper($NmT)?></td>
		</tr>
		<tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">TAHUN <?=$Thn?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<!--tr>
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
		</tr-->
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
			<td>
			<table border="1" width="100%" style="font-family: arial; font-size: 8pt; border-collapse: collapse" bordercolor="#000000">
				<tr height="20">
				  <td colspan="3" rowspan="2" align="center" style="font-weight: bold">NOMOR</td>
				  <td rowspan="3" align="center" style="font-weight: bold">NAMA BARANG </td>
				  <td colspan="3" rowspan="2" align="center" style="font-weight: bold">SPESIFIKASI </td>
				  <td rowspan="3" align="center" style="font-weight: bold">Asal/<br>Cara Perolehan<br>Barang</td>
				  <td rowspan="3" align="center" style="font-weight: bold">Tahun<br>Perolehan</td>
				  <td rowspan="3" align="center" style="font-weight: bold">Ukuran Barang/<br>Kontruksi<br>(P,SP,D)</td>
				  <td rowspan="3" align="center" style="font-weight: bold">Satuan</td>
				  <td rowspan="3" align="center" style="font-weight: bold">Kondisi<br>(B,RR,RB)</td>
				  <td colspan="2" align="center" style="font-weight: bold">JUMLAH AWAL</td>
				  <td colspan="4" align="center" style="font-weight: bold">PEMINDAH TANGANAN</td>
				  <td colspan="2" align="center" style="font-weight: bold">JUMLAH AKHIR </td>
				  <td rowspan="3" align="center" style="font-weight: bold">Keterangan</td>
			    </tr>
				<tr height="20">
				  <td rowspan="2" align="center" style="font-weight: bold">Barang</td>
			      <td rowspan="2" align="center" style="font-weight: bold">Harga</td>
			      <td colspan="2" align="center" style="font-weight: bold">Jumlah Berkurang </td>
			      <td colspan="2" align="center" style="font-weight: bold">Jumlah Bertambah </td>
			      <td rowspan="2" align="center" style="font-weight: bold">Barang</td>
			      <td rowspan="2" align="center" style="font-weight: bold">Harga</td>
			    </tr>
				<tr>
					<td width="31" align="center" style="font-weight: bold">Urut</td>
					<td align="center" style="font-weight: bold">Kode Barang</td>
					<td align="center" style="font-weight: bold">Register</td>
					<td align="center" style="font-weight: bold">Merk Tipe </td>
					<td align="center" style="font-weight: bold">No Sertifikat /No. Rangka/<br>No. Mesin/ No. Pabrik </td>
					<td align="center" style="font-weight: bold">Bahan</td>
					<td align="center" style="font-weight: bold">Barang</td>
					<td align="center" style="font-weight: bold">Harga</td>
					<td align="center" style="font-weight: bold">Barang</td>
					<td align="center" style="font-weight: bold">Harga</td>
				</tr>
				<tr style="font-weight: bold; border-bottom: 3px double #000000; text-align:center">
					<td width="31" align="center">1</td>
					<td width="84" align="center">2</td>
					<td width="47" align="center">3</td>
					<td width="250" align="center">4</td>
					<td width="150" align="center">5</td>
					<td width="150" align="center">6</td>
					<td width="100" align="center">7</td>
					<td width="90" align="center">8</td>
					<td width="60" align="center">9</td>
					<td width="85" align="center">10</td>
					<td width="70" align="center">11</td>
					<td width="70" align="center">12</td>
					<td width="40" align="center">13</td>
					<td width="100" align="center">14</td>
					<td width="40" align="center">15</td>
					<td width="100" align="center">16</td>
					<td width="40" align="center">17</td>
					<td width="90" align="center">18</td>
					<td width="40" align="center">19</td>
					<td width="90" align="center">20</td>
					<td align="center">21</td>
				</tr>
				<?php
				$gTotal=0;
				$iG=1;
				$nSQ = "SELECT Ref_Aset as A0, 
				Kd_Aset as A1, 
				No_Register as A2, 
				Nm_Aset as A3, 
				Tgl_Perolehan as A4, 
				Harga as A5, 
				Nilai_Akhir as A6, 
				Uraian as A7, 
				Kondisi as A8, 
				Asal_Usul as A9 
				FROM ta_rpbmd_new_aset WHERE Referensi='".$Ref."' AND Tahun='".$Thn."' ORDER BY IDT";
				$nRs = mysql_query($nSQ);
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$xB = "";
					$rRF= $mRo[0];
					$x1 = $iG.".";
					$x2 = strtoupper($mRo[1]);
					$x3 = $mRo[2];
					$x4 = $mRo[3];
					$x8 = $mRo[9];
					$x9 = substr($mRo[4],0,4);
					$rTbL = "";//detectTBL($rRF);
					
					$x5 = "";
					$x6 = "";
					#if ($rTbL=='b' || $rTbL=='g'){
						$SQ = "SELECT merk as A0, 
						type as A1, 
						Nomor_Rangka as A2,
						Nomor_Mesin as A3,
						Nomor_Pabrik as A4,
						Bahan as A5,
						Ukuran_CC as A6 
						FROM ta_kib_108 WHERE Referensi='".$rRF."' AND Kd_UPB LIKE '".$UnT."%'";
						$nR = mysql_query($SQ);
						while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
						{
							$x5 = $mR[0];
							if ($mR[1]!='')
							{
								if ($x5!=''){
									$x5.= " / ".$mR[1];
								}
								else{
									$x5 = $mR[1];
								}
							}
							
							$x6 = $mR[2];
							if ($mR[3]!='')
							{
								if ($x6!=''){
									$x6.= " / ".$mR[3];
								}
								else{
									$x6 = $mR[3];
								}
							}
							if ($mR[4]!='' && $mR[4]!='-')
							{
								if ($x6!=''){
									$x6.= " / ".$mR[4];
								}
								else{
									$x6 = $mR[4];
								}
							}
							$x7 = $mR[5];
							$x10 = $mR[6];
						}
					#}
					
					$x12 = $mRo[8];
					
					$x11 = '-';
					$x13 = 1;
					$x14 = $mRo[6];
					$x15 = $x13;
					$x16 = $x14;
					
					$x17 = 0;
					$x18 = 0;
					
					$x19 = $x13-$x15;
					$x20 = $x14-$x16;
					
					$t13 = $t13 + $x13;
					$t14 = $t14 + $x14;
					$t15 = $t15 + $x15;
					$t16 = $t16 + $x16;
					$t17 = $t17 + $x17;
					$t18 = $t18 + $x19;
					$t19 = $t19 + $x19;
					$t20 = $t20 + $x20;
					
					$x21 = $mRo[7];
					
					detilROW($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$x20,$x21,DatabaseSB,$ConSB,$xB);
					$iG++;
				}

				function detilROW($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$x20,$x21,$DatabaseSB,$ConSB,$xB)
				{
				?>
					<tr valign="top" height="22">
						<td style="text-align:center"><?=$xB.$x1?></td>
						<td style="text-align:center"><?=$xB.$x2?></td>
						<td style="text-align:center"><?=$xB.$x3?></td>
						<td><?=$xB.$x4?></td>
						<td><?=$xB.$x5?></td>
						<td style="text-align:center"><?=$xB.$x6?></td>
						<td style="text-align:center"><?=$xB.$x7?></td>
						<td style="text-align:center"><?=$xB.$x8?></td>
						<td style="text-align:center"><?=$xB.$x9?></td>
						<td style="text-align:center"><?=$xB.$x10?></td>
						<td style="text-align:center"><?=$xB.$x11?></td>
						<td style="text-align:center"><?=$xB.$x12?></td>
						<td style="text-align:center"><?php if ($x13>0) {echo $xB.fConvertToRupiahBulat($x13); }else {echo "-";}?></td>
						<td style="text-align:right; padding-right:3px"><?php if ($x14>0) {echo $xB.fConvertToRupiah($x14); }else {echo "-";}?></td>
						<td style="text-align:center"><?php if ($x15>0) {echo $xB.fConvertToRupiahBulat($x15); }else {echo "-";}?></td>
						<td style="text-align:right; padding-right:3px"><?php if ($x16>0) {echo $xB.fConvertToRupiah($x16); }else {echo "-";}?></td>
						<td style="text-align:center"><?php if ($x17>0) {echo $xB.fConvertToRupiahBulat($x17); }else {echo "-";}?></td>
						<td style="text-align:right; padding-right:3px"><?php if ($x18>0) {echo $xB.fConvertToRupiah($x18); }else {echo "-";}?></td>
						<td style="text-align:center"><?php if ($x19>0) {echo $xB.$x19; }else {echo "-";}?></td>
						<td style="text-align:right; padding-right:3px"><?php if ($x20>0) {echo $xB.$x20; }else {echo "-";}?></td>
						<td><?=$xB.$x21?></td>
					</tr>
					<?php
				}
				?>
				<?php
				function rowBLANK()
				{
				?>
				<tr height="20">
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
					<td>&nbsp;</td>
				</tr>
				<?php
				}
				?>
				<?php
				if ($iG==1){
				?>
				<tr height="20">
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
					<td>&nbsp;</td>
				</tr>
				<?php
				}
				?>
				<tr height="23">
					<td colspan="12" align="center" style="font-weight: bold; border-top: 3px double #000000">T O T A L</td>
					<td style="font-weight: bold; border-top: 3px double #000000; text-align:center"><?=fConvertToRupiahBulat($t13)?></td>
					<td style="font-weight: bold; border-top: 3px double #000000; text-align:right; padding-right:3px"><?=fConvertToRupiah($t14)?></td>
					<td style="font-weight: bold; border-top: 3px double #000000; text-align:center"><?=fConvertToRupiahBulat($t15)?></td>
					<td style="font-weight: bold; border-top: 3px double #000000; text-align:right; padding-right:3px"><?=fConvertToRupiah($t16)?></td>
					<td style="font-weight: bold; border-top: 3px double #000000; text-align:right; padding-right:3px"><?php if ($t17>0) {echo fConvertToRupiahBulat($t17);}else{echo "-";}?></td>
					<td style="font-weight: bold; border-top: 3px double #000000; text-align:right; padding-right:3px"><?php if ($t18>0) {echo fConvertToRupiah($t18);}else{echo "-";}?></td>
					<td style="font-weight: bold; border-top: 3px double #000000; text-align:right; padding-right:3px"><?php if ($t19>0) {echo fConvertToRupiahBulat($t19);}else{echo "-";}?></td>
					<td style="font-weight: bold; border-top: 3px double #000000; text-align:right; padding-right:3px"><?php if ($t20>0) {echo fConvertToRupiah($t20);}else{echo "-";}?></td>
					<td style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
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
					<td align="center" width="230"><?=$NmIbuk?>, &nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
					<td width="230" align="center" style="font-weight: bold">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center" style="font-weight: bold" width="230">Pengguna Barang/Kuasa Pengguna Barang</td>
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
					<td align="center" style="font-weight: bold" width="230"><?=$NmPim?></td>
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