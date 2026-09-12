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
$NmT = fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",$UnT,"=","","");

$NmPim = fGlobal("Nma_Pimpinan","ref_unit","kd_unit",$UnT,"=","","");
$NiPim = fGlobal("Nip_Pimpinan","ref_unit","kd_unit",$UnT,"=","","");

$TgC = fGetDate('mday')." / ".fGetDate('mon')." / ".fGetDate('year');
?>
<body onLoad="javascript:window.focus()">

<div align="center">
	<table border="0" width="1500" cellspacing="1" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">USULAN RENCANA KEBUTUHAN PEMELIHARAAN BARANG MILIK DAERAH</td>
		</tr>
		<tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">( RENCANA PEMELIHARAAN )</td>
		</tr>
		<!--tr>
			<td style="font-size: 11pt; font-weight: bold" align="center">PENGGUNA BARANG / KUASA PENGGUNA BARANG</td>
		</tr-->
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
			<td height="5"></td>
		</tr>
		<tr>
			<td>
			<table border="1" width="100%" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" bordercolor="#000000">
				<tr>
					<td width="31" rowspan="3" align="center" style="font-weight: bold">NO</td>
					<td rowspan="3" align="center" style="font-weight: bold">PROGRAM/KEGIATAN/OUTPUT</td>
					<td colspan="8" align="center" style="font-weight: bold">BARANG YANG DIPELIHARA </td>
					<td colspan="3" align="center" style="font-weight: bold">USULAN KEBUTUHAN PEMELIHARAAN </td>
				    <td rowspan="3" align="center" style="font-weight: bold">KETERANGAN</td>
				</tr>
				<tr>
				  <td rowspan="2" align="center" style="font-weight: bold">Kode</td>
				  <td rowspan="2" align="center" style="font-weight: bold">Nama Barang</td>
				  <td rowspan="2" align="center" style="font-weight: bold">Jumlah</td>
				  <td rowspan="2" align="center" style="font-weight: bold">Satuan</td>
				  <td rowspan="2" align="center" style="font-weight: bold">Status Barang </td>
			      <td colspan="3" align="center" style="font-weight: bold">Kondisi Barang </td>
			      <td rowspan="2" align="center" style="font-weight: bold">Nama Pemeliharaan </td>
			      <td rowspan="2" align="center" style="font-weight: bold">Jumlah</td>
			      <td rowspan="2" align="center" style="font-weight: bold">Satuan</td>
		      </tr>
				<tr>
				  <td align="center" style="font-weight: bold">B</td>
			      <td align="center" style="font-weight: bold">RR</td>
			      <td align="center" style="font-weight: bold">RB</td>
			  </tr>
				<tr>
					<td width="31" style="font-weight: bold; border-bottom: 3px double #000000" align="center">1</td>
					<td style="font-weight: bold; border-bottom: 3px double #000000" align="center">2</td>
					<td width="90" style="font-weight: bold; border-bottom: 3px double #000000" align="center">3</td>
					<td width="200" style="font-weight: bold; border-bottom: 3px double #000000" align="center">4</td>
					<td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">5</td>
					<td width="60" align="center" style="font-weight: bold; border-bottom: 3px double #000000">6</td>
					<td width="90" align="center" style="font-weight: bold; border-bottom: 3px double #000000">7</td>
					<td width="35" align="center" style="font-weight: bold; border-bottom: 3px double #000000">8</td>
					<td width="35" align="center" style="font-weight: bold; border-bottom: 3px double #000000">9</td>
					<td width="35" align="center" style="font-weight: bold; border-bottom: 3px double #000000">10</td>
					<td width="200" align="center" style="font-weight: bold; border-bottom: 3px double #000000">11</td>
					<td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">12</td>
					<td width="60" align="center" style="font-weight: bold; border-bottom: 3px double #000000">13</td>
					<td width="150" align="center" style="font-weight: bold; border-bottom: 3px double #000000">14</td>
				</tr>
				<?php
				$nUJ = fGlobalNEW("IfNull(sum(Usulan_Jumlah),0)","ta_rkpbmd_new_rekening","Referensi:Kd_Unit:Tahun",$Ref.":".$UnT.":".$Thn,"=:=:=","",$DatabaseSB,$ConSB,"");
				$nKJ = fGlobalNEW("IfNull(sum(UsulanKebthan_Jumlah),0)","ta_rkpbmd_new_rekening","Referensi:Kd_Unit:Tahun",$Ref.":".$UnT.":".$Thn,"=:=:=","",$DatabaseSB,$ConSB,"");
				
				$nTT = fGlobalNEW("IfNull(sum(Usulan_Harga),0)","ta_rkpbmd_new_rekening","Referensi:Kd_Unit:Tahun",$Ref.":".$UnT.":".$Thn,"=:=:=","",$DatabaseSB,$ConSB,"");
				
				$gTotal=0;
				$iG=1;
				$nSQ = "SELECT nm_program, kd_program FROM ta_rkpbmd_new_program WHERE Referensi='".$Ref."' AND Kd_Unit='".$UnT."' AND Tahun='".$Thn."' GROUP BY Kd_Program";
				$nRs = mysql_query($nSQ);
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$crt="prog";
					if ($iG>1){rowBLANK();}
					$xB = "<b>";
					$x1 = strtoupper($mRo[0]);
					$KdP = $mRo[1];
					detilROW($iG.".",$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$crt,DatabaseSB,$ConSB,$xB);
					detilKEG($Ref,$KdP,$UnT,$Thn,DatabaseSB,$ConSB,"");
					$iG++;
				}

				function detilKEG($Ref,$KdP,$UnT,$Thn,$DatabaseSB,$ConSB,$fSH)
				{
					$iGa=1;
					$nSW = "SELECT nm_kegiatan, kd_kegiatan, Output FROM ta_rkpbmd_new_kegiatan WHERE Referensi='".$Ref."' AND Kd_Unit='".$UnT."' AND Kd_Kegiatan LIKE '".$KdP."%' AND Tahun='".$Thn."' GROUP BY Kd_Kegiatan";
					$nRw = mysql_query($nSW);
					while ($mRw = mysql_fetch_array($nRw, MYSQL_BOTH))
					{
						$crt="kegi";
						if ($iGa>1){rowBLANK();}
						$xB = "";
						$x1 = "KEGIATAN ".strtoupper($mRw[0]);
						//$x1.= "<br><br>Output : ".strtoupper($mRw[2]);
						$KdK = $mRw[1];
						detilROW("",$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$crt,$DatabaseSB,$ConSB,$xB);
						detilSUB($Ref,$KdK,$UnT,$Thn,$DatabaseSB,$ConSB,"");
						$iGa++;
					}
				}
				
				function detilSUB($Ref,$KdP,$UnT,$Thn,$DatabaseSB,$ConSB,$fSH)
				{
					$iGa=1;
					$nSG = "SELECT nm_sub_kegiatan, kd_sub_kegiatan, Output FROM ta_rkpbmd_new_kegiatan_sub WHERE Referensi='".$Ref."' AND Kd_Unit='".$UnT."' AND Kd_Sub_Kegiatan LIKE '".$KdP."%' AND Tahun='".$Thn."' GROUP BY Kd_Sub_Kegiatan";
					$nRG = mysql_query($nSG);
					while ($mRG = mysql_fetch_array($nRG, MYSQL_BOTH))
					{
						$crt="subk";
						if ($iGa>1){rowBLANK();}
						$xB = "";
						$x1 = "KEGIATAN ".strtoupper($mRG[0]);
						$x1.= "<br><br>Output : ".strtoupper($mRG[2]);
						$KdK = $mRG[1];
						detilROW("",$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$crt,$DatabaseSB,$ConSB,$xB);
						detilREK($Ref,$KdK,$UnT,$Thn,$DatabaseSB,$ConSB,"s");
						$iGa++;
					}
				}
				
				function detilREK($Ref,$KdR,$UnT,$Thn,$DatabaseSB,$ConSB,$fSH)
				{
					$nSE = "SELECT nm_rekening as A0, 
					kd_rekening as A1, 
					
					Usulan_Jumlah as A2, 
					Usulan_Satuan as A3, 
					
					Status_Barang as A4, 
					Kondisi_Barang as A5, 
					
					Nama_Pemeliharaan as A6, 
					UsulanKebthan_Jumlah as A7, 
					
					UsulanKebthan_Satuan as A8,					
					Keterangan as A9, 
					Usulan_Harga as A10 
					
					FROM ta_rkpbmd_new_rekening WHERE Referensi='".$Ref."' AND Kd_Unit='".$UnT."' AND Kd_Sub_Kegiatan = '".$KdR."' AND Tahun='".$Thn."' ORDER BY IDT";
					#FROM ta_rkpbmd_new_rekening WHERE Kd_Unit='".$UnT."' AND Kd_Kegiatan = '".$KdR."' AND Tahun='".$Thn."' GROUP BY Kd_Rekening";
					#echo $nSE;
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
						$x5  = $mRe[3];
						
						$x6  = $mRe[4];
						
						if ($mRe[5]=='B'){
							$x7  = $mRe[5];
							$x8  = "";
							$x9  = "";
						}
						if ($mRe[5]=='RR'){
							$x7  = "";
							$x8  = $mRe[5];
							$x9  = "";
						}
						if ($mRe[5]=='RB'){
							$x7  = "";
							$x8  = "";
							$x9  = $mRe[5];
						}
						
						$x10 = $mRe[6];
						$x11 = $mRe[7];
						$x12 = $mRe[8];
						$x13 = $mRe[9];
						$x14 = $mRe[10];
						/*
						if ($mRe[6]>0){
							$x8  = $KdR;
							$x9  = $mRe[0];
						}
						
						$x11 = $mRe[7];
						
						$x12 = $x6-$x10;
						$x13 = $mRe[7];
						
						$x14 = $mRe[8];
						$x15 = $mRe[9];
						*/
						$x3.= "<br><i>Jenis : ".fGlobalNEW("nm_aset","ref_rek_aset108_4","kd_aset",substr($KdR,0,8),"=","",$DatabaseSB,$ConSB,"");
						$x3.= "<br><i>Objek : ".fGlobalNEW("nm_aset","ref_rek_aset108_5","kd_aset",substr($KdR,0,11),"=","",$DatabaseSB,$ConSB,"");
						detilROW("",$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$crt,$DatabaseSB,$ConSB,$xB);
					}
				}
				
				function detilROW($iG,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$crt,$DatabaseSB,$ConSB,$xB)
				{
				?>
					<tr height="20">
						<td valign="top" align="center" height="20"><?=$iG?></td>
						<td valign="top"><?=$xB.$x1?></td>
						<td align="center" valign="top"><?=$xB.$x2?></td>
						<td valign="top"><?=$xB.$x3?></td>
						<td align="center" valign="top"><?=$xB.$x4?></td>
						<td align="center" valign="top"><?=$xB.$x5?></td>
						<td align="center" valign="top"><?=$xB.$x6?></td>
						<td align="center" valign="top"><?=$xB.$x7?></td>
						<td align="center" valign="top"><?=$xB.$x8?></td>
						<td align="center" valign="top"><?=$xB.$x9?></td>
						<td valign="top"><?=$xB.$x10?></td>
						<td align="center" valign="top"><?=$xB.$x11?></td>
						<td align="center" valign="top"><?=$xB.$x12?></td>
						<td valign="top"><?=$xB.$x13?></td>
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
				</tr>
				<?php
				}
				?>
				<tr height="25">
					<td align="center" colspan="4" style="font-weight: bold; border-top: 3px double #000000">JUMLAH</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000"><?=fConvertToRupiahBulat($nUJ)?></td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000"><?=fConvertToRupiahBulat($nKJ)?></td>
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