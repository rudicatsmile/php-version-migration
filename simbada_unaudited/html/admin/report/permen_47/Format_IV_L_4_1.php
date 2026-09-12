<?
require('../../Connection.php');
require('../../FileFunction.php');
require("../../CheckLogin.php");

$DatabaseSA = $DatabaseSB ;
$ConSA      = $ConSB;

extract($_GET);
$SkP = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($KdS,0,11),"=","","");

$TgA = $rThn."-01-01";
$TgB = $rThn."-06-30";
if ($rSem=='2') {$TgB = $rThn."-12-31";}

#echo $TgA."<br>";
#echo $TgB."<br>";

if ($RdB=='V1')
{
	$Vx = "KUASA PENGGUNA BARANG";
	$fP1Nma  = fGlobal("Nm_Pengurus","ref_unit","Kd_Unit",$KdS,"=","","");
	$fP1Nip  = fGlobal("Nip_Pengurus","ref_unit","Kd_Unit",$KdS,"=","","");
	$fP1Pkt  = fGlobal("Pkt_Pengurus","ref_unit","Kd_Unit",$KdS,"=","","");
	$fP1Jab  = fGlobal("Jbt_Pengurus","ref_unit","Kd_Unit",$KdS,"=","","");
}
if ($RdB=='V2')
{
	$Vx = "PENGGUNA BARANG";
	$fP1Nma  = fGlobal("Nm_Kepala","ref_unit","Kd_Unit",$KdS,"=","","");
	$fP1Nip  = fGlobal("Nip_Kepala","ref_unit","Kd_Unit",$KdS,"=","","");
	$fP1Pkt  = fGlobal("Pkt_Kepala","ref_unit","Kd_Unit",$KdS,"=","","");
	$fP1Jab  = fGlobal("Jbt_Kepala","ref_unit","Kd_Unit",$KdS,"=","","");
}
if ($RdB=='V3')
{
	$KdSx = "24.04.13.04";
	$Vx   = "PENGELOLA BARANG";
	$fP1Nma  = fGlobal("Nm_Pengurus","ref_unit","Kd_Unit",$KdSx,"=","","");
	$fP1Nip  = fGlobal("Nip_Pengurus","ref_unit","Kd_Unit",$KdSx,"=","","");
	$fP1Pkt  = fGlobal("Pkt_Pengurus","ref_unit","Kd_Unit",$KdSx,"=","","");
	$fP1Jab  = fGlobal("Jbt_Pengurus","ref_unit","Kd_Unit",$KdSx,"=","","");
}
?> 
<body>
<table border="0" width="800" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td style="text-align:right">Format IV.L.4.1</td>
  </tr>
</table>
<table border="0" width="800" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri">REKAPITULASI MUTASI TAMBAH DAN MUTASI KURANG LAPORAN BMD</td>
  </tr>
  <!-- <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri">MENURUT OBJEK</td>
  </tr> -->
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri"><?=$Vx?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-family:calibri; font-weight:bold"><?=strtoupper(NmaSemester($rSem))?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-family:calibri; font-weight:bold">TAHUN : <?=$rThn?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="800" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td width="80" valign="top">PROVINSI</td>
    <td width="20" valign="top">:</td>
    <td valign="top"><?=strtoupper($NmProv)?></td>
  </tr>
  <tr>
    <td valign="top">KABUPATEN</td>
    <td valign="top">:</td>
    <td valign="top"><?=strtoupper($NmDaer)?></td>
  </tr>
  <tr>
    <td valign="top">SKPD</td>
    <td valign="top">:</td>
    <td valign="top"><?=$SkP?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="800" align="center" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr height="25" style="font-weight:bold; text-align:center">
    <td colspan="2" style="border:1px solid #000">Penggolongan dan Kodefikasi Barang</td>
    <td rowspan="2" style="border:1px solid #000">Saldo Awal<br>(Rp)</td>
    <td rowspan="2" style="border:1px solid #000">Berambah<br>(Rp) </td>
    <td rowspan="2" style="border:1px solid #000">Berkurang<br>(Rp) </td>
    <td rowspan="2" style="border:1px solid #000">Saldo Akhir<br>(Rp) </td>
  </tr>
  <tr style="text-align:center; font-weight:bold">
    <td style="border:1px solid #000; border-bottom:1px solid #000">Kode Barang</td>
    <td style="border:1px solid #000; border-bottom:1px solid #000">Nama Barang</td>
  </tr>
  <tr style="text-align:center">
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">1</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">2</td>
    <td width="110" style="border:1px solid #000; border-bottom:3px double #000">3</td>
    <td width="110" style="border:1px solid #000; border-bottom:3px double #000">4</td>
    <td width="110" style="border:1px solid #000; border-bottom:3px double #000">5</td>
    <td width="110" style="border:1px solid #000; border-bottom:3px double #000">6</td>
  </tr>
	<?
	$t3=0;
	$t4=0;
	$t5=0;
	$t6=0;
	$SQa = "SELECT 
	'' as A0,
	Kd_Rek as A1, 
	Nm_Rek as A2 
	FROM ref_rek_90_1 WHERE Kd_Rek='1' ORDER BY Kd_Rek";
	$nRa = mysql_query($SQa);
	while ($mRa = mysql_fetch_array($nRa)) 
	{ 
		$x0 = "";
		$x1 = $mRa[1];
		$x2 = $mRa[2];
		if ($KdS == "24.04.07.03" && $rThn=='2024') #Dinkes, .....
		{
			$x3 = 0;
		}
		else
		{
			$x3 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":D:SLF","LIKE:LIKE:=:=:=","","");
		}
		$x4 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit:Mutasi",$KdS."%:".$x1."%:".$TgA.":".$TgB.":D:MTS:skpd","LIKE:LIKE:>=:<=:=:=:=","","");
		$x5 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit:Mutasi",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:MTS:skpd","LIKE:LIKE:>=:<=:=:=:=","","");
		$x6 = $x3 + $x4 - $x5;
		$xB = "bold";
		TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$xB);
		Level2($x1,$KdS,$TgA,$TgB,$rSem,$rThn,DatabaseSA,$ConSA);
		
		$t3 = $t3+$x3;
		$t4 = $t4+$x4;
		$t5 = $t5+$x5;
		$t6 = $t6+$x6;
		
	}
	
	function Level2($Mst,$KdS,$TgA,$TgB,$rSem,$rThn,$DatabaseSA,$ConSA)
	{
		$SQb = "SELECT 
		'' as A0,
		Kd_Rek as A1, 
		Nm_Rek as A2 
		FROM ref_rek_90_2 WHERE Kd_Rek LIKE '".$Mst.".1' ORDER BY Kd_Rek";
		$nRb = mysql_query($SQb);
		while ($mRb = mysql_fetch_array($nRb)) 
		{ 
			$x0 = "";
			$x1 = $mRb[1];
			$x2 = $mRb[2];
			if ($KdS == "24.04.07.03" && $rThn=='2024') #Dinkes, .....
			{
				$x3 = 0;
			}
			else
			{
				$x3 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":D:SLF","LIKE:LIKE:=:=:=","","");
			}
			$x4 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit:Mutasi",$KdS."%:".$x1."%:".$TgA.":".$TgB.":D:MTS:skpd","LIKE:LIKE:>=:<=:=:=:=","","");
			$x5 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit:Mutasi",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:MTS:skpd","LIKE:LIKE:>=:<=:=:=:=","","");
			$x6 = $x3 + $x4 - $x5;
			$xB = "bold";
			TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$xB);
			Level3($x1,$KdS,$TgA,$TgB,$rSem,$rThn,$DatabaseSA,$ConSA);
		}
	}
	
	function Level3($Mst,$KdS,$TgA,$TgB,$rSem,$rThn,$DatabaseSA,$ConSA)
	{
		$SQc = "SELECT 
		'' as A0,
		Kd_Rek as A1, 
		Nm_Rek as A2 
		FROM ref_rek_90_3 WHERE Kd_Rek LIKE '".$Mst.".12' ORDER BY Kd_Rek";
		$nRc = mysql_query($SQc);
		while ($mRc = mysql_fetch_array($nRc)) 
		{ 
			$x0 = "";
			$x1 = $mRc[1];
			$x2 = strtoupper($mRc[2]);
			if ($KdS == "24.04.07.03" && $rThn=='2024') #Dinkes, .....
			{
				$x3 = 0;
			}
			else
			{
				$x3 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":D:SLF","LIKE:LIKE:=:=:=","","");
			}
			$x4 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit:Mutasi",$KdS."%:".$x1."%:".$TgA.":".$TgB.":D:MTS:skpd","LIKE:LIKE:>=:<=:=:=:=","","");
			$x5 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit:Mutasi",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:MTS:skpd","LIKE:LIKE:>=:<=:=:=:=","","");
			$x6 = $x3 + $x4 - $x5;
			$xB = "bold";
			TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$xB);
			Level4($x1,$KdS,$TgA,$TgB,$rSem,$rThn,$DatabaseSA,$ConSA);
		}
	}
	
	function Level4($Mst,$KdS,$TgA,$TgB,$rSem,$rThn,$DatabaseSA,$ConSA)
	{
		$iGd = 1;
		$SQd = "SELECT 
		'' as A0,
		Kd_Rek as A1, 
		Nm_Rek as A2 
		FROM ref_rek_90_4 WHERE Kd_Rek LIKE '".$Mst.".%' ORDER BY Kd_Rek";
		$nRd = mysql_query($SQd);
		while ($mRd = mysql_fetch_array($nRd)) 
		{ 
			$x0 = "";
			$x1 = $mRd[1];
			$x2 = strtoupper($mRd[2]);
			if ($KdS == "24.04.07.03" && $rThn=='2024') #Dinkes, .....
			{
				$x3 = 0;
			}
			else
			{
				$x3 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":D:SLF","LIKE:LIKE:=:=:=","","");
			}
			
			$x4 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit:Mutasi",$KdS."%:".$x1."%:".$TgA.":".$TgB.":D:MTS:skpd","LIKE:LIKE:>=:<=:=:=:=","","");
			$x5 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit:Mutasi",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:MTS:skpd","LIKE:LIKE:>=:<=:=:=:=","","");
			$x6 = $x3 + $x4 - $x5;
			$xB = "bold";
			if ($iGd>1) {EmptRow();}
			TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$xB);
			Level5($x1,$KdS,$TgA,$TgB,$rSem,$rThn,$DatabaseSA,$ConSA);
			$iGd++;
		}
	}
	
	function Level5($Mst,$KdS,$TgA,$TgB,$rSem,$rThn,$DatabaseSA,$ConSA)
	{
		$iGe=1;
		$SQe = "SELECT 
		'' as A0,
		Kd_Rek as A1, 
		Nm_Rek as A2 
		FROM ref_rek_90_5 WHERE Kd_Rek LIKE '".$Mst.".%' ORDER BY Kd_Rek";
		$nRe = mysql_query($SQe);
		while ($mRe = mysql_fetch_array($nRe)) 
		{ 
			$x0 = "";
			$x1 = $mRe[1];
			$x2 = $mRe[2];
			$xB = "NORMAL";
			if ($KdS == "24.04.07.03" && $rThn=='2024') #Dinkes, .....
			{
				$x3 = 0;
			}
			else
			{
				$x3 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":D:SLF","LIKE:LIKE:=:=:=","","");
			}
			
			$x4 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit:Mutasi",$KdS."%:".$x1."%:".$TgA.":".$TgB.":D:MTS:skpd","LIKE:LIKE:>=:<=:=:=:=","","");
			$x5 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit:Mutasi",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:MTS:skpd","LIKE:LIKE:>=:<=:=:=:=","","");
			$x6 = $x3 + $x4 - $x5;
			
			#if ($iGe>1) {EmptRow();}
			TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$xB);
			#Level6($x1,$KdS,$TgA,$TgB,$rSem,$rThn,$DatabaseSA,$ConSA);
			$iGe++;
		}
	}
	
	function Level6($Mst,$KdS,$TgA,$TgB,$rSem,$rThn,$DatabaseSA,$ConSA)
	{
		$SQf = "SELECT 
		'' as A0,
		Kd_Rek as A1, 
		Nm_Rek as A2 
		FROM ref_rek_90_6 WHERE Kd_Rek LIKE '".$Mst.".%' ORDER BY Kd_Rek";
		$nRf = mysql_query($SQf);
		while ($mRf = mysql_fetch_array($nRf)) 
		{ 
			$x0 = "";
			$x1 = $mRf[1];
			$x2 = $mRf[2];
			$xB = "normal";
			
			if ($KdS == "24.04.07.03" && $rThn=='2024') #Dinkes, .....
			{
				$x3 = 0;
			}
			else
			{
				$x3 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":D:SLF","LIKE:LIKE:=:=:=","","");
			}
			
			$x4 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit:Mutasi",$KdS."%:".$x1."%:".$TgA.":".$TgB.":D:MTS:skpd","LIKE:LIKE:>=:<=:=:=:=","","");
			$x5 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit:Mutasi",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:MTS:skpd","LIKE:LIKE:>=:<=:=:=:=","","");
			$x6 = $x3 + $x4 - $x5;
			TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$xB);
		}
	}
	
	
	?>
	
	<? function TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$xB)
	{
	?>
	<tr height="22" style=" font-weight:<?=$xB?>">
	<td style="border:1px solid #000; padding-left:5px"><?=$x1?></td>
	<td style="border:1px solid #000; padding-left:3px"><?=$x2?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x3)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x4)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x5)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x6)?></td>
	</tr>
	<?
	}
	?>
	<? function EmptRow()
	{
	?>
	<tr height="22">
	<td style="border:1px solid #000; padding-left:4px">&nbsp;</td>
	<td style="border:1px solid #000; padding-left:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	</tr>
	<?
	}
	?>
  <tr height="22">
    <td style="border:1px solid #000; text-align:center">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="25" style="font-weight:bold">
    <td colspan="2" style="border:1px solid #000; border-top:3px double #000; text-align:center">T O T A L</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t3)?></td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t4)?></td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t5)?></td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t6)?></td>
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
