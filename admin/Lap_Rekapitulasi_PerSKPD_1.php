<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
$gThA = $_GET['gThA'];
$gThB = $_GET['gThB'];
$gExt = $_GET['gExt'];

if ($gExt=='Y')
{
	$NmExt = "EXTRACOMPTABLE";
}
else if ($gExt=='N')
{
	$NmExt = "NON EXTRACOMPTABLE";
}
else if ($gExt=='All')
{
	$gExt = "%";
	$NmExt = "EXTRACOMPTABLE & NON EXTRACOMPTABLE";
}
$TglA = $gThA."-01-01";
$TglB = $gThB."-12-31";
if ($gThA==$gThB) {$rThn=$gThA;} else {$rThn=$gThA." s/d ".$gThB;}

?>
<body>
<table border="0" width="1300" cellspacing="0" cellpadding="0" align="center" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table1" bordercolor="#000000">
	<tr>
		<td width="1285" align="center" style="font-size: 12pt; font-weight: bold">PEMERINTAH <?php echo $TiDaer." ".$NmDaer?></td>
	</tr>
	<tr>
		<td width="1285" align="center" style="font-size: 12pt; font-weight: bold">REKAPITULASI BARANG PER SKPD</td>
	</tr>
	<tr>
		<td width="1285" align="center" style="font-size: 10pt; font-weight: bold">TAHUN ANGGARAN <?php echo $gThB?></td>
	</tr>
	<tr>
		<td style="font-size: 10pt; font-weight: bold; text-align:center">( <?=$NmExt?> )</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<table border="1" width="1300" cellspacing="0" cellpadding="0" align="center" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" bordercolor="#000000">
  <tr> 
    <td width="30" rowspan="2" align="center" style="font-weight:bold; border-bottom: 3px double #000000">NO</td>
    <td rowspan="2" align="center" style="font-weight:bold; border-bottom: 3px double #000000">S K P D</td>
    <td width="110" align="center" style="font-weight:bold">TANAH</td>
    <td width="110" align="center" style="font-weight:bold">PERALATAN<br>DAN MESIN</td>
    <td width="110" align="center" style="font-weight:bold">GEDUNG<br>DAN BANGUNAN</td>
    <td width="110" align="center" style="font-weight:bold">JALAN, IRIGASI DAN JARINGAN</td>
    <td width="110" align="center" style="font-weight:bold">ASET TETAP<br>LAINNYA</td>
    <td width="110" align="center" style="font-weight:bold">KONSTRUKSI DALAM PENGERJAAN</td>
    <td width="110" align="center" style="font-weight:bold">ATB</td>
    <td width="110" align="center" style="font-weight:bold">ASET LAINNYA</td>
    <td width="120" align="center" style="font-weight:bold">TOTAL</td>
  </tr>
  <tr> 
    <td align="center" style="font-weight:bold; border-bottom: 3px double #000000">1</td>
    <td align="center" style="font-weight:bold; border-bottom: 3px double #000000">2</td>
    <td align="center" style="font-weight:bold; border-bottom: 3px double #000000">3</td>
    <td align="center" style="font-weight:bold; border-bottom: 3px double #000000">4</td>
    <td align="center" style="font-weight:bold; border-bottom: 3px double #000000">5</td>
    <td align="center" style="font-weight:bold; border-bottom: 3px double #000000">6</td>
    <td align="center" style="font-weight:bold; border-bottom: 3px double #000000">7</td>
    <td align="center" style="font-weight:bold; border-bottom: 3px double #000000">8</td>
    <td align="center" style="font-weight:bold; border-bottom: 3px double #000000">9</td>
  </tr>
  <?php
	$gCoL = array(9);
	$tCoL = array(9);
	$iG=1;
	$SQL = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
	$nRs = mysql_query($SQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{  
			$gUNT = $mRo['Kd_Unit'];
			$gCoL[9] = 0;
			for ($i=1; $i<=6; $i++)
			{
				$gKDA = "1.3.".$i;
				if ($gKDA=="1.3.5"){
					$gCoL[$i] = fGlobal("IfNull(sum(Harga),0)","ta_kib_108","Kd_Aset_108:Kd_UPB:Tgl_Perolehan:Tgl_Perolehan:extracom:KdpToAset",$gKDA."%:".$gUNT."%:".$TglA.":".$TglB.":".$gExt.":N","LIKE:LIKE:>=:<=:LIKE:=","","");
				}
				else{
					$gCoL[$i] = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Kd_Aset_108:Kd_UPB:Tanggal:Tanggal:extracom:KdpToAset",$gKDA."%:".$gUNT."%:".$TglA.":".$TglB.":".$gExt.":N","LIKE:LIKE:>=:<=:LIKE:=","","");
				}
				$gCoL[9] = $gCoL[9] + $gCoL[$i];
			}
			
			for ($i=3; $i<=4; $i++)
			{
				$gKDA = "1.5.".$i;
				$x=$i+4;
				$gCoL[$x] = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Kd_Aset_108:Kd_UPB:Tanggal:Tanggal:extracom:KdpToAset",$gKDA."%:".$gUNT."%:".$TglA.":".$TglB.":".$gExt.":N","LIKE:LIKE:>=:<=:LIKE:=","","");
				$gCoL[9] = $gCoL[9] + $gCoL[$x];
			}
			
			#$gCoL[7] = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Kd_Aset_108:Kd_UPB:Tanggal:Tanggal:extracom:KdpToAset","1.5.%:".$gUNT."%:".$TglA.":".$TglB.":".$gExt.":N","LIKE:LIKE:>=:<=:LIKE:=","","");
			#$gCoL[8] = $gCoL[8]+$gCoL[7];
			
			for ($g=1; $g<=9; $g++)
			{
				$tCoL[$g]=$tCoL[$g]+$gCoL[$g];
			}
		  ?>
		  <tr height="25"> 
			<td align="center"><?php echo $iG?>.</td>
			<td style="padding-left:5px"><?php echo $mRo['Nm_Unit']?></td>
			<td align="right" style="padding-right:2px"><?php echo fConvertToRupiah($gCoL[1]) ?></td>
			<td align="right" style="padding-right:2px"><?php echo fConvertToRupiah($gCoL[2]) ?></td>
			<td align="right" style="padding-right:2px"><?php echo fConvertToRupiah($gCoL[3]) ?></td>
			<td align="right" style="padding-right:2px"><?php echo fConvertToRupiah($gCoL[4]) ?></td>
			<td align="right" style="padding-right:2px"><?php echo fConvertToRupiah($gCoL[5]) ?></td>
			<td align="right" style="padding-right:2px"><?php echo fConvertToRupiah($gCoL[6]) ?></td>
			<td align="right" style="padding-right:2px"><?php echo fConvertToRupiah($gCoL[7]) ?></td>
			<td align="right" style="padding-right:2px"><?php echo fConvertToRupiah($gCoL[8]) ?></td>
			<td align="right" style="padding-right:2px"><?php echo fConvertToRupiah($gCoL[9]) ?></td>
		  </tr>
		  <?php
			$iG++;
		}
		while ($mRo = mysql_fetch_assoc($nRs));
	}
  ?>
  <tr height="25"> 
    <td colspan="2" align="center" style="font-weight:bold; border-top: 3px double #000000">TOTAL</td>
    <td align="right" style="font-weight:bold; border-top: 3px double #000000; padding-right:2px"><?php echo fConvertToRupiah($tCoL[1]) ?></td>
    <td align="right" style="font-weight:bold; border-top: 3px double #000000; padding-right:2px"><?php echo fConvertToRupiah($tCoL[2]) ?></td>
    <td align="right" style="font-weight:bold; border-top: 3px double #000000; padding-right:2px"><?php echo fConvertToRupiah($tCoL[3]) ?></td>
    <td align="right" style="font-weight:bold; border-top: 3px double #000000; padding-right:2px"><?php echo fConvertToRupiah($tCoL[4]) ?></td>
    <td align="right" style="font-weight:bold; border-top: 3px double #000000; padding-right:2px"><?php echo fConvertToRupiah($tCoL[5]) ?></td>
    <td align="right" style="font-weight:bold; border-top: 3px double #000000; padding-right:2px"><?php echo fConvertToRupiah($tCoL[6]) ?></td>
    <td align="right" style="font-weight:bold; border-top: 3px double #000000; padding-right:2px"><?php echo fConvertToRupiah($tCoL[7]) ?></td>
    <td align="right" style="font-weight:bold; border-top: 3px double #000000; padding-right:2px"><?php echo fConvertToRupiah($tCoL[8]) ?></td>
    <td align="right" style="font-weight:bold; border-top: 3px double #000000; padding-right:2px"><?php echo fConvertToRupiah($tCoL[9]) ?></td>
  </tr>
</table>
<table border="0" width="1300" cellspacing="0" cellpadding="0" align="center" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table1" bordercolor="#000000">
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
</body>
</html>
