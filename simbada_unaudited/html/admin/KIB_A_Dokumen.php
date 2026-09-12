<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<?
ini_set('max_execution_time', 300);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?
extract($_GET);
$gRf = "TNH";
if ($CriT=="BPK")
{
	$gNmUNT = strtoupper(fGlobal("nm_unit","ref_unit","kd_unit",$gUnt,"=","",""));
	if ($gSub=="All"){
		$gNmSUB = "SEMUA";	
	}
	else{
		$gNmSUB = strtoupper(fGlobal("nm_sub","ref_sub_unit","kd_sub",$gSub,"=","",""));
	}
	if ($gUpb=="All"){
		$gNmUPB = "SEMUA";	
	}
	else{
		$gNmUPB = strtoupper(fGlobal("nm_upb","ref_upb","kd_upb",$gUpb,"=","",""));
	}
	if ($gBid=="All"){
		$gNmKEL = "Semua";
		$gNmJNS = "Semua";
		$gNmOBJ = "Semua";
		$gNmRIN = "Semua";
	}
	else {
		#$gNmKEL = strtoupper(fGlobal("nm_aset","ref_rek_aset2","kd_aset",$gBid,"=","",""));
		$gNmKEL = strtoupper(fGlobal("nm_aset","ref_rek_aset108_4","kd_aset",$gBid,"=","",""));
		if ($gKel=="All"){
			$gNmJNS = "Semua";
			$gNmOBJ = "Semua";
			$gNmRIN = "Semua";
		}
		else{
			#$gNmJNS = strtoupper(fGlobal("nm_aset","ref_rek_aset3","kd_aset",$gKel,"=","",""));
			$gNmJNS = strtoupper(fGlobal("nm_aset","ref_rek_aset108_5","kd_aset",$gKel,"=","",""));
			
			if ($gOBJ=="All"){
				$gNmOBJ = "Semua";
				$gNmRIN = "Semua";
			}
			else{
				#$gNmOBJ = strtoupper(fGlobal("nm_aset","ref_rek_aset4","kd_aset",$gOBJ,"=","",""));
				$gNmOBJ = strtoupper(fGlobal("nm_aset","ref_rek_aset108_6","kd_aset",$gOBJ,"=","",""));
				
				if ($gRin=="All"){
					$gNmRIN = "Semua";
				}
				else{
					#$gNmRIN = strtoupper(fGlobal("nm_aset","ref_rek_aset5","kd_aset",$gRin,"=","",""));
					$gNmRIN = strtoupper(fGlobal("nm_aset","ref_rek_aset108_7","kd_aset",$gRin,"=","",""));
				}
			}
		}
		
	}
}
else
{
	if (isset($_GET['rIDT'])){$rIDT=$_GET['rIDT'];}
	if (isset($_GET['gExt'])){$gExt=$_GET['gExt'];}
	if ($gExt=="All") {$gExt="%";}
	if ($rIDT)
	{
		$rDT = fGlobal("kd_upb","ta_kib_108","IDT",$rIDT,"=","","");
		$gExt = fGlobal("extracom","ta_kib_108","IDT",$rIDT,"=","","");
		$gUnt = substr($rDT,0,11);
		$gSub = substr($rDT,0,14);
		$gUpb = $rDT;
	}
	else
	{
		$gUnt = $_GET['gUnt'];
		$gSub = $_GET['gSub'];
		$gUpb = $_GET['gUpb'];
	}
	
	$gThn = $_GET['gThn'];
	require "KIB_Dokumen_Unit.php";
	
	$gMLK  = $_GET['gMLK'];
	if ($gThn=="") {$gThn="____";}
	if ($gThn=="All") {$gThn="____";}
	if ($gMLK=="") {$gMLK="__";}
	if ($gMLK=="All") {$gMLK="__";}
	
	//KODE LOKASI
	if ($gMLK!="__")
	{
		$KdKomp = $gMLK;				//Kode Komponen Kepemilikan
		$KdProp = "24";					//Kode Provinsi
		$KdKabK = "00";					//Kode Kab./Kota.
		$KdBida = substr($gSub,6,2);	//Kode Bidang
		$KdUnit = substr($gSub,9,2);	//Kode Unit Bidang
		$KdTahu = substr($gThn,-2);		//Tahun Pembelian
		$KdSubU = substr($gSub,-2);		//Kode Sub Unit
		$gLok = $KdKomp.".".$KdProp.".".$KdKabK.".".$KdBida.".".$KdUnit.".".$KdTahu.".".$KdSubU;
	}
	else
	{$gLok = "-";}
}
?>
<body>

<div align="center">
	<table border="0" width="1800" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
	<tr>
      <td style="font-size: 13pt; font-weight: bold" align="center">KARTU INVENTARIS 
        BARANG (KIB A)</td>
		</tr>
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center">TANAH <? if ($gExt=="Y") {echo "(EXTRA KOMTABLE)";}?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
          <tr> 
            <td width="104">UNIT KERJA</td>
            <td width="19">:</td>
            <td width="492"><?=$gNmUNT ?></td>
            <td width="82"><? if ($CriT=="BPK") {echo "KELOMPOK";}?></td>
            <td width="23"><? if ($CriT=="BPK") {echo ":";}?></td>
            <td width="557"><? if ($CriT=="BPK") {echo $gNmKEL;}?></td>
          </tr>
		  <? if ($gUnt!="All") { ?>
          <tr> 
            <td width="104">SUB UNIT</td>
            <td width="19">:</td>
            <td><?=$gNmSUB ?></td>
            <td><? if ($CriT=="BPK") {echo "JENIS";}?></td>
            <td><? if ($CriT=="BPK") {echo ":";}?></td>
            <td><? if ($CriT=="BPK") {echo $gNmJNS;}?></td>
          </tr>
          <tr>
            <td>UPB</td>
            <td>:</td>
            <td><? echo $gNmUPB?></td>
            <td><? if ($CriT=="BPK") {echo "OBJEK";}?></td>
            <td><? if ($CriT=="BPK") {echo ":";}?></td>
            <td><? if ($CriT=="BPK") {echo $gNmOBJ;}?></td>
          </tr>
          <tr> 
            <td width="104"><? if ($CriT!="BPK") {echo "KODE LOKASI";} else {echo "TAHUN";}?></td>
            <td width="19"><?=":"?></td>
            <td><? if ($CriT!="BPK") {echo "$gLok";} else {echo $gThn;}?></td>
            <td><? if ($CriT=="BPK") {echo "RINCIAN OBJEK";}?></td>
            <td><? if ($CriT=="BPK") {echo ":";}?></td>
            <td><? if ($CriT=="BPK") {echo $gNmRIN;}?></td>
          </tr>
		  <? } else {?>
          <tr> 
            <td width="104">TAHUN</td>
            <td width="19">:</td>
            <td colspan="4"><? echo $gThn?></td>
          </tr>
		  <? } ?>
        </table>			
			<!---table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
          <tr> 
            <td width="91">UNIT KERJA</td>
            <td width="22">:</td>
            <td width="923"><? echo $gNmUNT?></td>
          </tr>
		  <? if ($gUnt!="All") { ?>
          <tr> 
            <td width="91">SUB UNIT</td>
            <td width="22">:</td>
            <td><? echo $gNmSUB?></td>
          </tr>
          <tr>
            <td>UPB</td>
            <td>:</td>
            <td><? echo $gNmUPB?></td>
          </tr>
		  <? if ($rIDT==""){?>
          <tr> 
            <td width="91">KODE LOKASI</td>
            <td width="22">:</td>
            <td><? echo $gLok?></td>
          </tr>
		  <? } ?>
		  <? } else {?>
		  <? if ($rIDT==""){?>
          <tr> 
            <td width="109">TAHUN</td>
            <td width="31">:</td>
            <td><? echo $gThn?></td>
          </tr>
		  <? } ?>
		  <? } ?>
        </table-->
			</td>
		</tr>
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" style="border:0 solid #000000; font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table2" bordercolor="#000000">
          <tr> 
            <td rowspan="3" style="border:1px solid #000000; font-weight: bold" align="center">NO</td>
            <td rowspan="3" align="center" style="border:1px solid #000000; font-weight: bold">JENIS BARANG / NAMA BARANG</td>
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold">NOMOR</td>
            <td rowspan="3" style="border:1px solid #000000; font-weight: bold" align="center">LUAS (M<sup>2</sup>) </td>
            <td rowspan="3" style="border:1px solid #000000; font-weight: bold" align="center">TGL. PEROLEHAN</td>
            <td rowspan="3" style="border:1px solid #000000; font-weight: bold" align="center">LETAK / ALAMAT</td>
            <td rowspan="3" style="border:1px solid #000000; font-weight: bold" align="center">KOORDINAT</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" colspan="3">STATUS TANAH </td>
            <td rowspan="3" style="border:1px solid #000000; font-weight: bold" align="center">PENGGU NAAN</td>
            <td rowspan="3" align="center" style="border:1px solid #000000; font-weight: bold">SASAL-USUL</td>
            <td colspan="2" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">N I L A I </td>
            <td rowspan="3" style="border:1px solid #000000; font-weight: bold" align="center" width="159">KETERANGAN</td>
          </tr>
          <tr> 
            <td rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">KODE BARANG </td>
            <td rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">REGISTER</td>
            <td rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">HAK</td>
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold">SERTIFIKAT</td>
          </tr>
          <tr> 
            <td style="border:1px solid #000000; font-weight: bold" align="center">TANGGAL</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">NOMOR</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">PEROLEHAN</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">AKHIR</td>
          </tr>
          <tr> 
            <td width="30" style="border:1px solid #000000; font-weight: bold" align="center">1</td>
            <td width="158" style="border:1px solid #000000; font-weight: bold" align="center">2</td>
            <td width="108" style="border:1px solid #000000; font-weight: bold" align="center">3</td>
            <td width="48" style="border:1px solid #000000; font-weight: bold" align="center">4</td>
            <td width="60" style="border:1px solid #000000; font-weight: bold" align="center">5</td>
            <td width="77" style="border:1px solid #000000; font-weight: bold" align="center">6</td>
            <td width="200" align="center" style="border:1px solid #000000; font-weight: bold">7</td>
            <td width="150" align="center" style="border:1px solid #000000; font-weight: bold">8</td>
            <td width="86" style="border:1px solid #000000; font-weight: bold" align="center">9</td>
            <td width="78" style="border:1px solid #000000; font-weight: bold" align="center">10</td>
            <td width="118" style="border:1px solid #000000; font-weight: bold" align="center">11</td>
            <td width="136" align="center" style="border:1px solid #000000; font-weight: bold">12</td>
            <td width="101" align="center" style="border:1px solid #000000; font-weight: bold">13</td>
            <td width="117" align="center" style="border:1px solid #000000; font-weight: bold">14</td>
            <td width="103" align="center" style="border:1px solid #000000; font-weight: bold">15</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">16</td>
          </tr>
          <?
				$Col[15];
				$iG = 1;
				$gHrg = 0;
				function ClrVr()
				{
					for($nG=0; $nG<=15; $nG++)
					{
						$Col[$nG]="";
					}
				}
				if ($CriT=="BPK")
				{
					if ($gUpb=="All") {$gUpb = $gSub.".%";}
					if ($gSub=="All") {$gUpb = $gUnt.".%.%";}
					if ($gExt=="All") {$gExt = "%";} else {$gExt=$gExt;}
					
					if ($gThn=="All")
						{$rThn="____";}
					else
						{$rThn=$gThn;}
							
					/*
					if ($gBid=="All")
					{
						$rBid="__.__";
						$rKel="__";
						$rOBJ="__";
						$rRin="___";
					}
					else
					{
						if ($gKel=="All")
						{
							$rBid=$gBid;
							$rKel="__";
							$rOBJ="__";
							$rRin="___";
						}
						else
						{
							if ($gOBJ=="All")
							{
								$rBid=$gBid;
								$rKel=substr($gKel,6,2);
								$rOBJ="__";
								$rRin="___";
							}
							else
							{
								if ($gRin=="All")
								{
									$rBid=$gBid;
									$rKel=substr($gKel,6,2);
									$rOBJ=substr($gOBJ,9,2);
									$rRin="___";
								}
								else
								{
									$rBid=$gBid;
									$rKel=substr($gKel,6,2);
									$rOBJ=substr($gOBJ,9,2);
									$rRin=substr($gRin,12,3);
								}
							}
						}
					}
					*/
					
					if ($gBid=="All")
					{
						#$rBid="__.__";
						#$rKel="__";
						#$rOBJ="__";
						#$rRin="___";
						
						$rBid="_._._.__";
						$rKel="__";
						$rOBJ="__";
						$rRin="___";
					}
					else
					{
						if ($gKel=="All")
						{
							#$rBid=$zBid;
							#$rKel="__";
							#$rOBJ="__";
							#$rRin="___";
						
							$rBid=$gBid;
							$rKel="__";
							$rOBJ="__";
							$rRin="___";
						}
						else
						{
							if ($gOBJ=="All")
							{
								#$rBid=$zBid;
								#$rKel=substr($zKel,6,2);
								#$rOBJ="__";
								#$rRin="___";
								
								$rBid=$gBid;
								$rKel=substr($gKel,-2,2);
								$rOBJ="__";
								$rRin="___";
							}
							else
							{
								if ($gRin=="All")
								{
									#$rBid=$zBid;
									#$rKel=substr($zKel,6,2);
									#$rOBJ=substr($zOBJ,9,2);
									#$rRin="___";
									
									$rBid=$gBid;
									$rKel=substr($gKel,-2,2);
									$rOBJ=substr($gOBJ,-2,2);
									$rRin="___";
								}
								else
								{
									#$rBid=$gBid;
									#$rKel=substr($gKel,6,2);
									#$rOBJ=substr($gOBJ,9,2);
									#$rRin=substr($gRin,12,3);
									
									$rBid=$gBid;
									$rKel=substr($gKel,-2,2);
									$rOBJ=substr($gOBJ,-2,2);
									$rRin=substr($gRin,-3,3);
								}
							}
						}
					}
					
					if ($gFin!="")
					{
						$fFindSy = "AND (Nm_Aset LIKE '%".$gFin."%' OR Harga = '".$gFin."' OR Referensi LIKE '%".$gFin."%' OR Kd_Aset_108 LIKE '%".$gFin."%' OR Keterangan LIKE '%".$gFin."%')";
					}
					else
					{
						$fFindSy = "";
					}
					if ($gThnA){
						$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND (Tgl_Perolehan BETWEEN '".$gThnA."-01-01' AND '".$gThn."-12-31') ".$fFindSy." ORDER BY Tgl_Perolehan, Kd_Aset, No_Register";
					}
					else{
						$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
					}
				}
				else
				{
					if ($rIDT!=""){
						$nSQL= "SELECT * FROM ta_kib_108 WHERE IDT='".$rIDT."' ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
					}
					else{
						if ($gThnA){
							$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gThnA."-01-01' AND '".$gThn."-12-31') AND Status='' ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
						}
						else{
							$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Tgl_Perolehan LIKE '".$gThn."-__-__' AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
						}
					}
				}
				#echo $nSQL;
				$nRs = mysql_query($nSQL) or die(mysql_error());
				$mRo = mysql_fetch_assoc($nRs);
				$tRo = mysql_num_rows($nRs);
				if ($tRo > 0)
				{
					do
					{
						echo ClrVr();
						$Col[0] = $iG;
						$Col[1] = $mRo['Kd_Aset_108'];
						$Col[2] = $mRo['Nm_Aset'];
						$Col[3] = $mRo['No_Register'];
						if ($nType!="") {$nType="Type : ".$nType;} else {$nType="";}
						if ($Col[4]!="") {$Col[4]=$Col[4]."<br> ".$nType;}
						$Col[5] = $mRo['Luas_M2'];
						$Col[6] = fConvertDateShort($mRo['Tgl_Perolehan']);
						$Col[7] = $mRo['Alamat'];
						$Col[8] = $mRo['Hak_Tanah'];
						$Col[9] = $mRo['Sertifikat_Tanggal'];
						$Col[10] = $mRo['Sertifikat_Nomor'];
						$Col[11] = $mRo['Penggunaan'];
						$Col[12] = $mRo['Asal_Usul'];
						if ($Col[9]!= "0000-00-00") {$Col[9] = fConvertDateShort($Col[9]);} else {$Col[9]="";}
						 
						$gREF = $mRo['Referensi'];
						$Col[13] = $mRo['Harga'];
						$gNIa = fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","referensi:kd_upb",$gREF.":".substr($mRo['Kd_UPB'],0,11)."%","=:LIKE","","");
						$gNIb = 0;
						if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;}
						else {$gAKH=$gNIa;}
						$Col[14] = $mRo['Keterangan'];
						$Col[15] = $gAKH;
						$Col[16] = $mRo['Pemegang'];
						$Col[17] = $mRo['lat_lng'];
						$gHrg = $gHrg + $gAKH;
						
						$Col[13] = fConvertToRupiah($Col[13]);
						$CeM = fGlobal("count(*)","ta_kib_post_108","referensi:HasilMerger:kd_upb:tanggal",$mRo['Referensi'].":Y:".substr($mRo['Kd_UPB'],0,11)."%:".$gThn."-12-31","=:=:LIKE:<=","","");
						$xB="";
						$LT="1";
						$LB="1";
						$LG="solid";
						if ($CeM>0){
							$xB="<b>";
							$LT="1";
							$LB="1";
							$LG="dotted";
						}
						
						ViewRincian($Col[0],$Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],"",$LT,$LB,$LG,$xB);
						if ($CeM>0){
							LoadMerger($mRo['Referensi']);
						}
						$iG++;
					}
					while ($mRo = mysql_fetch_assoc($nRs));	
				}
				else
				{
					echo ViewBlank();
				}
				
				function LoadMerger($Ref)
				{
					$SW="SELECT P2.*, P1.Debet as Debet, P1.Tanggal 
					FROM ta_kib_post_108 P1 
					LEFT JOIN ta_kib_108_merger_his P2 ON P2.Referensi=P1.Mrg_Ref_History 
					WHERE P1.Referensi='$Ref' AND P1.HasilMerger='Y' ORDER BY P2.Tgl_Perolehan, P2.Kd_Aset_108, P2.No_Register";
					$Rw = mysql_query($SW);
					while ($mR = mysql_fetch_array($Rw, MYSQL_BOTH))
					{
						echo ClrVr();
						$Col[0] = "";
						$Col[1] = $mR['Kd_Aset_108'];
						$Col[2] = $mR['Nm_Aset'];
						$Col[3] = "-";
						if ($nType!="") {$nType="Type : ".$nType;} else {$nType="";}
						if ($Col[4]!="") {$Col[4]=$Col[4]."<br> ".$nType;}
						$Col[5] = "";//$mR['Luas_M2'];
						$Col[6] = fConvertDateShort($mR['Tanggal']);
						$Col[7] = $mR['Alamat'];
						$Col[8] = $mR['Hak_Tanah'];
						$Col[9] = $mR['Sertifikat_Tanggal'];
						$Col[10] = $mR['Sertifikat_Nomor'];
						$Col[11] = $mR['Penggunaan'];
						$Col[12] = $mR['Asal_Usul'];
						if ($Col[9]!="0000-00-00") {$Col[9]=fConvertDateShort($Col[9]);} else {$Col[9]="";}
						
						#$Col[13] = fConvertToRupiah($mR['Harga']);
						$Col[13] = fConvertToRupiah($mR['Debet']);
						$Col[14] = "";
						$Col[15] = "";
						$Col[16] = $mR['Pemegang'];
						$Col[17] = "";
						ViewRincian($Col[0],$Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],"<i>","0","0","solid","");
					}
				}
				
				?>
          <? function ViewRincian($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$LI,$LT,$LB,$LG,$xB) {?>
          <tr> 
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><? echo $xB.$x0?><? if ($x0!=""){echo ".";}?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.$x2?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><?=$LI.$xB.$x1?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><?=$LI.$xB.$x3?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><? if ($x5!="0") {echo $LI.$xB.fConvertToRupiahBulat($x5);}?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><?=$LI.$xB.$x6?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.$x7?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000; text-align:center"><?=$LI.$xB.$x17?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000; text-align:center"><?=$LI.$xB.$x8?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000; text-align:center" ><?=$LI.$xB.$x9?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.$x10?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.$x11?></td>
            <td align="center"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.$x12?></td>
            <td align="right" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.$x13?></td>
            <td align="right" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><? if ($x15!="") {echo $xB.fConvertToRupiah($x15);}?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><? echo $x14?></td>
          </tr>
          <? } ?>
          <? function ViewBlank() {?>
          <tr> 
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
          </tr>
          <? } ?>
          <tr> 
            <td colspan="13" style="border:1px solid #000000; font-weight: bold" align="center"> 
              JUMLAH</td>
            <td align="right" style="border:1px solid #000000; font-weight: bold"><? echo fConvertToRupiah($gHrg)?></td>
            <td align="right" style="border:1px solid #000000; font-weight: bold"><? echo fConvertToRupiah($gHrg)?></td>
            <td style="border: 1px solid #000000">&nbsp;</td>
          </tr>
        </table>
			</td>
		</tr>
		<tr>
			<td style="font-family: Calibri Narrow; font-style: italic">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<? if ($gUnt!="All") { ?>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table6">
				<? require "Dokumen_Footer.php";?>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">Mengetahui,</td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230"><? echo $NmIbKt.", ".$rHri." ".fNmBulan($rBln)." ".$rThn?></td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
					<td width="230" align="center" style="font-weight: bold"><? echo $FotA[1]?></td>
					<td align="center">&nbsp;</td>
					<td align="center" style="font-weight: bold" width="230"><? echo $FotC[1]?></td>
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
					<td width="230" align="center" style="font-weight: bold"><u><? echo $FotA[2]?></u></td>
					<td align="center">&nbsp;</td>
					<td align="center" style="font-weight: bold" width="230"><u><? echo $FotC[2]?></u></td>
					<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">NIP. <? echo $FotA[3]?></td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230">NIP. <? echo $FotC[3]?></td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
			</table>
			</td>
		</tr>
		<? } ?>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>

</body>

</html>

