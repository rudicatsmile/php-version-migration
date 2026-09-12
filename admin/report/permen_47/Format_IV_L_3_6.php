<?php
require('../../Connection.php');
require('../../FileFunction.php');
require("../../CheckLogin.php");

$DatabaseSA = $DatabaseSB ;
$ConSA      = $ConSB;

extract($_GET);
$SkP = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($KdS,0,11),"=","","");

$TG = $rThn."-01-01";
if ($rSem==1) 
{
	$TGx = $rThn."-06-30";
	$TGz = $rThn."-12-31";	#Hitung data mutasi keluar
}
else 
{
	$TGx = $rThn."-12-31";
	$TGz = $rThn."-12-31";
}

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
    <td style="text-align:right">Format IV.L.3.6</td>
  </tr>
</table>
<table border="0" width="800" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri">REKAPITULASI LAPORAN ASET TETAP</td>
  </tr>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri">MENURUT JENIS </td>
  </tr>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri">INTRAKOMPTABEL</td>
  </tr>
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
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr> -->
</table>
<table border="0" width="800" align="center" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr height="25" style="font-weight:bold; text-align:center">
    <td colspan="2" style="border:1px solid #000">Penggolongan dan Kodefikasi Barang</td>
    <td rowspan="2" style="border:1px solid #000">Jumlah<br>(Rp)</td>
    <td rowspan="2" style="border:1px solid #000">Saldo Akhir<br>(Rp) </td>
  </tr>
  <tr style="text-align:center; font-weight:bold">
    <td style="border:1px solid #000; border-bottom:1px solid #000">Kode Barang</td>
    <td style="border:1px solid #000; border-bottom:1px solid #000">Nama Barang</td>
  </tr>
  <tr style="text-align:center">
    <td width="80" style="border:1px solid #000; border-bottom:3px double #000">1</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">2</td>
    <td width="110" style="border:1px solid #000; border-bottom:3px double #000">3</td>
    <td width="110" style="border:1px solid #000; border-bottom:3px double #000">4</td>
  </tr>
	<?php
	if ($KdS == "24.04.12.03") {$KdS = "24.04.12.05";} #Mapping Simbada Perindag
	if ($KdS == "24.04.07.03") {$KdS = "24.04.07.06";} #Mapping Simbada Dinkes
	if ($KdS == "24.04.12.02") {$KdS = "24.04.12.04";} #Mapping Simbada Naker
	if ($KdS == "24.04.07.04") {$KdS = "24.04.07.07";} #Mapping Simbada Pemberdayaan
	
	mysql_select_db(DatabaseSB, $ConSB);
	$t3=0;
	$t4=0;
	
	$SQb = "SELECT 
	'' as A0,
	Kd_Aset as A1, 
	Nm_Aset as A2 
	FROM ref_rek_aset108_2 WHERE Kd_Aset LIKE '1.5' ORDER BY Kd_Aset";
	$nRb = mysql_query($SQb);
	while ($mRb = mysql_fetch_array($nRb)) 
	{ 
		$x0 = "";
		$x1 = $mRb[1];
		$x2 = $mRb[2];
		
		$fs = "";
		$x3 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".%:".$TG.":N:N","LIKE:LIKE:<$sm:LIKE:=","",$fs);
		
		#tambah tanah
		$x4 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".1%:".$TG.":N:N","LIKE:LIKE:<$sm:LIKE:=","",$fs);
		#tambah kdp
		$x4 = $x4 + fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".6%:".$TG.":N:N","LIKE:LIKE:<$sm:LIKE:=","",$fs);
		
		$x32  = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:1.5.2.%:".$TG.":N:N","LIKE:LIKE:<$sm:LIKE:=","",$fs);
		$x32P = fGlobal("ifnull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:Tahun:Extracom",$KdS."%:1.5.2.%:".($rThn-1).":N","LIKE:LIKE:=:LIKE","","");
		$x4 = $x4 + ($x32-$x32P);
		#echo $x32-$x32P."<br>";
		
		$x33  = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:1.5.3.%:".$TG.":N:N","LIKE:LIKE:<$sm:LIKE:=","",$fs);
		$x33P = fGlobal("ifnull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:Tahun:Extracom",$KdS."%:1.5.3.%:".($rThn-1).":N","LIKE:LIKE:=:LIKE","","");
		$x4 = $x4 + ($x33-$x33P);
		#echo $x33-$x33P."<br>";
		
		$x34  = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:1.5.4.%:".$TG.":N:N","LIKE:LIKE:<$sm:LIKE:=","",$fs);
		$x34P = fGlobal("ifnull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:Tahun:Extracom",$KdS."%:1.5.4.%:".($rThn-1).":N","LIKE:LIKE:=:LIKE","","");
		$x4 = $x4 + ($x34-$x34P);
		#echo $x34-$x34P."<br>";
		
		$x35  = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:1.5.5.%:".$TG.":N:N","LIKE:LIKE:<$sm:LIKE:=","",$fs);
		$x35P = fGlobal("ifnull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:Tahun:Extracom",$KdS."%:1.5.5.%:".($rThn-1).":N","LIKE:LIKE:=:LIKE","","");
		$x4 = $x4 + ($x35-$x35P);
		#echo $x35-$x35P."<br>";
		
		#penyusutan total
		$x4 = $x4 + fGlobal("ifnull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:Tahun:Extracom",$KdS."%:1.5.%:".($rThn-1).":N","LIKE:LIKE:=:LIKE","","");
		
		$xB = "bold";
		TempRow($x0,$x1,$x2,$x3,$x4,$xB);
		Level3($x1,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,DatabaseSA,$ConSA,DatabaseSB,$ConSB);
		$t3 = $t3+$x3;
		$t4 = $t4+$x4;
	}
	
	function Level3($Mst,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB)
	{
		$iGc = 1;
		$SQc = "SELECT 
		'' as A0,
		Kd_Aset as A1, 
		Nm_Aset as A2 
		FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '".$Mst.".%' ORDER BY Kd_Aset";
		$nRc = mysql_query($SQc);
		while ($mRc = mysql_fetch_array($nRc)) 
		{ 
			$x0 = "";
			$x1 = $mRc[1];
			$x2 = ucwords(strtolower($mRc[2]));
			
			$fs = "";
			$x3 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".%:".$TG.":N:N","LIKE:LIKE:<$sm:LIKE:=","",$fs);
			
			if ($x1=='1.5.1' || $x1=='1.5.6')
			{
				$x4 = $x3;
			}
			else if ($x1=='1.5.7')
			{
				$p132 = fGlobal("ifnull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:Tahun:Extracom",$KdS."%:1.5.2.%:".($rThn-1).":N","LIKE:LIKE:=:LIKE","","");
				$p133 = fGlobal("ifnull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:Tahun:Extracom",$KdS."%:1.5.3.%:".($rThn-1).":N","LIKE:LIKE:=:LIKE","","");
				$p134 = fGlobal("ifnull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:Tahun:Extracom",$KdS."%:1.5.4.%:".($rThn-1).":N","LIKE:LIKE:=:LIKE","","");
				$p135 = fGlobal("ifnull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:Tahun:Extracom",$KdS."%:1.5.5.%:".($rThn-1).":N","LIKE:LIKE:=:LIKE","","");
				$x4 = $p132+$p133+$p134+$p135;
			}
			else
			{
				$x4 = $x3 - fGlobal("ifnull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:Tahun:Extracom",$KdS."%:".$x1."%:".($rThn-1).":N","LIKE:LIKE:=:LIKE","","");
			}
			
			$xB = "normal";
			#if ($iGc>1) {EmptRow();}
			TempRow($x0,$x1,$x2,$x3,$x4,$xB);
			#Level4($x1,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB);
			$iGc++;
		}
	}
	
	function Level4($Mst,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB)
	{
		$iGd = 1;
		$SQd = "SELECT 
		'' as A0,
		Kd_Aset as A1, 
		Nm_Aset as A2 
		FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '".$Mst.".%' ORDER BY Kd_Aset";
		$nRd = mysql_query($SQd);
		while ($mRd = mysql_fetch_array($nRd)) 
		{ 
			$x0 = "";
			$x1 = $mRd[1];
			$x2 = ucwords(strtolower($mRd[2]));
			
			$fs = "";
			$x3 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".%:".$TG.":N:N","LIKE:LIKE:<$sm:LIKE:=","",$fs);
			
			if ($x1=='1.5.6.01')
			{
				$x4 = $x3;
			}
			else if ($x1=='1.5.7.01')
			{
				$x4 = fGlobal("ifnull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:Tahun:Extracom",$KdS."%:1.5.2.%:".($rThn-1).":N","LIKE:LIKE:=:LIKE","","");;
			}
			else if ($x1=='1.5.7.02')
			{
				$x4 = fGlobal("ifnull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:Tahun:Extracom",$KdS."%:1.5.3.%:".($rThn-1).":N","LIKE:LIKE:=:LIKE","","");;
			}
			else if ($x1=='1.5.7.03')
			{
				$x4 = fGlobal("ifnull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:Tahun:Extracom",$KdS."%:1.5.4.%:".($rThn-1).":N","LIKE:LIKE:=:LIKE","","");;
			}
			else if ($x1=='1.5.7.04')
			{
				$x4 = fGlobal("ifnull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:Tahun:Extracom",$KdS."%:1.5.5.%:".($rThn-1).":N","LIKE:LIKE:=:LIKE","","");;
			}
			else
			{
				$x4 = $x3 - fGlobal("ifnull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:Tahun:Extracom",$KdS."%:".$x1."%:".($rThn-1).":N","LIKE:LIKE:=:LIKE","","");
			}
			
			$xB = "normal";
			TempRow($x0,$x1,$x2,$x3,$x4,$xB);
			$iGd++;
		}
	}
	
	?>
	
	<?php function TempRow($x0,$x1,$x2,$x3,$x4,$xB)
	{
	?>
	<tr height="22" style=" font-weight:<?=$xB?>">
	<td style="border:1px solid #000; padding-left:5px"><?=$x1?></td>
	<td style="border:1px solid #000; padding-left:3px"><?=$x2?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x3)?></td>
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
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t3)?></td>
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
