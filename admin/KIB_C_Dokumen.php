<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<?php
ini_set('max_execution_time', 300);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
extract($_GET);
$gRf = "BNG";
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
			
      <td style="font-size: 13pt; font-weight: bold" align="center">KARTU INVENTARIS 
        BARANG (KIB C)</td>
		</tr>
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center"> GEDUNG DAN BANGUNAN <?php if ($gExt=="Y") {echo "(EXTRA KOMTABLE)";}?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
              <tr>
                <td width="103">UNIT KERJA</td>
                <td width="30">:</td>
                <td width="457"><?=$gNmUNT ?></td>
                <td width="110"><?php if ($CriT=="BPK") {echo "KELOMPOK";}?></td>
                <td width="40"><?php if ($CriT=="BPK") {echo ":";}?></td>
                <td width="641"><?php if ($CriT=="BPK") {echo $gNmKEL;}?></td>
              </tr>
              <?php if ($gUnt!="All") { ?>
              <tr>
                <td width="103">SUB UNIT</td>
                <td width="30">:</td>
                <td><?=$gNmSUB ?></td>
                <td><?php if ($CriT=="BPK") {echo "JENIS";}?></td>
                <td><?php if ($CriT=="BPK") {echo ":";}?></td>
                <td><?php if ($CriT=="BPK") {echo $gNmJNS;}?></td>
              </tr>
              <tr>
                <td>UPB</td>
                <td>:</td>
                <td><?php echo $gNmUPB?></td>
                <td><?php if ($CriT=="BPK") {echo "OBJEK";}?></td>
                <td><?php if ($CriT=="BPK") {echo ":";}?></td>
                <td><?php if ($CriT=="BPK") {echo $gNmOBJ;}?></td>
              </tr>
              <tr>
                <td width="103"><?php if ($CriT!="BPK") {echo "KODE LOKASI";} else {echo "TAHUN";}?></td>
                <td width="30"><?=":"?></td>
                <td><?php if ($CriT!="BPK") {echo "$gLok";} else {echo $gThn;}?></td>
                <td><?php if ($CriT=="BPK") {echo "RINCIAN OBJEK";}?></td>
                <td><?php if ($CriT=="BPK") {echo ":";}?></td>
                <td><?php if ($CriT=="BPK") {echo $gNmRIN;}?></td>
              </tr>
              <?php } else {?>
              <tr>
                <td width="103">TAHUN</td>
                <td width="30">:</td>
                <td colspan="4"><?php echo $gThn?></td>
              </tr>
              <?php } ?>
            </table>
			  <!--table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
          <tr> 
            <td width="109">UNIT KERJA</td>
            <td width="31">:</td>
            <td width="1250"><?php echo $gNmUNT ?></td>
          </tr>
		  <?php if ($gUnt!="All") { ?>
          <tr> 
            <td width="109">SUB UNIT</td>
            <td width="31">:</td>
            <td><?php echo $gNmSUB ?></td>
          </tr>
          <tr>
            <td>UPB</td>
            <td>:</td>
            <td><?php echo $gNmUPB ?></td>
          </tr>
          <tr> 
            <td width="109">KODE LOKASI</td>
            <td width="31">:</td>
            <td><?php echo $gLok?></td>
          </tr>
		  <?php } else {?>
          <tr> 
            <td width="109">TAHUN</td>
            <td width="31">:</td>
            <td><?php echo $gThn?></td>
          </tr>
		  <?php } ?>
        </table-->
			</td>
		</tr>
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
			<td>
		  <table border="0" width="2100" style="border:0 solid #000000; font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table2" bordercolor="#000000">
          <tr> 
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">NO</td>
            <td rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">JENIS BARANG / NAMA BARANG</td>
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold"> NOMOR</td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">KONDISI BANGUNAN (B,KB,RB)</td>
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold">KONSTRUKSI BANGUNAN </td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">LUAS<br>LANTAI (M<sup>2</sup>)</td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">LETAK / LOKASI</td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">KOORDINAT</td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">TANGGAL<br>PEROLEHAN</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" colspan="2">DOKUMEN GEDUNG </td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">LUAS (M<sup>2</sup>) </td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">STATUS TANAH </td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">NOMOR KODE<br>TANAH</td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">ASAL-USUL</td>
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold">N I L A I</td>
            <td rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">KETERANGAN</td>
          </tr>
          <tr> 
            <td align="center" style="border:1px solid #000000; font-weight: bold">KODE BARANG </td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">REGISTER</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">BERTINGKAT/ TIDAK</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">BETON/ TIDAK </td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">TANGGAL</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">NOMOR</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">PEROLEHAN</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">AKHIR</td>
          </tr>
          <tr style="text-align:center">
            <td width="30" style="border:1px solid #000000; font-weight: bold">1</td>
            <td width="250" style="border:1px solid #000000; font-weight: bold">2 </td>
            <td width="80" style="border:1px solid #000000; font-weight: bold">3</td>
            <td width="50" style="border:1px solid #000000; font-weight: bold">4</td>
            <td width="40" style="border:1px solid #000000; font-weight: bold">5</td>
            <td width="70" style="border:1px solid #000000; font-weight: bold">6</td>
            <td width="70" style="border:1px solid #000000; font-weight: bold">7</td>
            <td width="80" style="border:1px solid #000000; font-weight: bold">8</td>
            <td width="240" style="border:1px solid #000000; font-weight: bold">9</td>
            <td width="150" style="border:1px solid #000000; font-weight: bold">10</td>
            <td width="70" style="border:1px solid #000000; font-weight: bold">11</td>
            <td width="70" style="border:1px solid #000000; font-weight: bold">12</td>
            <td width="100" style="border:1px solid #000000; font-weight: bold">13</td>
            <td width="60" style="border:1px solid #000000; font-weight: bold">14</td>
            <td width="60" style="border:1px solid #000000; font-weight: bold">15</td>
            <td width="80" style="border:1px solid #000000; font-weight: bold">16</td>
            <td width="100" style="border:1px solid #000000; font-weight: bold">17</td>
            <td width="100" style="border:1px solid #000000; font-weight: bold">18</td>
            <td width="100" style="border:1px solid #000000; font-weight: bold">19</td>
            <td style="border:1px solid #000000; font-weight: bold">19</td>
          </tr>
          <?php
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
						$fFindSy = "AND (No_Pengadaan LIKE '%".$gFin."%' OR Nm_Aset LIKE '%".$gFin."%' OR Harga LIKE '%".$gFin."%' OR Referensi LIKE '%".$gFin."%' OR Kd_Aset_108 LIKE '%".$gFin."%' OR Keterangan LIKE '%".$gFin."%' OR Lokasi LIKE '%".$gFin."%' OR Pencatat LIKE '%".$gFin."%')";
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
					if ($rIDT!="") {
						$nSQL= "SELECT * FROM ta_kib_108 WHERE IDT='".$rIDT."' ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
					}
					else {
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
						ClrVr();
						$Col[0] = $iG;
						
						$Col[1] = $mRo['Nm_Aset'];
						if ($mRo['Nm_Aset']) {
							$Col[1].= " (<i> ".$mRo['Nm_Aset']." </i>)";
						}
						
						$Col[1].= "<br><i>".$mRo['Referensi'];
						
						if ($Col[1]=="") {$Col[1]=fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$mRo['Kd_Aset_108'],"=","","");}
						
						$Col[2] = $mRo['Kd_Aset_108'];
						$Col[3] = $mRo['No_Register'];
						$Col[4] = $mRo['Kondisi'];
						$Col[5] = $mRo['Bertingkat'];
						$Col[6] = $mRo['Beton'];
						$Col[7] = $mRo['Luas_Lantai'];
						$Col[8] = $mRo['Lokasi'];
						$Col[9] = $mRo['Dokumen_Tanggal'];
						$Col[10] = $mRo['Dokumen_Nomor'];
						
						if ($Col[9]=='0000-00-00' || $Col[9]=='')
						{
							$NoB = fGlobal("No_Berkas","ta_pengadaan","Nomor",$mRo['No_Pengadaan'],"=","","");
							$Col[9] = fGlobal("Tg_Kontrak","ta_penerimaan_berkas","Nomor",$NoB,"=","","");
							$Col[10] = fGlobal("No_Kontrak","ta_penerimaan_berkas","Nomor",$NoB,"=","","");
						}
						
						$Col[11] = $mRo['Luas_Tanah'];
						$Col[12] = $mRo['Status_Tanah'];
						$Col[13] = $mRo['Kode_Tanah'];
						$Col[14] = $mRo['Asal_Usul'];
						#$Col[14] = $mRo['Referensi'];
						$Col[15] = $mRo['Harga'];
						$gREF = $mRo['Referensi'];
						$TG   = $mRo['Tgl_Perolehan'];
						$gNIa = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB",$gREF.":".substr($mRo['Kd_UPB'],0,11)."%","=:LIKE","","");
						#$gNIa = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB",$gREF.":".$mRo['Kd_UPB'],"=:=","","");
						
						$gNIb = 0;
						if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;}
						else {$gAKH=$gNIa;}
						
						$Col[16] = $mRo['Keterangan'];
						$Col[17] = $gAKH;
						$Col[18] = $mRo['lat_lng'];
						
						$gHrg = $gHrg + $gAKH;
						$gAhr = $gAhr + $gAKH;
						
						$CeM = fGlobal("count(*)","ta_kib_post_108","referensi:HasilMerger:kd_upb",$mRo['Referensi'].":Y:".substr($mRo['Kd_UPB'],0,11)."%","=:=:LIKE","","");
						$xB="";
						$LT="1";
						$LL="1";
						$LB="0";
						$LG="solid";
						ViewRincian($Col[0],$Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],"",$LT,$LB,$LG,$LL,$TG,$xB);
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
					$SW="SELECT P2.*, P1.Debet as Debet, P1.Tanggal as Tanggal 
					FROM ta_kib_post_108 P1 
					LEFT JOIN ta_kib_108_merger_his P2 
					ON P2.Referensi=P1.Mrg_Ref_History AND P2.Kd_UPB LIKE '$SkP%' 
					WHERE P1.Referensi='$Ref' AND P1.HasilMerger='Y' AND P1.Kd_UPB LIKE '$SkP%' ORDER BY P2.Dokumen_Tanggal, P2.Tgl_Perolehan, P2.Kd_Aset_108";
					#echo $SW."<br>";
					$Rw = mysql_query($SW);
					while ($mR = mysql_fetch_array($Rw, MYSQL_BOTH))
					{
						echo ClrVr();
						$Col[0] = "";
						$Col[1] = $mR['Nm_Aset'];
						$Try1   = fGlobal("uraian","ta_kib_post_108","referensi:mrg_ref_history:kd_upb",$Ref.":".$mR['referensi'].":".$SkP."%","=:=:LIKE","","");
						if ($Try1!=''){
							$Col[1].= "<br>(".$Try1.")";
						}
						$Col[1].= "<br><i>".$mR['Referensi'];
						$Col[2] = "";
						$Col[3] = "";
						$Col[4] = "";
						$Col[5] = "";
						$Col[6] = "";
						$Col[7] = $mR['Luas_Lantai'];
						$Col[8] = $mR['Lokasi'];
						$Col[9] = $mR['Dokumen_Tanggal'];
						$Col[10] = $mR['Dokumen_Nomor'];
						
						if ($Col[9]=='0000-00-00' || $Col[9]=='')
						{
							$NoB = fGlobal("No_Berkas","ta_pengadaan","Nomor",$mR['No_Pengadaan'],"=","","");
							$Col[9] = fGlobal("Tg_Kontrak","ta_penerimaan_berkas","Nomor",$NoB,"=","","");
							$Col[10] = fGlobal("No_Kontrak","ta_penerimaan_berkas","Nomor",$NoB,"=","","");
						}
						
						$Col[11] = $mR['Luas_Tanah'];
						$Col[12] = $mR['Status_Tanah'];
						$Col[13] = $mR['Kode_Tanah'];
						$Col[14] = $mR['Asal_Usul'];
						$Col[15] = $mR['Debet'];
						$Col[16] = $mR['Keterangan'];
						$Col[17] = "";
						$Col[18] = "";
						$LT="1";
						$LL="0";
						$LB="0";
						$LG="dotted";
						$TG = $mR['Tanggal'];
						ViewRincian($Col[0],$Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],"<i>",$LT,$LB,$LG,$LL,$TG,"");
					}
				}
				
				function LoadMerger2($Ref,$SkP)
				{
					$SW="SELECT * FROM ta_kib_post_108 
					WHERE Referensi='$Ref' AND Kd_UPB LIKE '$SkP%' AND HasilMerger='N' AND Crit='INV' ORDER BY Tanggal, Kd_Aset_108, No_Register";
					$Rw = mysql_query($SW);
					while ($mR = mysql_fetch_array($Rw, MYSQL_BOTH))
					{
						ClrVr();
						$Col[0] = "";
						$Col[1] = $mR['Uraian']."<br><i>".$mR['Ref_History'];
						$Col[2] = "";
						$Col[3] = "";
						$Col[4] = "";
						$Col[5] = "";
						$Col[6] = "";
						$Col[7] = "";
						$Col[8] = "";
						$Col[9] = "";
						
						if ($Col[9]=='0000-00-00' || $Col[9]=='')
						{
							$NoB = fGlobal("No_Berkas","ta_pengadaan","Nomor",$mR['No_Pengadaan'],"=","","");
							$Col[9] = fGlobal("Tg_Kontrak","ta_penerimaan_berkas","Nomor",$NoB,"=","","");
							$Col[10] = fGlobal("Tg_Kontrak","ta_penerimaan_berkas","Nomor",$NoB,"=","","");
						}
						
						$Col[10] = "";
						$Col[11] = "";
						$Col[12] = "";
						$Col[13] = "";
						$Col[14] = "";
						$Col[15] = $mR['Debet'];
						$Col[16] = $mR['Keterangan'];
						$Col[17] = "";
						$Col[18] = "";
						$LT="1";
						$LL="0";
						$LB="0";
						$LG="dotted";
						$TG = $mR['Tanggal'];
						ViewRincian($Col[0],$Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],"<i>",$LT,$LB,$LG,$LL,$TG,"");
					}
				}
				?>
          <?php function ViewRincian($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$LI,$LT,$LB,$LG,$LL,$TG,$xB) {?>
          <tr height="22">
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LL?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><?php echo $x0?><?php if ($x0!=""){echo ".";}?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$x1?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><?=$LI.$xB.$x2?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><?=$LI.$xB.$x3?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><?=$LI.$xB.$x4?></td>
            <td align="center" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.$x5?></td>
            <td align="center" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.$x6?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="center"><?php if ($x7!=0){echo $LI.$xB.fConvertToRupiahBulat($x7);}?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.$x8?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.$x18?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000; text-align:center"><?=$LI.fConvertDateShort($TG)?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000; text-align:center"><?php if ($x9!="0000-00-00" && $x9!=""){echo $LI.$xB.fConvertDateShort($x9);}?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$LI.$xB.$x10?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000; text-align:center"><?php if ($x11!=0){echo $LI.$xB.fConvertToRupiahBulat($x11);}?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000; text-align:center"><?=$LI.$xB.$x12?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000; text-align:center"><?=$LI.$xB.$x13?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000; text-align:center"><?=$LI.$xB.$x14?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="right"><?php echo $LI.$xB.fConvertToRupiah($x15)?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000" align="right"><?php if ($x17!="") {echo $LI.$xB.fConvertToRupiah($x17);}?></td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: <?=$LT?>px <?=$LG?> #000; border-bottom: <?=$LB?>px <?=$LG?> #000"><?=$x16?></td>
          </tr>
          <?php } ?>
          <?php function ViewBlank() {?>
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
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
          </tr>
          <?php } ?>
          <tr height="25"> 
            <td colspan="17" style="border:1px solid #000000; font-weight: bold" align="center"> 
              JUMLAH</td>
            <td align="right" style="border:1px solid #000000; font-weight: bold"><?php echo fConvertToRupiah($gHrg)?></td>
            <td align="right" style="border:1px solid #000000; font-weight: bold"><?php echo fConvertToRupiah($gAhr)?></td>
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
			<?php if ($gUnt!="All") { ?>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table6">
				<?php require "Dokumen_Footer.php";?>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">Mengetahui,</td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230"><?php echo $NmIbKt.", ".$rHri." ".fNmBulan($rBln)." ".$rThn?></td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
					<td width="230" align="center" style="font-weight: bold"><?php echo $FotA[1]?></td>
					<td align="center">&nbsp;</td>
					<td align="center" style="font-weight: bold" width="230"><?php echo $FotC[1]?></td>
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
					<td width="230" align="center" style="font-weight: bold"><u><?php echo $FotA[2]?></u></td>
					<td align="center">&nbsp;</td>
					<td align="center" style="font-weight: bold" width="230"><u><?php echo $FotC[2]?></u></td>
					<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">NIP. <?php echo $FotA[3]?></td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230">NIP. <?php echo $FotC[3]?></td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
			</table>
			<?php } ?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>

</body>

</html>
<?php
$colors = array('red', 'blue', 'green', 'yellow');

foreach ($colors as $color) {
	//echo "Do you like $color?\n";
}

?> 

<?php require('Connection_Close.php');?>
