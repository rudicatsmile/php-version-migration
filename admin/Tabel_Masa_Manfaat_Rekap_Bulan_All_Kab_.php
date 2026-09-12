<?php
require "Connection.php";
require "FileFunction.php";
extract($_GET);

$rTH = $_GET['rTH'];
$rAS = $_GET['rAS'];

$uNT = $_GET['uNT'];

require "Lap_Footer.php";

if ($uNT==""){
	$uNT="__.__.__.__";
}
$gUnt  = $uNT;

$frHri = $gHriC;
$frBln = $gBlnC;
$frThn = $gThnC;

$nMT="N";
$txt="";
if ($mts!=""){
	$txt="<br><font style='background:#000; color:#fff; font-size:9pt;font-style:italic'>&nbsp;( SUDAH MUTASI KE ASET LAINNYA )&nbsp;</font>";
	$nMT="Y";
}

?>
<body>
<table border="0" align="center" cellspacing="0" style="width:1050px; font-size: 8pt; font-family: Calibri; border-collapse: collapse">
  <tr>
    <td>
	<table border="0" align="center" width="1050" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
	<tr>
	  <td colspan="3" align="center" style="font-size: 13pt; font-weight: bold">REKAPITULASI ASET</td>
	</tr>
	<tr>
	  <td colspan="3" align="center" style="font-size: 11pt; font-weight: bold">SEMUA ASET<?=$txt?></td>
	</tr>
	<tr>
	  <td colspan="3" align="center" style="font-size: 10pt; font-weight: normal">PER 31 DESEMBER <?=$rTH?></td>
	</tr>
	<tr>
	  <td colspan="3">&nbsp;</td>
	</tr>
	</table>
	<table border="0" align="center" width="1050" cellspacing="0" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse">
	  <tr height="20">
		<td width="70" style="text-align:center; font-weight:bold; border:1px solid #000000">KODE</td>
		<td style="text-align:center; font-weight:bold; border:1px solid #000000">KELOMPOK</td>
		<td width="120" style="text-align:center; font-weight:bold; border:1px solid #000000">N I L A I <br>
		  PEROLEHAN</td>
		<td width="120" style="text-align:center; font-weight:bold; border:1px solid #000000">N I L A I<br>
		  ATRIBUSI</td>
		<td width="130" style="text-align:center; font-weight:bold; border:1px solid #000000">AKUMULASI PENYUSUTAN S.D <br>TAHUN <?=((int)$rTH-1)?></td>
		<td width="130" style="text-align:center; font-weight:bold; border:1px solid #000000">BEBAN PENYUSUTAN <br>TAHUN <?=$rTH?></td>
		<td width="130" style="text-align:center; font-weight:bold; border:1px solid #000000">AKUMULASI PENYUSUTAN S.D <br>TAHUN <?=$rTH?></td>
		<td width="130" style="text-align:center; font-weight:bold; border:1px solid #000000">NILAI BUKU</td>
	  </tr>
	  <tr height="20">
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">1</td>
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">2</td>
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">3</td>
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">4</td>
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">5</td>
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">6</td>
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">7</td>
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">8</td>
	  </tr>
		<?php
		$iG=1;
		if ($mts!=""){
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset1 WHERE Kd_Aset<> '07' ORDER BY Kd_Aset";
		}
		else{
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset1 ORDER BY Kd_Aset";
		}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$Col01 = $mRo['Kd_Aset'];
			$Col02 = strtoupper($mRo['Nm_Aset']);
			$TbL   = fNmHuruf((int)$Col01);
			$KdAsT = $Col01;
			if ($TbL=='a' || $TbL=='e' || $TbL=='f')
			{
				if ($mts){
					$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post".$mts,"Kd_UPB:Kd_Aset:Tanggal:extracom",$uNT."%:".$Col01.".%:".$rTH."-12-31:%","LIKE:LIKE:<=:LIKE","",DatabaseSB,$ConSB,"");
				}
				else{
					$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post".$mts,"Kd_UPB:Kd_Aset:Tanggal:extracom:KdpToAset",$uNT."%:".$Col01.".%:".$rTH."-12-31:%:N","LIKE:LIKE:<=:LIKE:=","",DatabaseSB,$ConSB,"");
				}
				$Col04 = 0;
				$Col05 = 0;
				$Col06 = 0;
				$Col07 = 0;
				$Col08 = $Col03+$Col04;
			}
			else
			{
				if ($TbL=='g'){
					$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post".$mts,"Kd_UPB:Tanggal:Kd_Aset:Crit:extracom",$uNT."%:".$rTH."-12-31:07%:%:N","LIKE:<=:LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
					$Col04 = fGlobalNEW("IfNull(sum(Nilai_Tambah),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":".$nMT,"LIKE:LIKE:<=:=","",DatabaseSB,$ConSB,"");
					$Col03 = $Col03-$Col04;
				}
				else{
					$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_".$TbL.$mts,"Kd_UPB:Tgl_Perolehan:extracom",$uNT."%:".$rTH."-12-31:N","LIKE:<=:=","",DatabaseSB,$ConSB,"");
					$Col04 = fGlobalNEW("IfNull(sum(Nilai_Tambah),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":".$nMT,"LIKE:LIKE:<=:=","",DatabaseSB,$ConSB,"");
				}
				$Col05 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:".$Col01.".%:".((int)$rTH-1).":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",DatabaseSB,$ConSB,"");
				$Col06 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":".$nMT,"LIKE:LIKE:=:=","",DatabaseSB,$ConSB,"");
				$Col07 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",DatabaseSB,$ConSB,"");
				if ($TbL=='g'){
					$Col08 = ($Col03+$Col04)-$Col07;
				}
				else{
					$Col08 = fGlobalNEW("IfNull(sum(Nilai_Buku),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",DatabaseSB,$ConSB,"");
				}
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
				SubData2($Col01,$TbL,$rTH,$uNT,$crt,$mts,$nMT,DatabaseSB,$ConSB,'');
				$iG++;
			}
		}
		
		function SubData2($KdR,$TbL,$rTH,$uNT,$crt,$mts,$nMT,$DatabaseSB,$ConSB,$xB)
		{
			$iGA=1;
			$nSQA = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset2 WHERE Kd_Aset LIKE '$KdR%' ORDER BY Kd_Aset";
			$nRsA = mysql_query($nSQA) or die(mysql_error());
			while ($mRoA = mysql_fetch_array($nRsA, MYSQL_BOTH))
			{
				$Col01 = $mRoA['Kd_Aset'];
				$Col02 = strtoupper($mRoA['Nm_Aset']);
				$KdAsT = $Col01;
				
				if ($TbL=='a' || $TbL=='e' || $TbL=='f' || $TbL=='g') 
				{
					$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post".$mts,"Kd_UPB:Kd_Aset:Tanggal:extracom",$uNT."%:".$Col01.".%:".$rTH."-12-31:N","LIKE:LIKE:<=:=","",$DatabaseSB,$ConSB,"");
					$Col04 = 0;
					$Col05 = 0;
					$Col06 = 0;
					$Col07 = 0;
					$Col08 = $Col03+$Col04;
					#$Col08 = $Col03;
				}
				else
				{
					$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_".$TbL.$mts,"Kd_UPB:Kd_Aset:Tgl_Perolehan:extracom",$uNT."%:".$Col01.".%:".$rTH."-12-31:N","LIKE:LIKE:<=:=","",$DatabaseSB,$ConSB,"");
					$Col04 = fGlobalNEW("IfNull(sum(Nilai_Tambah),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":".$nMT,"LIKE:LIKE:<=:=","",$DatabaseSB,$ConSB,"");
					#$Col03 = $Col03+$Col04;
					$Col05 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:".$Col01.".%:".((int)$rTH-1).":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",$DatabaseSB,$ConSB,"");
					$Col06 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":".$nMT,"LIKE:LIKE:=:=","",$DatabaseSB,$ConSB,"");
					$Col07 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",$DatabaseSB,$ConSB,"");
					$Col08 = fGlobalNEW("IfNull(sum(Nilai_Buku),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",$DatabaseSB,$ConSB,"");
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
						SubData3($Col01,$TbL,$rTH,$uNT,$crt,$mts,$nMT,$DatabaseSB,$ConSB,'');
					}
					$iGA++;
				}
			}
		}
		
		function SubData3($KdR,$TbL,$rTH,$uNT,$crt,$mts,$nMT,$DatabaseSB,$ConSB,$xB)
		{
			$iGB=1;
			$nSQB = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset3 WHERE Kd_Aset LIKE '$KdR%' ORDER BY Kd_Aset";
			$nRsB = mysql_query($nSQB) or die(mysql_error());
			while ($mRoB = mysql_fetch_array($nRsB, MYSQL_BOTH))
			{
				$Col01 = $mRoB['Kd_Aset'];
				$Col02 = $mRoB['Nm_Aset'];
				$KdAsT = $Col01;
				if ($TbL=='a' || $TbL=='e' || $TbL=='f' || $TbL=='g') 
				{
					$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post".$mts,"Kd_UPB:Kd_Aset:Tanggal:extracom",$uNT."%:".$Col01.".%:".$rTH."-12-31:N","LIKE:LIKE:<=:=","",$DatabaseSB,$ConSB,"");
					$Col04 = 0;
					$Col05 = 0;
					$Col06 = 0;
					$Col07 = 0;
					$Col08 = $Col03+$Col04;
					#$Col08 = $Col03;
				}
				else
				{
					$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_".$TbL.$mts,"Kd_UPB:Kd_Aset:Tgl_Perolehan:extracom",$uNT."%:".$Col01.".%:".$rTH."-12-31:N","LIKE:LIKE:<=:=","",$DatabaseSB,$ConSB,"");
					$Col04 = fGlobalNEW("IfNull(sum(Nilai_Tambah),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":".$nMT,"LIKE:LIKE:<=:=","",$DatabaseSB,$ConSB,"");
					#$Col03 = $Col03+$Col04;
					$Col05 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:".$Col01.".%:".((int)$rTH-1).":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",$DatabaseSB,$ConSB,"");
					$Col06 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":".$nMT,"LIKE:LIKE:=:=","",$DatabaseSB,$ConSB,"");
					$Col07 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",$DatabaseSB,$ConSB,"");
					$Col08 = fGlobalNEW("IfNull(sum(Nilai_Buku),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",$DatabaseSB,$ConSB,"");
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
						SubData4($Col01,$TbL,$rTH,$uNT,$crt,$mts,$nMT,$DatabaseSB,$ConSB,'');
					}
					$iGB++;
				}
			}
		}		
		
		function SubData4($KdR,$TbL,$rTH,$uNT,$crt,$mts,$nMT,$DatabaseSB,$ConSB,$xB)
		{
			$nSQC = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset4 WHERE Kd_Aset LIKE '$KdR%' ORDER BY Kd_Aset";
			$nRsC = mysql_query($nSQC) or die(mysql_error());
			while ($mRoC = mysql_fetch_array($nRsC, MYSQL_BOTH))
			{
				$Col01 = $mRoC['Kd_Aset'];
				$Col02 = $mRoC['Nm_Aset'];
				$KdAsT = $Col01;
				if (substr($KdAsT,0,2)=="02" || substr($KdAsT,0,2)=="03")
				{
					$sYt = ":extracom";
					$nIL = ":N";
					$oPr = ":=";
				}
				else{
					$sYt = "";
					$nIL = "";
					$oPr = "";
				}
				if ($TbL=='a' || $TbL=='e' || $TbL=='f' || $TbL=='g') 
				{
					$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post".$mts,"Kd_UPB:Kd_Aset:Tanggal:extracom",$uNT."%:".$Col01.".%:".$rTH."-12-31:N","LIKE:LIKE:<=:=","",$DatabaseSB,$ConSB,"");
					$Col04 = 0;
					$Col05 = 0;
					$Col06 = 0;
					$Col07 = 0;
					$Col08 = $Col03+$Col04;
					#$Col08 = $Col03;
				}
				else
				{
					$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_".$TbL.$mts,"Kd_UPB:Kd_Aset:Tgl_Perolehan:extracom",$uNT."%:".$Col01.".%:".$rTH."-12-31:N","LIKE:LIKE:<=:=","",$DatabaseSB,$ConSB,"");
					$Col04 = fGlobalNEW("IfNull(sum(Nilai_Tambah),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":".$nMT,"LIKE:LIKE:<=:=","",$DatabaseSB,$ConSB,"");
					#$Col03 = $Col03+$Col04;
					$Col05 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:".$Col01.".%:".((int)$rTH-1).":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",$DatabaseSB,$ConSB,"");
					$Col06 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":".$nMT,"LIKE:LIKE:=:=","",$DatabaseSB,$ConSB,"");
					$Col07 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",$DatabaseSB,$ConSB,"");
					$Col08 = fGlobalNEW("IfNull(sum(Nilai_Buku),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:".$Col01.".%:".$rTH.":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",$DatabaseSB,$ConSB,"");
				}
				
				if ($Col03>0){
					RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,'');
				}
			}
		}		
		
		?>
	  <?php function RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,$xB) {?>
	  <?php
		$eCek = ($Col03+$Col04)-$Col07;
		$eCL = "";
		if (round($eCek,2)>round($Col08,2)){
			$eCL = "; color:#0000ff";
		}
		else if (round($eCek,2)<round($Col08,2)){
			$eCL = "; color:#ff0000";
		}
	  ?>
	  <tr height="22">
		<td style="border:1px solid #000000; text-align:left; padding-left:9px"><?=$xB.$Col01?></td>
		<td style="border:1px solid #000000; padding-left:5px"><?=$xB.$Col02?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col03)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col04)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col05)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col06)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col07)?></td>
		<td title="<?=fConvertToRupiah(round($eCek-$Col08,2))?>" style="border:1px solid #000000; text-align:right; padding-right:3px <?=$eCL?>"><?=$xB.fConvertToRupiah($Col08)?></td>
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
		<td colspan="2" style="border:1px solid #000000; border-top:3px double #000000; font-weight:bold; text-align:center">T O T A L</td>
		<td style="border:1px solid #000000; border-top:3px double #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol03)?></td>
		<td style="border:1px solid #000000; border-top:3px double #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol04)?></td>
		<td style="border:1px solid #000000; border-top:3px double #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol05)?></td>
		<td style="border:1px solid #000000; border-top:3px double #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol06)?></td>
		<td style="border:1px solid #000000; border-top:3px double #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol07)?></td>
		<td style="border:1px solid #000000; border-top:3px double #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol08)?></td>
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
	  <td width="202"> Nilai Perolehan <i>( 3 ) </i></td>
	  <td width="19">=</td>
	  <td width="145" style="text-align:right"><?=fConvertToRupiah($tCol03+$tCol04)?></td>
	  </tr>
	<tr>
	  <td>b.</td>
	  <td>Beban Penyusutan Tahun <?=$rTH?>
		<i>(  5 ) </i></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tCol06)?></td>
	  </tr>
	<tr>
	  <td>c.</td>
	  <td>Koreksi di LPE <i>( 4 ) </i></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tCol05)?></td>
	  </tr>
	<tr>
	  <td>d.</td>
	  <td>Akumulasi Penyusutan <i>( b + c )</i></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tCol07)?></td>
	</tr>
	<?php
	if (round(($tCol03+$tCol04-$tCol07),2) < round($tCol08,2)){
		$cL="; color:#ff0000";
		#$cL="";
	}
	else if (round(($tCol03+$tCol04-$tCol07),2) > round($tCol08,2)){
		$cL="; color:#0000ff";
		#$cL="";
	}
	else{
		$cL="";
	}
	?>
	<tr>
	  <td>e.</td>
	  <td>Nilai Akhir Buku <i>( a - d )</i></td>
	  <td>=</td>
	  <td style="text-align:right <?=$cL?>"><?=fConvertToRupiah($tCol08)?></td>
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
  <td colspan="3" valign="top"><?php require "Lap_Bottom3.php"?></td>
</tr>
</table>
</body>