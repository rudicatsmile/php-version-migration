<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
extract($_GET);

$gUnt= $gUnt;
$gSub= $gSub;
$gUpb= $gUpb;

require ("Lap_Include.php");

$gThn = $gThn;
$gMLK = $gMLK;

if ($gThn=="All" || $gThn=="") {$rThn="____";} else {$rThn=$gThn;}
if ($gMLK=="All" || $gMLK=="") {$rMLK="__";}   else {$rMLK=$gMLK;}

?>
<body>
<table border="0" align="center" width="760" cellspacing="1" style="font-family: Calibri; font-size: 8pt; border-collapse: collapse" id="table1">
	<tr>
		<td width="1285" align="center" style="font-size: 12pt; font-weight: bold">REKAPITULASI BUKU INVENTARIS</td>
	</tr>
	<tr>
		<td width="1285" align="center" style="font-size: 12pt; font-weight: bold">SAMPAI DENGAN TAHUN <?=$gThn?></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
  </tr>
	<tr>
		<td>
		<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table8">
		<tr>
			<td width="97">SKPD</td>
			<td width="21">:</td>
			<td><?php if ($xUnt=="") {echo "<i>SEMUA</i>";} else {echo strtoupper(fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",$xUnt,"=","",""));}?></td>
			<td width="237" align="right">&nbsp;</td>
		</tr>
		<tr>
			<td width="97">SUB UNIT </td>
			<td width="21">:</td>
			<td><?php if ($xSub=="") {echo "<i>SEMUA</i>";} else {echo strtoupper(fGlobal("Nm_Sub","Ref_Sub_Unit","Kd_Sub",$xSub,"=","",""));}?></td>
			<td width="237">&nbsp;</td>
		</tr>
		<tr>
			<td width="97">UPB</td>
			<td width="21">:</td>
			<td><?php if ($xUpb=="") {echo "<i>SEMUA</i>";} else {echo strtoupper(fGlobal("Nm_Upb","Ref_Upb","Kd_Upb",$xUpb,"=","",""));}?></td>
			<td width="237">&nbsp;</td>
		</tr>
		<tr>
			<td width="97"><?=$TiDaer?></td>
			<td width="21">:</td>
			<td><?=$NmDaer?></td>
			<td width="237" align="right" style="font-weight: bold">&nbsp;</td>
		</tr>
		</table>		</td>
	</tr>
	<tr>
	  <td>
		<table border="1" width="760" cellspacing="1" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" id="table1" bordercolor="#000000">
			<tr>
				<td width="24" style="font-weight: bold" align="center">No</td>
				<td width="30" style="font-weight: bold" align="center">Gol</td>
				<td width="35" style="font-weight: bold" align="center">Bidang</td>
				<td width="285" style="font-weight: bold" align="center">Nama Bidang 
				Barang</td>
				<td width="52" style="font-weight: bold" align="center">Jumlah Barang</td>
				<td width="114" style="font-weight: bold" align="center">Jumlah Harga</td>
				<td width="182" align="center" style="font-weight: bold">Keterangan</td>
			</tr>
			<tr>
				<td width="24" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
				1</td>
				<td width="30" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
				2</td>
				<td width="35" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
				3</td>
				<td width="285" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
				4</td>
				<td width="52" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
				5</td>
				<td width="114" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
				6</td>
				<td style="font-weight: bold; border-bottom: 3px double #000000" align="center">
				7</td>
			</tr>
			<?php
			$Col[7];
			$iG   = 1;
			$tHRG = 0;
			$tCNT = 0;
			function ClrVr()
			{
				for($nG=1; $nG<=7; $nG++)
				{
					if ($nG==5 || $nG==6)
					{$Col[$nG]=0;}
					else
					{$Col[$nG]="";}
				}
			}
			
			$nSQL= "SELECT * FROM ref_rek_aset108_3 ORDER BY Kd_Aset";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				do
				{
					$gHRG = 0;
					$gNiA = 0;
					$gNiB = 0;
					if ($iG > 1) {echo ViewBlank();}
					$xB = "<b>";
					echo ClrVr();
					$KdAsT  = $mRo['Kd_Aset'];
					$Col[1] = $iG.".";
					$Col[2] = $mRo['Kd_Aset'];
					$Col[3] = "";
					$Col[4] = strtoupper($mRo['Nm_Aset']);
					
					$fLD = "";
					$oPR = "";
					$nIL = "";
					if (substr($KdAsT,0,2)=="06"){
						$fLD = ":KdpToAset";
						$oPR = ":=";
						$nIL = ":N";
					}
					
					$gCNT   = fGlobal("IfNull(count(*),0)","ta_kib_108","Kd_Aset_108:Kd_UPB:Tgl_Perolehan:Status:extracom:KdpToAset".$fLD,$KdAsT."%:".substr($gUpb,0,11)."%:".$gThn."-12-31::N:N".$nIL,"like:like:<=:=:=:=".$oPR,"","");
					if ($KdAsT=='1.3.5'){
						$gNiA   = fGlobal("IfNull(sum(Harga),0)", "ta_kib_108","Kd_Aset_108:Kd_UPB:Tgl_Perolehan:extracom:KdpToAset",$KdAsT."%:".substr($gUpb,0,11)."%:".$gThn."-12-31:N:N","like:like:<=:=:=","","");
					}
					else{
						$gNiA   = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset_108:Kd_UPB:Tanggal:extracom:KdpToAset",$KdAsT."%:".substr($gUpb,0,11)."%:".$gThn."-12-31:N:N","like:like:<=:=:=","","");
					}
					if ($gNiB!=0) {$gHRG = $gNiA - $gNiB;}
					else {$gHRG=$gNiA;}
					
					$Col[5] = $gCNT;
					$Col[6] = $gHRG;
					ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$xB);
					ViewBidang($mRo['Kd_Aset'],strtoupper(fNmHuruf($iG)),$gUpb,$gThn);
					$tCNT = $tCNT + $gCNT;
					$tHRG = $tHRG + $gHRG;
					$iG++;
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
			
			function ViewBidang($KdBDG,$mTBL,$mUpb,$mThn)
			{
				$iGG  = 1;
				$nSQB = "SELECT * FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '".$KdBDG.".%' ORDER BY Kd_Aset";
				$nRsB = mysql_query($nSQB) or die(mysql_error());
				$mRoB = mysql_fetch_assoc($nRsB);
				$tRoB = mysql_num_rows($nRsB);
				if ($tRoB > 0)
				{
					do
					{
						$xB = "";
						$gAKH = 0;
						$gNiA = 0;
						$gNiB = 0;
						echo ClrVr();
						$KdAsT  = $mRoB['Kd_Aset'];
						$Col[1] = "";
						$Col[2] = "";
						$Col[3] = substr($mRoB['Kd_Aset'],6,2);
						$Col[4] = $mRoB['Nm_Aset'];
						
						$fLD = "";
						$oPR = "";
						$nIL = "";
						if (substr($KdAsT,0,5)=="1.3.6"){
							$fLD = ":KdpToAset";
							$oPR = ":=";
							$nIL = ":N";
						}
					
						$gCNT   = fGlobal("IfNull(count(*),0)","ta_kib_108","Kd_Aset_108:Kd_UPB:Tgl_Perolehan:Status:extracom:KdpToAset".$fLD,$KdAsT."%:".substr($mUpb,0,11)."%:".$mThn."-12-31::N:N".$nIL,"like:like:<=:=:=:=".$oPR,"","");
						if (substr($KdAsT,0,5)=='1.3.5'){
							$gNiA   = fGlobal("IfNull(sum(Harga),0)", "ta_kib_108","Kd_Aset_108:Kd_UPB:Tgl_Perolehan:extracom:KdpToAset",$KdAsT."%:".substr($mUpb,0,11)."%:".$mThn."-12-31:N:N","like:like:<=:=:=","","");
						}
						else{
							$gNiA   = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset_108:Kd_UPB:Tanggal:extracom:KdpToAset",$KdAsT."%:".substr($mUpb,0,11)."%:".$mThn."-12-31:N:N","like:like:<=:=:=","","");
						}
						if ($gNiB!=0) {$gHRG = $gNiA - $gNiB;}
						else {$gHRG=$gNiA;}
						$Col[5] = $gCNT;
						$Col[6] = $gHRG;
				
						ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$xB);
						$iGG++;
					}
					while ($mRoB = mysql_fetch_assoc($nRsB));	
				}
			}
			?>
			<?php function ViewRincian($x1,$x2,$x3,$x4,$x5,$x6,$x7,$xB) {?>
			<tr>
				<td width="24" height="22" align="center"><?php echo $xB.$x1?></td>
				<td width="30" align="center"><?php echo $xB.$x2?></td>
				<td width="35" align="center"><?php echo $xB.$x3?></td>
				<td width="285"><?php echo $xB.$x4?></td>
				<td width="52" align="center"><?php if ($x5!=0) {echo $xB.fConvertToRupiahBulat($x5);} else {echo "-";}?></td>
				<td width="114" align="right"><?php if ($x6!=0) {echo $xB.fConvertToRupiah($x6);} else {echo "-";}?></td>
				<td><?php echo $xB.$x7?></td>
			</tr>
		 	<?php } ?>
          	<?php function ViewBlank() {?>
			<tr>
				<td width="24">&nbsp;</td>
				<td width="30">&nbsp;</td>
				<td width="35">&nbsp;</td>
				<td width="285">&nbsp;</td>
				<td width="52">&nbsp;</td>
				<td width="114">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		  	<?php } ?>
			<tr>
				<td colspan="4" align="center" style="font-weight:bold; border-top: 3px double #000000">Jumlah</td>
				<td width="52" align="center" style="font-weight:bold; border-top: 3px double #000000"><?php if ($tCNT!=0) {echo fConvertToRupiahBulat($tCNT);} else {echo "-";}?></td>
				<td width="114" align="right" style="font-weight:bold; border-top: 3px double #000000"><?php echo fConvertToRupiah($tHRG)?></td>
				<td style="font-weight:bold; border-top: 3px double #000000">&nbsp;</td>
			</tr>
		</table>	  </td>
	</tr>
	<tr>
		<td style="font-size:8pt; font-style:italic">&nbsp;</td>
	</tr>
	<tr>
	  <td></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
  </tr>
</table>
<table border="0" align="center" width="760" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table6">
<?php require "Dokumen_Footer.php";?>
<tr>
	<td width="230" align="center">Mengetahui,</td>
	<td align="center">&nbsp;</td>
	<td align="center" width="230"><?php echo $NmIbKt.", ".$frHri." ".fNmBulan($frBln)." ".$gThn?></td>
  </tr>
<tr>
	<td width="230" align="center" style="font-weight: bold"><?php echo $FotA[1]?></td>
	<td align="center">&nbsp;</td>
	<td align="center" style="font-weight: bold" width="230"><?php echo $FotC[1]?></td>
  </tr>
<tr>
	<td width="230" align="center">&nbsp;</td>
	<td align="center">&nbsp;</td>
	<td align="center" width="230">&nbsp;</td>
  </tr>
<tr>
	<td width="230" align="center">&nbsp;</td>
	<td align="center">&nbsp;</td>
	<td align="center" width="230">&nbsp;</td>
  </tr>
<tr>
	<td width="230" align="center">&nbsp;</td>
	<td align="center">&nbsp;</td>
	<td align="center" width="230">&nbsp;</td>
  </tr>
<tr>
	<td width="230" align="center" style="font-weight: bold"><u><?php echo $FotA[2]?></u></td>
	<td align="center">&nbsp;</td>
	<td align="center" style="font-weight: bold" width="230"><u><?php echo $FotC[2]?></u></td>
  </tr>
<tr>
	<td width="230" align="center">NIP. <?php echo $FotA[3]?></td>
	<td align="center">&nbsp;</td>
	<td align="center" width="230">NIP. <?php echo $FotC[3]?></td>
  </tr>
</table>
</body>
</html>
