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
$gRf = "JLN";
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
	if (isset($_GET['gExt'])){$gExt=$_GET['gExt'];}
	if ($gExt=="All") {$gExt="%";}
	if (isset($_GET['rIDT'])){$rIDT=$_GET['rIDT'];}
	if ($rIDT)
	{
		$rDT = fGlobal("kd_upb","ta_kib_108","IDT",$rIDT,"=","","");
		$rRF = fGlobal("referensi","ta_kib_108","IDT",$rIDT,"=","","");
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
	<table border="0" width="1420" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center">KARTU INVENTARIS 
        BARANG (KIB D)</td>
		</tr>
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center"> JALAN, IRIGASI 
        DAN JARINGAN</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
              <tr>
                <td width="114">UNIT KERJA</td>
                <td width="21">:</td>
                <td width="454"><?=$gNmUNT ?></td>
                <td width="91"><? if ($CriT=="BPK") {echo "KELOMPOK";}?></td>
                <td width="30"><? if ($CriT=="BPK") {echo ":";}?></td>
                <td width="687"><? if ($CriT=="BPK") {echo $gNmKEL;}?></td>
              </tr>
              <? if ($gUnt!="All") { ?>
              <tr>
                <td width="114">SUB UNIT</td>
                <td width="21">:</td>
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
                <td width="114"><? if ($CriT!="BPK") {echo "KODE LOKASI";} else {echo "TAHUN";}?></td>
                <td width="21"><?=":"?></td>
                <td><? if ($CriT!="BPK") {echo "$gLok";} else {echo $gThn;}?></td>
                <td><? if ($CriT=="BPK") {echo "RINCIAN OBJEK";}?></td>
                <td><? if ($CriT=="BPK") {echo ":";}?></td>
                <td><? if ($CriT=="BPK") {echo $gNmRIN;}?></td>
              </tr>
              <? } else {?>
              <tr>
                <td width="114">TAHUN</td>
                <td width="21">:</td>
                <td colspan="4"><? echo $gThn?></td>
              </tr>
              <? } ?>
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
    <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center" width="3%">NO</td>
    <td width="13%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">JENIS 
      BARANG / NAMA BARANG</td>
    <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold"> 
      NOMOR</td>
    <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center" width="6%">KONSTRUKSI</td>
    <td rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">PANJANG 
      (KM)</td>
    <td rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">LEBAR 
      (M)</td>
    <td width="3%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">LUAS 
      (M<sup>2</sup>) </td>
    <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center" width="8%">LETAK 
      / LOKASI</td>
    <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center" width="4%">TANGGAL PEROLEHAN </td>
    <td style="border:1px solid #000000; font-weight: bold" align="center" colspan="2">DOKUMEN</td>
    <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center" width="4%">STATUS 
      TANAH </td>
    <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center" width="4%">NOMOR 
      KODE TANAH</td>
    <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center" width="4%">ASAL-USUL</td>
    <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center" width="4%">KONDISI 
      (B,KB,RB) </td>
    <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold">N I L A I</td>
    <td width="9%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">KETERANGAN</td>
  </tr>
  <tr> 
    <td width="4%" align="center" style="border:1px solid #000000; font-weight: bold">KODE 
      BARANG </td>
    <td width="4%" align="center" style="border:1px solid #000000; font-weight: bold">REGISTER</td>
    <td align="center" style="border:1px solid #000000; font-weight: bold">TANGGAL</td>
    <td align="center" style="border:1px solid #000000; font-weight: bold">NOMOR</td>
    <td style="border:1px solid #000000; font-weight: bold" align="center" width="5%">PEROLEHAN</td>
    <td style="border:1px solid #000000; font-weight: bold" align="center" width="6%">AKHIR</td>
  </tr>
  <tr> 
    <td style="border:1px solid #000000; font-weight: bold" align="center" width="3%">1</td>
    <td style="border:1px solid #000000; font-weight: bold" align="center" width="13%">2</td>
    <td style="border:1px solid #000000; font-weight: bold" align="center" width="4%">3</td>
    <td style="border:1px solid #000000; font-weight: bold" align="center" width="4%">4</td>
    <td style="border:1px solid #000000; font-weight: bold" align="center" width="6%">5</td>
    <td width="4%" align="center" style="border:1px solid #000000; font-weight: bold">6</td>
    <td width="3%" align="center" style="border:1px solid #000000; font-weight: bold">7</td>
    <td style="border:1px solid #000000; font-weight: bold" align="center" width="3%">8</td>
    <td width="5%" align="center" style="border:1px solid #000000; font-weight: bold">9</td>
    <td width="5%" align="center" style="border:1px solid #000000; font-weight: bold">10</td>
    <td style="border:1px solid #000000; font-weight: bold" align="center" width="4%">11</td>
    <td style="border:1px solid #000000; font-weight: bold" align="center" width="10%">12</td>
    <td width="4%" align="center" style="border:1px solid #000000; font-weight: bold">13</td>
    <td width="4%" align="center" style="border:1px solid #000000; font-weight: bold">14</td>
    <td width="4%" align="center" style="border:1px solid #000000; font-weight: bold">15</td>
    <td width="4%" align="center" style="border:1px solid #000000; font-weight: bold">16</td>
    <td width="5%" align="center" style="border:1px solid #000000; font-weight: bold">17</td>
    <td style="border:1px solid #000000; font-weight: bold" align="center" width="6%">18</td>
    <td style="border:1px solid #000000; font-weight: bold" align="center">19</td>
  </tr>
  <?
		$Col[17];
		$iG = 1;
		$gHrg = 0;
		function ClrVr()
		{
			for($nG=0; $nG<=17; $nG++)
			{
				$Col[$nG]="";
			}
		}
		
		$t0413 = 0;
		$t0415 = 0;
		$t0415 = 0;
		$t0416 = 0;
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
				$fFindSy = "AND (No_Pengadaan LIKE '%".$gFin."%' OR Nm_Aset LIKE '%".$gFin."%' OR Harga LIKE '%".$gFin."%' OR Referensi LIKE '%".$gFin."%' OR Kd_Aset_108 LIKE '%".$gFin."%' OR Lokasi LIKE '%".$gFin."%' OR Keterangan LIKE '%".$gFin."%' OR Pencatat LIKE '%".$gFin."%')";
			}
			else
			{
				$fFindSy = "";
			}
			if ($gThnA){
				$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND (Tgl_Perolehan BETWEEN '".$gThnA."-01-01' AND '".$gThn."-12-31') ".$fFindSy." ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
			}
			else{
				$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
			}
		}
		else
		{				#########		
			$TglA="1900-01-01";
			$TglB=$gThn."-12-31";
			if ($gThn=="____") {$TglB=fGetDate('year')."-12-31";}
			
			
			if ($rIDT!="") {
				$nSQL= "SELECT * FROM ta_kib_108 WHERE IDT='".$rIDT."' ORDER BY Tgl_Perolehan, , No_Register";
			}
			else {
				if ($gThnA){
					$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gThnA."-01-01' AND '".$gThn."-12-31') AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' ORDER BY Tgl_Perolehan, No_Register";
				}
				else{
					$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Tgl_Perolehan LIKE '".$gThn."-__-__' AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' ORDER BY Tgl_Perolehan, No_Register";
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
				$Col[1] = $mRo['Nm_Aset']."<br><i>".$mRo['Referensi'];//fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");
				#if ($mRo['Nm_Aset']) {
				#	$Col[1].= " (<i> ".$mRo['Nm_Aset']." </i>)";
				#}
				
				#$Lef5   = substr($mRo['Kd_Aset'],0,5);
				$Col[2] = $mRo['Kd_Aset_108'];
				$Col[3] = $mRo['No_Register'];
				$Col[4] = $mRo['Konstruksi'];
				$Col[5] = $mRo['Panjang'];
				$Col[6] = $mRo['Lebar'];
				$Col[7] = $mRo['Luas'];
				$Col[8] = $mRo['Lokasi'];
				$Col[9] = $mRo['Dokumen_Tanggal'];
				$Col[10] = $mRo['Dokumen_Nomor'];
				$Col[11] = $mRo['Status_Tanah'];
				$Col[12] = $mRo['Kode_Tanah'];
				$Col[13] = $mRo['Asal_Usul'];
				$Col[14] = $mRo['Harga'];
				$rUPB = substr($mRo['Kd_UPB'],0,11);
				
				$gREF = $mRo['Referensi'];
				$gNIa = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB",$gREF.":".$rUPB."%","=:LIKE","","");
				$gNIb = 0;
				if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;}
				else {$gAKH=$gNIa;}
				
				$Col[15] = $mRo['Kondisi'];
				$Col[16] = $mRo['Keterangan'];
				$Col[17] = $gAKH;
				$gHrg = $gHrg + $gAKH;
				
				$CeM = fGlobal("count(*)","ta_kib_post_108","referensi:HasilMerger:Kd_UPB",$mRo['Referensi'].":Y:".$rUPB."%","=:=:LIKE","","");
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
				$TG = $mRo['Tgl_Perolehan'];
				ViewRincian($Col[0],$Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],"",$LT,$LB,$LG,$TG,$xB);
				if ($CeM>0){
					LoadMerger1($mRo['Referensi'],substr($mRo['Kd_UPB'],0,11));
				}
				LoadMerger2($mRo['Referensi'],substr($mRo['Kd_UPB'],0,11));
				$iG++;
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
		else
		{
		echo ViewBlank();
		}
		
		function LoadMerger1($Ref,$SkP)
		{
			$SW="SELECT P2.*, P1.Tanggal as Tanggal FROM ta_kib_post_108 P1 
			LEFT JOIN ta_kib_108_merger_his P2 ON P2.Referensi=P1.Mrg_Ref_History 
			WHERE P1.Referensi='$Ref' AND P1.HasilMerger='Y' ORDER BY P2.Tgl_Perolehan, P2.Kd_Aset_108, P2.No_Register";
			$Rw = mysql_query($SW);
			while ($mR = mysql_fetch_array($Rw, MYSQL_BOTH))
			{
				echo ClrVr();
				$Col[0] = "";
				$Col[1] = $mR['Referensi']."<br>".$mR['Nm_Aset'];
				$Col[2] = $mR['Kd_Aset_108'];
				$Col[3] = "-";
				$Col[4] = $mR['Konstruksi'];
				$Col[5] = $mR['Panjang'];
				$Col[6] = $mR['Lebar'];
				$Col[7] = $mR['Luas'];
				$Col[8] = $mR['Lokasi']." ".$mR['Keterangan'];
				#$Col[9] = $mR['Dokumen_Tanggal'];
				$Col[9] = $mR['Tanggal'];
				$Col[10] = $mR['Dokumen_Nomor'];
				$Col[11] = $mR['Status_Tanah'];
				$Col[12] = $mR['Kode_Tanah'];
				$Col[13] = $mR['Asal_Usul'];
				$Col[14] = $mR['Debet'];
				$TG = $mR['Tanggal'];
				
				ViewRincian($Col[0],$Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],"<i>","0","0","solid",$TG,"");
			}
		}
		
		function LoadMerger2($Ref,$SkP)
		{
			$SW="SELECT Uraian, Kd_Aset_108, Tanggal, Debet FROM ta_kib_post_108 
			WHERE Referensi='$Ref' AND Kd_UPB LIKE '$SkP%' AND HasilMerger='N' AND Crit='INV' ORDER BY Tanggal, Kd_Aset_108, No_Register";
			$Rw = mysql_query($SW);
			while ($mR = mysql_fetch_array($Rw, MYSQL_BOTH))
			{
				echo ClrVr();
				$Col[0] = "";
				$Col[1] = $mR[0];
				$Col[2] = $mR[1];
				$Col[3] = "-";
				$Col[4] = "";
				$Col[5] = 0;
				$Col[6] = 0;
				$Col[7] = 0;
				$Col[8] = "";
				$Col[9] = $mR[2];
				$Col[10] = "";
				$Col[11] = "";
				$Col[12] = "";
				$Col[13] = "";
				$Col[14] = $mR[3];
				$TG = $mR['Tanggal'];
				
				ViewRincian($Col[0],$Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],"<i>","0","0","solid",$TG,"");
			}
		}
		?>
  <? function ViewRincian($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$LI,$LT,$LB,$LG,$TG,$xB) {?>
  <tr valign="top"> 
    <td width="3%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><? echo $x0?><? if ($x0!=""){echo ".";}?></td>
    <td width="13%" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.$x1?></td>
    <td width="4%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><?=$LI.$xB.$x2?></td>
    <td width="4%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><?=$LI.$xB.$x3?></td>
    <td width="6%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><?=$LI.$xB.$x4?></td>
    <td width="4%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><? if ($x5!=0){echo $LI.$xB.fConvertToRupiah($x5);}?></td>
    <td width="3%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><? if ($x6!=0){echo $LI.$xB.fConvertToRupiah($x6);}?></td>
    <td width="3%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><? if ($x7!=0){echo $LI.$xB.fConvertToRupiah($x7);}?></td>
    <td width="5%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.$x8?></td>
    <td width="4%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000; text-align:center"><?=$LI.$xB.fConvertDateShort($TG)?></td>
    <td width="4%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.fConvertDateShort($x9)?></td>
    <td width="10%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.$x10?></td>
    <td width="4%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.$x11?></td>
    <td width="4%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000; text-align:center"><?=$LI.$xB.$x12?></td>
    <td width="4%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><?=$LI.$xB.$x13?></td>
    <td width="4%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><?=$LI.$xB.$x15?></td>
    <td width="5%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="right"><?=$LI.$xB.fConvertToRupiah($x14)?></td>
    <td width="6%"  style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="right"><? if ($x17!=0) {echo $LI.$xB.fConvertToRupiah($x17);}?></td>
    <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px solid #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><? echo $x16?></td>
  </tr>
  <? } ?>
  <? function ViewBlank() {?>
  <tr> 
    <td width="3%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="13%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="4%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="4%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="6%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="4%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="3%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="3%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="5%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="5%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="4%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="10%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="4%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="4%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="4%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="4%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="5%" style="border: 1px solid #000000">&nbsp;</td>
    <td width="6%" style="border: 1px solid #000000">&nbsp;</td>
    <td style="border: 1px solid #000000">&nbsp;</td>
  </tr>
  <? } ?>
  <?
  //echo $t0413."<br>";
  //echo $t0414."<br>";
  //echo $t0415."<br>";
  //echo $t0416."<br>";
  ?>
  <tr> 
    <td style="border:1px solid #000000; font-weight: bold" align="center" colspan="16">JUMLAH</td>
    <td style="border:1px solid #000000; font-weight: bold" align="right"><?=fConvertToRupiah($gHrg)?></td>
    <td width="6%" style="border:1px solid #000000; font-weight: bold" align="right"><?=fConvertToRupiah($gHrg)?></td>
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
