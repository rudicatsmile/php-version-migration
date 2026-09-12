<?php
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";

ini_set('max_execution_time', 300);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
$gRf = "ATL";
extract($_GET);

if (isset($_GET['gExt'])){$gExt=$_GET['gExt'];}
if ($gExt=="All" || $gExt=="") {$gExt="%";}
	
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
		<?php if ($gHeA!="NO") {?>
			<tr>
				<td style="font-size: 13pt; font-weight: bold" align="center">KARTU INVENTARIS BARANG (KIB E)</td>
			</tr>
			<tr>
				<td style="font-size: 13pt; font-weight: bold" align="center"> ASET TETAP LAINNYA <?php if ($gExt=="Y") {echo "(EXTRA KOMTABLE)";}?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<?php } ?>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
              <tr>
                <td width="96">UNIT KERJA</td>
                <td width="18">:</td>
                <td width="486"><?=$gNmUNT ?></td>
                <td width="109"><?php if ($CriT=="BPK") {echo "KELOMPOK";}?></td>
                <td width="20"><?php if ($CriT=="BPK") {echo ":";}?></td>
                <td width="448"><?php if ($CriT=="BPK") {echo $gNmKEL;}?></td>
              </tr>
              <?php if ($gUnt!="All") { ?>
              <tr>
                <td width="96">SUB UNIT</td>
                <td width="18">:</td>
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
                <td width="96"><?php if ($CriT!="BPK") {echo "KODE LOKASI";} else {echo "TAHUN";}?></td>
                <td width="18"><?=":"?></td>
                <td><?php if ($CriT!="BPK") {echo "$gLok";} else {echo $gThn;}?></td>
                <td><?php if ($CriT=="BPK") {echo "RINCIAN OBJEK";}?></td>
                <td><?php if ($CriT=="BPK") {echo ":";}?></td>
                <td><?php if ($CriT=="BPK") {echo $gNmRIN;}?></td>
              </tr>
              <?php } else {?>
              <tr>
                <td width="96">TAHUN</td>
                <td width="18">:</td>
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
		  <table border="0" width="1300" style="border:0 solid #000000; font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table2" bordercolor="#000000">
          <tr> 
            <td width="25" rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">NO</td>
            <td width="13" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">JENIS BARANG / NAMA BARANG</td>
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold">NOMOR</td>
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold">BUKU / PERPUSTAKAAN</td>
            <td colspan="3" align="center" style="border:1px solid #000000; font-weight: bold">BARANG BERCORAK KESENIAN / KEBUDAYAAN</td>
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold">HEWAN / TERNAK DAN TUMBUHAN</td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center" width="6%">JUMLAH</td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center" width="6%">TAHUN CETAK / PEMBELIAN</td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center" width="6%">ASAL - USUL</td>
            <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center" width="6%">HARGA (Rp)</td>
            <td rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">KETERANGAN</td>
          </tr>
          <tr> 
            <td width="40" align="center" style="border:1px solid #000000; font-weight: bold">KODE BARANG </td>
            <td width="40" align="center" style="border:1px solid #000000; font-weight: bold">REGISTER</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="6%">JUDUL/ PENCIPTA</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">SPESIFIKASI</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">ASAL DAERAH </td>
            <td width="40" align="center" style="border:1px solid #000000; font-weight: bold">PENCIPTA</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="6%">BAHAN</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="6%">JENIS</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="5%">UKURAN</td>
          </tr>
          <tr> 
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="2%">1</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="13%">2</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="4%">3</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="4%">4</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="6%">5</td>
            <td width="5%" align="center" style="border:1px solid #000000; font-weight: bold">6</td>
            <td width="5%" align="center" style="border:1px solid #000000; font-weight: bold">7</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="4%">8</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="6%">9</td>
            <td width="6%" align="center" style="border:1px solid #000000; font-weight: bold">10</td>
            <td width="5%" align="center" style="border:1px solid #000000; font-weight: bold">11</td>
            <td width="6%" align="center" style="border:1px solid #000000; font-weight: bold">12</td>
            <td width="6%" align="center" style="border:1px solid #000000; font-weight: bold">13</td>
            <td width="6%" align="center" style="border:1px solid #000000; font-weight: bold">14</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="6%">15</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">16</td>
          </tr>
          <?php
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
		if ($gFin!="")
		{
			$fFindSy = "AND (No_Pengadaan LIKE '%".$gFin."%' OR Nm_Aset LIKE '%".$gFin."%' OR Harga LIKE '%".$gFin."%' OR Referensi LIKE '%".$gFin."%' OR Kd_Aset_108 LIKE '%".$gFin."%' OR Keterangan LIKE '%".$gFin."%')";
			$fFindSm = "AND (P1.No_Pengadaan LIKE '%".$gFin."%' OR P2.Nm_Aset LIKE '%".$gFin."%' OR P2.Harga LIKE '%".$gFin."%' OR P2.Referensi LIKE '%".$gFin."%' OR P2.Kd_Aset_108 LIKE '%".$gFin."%' OR P2.Keterangan LIKE '%".$gFin."%')";
		}
		else
		{
			$fFindSy = "";
			$fFindSm = "";
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
			
			if ($gThnA){
				$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND (Tgl_Perolehan BETWEEN '".$gThnA."-01-01' AND '".$gThn."-12-31') ".$fFindSy." 
				GROUP BY Referensi, Ref_Group, Kd_UPB 
				ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
			}
			else{
				$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." 
				GROUP BY Referensi, Ref_Group, Kd_UPB 
				ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
			}
		}
		else
		{
			if ($rIDT!="") {
				$nSQL= "SELECT * FROM ta_kib_108 WHERE IDT='".$rIDT."' ".$fFindSy." ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
			}
			else {
				
				if ($gLmT=="YA")
				{
					$iG  = $gReC+1;
					if ($gThnA){
						$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gThnA."-01-01' AND '".$gThn."-12-31') AND Status='' 
						".$fFindSy." GROUP BY Referensi, Ref_Group, Kd_UPB 
						ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register LIMIT ".$gReC.",5000";
					
						$mSQL= "SELECT IfNull(sum(P1.debet),0) as JmlG 
						FROM ta_kib_post_108 P1 
						JOIN ta_kib_108 P2 ON P2.Referensi=P1.Referensi AND P2.extracom=P1.extracom 
						AND P2.Kd_UPB=P1.Kd_UPB 
						AND P2.Kd_Aset_108=P1.Kd_Aset_108 
						AND P2.No_Register=P1.No_Register 
						AND P2.Ref_Group=P1.Ref_Group 
						WHERE P1.referensi LIKE '$gRf%' AND P1.extracom LIKE '".$gExt."' AND P1.Kd_UPB LIKE '".$gUpb."' 
						".$fFindSm." AND (P1.Tanggal BETWEEN '".$gThnA."-01-01' AND '".$gThn."-12-31')";
						#echo "1.".$mSQL."<br>";
						
					}
					else{
						$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Tgl_Perolehan LIKE '".$gThn."-__-__' AND Status='' 
						".$fFindSy." GROUP BY Referensi, Ref_Group, Kd_UPB 
						ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register LIMIT ".$gReC.",5000";
					
						$mSQL= "SELECT IfNull(sum(P1.debet),0) as JmlG 
						FROM ta_kib_post_108 P1 
						JOIN ta_kib_108 P2 ON P2.Referensi=P1.Referensi AND P2.extracom=P1.extracom 
						AND P2.Kd_UPB=P1.Kd_UPB 
						AND P2.Kd_Aset_108=P1.Kd_Aset_108 
						AND P2.No_Register=P1.No_Register 
						AND P2.Ref_Group=P1.Ref_Group 
						WHERE P1.referensi LIKE '$gRf%' AND P1.extracom LIKE '".$gExt."' AND P1.Kd_UPB LIKE '".$gUpb."' 
						".$fFindSm." AND P1.Tanggal LIKE '".$gThn."-__-__'";
						#echo "2.".$mSQL."<br>";
					}
				}
				else
				{
					if ($gThnA){
						$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gThnA."-01-01' AND '".$gThn."-12-31') AND Status='' 
						".$fFindSy." GROUP BY Referensi, Ref_Group, Kd_UPB 
						ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";	//asli
					}
					else{
						$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Tgl_Perolehan LIKE '".$gThn."-__-__' AND AND Status='' 
						".$fFindSy." GROUP BY Referensi, Ref_Group, Kd_UPB 
						ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";	//asli
					}
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
				$Col[1] = fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$mRo['Kd_Aset_108'],"=","","");
				if ($mRo['Nm_Aset']) {
					$Col[1].= " (<i> ".$mRo['Nm_Aset']." </i>)";
				}
				$Col[1].= "<br>".$mRo['Referensi'];
				$Col[2] = $mRo['Kd_Aset_108'];
				$Col[3] = $mRo['No_Register'];
				$Col[4] = $mRo['Judul'];
				$Col[5] = $mRo['Spesifikasi'];
				$Col[6] = $mRo['Daerah_Asal'];
				$Col[7] = $mRo['Pencipta'];
				$Col[8] = $mRo['Bahan'];
				$Col[9] = $mRo['Jenis'];
				$Col[10] = $mRo['Ukuran'];
				$Col[11] = "";
				$Col[12] = $mRo['Tahun'];
				if ($Col[12]!=0)
				{
					$Col[12] = $Col[12]." / ".substr($mRo['Tgl_Perolehan'],0,4);
				}
				else
				{
					$Col[12] = substr($mRo['Tgl_Perolehan'],0,4);
				}
				$Col[13] = $mRo['Asal_Usul'];
				
				$NoRG = $mRo['No_Register'];
				$gREF = $mRo['Referensi'];
				$rUPB = $mRo['Kd_UPB'];
				$rREG = $mRo['Ref_Group'];
				
				$gNIa = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB",$gREF.":".$rUPB,"=:=","","");
				$gNIb = 0;
				if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;}
				else {$gAKH=$gNIa;}
				$Col[14] = $gAKH;
				$Col[15] = $mRo['Keterangan'];
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
          <?php function ViewRincian($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16) {?>
          <tr> 
            <td width="2%" style="border: 1px solid #000000" valign="top" align="center"><?=fConvertToRupiahBulat($x0)?>.</td>
            <td width="13%" style="border: 1px solid #000000" valign="top"><?php echo $x1?></td>
            <td width="4%" style="border: 1px solid #000000" valign="top" align="center"><?php echo $x2?></td>
            <td width="4%" style="border: 1px solid #000000" valign="top" align="center"><?php echo $x3?></td>
            <td width="6%" style="border: 1px solid #000000" valign="top"><?php echo $x4?></td>
            <td width="5%" style="border: 1px solid #000000" valign="top"><?php echo $x5?></td>
            <td width="5%" style="border: 1px solid #000000" valign="top"><?php echo $x6?></td>
            <td width="4%" style="border: 1px solid #000000" valign="top"><?php echo $x7?></td>
            <td width="6%" style="border: 1px solid #000000" valign="top"><?php echo $x8?></td>
            <td width="6%" style="border: 1px solid #000000" valign="top"><?php echo $x9?></td>
            <td width="5%" style="border: 1px solid #000000" valign="top"><?php if ($x10!=0) {echo $x10;}?></td>
            <td width="6%" style="border: 1px solid #000000" valign="top"><?php echo $x11?></td>
            <td width="6%" style="border: 1px solid #000000" valign="top" align="center"><?php echo $x12?>
            </td>
            <td width="6%" style="border: 1px solid #000000" valign="top"><?php echo $x13?></td>
            <td width="6%" style="border: 1px solid #000000" valign="top" align="right"><?php echo fConvertToRupiah($x14)?></td>
            <td style="border: 1px solid #000000" valign="top"><?php echo $x15?></td>
          </tr>
          <?php } ?>
          <?php function ViewBlank() {?>
          <tr> 
            <td width="2%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="13%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="4%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="4%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="6%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="5%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="5%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="4%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="6%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="6%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="5%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="6%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="6%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="6%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="6%" style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
          </tr>
          <?php } ?>
          <tr> 
            <td style="border:1px solid #000000; font-weight: bold" align="center" colspan="14">
			<?php
			if ($gLmT=="YA"){
				echo "SUB TOTAL";
			}
			else{
				echo "T O T A L";
			}
			?>
			</td>
            <td width="6%" style="border:1px solid #000000; font-weight: bold" align="right"><?php echo fConvertToRupiah($gHrg)?></td>
            <td style="border: 1px solid #000000">&nbsp;</td>
          </tr>
		  <?php 
		  if ($gLmT=="YA" && $LoadEND=="YA")
		  {
			$nRe = mysql_query($mSQL);
			$mRe = mysql_fetch_assoc($nRe);
		  ?>
          <tr> 
            <td style="border:1px solid #000000; font-weight: bold" align="center" colspan="14">T O T A L</td>
            <td width="6%" style="border:1px solid #000000; font-weight: bold" align="right"><?=fConvertToRupiah($mRe['JmlG'])?></td>
            <td style="border: 1px solid #000000">&nbsp;</td>
          </tr>
		  <?php } ?>
        </table>			
			</td>
		</tr>
		<tr>
			<td style="font-family: Calibri Narrow; font-style: italic">&nbsp;</td>
		</tr>
		<?php if ($gTtD!="NO") {?>
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
		<?php } ?>
	</table>
</div>

</body>

</html>

<?php require('Connection_Close.php');?>
