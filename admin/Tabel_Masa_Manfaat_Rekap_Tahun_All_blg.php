<?php
require "Connection.php";
require "FileFunction.php";
extract($_GET);
#echo "xxxxx ".$ExtR;
#return false;

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

$nMT="N";
$txt="";
if ($mts!=""){
	$txt="<br><font style='background:#000; color:#fff; font-size:9pt;font-style:italic'>&nbsp;( SUDAH MUTASI KE ASET LAINNYA )&nbsp;</font>";
	$nMT="Y";
}

if ($crt==1){$WiD=40; $PaD=0; $CeNT="center";}
if ($crt==2){$WiD=45; $PaD=5; $CeNT="left";}
if ($crt==3){$WiD=57; $PaD=5; $CeNT="left";}
if ($crt==4){$WiD=69; $PaD=5; $CeNT="left";}
if ($crt==5){$WiD=85; $PaD=5; $CeNT="left";}

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
	  <td colspan="3" align="center" style="font-size: 11pt; font-weight: bold">SEMUA ASET<?=$txt?> <?php if ($ExtR=="Y"){echo "( EXTRACOM )";} else {echo "( NON EXTRACOM )";} ?></td>
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
		<td width="<?=$WiD?>" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">KODE</td>
		<td rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">DESKRIPSI</td>
		<td colspan="3" style="text-align:center; font-weight:bold; border:1px solid #000000">NILAI ASET </td>
		<td width="100" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">AKUMULASI PENYUSUTAN S.D <br>TAHUN <?=((int)$rTH-1)?></td>
		<td width="100" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">BEBAN PENYUSUTAN <br>TAHUN <?=$rTH?></td>
		<td width="100" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">AKUMULASI PENYUSUTAN S.D <br>TAHUN <?=$rTH?></td>
		<td width="100" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">NILAI BUKU</td>
	  </tr>
	  <tr height="20">
	    <td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000"> PEROLEHAN </td>
	    <td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000">ATRIBUSI</td>
	    <td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000; background-color:#dbf1df">TOTAL</td>
	    </tr>
	  <tr height="20">
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">1</td>
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">2</td>
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">3</td>
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">4</td>
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000; background-color:#dbf1df">5</td>
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">6</td>
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">7</td>
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">8</td>
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">9</td>
	  </tr>
		<?php
		$iG=1;
		if ($mts!=""){
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '1.3.1%' OR Kd_Aset LIKE '1.3.2%' OR Kd_Aset LIKE '1.3.3%' OR Kd_Aset LIKE '1.3.4%' OR Kd_Aset LIKE '1.3.5%' OR Kd_Aset LIKE '1.3.6%' OR Kd_Aset LIKE '1.5.3%' OR Kd_Aset LIKE '1.5.4%' ORDER BY Kd_Aset";
		}
		else{
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '1.3.1%' OR Kd_Aset LIKE '1.3.2%' OR Kd_Aset LIKE '1.3.3%' OR Kd_Aset LIKE '1.3.4%' OR Kd_Aset LIKE '1.3.5%' OR Kd_Aset LIKE '1.3.6%' OR Kd_Aset LIKE '1.5.3%' OR Kd_Aset LIKE '1.5.4%' ORDER BY Kd_Aset";
		}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$Col01 = $mRo['Kd_Aset'];
			$Col02 = strtoupper($mRo['Nm_Aset']);
			$TbL   = substr($Col01,0,5);
			$KdAsT = $Col01;
			
			if ($TbL=='1.3.1' || $TbL=='1.3.6') 
			{
				if ($mts)
				{
					$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Kd_Aset_108:Tanggal:extracom",$uNT."%:".$Col01.".%:".$rTH."-12-31:".$ExtR,"LIKE:LIKE:<=:=","",DatabaseSB,$ConSB,"");
				}
				else
				{
					$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:extracom:KdpToAset",$uNT."%:".$Col01.".%:".$rTH."-12-31:".$ExtR.":N","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
				}
				$Col04 = 0;
				$Col05 = 0;
				$Col06 = 0;
				$Col07 = 0;
				$Col08 = $Col03+$Col04;
			}
			else
			{
				if ($TbL=='1.5.4')
				{
					$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Tanggal:Kd_Aset_108:Crit:extracom",$uNT."%:".$rTH."-12-31:1.5.4%:%:".$ExtR,"LIKE:<=:LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
					$Col04 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Kd_Aset_108:Tanggal:extracom:Crit",$uNT."%:".$Col01."%:".$rTH."-12-31:".$ExtR.":INV","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
					$Col03 = $Col03-$Col04;
				}
				else
				{
					$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_108".$mts,"Kd_UPB:Kd_Aset_108:Tgl_Perolehan:extracom",$uNT."%:".$Col01."%:".$rTH."-12-31:".$ExtR,"LIKE:LIKE:<=:=","",DatabaseSB,$ConSB,"");
					$Col04 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Kd_Aset_108:Tanggal:extracom:Crit",$uNT."%:".$Col01."%:".$rTH."-12-31:".$ExtR.":INV","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
				}
				$Col05 = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".((int)$rTH-1).":".$ExtR,"LIKE:LIKE:=:=","",DatabaseSB,$ConSB,"");
				$Col06 = fGlobalNEW("IfNull(sum(Penyusutan),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=","",DatabaseSB,$ConSB,"");
				$Col07 = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=","",DatabaseSB,$ConSB,"");
				#$Col07 = $Col05+$Col06;
				#if ($TbL=='1.5.4')
				#{
					$Col08 = ($Col03+$Col04)-$Col07;
				#}
				#else{
					#$Col08 = fGlobalNEW("IfNull(sum(Nilai_Buku_Akhir),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
				#}
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
			
			RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,$CeNT,$PaD,$xB);
			if ((int)$crt > 1) {
				SubData2($Col01,$TbL,$rTH,$uNT,$crt,$mts,$nMT,$ExtR,DatabaseSB,$ConSB,$CeNT,$PaD,'');
				$iG++;
			}
		}
		
		function SubData2($KdR,$TbL,$rTH,$uNT,$crt,$mts,$nMT,$ExtR,$DatabaseSB,$ConSB,$CeNT,$PaD,$xB)
		{
			$iGA=1;
			$nSQA = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '$KdR%' ORDER BY Kd_Aset";

			$nSQA = "SELECT left(P1.Kd_Aset_108,8) as Kd_Aset, P2.Nm_Aset 
			FROM ta_kib_108 P1 LEFT JOIN ref_rek_aset108_4 P2 ON P2.Kd_Aset = left(P1.Kd_Aset_108,8) 
			WHERE P1.Kd_Aset_108 LIKE '".$KdR."%' AND P1.Kd_UPB LIKE '".$uNT."%' 
			GROUP BY left(P1.Kd_Aset_108,8) 
			ORDER BY left(P1.Kd_Aset_108,8)";
			#echo $nSQA."<br>";
			$nRsA = mysql_query($nSQA) or die(mysql_error());
			while ($mRoA = mysql_fetch_array($nRsA, MYSQL_BOTH))
			{
				$Col01 = $mRoA['Kd_Aset'];
				$Col02 = strtoupper($mRoA['Nm_Aset']);
				$KdAsT = $Col01;
				
				if ($TbL=='1.3.1' || $TbL=='1.3.6') 
				{
					if ($mts)
					{
						$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Kd_Aset_108:Tanggal:extracom",$uNT."%:".$Col01.".%:".$rTH."-12-31:".$ExtR,"LIKE:LIKE:<=:=","",DatabaseSB,$ConSB,"");
					}
					else
					{
						$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:extracom:KdpToAset",$uNT."%:".$Col01.".%:".$rTH."-12-31:".$ExtR.":N","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
					}
					$Col04 = 0;
					$Col05 = 0;
					$Col06 = 0;
					$Col07 = 0;
					$Col08 = $Col03+$Col04;
				}
				else
				{
					if ($TbL=='1.5.4')
					{
						$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Tanggal:Kd_Aset_108:Crit:extracom",$uNT."%:".$rTH."-12-31:".$Col01."%:%:".$ExtR,"LIKE:<=:LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
						$Col04 = fGlobalNEW("IfNull(sum(debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Kd_Aset_108:Tanggal:extracom:Crit",$uNT."%:".$Col01."%:".$rTH."-12-31:".$ExtR.":INV","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
						$Col03 = $Col03-$Col04;
					}
					else
					{
						$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_108".$mts,"Kd_UPB:Kd_Aset_108:Tgl_Perolehan:extracom",$uNT."%:".$Col01."%:".$rTH."-12-31:".$ExtR,"LIKE:LIKE:<=:=","",DatabaseSB,$ConSB,"");
						$Col04 = fGlobalNEW("IfNull(sum(debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Kd_Aset_108:Tanggal:extracom:Crit",$uNT."%:".$Col01."%:".$rTH."-12-31:".$ExtR.":INV","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
					}
					$Col05 = round(fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".((int)$rTH-1).":".$ExtR,"LIKE:LIKE:=:=","",DatabaseSB,$ConSB,""));
					$Col06 = round(fGlobalNEW("IfNull(sum(Penyusutan),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=","",DatabaseSB,$ConSB,""));
					$Col07 = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=","",DatabaseSB,$ConSB,"");
					#$Col07 = $Col05+$Col06;
					#if ($TbL=='1.5.4')
					#{
						$Col08 = ($Col03+$Col04)-$Col07;
					#}
					#else{
					#	$Col08 = fGlobalNEW("IfNull(sum(Nilai_Buku_Akhir),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
					#}
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
					
					RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,$CeNT,$PaD,$xB);
					if ((int)$crt > 2) {
						SubData3($Col01,$TbL,$rTH,$uNT,$crt,$mts,$nMT,$ExtR,$DatabaseSB,$ConSB,$CeNT,$PaD,'');
					}
					$iGA++;
				}
			}
		}
		
		function SubData3($KdR,$TbL,$rTH,$uNT,$crt,$mts,$nMT,$ExtR,$DatabaseSB,$ConSB,$CeNT,$PaD,$xB)
		{
			$iGB=1;
			$nSQB = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '$KdR%' ORDER BY Kd_Aset";
			
			$nSQB = "SELECT left(P1.Kd_Aset_108,11) as Kd_Aset, P2.Nm_Aset 
			FROM ta_kib_108 P1 LEFT JOIN ref_rek_aset108_5 P2 ON P2.Kd_Aset = left(P1.Kd_Aset_108,11) 
			WHERE P1.Kd_Aset_108 LIKE '".$KdR."%' AND P1.Kd_UPB LIKE '".$uNT."%' 
			GROUP BY left(P1.Kd_Aset_108,11) 
			ORDER BY left(P1.Kd_Aset_108,11)";
			#echo $nSQB."<br>";
			
			$nRsB = mysql_query($nSQB) or die(mysql_error());
			while ($mRoB = mysql_fetch_array($nRsB, MYSQL_BOTH))
			{
				$Col01 = $mRoB[0];
				$Col02 = $mRoB[1];
				$KdAsT = $Col01;
				
				if ($TbL=='1.3.1' || $TbL=='1.3.6') 
				{
					if ($mts)
					{
						$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Kd_Aset_108:Tanggal:extracom",$uNT."%:".$Col01.".%:".$rTH."-12-31:".$ExtR,"LIKE:LIKE:<=:=","",DatabaseSB,$ConSB,"");
					}
					else
					{
						$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:extracom:KdpToAset",$uNT."%:".$Col01.".%:".$rTH."-12-31:".$ExtR.":N","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
					}
					$Col04 = 0;
					$Col05 = 0;
					$Col06 = 0;
					$Col07 = 0;
					$Col08 = $Col03+$Col04;
				}
				else
				{
					if ($TbL=='1.5.4')
					{
						$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Tanggal:Kd_Aset_108:Crit:extracom",$uNT."%:".$rTH."-12-31:".$Col01."%:%:".$ExtR,"LIKE:<=:LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
						$Col04 = fGlobalNEW("IfNull(sum(debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Kd_Aset_108:Tanggal:extracom:Crit",$uNT."%:".$Col01."%:".$rTH."-12-31:".$ExtR.":INV","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
						$Col03 = $Col03-$Col04;
					}
					else
					{
						$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_108".$mts,"Kd_UPB:Kd_Aset_108:Tgl_Perolehan:extracom",$uNT."%:".$Col01."%:".$rTH."-12-31:".$ExtR,"LIKE:LIKE:<=:=","",DatabaseSB,$ConSB,"");
						$Col04 = fGlobalNEW("IfNull(sum(debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Kd_Aset_108:Tanggal:extracom:Crit",$uNT."%:".$Col01."%:".$rTH."-12-31:".$ExtR.":INV","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
					}
					$Col05 = round(fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".((int)$rTH-1).":".$ExtR,"LIKE:LIKE:=:=","",DatabaseSB,$ConSB,""));
					$Col06 = round(fGlobalNEW("IfNull(sum(Penyusutan),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=","",DatabaseSB,$ConSB,""));
					$Col07 = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=","",DatabaseSB,$ConSB,"");
					#$Col07 = $Col05+$Col06;
					#if ($TbL=='1.5.4')
					#{
						$Col08 = ($Col03+$Col04)-$Col07;
					#}
					#else{
					#	$Col08 = fGlobalNEW("IfNull(sum(Nilai_Buku_Akhir),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
					#}
				}
				
				if ($Col03 > 0){
					if ((int)$crt > 3) 
					{
						$xB="<b>";
						if ($iGB>1) {RowBlank();}
					} 
					else 
					{
						$xB="";
					}
					
					RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,$CeNT,$PaD,$xB);
					if ((int)$crt > 3) {
						SubData4($Col01,$TbL,$rTH,$uNT,$crt,$mts,$nMT,$ExtR,$DatabaseSB,$ConSB,$CeNT,$PaD,'');
					}
					$iGB++;
				}
			}
		}		
		
		function SubData4($KdR,$TbL,$rTH,$uNT,$crt,$mts,$nMT,$ExtR,$DatabaseSB,$ConSB,$CeNT,$PaD,$xB)
		{
			$iGC=1;
			$nSQC = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '$KdR%' ORDER BY Kd_Aset";
			
			$nSQC = "SELECT left(P1.Kd_Aset_108,14) as Kd_Aset, P2.Nm_Aset 
			FROM ta_kib_108 P1 LEFT JOIN ref_rek_aset108_6 P2 ON P2.Kd_Aset = left(P1.Kd_Aset_108,14) 
			WHERE P1.Kd_Aset_108 LIKE '".$KdR."%' AND P1.Kd_UPB LIKE '".$uNT."%' 
			GROUP BY left(P1.Kd_Aset_108,14) 
			ORDER BY left(P1.Kd_Aset_108,14)";
			#echo $nSQC."<br>";
			$nRsC = mysql_query($nSQC) or die(mysql_error());
			while ($mRoC = mysql_fetch_array($nRsC, MYSQL_BOTH))
			{
				$Col01 = $mRoC[0];
				$Col02 = $mRoC[1];
				$KdAsT = $Col01;
				if (substr($KdAsT,0,5)=="1.3.2" || substr($KdAsT,0,5)=="1.3.3")
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
				
				if ($TbL=='1.3.1' || $TbL=='1.3.6') 
				{
					if ($mts)
					{
						$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Kd_Aset_108:Tanggal:extracom",$uNT."%:".$Col01.".%:".$rTH."-12-31:".$ExtR,"LIKE:LIKE:<=:=","",DatabaseSB,$ConSB,"");
					}
					else
					{
						$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:extracom:KdpToAset",$uNT."%:".$Col01.".%:".$rTH."-12-31:".$ExtR.":N","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
					}
					$Col04 = 0;
					$Col05 = 0;
					$Col06 = 0;
					$Col07 = 0;
					$Col08 = $Col03+$Col04;
				}
				else
				{
					if ($TbL=='1.5.4')
					{
						$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Tanggal:Kd_Aset_108:Crit:extracom",$uNT."%:".$rTH."-12-31:".$Col01."%:%:".$ExtR,"LIKE:<=:LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
						$Col04 = fGlobalNEW("IfNull(sum(debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Kd_Aset_108:Tanggal:extracom:Crit",$uNT."%:".$Col01."%:".$rTH."-12-31:".$ExtR.":INV","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
						$Col03 = $Col03-$Col04;
					}
					else
					{
						$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_108".$mts,"Kd_UPB:Kd_Aset_108:Tgl_Perolehan:extracom",$uNT."%:".$Col01."%:".$rTH."-12-31:".$ExtR,"LIKE:LIKE:<=:=","",DatabaseSB,$ConSB,"");
						$Col04 = fGlobalNEW("IfNull(sum(debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Kd_Aset_108:Tanggal:extracom:Crit",$uNT."%:".$Col01."%:".$rTH."-12-31:".$ExtR.":INV","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
					}
					$Col05 = round(fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".((int)$rTH-1).":".$ExtR,"LIKE:LIKE:=:=","",DatabaseSB,$ConSB,""));
					$Col06 = round(fGlobalNEW("IfNull(sum(Penyusutan),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=","",DatabaseSB,$ConSB,""));
					$Col07 = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=","",DatabaseSB,$ConSB,"");
					#$Col07 = $Col05+$Col06;
					#if ($TbL=='1.5.4')
					#{
						$Col08 = ($Col03+$Col04)-$Col07;
					#}
					#else{
					#	$Col08 = fGlobalNEW("IfNull(sum(Nilai_Buku_Akhir),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.".%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
					#}
				}
				
				if ($Col03>0)
				{
					$xB="";
					if ((int)$crt > 4) {
						$xB="<b>";
						if ($iGC>1) {RowBlank();}
					}
					
					RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,$CeNT,$PaD,$xB);
					if ((int)$crt > 4) {
						SubData5($Col01,$TbL,$rTH,$uNT,$crt,$mts,$nMT,$ExtR,$DatabaseSB,$ConSB,$CeNT,$PaD,'');
					}
					$iGC++;
				}
			}
		}
		
		function SubData5($KdR,$TbL,$rTH,$uNT,$crt,$mts,$nMT,$ExtR,$DatabaseSB,$ConSB,$CeNT,$PaD,$xB)
		{
			$nSQD = "SELECT P1.Kd_Aset_108, P2.Nm_Aset 
			FROM ta_kib_108 P1 LEFT JOIN ref_rek_aset108_7 P2 ON P2.Kd_Aset = P1.Kd_Aset_108 
			WHERE P1.Kd_Aset_108 LIKE '$KdR%' AND P1.Kd_UPB LIKE '".$uNT."%' 
			GROUP BY Kd_Aset_108 ORDER BY P1.Kd_Aset_108";
			#echo $nSQD."<br>";
			$nRsD = mysql_query($nSQD);
			while ($mRoD = mysql_fetch_array($nRsD, MYSQL_BOTH))
			{
				$Col01 = $mRoD[0];
				$Col02 = $mRoD[1];
				$KdAsT = $Col01;
				if (substr($KdAsT,0,5)=="1.3.2" || substr($KdAsT,0,5)=="1.3.3")
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
				
				if ($TbL=='1.3.1' || $TbL=='1.3.6') 
				{
					if ($mts)
					{
						$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Kd_Aset_108:Tanggal:extracom",$uNT."%:".$Col01.":".$rTH."-12-31:".$ExtR,"LIKE:=:<=:=","",DatabaseSB,$ConSB,"");
					}
					else
					{
						$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:extracom:KdpToAset",$uNT."%:".$Col01.":".$rTH."-12-31:".$ExtR.":N","LIKE:=:<=:=:=","",DatabaseSB,$ConSB,"");
					}
					$Col04 = 0;
					$Col05 = 0;
					$Col06 = 0;
					$Col07 = 0;
					$Col08 = $Col03+$Col04;
				}
				else
				{
					if ($TbL=='1.5.4')
					{
						$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Tanggal:Kd_Aset_108:Crit:extracom",$uNT."%:".$rTH."-12-31:".$Col01.":%:".$ExtR,"LIKE:<=:=:LIKE:=","",DatabaseSB,$ConSB,"");
						$Col04 = fGlobalNEW("IfNull(sum(debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Kd_Aset_108:Tanggal:extracom:Crit",$uNT."%:".$Col01.":".$rTH."-12-31:".$ExtR.":INV","LIKE:=:<=:=:=","",DatabaseSB,$ConSB,"");
						$Col03 = $Col03-$Col04;
					}
					else
					{
						$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_108".$mts,"Kd_UPB:Kd_Aset_108:Tgl_Perolehan:extracom",$uNT."%:".$Col01.":".$rTH."-12-31:".$ExtR,"LIKE:=:<=:=","",DatabaseSB,$ConSB,"");
						$Col04 = fGlobalNEW("IfNull(sum(debet),0)","ta_kib_post_108".$mts,"Kd_UPB:Kd_Aset_108:Tanggal:extracom:Crit",$uNT."%:".$Col01.":".$rTH."-12-31:".$ExtR.":INV","LIKE:=:<=:=:=","",DatabaseSB,$ConSB,"");
					}
					$Col05 = round(fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.":".((int)$rTH-1).":".$ExtR,"LIKE:=:=:=","",DatabaseSB,$ConSB,""));
					$Col06 = round(fGlobalNEW("IfNull(sum(Penyusutan),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.":".$rTH.":".$ExtR,"LIKE:=:=:=","",DatabaseSB,$ConSB,""));
					$Col07 = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.":".$rTH.":".$ExtR,"LIKE:=:=:=","",DatabaseSB,$ConSB,"");
					#$Col07 = $Col05+$Col06;
					#if ($TbL=='1.5.4')
					#{
						$Col08 = ($Col03+$Col04)-$Col07;
					#}
					#else{
					#	$Col08 = fGlobalNEW("IfNull(sum(Nilai_Buku_Akhir),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:extracom",$uNT."%:".$Col01.":".$rTH.":".$ExtR,"LIKE:=:=:=:=","",DatabaseSB,$ConSB,"");
					#}
				}
				if ($Col03>0)
				{
					RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,$CeNT,$PaD,'');
				}
				
			}
			
		}
		
	  function RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,$CeNT,$PaD,$xB) 
	  {
	  $eCL="";
	  #if (round(($Col03+$Col04-$Col07),2) < round($Col08,2)){
	  
	  if ((($Col03+$Col04-$Col07) - $Col08) > 1) {
	  	$eCL="; color:#ff0000";
	  }
	  else if (round(($Col03+$Col04-$Col07),2) > round($Col08,2)){
	  #else if ((($Col03+$Col04-$Col07) != $Col08)){
	  	$eCL="; color:#0000ff";
	  }
	  ?>
	  <tr height="25">
		<td style="border:1px solid #000000; text-align:<?=$CeNT?>; padding-left:<?=$PaD?>px"><?=$xB.$Col01?></td>
		<td style="border:1px solid #000000; padding-left:5px"><?=$xB.$Col02?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col03)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col04)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px; background-color:#dbf1df"><?=$xB.fConvertToRupiah($Col03+$Col04)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col05)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col06)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col07)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px <?=$eCL?>"><?=$xB.fConvertToRupiah($Col08)?></td>
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
		<td style="border:1px solid #000000; text-align:right; padding-right:3px; background-color:#dbf1df">&nbsp;</td>
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
		<td style="border:1px solid #000000; border-top:3px double #000000; font-weight:bold; text-align:right; padding-right:3px; background-color:#dbf1df"><?=fConvertToRupiah($tCol03+$tCol04)?></td>
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
	<?php
	#if (round(($tCol03+$tCol04-$tCol07),2) < round($tCol08,2)){
	
	if (((($tCol03+$tCol04)-$tCol07) - $tCol08) >= 1){
		$cL="; color:#ff0000";
	}
	else if (round(($tCol03+$tCol04-$tCol07),2) > round($tCol08,2)){
		$cL="; color:#0000ff";
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
  <td valign="top">&nbsp;</td>
</tr>
<tr>
  <td colspan="3" valign="top"><?php require "Lap_Bottom2.php"?></td>
</tr>
<tr>
  <td colspan="3" valign="top">&nbsp;</td>
</tr>
<tr>
  <td colspan="3" valign="top">--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
</tr>
<tr>
  <td colspan="3" valign="top"><table border="0" align="left" width="600" cellspacing="1" style="font-size: 8pt; color:#999; font-family: Calibri; border-collapse: collapse">
    <tr>
      <td colspan="7">LOG REKAP DATA PENYUSUTAN : </td>
    </tr>
    <tr style="font-weight:bold; text-align:center">
      <td width="60" rowspan="2" style="border:1px solid #999">ASET<br>
        TAHUN</td>
      <td colspan="2" style="border:1px solid #999">KIB-B</td>
      <td colspan="2" style="border:1px solid #999">KIB-C</td>
      <td colspan="2" style="border:1px solid #999">KIB-D</td>
    </tr>
    <tr style="font-weight:bold; text-align:center">
      <td width="100" style="border:1px solid #999">Recorded</td>
      <td width="72" style="border:1px solid #999">Pencatat</td>
      <td width="100" style="border:1px solid #999">Recorded</td>
      <td width="72" style="border:1px solid #999">Pencatat</td>
      <td width="100" style="border:1px solid #999">Recorded</td>
      <td style="border:1px solid #999">Pencatat</td>
    </tr>
    <?php for ($iG=2018; $iG<=2020; $iG++) {
	$KibBR = fGlobalNEW("recorded","ta_kib_post_penyusutan_recorded_108","Kd_UPB:Kd_Bidang:Tahun",$uNT.":1.3.2:".$iG,"=:=:=","IDT DESC LIMIT 0,1",$DatabaseSB,$ConSB,"");
	$KibBP = fGlobalNEW("pencatat","ta_kib_post_penyusutan_recorded_108","Kd_UPB:Kd_Bidang:Tahun",$uNT.":1.3.2:".$iG,"=:=:=","IDT DESC LIMIT 0,1",$DatabaseSB,$ConSB,"");
	
	$KibCR = fGlobalNEW("recorded","ta_kib_post_penyusutan_recorded_108","Kd_UPB:Kd_Bidang:Tahun",$uNT.":1.3.3:".$iG,"=:=:=","IDT DESC LIMIT 0,1",$DatabaseSB,$ConSB,"");
	$KibCP = fGlobalNEW("pencatat","ta_kib_post_penyusutan_recorded_108","Kd_UPB:Kd_Bidang:Tahun",$uNT.":1.3.3:".$iG,"=:=:=","IDT DESC LIMIT 0,1",$DatabaseSB,$ConSB,"");
	
	$KibDR = fGlobalNEW("recorded","ta_kib_post_penyusutan_recorded_108","Kd_UPB:Kd_Bidang:Tahun",$uNT.":1.3.4:".$iG,"=:=:=","IDT DESC LIMIT 0,1",$DatabaseSB,$ConSB,"");
	$KibDP = fGlobalNEW("pencatat","ta_kib_post_penyusutan_recorded_108","Kd_UPB:Kd_Bidang:Tahun",$uNT.":1.3.4:".$iG,"=:=:=","IDT DESC LIMIT 0,1",$DatabaseSB,$ConSB,"");
	?>
    <tr>
      <td style="border:1px solid #999; text-align:center"><?=$iG?></td>
      <td style="border:1px solid #999; text-align:center"><?=$KibBR?></td>
      <td style="border:1px solid #999; text-align:center"><?=$KibBP?></td>
      <td style="border:1px solid #999; text-align:center"><?=$KibCR?></td>
      <td style="border:1px solid #999; text-align:center"><?=$KibCP?></td>
      <td style="border:1px solid #999; text-align:center"><?=$KibDR?></td>
      <td style="border:1px solid #999; text-align:center"><?=$KibDP?></td>
    </tr>
    <?php } ?>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table></td>
</tr>
</table>
</body>