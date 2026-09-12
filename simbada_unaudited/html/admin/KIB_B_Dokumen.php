<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<?
ini_set('max_execution_time', 50000);
//$CriT = "BPK";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?
extract($_GET);
$gRf = "ALT";
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
		$gNmKEL = strtoupper(fGlobal("nm_aset","ref_rek_aset108_4","kd_aset",$gBid,"=","",""));
		if ($gKel=="All"){
			$gNmJNS = "Semua";
			$gNmOBJ = "Semua";
			$gNmRIN = "Semua";
		}
		else{
			$gNmJNS = strtoupper(fGlobal("nm_aset","ref_rek_aset108_5","kd_aset",$gKel,"=","",""));
			if ($gOBJ=="All"){
				$gNmOBJ = "Semua";
				$gNmRIN = "Semua";
			}
			else{
				$gNmOBJ = strtoupper(fGlobal("nm_aset","ref_rek_aset108_6","kd_aset",$gOBJ,"=","",""));
				if ($gRin=="All"){
					$gNmRIN = "Semua";
				}
				else{
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
	
	$gThn  = $_GET['gThn'];
	require "KIB_Dokumen_Unit.php";
	
	$gMLK  = $_GET['gMLK'];
	if ($gThn=="") {$gThn="____";}
	if ($gThn=="All") {$gThn="____";}
	if ($gMLK=="") {$gMLK="__";}
	if ($gMLK=="All") {$gMLK="__";}
	
	$gHr =$_GET['gHr'];
	$gBl =$_GET['gBl'];
	$gTh =$_GET['gTh'];
	
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
	<table border="0" width="1600" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
			<td style="font-size: 13pt; font-weight: bold" align="center">KARTU 
			INVENTARIS BARANG (KIB B)</td>
		</tr>
		<tr>
			<td style="font-size: 13pt; font-weight: bold" align="center">
			PERALATAN DAN MESIN <? if ($gExt=="Y") {echo "(EXTRA KOMTABLE)";}?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
              <tr>
                <td width="96">UNIT KERJA</td>
                <td width="18">:</td>
                <td width="486"><?=$gNmUNT ?></td>
                <td width="109"><? if ($CriT=="BPK") {echo "KELOMPOK";}?></td>
                <td width="20"><? if ($CriT=="BPK") {echo ":";}?></td>
                <td width="448"><? if ($CriT=="BPK") {echo $gNmKEL;}?></td>
              </tr>
              <? if ($gUnt!="All") { ?>
              <tr>
                <td width="96">SUB UNIT</td>
                <td width="18">:</td>
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
			  <? } ?>
              <tr>
                <td width="96">TAHUN</td>
                <td width="18">:</td>
                <td><?=$gThnA?> s.d <?=$gThn?></td>
                <td><? if ($CriT=="BPK") {echo "RINCIAN OBJEK";}?></td>
                <td><? if ($CriT=="BPK") {echo ":";}?></td>
                <td><? if ($CriT=="BPK") {echo $gNmRIN;}?></td>
              </tr>
            </table></td>
		</tr>
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" style="border:0 solid #000000; font-size: 8pt; font-family: Calibri; border-collapse: collapse" bordercolor="#000000">
			<tr>
				<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">No</td>
				<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Kode Barang</td>
				<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Jenis Barang / <br>Nama Barang</td>
				<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Nomor Register</td>
				<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Merk / Type</td>
				<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Ukuran / CC</td>
				<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Bahan</td>
				<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Tahun</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center" colspan="5">Nomor</td>
				<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Asal-Usul</td>
				<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Pemegang</td>
				<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Harga (Rp)</td>
				<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Keterangan</td>
			</tr>
			<tr>
            	<td style="border:1px solid #000000; font-weight: bold" align="center">Pabrik</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center">Rangka</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center">Mesin</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center">Polisi</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center">BPKB</td>
			</tr>
			<tr>
				<td style="border:1px solid #000000; font-weight: bold" align="center" width="27">1</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center" width="91">2</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center">3</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center" width="75">4</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center" width="107">5</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center" width="75">6</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center" width="59">7</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center" width="59">8</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center" width="107">9</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center" width="107">10</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center" width="74">11</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center" width="62">12</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center" width="69">13</td>
				<td width="91" align="center" style="border:1px solid #000000; font-weight: bold">14</td>
				<td width="92" align="center" style="border:1px solid #000000; font-weight: bold">15</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center" width="89">16</td>
				<td style="border:1px solid #000000; font-weight: bold" align="center" width="107">17</td>
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
					
					if ($gBid=="All")
					{
						$rBid="_._._.__";
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
								$rKel=substr($gKel,-2,2);
								$rOBJ="__";
								$rRin="___";
							}
							else
							{
								if ($gRin=="All")
								{
									$rBid=$gBid;
									$rKel=substr($gKel,-2,2);
									$rOBJ=substr($gOBJ,-2,2);
									$rRin="___";
								}
								else
								{
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
						$fFindSy = "AND (P1.No_Pengadaan LIKE '%".$gFin."%' OR P1.Nm_Aset LIKE '%".$gFin."%' OR P1.Harga LIKE '%".$gFin."%' OR P1.Referensi LIKE '%".$gFin."%' OR P1.Nomor_Polisi LIKE '%".$gFin."%' OR P1.Nomor_Rangka LIKE '%".$gFin."%' OR P1.Nomor_BPKB LIKE '%".$gFin."%' OR P1.Nomor_Mesin LIKE '%".$gFin."%' OR P1.Kd_Aset_108 LIKE '%".$gFin."%' OR P1.Keterangan LIKE '%".$gFin."%' OR P1.Merk LIKE '%".$gFin."%')";
					}
					else
					{
						$fFindSy = "";
					}
					
					if ($gThnA)
					{
						$nSQL= "SELECT 
						P1.Referensi as Referensi,
						P1.Kd_Aset_108 as Kd_Aset_108, 
						concat(P3.Nm_Aset,' (<i>',P1.Nm_Aset,'</i>)') as Nm_Aset, 
						P1.No_Register as No_Register, 
						P1.Merk as Merk, 
						P1.Ukuran_CC as Ukuran_CC, 
						P1.Bahan as Bahan, 
						P1.Tgl_Perolehan as Tgl_Perolehan, 
						P1.Nomor_Pabrik as Nomor_Pabrik,
						P1.Nomor_Rangka as Nomor_Rangka,
						P1.Nomor_Mesin as Nomor_Mesin,
						P1.Nomor_Polisi as Nomor_Polisi,
						P1.Nomor_BPKB as Nomor_BPKB,
						P1.Asal_Usul as Asal_Usul,
						P1.Pemegang as Pemegang,
						sum(P2.Debet) as Debet,
						P1.Keterangan 
						FROM ta_kib_108 P1 
						LEFT JOIN ta_kib_post_108 P2 ON P2.Referensi=P1.Referensi AND P2.Kd_UPB=P1.Kd_UPB AND P2.Ref_Group=P1.Ref_Group 
						LEFT JOIN ref_rek_aset108_7 P3 ON P3.Kd_Aset=P1.Kd_Aset_108 
						WHERE P1.referensi LIKE '$gRf%' AND P1.extracom LIKE '".$gExt."' AND P1.Kd_UPB LIKE '".$gUpb."' AND P1.Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND P1.Tgl_Perolehan >= '".$gThnA."-01-01' AND P1.Tgl_Perolehan <= '".$gThn."-12-31' ".$fFindSy." 
						GROUP BY P1.Referensi, P1.Kd_UPB, P1.Ref_Group 
						ORDER BY P1.Kd_UPB, P1.Tgl_Perolehan, P1.Kd_Aset_108, P1.No_Register";
						
						#return false;
						
						#$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan >= '".$gThnA."-01-01' AND Tgl_Perolehan <= '".$gThn."-12-31' ".$fFindSy." ORDER BY Kd_UPB, Tgl_Perolehan, Kd_Aset_108, No_Register";
						#echo $nSQL;
						
					}
					else
					{
						$nSQL= "SELECT 
						Referensi,
						Kd_Aset_108, 
						Nm_Aset, 
						No_Register, 
						Merk, 
						Ukuran_CC, 
						Bahan, 
						Tgl_Perolehan, 
						Nomor_Pabrik,
						Nomor_Rangka,
						Nomor_Mesin,
						Nomor_Polisi,
						Nomor_BPKB,
						Asal_Usul,
						Pemegang,
						Keterangan 
						FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." ORDER BY Kd_UPB, Tgl_Perolehan, Kd_Aset_108, No_Register";
					}
				}
				else
				{
					if ($rIDT!="") 
					{
						$nSQL= "SELECT 
						Referensi,
						Kd_Aset_108, 
						Nm_Aset, 
						No_Register, 
						Merk, 
						Ukuran_CC, 
						Bahan, 
						Tgl_Perolehan, 
						Nomor_Pabrik,
						Nomor_Rangka,
						Nomor_Mesin,
						Nomor_Polisi,
						Nomor_BPKB,
						Asal_Usul,
						Pemegang,
						Keterangan 
						FROM ta_kib_108 WHERE IDT='".$rIDT."' ORDER BY Kd_UPB, Tgl_Perolehan, Kd_Aset_108, No_Register";
					}
					else 
					{
						if ($gThnA){
							$nSQL= "SELECT 
							Referensi,
							Kd_Aset_108, 
							Nm_Aset, 
							No_Register, 
							Merk, 
							Ukuran_CC, 
							Bahan, 
							Tgl_Perolehan, 
							Nomor_Pabrik,
							Nomor_Rangka,
							Nomor_Mesin,
							Nomor_Polisi,
							Nomor_BPKB,
							Asal_Usul,
							Pemegang,
							Keterangan 
							FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Tgl_Perolehan >= '".$gThnA."-01-01' AND Tgl_Perolehan <= '".$gThn."-12-31' AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' ORDER BY Kd_UPB, Tgl_Perolehan, Kd_Aset_108, No_Register";
						}
						else
						{
							$nSQL= "SELECT 
							Referensi,
							Kd_Aset_108, 
							Nm_Aset, 
							No_Register, 
							Merk, 
							Ukuran_CC, 
							Bahan, 
							Tgl_Perolehan, 
							Nomor_Pabrik,
							Nomor_Rangka,
							Nomor_Mesin,
							Nomor_Polisi,
							Nomor_BPKB,
							Asal_Usul,
							Pemegang,
							Keterangan 
							FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Tgl_Perolehan LIKE '".$gThn."-__-__' AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' ORDER BY Kd_UPB, Tgl_Perolehan, Kd_Aset_108, No_Register";
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
						ClrVr();
						$Col[0] = $iG;
						$Col[1] = $mRo['Kd_Aset_108'];
						$Col[2] = $mRo['Nm_Aset'];
						$Col[3] = $mRo['No_Register'];
						$nMerk = $mRo['Merk'];
						if (substr($nMerk,0,7)=="Merk : ") {$rMrk="";} else {$rMrk="Merk : ";}
						
						if ($nMerk!="") {$nMerk=$rMrk.$nMerk;} else {$nMerk="";}
						$Col[4]= $nMerk;
						$nType = $mRo['Type'];
						if ($nType!="") {$nType="Type : ".$nType;} else {$nType="";}
						if ($Col[4]!="") {$Col[4]=$Col[4]."<br> ".$nType;}
						
						$Col[5] = $mRo['Ukuran_CC'];
						$Col[6] = $mRo['Bahan'];
						$Col[7] = fConvertDateShort($mRo['Tgl_Perolehan']);
						$Col[8] = $mRo['Nomor_Pabrik'];
						$Col[9] = $mRo['Nomor_Rangka'];
						$Col[10] = $mRo['Nomor_Mesin'];
						$Col[11] = $mRo['Nomor_Polisi'];
						$Col[12] = $mRo['Nomor_BPKB'];
						$Col[13] = $mRo['Asal_Usul'];
						$Col[16] = $mRo['Pemegang'];
						
						$gREF = $mRo['Referensi'];
						
						if ($CriT=='BPK' && $gThnA!='')
						{
							$gAKH = $mRo['Debet'];
						}
						else
						{
							$gAKH = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB:Tanggal",$gREF.":".substr($mRo['Kd_UPB'],0,11)."%:".$gThn."-12-31","=:LIKE:<=","","");
						}
						
						$Col[14] = $gAKH;
						$Col[15] = $mRo['Keterangan'];
						$gHrg = $gHrg + $gAKH;
						#$Col[0] = $mRo['Referensi'];
						ViewRincian($Col[0],$Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16]);
						$iG++;
					}
					while ($mRo = mysql_fetch_assoc($nRs));	
				}
				else
				{
				echo ViewBlank();
				}
				?>
				<? function ViewRincian($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16) {?>
				<tr>
            		<td style="border: 1px solid #000000; text-align:center"><?=$x0?>.</td>
					<td style="border: 1px solid #000000; text-align:center"><?=$x1?></td>
					<td style="border: 1px solid #000000"><?=$x2?></td>
					<td style="border: 1px solid #000000; text-align:center"><?=$x3?></td>
					<td style="border: 1px solid #000000"><?=$x4?></td>
					<td style="border: 1px solid #000000"><?=$x5?></td>
					<td style="border: 1px solid #000000"><?=$x6?></td>
					<td style="border: 1px solid #000000" align="center"><?=$x7?></td>
					<td style="border: 1px solid #000000; text-align:center"><?=$x8?></td>
					<td style="border: 1px solid #000000; text-align:center"><?=$x9?></td>
					<td style="border: 1px solid #000000; text-align:center"><?=$x10?></td>
					<td style="border: 1px solid #000000; text-align:center"><?=$x11?></td>
					<td style="border: 1px solid #000000; text-align:center"><?=$x12?></td>
					<td style="border: 1px solid #000000; text-align:center"><?=$x13?></td>
					<td style="border: 1px solid #000000; text-align:center"><?=$x16?></td>
					<td style="border: 1px solid #000000" align="right"><?=fConvertToRupiah($x14)?></td>
					<td style="border: 1px solid #000000"><?=$x15?></td>
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
			<td style="border: 1px solid #000000">&nbsp;</td>
		</tr>
		<? } ?>
		<tr>
					
            <td colspan="15" style="border:1px solid #000000; font-weight: bold" align="center">JUMLAH</td>
			<td style="border:1px solid #000000; font-weight: bold" align="right"><?=fConvertToRupiah($gHrg)?></td>
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
		<? if ($gUnt!="All") { ?>
		<tr>
			<td>
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

<?php require('Connection_Close.php');?>
