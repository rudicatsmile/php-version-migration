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
set_time_limit(2000);
extract($_GET);

$gUnt= $gUnt;
$gSub= $gSub;
$gUpb= $gUpb;
$gThn= $gThn;
$gThn2= $gThn2;
require "KIB_Dokumen_Unit.php";

$gMLK  = $gMLK;

if ($gThn=="All" || $gThn=="") {$rThn="____";} else {$rThn=$gThn;}
if ($gMLK=="All" || $gMLK=="") {$rMLK="__";}   else {$rMLK=$gMLK;}

?>
<body>
<table border="0" align="center" width="1250" cellspacing="1" style="font-family: Calibri; font-size: 8pt; border-collapse: collapse" id="table1">
	<tr>
		<td width="1285" align="center" style="font-size: 14pt; font-weight: bold">BUKU INVENTARIS</td>
	</tr>
	<? if ($gThn2) {?>
	<tr>
	  <td style="font-size: 10pt; font-weight: bold; text-align:center"><?="SAMPAI DENGAN TAHUN ".$gThn2?></td>
    </tr>
    <? } ?>
	<tr>
	  <td>&nbsp;</td>
    </tr>
	<tr>
		<td>
		<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table8">
		<tr>
			<td width="67">SKPD</td>
			<td width="20">:</td>
			<td width="909"><?=strtoupper($gNmUNT)?></td>
			<td width="237" align="right">&nbsp;</td>
		</tr>
		<tr>
			<td width="67">SUB UNIT</td>
			<td width="20">:</td>
			<td><?=strtoupper($gNmSUB)?></td>
			<td width="237">&nbsp;</td>
		</tr>
		<tr>
			<td width="67">UPB</td>
			<td width="20">:</td>
			<td><?=strtoupper($gNmUPB)?></td>
			<td width="237">&nbsp;</td>
		</tr>
		<tr>
			<td width="67"><?=$TiDaer?></td>
			<td width="20">:</td>
			<td><?=$NmDaer?></td>
			<td width="237" align="right" style="font-weight: bold">&nbsp;</td>
		</tr>
		</table>		</td>
	</tr>
	<tr>
		<td>
		<table border="1" width="100%" cellspacing="1" style="border:1px solid #000000; font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table7" bordercolor="#000000">
		<tr>
			<td colspan="3" style="font-weight: bold" align="center" height="25">
			Nomor</td>
			<td colspan="4" style="font-weight: bold" align="center" height="25">
			Spesifikasi Barang</td>
			<td rowspan="2" style="font-weight: bold" align="center" width="9%">
			Asal-usul/Cara Perolehan Barang</td>
			<td rowspan="2" style="font-weight: bold" align="center" width="6%">
			Tahun Perolehan</td>
			<td rowspan="2" style="font-weight: bold" align="center" width="6%">
			<table border="0" width="100%" style="font-family: Calibri; font-size: 8pt; border-collapse: collapse; font-weight: bold" id="table8" cellpadding="0">
				<tr>
					<td align="center">Ukuran Barang/</td>
				</tr>
				<tr>
					<td align="center">Konstruksi</td>
				</tr>
				<tr>
					<td align="center">(P,SP,D)</td>
				</tr>
			</table>			</td>
			<td rowspan="2" style="font-weight: bold" align="center" width="4%">
			Satuan</td>
			<td rowspan="2" style="font-weight: bold" align="center" width="5%">
			Keadaan Barang (B,KB,RB)</td>
			<td colspan="2" style="font-weight: bold" align="center" height="25">
			Jumlah</td>
			<td rowspan="2" style="font-weight: bold" align="center" width="12%">
			Ket.</td>
		</tr>
		<tr>
			<td style="font-weight: bold" align="center" width="2%">No.</td>
			<td style="font-weight: bold" align="center" width="5%">Kode 
			Barang</td>
			<td style="font-weight: bold" align="center" width="4%">Register</td>
			<td style="font-weight: bold" align="center" width="16%">
			<table border="0" width="100%" style="font-family: Calibri; font-size: 8pt; border-collapse: collapse; font-weight: bold" id="table9" cellpadding="0">
				<tr>
					<td align="center">Nama / </td>
				</tr>
				<tr>
					<td align="center">Jenis Barang</td>
				</tr>
			</table>			</td>
			<td style="font-weight: bold" align="center" width="6%">Merk/Type</td>
			<td style="font-weight: bold" align="center" width="8%">
			<table border="0" width="100%" style="font-family: Calibri; font-size: 8pt; border-collapse: collapse; font-weight: bold" id="table10" cellpadding="0">
				<tr>
					<td align="center">No.Sertifikat</td>
				</tr>
				<tr>
					<td align="center">No.Pabrik</td>
				</tr>
				<tr>
					<td align="center">No.Chasis</td>
				</tr>
				<tr>
					<td align="center">No.Mesin</td>
				</tr>
			</table>			</td>
			<td style="font-weight: bold" align="center" width="6%">Bahan</td>
			<td style="font-weight: bold" align="center" width="3%">
			Barang</td>
			<td style="font-weight: bold" align="center" width="8%">
			Harga</td>
		</tr>
		<tr>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="2%">
			1</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="5%">
			2</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="4%">
			3</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="16%">
			4</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="6%">
			5</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="8%">
			6</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="6%">
			7</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="9%">
			8</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="6%">
			9</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="6%">
			10</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="4%">
			11</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="5%">
			12</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="3%">
			13</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="8%">
			14</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="12%">
			15</td>
		</tr>
		<?
		$gExt="N";
		$Col[15];
		$iG = 1;
		$Col13=0;
		$gHrg = 0;
		function ClrVr()
		{
			for($nG=1; $nG<=15; $nG++)
			{
				$Col[$nG]="";
			}
		}
		
		$qAKH_A = 0;
		$qAKH_B = 0;
		$qAKH_C = 0;
		$qAKH_D = 0;
		$qAKH_E = 0;
		$qAKH_F = 0;
		$qAKH_G = 0;
		$LoadKib_A="Ya";
		$LoadKib_B="Ya";
		$LoadKib_C="Ya";
		$LoadKib_D="Ya";
		$LoadKib_E="Ya";
		$LoadKib_F="Ya";
		$LoadKib_G="Ya";
		
		if ($LoadKib_A=="Ya")
		{
			//KIB-A
			$nSQL="SELECT * FROM ta_kib_a WHERE extracom='N' AND Kd_UPB LIKE '".$gUpb."' 
			AND (Tgl_Perolehan BETWEEN '".$gThn."-01-01' AND '".$gThn2."-12-31') AND Status='' ORDER BY Kd_Aset, No_Register, Referensi";
			
			$nSQL="SELECT P2.*, P1.Tanggal FROM ta_kib_post P1 
			join ta_kib_a P2 ON P2.Referensi=P1.Referensi AND left(P2.Kd_UPB,11)=left(P1.Kd_UPB,11) 
			WHERE P2.extracom='N' AND P1.Kd_UPB LIKE '".$gUpb."' 
			AND P1.Tanggal <='".$gThn."-12-31' AND P2.Status='' 
			GROUP BY P1.Referensi
			ORDER BY P1.Kd_Aset, P1.No_Register, P1.Referensi";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				do
				{
					ClrVr();
					$Col[1] = $iG;
					$Col[2] = $mRo['Kd_Aset'];
					$Col[3] = $mRo['No_Register'];
					$Col[4] = $mRo['Nm_Aset'];
					if ($Col[4]=="") {$Col[4]=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
					$Col[5] = "";
					$Col[6] = $mRo['Sertifikat_Nomor'];
					$Col[7] = "";
					
					$Col[8] = $mRo['Asal_Usul'];
					$Col[9] = substr($mRo['Tgl_Perolehan'],0,4);
					$Col[10] = fConvertToRupiah($mRo['Luas_M2']);
					$Col[11] = "M<sup>2</sup>";
					$Col[12] = "";
					$gREF = $mRo['Referensi'];
					$rUPB = substr($mRo['Kd_UPB'],0,11);
					$Col[13] = fGlobal("IfNull(count(*),0)","Ta_KIB_a","Referensi:Kd_UPB:Tgl_Perolehan",$gREF.":".$rUPB."%:".$gThn."-12-31","=:LIKE:<=","","");
					$Col13 = $Col13+$Col[13];
					
					$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi:Kd_UPB:Tanggal",$gREF.":".$rUPB."%:".$gThn."-12-31","=:LIKE:<=","","");
					$gNIb = 0;
					
					if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;}
					else {$gAKH=$gNIa;}
					$Col[14] = $gAKH;
					$Col[15] = $mRo['Keterangan'];
					
					echo ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15]);
					$qAKH_A = $qAKH_A + $gAKH;
					$iG++;
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
		
		if ($LoadKib_B=="Ya")
		{
			//KIB-B
			$nSQL="SELECT * FROM ta_kib_b WHERE extracom='N' AND Kd_UPB LIKE '".$gUpb."' 
			AND (Tgl_Perolehan BETWEEN '".$gThn."-01-01' AND '".$gThn2."-12-31') AND Status='' ORDER BY Kd_Aset, No_Register, Referensi";
			 
			$nSQL="SELECT P2.*, P1.Tanggal FROM ta_kib_post P1 
			join ta_kib_b P2 ON P2.Referensi=P1.Referensi AND left(P2.Kd_UPB,11)=left(P1.Kd_UPB,11) 
			WHERE P2.extracom='N' AND P1.Kd_UPB LIKE '".$gUpb."' 
			AND P1.Tanggal <='".$gThn."-12-31' AND P2.Status='' 
			GROUP BY P1.Referensi
			ORDER BY P1.Kd_Aset, P1.No_Register, P1.Referensi";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				do
				{
					ClrVr();
					$Col[1] = $iG;
					$Col[2] = $mRo['Kd_Aset'];
					$Col[3] = $mRo['No_Register'];
					$Col[4] = $mRo['Nm_Aset'];
					if ($Col[4]=="") {$Col[4]=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
					$Col[5] = "-";
					$NmMrk = $mRo['Merk'];
					$NmTyp = $mRo['Type'];

					$NmPbk = $mRo['Nomor_Pabrik'];
					$NmRka = $mRo['Nomor_Rangka'];
					$NmMsn = $mRo['Nomor_Mesin'];
					if ($NmPbk=="") {$NmPbk="-";}
					if ($NmRka=="") {$NmPbk="-";}
					if ($NmMsn=="") {$NmPbk="-";}
					
					if ($NmMrk=="") {$NmMrk="-";}
					if ($NmTyp=="") {$NmTyp="-";}
					
					$Col[5] = "";
					if ($NmMrk!="-") {$Col[5]=$NmMrk;}
					if ($NmTyp!="-")
					{
						if ($Col[5]!="") {$Col[5]=$Col[5]."/".$NmTyp;}
					}
					
					$Col[6] = $NmPbk."<br>".$NmRka."<br>".$NmMsn;
					$Col[7] = $mRo['Bahan'];
					$Col[8] = $mRo['Asal_Usul'];
					$Col[9] = substr($mRo['Tgl_Perolehan'],0,4);
					$Col[10] = $mRo['Ukuran_CC'];
					$Col[11] = "-";
					$Col[12] = $mRo['Kondisi'];
					$gREF = $mRo['Referensi'];
					$rUPB = substr($mRo['Kd_UPB'],0,11);
					
					$Col[13] = fGlobal("IfNull(count(*),0)","Ta_KIB_b","Referensi:Kd_UPB:Tgl_Perolehan",$gREF.":".$rUPB."%:".$gThn."-12-31","=:LIKE:<=","","");
					$Col13 = $Col13+$Col[13];
					
					$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi:Kd_UPB:Tanggal",$gREF.":".$rUPB."%:".$gThn."-12-31","=:LIKE:<=","","");
					$gNIb = 0;
										
					if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;}
					else {$gAKH=$gNIa;}
					$Col[14] = $gAKH;
					$Col[15] = $mRo['Keterangan'];
					
					echo ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15]);
					$qAKH_B = $qAKH_B + $gAKH;
					$iG++;
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
		
		if ($LoadKib_C=="Ya")
		{
			//KIB-C
			$nSQL="SELECT * FROM ta_kib_c WHERE extracom='N' AND Kd_UPB LIKE '".$gUpb."' 
			AND (Tgl_Perolehan BETWEEN '".$gThn."-01-01' AND '".$gThn2."-12-31') AND Status='' ORDER BY Kd_Aset, No_Register, Referensi";
			
			$nSQL="SELECT P2.*, P1.Tanggal FROM ta_kib_post P1 
			join ta_kib_c P2 ON P2.Referensi=P1.Referensi AND left(P2.Kd_UPB,11)=left(P1.Kd_UPB,11) 
			WHERE P2.extracom='N' AND P1.Kd_UPB LIKE '".$gUpb."' 
			AND P1.Tanggal <='".$gThn."-12-31' AND P2.Status='' 
			GROUP BY P1.Referensi
			ORDER BY P1.Kd_Aset, P1.No_Register, P1.Referensi";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				do
				{
					ClrVr();
					$Col[1] = $iG;
					$Col[2] = $mRo['Kd_Aset'];
					$Col[3] = $mRo['No_Register'];
					$Col[4] = $mRo['Nm_Aset'];
					if ($Col[4]=="") {$Col[4]=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
					$Col[5] = "";
					$Col[6] = "";
					$Col[7] = "";
					$Col[8] = $mRo['Asal_Usul'];
					$Col[9] = substr($mRo['Tgl_Perolehan'],0,4);
					if ($mRo['Beton']=="Ya") {$BTON = "Beton";} else {$BTON = "Bukan Beton";}
					if ($mRo['Bertingkat']=="Ya") {$BTKT = "Bertingkat";} else {$BTKT = "Tidak Bertingkat";}
					
					$Col[10] = $BTON."/".$BTKT;
					$Col[11] = "";
					$Col[12] = $mRo['Kondisi'];
					$gREF = $mRo['Referensi'];
					$rUPB = substr($mRo['Kd_UPB'],0,11);
					
					$Col[13] = fGlobal("IfNull(count(*),0)","Ta_KIB_c","Referensi:Kd_UPB:Tgl_Perolehan",$gREF.":".$rUPB."%:".$gThn."-12-31","=:LIKE:<=","","");
					$Col13 = $Col13+$Col[13];
					
					$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi:Kd_UPB:Tanggal",$gREF.":".$rUPB."%:".$gThn."-12-31","=:LIKE:<=","","");
					$gNIb = 0;
					
					if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;}
					else {$gAKH=$gNIa;}
					$Col[14] = $gAKH;
					$Col[15] = $mRo['Keterangan'];
					
					echo ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15]);
					$qAKH_C = $qAKH_C + $gAKH;
					$iG++;
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
		
		if ($LoadKib_D=="Ya")
		{
			//KIB-D
			$nSQL="SELECT * FROM ta_kib_d WHERE extracom='N' AND Kd_UPB LIKE '".$gUpb."' 
			AND (Tgl_Perolehan BETWEEN '".$gThn."-01-01' AND '".$gThn2."-12-31') AND Status='' ORDER BY Kd_Aset, No_Register, Referensi";
			
			$nSQL="SELECT P2.*, P1.Tanggal FROM ta_kib_post P1 
			join ta_kib_d P2 ON P2.Referensi=P1.Referensi AND left(P2.Kd_UPB,11)=left(P1.Kd_UPB,11) 
			WHERE P2.extracom='N' AND P1.Kd_UPB LIKE '".$gUpb."' 
			AND P1.Tanggal <='".$gThn."-12-31' AND P2.Status='' 
			GROUP BY P1.Referensi
			ORDER BY P1.Kd_Aset, P1.No_Register, P1.Referensi";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				do
				{
					ClrVr();
					$Col[1] = $iG;
					$Col[2] = $mRo['Kd_Aset'];
					$Col[3] = $mRo['No_Register'];
					$Col[4] = $mRo['Nm_Aset'];
					if ($Col[4]=="") {$Col[4]=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
					$Col[5] = "";
					$Col[6] = "";
					$Col[7] = "";
					$Col[8] = $mRo['Asal_Usul'];
					$Col[9] = substr($mRo['Tgl_Perolehan'],0,4);
					if ($mRo['Luas']!=0) {$Lua = fConvertToRupiah($mRo['Luas']);} else {$Lua = "";}
					$Col[10] = $Lua;
					$Col[11] = "";
					$Col[12] = $mRo['Kondisi'];
					
					$gREF = $mRo['Referensi'];
					$rUPB = substr($mRo['Kd_UPB'],0,11);
					
					$Col[13] = fGlobal("IfNull(count(*),0)","Ta_KIB_d","Referensi:Kd_UPB:Tgl_Perolehan",$gREF.":".$rUPB."%:".$gThn."-12-31","=:LIKE:<=","","");
					$Col13 = $Col13+$Col[13];
					
					$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi:Kd_UPB:Tanggal",$gREF.":".$rUPB."%:".$gThn."-12-31","=:LIKE:<=","","");
					$gNIb = 0;
					
					if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;}
					else {$gAKH=$gNIa;}
					$Col[14] = $gAKH;
					$Col[15] = $mRo['Keterangan'];
					
					echo ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15]);
					$qAKH_D = $qAKH_D + $gAKH;
					$iG++;
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
		
		if ($LoadKib_E=="Ya")
		{
			//KIB-E
			$nSQL="SELECT * FROM ta_kib_e WHERE extracom='N' AND Kd_UPB LIKE '".$gUpb."' 
			AND (Tgl_Perolehan BETWEEN '".$gThn."-01-01' AND '".$gThn2."-12-31') AND Status='' ORDER BY Kd_Aset, No_Register, Referensi";
			
			$nSQL="SELECT P2.*, P1.Tanggal FROM ta_kib_post P1 
			join ta_kib_e P2 ON P2.Referensi=P1.Referensi AND left(P2.Kd_UPB,11)=left(P1.Kd_UPB,11) 
			WHERE P2.extracom='N' AND P1.Kd_UPB LIKE '".$gUpb."' 
			AND P1.Tanggal <='".$gThn."-12-31' AND P2.Status='' 
			GROUP BY P1.Referensi
			ORDER BY P1.Kd_Aset, P1.No_Register, P1.Referensi";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				do
				{
					ClrVr();
					$Col[1] = $iG;
					$Col[2] = $mRo['Kd_Aset'];
					$Col[3] = $mRo['No_Register'];
					$Col[4] = $mRo['Nm_Aset'];
					if ($Col[4]=="") {$Col[4]=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
					$Col[5] = "";
					$Col[6] = "";
					$Col[7] = $mRo['Bahan'];
					$Col[8] = $mRo['Asal_Usul'];
					$Col[9] = substr($mRo['Tgl_Perolehan'],0,4);
					$Col[10] = "";
					$Col[11] = "";
					$Col[12] = $mRo['Kondisi'];
					$gREF = $mRo['Referensi'];
					$rUPB = substr($mRo['Kd_UPB'],0,11);
					
					$Col[13] = fGlobal("IfNull(count(*),0)","Ta_KIB_e","Referensi:Kd_UPB:Tgl_Perolehan",$gREF.":".$rUPB."%:".$gThn."-12-31","=:LIKE:<=","","");
					$Col13 = $Col13+$Col[13];
					
					$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi:Kd_UPB:Tanggal",$gREF.":".$rUPB."%:".$gThn."-12-31","=:LIKE:<=","","");
					$gNIb = 0;
					
					if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;}
					else {$gAKH=$gNIa;}
					$Col[14] = $gAKH;
					$Col[15] = $mRo['Keterangan'];
					
					echo ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15]);
					$qAKH_E = $qAKH_E + $gAKH;
					$iG++;
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}

		if ($LoadKib_F=="Ya")
		{
			//KIB-F
			$nSQL="SELECT * FROM ta_kib_f WHERE extracom='N' AND Kd_UPB LIKE '".$gUpb."' 
			AND (Tgl_Perolehan BETWEEN '".$gThn."-01-01' AND '".$gThn2."-12-31') AND Status='' ORDER BY Kd_Aset, No_Register, Referensi";
			
			$nSQL="SELECT P2.*, P1.Tanggal FROM ta_kib_post P1 
			join ta_kib_f P2 ON P2.Referensi=P1.Referensi AND left(P2.Kd_UPB,11)=left(P1.Kd_UPB,11) 
			WHERE P2.extracom='N' AND P1.Kd_UPB LIKE '".$gUpb."' 
			AND P1.Tanggal <='".$gThn."-12-31' AND P2.Status='' AND P2.KdpToAset='N' 
			GROUP BY P1.Referensi
			ORDER BY P1.Kd_Aset, P1.No_Register, P1.Referensi";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				do
				{
					ClrVr();
					$Col[1] = $iG;
					$Col[2] = $mRo['Kd_Aset'];
					$Col[3] = $mRo['No_Register'];
					$Col[4] = $mRo['Nm_Aset'];
					if ($Col[4]=="") {$Col[4]=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
					$Col[5] = "";
					$Col[6] = "";
					$Col[7] = "";//$mRo['Bahan'];
					$Col[8] = $mRo['Asal_Usul'];
					$Col[9] = substr($mRo['Tgl_Perolehan'],0,4);
					$Col[10] = "";
					$Col[11] = "";
					$Col[12] = "";//$mRo['Kondisi'];
					
					$gREF = $mRo['Referensi'];
					$rUPB = substr($mRo['Kd_UPB'],0,11);
					
					$Col[13] = fGlobal("IfNull(count(*),0)","Ta_KIB_f","Referensi:Kd_UPB:Tgl_Perolehan:KdpToAset",$gREF.":".$rUPB."%:".$gThn."-12-31:N","=:LIKE:<=:=","","");
					$Col13 = $Col13+$Col[13];
					
					$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi:Kd_UPB:Tanggal:KdpToAset",$gREF.":".$rUPB."%:".$gThn."-12-31:N","=:LIKE:<=:=","","");
					$gNIb = 0;
					
					if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;}
					else {$gAKH=$gNIa;}
					$Col[14] = $gAKH;
					$Col[15] = $mRo['Keterangan'];
					
					echo ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15]);
					$qAKH_F = $qAKH_F + $gAKH;
					$iG++;
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
		
		if ($LoadKib_G=="Ya")
		{
			//KIB-E
			$nSQL="SELECT * FROM ta_kib_e WHERE extracom='N' AND Kd_UPB LIKE '".$gUpb."' 
			AND (Tgl_Perolehan BETWEEN '".$gThn."-01-01' AND '".$gThn2."-12-31') AND Status='' ORDER BY Kd_Aset, No_Register, Referensi";
			
			$nSQL="SELECT P2.*, P1.Tanggal FROM ta_kib_post P1 
			join ta_kib_g P2 ON P2.Referensi=P1.Referensi AND left(P2.Kd_UPB,11)=left(P1.Kd_UPB,11) 
			WHERE P2.extracom='N' AND P1.Kd_UPB LIKE '".$gUpb."' 
			AND P1.Tanggal <='".$gThn."-12-31' AND P2.Status='' 
			GROUP BY P1.Referensi
			ORDER BY P1.Kd_Aset, P1.No_Register, P1.Referensi";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				do
				{
					ClrVr();
					$Col[1] = $iG;
					$Col[2] = $mRo['Kd_Aset'];
					$Col[3] = $mRo['No_Register'];
					$Col[4] = $mRo['Nm_Aset'];
					if ($Col[4]=="") {$Col[4]=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
					$Col[5] = "";
					$Col[6] = "";
					$Col[7] = $mRo['Bahan'];
					$Col[8] = $mRo['Asal_Usul'];
					$Col[9] = substr($mRo['Tgl_Perolehan'],0,4);
					$Col[10] = "";
					$Col[11] = "";
					$Col[12] = $mRo['Kondisi'];
					$gREF = $mRo['Referensi'];
					$rUPB = substr($mRo['Kd_UPB'],0,11);
					
					$Col[13] = fGlobal("IfNull(count(*),0)","Ta_KIB_g","Referensi:Kd_UPB:Tgl_Perolehan",$gREF.":".$rUPB."%:".$gThn."-12-31","=:LIKE:<=","","");
					$Col13 = $Col13+$Col[13];
					
					$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi:Kd_UPB:Tanggal",$gREF.":".$rUPB."%:".$gThn."-12-31","=:LIKE:<=","","");
					$gNIb = 0;
					
					if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;}
					else {$gAKH=$gNIa;}
					$Col[14] = $gAKH;
					$Col[15] = $mRo['Keterangan'];
					
					echo ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15]);
					$qAKH_G = $qAKH_G + $gAKH;
					$iG++;
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
		?>
		<? function ViewRincian($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15) {?>
		<tr>
			<td width="2%" valign="top" align="center"><? echo $x1?>.</td>
			<td width="5%" valign="top"><? echo $x2?></td>
			<td width="4%" valign="top" align="center"><? echo $x3?></td>
			<td width="16%" valign="top"><? echo $x4?></td>
			<td width="6%" valign="top"><? echo $x5?></td>
			<td width="8%" valign="top" align="center"><? echo $x6?></td>
			<td width="6%" valign="top"><? echo $x7?></td>
			<td width="9%" valign="top" align="center"><? echo $x8?></td>
			<td width="6%" valign="top" align="center"><? echo $x9?></td>
			<td width="6%" valign="top" align="center"><? if ($x10!=0) {echo $x10;}?></td>
			<td width="4%" valign="top" align="center"><? if ($x11!="-") {echo $x11;}?></td>
			<td width="5%" valign="top" align="center"><? echo $x12?></td>
			<td width="3%" valign="top" align="center"><? echo $x13?></td>
			<td width="8%" valign="top" align="right"><? echo fConvertToRupiah($x14)?></td>
			<td width="12%" valign="top"><? echo $x15?></td>
		</tr>
		  <? } ?>
          <? function ViewBlank() {?>
		<tr>
			<td width="2%">&nbsp;</td>
			<td width="5%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="16%">&nbsp;</td>
			<td width="6%">&nbsp;</td>
			<td width="8%">&nbsp;</td>
			<td width="6%">&nbsp;</td>
			<td width="9%">&nbsp;</td>
			<td width="6%">&nbsp;</td>
			<td width="6%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="5%">&nbsp;</td>
			<td width="3%">&nbsp;</td>
			<td width="8%">&nbsp;</td>
			<td width="12%">&nbsp;</td>
		</tr>
		  <? } ?>
		<tr>
			<td colspan="12" align="center" style="font-weight: bold; border-top: 3px double #000000; ">J u m l a h</td>
			<td style="font-weight: bold; border-top: 3px double #000000; " align="center" width="3%"><?=$Col13?></td>
			<td style="font-weight: bold; border-top: 3px double #000000; " align="right" width="8%"><? echo fConvertToRupiah($qAKH_A + $qAKH_B + $qAKH_C + $qAKH_D + $qAKH_E + $qAKH_F + $qAKH_G)?></td>
			<td style="font-weight: bold; border-top: 3px double #000000; " align="center" width="12%">&nbsp;</td>
		</tr>
		</table>		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
	  <td><?php require "Lap_Bottom.php"?></td>
  </tr>
</table>
</body>
</html>
