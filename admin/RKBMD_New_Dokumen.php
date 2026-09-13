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
$UnT = fGlobal("Kd_Unit","ta_rkbmd_new","IDT",$IdT,"=","","");
$Ref = fGlobal("Referensi","ta_rkbmd_new","IDT",$IdT,"=","","");

$Thn = fGlobal("Tahun","ta_rkbmd_new","IDT",$IdT,"=","","");
$Apb = fGlobal("Apbd","ta_rkbmd_new","IDT",$IdT,"=","","");
$NmT = fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",$UnT,"=","","");

$NmPim = fGlobal("Nma_Pimpinan","ref_unit","kd_unit",$UnT,"=","","");
$NiPim = fGlobal("Nip_Pimpinan","ref_unit","kd_unit",$UnT,"=","","");

$TgC = fGetDate('mday')." / ".fGetDate('mon')." / ".fGetDate('year');
?>
<body onLoad="javascript:window.focus()">

<div align="center">
	<table border="0" width="1500" cellspacing="1" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table1">
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
			<td style="font-size: 11pt; font-weight: bold" align="center">TAHUN <?=$Thn?> (<?php if ($Apb=='1'){echo "PERUBAHAN";} else {echo "MURNI";}?>)</td>
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
					<td width="31" rowspan="2" align="center" style="font-weight: bold">NO</td>
					<td rowspan="2" align="center" style="font-weight: bold"><p>PROGRAM/KEGIATAN/<br>SUB KEGIATAN/OUTPUT</p>				    </td>
					<td colspan="4" align="center" style="font-weight: bold">USULAN RKBMD </td>
					<td colspan="2" align="center" style="font-weight: bold">KEBUTUHAN<br>MAKSIMUM</td>
					<td colspan="4" align="center" style="font-weight: bold">DATA DAFTAR BARANG<br>YANG DAPAT DIOPTIMALKAN</td>
					<td colspan="2" align="center" style="font-weight: bold">KEBUTUHAN RIIL BMD</td>
					<td rowspan="2" align="center" style="font-weight: bold">KETERANGAN</td>
				</tr>
				<tr>
				  <td align="center" style="font-weight: bold">Kode</td>
				  <td align="center" style="font-weight: bold">Nama Barang</td>
				  <td align="center" style="font-weight: bold">Jumlah</td>
				  <td align="center" style="font-weight: bold">Satuan</td>
				  <td align="center" style="font-weight: bold">Jumlah</td>
			      <td align="center" style="font-weight: bold">Satuan</td>
			      <td align="center" style="font-weight: bold">Kode</td>
			      <td align="center" style="font-weight: bold">Nama Barang</td>
			      <td align="center" style="font-weight: bold">Jumlah</td>
			      <td align="center" style="font-weight: bold">Satuan</td>
			      <td align="center" style="font-weight: bold">Jumlah</td>
			      <td align="center" style="font-weight: bold">Satuan</td>
			  </tr>
				<tr>
					<td width="31" style="font-weight: bold; border-bottom: 3px double #000000" align="center">1</td>
					<td style="font-weight: bold; border-bottom: 3px double #000000" align="center">2</td>
					<td width="70" style="font-weight: bold; border-bottom: 3px double #000000" align="center">3</td>
					<td width="200" style="font-weight: bold; border-bottom: 3px double #000000" align="center">4</td>
					<td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">5</td>
					<td width="60" align="center" style="font-weight: bold; border-bottom: 3px double #000000">6</td>
					<td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">7</td>
					<td width="77" align="center" style="font-weight: bold; border-bottom: 3px double #000000">8</td>
					<td width="70" align="center" style="font-weight: bold; border-bottom: 3px double #000000">9</td>
					<td width="200" align="center" style="font-weight: bold; border-bottom: 3px double #000000">10</td>
					<td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">11</td>
					<td width="60" align="center" style="font-weight: bold; border-bottom: 3px double #000000">12</td>
					<td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">13 (7-11)</td>
					<td width="60" align="center" style="font-weight: bold; border-bottom: 3px double #000000">14</td>
					<td width="80"style="font-weight: bold; border-bottom: 3px double #000000" align="center">15</td>
				</tr>
				<?php
				$nUJ = fGlobalNEW("IfNull(sum(Usulan_Jumlah),0)","ta_rkbmd_new_rekening","Referensi:Kd_Unit:Tahun:Apbd",$Ref.":".$UnT.":".$Thn.":".$Apb,"=:=:=:=","",$DatabaseSB,$ConSB,"");
				$nMJ = fGlobalNEW("IfNull(sum(Maksimum_Jumlah),0)","ta_rkbmd_new_rekening","Referensi:Kd_Unit:Tahun:Apbd",$Ref.":".$UnT.":".$Thn.":".$Apb,"=:=:=:=","",$DatabaseSB,$ConSB,"");
				$nOJ = fGlobalNEW("IfNull(sum(Optimalisasi_Jumlah),0)","ta_rkbmd_new_rekening","Referensi:Kd_Unit:Tahun:Apbd",$Ref.":".$UnT.":".$Thn.":".$Apb,"=:=:=:=","",$DatabaseSB,$ConSB,"");
				
				$nTT = fGlobalNEW("IfNull(sum(Usulan_Harga),0)","ta_rkbmd_new_rekening","Referensi:Kd_Unit:Tahun:Apbd",$Ref.":".$UnT.":".$Thn.":".$Apb,"=:=:=:=","",$DatabaseSB,$ConSB,"");
				
				$gTotal=0;
				$iG=1;
				$nSQ = "SELECT nm_program, kd_program FROM ta_rkbmd_new_program WHERE Referensi='".$Ref."' AND Kd_Unit='".$UnT."' AND Tahun='".$Thn."' AND Apbd='".$Apb."' GROUP BY Kd_Program ORDER BY Kd_Program";
				$nRs = mysql_query($nSQ);
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$crt="prog";
					if ($iG>1){rowBLANK();}
					$xB = "<b>";
					$x1 = strtoupper($mRo[0]);
					$KdP = $mRo[1];
					
					$DtA = fGlobalNEW("sum(Usulan_Jumlah):sum(Maksimum_Jumlah):sum(Optimalisasi_Jumlah)","ta_rkbmd_new_rekening","Referensi:Kd_Unit:Kd_Sub_Kegiatan:Tahun:Apbd",$Ref.":".$UnT.":".$KdP."%:".$Thn.":".$Apb,"=:=:LIKE:=:=","",$DatabaseSB,$ConSB,"");
					$DtA = explode(':',$DtA);
					
					$x4  = $DtA[0];
					$x6  = $DtA[1];
					$x10 = $DtA[2];
					$x12 = $DtA[1]-$DtA[2];
					$x16 = "";
						
					detilROW($iG.".",$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$crt,DatabaseSB,$ConSB,$xB);
					detilKEG($Ref,$KdP,$UnT,$Thn,$Apb,DatabaseSB,$ConSB,"");
					$iG++;
				}

				function detilKEG($Ref,$KdP,$UnT,$Thn,$Apb,$DatabaseSB,$ConSB,$fSH)
				{
					$iGa=1;
					if (substr($KdP,0,3)=='000'){
						$KdP = "___.".substr($KdP,-2,2);
					}
					$nSW = "SELECT nm_kegiatan, kd_kegiatan FROM ta_rkbmd_new_kegiatan WHERE Referensi='".$Ref."' AND Kd_Unit='".$UnT."' AND Kd_Kegiatan LIKE '".$KdP."%' AND Tahun='".$Thn."' AND Apbd='".$Apb."' ORDER BY Kd_Kegiatan";
					if ($fSH) echo $nSW."<br>";
					$nRw = mysql_query($nSW);
					while ($mRw = mysql_fetch_array($nRw, MYSQL_BOTH))
					{
						$crt="kegi";
						if ($iGa>1){rowBLANK();}
						$xB = "<b>";
						$x1 = "<u>Kegiatan</u> :<br>".strtoupper($mRw[0]);
						
						$KdK = $mRw[1];
						$DtA = fGlobalNEW("sum(Usulan_Jumlah):sum(Maksimum_Jumlah):sum(Optimalisasi_Jumlah)","ta_rkbmd_new_rekening","Referensi:Kd_Unit:Kd_Sub_Kegiatan:Tahun:Apbd",$Ref.":".$UnT.":".$KdK."%:".$Thn.":".$Apb,"=:=:LIKE:=:=","",$DatabaseSB,$ConSB,"");
						$DtA = explode(':',$DtA);
						
						$x4  = $DtA[0];
						$x6  = $DtA[1];
						$x10 = $DtA[2];
						$x12 = $DtA[1]-$DtA[2];
						$x16 = "";
						
						detilROW("",$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$crt,$DatabaseSB,$ConSB,$xB);
						detilSUB($Ref,$KdK,$UnT,$Thn,$Apb,$DatabaseSB,$ConSB,"");
						$iGa++;
					}
				}
				
				function detilSUB($Ref,$KdK,$UnT,$Thn,$Apb,$DatabaseSB,$ConSB,$fSH)
				{
					$iGa=1;
					$nST = "SELECT nm_sub_kegiatan, kd_sub_kegiatan, output FROM ta_rkbmd_new_kegiatan_sub WHERE Referensi='".$Ref."' AND Kd_Unit='".$UnT."' AND Kd_Sub_Kegiatan LIKE '".$KdK."%' AND Tahun='".$Thn."' AND Apbd='".$Apb."' ORDER BY Kd_Sub_Kegiatan";
					if ($fSH) echo $nST."<br>";
					$nR = mysql_query($nST);
					while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
					{
						$crt="subk";
						if ($iGa>1){rowBLANK();}
						$xB = "";
						$x1 = "<u>Sub Kegiatan</u> :<br>".strtoupper($mR[0]);
						$x1.= "<br><br>Output : ".$mR[2];
						$KdK = $mR[1];
						
						$DtA = fGlobalNEW("sum(Usulan_Jumlah):sum(Maksimum_Jumlah):sum(Optimalisasi_Jumlah)","ta_rkbmd_new_rekening","Referensi:Kd_Unit:Kd_Sub_Kegiatan:Tahun:Apbd",$Ref.":".$UnT.":".$KdK.":".$Thn.":".$Apb,"=:=:=:=:=","",$DatabaseSB,$ConSB,"");
						$DtA = explode(':',$DtA);
						
						$x4  = $DtA[0];
						$x6  = $DtA[1];
						$x10 = $DtA[2];
						$x12 = $DtA[1]-$DtA[2];
						$x16 = "";
						detilROW("",$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$crt,$DatabaseSB,$ConSB,$xB);
						detilREK($Ref,$KdK,$UnT,$Thn,$Apb,$DatabaseSB,$ConSB,"");
						$iGa++;
					}
				}
				
				function detilREK($Ref,$KdR,$UnT,$Thn,$Apb,$DatabaseSB,$ConSB,$fSH)
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
					Keterangan as A9, 
					Usulan_Harga as A10 
					FROM ta_rkbmd_new_rekening WHERE Referensi='".$Ref."' AND Kd_Unit='".$UnT."' AND Kd_Sub_Kegiatan = '".$KdR."' AND Tahun='".$Thn."' AND Apbd='".$Apb."' ORDER BY IDT";
					if ($fSH) echo $nSE."<br>";
					$nRe = mysql_query($nSE);
					while ($mRe = mysql_fetch_array($nRe, MYSQL_BOTH))
					{
						$x1="";$x2="";$x3="";$x4="";$x5="";$x6="";$x7="";$x8="";$x9="";$x10="";$x11="";$x12="";$x13="";$x14="";$x15="";$x16="";
						$crt="rekn";
						$xB = "";
						
						$KdR = $mRe[1];
						#if ($mRe[2]>0){
							$x2  = $mRe[1];
							$x3  = $mRe[0];
						#}
						
						$x4  = $mRe[2];
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
						$x16 = $mRe[10];
						
						$x3.= "<br><i>Jenis : ".fGlobalNEW("nm_aset","ref_rek_aset108_5","kd_aset",substr($KdR,0,11),"=","",$DatabaseSB,$ConSB,"");
						$x3.= "<br><i>Objek : ".fGlobalNEW("nm_aset","ref_rek_aset108_6","kd_aset",substr($KdR,0,14),"=","",$DatabaseSB,$ConSB,"");
						detilROW("",$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$crt,$DatabaseSB,$ConSB,$xB);
					}
				}
				
				function detilROW($iG,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$crt,$DatabaseSB,$ConSB,$xB)
				{
				?>
					<tr height="20">
						<td valign="top" align="center" height="20"><?=$iG?></td>
						<td valign="top" height="20"><?=$xB.$x1?></td>
						<td valign="top" height="20"><?=$xB.$x2?></td>
						<td valign="top" height="20"><?=$xB.$x3?></td>
						<td align="center" valign="top"><?php if ($x4>0){echo $xB.$x4;}?></td>
						<td align="center" valign="top"><?php if ($x4>0){echo $xB.$x5;}?></td>
						<td align="center" valign="top"><?php if ($x6>0){echo $xB.$x6;}?></td>
						<td align="center" valign="top"><?php if ($x6>0){echo $xB.$x7;}?></td>
						<td align="center" valign="top"><?=$xB.$x8?></td>
						<td valign="top"><?=$xB.$x9?></td>
						<td align="center" valign="top"><?php if ($x10>0){echo $xB.$x10;}?></td>
						<td align="center" valign="top"><?php if ($x10>0){echo $xB.$x11;}?></td>
						<td align="center" valign="top"><?=$xB.$x12?></td>
						<td align="center" valign="top"><?=$xB.$x13?></td>
						<td valign="top"><?=$xB.$x15?></td>
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
				</tr>
				<?php
				}
				?>
				<tr height="25">
					<td align="center" colspan="4" style="font-weight: bold; border-top: 3px double #000000">JUMLAH</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000"><?=fConvertToRupiahBulat($nUJ)?></td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000"><?=fConvertToRupiahBulat($nMJ)?></td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000"><?=fConvertToRupiahBulat($nOJ)?></td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000">&nbsp;</td>
					<td align="center" style="font-weight: bold; border-top: 3px double #000000"><?=fConvertToRupiahBulat($nMJ-$nOJ)?></td>
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