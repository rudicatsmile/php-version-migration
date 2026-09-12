<?php
require('../../Connection.php');
require('../../FileFunction.php');
require("../../CheckLogin.php");

$DatabaseSA = $DatabaseSB ;
$ConSA = $ConSB;

extract($_GET);

$KdS = "__.__.__.__";
$SkP = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($KdS,0,11),"=","","");

$TgA = $rThn."-01-01";
$TgB = $rThn."-06-30";
if ($rSem=='2') {$TgB = $rThn."-12-31";}

$KdSx = "25.08.13.04";
$Vx   = "PENGELOLA BARANG";
$fP1Nma  = fGlobal("Nm_Pengurus","ref_unit","Kd_Unit",$KdSx,"=","","");
$fP1Nip  = fGlobal("Nip_Pengurus","ref_unit","Kd_Unit",$KdSx,"=","","");
$fP1Pkt  = fGlobal("Pkt_Pengurus","ref_unit","Kd_Unit",$KdSx,"=","","");
$fP1Jab  = fGlobal("Jbt_Pengurus","ref_unit","Kd_Unit",$KdSx,"=","","");
?> 
<body>
<table border="0" width="800" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td style="text-align:right">Format IV.L.4.3</td>
  </tr>
</table>
<table border="0" width="800" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri">REKAPITULASI MUTASI TAMBAH DAN KURANG BMD</td>
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
  <!-- <tr>
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
  </tr> -->
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
    <td rowspan="2" style="border:1px solid #000">Bertambah<br>
      (Rp) </td>
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
	<?php
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
		
		#ASET LANCAR
		$x3 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":D:SLD","LIKE:LIKE:=:=:=","","");
		$x4 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":".$TgB.":D:PGD","LIKE:LIKE:>=:<=:=:=:=","","");
		$x5 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:PMK","LIKE:LIKE:>=:<=:=:=:=","","");
		$x5 = $x5+fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:RTR","LIKE:LIKE:>=:<=:=:=:=","","");
		
		##################
		#ASET TETAP
		$x1A = "1.3";
		$x3A = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1A.".%:".$TgA.":N:N","LIKE:LIKE:<$sm:LIKE:=","","");
		#mutasi masuk
		$x4A = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Tanggal:Extracom",$KdS."%:".$x1A.".%:".$TgA.":".$TgB.":N","LIKE:LIKE:>=:<=:LIKE","","");
		#mutasi keluar
		$x5A = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_Aset_108:Tgl_Mutasi:Tgl_Mutasi:Extracom:Jns_Mutasi",$KdS."%:".$x1A.".%:".$TgA.":".$TgB.":N:RB","LIKE:LIKE:>=:<=:LIKE:=","","");
		$x3A = $x3A+$x5A;
		$x6A = $x3A+$x4A-$x5A;
		#ASET LAINNYA
		$x1B = "1.5";
		$x3B = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1B.".%:1.5.4.%:".$TgA.":N:N","LIKE:LIKE:NOT LIKE:<$sm:LIKE:=","","");
		#mutasi masuk
		$x4B = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_Aset_108_To:Kd_Aset_108_To:Tgl_Mutasi:Tgl_Mutasi:Extracom:Jns_Mutasi",$KdS."%:".$x1B.".%:1.5.4.%:".$TgA.":".$TgB.":N:MK","LIKE:LIKE:NOT LIKE:>=:<=:LIKE:=","","");
		#mutasi keluar
		$x5B = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_Aset_108:Kd_Aset_108:Tgl_Mutasi:Tgl_Mutasi:Extracom:Jns_Mutasi",$KdS."%:".$x1B.".%:1.5.4.%:".$TgA.":".$TgB.":N:RB","LIKE:LIKE:NOT LIKE:>=:<=:LIKE:=","","");
		$x3B = $x3B+$x5B;
		$x6B = $x3B+$x4B-$x5B;
		#??????????????
		
		##################
		$x3 = $x3+$x3A+$x3B;
		$x4 = $x4+$x4A+$x4B;
		$x5 = $x5+$x5A+$x5B;
		$x6 = $x6+$x6A+$x6B;
		
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
			$x3 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":D:SLD","LIKE:LIKE:=:=:=","","");
			$x4 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":".$TgB.":D:PGD","LIKE:LIKE:>=:<=:=:=:=","","");
			$x5 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:PMK","LIKE:LIKE:>=:<=:=:=:=","","");
			$x5 = $x5+fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:RTR","LIKE:LIKE:>=:<=:=:=:=","","");
			
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
			$x3 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":D:SLD","LIKE:LIKE:=:=:=","","");
			$x4 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":".$TgB.":D:PGD","LIKE:LIKE:>=:<=:=:=:=","","");
			$x5 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:PMK","LIKE:LIKE:>=:<=:=:=:=","","");
			$x5 = $x5+fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:RTR","LIKE:LIKE:>=:<=:=:=:=","","");
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
			$x3 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":D:SLD","LIKE:LIKE:=:=:=","","");
			$x4 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":".$TgB.":D:PGD","LIKE:LIKE:>=:<=:=:=:=","","");
			$x5 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:PMK","LIKE:LIKE:>=:<=:=:=:=","","");
			$x5 = $x5+fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:RTR","LIKE:LIKE:>=:<=:=:=:=","","");
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
			$x3 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":D:SLD","LIKE:LIKE:=:=:=","","");
			$x4 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":".$TgB.":D:PGD","LIKE:LIKE:>=:<=:=:=:=","","");
			$x5 = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:PMK","LIKE:LIKE:>=:<=:=:=:=","","");
			$x5 = $x5+fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:Tanggal:DK:Crit",$KdS."%:".$x1."%:".$TgA.":".$TgB.":K:RTR","LIKE:LIKE:>=:<=:=:=:=","","");
			$x6 = $x3 + $x4 - $x5;
			
			#if ($iGe>1) {EmptRow();}
			TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$xB);
			$iGe++;
		}
	}
	
	EmptRow();
	
	##################################################
	$iA = 1;
	$SQ1 = "SELECT 
	'' as A0,
	Kd_Aset as A1, 
	Nm_Aset as A2 
	FROM ref_rek_aset108_2 WHERE (Kd_Aset LIKE '1.3' OR Kd_Aset LIKE '1.5') ORDER BY Kd_Aset";
	$nR1 = mysql_query($SQ1);
	while ($mR1 = mysql_fetch_array($nR1)) 
	{
		$xB = "bold";
		$x0 = "";
		$x1 = $mR1[1];
		$x2 = $mR1[2];
		$x3=0; $x4=0; $x5=0; $x6=0;
		
		if (substr($x1,0,3)=='1.3')
		{
			$x3 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".%:".$TgA.":N:N","LIKE:LIKE:<$sm:LIKE:=","","");
			#mutasi masuk
			$x4 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Tanggal:Extracom",$KdS."%:".$x1.".%:".$TgA.":".$TgB.":N","LIKE:LIKE:>=:<=:LIKE","","");
			#mutasi keluar
			$x5 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_Aset_108:Tgl_Mutasi:Tgl_Mutasi:Extracom:Jns_Mutasi",$KdS."%:".$x1.".%:".$TgA.":".$TgB.":N:RB","LIKE:LIKE:>=:<=:LIKE:=","","");
			$x3 = $x3+$x5;
		}
		if (substr($x1,0,3)=='1.5')
		{
			$x3 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".%:1.5.4%:".$TgA.":N:N","LIKE:LIKE:NOT LIKE:<$sm:LIKE:=","","");
			#mutasi masuk
			$x4 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Kd_Aset_108:Tanggal:Tanggal:Extracom",$KdS."%:".$x1.".%:1.5.4%:".$TgA.":".$TgB.":N","LIKE:LIKE:NOT LIKE:>=:<=:LIKE","","");
			#mutasi keluar
			$x5 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_Aset_108:Kd_Aset_108:Tgl_Mutasi:Tgl_Mutasi:Extracom:Jns_Mutasi",$KdS."%:".$x1.".%:1.5.4%:".$TgA.":".$TgB.":N:RB","LIKE:LIKE:NOT LIKE:>=:<=:LIKE:=","","");
			$x3 = $x3+$x5;
		}
		$x6 = $x3+$x4-$x5;
		
		if ($iA>1) {EmptRow();}
		TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$xB);
		Level3A($x1,$KdS,$TgA,$TgB);
		$iA++;
	}
	
	function Level3A($nR,$KdS,$TgA,$TgB)
	{
		$iB = 1;
		$SQ2 = "SELECT 
		'' as A0,
		Kd_Aset as A1, 
		Nm_Aset as A2 
		FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '".$nR."%' AND Kd_Aset <> '1.3.7' AND Kd_Aset <> '1.5.4' AND Kd_Aset <> '1.5.5' AND Kd_Aset <> '1.5.6' ORDER BY Kd_Aset";
		$nR2 = mysql_query($SQ2);
		while ($mR2 = mysql_fetch_array($nR2)) 
		{ 
			$xB = "bold";
			$x0 = "";
			$x1 = $mR2[1];
			$x2 = strtoupper($mR2[2]);
			
			$x3=0; $x4=0; $x5=0; $x6=0;
			if (substr($x1,0,3)=='1.3')
			{
				$x3 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".%:".$TgA.":N:N","LIKE:LIKE:<$sm:LIKE:=","","");
				#mutasi masuk
				$x4 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Tanggal:Extracom",$KdS."%:".$x1.".%:".$TgA.":".$TgB.":N","LIKE:LIKE:>=:<=:LIKE","","");
				#mutasi keluar
				$x5 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_Aset_108:Tgl_Mutasi:Tgl_Mutasi:Extracom:Jns_Mutasi",$KdS."%:".$x1.".%:".$TgA.":".$TgB.":N:RB","LIKE:LIKE:>=:<=:LIKE:=","","");
				$x3 = $x3+$x5;
			}
			if (substr($x1,0,3)=='1.5')
			{
				$x3 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".%:".$TgA.":N:N","LIKE:LIKE:<$sm:LIKE:=","","");
				#mutasi masuk
				$x4 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB_To:Kd_Aset_108_To:Tgl_Mutasi:Tgl_Mutasi:Extracom:Jns_Mutasi",$KdS."%:".$x1.".%:".$TgA.":".$TgB.":N:MK","LIKE:LIKE:>=:<=:LIKE:=","","");
				#mutasi keluar
				$x5 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_Aset_108:Tgl_Mutasi:Tgl_Mutasi:Extracom:Jns_Mutasi",$KdS."%:".$x1.".%:".$TgA.":".$TgB.":N:RB","LIKE:LIKE:>=:<=:LIKE:=","","");
				$x3 = $x3+$x5;
			}
			$x6 = $x3+$x4-$x5;
			
			if ($iB>1) {EmptRow();}
			TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$xB);
			Level4A($x1,$KdS,$TgA,$TgB);
			$iB++;
		}
	}
	
	function Level4A($nR,$KdS,$TgA,$TgB)
	{
		$iC = 1;
		$SQ3 = "SELECT 
		'' as A0,
		Kd_Aset as A1, 
		Nm_Aset as A2 
		FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '".$nR."%' ORDER BY Kd_Aset";
		$nR3 = mysql_query($SQ3);
		while ($mR3 = mysql_fetch_array($nR3)) 
		{ 
			$xB = "bold";
			$x0 = "";
			$x1 = $mR3[1];
			$x2 = strtoupper($mR3[2]);
			
			$x3=0; $x4=0; $x5=0; $x6=0;
			if (substr($x1,0,3)=='1.3')
			{
				$x3 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".%:".$TgA.":N:N","LIKE:LIKE:<$sm:LIKE:=","","");
				#mutasi masuk
				$x4 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Tanggal:Extracom",$KdS."%:".$x1.".%:".$TgA.":".$TgB.":N","LIKE:LIKE:>=:<=:LIKE","","");
				#mutasi keluar
				$x5 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_Aset_108:Tgl_Mutasi:Tgl_Mutasi:Extracom:Jns_Mutasi",$KdS."%:".$x1.".%:".$TgA.":".$TgB.":N:RB","LIKE:LIKE:>=:<=:LIKE:=","","");
				$x3 = $x3+$x5;
			}
			if (substr($x1,0,3)=='1.5')
			{
				$x3 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".%:".$TgA.":N:N","LIKE:LIKE:<$sm:LIKE:=","","");
				#mutasi masuk
				$x4 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB_To:Kd_Aset_108_To:Tgl_Mutasi:Tgl_Mutasi:Extracom:Jns_Mutasi",$KdS."%:".$x1.".%:".$TgA.":".$TgB.":N:MK","LIKE:LIKE:>=:<=:LIKE:=","","");
				#mutasi keluar
				$x5 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_Aset_108:Tgl_Mutasi:Tgl_Mutasi:Extracom:Jns_Mutasi",$KdS."%:".$x1.".%:".$TgA.":".$TgB.":N:RB","LIKE:LIKE:>=:<=:LIKE:=","","");
				$x3 = $x3+$x5;
			}
			$x6 = $x3+$x4-$x5;
			
			if ($iC>1) {EmptRow();}
			TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$xB);
			Level5A($x1,$KdS,$TgA,$TgB);
			$iC++;
		}
	}
	
	function Level5A($nR,$KdS,$TgA,$TgB)
	{
		$iD = 1;
		$SQ4 = "SELECT 
		'' as A0,
		Kd_Aset as A1, 
		Nm_Aset as A2 
		FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$nR."%' ORDER BY Kd_Aset";
		$nR4 = mysql_query($SQ4);
		while ($mR4 = mysql_fetch_array($nR4)) 
		{ 
			$xB = "normal";
			$x0 = "";
			$x1 = $mR4[1];
			$x2 = ucwords(strtolower($mR4[2]));
			
			$x3=0; $x4=0; $x5=0; $x6=0;
			if (substr($x1,0,3)=='1.3')
			{
				$x3 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".%:".$TgA.":N:N","LIKE:LIKE:<$sm:LIKE:=","","");
				#mutasi masuk
				$x4 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Tanggal:Extracom",$KdS."%:".$x1.".%:".$TgA.":".$TgB.":N","LIKE:LIKE:>=:<=:LIKE","","");
				#mutasi keluar
				$x5 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_Aset_108:Tgl_Mutasi:Tgl_Mutasi:Extracom:Jns_Mutasi",$KdS."%:".$x1.".%:".$TgA.":".$TgB.":N:RB","LIKE:LIKE:>=:<=:LIKE:=","","");
				$x3 = $x3+$x5;
			}
			if (substr($x1,0,3)=='1.5')
			{
				$x3 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".%:".$TgA.":N:N","LIKE:LIKE:<$sm:LIKE:=","","");
				#mutasi masuk
				$x4 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB_To:Kd_Aset_108_To:Tgl_Mutasi:Tgl_Mutasi:Extracom:Jns_Mutasi",$KdS."%:".$x1.".%:".$TgA.":".$TgB.":N:MK","LIKE:LIKE:>=:<=:LIKE:=","","");
				#mutasi keluar
				$x5 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_Aset_108:Tgl_Mutasi:Tgl_Mutasi:Extracom:Jns_Mutasi",$KdS."%:".$x1.".%:".$TgA.":".$TgB.":N:RB","LIKE:LIKE:>=:<=:LIKE:=","","");
				$x3 = $x3+$x5;
			}
			$x6 = $x3+$x4-$x5;
			
			TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$xB);
		}
	}
	?>
	
	<?php function TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$xB)
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
