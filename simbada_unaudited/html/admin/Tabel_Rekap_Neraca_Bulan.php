<?
require "Connection.php";
require "FileFunction.php";
extract($_GET);
$rTH = $_GET['rTH'];
$rAS = $_GET['rAS'];

$uNT = $_GET['uNT'];
require "Lap_Footer.php";
$gUnt  = $uNT;

if ($uNT=='All'){$uNT="";}
$frHri = 31;
$frBln = 12;
$frThn = $rTH;

?>
<body>
	<table border="0" align="center" width="1270" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
	<tr>
	  <td colspan="3" align="center" style="font-size: 13pt; font-weight: bold">REKAPITULASI NILAI ASET NERACA</td>
	</tr>
	<tr>
	  <td colspan="3" align="center" style="font-size: 11pt; font-weight: bold">SEMUA ASET</td>
	</tr>
	<tr>
	  <td colspan="3" align="center" style="font-size: 10pt; font-weight: normal">PER 31 DESEMBER <?=$rTH?></td>
	</tr>
	<tr>
	  <td width="78" style="font-size: 10pt; font-weight: normal">UNIT KERJA </td>
	  <td width="22" style="font-size: 10pt; font-weight: normal">:</td>
	  <td width="1190" style="font-size: 10pt; font-weight: normal"><? if ($_GET['uNT']=='All'){echo "SEMUA";} else {echo strtoupper(fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",$_GET['uNT'],"=","",DatabaseSB,$ConSB,""));}?></td>
	</tr>
	<tr>
	  <td colspan="3">&nbsp;</td>
	</tr>
	</table>
    <table border="0" align="center" width="1270" cellspacing="0" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse">
	  <tr height="20">
	    <td rowspan="3" style="text-align:center; font-weight:bold; border:1px solid #000000">Kode</td>
	    <td rowspan="3" style="text-align:center; font-weight:bold; border:1px solid #000000">Kelompok</td>
	    <td rowspan="3" style="text-align:center; font-weight:bold; border:1px solid #000000">N i l a i<br>Perolehan</td>
	    <td colspan="8" style="text-align:center; font-weight:bold; border:1px solid #000000">N E R A C A</td>
      </tr>
	  <tr height="20">
		<td colspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">Nilai Awal<br>(<?=$rTH-1?>)</td>
		<td colspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">Nilai Regulasi<br/>(<?=$rTH?>)</td>
		<td colspan="4" style="text-align:center; font-weight:bold; border:1px solid #000000">Nilai Akhir<br/>(<?=$rTH?>)</td>
      </tr>
	  <tr height="20">
	    <td style="text-align:center; font-weight:bold; border:1px solid #000000">Aset</td>
	    <td style="text-align:center; font-weight:bold; border:1px solid #000000">Akumulasi Penyusutan</td>
        <td style="text-align:center; font-weight:bold; border:1px solid #000000">Atribusi/<br/>Penambahan<br/>Nilai</td>
        <td style="text-align:center; font-weight:bold; border:1px solid #000000">Nilai Setelah Penambahan</td>
	    <td style="text-align:center; font-weight:bold; border:1px solid #000000">Nilai Akhir</td>
	    <td style="text-align:center; font-weight:bold; border:1px solid #000000">Beban Penyusutan</td>
	    <td style="text-align:center; font-weight:bold; border:1px solid #000000">Akumulasi Penyusutan</td>
	    <td style="text-align:center; font-weight:bold; border:1px solid #000000">Nilai Buku</td>
	  </tr>
	  <tr height="20" style="font-weight:bold">
		<td width="35" style="text-align:center; border:1px solid #000000">1</td>
		<td style="text-align:center; border:1px solid #000000">2</td>
		<td width="110" style="text-align:center; border:1px solid #000000">3</td>
		<td width="110" style="text-align:center; border:1px solid #000000">4</td>
		<td width="110" style="text-align:center; border:1px solid #000000">5</td>
		<td width="110" style="text-align:center; border:1px solid #000000">6</td>
		<td width="110" style="text-align:center; border:1px solid #000000">7=4+6</td>
		<td width="110" style="text-align:center; border:1px solid #000000">8=7</td>
		<td width="110" style="text-align:center; border:1px solid #000000">9</td>
		<td width="110" style="text-align:center; border:1px solid #000000">10=5+9</td>
		<td width="110" style="text-align:center; border:1px solid #000000">11=8-10</td>
	  </tr>
	  <?
		$iG=1;
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE (Kd_Aset LIKE '1.3.%' OR Kd_Aset LIKE '1.5.3' OR Kd_Aset LIKE '1.5.4') AND Kd_Aset NOT LIKE '1.3.7' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$Col01 = $mRo['Kd_Aset'];
			$Col02 = strtoupper($mRo['Nm_Aset']);
			$Left2 = substr($Col01,0,5);
			
			if ($Left2=='1.3.1' || $Left2=='1.3.5' || $Left2=='1.3.6'){
				if ($Left2=='1.3.5'){
					$Col03 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_108","Kd_UPB:Kd_Aset_108:Tgl_Perolehan:extracom:KdpToAset",$uNT."%:".$Left2.".%:".$rTH."-12-31:N:N","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
					$Col04 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_108","Kd_UPB:Kd_Aset_108:Tgl_Perolehan:extracom:KdpToAset",$uNT."%:".$Left2.".%:".($rTH-1)."-12-31:N:N","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
				}
				else{
					$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Crit:extracom:KdpToAset",$uNT."%:".$Left2.".%:".$rTH."-12-31:%:N:N","LIKE:LIKE:<=:LIKE:=:=","",DatabaseSB,$ConSB,"");
					$Col04 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Crit:extracom:KdpToAset",$uNT."%:".$Left2.".%:".($rTH-1)."-12-31:%:N:N","LIKE:LIKE:<=:LIKE:=:=","",DatabaseSB,$ConSB,"");
				}
				
				
				$Col05 = 0;
				if ($Left2=='1.3.5'){
					$Col06 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_108","Kd_UPB:Kd_Aset_108:Tgl_Perolehan:Tgl_Perolehan:extracom:KdpToAset",substr($uNT,0,11)."%:".$Left2."%:".$rTH."-01-01:".$rTH."-12-31:N:N","LIKE:LIKE:>=:<=:=:=","",DatabaseSB,$ConSB,"");
				}
				else{
					$Col06 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Crit:Tanggal:Tanggal:extracom:KdpToAset",substr($uNT,0,11)."%:".$Left2."%:%:".$rTH."-01-01:".$rTH."-12-31:N:N","LIKE:LIKE:LIKE:>=:<=:=:=","",DatabaseSB,$ConSB,"");
				}
				$Col07 = $Col04+$Col06;
				$Col08 = $Col07;
				$Col09 = 0;
				$Col10 = 0;
				$Col11 = $Col08-$Col10;
			}
			else{
				$Col03 = fGlobalNEW("IfNull(sum(nilai_perolehan),0)","ta_kib_post_neraca_108","Kd_UPB:Kd_Aset_108:Periode",$uNT."%:".$Left2.".%:".$rTH,"LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
				$Col04 = fGlobalNEW("IfNull(sum(nilai_awal),0)","ta_kib_post_neraca_108","Kd_UPB:Kd_Aset_108:Periode",$uNT."%:".$Left2.".%:".$rTH,"LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
				$Col05 = fGlobalNEW("IfNull(sum(Akumulasi_PenyusutanMin),0)","ta_kib_post_neraca_108","Kd_UPB:Kd_Aset_108:Periode",$uNT."%:".$Left2.".%:".$rTH,"LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
				$Col06 = fGlobalNEW("IfNull(sum(nilai_atribusi),0)","ta_kib_post_neraca_108","Kd_UPB:Kd_Aset_108:Periode",$uNT."%:".$Left2.".%:".$rTH,"LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
				$Col07 = fGlobalNEW("IfNull(sum(nilai_aset),0)","ta_kib_post_neraca_108","Kd_UPB:Kd_Aset_108:Periode",$uNT."%:".$Left2.".%:".$rTH,"LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
				$Col08 = $Col07;
				$Col09 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_neraca_108","Kd_UPB:Kd_Aset_108:Periode",$uNT."%:".$Left2.".%:".$rTH,"LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
				$Col10 = fGlobalNEW("IfNull(sum(Akumulasi_Penyusutan),0)","ta_kib_post_neraca_108","Kd_UPB:Kd_Aset_108:Periode",$uNT."%:".$Left2.".%:".$rTH,"LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
				$Col11 = fGlobalNEW("IfNull(sum(Nilai_Buku),0)","ta_kib_post_neraca_108","Kd_UPB:Kd_Aset_108:Periode",$uNT."%:".$Left2.".%:".$rTH,"LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
			}
			if ($Col11<($Col08-$Col10))
			{
				$xG="000";
			}
			elseif ($Col11>($Col08-$Col10))
			{
				$xG="000";
			}
			else{
				$xG="";
			}
			
			$tCol03 = $tCol03 + $Col03;
			$tCol04 = $tCol04 + $Col04;
			$tCol05 = $tCol05 + $Col05;
			$tCol06 = $tCol06 + $Col06;
			$tCol07 = $tCol07 + $Col07;
			$tCol08 = $tCol08 + $Col08;
			$tCol09 = $tCol09 + $Col09;
			$tCol10 = $tCol10 + $Col10;
			$tCol11 = $tCol11 + $Col11;
			
			RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,$Col09,$Col10,$Col11,$xG,$xB);
		}
	  ?>
	  <? function RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,$Col09,$Col10,$Col11,$xG,$xB) {?>
	  <tr height="28">
		<td style="border:1px solid #000000; text-align:center"><?=$xB.$Col01?></td>
		<td style="border:1px solid #000000; padding-left:5px"><?=$xB.$Col02?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col03)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col04)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col05)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col06)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col07)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col08)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col09)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col10)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px <? if ($xG!="") {echo "; color:#".$xG;}?>"><?=$xB.fConvertToRupiah($Col11)?></td>
	  </tr>
	  <?
	  }
	  ?>
	  <? function RowBlank() {?>
	  <tr height="22">
		<td style="border:1px solid #000000; text-align:left">&nbsp;</td>
		<td style="border:1px solid #000000; padding-left:5px">&nbsp;</td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px">&nbsp;</td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px">&nbsp;</td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px">&nbsp;</td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px">&nbsp;</td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px">&nbsp;</td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px">&nbsp;</td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px">&nbsp;</td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px">&nbsp;</td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px">&nbsp;</td>
	  </tr>
	  <?
	  }
	  #$tCol03 = 0;
	  #$tCol04 = 0;
	  #$tCol05 = 0;
	  #$tCol06 = 0;
	  #$tCol07 = 0;
	  #$tCol08 = 0;
	  #$tCol09 = 0;
	  #$tCol10 = 0;
	  #$tCol11 = 0;
	  ?>
	  <tr height="35">
		<td colspan="2" style="border:1px solid #000000; font-weight:bold; text-align:center">T O T A L</td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol03)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol04)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol05)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol06)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol07)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol08)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol09)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol10)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol11)?></td>
	  </tr>
</table>
<table border="0" align="center" width="1270" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td colspan="3" valign="top"><?php require "Lap_Bottom2.php"?></td>
</tr>
</table>

</body>