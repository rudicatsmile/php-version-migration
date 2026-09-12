<?php require "CheckSession.php";?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php";?>
<?php
ini_set('max_execution_time', 300);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
extract($_GET);

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
	$gLmT  = $_GET['LmT'];
	$gHeA   = $_GET['HeA'];
	$gTtD   = $_GET['TtD'];
	$gReC   = $_GET['ReC'];
	
	if (isset($_GET['rIDT'])){$rIDT=$_GET['rIDT'];}
	if ($rIDT)
	{
		$rDT = fGlobal("kd_upb","ta_kib_108","IDT",$rIDT,"=","","");
		$gUnt = substr($rDT,0,11);
		$gSub = substr($rDT,0,14);
		$gUpb = $rDT;
	}
	else
	{
		$gUnt  = $_GET['gUnt'];
		$gSub  = $_GET['gSub'];
		$gUpb  = $_GET['gUpb'];
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
	<table border="0" width="1100" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
		
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center">ASET TIDAK BERWUJUD</td>
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
                <td width="109"><?php if ($CriT=="BPK") {echo "OBJEK";}?></td>
                <td width="20"><?php if ($CriT=="BPK") {echo ":";}?></td>
                <td width="448"><?php if ($CriT=="BPK") {echo $gNmKEL;}?></td>
              </tr>
              <?php if ($gUnt!="All") { ?>
              <tr>
                <td width="96">SUB UNIT</td>
                <td width="18">:</td>
                <td><?=$gNmSUB ?></td>
                <td><?php if ($CriT=="BPK") {echo "RINCIAN OBJEK";}?></td>
                <td><?php if ($CriT=="BPK") {echo ":";}?></td>
                <td><?php if ($CriT=="BPK") {echo $gNmJNS;}?></td>
              </tr>
              <tr>
                <td>UPB</td>
                <td>:</td>
                <td><?php echo $gNmUPB?></td>
                <td><?php if ($CriT=="BPK") {echo "SUB RO";}?></td>
                <td><?php if ($CriT=="BPK") {echo ":";}?></td>
                <td><?php if ($CriT=="BPK") {echo $gNmOBJ;}?></td>
              </tr>
              <tr>
                <td width="96"><?php if ($CriT!="BPK") {echo "KODE LOKASI";} else {echo "TAHUN";}?></td>
                <td width="18"><?=":"?></td>
                <td><?php if ($CriT!="BPK") {echo "$gLok";} else {echo $gThn;}?></td>
                <td><?php if ($CriT=="BPK") {echo "SUB-SUB RO";}?></td>
                <td><?php if ($CriT=="BPK") {echo ":";}?></td>
                <td><?php if ($CriT=="BPK") {echo $gNmRIN;}?></td>
              </tr>
              <?php } else {?>
				  <?php if ($gThnA==""){?>
				  <tr>
					<td width="96">TAHUN</td>
					<td width="18">:</td>
					<td colspan="4"><?php echo $gThn?></td>
				  </tr>
	              <?php } ?>
              <?php } ?>
			  <?php if ($gThnA!=""){?>
              <tr>
                <td width="96">TAHUN</td>
                <td width="18">:</td>
                <td colspan="4"><?=$gThnA?> S.D <?=$gThn?></td>
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
        </table-->			</td>
		</tr>
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
		  <td>
		  <table border="0" width="1300" style="border:0 solid #000000; font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table2" bordercolor="#000000">
          <tr> 
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center" width="2%">NO</td>
            <td width="7%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">KODE BARANG </td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" colspan="2">DOKUMEN </td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center" width="7%">MERK / TYPE </td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center" width="8%">NO.SERTIFIKAT NO.PABRIK NO.CHASIS NO.MESIN</td>
            <td width="7%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">BAHAN</td>
            <td width="5%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">ASAL / CARA PEROLEHAN BARANG </td>
            <td width="6%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">TAHUN BELI / TGL.PEROLEHAN </td>
            <td width="8%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">UKURAN BARANG/ KONTRUKSI (P.S.D)</td>
            <td width="5%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">SATUAN</td>
            <td width="6%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">KEADAAN BARANG (B/KB/RB) </td>
            <td width="4%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">JUMLAH BARANG</td>
            <td width="3%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">NILAI PEROLEHAN </td>
            </tr>
          <tr> 
            <td align="center" style="border:1px solid #000000; font-weight: bold">REGISTER</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">NAMA / JENIS BARANG </td>
            </tr>
          <tr> 
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="2%">1</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="7%">2            </td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="4%"> 
              3</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="17%"> 
              4</td>
            <td width="7%" align="center" style="border:1px solid #000000; font-weight: bold">5</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="8%"> 
              6</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold"> 
              7</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">8</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">9</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">10</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">11</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">12</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">13</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">14</td>
            </tr>
          <?php
				$gTOA = 0;
				$gTOB = 0;
				$iG = 1;
				$iR = 1;
				$gHrg = 0;
				function ClrVr()
				{
					for($nG=0; $nG<=15; $nG++)
					{
						$Col[$nG]="";
					}
				}
				$gRf = "KDL";
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
						$fFindSy = "AND (Nm_Aset LIKE '%".$gFin."%' OR Harga LIKE '%".$gFin."%' OR Referensi LIKE '%".$gFin."%' OR Kd_Aset_108 LIKE '%".$gFin."%' OR Keterangan LIKE '%".$gFin."%' OR Lokasi LIKE '%".$gFin."%')";
					}
					else
					{
						$fFindSy = "";
					}
					if ($gThnA){
						$nSQL= "SELECT * FROM ta_kib_108 WHERE Kd_Aset_108 LIKE '1.5.3%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND (Tgl_Perolehan BETWEEN '".$gThnA."-01-01' AND '".$gThn."-12-31') ".$fFindSy." ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
					}
					else{
						$nSQL= "SELECT * FROM ta_kib_108 WHERE Kd_Aset_108 LIKE '1.5.3%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
					}
				}
				else
				{
					if ($rIDT!="") {
						$nSQL= "SELECT * FROM ta_kib_108 WHERE IDT='".$rIDT."' ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
					}
					else {
						if ($gThnA){
							$nSQL= "SELECT * FROM ta_kib_108 WHERE Kd_Aset_108 LIKE '1.5.3%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gThnA."-01-01' AND '".$gThn."-12-31') AND Status='' ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
						}
						else{
							$nSQL= "SELECT * FROM ta_kib_108 WHERE Kd_Aset_108 LIKE '1.5.3%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Tgl_Perolehan LIKE '".$gThn."-__-__' AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
						}
					}
				}
				$nRs = mysql_query($nSQL) or die(mysql_error());
				$mRo = mysql_fetch_assoc($nRs);
				$tRo = mysql_num_rows($nRs);
				if ($tRo > 0)
				{
					do
					{
						ClrVr();
						$Col[1] = $iG;
						$Col[2] = $mRo['Kd_Aset_108'];
						$Col[3] = $mRo['No_Register'];
						$Col[4] = $mRo['Nm_Aset'];
						$Col[5] = $mRo['Merk'];
						$rUPB   = substr($mRo['Kd_UPB'],0,11);
						$RefH = $mRo['Ref_History'];
						$Urai = $mRo['Keterangan'];
						if ($mRo['Type']!="" && $mRo['Type']!="-") {$Col[5].= "/ ".$mRo['Type'];}
						
						$Col[6] = "";
						if ($mRo['Sertifikat_Nomor']!=""){$Col[6].= $mRo['Sertifikat_Nomor'];}
						if ($mRo['Nomor_Pabrik']!="" && $mRo['Nomor_Pabrik']!="-")
						{
							if ($Col[6]!=""){$Col[6].= "/ ";}
							$Col[6].= $mRo['Nomor_Pabrik'];
						}
						if ($mRo['Nomor_Rangka']!="" && $mRo['Nomor_Rangka']!="-")
						{
							if ($Col[6]!=""){$Col[6].= "/ ";}
							$Col[6].= $mRo['Nomor_Rangka'];
						}
						if ($mRo['Nomor_Mesin']!="" && $mRo['Nomor_Mesin']!="-")
						{
							if ($Col[6]!=""){$Col[6].= "/ ";}
							$Col[6].= $mRo['Nomor_Mesin'];
						}
						if ($mRo['Nomor_Polisi']!="" && $mRo['Nomor_Polisi']!="-")
						{
							if ($Col[6]!=""){$Col[6].= "/ ";}
							$Col[6].= $mRo['Nomor_Polisi'];
						}
						if ($mRo['Nomor_BPKB']!="" && $mRo['Nomor_BPKB']!="-")
						{
							if ($Col[6]!=""){$Col[6].= "/ ";}
							$Col[6].= $mRo['Nomor_BPKB'];
						}
						
						#if ($Col[1]=="") {$Col[1]=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
						
						$Col[7] = $mRo['Bahan'];
						$Col[8] = $mRo['Asal_Usul'];
						$Col[9] = fConvertDateShort($mRo['Tgl_Perolehan']);
						
						$Col[10] = "";
						if ($mRo['Ukuran_CC']!=""){$Col[10].= $mRo['Ukuran_CC'];}
						if ($mRo['Luas_Lantai']!="" && $mRo['Luas_Lantai']!="-" && $mRo['Luas_Lantai']!="0.00")
						{
							if ($Col[10]!=""){$Col[10].= "/ ";}
							$Col[10].= $mRo['Luas_Lantai'];
						}
						if ($mRo['Luas_Tanah']!="" && $mRo['Luas_Tanah']!="-" && $mRo['Luas_Lantai']!="0.00")
						{
							if ($Col[10]!=""){$Col[10].= "/ ";}
							$Col[10].= $mRo['Luas_Tanah'];
						}
						if ($mRo['Luas']!="" && $mRo['Luas']!="-" && $mRo['Luas_Lantai']!="0.00")
						{
							if ($Col[10]!=""){$Col[10].= "/ ";}
							$Col[10].= $mRo['Luas'];
						}
						if ($mRo['Ukuran']!="" && $mRo['Ukuran']!="-" && $mRo['Ukuran']!="0.00")
						{
							if ($Col[10]!=""){$Col[10].= "/ ";}
							$Col[10].= $mRo['Ukuran'];
						}
						if ($mRo['Spesifikasi']!="" && $mRo['Spesifikasi']!="-")
						{
							if ($Col[10]!=""){$Col[10].= "/ ";}
							$Col[10].= $mRo['Spesifikasi'];
						}
						if ($mRo['Konstruksi']!="" && $mRo['Konstruksi']!="-")
						{
							if ($Col[10]!=""){$Col[10].= "/ ";}
							$Col[10].= $mRo['Konstruksi'];
						}
						$Col[10]= "";//$mRo['Referensi'];
						$Col[11]= "";//$mRo['Ref_History'];
						$Col[12]= $mRo['Kondisi'];
						$Col[13]= "1";
						
						$gREF = $mRo['Referensi'];
						$gReH = $mRo['Ref_History'];
						
						#$gNIa = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB:Ref_History:Tanggal",$gREF.":".$rUPB."%:".$gReH.":".$gThn."-12-31","=:LIKE:=:<=","","");
						$gNIa = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB:Tanggal",$gREF.":".$rUPB."%:".$gThn."-12-31","=:LIKE:<=","","");
						
						$NilSS = 0;
						if ($RefH!=""){
							if ($UID=='creator'){
								$DissP="";
							}
							else{
								$DissP="";
							}
							$NilSS = 0;//fGlobal("Koreksi_Akumulasi","ta_kib_post_108_penyusutan_bulanan","Referensi:Kd_UPB:Triwulan:sdhmutasi",$RefH.":".$rUPB."%:IV:Y","=:LIKE:=:=","IDT DESC LIMIT 0,1","$DissP");;
						}
						
						$gAKH = $gNIa-$NilSS;
						$Col[14] = $gNIa;
						$Col[15] = $NilSS;
						$Col[16] = $gAKH;
						
						$gTOA = $gTOA + $Col[14];
						$gTOB = $gTOB + $gAKH;
						$gPNY = $gPNY + $NilSS;
						
						ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$RefH,$Urai,$NilSS);
						$iG++;
						$iR++;
					}
					while ($mRo = mysql_fetch_assoc($nRs));	
				}
				else
				{
				echo ViewBlank();
				}
				$gITM=$iR-1;
				?>
          <?php function ViewRincian($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$RefH,$Urai,$NilSS) {?>
          <tr> 
            <td width="2%" style="border: 1px solid #000000" valign="top" align="center"><?php echo $x1?>.</td>
            <td width="7%" style="border: 1px solid #000000; text-align:center" valign="top"><?=$x2?></td>
            <td width="4%" style="border: 1px solid #000000; text-align:center" valign="top"><?=$x3?></td>
            <td width="17%" style="border: 1px solid #000000" valign="top"><?=$x4?><?php if ($Urai!=""){echo "<br>(<i>".$Urai."</i>)";}?><?php if ($RefH!=""){echo "<br>(<i>Ref. Mutasi : ".$RefH."</i>)";}?></td>
            <td width="7%" valign="top" style="border: 1px solid #000000"><?=$x5?></td>
            <td width="8%" style="border: 1px solid #000000" valign="top"><?=$x6?></td>
            <td valign="top" style="border: 1px solid #000000"><?=$x7?></td>
            <td valign="top" style="border: 1px solid #000000"><?=$x8?></td>
            <td valign="top" style="border: 1px solid #000000; text-align:center"><?=$x9?></td>
            <td valign="top" style="border: 1px solid #000000"><?=$x10?></td>
            <td valign="top" style="border: 1px solid #000000"><?=$x11?></td>
            <td valign="top" style="border: 1px solid #000000; text-align:center"><?=$x12?></td>
            <td valign="top" style="border: 1px solid #000000; text-align:center"><?=$x13?></td>
            <td valign="top" style="border: 1px solid #000000; text-align:right"><?=fConvertToRupiah($x14)?></td>
            </tr>
          <?php } ?>
          <?php function ViewBlank() {?>
          <tr> 
            <td width="2%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="7%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="4%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="17%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="7%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="8%" style="border: 1px solid #000000">&nbsp;</td>
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
          <tr height="22"> 
            <td colspan="12" align="center" style="border:1px solid #000000; font-weight: bold">
			<?php
			if ($gLmT=="YA"){
				echo "SUB TOTAL";
			}
			else{
				echo "T O T A L";
			}
			?>
			</td>
            <td style="border: 1px solid #000000; text-align:center; font-weight:bold"><?=fConvertToRupiahBulat($gITM)?></td>
            <td style="border: 1px solid #000000; text-align:right; font-weight:bold"><?=fConvertToRupiah($gTOA)?></td>
          </tr>
		  <?php 
		  if ($gLmT=="YA" && $LoadEND=="YA")
		  {
			$nRe = mysql_query($mSQL);
			$mRe = mysql_fetch_assoc($nRe);
		  ?>
          <tr height="22"> 
            <td colspan="12" align="center" style="border:1px solid #000000; font-weight: bold">T O T A L</td>
            <td style="border: 1px solid #000000; text-align:center; font-weight:bold"><?=fConvertToRupiahBulat($iG-1)?></td>
            <td style="border: 1px solid #000000; text-align:right; font-weight:bold"><?=fConvertToRupiah($mRe['JmlG'])?></td>
          </tr>
		  <?php } ?>
        </table>		  </td>
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
			<?php } ?>			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>

</body>

</html>

<?php require('Connection_Close.php');?>
