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
//echo $gA."<br>";
//echo $gB."<br>";
//echo $gC."<br>";
//echo $gD."<br>";
//echo $gE."<br>";

$gExt="N";
if ($gA) {$rKIB ="A";}
if ($gB) {if ($rKIB!="") {$rKIB.=", B";} else {$rKIB="B";}}
if ($gB) {if ($rKIB!="") {$rKIB.=", C";} else {$rKIB="C";}}
if ($gB) {if ($rKIB!="") {$rKIB.=", D";} else {$rKIB="D";}}
if ($gB) {if ($rKIB!="") {$rKIB.=", E";} else {$rKIB="E";}}

$gUnt= $gUnt;
$gSub= $gSub;
$gUpb= $gUpb;
$gThn= $gThn;
require "KIB_Dokumen_Unit.php";

$gMLK  = $gMLK;

if ($gThn=="All" || $gThn=="") {$rThn="____";} else {$rThn=$gThn;}
if ($gMLK=="All" || $gMLK=="") {$rMLK="__";}   else {$rMLK=$gMLK;}
$Thn_A= $rThn-1;
$Thn_B= $rThn;

?>
<body>
<table border="0" align="center" width="1400" cellspacing="1" style="font-family: Calibri; font-size: 8pt; border-collapse: collapse" id="table1">
  <tr>
    <td align="center" style="font-size: 12pt; font-weight: bold">LAPORAN MUTASI BARANG (KIB <?=$rKIB?>)</td>
  </tr>
	<tr>
      <td align="center" style="font-size: 12pt; font-weight: bold">TAHUN ANGGARAN <?php echo $Thn_B?></td>
  </tr>
	<tr>
      <td align="center" style="font-size: 11pt">Per Tanggal 31 Desember <?php echo $Thn_B?> </td>
  </tr>
	<tr>
	  <td width="1285">&nbsp;</td>
  </tr>
	<tr>
		<td>
		<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table8">
		<tr>
			<td width="73">SKPD</td>
			<td width="26">:</td>
			<td width="1047"><?=strtoupper($gNmUNT)?></td>
			<td width="237" align="right">&nbsp;</td>
		</tr>
		<tr>
			<td width="73">SUB UNIT </td>
			<td width="26">:</td>
			<td><?=strtoupper($gNmSUB)?></td>
			<td width="237">&nbsp;</td>
		</tr>
		<tr>
			<td width="73">UPB</td>
			<td width="26">:</td>
			<td><?=strtoupper($gNmUPB)?></td>
			<td width="237">&nbsp;</td>
		</tr>
		<tr>
			<td width="73"><?=$TiDaer?></td>
			<td width="26">:</td>
			<td><?=$NmDaer?></td>
			<td width="237" align="right" style="font-weight: bold">Kode Lokasi : <?php echo fStrukKdLokasi($rMLK,$KdProp,$KdKabK,$gUnt,$gSub,$rThn)?></td>
		</tr>
		</table>		</td>
	</tr>
	<tr>
		<td>
		<table border="1" width="100%" cellspacing="1" style="border:1px solid #000000; font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table7" bordercolor="#000000">
		<tr>
			<td height="25" colspan="3" rowspan="2" align="center" style="font-weight: bold">
			Nomor</td>
			<td height="25" colspan="4" rowspan="2" align="center" style="font-weight: bold">
			Spesifikasi Barang</td>
			<td rowspan="3" style="font-weight: bold" align="center" width="5%">
			Asal-usul/Cara Perolehan Barang</td>
			<td rowspan="3" style="font-weight: bold" align="center" width="4%">
			Tahun Perolehan</td>
			<td rowspan="3" style="font-weight: bold" align="center" width="4%">
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
			<td rowspan="3" style="font-weight: bold" align="center" width="3%">
			Satuan</td>
			<td rowspan="3" style="font-weight: bold" align="center" width="4%">
			Keadaan Barang (B,KB,RB)</td>
			<td height="25" colspan="2" rowspan="2" align="center" style="font-weight: bold">
			Jumlah Awal<br>(<?php echo $Thn_A?>)</td>
			<td colspan="4" align="center" style="font-weight: bold">Mutasi / Perubahan </td>
		    <td colspan="2" rowspan="2" align="center" style="font-weight: bold">Jumlah Akhir<br>(<?php echo $Thn_B?>)</td>
		    <td rowspan="3" style="font-weight: bold" align="center" width="7%"> Keterangan</td>
		</tr>
		<tr>
		  <td colspan="2" align="center" style="font-weight: bold">Berkurang</td>
		  <td colspan="2" align="center" style="font-weight: bold">Bertambah</td>
		  </tr>
		<tr>
			<td style="font-weight: bold" align="center" width="2%">No.</td>
			<td style="font-weight: bold" align="center" width="3%">Kode 
			Barang</td>
			<td style="font-weight: bold" align="center" width="4%">Register</td>
			<td style="font-weight: bold" align="center" width="10%">
			<table border="0" width="100%" style="font-family: Calibri; font-size: 8pt; border-collapse: collapse; font-weight: bold" id="table9" cellpadding="0">
				<tr>
					<td align="center">Nama / </td>
				</tr>
				<tr>
					<td align="center">Jenis Barang</td>
				</tr>
			</table>			</td>
			<td style="font-weight: bold" align="center" width="5%">Merk/Type</td>
			<td style="font-weight: bold" align="center" width="5%">
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
			<td style="font-weight: bold" align="center" width="4%">Bahan</td>
			<td style="font-weight: bold" align="center" width="3%">
			Barang</td>
			<td style="font-weight: bold" align="center" width="6%">
			Harga</td>
		    <td style="font-weight: bold" align="center" width="3%">Jumlah Barang</td>
		    <td style="font-weight: bold" align="center" width="6%">Harga</td>
		    <td style="font-weight: bold" align="center" width="4%">Jumlah Barang </td>
		    <td style="font-weight: bold" align="center" width="7%">Harga</td>
		    <td style="font-weight: bold" align="center" width="4%">Barang</td>
		    <td style="font-weight: bold" align="center" width="7%">Harga</td>
		</tr>
		<tr>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="2%">
			1</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="3%">
			2</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="4%">
			3</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="10%">
			4</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="5%">
			5</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="5%">
			6</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="4%">
			7</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="5%">
			8</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="4%">
			9</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="4%">
			10</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="3%">
			11</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="4%">
			12</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="3%">
			13</td>
			<td style="font-weight: bold; border-bottom: 3px double #000000" align="center" width="6%">
			14</td>
			<td width="3%" align="center" style="font-weight: bold; border-bottom: 3px double #000000">
			15</td>
		    <td width="6%" align="center" style="font-weight: bold; border-bottom: 3px double #000000">16</td>
		    <td width="4%" align="center" style="font-weight: bold; border-bottom: 3px double #000000">17</td>
		    <td width="7%" align="center" style="font-weight: bold; border-bottom: 3px double #000000">18</td>
		    <td width="4%" align="center" style="font-weight: bold; border-bottom: 3px double #000000">19</td>
		    <td width="7%" align="center" style="font-weight: bold; border-bottom: 3px double #000000">20</td>
		    <td width="7%" align="center" style="font-weight: bold; border-bottom: 3px double #000000">21</td>
		</tr>
		<?php
		$Col[21];
		$iG = 1;
		$gHrg = 0;
		function ClrVr()
		{
			for($nG=1; $nG<=21; $nG++)
			{
				$Col[$nG]="";
			}
		}
		
		$qAKH     = 0;
		//$LoadKib_A="Ya";
		//$LoadKib_B="Ya";
		//$LoadKib_C="Ya";
		//$LoadKib_D="Ya";
		//$LoadKib_E="Ya";
		
		if ($gA=="Ya")
		{
			//KIB-A
			$nSQL="SELECT * FROM ta_kib_a WHERE Kd_UPB LIKE '".$gUpb."' AND Kd_Pemilik LIKE '".$rMLK."' AND Tgl_Perolehan <= '".$Thn_B."-12-31' ORDER BY Kd_Aset, No_Register, Referensi";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				do
				{
					$gAWL = 0;
					$gKRG = 0;
					$gTBH = 0;
					$gAHK = 0;
					
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
					
					//AWAL
					$Col[13] = fGlobal("IfNull(count(*),0)","Ta_KIB_A","Referensi:Tgl_Perolehan:Status",$gREF.":".$Thn_A."-12-31:","=:<=:=","","");
					$gNIa = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Referensi:Tanggal",$gREF.":".$Thn_A."-12-31","=:<=","","");
					$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi:Tanggal",$gREF.":".$Thn_A."-12-31","=:<=","","");
					if ($gNIb!=0) {$gAWL = $gNIa - $gNIb;}
					else {$gAWL=$gNIa;}
					$Col[14] = $gAWL;
					
					//BERKURANG
					$gKRG    = fGlobal("IfNull(sum(Kredit),0)", "Ta_KIB_Post","Referensi:Tanggal:Tanggal",$gREF.":".$Thn_B."-01-01".":".$Thn_B."-12-31","=:>=:<=","","");
					$Col[15] = fGlobal("IfNull(count(*),0)","Ta_KIB_A","Referensi:Tgl_Perolehan:Tgl_Perolehan:Status",$gREF.":".$Thn_B."-01-01".":".$Thn_B."-12-31:","=:>=:<=:<>","","");
					$Col[16] = $gKRG;
					
					//BERTAMBAH
					$Col[17] = 0;
					$gTBH    = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Referensi:Tanggal:Tanggal",$gREF.":".$Thn_B."-01-01".":".$Thn_B."-12-31","=:>=:<=","","");
					$Col[18] = $gTBH;
					$Col[19] = fGlobal("IfNull(count(*),0)","Ta_KIB_A","Referensi:Tgl_Perolehan:Status",$gREF.":".$Thn_B."-12-31:","=:<=:=","","");
					
					//AKHIR
					$gAKH    = $gAWL - $gKRG + $gTBH;
					$Col[20] = $gAKH;
					$Col[21] = $mRo['Keterangan'];
					
					ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19],$Col[20],$Col[21]);
					$qAWL = $qAWL + $gAWL;
					$qKRG = $qKRG + $gKRG;
					$qTBH = $qTBH + $gTBH;
					$qAKH = $qAKH + $gAKH;
					$iG++;
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
		
		if ($gB=="Ya")
		{
			//KIB-B
			$nSQL="SELECT * FROM ta_kib_b WHERE extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Pemilik LIKE '".$rMLK."' AND Tgl_Perolehan <= '".$Thn_B."-12-31' ORDER BY Kd_Aset, No_Register, Referensi";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				do
				{
					$gAWL = 0;
					$gKRG = 0;
					$gTBH = 0;
					$gAHK = 0;
					
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
					$Col[13] = "";
					$gREF = $mRo['Referensi'];
					$gNIa = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Referensi:Tanggal",$gREF.":".$Thn_A."-12-31","=:<=","","");
					$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi:Tanggal",$gREF.":".$Thn_A."-12-31","=:<=","","");
					if ($gNIb!=0) {$gAWL = $gNIa - $gNIb;}
					else {$gAWL=$gNIa;}
					$Col[14] = $gAWL;
					
					//BERKURANG
					$gKRG    = fGlobal("IfNull(sum(Kredit),0)", "Ta_KIB_Post","Referensi:Tanggal:Tanggal",$gREF.":".$Thn_B."-01-01".":".$Thn_B."-12-31","=:>=:<=","","");
					$Col[15] = 0;
					$Col[16] = $gKRG;
					
					//BERTAMBAH
					$Col[17] = 0;
					$gTBH    = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Referensi:Tanggal:Tanggal",$gREF.":".$Thn_B."-01-01".":".$Thn_B."-12-31","=:>=:<=","","");
					$Col[18] = $gTBH;
					$Col[19] = 0;
					
					//AKHIR
					$gAKH    = $gAWL - $gKRG + $gTBH;
					$Col[20] = $gAKH;
					$Col[21] = $mRo['Keterangan'];
					
					ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19],$Col[20],$Col[21]);
					$qAWL = $qAWL + $gAWL;
					$qKRG = $qKRG + $gKRG;
					$qTBH = $qTBH + $gTBH;
					$qAKH = $qAKH + $gAKH;
					$iG++;
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
		
		if ($gC=="Ya")
		{
			//KIB-C
			$nSQL="SELECT * FROM ta_kib_c WHERE extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Pemilik LIKE '".$rMLK."' AND Tgl_Perolehan <= '".$Thn_B."-12-31' ORDER BY Kd_Aset, No_Register, Referensi";
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
					$Col[13] = "";
					$gREF = $mRo['Referensi'];
					$gNIa = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Referensi:Tanggal",$gREF.":".$Thn_A."-12-31","=:<=","","");
					$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi:Tanggal",$gREF.":".$Thn_A."-12-31","=:<=","","");
					if ($gNIb!=0) {$gAWL = $gNIa - $gNIb;}
					else {$gAWL=$gNIa;}
					$Col[14] = $gAWL;
					
					//BERKURANG
					$gKRG    = fGlobal("IfNull(sum(Kredit),0)", "Ta_KIB_Post","Referensi:Tanggal:Tanggal",$gREF.":".$Thn_B."-01-01".":".$Thn_B."-12-31","=:>=:<=","","");
					$Col[15] = 0;
					$Col[16] = $gKRG;
					
					//BERTAMBAH
					$Col[17] = 0;
					$gTBH    = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Referensi:Tanggal:Tanggal",$gREF.":".$Thn_B."-01-01".":".$Thn_B."-12-31","=:>=:<=","","");
					$Col[18] = $gTBH;
					$Col[19] = 0;
					
					//AKHIR
					$gAKH    = $gAWL - $gKRG + $gTBH;
					$Col[20] = $gAKH;
					$Col[21] = $mRo['Keterangan'];
					
					ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19],$Col[20],$Col[21]);
					$qAWL = $qAWL + $gAWL;
					$qKRG = $qKRG + $gKRG;
					$qTBH = $qTBH + $gTBH;
					$qAKH = $qAKH + $gAKH;
					$iG++;
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
		
		if ($gD=="Ya")
		{
			//KIB-D
			$nSQL= "SELECT * FROM ta_kib_d WHERE Kd_UPB LIKE '".$gUpb."' AND Kd_Pemilik LIKE '".$rMLK."' AND Tgl_Perolehan <= '".$Thn_B."-12-31' ORDER BY Kd_Aset, No_Register, Referensi";
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
					$Col[13] = "";
					$gREF = $mRo['Referensi'];
					$gNIa = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Referensi:Tanggal",$gREF.":".$Thn_A."-12-31","=:<=","","");
					$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi:Tanggal",$gREF.":".$Thn_A."-12-31","=:<=","","");
					if ($gNIb!=0) {$gAWL = $gNIa - $gNIb;}
					else {$gAWL=$gNIa;}
					$Col[14] = $gAWL;
					
					//BERKURANG
					$gKRG    = fGlobal("IfNull(sum(Kredit),0)", "Ta_KIB_Post","Referensi:Tanggal:Tanggal",$gREF.":".$Thn_B."-01-01".":".$Thn_B."-12-31","=:>=:<=","","");
					$Col[15] = 0;
					$Col[16] = $gKRG;
					
					//BERTAMBAH
					$Col[17] = 0;
					$gTBH    = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Referensi:Tanggal:Tanggal",$gREF.":".$Thn_B."-01-01".":".$Thn_B."-12-31","=:>=:<=","","");
					$Col[18] = $gTBH;
					$Col[19] = 0;
					
					//AKHIR
					$gAKH    = $gAWL - $gKRG + $gTBH;
					$Col[20] = $gAKH;
					$Col[21] = $mRo['Keterangan'];
					
					ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19],$Col[20],$Col[21]);
					$qAWL = $qAWL + $gAWL;
					$qKRG = $qKRG + $gKRG;
					$qTBH = $qTBH + $gTBH;
					$qAKH = $qAKH + $gAKH;
					$iG++;
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
		
		if ($gE=="Ya")
		{
			//KIB-E
			$nSQL="SELECT * FROM ta_kib_e WHERE Kd_UPB LIKE '".$gUpb."' AND Kd_Pemilik LIKE '".$rMLK."' AND Tgl_Perolehan <= '".$Thn_B."-12-31' ORDER BY Kd_Aset, No_Register, Referensi";
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
					$Col[13] = "";
					$gREF = $mRo['Referensi'];
					$gNIa = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Referensi:Tanggal",$gREF.":".$Thn_A."-12-31","=:<=","","");
					$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi:Tanggal",$gREF.":".$Thn_A."-12-31","=:<=","","");
					if ($gNIb!=0) {$gAWL = $gNIa - $gNIb;}
					else {$gAWL=$gNIa;}
					$Col[14] = $gAWL;
					
					//BERKURANG
					$gKRG    = fGlobal("IfNull(sum(Kredit),0)", "Ta_KIB_Post","Referensi:Tanggal:Tanggal",$gREF.":".$Thn_B."-01-01".":".$Thn_B."-12-31","=:>=:<=","","");
					$Col[15] = 0;
					$Col[16] = $gKRG;
					
					//BERTAMBAH
					$Col[17] = 0;
					$gTBH    = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Referensi:Tanggal:Tanggal",$gREF.":".$Thn_B."-01-01".":".$Thn_B."-12-31","=:>=:<=","","");
					$Col[18] = $gTBH;
					$Col[19] = 0;
					
					//AKHIR
					$gAKH    = $gAWL - $gKRG + $gTBH;
					$Col[20] = $gAKH;
					$Col[21] = $mRo['Keterangan'];
					
					ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19],$Col[20],$Col[21]);
					$qAWL = $qAWL + $gAWL;
					$qKRG = $qKRG + $gKRG;
					$qTBH = $qTBH + $gTBH;
					$qAKH = $qAKH + $gAKH;
					$iG++;
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
		?>
		<?php function ViewRincian($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$x20,$x21) {?>
		<tr>
			<td width="2%" style="font-size:8pt" valign="top" align="center"><?php echo $x1?>.</td>
			<td width="3%" style="font-size:8pt" valign="top"><?php echo $x2?></td>
			<td width="4%" style="font-size:8pt" valign="top" align="center"><?php echo $x3?></td>
			<td width="10%" style="font-size:8pt" valign="top"><?php echo $x4?></td>
			<td width="5%" style="font-size:8pt" valign="top"><?php echo $x5?></td>
			<td width="5%" style="font-size:8pt" valign="top" align="center"><?php echo $x6?></td>
			<td width="4%" style="font-size:8pt" valign="top"><?php echo $x7?></td>
			<td width="5%" style="font-size:8pt" valign="top" align="center"><?php echo $x8?></td>
			<td width="4%" style="font-size:8pt" valign="top" align="center"><?php echo $x9?></td>
			<td width="4%" style="font-size:8pt" valign="top" align="center"><?php if ($x10!=0) {echo $x10;}?></td>
			<td width="3%" style="font-size:8pt" valign="top" align="center"><?php if ($x11!="-") {echo $x11;}?></td>
			<td width="4%" style="font-size:8pt" valign="top" align="center"><?php echo $x12?></td>
			<td width="3%" style="font-size:8pt" valign="top" align="center"><?php echo $x13?></td>
			<td width="6%" style="font-size:8pt" valign="top" align="right"><?php if ($x14!=0) {echo fConvertToRupiah($x14);}?></td>
			<td width="3%" style="font-size:8pt" valign="top" align="center"><?php if ($x15!=0) {echo $x15;}?></td>
		    <td width="6%" style="font-size:8pt" valign="top" align="right"><?php if ($x16!=0) {echo fConvertToRupiah($x16);}?></td>
		    <td width="4%" style="font-size:8pt" valign="top" align="center"><?php if ($x17!=0) {echo $x17;}?></td>
		    <td width="7%" style="font-size:8pt" valign="top" align="right"><?php if ($x18!=0) {echo fConvertToRupiah($x18);}?></td>
		    <td width="4%" style="font-size:8pt" valign="top" align="center"><?php if ($x19!=0) {echo $x19;}?></td>
		    <td width="7%" style="font-size:8pt" valign="top" align="right"><?php if ($x20!=0) {echo fConvertToRupiah($x20);}?></td>
		    <td width="7%" style="font-size:8pt" valign="top"><?php echo $x21?></td>
		</tr>
		  <?php } ?>
          <?php function ViewBlank() {?>
		<tr>
			<td width="2%">&nbsp;</td>
			<td width="3%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="5%">&nbsp;</td>
			<td width="5%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="5%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="3%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="3%">&nbsp;</td>
			<td width="6%">&nbsp;</td>
			<td width="3%">&nbsp;</td>
		    <td width="6%">&nbsp;</td>
		    <td width="4%">&nbsp;</td>
		    <td width="7%">&nbsp;</td>
		    <td width="4%">&nbsp;</td>
		    <td width="7%">&nbsp;</td>
		    <td width="7%">&nbsp;</td>
		</tr>
		  <?php } ?>
		<tr>
			<td colspan="12" align="center" style="font-weight: bold; border-top: 3px double #000000; ">J u m l a h</td>
			<td  width="3%"style="font-weight: bold; border-top: 3px double #000000; " align="center">&nbsp;</td>
			<td style="font-weight: bold; border-top: 3px double #000000; " align="right" width="6%"><?php echo fConvertToRupiah($qAWL)?></td>
			<td width="3%" style="font-weight: bold; border-top: 3px double #000000; " align="right">&nbsp;</td>
		    <td width="6%" style="font-weight: bold; border-top: 3px double #000000; " align="right"><?php if ($qKRG!=0) {echo fConvertToRupiah($qKRG);}?></td>
		    <td width="4%" style="font-weight: bold; border-top: 3px double #000000; " align="right">&nbsp;</td>
		    <td width="7%" style="font-weight: bold; border-top: 3px double #000000; " align="right"><?php if ($qTBH!=0) {echo fConvertToRupiah($qTBH);}?></td>
		    <td width="4%" style="font-weight: bold; border-top: 3px double #000000; " align="right">&nbsp;</td>
		    <td width="7%" style="font-weight: bold; border-top: 3px double #000000; " align="right"><?php echo fConvertToRupiah($qAKH)?></td>
		    <td width="7%" align="center" style="font-weight: bold; border-top: 3px double #000000; ">&nbsp;</td>
		</tr>
		</table>		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
	  <td><?php require "Lap_Bottom.php"?></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
