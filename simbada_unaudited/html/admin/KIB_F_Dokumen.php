<?php require "CheckSession.php";?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php";?>
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
$gRf = "KDP";
extract($_GET);
#echo $fSD;
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
	if ($rIDT)
	{
		$rDT = fGlobal("kd_upb","ta_kib_f","IDT",$rIDT,"=","","");
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
	<table border="0" width="1320" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center">KARTU INVENTARIS 
        BARANG (KIB F)</td>
		</tr>
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center">KONSTRUKSI DALAM PENGERJAAN </td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
              <tr>
                <td width="96">UNIT KERJA</td>
                <td width="18">:</td>
                <td width="486"><?=$gNmUNT ?></td>
                <td width="109"><? if ($CriT=="BPK") {echo "OBJEK";}?></td>
                <td width="20"><? if ($CriT=="BPK") {echo ":";}?></td>
                <td width="448"><? if ($CriT=="BPK") {echo $gNmKEL;}?></td>
              </tr>
              <? if ($gUnt!="All") { ?>
              <tr>
                <td width="96">SUB UNIT</td>
                <td width="18">:</td>
                <td><?=$gNmSUB ?></td>
                <td><? if ($CriT=="BPK") {echo "RINCIAN OBJEK";}?></td>
                <td><? if ($CriT=="BPK") {echo ":";}?></td>
                <td><? if ($CriT=="BPK") {echo $gNmJNS;}?></td>
              </tr>
              <tr>
                <td>UPB</td>
                <td>:</td>
                <td><? echo $gNmUPB?></td>
                <td><? if ($CriT=="BPK") {echo "SUB RO";}?></td>
                <td><? if ($CriT=="BPK") {echo ":";}?></td>
                <td><? if ($CriT=="BPK") {echo $gNmOBJ;}?></td>
              </tr>
              <tr>
                <td width="96"><? if ($CriT!="BPK") {echo "KODE LOKASI";} else {echo "TAHUN";}?></td>
                <td width="18"><?=":"?></td>
                <td><? if ($CriT!="BPK") {echo "$gLok";} else {echo $gThn;}?></td>
                <td><? if ($CriT=="BPK") {echo "SUB-SUB RO";}?></td>
                <td><? if ($CriT=="BPK") {echo ":";}?></td>
                <td><? if ($CriT=="BPK") {echo $gNmRIN;}?></td>
              </tr>
              <? } else {?>
              <tr>
                <td width="96">TAHUN</td>
                <td width="18">:</td>
                <td colspan="4"><? echo $gThn?></td>
              </tr>
              <? } ?>
              <tr>
                <td width="96">KDP TO ASET</td>
                <td width="18">:</td>
                <td colspan="4"><? if ($gKDP=='All'){echo "SEMUA";} else if ($gKDP=='Y'){echo "SUDAH";} else {echo "BELUM";}?></td>
              </tr>
            </table>
			<!--table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
          <tr> 
            <td width="109">UNIT KERJA</td>
            <td width="31">:</td>
            <td width="1250"><? echo $gNmUNT ?></td>
          </tr>
		  <? if ($gUnt!="All") { ?>
          <tr> 
            <td width="109">SUB UNIT</td>
            <td width="31">:</td>
            <td><? echo $gNmSUB ?></td>
          </tr>
          <tr>
            <td>UPB</td>
            <td>:</td>
            <td><? echo $gNmUPB ?></td>
          </tr>
          <tr> 
            <td width="109">KODE LOKASI</td>
            <td width="31">:</td>
            <td><? echo $gLok?></td>
          </tr>
		  <? } else {?>
          <tr> 
            <td width="109">TAHUN</td>
            <td width="31">:</td>
            <td><? echo $gThn?></td>
          </tr>
		  <? } ?>
        </table-->
			</td>
		</tr>
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
		  <td>
		  <table border="0" width="1500" style="border:0 solid #000000; font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table2" bordercolor="#000000">
          <tr> 
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">NO</td>
            <td rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">JENIS 
              BARANG / NAMA BARANG</td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">              BANGUNAN (P,SPD)</td>
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold">KONSTRUKSI 
              BANGUNAN </td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">LUAS (M<sup>2</sup>)</td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">LETAK 
              / LOKASI ALAMAT </td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">TANGGAL PEROLEHAN</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" colspan="2">DOKUMEN </td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Tanggal, Bulan, Tahun Mulai </td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">STATUS 
              TANAH </td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">NOMOR 
              KODE TANAH</td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">ASAL-USUL PEMBIAYAAN </td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">NILAI KONTRAK  
              (Rp)</td>
            <td rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">No. Pengadaan </td>
            <td rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">KETERANGAN</td>
          </tr>
          <tr> 
            <td align="center" style="border:1px solid #000000; font-weight: bold">BERTINGKAT/ 
              TIDAK</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">BETON/ 
              TIDAK </td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">TANGGAL</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">NOMOR</td>
          </tr>
          <tr style="font-weight:bold; text-align:center"> 
            <td width="30" style="border:1px solid #000">1</td>
            <td style="border:1px solid #000">2</td>
            <td width="60" style="border:1px solid #000">3</td>
            <td width="60" style="border:1px solid #000">4</td>
            <td width="60" style="border:1px solid #000">5</td>
            <td width="60" style="border:1px solid #000">6</td>
            <td width="130" style="border:1px solid #000">7</td>
            <td width="60" style="border:1px solid #000">8</td>
            <td width="60" style="border:1px solid #000">9</td>
            <td width="60" style="border:1px solid #000">10</td>
            <td width="60" style="border:1px solid #000">11</td>
            <td width="60" style="border:1px solid #000">12</td>
            <td width="90" style="border:1px solid #000">13</td>
            <td width="80" style="border:1px solid #000">14</td>
            <td width="90" style="border:1px solid #000">15</td>
            <td width="120" style="border:1px solid #000">16</td>
            <td width="160" style="border:1px solid #000">17</td>
          </tr>
          <?
		  		if ($gKDP=='All') 
				{
					$KdpT = "%";
				}
				else
				{
		  			$KdpT = $gKDP;
				}
				if ($KdpT=="")
				{
					$KdpT="N";
				}
				$Col[16];
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
						$fFindSy = "AND (No_Pengadaan LIKE '%".$gFin."%' OR Nm_Aset LIKE '%".$gFin."%' OR Harga LIKE '%".$gFin."%' OR Referensi LIKE '%".$gFin."%' OR Kd_Aset_108 LIKE '%".$gFin."%' OR Keterangan LIKE '%".$gFin."%')";
					}
					else
					{
						$fFindSy = "";
					}
					if ($gThnA){
						$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND (Tgl_Perolehan BETWEEN '".$gThnA."-01-01' AND '".$gThn."-12-31') ".$fFindSy." AND KdpToAset LIKE '$KdpT' ORDER BY Tgl_Perolehan, Kd_Aset_108 , No_Register";
					}
					else
					{
						if ($fSD=='Ya')
						{
							$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan <= '".$rThn."-12-31' ".$fFindSy." AND KdpToAset LIKE '$KdpT' ORDER BY Tgl_Perolehan, Kd_Aset_108 , No_Register";
						}
						else
						{
							$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." AND KdpToAset LIKE '$KdpT' ORDER BY Tgl_Perolehan, Kd_Aset_108 , No_Register";
						}
					}
				}
				else
				{				#########
					if ($rIDT!="") {
						$nSQL= "SELECT * FROM ta_kib_108 WHERE IDT='".$rIDT."' AND KdpToAset LIKE '$KdpT' ORDER BY Tgl_Perolehan, Kd_Aset_108 , No_Register";
					}
					else {
						if ($gThnA)
						{
							$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gThnA."-01-01' AND '".$gThn."-12-31') AND Kd_Pemilik LIKE '".$gMLK."' AND KdpToAset LIKE '$KdpT' ORDER BY Tgl_Perolehan, Kd_Aset_108 , No_Register";
						}
						else
						{
							$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND Kd_UPB LIKE '".$gUpb."' AND Tgl_Perolehan LIKE '".$gThn."-__-__' AND Kd_Pemilik LIKE '".$gMLK."' AND KdpToAset LIKE '$KdpT' ORDER BY Tgl_Perolehan, Kd_Aset_108 , No_Register";
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
						
						$Col[1] = fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$mRo['Kd_Aset'],"=","","");
						if ($mRo['Nm_Aset']) {
							$Col[1].= " (<i> ".$mRo['Nm_Aset']." </i>)";
						}
						
						$Col[2] = $mRo['Tipe_Bangunan'];
						$Col[3] = $mRo['Bertingkat'];
						$Col[4] = $mRo['Beton'];
						$Col[5] = $mRo['Luas'];
						$Col[6] = $mRo['Lokasi'];
						$Col[7] = $mRo['Dokumen_Tanggal'];
						$Col[8] = $mRo['Dokumen_Nomor'];
						$Col[9] = $mRo['Tgl_Mulai'];
						$Col[10] = $mRo['Status_Tanah'];
						$Col[11] = $mRo['Kode_Tanah'];
						$Col[12] = $mRo['Asal_Usul'];
						
						$gREF = $mRo['Referensi'];
						$rUPB = substr($mRo['Kd_UPB'],0,11);
						$gNIa = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB",$gREF.":".$rUPB."%","=:LIKE","","");
						$gNIb = 0;
						if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;}
						else {$gAKH=$gNIa;}
						$Col[13] = $gAKH;
						
						$Col[14] = $mRo['Keterangan'];
						$Col[15] = $mRo['No_Pengadaan'];
						$Col[16] = $mRo['Tgl_Perolehan'];
						$gHrg = $gHrg + $gAKH;
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
            <td style="border: 1px solid #000000" valign="top" align="center"><? echo $x0?>.</td>
            <td style="border: 1px solid #000000" valign="top"><? echo $x1?></td>
            <td style="border: 1px solid #000000" valign="top" align="center"><? echo $x2?></td>
            <td align="center" valign="top" style="border: 1px solid #000000"><? echo $x3?></td>
            <td align="center" valign="top" style="border: 1px solid #000000"><? echo $x4?></td>
            <td style="border: 1px solid #000000" valign="top" align="center"><? if ($x5!='0' || $x5>0) {echo fConvertToRupiah($x5);}?></td>
            <td valign="top" style="border: 1px solid #000000"><?=$x6?></td>
            <td valign="top" style="border: 1px solid #000000; text-align:center"><?=fConvertDateShort($x16)?></td>
            <td style="border: 1px solid #000000; text-align:center" valign="top"><? if ($x7!="" && $x7!="0000-00-00" && $x7!="00-00-0000") {echo fConvertDateShort($x7);}?></td>
            <td style="border: 1px solid #000000" valign="top"><? echo $x8?></td>
            <td valign="top" style="border: 1px solid #000000"><? if ($x9!="" && $x9!="0000-00-00" && $x9!="00-00-0000") {echo fConvertDateShort($x9);}?></td>
            <td valign="top" style="border: 1px solid #000000"><? echo $x10?></td>
            <td valign="top" style="border: 1px solid #000000"><? echo $x11?></td>
            <td valign="top" style="border: 1px solid #000000"><? echo $x12?></td>
            <td style="border: 1px solid #000000" valign="top" align="right"><? echo fConvertToRupiah($x13)?></td>
            <td style="border: 1px solid #000000" valign="top"><? echo $x15?></td>
            <td style="border: 1px solid #000000" valign="top"><? echo $x14?></td>
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
            <td style="border:1px solid #000000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">&nbsp;</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">&nbsp;</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">&nbsp;</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000000; font-weight: bold" align="right"><? echo fConvertToRupiah($gHrg)?></td>
            <td style="border: 1px solid #000000">&nbsp;</td>
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
			<? } ?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>

</body>

</html>

<?php require('Connection_Close.php');?>
