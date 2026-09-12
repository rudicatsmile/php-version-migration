<?
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

$nMT="N";
$txt="";
if ($mts!=""){
	$txt="<br><font style='background:#000; color:#fff; font-size:9pt;font-style:italic'>&nbsp;( SUDAH MUTASI KE ASET LAINNYA )&nbsp;</font>";
	$nMT="Y";
}

?>
<body>
<table border="0" align="center" cellspacing="0" style="width:1300px; font-size: 8pt; font-family: Calibri; border-collapse: collapse">
  <tr>
    <td>
	<table border="0" align="center" width="1300" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
	<tr>
	  <td colspan="3" align="center" style="font-size: 13pt; font-weight: bold">REKAPITULASI NILAI BUKU PER SOPD</td>
	</tr>
	<tr>
	  <td colspan="3" align="center" style="font-size: 10pt; font-weight: normal">PER 31 DESEMBER <?=$rTH?></td>
	</tr>
	
	<tr>
	  <td colspan="3">&nbsp;</td>
	</tr>
	</table>
	<table border="0" align="center" width="1300" cellspacing="0" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse">
	  <tr height="20">
	    <td width="70" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">KODE</td>
	    <td rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">SOPD</td>
	    <td colspan="8" style="text-align:center; font-weight:bold; border:1px solid #000000">NILAI AKHIR ASET </td>
	    </tr>
	  <tr height="20">
		<td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000">KIB-A</td>
		<td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000">KIB-B</td>
		<td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000">KIB-C</td>
		<td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000">KIB-D</td>
		<td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000">KIB-E</td>
		<td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000">KIB-F</td>
		<td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000">KIB-G</td>
	    <td width="110" style="text-align:center; font-weight:bold; border:1px solid #000000">TOTAL</td>
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
		<td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">9</td>
	    <td style="text-align:center; border:1px solid #000000; border-bottom:3px double #000000">10</td>
	  </tr>
		<?
		$iG=1;
		$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$Col01 = $mRo['Kd_Unit'];
			$Col02 = strtoupper($mRo['Nm_Unit']);
			$uNT   = $Col01;
			$Col03 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post".$mts,"Kd_UPB:Kd_Aset:Tanggal:extracom:KdpToAset",$uNT."%:01.%:".$rTH."-12-31:N:N","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
			$Col04 = fGlobalNEW("IfNull(sum(Nilai_Buku),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:02.%:".$rTH.":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",DatabaseSB,$ConSB,"");
			$Col05 = fGlobalNEW("IfNull(sum(Nilai_Buku),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:03.%:".$rTH.":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",DatabaseSB,$ConSB,"");
			$Col06 = fGlobalNEW("IfNull(sum(Nilai_Buku),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:04.%:".$rTH.":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",DatabaseSB,$ConSB,"");
			$Col07 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post".$mts,"Kd_UPB:Kd_Aset:Tanggal:extracom:KdpToAset",$uNT."%:05.%:".$rTH."-12-31:N:N","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
			$Col08 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post".$mts,"Kd_UPB:Kd_Aset:Tanggal:extracom:KdpToAset",$uNT."%:06.%:".$rTH."-12-31:N:N","LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
			
			$Col9a = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post".$mts,"Kd_UPB:Tanggal:Kd_Aset:Crit:extracom",$uNT."%:".$rTH."-12-31:07%:%:N","LIKE:<=:LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
			//$Col9b = fGlobalNEW("IfNull(sum(Nilai_Tambah),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:SdhMutasi",$uNT."%:07.%:".$rTH.":".$nMT,"LIKE:LIKE:<=:=","",DatabaseSB,$ConSB,"");
			
			$Col9c = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Kd_Aset:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$uNT."%:07.%:".$rTH.":Y:IV:".$nMT,"LIKE:LIKE:=:=:=:=","",DatabaseSB,$ConSB,"");

			$Col09 = $Col9a-$Col9c;
			$Col10 = $Col03+$Col04+$Col05+$Col06+$Col07+$Col08+$Col09;
			
			
			$tCol03 = $tCol03 + $Col03;
			$tCol04 = $tCol04 + $Col04;
			$tCol05 = $tCol05 + $Col05;
			$tCol06 = $tCol06 + $Col06;
			$tCol07 = $tCol07 + $Col07;
			$tCol08 = $tCol08 + $Col08;
			$tCol09 = $tCol09 + $Col09;
			$tCol10 = $tCol10 + $Col10;
			
			$xB="";
			
			RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,$Col09,$Col10,$xB);
			$iG++;
		}
		
		
		?>
	  <? function RowData($Col01,$Col02,$Col03,$Col04,$Col05,$Col06,$Col07,$Col08,$Col09,$Col10,$xB) {?>
	  <?
	  ?>
	  <tr height="22">
		<td style="border:1px solid #000000; text-align:left; padding-left:9px"><?=$xB.$Col01?></td>
		<td style="border:1px solid #000000; padding-left:5px"><?=$xB.$Col02?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col03)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col04)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col05)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col06)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col07)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col08)?></td>
		<td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col09)?></td>
	    <td style="border:1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($Col10)?></td>
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
	  </tr>
	  <?
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
		<td style="border:1px solid #000000; border-top:3px double #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol09)?></td>
	    <td style="border:1px solid #000000; border-top:3px double #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol10)?></td>
	  </tr>
	</table>
    </td>
  </tr>
</table>
<br>
</body>