<?php
require "Connection.php";
require "FileFunction.php";
extract($_GET);
$rTH = $_GET['rTH'];
$rAS = $_GET['rAS'];

$uNT = $_GET['uNT'];
$uSU = $_GET['uSU'];
$uUP = $_GET['uUP'];

require "Lap_Footer.php";

if($uUP!="All") {
	$uNT=$uUP;
}
else {
	if($uSU!="All") {
		$uNT=$uSU;
	}
	else {
		$uNT=$uNT;
	}
}

$gUnt  = $uNT;

$frHri = $gHriC;
$frBln = $gBlnC;
$frThn = $gThnC;

?>
<body>
<table border="0" align="center" cellspacing="0" style="width:1050px; font-size: 8pt; font-family: Calibri; border-collapse: collapse">
  <tr>
    <td>
	<table border="0" align="center" width="1050" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
	<tr>
	  <td colspan="3" align="center" style="font-size: 13pt; font-weight: bold">REKAPITULASI DATA PENYUSUTAN</td>
	</tr>
	<tr>
	  <td colspan="3" align="center" style="font-size: 11pt; font-weight: bold">SEMUA ASET</td>
	</tr>
	<tr>
	  <td colspan="3" align="center" style="font-size: 10pt; font-weight: normal">PER 31 DESEMBER <?=$rTH?></td>
	</tr>
	<tr>
	  <td width="79" style="font-size: 10pt; font-weight: normal">UNIT KERJA </td>
	  <td width="17" style="font-size: 10pt; font-weight: normal">:</td>
	  <td width="944" style="font-size: 10pt; font-weight: normal"><?=strtoupper(fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",$_GET['uNT'],"=","",DatabaseSB,$ConSB,""))?></td>
	</tr>
	<tr>
	  <td width="79" style="font-size: 10pt; font-weight: normal">SUB UNIT</td>
	  <td width="17" style="font-size: 10pt; font-weight: normal">:</td>
	  <td width="944" style="font-size: 10pt; font-weight: normal"><?php if ($_GET['uSU']=="All"){echo "Semua";}else{ echo strtoupper(fGlobalNEW("Nm_Sub","ref_sub_unit","Kd_Sub",$_GET['uSU'],"=","",DatabaseSB,$ConSB,""));}?></td>
	</tr>
	<tr>
	  <td width="79" style="font-size: 10pt; font-weight: normal">UPB</td>
	  <td width="17" style="font-size: 10pt; font-weight: normal">:</td>
	  <td width="944" style="font-size: 10pt; font-weight: normal"><?php if ($_GET['uUP']=="All"){echo "Semua";}else{echo strtoupper(fGlobalNEW("Nm_UPB","ref_upb","Kd_UPB",$_GET['uUP'],"=","",DatabaseSB,$ConSB,""));}?></td>
	</tr>
	<tr>
	  <td colspan="3">&nbsp;</td>
	</tr>
	</table>
	<table border="0" align="center" width="1050" cellspacing="0" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse">
	  <tr height="20">
		<td width="70" style="text-align:center; font-weight:bold; border:1px solid #000000">KODE</td>
		<td style="text-align:center; font-weight:bold; border:1px solid #000000">KELOMPOK</td>
		<td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000">NILAI <br>PEROLEHAN</td>
		<td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000">ATRIBUSI/<br>PENAMBAHAN</td>
		<td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000">AKUMULASI PENYUSUTAN S.D <br>TAHUN <?=((int)$rTH-1)?></td>
		<td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000">BEBAN PENYUSUTAN <br>TAHUN <?=$rTH?></td>
		<td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000">AKUMULASI PENYUSUTAN S.D <br>TAHUN <?=$rTH?></td>
		<td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000">NILAI BUKU</td>
	  </tr>
	  <tr height="20">
		<td style="text-align:center; border:1px solid #000000">1</td>
		<td style="text-align:center; border:1px solid #000000">2</td>
		<td style="text-align:center; border:1px solid #000000">3</td>
		<td style="text-align:center; border:1px solid #000000">4</td>
		<td style="text-align:center; border:1px solid #000000">5</td>
		<td style="text-align:center; border:1px solid #000000">6</td>
		<td style="text-align:center; border:1px solid #000000">7</td>
		<td style="text-align:center; border:1px solid #000000">8</td>
	  </tr>
		<?php
		$iG=1;
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset1 ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$Col01 = $mRo['Kd_Aset'];
			$Col02 = strtoupper($mRo['Nm_Aset']);
			$TbL   = fNmHuruf((int)$Col01);
			if ($TbL=='a' || $TbL=='e' || $TbL=='f' || $TbL=='g') 
			{
				$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_".$TbL,"Kd_UPB:Tgl_Perolehan",$uNT."%:".$rTH."-12-31","LIKE:<=","",DatabaseSB,$ConSB,"");
				$Col04 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post","Kd_UPB:Kd_Aset:Tanggal:Crit",$uNT."%:".$Col01.".%:".$rTH."-12-31:SLD","LIKE:LIKE:<=:<>","",DatabaseSB,$ConSB,"");
				$Col05 = 0;
				$Col06 = 0;
				$Col07 = 0;;
				$Col08 = $Col03+$Col04;
			}
			else
			{
				$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_".$TbL,"Kd_UPB:Tgl_Perolehan",$uNT."%:".$rTH."-12-31","LIKE:<=","",DatabaseSB,$ConSB,"");
				$Col04 = fGlobalNEW("IfNull(sum(Nilai_Tambah),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap",$uNT."%:".$Col01.".%:".$rTH,"LIKE:LIKE:<=","",DatabaseSB,$ConSB,"");
				$Col05 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan",$uNT."%:".$Col01.".%:".((int)$rTH-1).":Y:IV","LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
				$Col06 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap",$uNT."%:".$Col01.".%:".$rTH,"LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
				$Col07 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan",$uNT."%:".$Col01.".%:".$rTH.":Y:IV","LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
				$Col08 = fGlobalNEW("IfNull(sum(Nilai_Buku),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan",$uNT."%:".$Col01.".%:".$rTH.":Y:IV","LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
			}
			$tCol03 = $tCol03 + $Col03;
			$tCol04 = $tCol04 + $Col04;
			$tCol05 = $tCol05 + $Col05;
			$tCol06 = $tCol06 + $Col06;
			$tCol07 = $tCol07 + $Col07;
			$tCol08 = $tCol08 + $Col08;
			
			
			if ((int)$crt > 1) 
			{
				$xB="<b>";
				if ($iG>1) {RowBlank();}
			} 
			else 
			{
				$xB="";
			}
			
			RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,$xB);
			if ((int)$crt > 1) {
				SubData2($Col01,$TbL,$rTH,$uNT,$crt,DatabaseSB,$ConSB,'');
				$iG++;
			}
		}
		
		function SubData2($KdR,$TbL,$rTH,$uNT,$crt,$DatabaseSB,$ConSB,$xB)
		{
			$iGA=1;
			$nSQA = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset2 WHERE Kd_Aset LIKE '$KdR%' ORDER BY Kd_Aset";
			$nRsA = mysql_query($nSQA) or die(mysql_error());
			while ($mRoA = mysql_fetch_array($nRsA, MYSQL_BOTH))
			{
				$Col01 = $mRoA['Kd_Aset'];
				$Col02 = strtoupper($mRoA['Nm_Aset']);
				if ($TbL=='a' || $TbL=='e' || $TbL=='f' || $TbL=='g') 
				{
					$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_".$TbL,"Kd_UPB:Kd_Aset:Tgl_Perolehan",$uNT."%:".$Col01.".%:".$rTH."-12-31","LIKE:LIKE:<=","",$DatabaseSB,$ConSB,"");
					$Col04 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post","Kd_UPB:Kd_Aset:Tanggal:Crit",$uNT."%:".$Col01.".%:".$rTH."-12-31:SLD","LIKE:LIKE:<=:<>","",$DatabaseSB,$ConSB,"");
					$Col05 = 0;
					$Col06 = 0;
					$Col07 = 0;;
					$Col08 = $Col03+$Col04;
				}
				else
				{
					$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_".$TbL,"Kd_UPB:Kd_Aset:Tgl_Perolehan",$uNT."%:".$Col01.".%:".$rTH."-12-31","LIKE:LIKE:<=","",$DatabaseSB,$ConSB,"");
					$Col04 = fGlobalNEW("IfNull(sum(Nilai_Tambah),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap",$uNT."%:".$Col01.".%:".$rTH,"LIKE:LIKE:<=","",$DatabaseSB,$ConSB,"");
					$Col05 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan",$uNT."%:".$Col01.".%:".((int)$rTH-1).":Y:IV","LIKE:LIKE:=:=:=","",$DatabaseSB,$ConSB,"");
					$Col06 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap",$uNT."%:".$Col01.".%:".$rTH,"LIKE:LIKE:=","",$DatabaseSB,$ConSB,"");
					$Col07 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan",$uNT."%:".$Col01.".%:".$rTH.":Y:IV","LIKE:LIKE:=:=:=","",$DatabaseSB,$ConSB,"");
					$Col08 = fGlobalNEW("IfNull(sum(Nilai_Buku),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan",$uNT."%:".$Col01.".%:".$rTH.":Y:IV","LIKE:LIKE:=:=:=","",$DatabaseSB,$ConSB,"");
				}
				
				if ($Col03>0){
						
					if ((int)$crt > 2) 
					{
						$xB="<b>";
						if ($iGA>1) {RowBlank();}
					} 
					else 
					{
						$xB="";
					}
					
					RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,$xB);
					if ((int)$crt > 2) {
						SubData3($Col01,$TbL,$rTH,$uNT,$crt,$DatabaseSB,$ConSB,'');
					}
					$iGA++;
				}
			}
		}
		
		function SubData3($KdR,$TbL,$rTH,$uNT,$crt,$DatabaseSB,$ConSB,$xB)
		{
			$iGB=1;
			$nSQB = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset3 WHERE Kd_Aset LIKE '$KdR%' ORDER BY Kd_Aset";
			$nRsB = mysql_query($nSQB) or die(mysql_error());
			while ($mRoB = mysql_fetch_array($nRsB, MYSQL_BOTH))
			{
				$Col01 = $mRoB['Kd_Aset'];
				$Col02 = $mRoB['Nm_Aset'];
				if ($TbL=='a' || $TbL=='e' || $TbL=='f' || $TbL=='g') 
				{
					$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_".$TbL,"Kd_UPB:Kd_Aset:Tgl_Perolehan",$uNT."%:".$Col01.".%:".$rTH."-12-31","LIKE:LIKE:<=","",$DatabaseSB,$ConSB,"");
					$Col04 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post","Kd_UPB:Kd_Aset:Tanggal:Crit",$uNT."%:".$Col01.".%:".$rTH."-12-31:SLD","LIKE:LIKE:<=:<>","",$DatabaseSB,$ConSB,"");
					$Col05 = 0;
					$Col06 = 0;
					$Col07 = 0;;
					$Col08 = $Col03+$Col04;
				}
				else
				{
					$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_".$TbL,"Kd_UPB:Kd_Aset:Tgl_Perolehan",$uNT."%:".$Col01.".%:".$rTH."-12-31","LIKE:LIKE:<=","",$DatabaseSB,$ConSB,"");
					$Col04 = fGlobalNEW("IfNull(sum(Nilai_Tambah),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap",$uNT."%:".$Col01.".%:".$rTH,"LIKE:LIKE:<=","",$DatabaseSB,$ConSB,"");
					$Col05 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan",$uNT."%:".$Col01.".%:".((int)$rTH-1).":Y:IV","LIKE:LIKE:=:=:=","",$DatabaseSB,$ConSB,"");
					$Col06 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap",$uNT."%:".$Col01.".%:".$rTH,"LIKE:LIKE:=","",$DatabaseSB,$ConSB,"");
					$Col07 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan",$uNT."%:".$Col01.".%:".$rTH.":Y:IV","LIKE:LIKE:=:=:=","",$DatabaseSB,$ConSB,"");
					$Col08 = fGlobalNEW("IfNull(sum(Nilai_Buku),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan",$uNT."%:".$Col01.".%:".$rTH.":Y:IV","LIKE:LIKE:=:=:=","",$DatabaseSB,$ConSB,"");
				}
				
				if ($Col03>0){
					if ((int)$crt > 3) 
					{
						$xB="<b>";
						if ($iGB>1) {RowBlank();}
					} 
					else 
					{
						$xB="";
					}
					
					RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,$xB);
					if ((int)$crt > 3) {
						SubData4($Col01,$TbL,$rTH,$uNT,$crt,$DatabaseSB,$ConSB,'');
					}
					$iGB++;
				}
			}
		}		
		
		function SubData4($KdR,$TbL,$rTH,$uNT,$crt,$DatabaseSB,$ConSB,$xB)
		{
			$nSQC = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset4 WHERE Kd_Aset LIKE '$KdR%' ORDER BY Kd_Aset";
			$nRsC = mysql_query($nSQC) or die(mysql_error());
			while ($mRoC = mysql_fetch_array($nRsC, MYSQL_BOTH))
			{
				$Col01 = $mRoC['Kd_Aset'];
				$Col02 = $mRoC['Nm_Aset'];
				if ($TbL=='a' || $TbL=='e' || $TbL=='f' || $TbL=='g') 
				{
					$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_".$TbL,"Kd_UPB:Kd_Aset:Tgl_Perolehan",$uNT."%:".$Col01.".%:".$rTH."-12-31","LIKE:LIKE:<=","",$DatabaseSB,$ConSB,"");
					$Col04 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post","Kd_UPB:Kd_Aset:Tanggal:Crit",$uNT."%:".$Col01.".%:".$rTH."-12-31:SLD","LIKE:LIKE:<=:<>","",$DatabaseSB,$ConSB,"");
					$Col05 = 0;
					$Col06 = 0;
					$Col07 = 0;;
					$Col08 = $Col03+$Col04;
				}
				else
				{
					$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_".$TbL,"Kd_UPB:Kd_Aset:Tgl_Perolehan",$uNT."%:".$Col01.".%:".$rTH."-12-31","LIKE:LIKE:<=","",$DatabaseSB,$ConSB,"");
					$Col04 = fGlobalNEW("IfNull(sum(Nilai_Tambah),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap",$uNT."%:".$Col01.".%:".$rTH,"LIKE:LIKE:<=","",$DatabaseSB,$ConSB,"");
					$Col05 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan",$uNT."%:".$Col01.".%:".((int)$rTH-1).":Y:IV","LIKE:LIKE:=:=:=","",$DatabaseSB,$ConSB,"");
					$Col06 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap",$uNT."%:".$Col01.".%:".$rTH,"LIKE:LIKE:=","",$DatabaseSB,$ConSB,"");
					$Col07 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan",$uNT."%:".$Col01.".%:".$rTH.":Y:IV","LIKE:LIKE:=:=:=","",$DatabaseSB,$ConSB,"");
					$Col08 = fGlobalNEW("IfNull(sum(Nilai_Buku),0)","ta_kib_post_penyusutan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan",$uNT."%:".$Col01.".%:".$rTH.":Y:IV","LIKE:LIKE:=:=:=","",$DatabaseSB,$ConSB,"");
				}
				
				if ($Col03>0){
					RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,'');
				}
			}
		}		
		
		?>
	  <?php function RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,$xB) {?>
	  <tr height="25">
		<td style="border:1px solid #000000; text-align:left"><?=$xB.$Col01?></td>
		<td style="border:1px solid #000000; padding-left:5px"><?=$xB.$Col02?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col03)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col04)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col05)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col06)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col07)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col08)?></td>
	  </tr>
	  <?php
	  }
	  ?>
	  <?php function RowBlank() {?>
	  <tr height="22">
		<td style="border:1px solid #000000; text-align:left">&nbsp;</td>
		<td style="border:1px solid #000000; padding-left:5px">&nbsp;</td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px">&nbsp;</td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px">&nbsp;</td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px">&nbsp;</td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px">&nbsp;</td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px">&nbsp;</td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px">&nbsp;</td>
	  </tr>
	  <?php
	  }
	  ?>
	  <tr height="30">
		<td colspan="2" style="border:1px solid #000000; font-weight:bold; text-align:center">T O T A L</td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol03)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol04)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol05)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol06)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol07)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol08)?></td>
	  </tr>
	</table>
    </td>
  </tr>
</table>
<table border="0" align="center" width="1050" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td valign="top" width="400">
	<table border="0" align="center" width="400" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse">
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td width="21">a.</td>
	  <td width="202"> Nilai Perolehan <i>( 3 + 4 ) </i></td>
	  <td width="19">=</td>
	  <td width="145" style="text-align:right"><?=fConvertToRupiah($tCol03+$tCol04)?></td>
	  </tr>
	<tr>
	  <td>b.</td>
	  <td>Beban Penyusutan Tahun <?=$rTH?>
		<i>(  6 ) </i></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tCol06)?></td>
	  </tr>
	<tr>
	  <td>c.</td>
	  <td>Koreksi di LPE <i>( 5 ) </i></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tCol05)?></td>
	  </tr>
	<tr>
	  <td>d.</td>
	  <td>Akumulasi Penyusutan <i>( b + c )</i></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tCol07)?></td>
	  </tr>
	<tr>
	  <td>e.</td>
	  <td>Nilai Akhir Buku <i>( a - d )</i></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tCol08)?></td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	</table>
  <td width="40">&nbsp;</td>
  <td></td>
</tr>
<tr>
  <td colspan="3" valign="top"><?php require "Lap_Bottom2.php"?></tr>
</table>
</body>