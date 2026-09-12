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
<?
extract($_GET);
$UnT = fGlobal("Kd_Unit","ta_rkbmd_new","IDT",$IdT,"=","","");
$Ref = fGlobal("Referensi","ta_rkbmd_new","IDT",$IdT,"=","","");

$Thn = fGlobal("Tahun","ta_rkbmd_new","IDT",$IdT,"=","","");
$Apb = fGlobal("Apbd","ta_rkbmd_new","IDT",$IdT,"=","","");
$NmT = fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",$UnT,"=","","");

$NmPim = fGlobal("Nma_Pimpinan","ref_unit","kd_unit",$UnT,"=","","");
$NiPim = fGlobal("Nip_Pimpinan","ref_unit","kd_unit",$UnT,"=","","");
?>
<body onLoad="javascript:window.focus()">

<div align="center">
	<table border="0" width="1700" cellspacing="1" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">USULAN RENCANA KEBUTUHAN PENGADAAN BARANG MILIK DAERAH</td>
		</tr>
		<tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">( RENCANA PENGADAAN )</td>
		</tr>
		<!--tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">PENGGUNA BARANG / KUASA PENGGUNA BARANG</td>
		</tr-->
		<tr>
			<td style="font-size: 11pt; font-weight: bold" align="center"><?=strtoupper($NmT)?></td>
		</tr>
		<tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">TAHUN <?=$Thn?> (<? if ($Apb=='1'){echo "PERUBAHAN";} else {echo "MURNI";}?>)</td>
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
			<td height="5"></td>
		</tr>
		<tr>
			<td>
			<table border="1" width="100%" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" bordercolor="#000000">
				<tr>
					<td width="31" rowspan="3" align="center" style="font-weight: bold">NO</td>
					<td rowspan="3" align="center" style="font-weight: bold">PROGRAM/KEGIATAN/OUTPUT</td>
					<td colspan="6" align="center" style="font-weight: bold">USULAN RKBMD </td>
					<td colspan="4" align="center" style="font-weight: bold">KEBUTUHAN<br>MAKSIMUM</td>
					<td colspan="6" align="center" style="font-weight: bold">DATA DAFTAR BARANG<br>YANG DAPAT DIOPTIMALKAN</td>
					<td colspan="2" align="center" style="font-weight: bold">KEBUTUHAN RIIL BMD</td>
					<td rowspan="3" align="center" style="font-weight: bold">CARA PEMENUHAN </td>
					<td rowspan="3" align="center" style="font-weight: bold">KETERANGAN</td>
				</tr>
				<tr>
				  <td rowspan="2" align="center" style="font-weight: bold">Kode</td>
				  <td rowspan="2" align="center" style="font-weight: bold">Nama Barang</td>
				  <td colspan="3" align="center" style="font-weight: bold">Jumlah</td>
				  <td rowspan="2" align="center" style="font-weight: bold">Satuan</td>
				  <td colspan="3" align="center" style="font-weight: bold">Jumlah</td>
			      <td rowspan="2" align="center" style="font-weight: bold">Satuan</td>
			      <td rowspan="2" align="center" style="font-weight: bold">Kode</td>
			      <td rowspan="2" align="center" style="font-weight: bold">Nama Barang</td>
			      <td colspan="3" align="center" style="font-weight: bold">Jumlah</td>
			      <td rowspan="2" align="center" style="font-weight: bold">Satuan</td>
			      <td rowspan="2" align="center" style="font-weight: bold">Jumlah</td>
			      <td rowspan="2" align="center" style="font-weight: bold">Satuan</td>
			    </tr>
				<tr>
				  <td width="40" align="center" style="font-weight: bold">Murni</td>
			      <td width="40" align="center" style="font-weight: bold">Prbhn</td>
			      <td width="40" align="center" style="font-weight: bold"><u>+</u></td>
				  <td width="40" align="center" style="font-weight: bold">Murni</td>
			      <td width="40" align="center" style="font-weight: bold">Prbhn</td>
			      <td width="40" align="center" style="font-weight: bold"><u>+</u></td>
				  <td width="40" align="center" style="font-weight: bold">Murni</td>
			      <td width="40" align="center" style="font-weight: bold">Prbhn</td>
			      <td width="40" align="center" style="font-weight: bold"><u>+</u></td>
			    </tr>
				<tr>
					<td width="31" style="font-weight: bold; border-bottom: 3px double #000000" align="center">1</td>
					<td style="font-weight: bold; border-bottom: 3px double #000000" align="center">2</td>
					<td width="70" style="font-weight: bold; border-bottom: 3px double #000000" align="center">3</td>
					<td width="170" style="font-weight: bold; border-bottom: 3px double #000000" align="center">4</td>
					<td width="7" align="center" style="font-weight: bold; border-bottom: 3px double #000000">5</td>
					<td width="9" align="center" style="font-weight: bold; border-bottom: 3px double #000000">6</td>
					<td width="20" align="center" style="font-weight: bold; border-bottom: 3px double #000000">7</td>
					<td width="60" align="center" style="font-weight: bold; border-bottom: 3px double #000000">8</td>
					<td width="7" align="center" style="font-weight: bold; border-bottom: 3px double #000000">9</td>
					<td width="9" align="center" style="font-weight: bold; border-bottom: 3px double #000000">10</td>
					<td width="20" align="center" style="font-weight: bold; border-bottom: 3px double #000000">11</td>
					<td width="77" align="center" style="font-weight: bold; border-bottom: 3px double #000000">12</td>
					<td width="70" align="center" style="font-weight: bold; border-bottom: 3px double #000000">13</td>
					<td width="170" align="center" style="font-weight: bold; border-bottom: 3px double #000000">14</td>
					<td width="7" align="center" style="font-weight: bold; border-bottom: 3px double #000000">15</td>
					<td width="9" align="center" style="font-weight: bold; border-bottom: 3px double #000000">16</td>
					<td width="20" align="center" style="font-weight: bold; border-bottom: 3px double #000000">17</td>
					<td width="60" align="center" style="font-weight: bold; border-bottom: 3px double #000000">18</td>
					<td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">19 (10-16)</td>
					<td width="60" align="center" style="font-weight: bold; border-bottom: 3px double #000000">20</td>
					<td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">21</td>
					<td width="80"style="font-weight: bold; border-bottom: 3px double #000000" align="center">22</td>
				</tr>
				<?
				$gTotal=0;
				$iG=1;
				$nSQ = "SELECT nm_program, kd_program FROM ta_rkbmd_new_program WHERE Referensi='".$Ref."' AND Kd_Unit='".$UnT."' AND Tahun='".$Thn."' AND Apbd='".$Apb."' GROUP BY Kd_Program ORDER BY Kd_Program";
				#echo $nSQ."<br>";
				$nRs = mysql_query($nSQ);
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$crt="prog";
					if ($iG>1){rowBLANK();}
					$xB = "<b>";
					$x1 = strtoupper($mRo[0]);
					$KdP = $mRo[1];
					detilROW($iG.".",$x1,$x2,$x3,$x4,$x4a,$x5,$x6,$x6a,$x7,$x8,$x9,$x10,$x10a,$x11,$x12,$x13,$x14,$x15,$crt,DatabaseSB,$ConSB,$xB);
					detilKEG($Ref,$KdP,$UnT,$Thn,$Apb,DatabaseSB,$ConSB,"");
					$iG++;
				}

				function detilKEG($Ref,$KdP,$UnT,$Thn,$Apb,$DatabaseSB,$ConSB,$fSH)
				{
					$iGa=1;
					if (substr($KdP,0,3)=='000'){
						$KdP = "___.".substr($KdP,-2,2);
					}
					$nSW = "SELECT nm_kegiatan, kd_kegiatan FROM ta_rkbmd_new_kegiatan WHERE Referensi='".$Ref."' AND Kd_Unit='".$UnT."' AND Kd_Kegiatan LIKE '".$KdP."%' AND Tahun='".$Thn."' AND Apbd='".$Apb."' GROUP BY Kd_Kegiatan ORDER BY Kd_Kegiatan";
					if ($fSH) echo $nSW."<br>";
					$nRw = mysql_query($nSW);
					while ($mRw = mysql_fetch_array($nRw, MYSQL_BOTH))
					{
						$crt="kegi";
						if ($iGa>1){rowBLANK();}
						$xB = "<b>";
						$x1 = "KEGIATAN ".strtoupper($mRw[0]);
						$KdK = $mRw[1];
						detilROW("",$x1,$x2,$x3,$x4,$x4a,$x5,$x6,$x6a,$x7,$x8,$x9,$x10,$x10a,$x11,$x12,$x13,$x14,$x15,$crt,$DatabaseSB,$ConSB,$xB);
						detilREK($Ref,$KdK,$UnT,$Thn,$Apb,$DatabaseSB,$ConSB,"");
						$iGa++;
					}
				}
				
				function detilREK($Ref,$KdK,$UnT,$Thn,$Apb,$DatabaseSB,$ConSB,$fSH)
				{
					$nSE = "SELECT nm_rekening as A0, 
					kd_rekening as A1, 
					Usulan_Jumlah as A2, 
					Usulan_Satuan as A3, 
					Maksimum_Jumlah as A4, 
					Maksimum_Satuan as A5,
					Optimalisasi_Jumlah as A6, 
					Optimalisasi_Satuan as A7, 
					Cara_Pemenuhan as A8,
					Keterangan as A9 
					FROM ta_rkbmd_new_rekening WHERE Referensi='".$Ref."' AND Kd_Unit='".$UnT."' AND Kd_Kegiatan = '".$KdK."' AND Tahun='".$Thn."' AND Apbd='".$Apb."' ORDER BY IDT";
					$nRe = mysql_query($nSE);
					while ($mRe = mysql_fetch_array($nRe, MYSQL_BOTH))
					{
						$x1="";$x2="";$x3="";$x4="";$x5="";$x6="";$x7="";$x8="";$x9="";$x10="";$x11="";$x12="";$x13="";$x14="";$x15="";
						$crt="rekn";
						$xB = "";
						
						$KdR = $mRe[1];
						$x2  = $mRe[1];
						$x3  = $mRe[0];
						
						$x4  = $mRe[2];
						$xDT = fGlobal("Usulan_Jumlah:Maksimum_Jumlah:Optimalisasi_Jumlah","ta_rkbmd_new_rekening","Kd_Unit:Referensi:Kd_Kegiatan:Kd_Rekening:Tahun:Apbd",$UnT.":".$Ref.":".$KdK.":".$KdR.":".$Thn.":0","=:=:=:=:=:=","","");
						$xDT = explode(":",$xDT);
						$x4a  = $xDT[0];
						$x6a  = $xDT[1];
						$x10a = $xDT[2];
						
						$x5  = $mRe[3];
						
						$x6  = $mRe[4];
						$x7  = $mRe[5];
						if ($mRe[6]>0){
							$x8  = $KdR;
							$x9  = $mRe[0];
						}
						
						$x10 = $mRe[6];
						$x11 = $mRe[7];
						
						$x12 = $x6-$x10;
						$x13 = $mRe[7];
						
						$x14 = $mRe[8];
						$x15 = $mRe[9];
						
						$x3.= "<br><i>Jenis : ".fGlobal("nm_aset","ref_rek_aset3","kd_aset",substr($KdR,0,8),"=","","");
						$x3.= "<br><i>Objek : ".fGlobal("nm_aset","ref_rek_aset4","kd_aset",substr($KdR,0,11),"=","","");
						detilROW("",$x1,$x2,$x3,$x4,$x4a,$x5,$x6,$x6a,$x7,$x8,$x9,$x10,$x10a,$x11,$x12,$x13,$x14,$x15,$crt,$DatabaseSB,$ConSB,$xB);
					}
				}
				
				function detilROW($iG,$x1,$x2,$x3,$x4,$x4a,$x5,$x6,$x6a,$x7,$x8,$x9,$x10,$x10a,$x11,$x12,$x13,$x14,$x15,$crt,$DatabaseSB,$ConSB,$xB)
				{
				?>
					<tr height="20">
						<td valign="top" align="center" height="20"><?=$iG?></td>
						<td valign="top" height="20"><?=$xB.$x1?></td>
						<td valign="top" height="20"><?=$xB.$x2?></td>
						<td valign="top" height="20"><?=$xB.$x3?></td>
						<td align="center" valign="top"><? if ($x4a>0){echo $xB.$x4a;}?></td>
						<td align="center" valign="top" style="color:#0000FF"><? if ($x4>0){echo $xB.$x4;}?></td>
						<td align="center" valign="top"><? if ($x4a>0){echo $xB.($x4-$x4a);}?></td>
						<td align="center" valign="top"><? if ($x4>0){echo $xB.$x5;}?></td>
						<td align="center" valign="top"><? if ($x6a>0){echo $xB.$x6a;}?></td>
						<td align="center" valign="top" style="color:#0000FF"><? if ($x6>0){echo $xB.$x6;}?></td>
						<td align="center" valign="top"><? if ($x6a>0){echo $xB.($x6-$x6a);}?></td>
						<td align="center" valign="top"><? if ($x6>0){echo $xB.$x7;}?></td>
						<td align="center" valign="top"><?=$xB.$x8?></td>
						<td valign="top"><?=$xB.$x9?></td>
						<td align="center" valign="top"><? if ($x10a>0){echo $xB.$x10a;}?></td>
						<td align="center" valign="top" style="color:#0000FF"><? if ($x10>0){echo $xB.$x10;}?></td>
						<td align="center" valign="top"><? if ($x10a>0){echo $xB.($x10-$x10a);}?></td>
						<td align="center" valign="top"><? if ($x10>0){echo $xB.$x11;}?></td>
						<td align="center" valign="top"><?=$xB.$x12?></td>
						<td align="center" valign="top"><?=$xB.$x13?></td>
						<td align="center" valign="top"><?=$xB.$x14?></td>
						<td valign="top"><?=$xB.$x15?></td>
					</tr>
					<?
				}
				?>
				<?
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
					<td>&nbsp;</td>
				</tr>
				<?
				}
				?>
				<?
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
					<td>&nbsp;</td>
				</tr>
				<?
				}
				?>
				<tr>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
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
					<td align="center" width="230"><?=$IbKta?>, &nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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