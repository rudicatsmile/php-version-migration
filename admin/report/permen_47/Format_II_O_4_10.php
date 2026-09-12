<?php
require('../../Connection.php');
require('../../ConnectionMysql.php');
require('../../FileFunction.php');

extract($_GET);

$TG = $rThn."-01-01";
if ($rSem==1) 
{
	$yThn= ($rThn-1);
	$TGx = $rThn."-06-30";
	$TGz = $rThn."-12-31";
}
else 
{
	$yThn= $rThn;
	$TGx = $rThn."-12-31";
	$TGz = $rThn."-12-31";
}

$KdSx = "25.08.13.04";
$Vx   = "PENGELOLA BARANG";
$fP1Nma  = fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit",$KdSx,"=","","");
$fP1Nip  = fGlobal("Nip_Pimpinan","ref_unit","Kd_Unit",$KdSx,"=","","");
$fP1Pkt  = fGlobal("Pkt_Pimpinan","ref_unit","Kd_Unit",$KdSx,"=","","");
$fP1Jab  = fGlobal("Jab_Pimpinan","ref_unit","Kd_Unit",$KdSx,"=","","");

$fR = "II.O.4.10"; 
$mR = "PERSEDIAAN RUSAK BERAT / USANG";

$NmE = "INTRA KOMTABEL & EXTRA KOMTABEL";
if ($RdB=="Y")
{
	$NmE = "EXTRA KOMTABEL";
}
else if ($RdB=="N")
{
	$NmE = "INTRA KOMTABEL";
}
?> 
<body>
<!--table border="0" width="800" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td style="text-align:right">Format IV.L.3.3</td>
  </tr>
</table-->
<table border="0" width="800" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td style="text-align:center; font-size:11pt; font-family:calibri; text-align:right">Format <?=$fR?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri">DAFTAR BMD</td>
  </tr>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri"><?=$mR?></td>
  </tr>
  <?php if ($nR!="1.1.12"){?>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri"><?=$NmE?></td>
  </tr>
  <?php } ?>
  <tr>
    <td style="text-align:center; font-family:calibri; font-size:10pt; font-weight:bold"><?=$TiDaer." ".$NmDaer?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-family:calibri; font-size:10pt; font-weight:bold">TAHUN : <?=$rThn?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="800" align="center" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  
  <tr height="25" style="text-align:center; font-weight:bold">
    <td style="border:1px solid #000; border-bottom:1px solid #000">Kode Barang</td>
    <td style="border:1px solid #000; border-bottom:1px solid #000">Nama Barang</td>
    <td style="border:1px solid #000">Jumlah</td>
    <td style="border:1px solid #000">Nilai (Rp)</td>
  </tr>
  <tr style="text-align:center">
    <td width="110" style="border:1px solid #000; border-bottom:3px double #000">1</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">2</td>
    <td width="70" style="border:1px solid #000; border-bottom:3px double #000">3</td>
    <td width="110" style="border:1px solid #000; border-bottom:3px double #000">4</td>
  </tr>
	<?php
	$KdS = str_replace("XX","__",$KdS);
	CallConnection(DatabaseMY,$ConMY);
	#mysql_select_db(DatabaseSB, $ConSB);
	
	$iGb=1;
	$t3=0;
	$t4=0;
	
	$SQb = "SELECT 
	'' as A0,
	Kd_Rek as A1, 
	Nm_Rek as A2 
	FROM ref_rek_90_2 WHERE Kd_Rek LIKE '".substr($nR,0,3)."' ORDER BY Kd_Rek";
	
	#echo $SQb."<br>";
	$nRb = mysql_query($SQb);
	while ($mRb = mysql_fetch_array($nRb)) 
	{ 
		$fs = "";
		$x0 = "";
		$x1 = $mRb[1];
		$x2 = $mRb[2];
		
		$x1 = substr($nR,0,3);
		$x3 = fGlobal("ifNull(sum(qty),0)","tb_post","KdSkpd:KdPersediaan:Tanggal:Tanggal:Crit",$KdS."%:".$nR.".%:".$TG.":".$TGx.":BAP","LIKE:LIKE:>=:<=:=","",$fs);
		$x4 = fGlobal("ifNull(sum(TotalHarga),0)","tb_post","KdSkpd:KdPersediaan:Tanggal:Tanggal:Crit",$KdS."%:".$nR.".%:".$TG.":".$TGx.":BAP","LIKE:LIKE:>=:<=:=","",$fs);
		
		$xB = "bold";
		if ($iGb>1) {EmptRow();}
		TempRow($x0,$x1,$x2,$x3,$x4,$xB);
		Level3($nR,$x1,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$yThn,$RdB,DatabaseMY,$ConMY);
		$t3 = $t3+$x3;
		$t4 = $t4+$x4;
		$iGb++;
	}
	
	function Level3($nR,$Mst,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$yThn,$RdB,$DatabaseMY,$ConMY)
	{
		$iGc = 1;
		$SQc = "SELECT 
		'' as A0,
		Kd_Rek as A1, 
		Nm_Rek as A2 
		FROM ref_rek_90_3 WHERE Kd_Rek LIKE '".$Mst.".12' ORDER BY Kd_Rek";
		$nRc = mysql_query($SQc);
		#echo $SQc."<br>";
		while ($mRc = mysql_fetch_array($nRc)) 
		{ 
			$fs = "";
			$x0 = "";
			$x1 = $mRc[1];
			$x2 = ucwords(strtolower($mRc[2]));
			
			$x3 = fGlobal("ifNull(sum(qty),0)","tb_post","KdSkpd:KdPersediaan:Tanggal:Tanggal:Crit",$KdS."%:".$x1.".%:".$TG.":".$TGx.":BAP","LIKE:LIKE:>=:<=:=","",$fs);
			$x4 = fGlobal("ifNull(sum(TotalHarga),0)","tb_post","KdSkpd:KdPersediaan:Tanggal:Tanggal:Crit",$KdS."%:".$x1.".%:".$TG.":".$TGx.":BAP","LIKE:LIKE:>=:<=:=","",$fs);
			
			$xB = "bold";
			if ($iGc>1) {EmptRow();}
			TempRow($x0,$x1,$x2,$x3,$x4,$xB);
			Level4($x1,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$yThn,$RdB,$DatabaseMY,$ConMY);
			$iGc++;
		}
	}
	
	function Level4($Mst,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$yThn,$RdB,$DatabaseMY,$ConMY)
	{
		$iGd = 1;
		$SQd = "SELECT 
		'' as A0,
		Kd_Rek as A1, 
		Nm_Rek as A2 
		FROM ref_rek_90_4 WHERE Kd_Rek LIKE '".$Mst.".%' ORDER BY Kd_Rek";
		#echo $SQd."<br>";
		$nRd = mysql_query($SQd);
		while ($mRd = mysql_fetch_array($nRd)) 
		{ 
			$fs = "";
			$x0 = "";
			$x1 = $mRd[1];
			$x2 = ucwords(strtolower($mRd[2]));
			
			$x3 = fGlobal("ifNull(sum(qty),0)","tb_post","KdSkpd:KdPersediaan:Tanggal:Tanggal:Crit",$KdS."%:".$x1.".%:".$TG.":".$TGx.":BAP","LIKE:LIKE:>=:<=:=","",$fs);
			$x4 = fGlobal("ifNull(sum(TotalHarga),0)","tb_post","KdSkpd:KdPersediaan:Tanggal:Tanggal:Crit",$KdS."%:".$x1.".%:".$TG.":".$TGx.":BAP","LIKE:LIKE:>=:<=:=","",$fs);
			
			$xB = "bold";
			if ($iGd>1) {EmptRow();}
			TempRow($x0,$x1,$x2,$x3,$x4,$xB);
			Level5($x1,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$yThn,$RdB,$DatabaseMY,$ConMY);
			$iGd++;
		}
	}
	
	function Level5($Mst,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$yThn,$RdB,$DatabaseMY,$ConMY)
	{
		$iGe = 1;
		$SQe = "SELECT 
		'' as A0,
		Kd_Rek as A1, 
		Nm_Rek as A2 
		FROM ref_rek_90_5 WHERE Kd_Rek LIKE '".$Mst.".%' ORDER BY Kd_Rek";
		#echo $SQe."<br>";
		$nRe = mysql_query($SQe);
		while ($mRe = mysql_fetch_array($nRe)) 
		{ 
			$fs = "";
			$x0 = "";
			$x1 = $mRe[1];
			$x2 = ucwords(strtolower($mRe[2]));
			
			$x3 = fGlobal("ifNull(sum(qty),0)","tb_post","KdSkpd:KdPersediaan:Tanggal:Tanggal:Crit",$KdS."%:".$x1.".%:".$TG.":".$TGx.":BAP","LIKE:LIKE:>=:<=:=","",$fs);
			$x4 = fGlobal("ifNull(sum(TotalHarga),0)","tb_post","KdSkpd:KdPersediaan:Tanggal:Tanggal:Crit",$KdS."%:".$x1.".%:".$TG.":".$TGx.":BAP","LIKE:LIKE:>=:<=:=","",$fs);
			
			$xB = "bold";
			if ($iGe>1) {EmptRow();}
			TempRow($x0,$x1,$x2,$x3,$x4,$xB);
			Level6($x1,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$yThn,$RdB,$DatabaseSB,$ConSB);
			$iGe++;
		}
	}
	
	function Level6($Mst,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$yThn,$RdB,$DatabaseSB,$ConSB)
	{
		$iGf = 1;
		$SQf = "SELECT 
		'' as A0,
		Kd_Rek as A1, 
		Nm_Rek as A2 
		FROM ref_rek_90_6 WHERE Kd_Rek LIKE '".$Mst.".%' ORDER BY Kd_Rek";
		#echo $SQf."<br>";
		$nRf = mysql_query($SQf);
		while ($mRf = mysql_fetch_array($nRf)) 
		{ 
			$fs = "";
			$x0 = "";
			$x1 = $mRf[1];
			$x2 = ucwords(strtolower($mRf[2]));
			
			$x3 = fGlobal("ifNull(sum(qty),0)","tb_post","KdSkpd:KdPersediaan:Tanggal:Tanggal:Crit",$KdS."%:".$x1.".%:".$TG.":".$TGx.":BAP","LIKE:LIKE:>=:<=:=","",$fs);
			$x4 = fGlobal("ifNull(sum(TotalHarga),0)","tb_post","KdSkpd:KdPersediaan:Tanggal:Tanggal:Crit",$KdS."%:".$x1.".%:".$TG.":".$TGx.":BAP","LIKE:LIKE:>=:<=:=","",$fs);
			
			$xB = "normal";
			TempRow($x0,$x1,$x2,$x3,$x4,$xB);
			$iGf++;
		}
	}
	?>
	
	<?php function TempRow($x0,$x1,$x2,$x3,$x4,$xB)
	{
	?>
	<tr height="22" style=" font-weight:<?=$xB?>">
	<td style="border:1px solid #000; padding-left:5px"><?=$x1?></td>
	<td style="border:1px solid #000; padding-left:3px"><?=$x2?></td>
	<td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($x3)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x4)?></td>
	</tr>
	<?php
	}
	?>
	<?php function EmptRow()
	{
	?>
	<tr height="22">
	<td style="border:1px solid #000; padding-left:4px">&nbsp;</td>
	<td style="border:1px solid #000; padding-left:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	</tr>
	<?php
	}
	?>
  <tr height="22">
    <td style="border:1px solid #000; text-align:center">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="25" style="font-weight:bold">
    <td colspan="2" style="border:1px solid #000; border-top:3px double #000; text-align:center">T O T A L</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:center"><?=fConvertToRupiahBulat($t3)?></td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t4)?></td>
  </tr>
</table>
<table border="0" width="800" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td width="350" style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td width="350" style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center"><?=$NmIbuk?>, <?=$Hri." ".fNmBulanLong($Bln)." ".$Thn?></td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center"><?=$Vx?></td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
  <tr height="50">
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center; font-weight:bold; text-decoration:underline"><?=$fP1Nma?></td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">NIP. <?=$fP1Nip?></td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center"><?=$fP1Pkt?></td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
</table>
