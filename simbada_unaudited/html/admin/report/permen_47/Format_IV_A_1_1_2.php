<?
// require "../../connfile.php";
// require "../../configfile.php";
// require "../../functionfile.php";

require('../../Connection.php');
require('../../FileFunction.php');
require("../../CheckLogin.php");

$DatabaseSA = $DatabaseSB ;
$ConSA      = $ConSB;
extract($_GET);
$SkP = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($KdS,0,11),"=","","");

$TG = $rThn."-01-01";
$rMonth = fNmBulan(date('m'));
if ($rSem==1) 
{
	#$TGx = $rThn."-06-30";
	$TGx = $rThn."-12-31";
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
<table border="0" width="1500" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td style="text-align:right">Format IV.L.2.1</td>
  </tr>
</table>
<table border="0" width="1500" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri">LAPORAN PENGADAAN BMD BERUPA ASET LANCAR PERSEDIAAN    </td>
  </tr>
  <!-- <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri"> <? if ($nR!=''){ echo "ASET TETAP ".fGlobal("nm_aset","ref_rek_aset108_3","kd_aset",$nR,"=","",DatabaseSB,$ConSB,"")." ";}?>MENURUT OBJEK</td>
  </tr>-->
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri"></td>
  </tr>
  
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri; font-size:10pt"><?=$Vx?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri; font-size:10pt"><?=$SkP?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-family:calibri; font-weight:bold; font-size:10pt">BULAN <?=strtoupper($rMonth)?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-family:calibri; font-weight:bold; font-size:10pt">TAHUN : <?=$rThn?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="1500" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
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
  <!-- <tr>
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

<table border="0" width="1500" align="center" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:9pt">
  <tr height="25" style="font-weight:bold; text-align:center">
    <td colspan="2" style="border:1px solid #000" rowspan="2">Penggolongan dan Kodefikasi Barang</td>
    <td style="border:1px solid #000" rowspan="3">Spesifikasi nama barang</td>
    <td style="border:1px solid #000" rowspan="3">Merk/Type</td>
    <td style="border:1px solid #000" rowspan="3">Jumlah Barang</td>
    <td style="border:1px solid #000" rowspan="3">Satuan barang</td>
    <td style="border:1px solid #000" rowspan="3">Harga barang</td>
    <td style="border:1px solid #000" rowspan="3">Total nilai barang</td>
    <td style="border:1px solid #000" rowspan="3">Total nilai atribusi</td>
    <td style="border:1px solid #000" rowspan="3">Nilai perolehan barang</td>
    <td style="border:1px solid #000" rowspan="3">Harga satuan perolehan</td>
    <td colspan="4" style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000" rowspan="3">Tanggal perolehan</td>
    <td colspan="3" style="border:1px solid #000" rowspan="2">Dokumen sumber 
	perolehan</td>
    <td rowspan="3" style="border:1px solid #000">Keterangan</td>
  </tr>
  <tr height="25" style="font-weight:bold; text-align:center">
    <td colspan="2" style="border:1px solid #000">Sub kegiatan</td>
    <td colspan="2" style="border:1px solid #000">Rekening belanja daerah</td>
  </tr>
  <tr style="text-align:center; font-weight:bold">
    <td style="border:1px solid #000; border-bottom:1px solid #000">Kode<br>Barang</td>
    <td style="border:1px solid #000; border-bottom:1px solid #000">Nama Barang</td>
    <td style="border:1px solid #000">Kode sub kegiatan</td>
    <td style="border:1px solid #000">Nama sub kegiatan</td>
    <td style="border:1px solid #000">Kode rekening</td>
    <td style="border:1px solid #000">Uraian Belanja</td>
    <td style="border:1px solid #000">Bentuk kontrak</td>
    <td style="border:1px solid #000">Nama Penyedia</td>
    <td style="border:1px solid #000">Nomor</td>
  </tr>
  <tr style="text-align:center">
    <td width="60" style="border:1px solid #000; border-bottom:3px double #000">
	(7)</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">(8)</td>
    <td width="80" style="border:1px solid #000; border-bottom:3px double #000">
	(9)</td>
    <td width="80" style="border:1px solid #000; border-bottom:3px double #000">
	(10)</td>
    <td width="80" style="border:1px solid #000; border-bottom:3px double #000">
	(11)</td>
    <td width="80" style="border:1px solid #000; border-bottom:3px double #000">
	(12)</td>
    <td width="80" style="border:1px solid #000; border-bottom:3px double #000">
	(13)</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">
	(14)=(11)x(13)</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">
	(15)</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">
	(16)=(14)+(15)</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">
	(17)=(16)/(11)</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">
	(18)</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">
	(19)</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">
	(20)</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">
	(21)</td>
    <td width="80" style="border:1px solid #000; border-bottom:3px double #000">
	(22)</td>
    <td width="80" style="border:1px solid #000; border-bottom:3px double #000">
	(23)</td>
    <td width="80" style="border:1px solid #000; border-bottom:3px double #000">
	(24)</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">
	(25)</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">
	(26)</td>
  </tr>
	<?
	if ($KdS == "24.04.12.03") {$KdS = "24.04.12.05";} #Mapping Simbada Perindag
	if ($KdS == "24.04.07.03") {$KdS = "24.04.07.06";} #Mapping Simbada Dinkes
	if ($KdS == "24.04.12.02") {$KdS = "24.04.12.04";} #Mapping Simbada Naker
	if ($KdS == "24.04.07.04") {$KdS = "24.04.07.07";} #Mapping Simbada Pemberdayaan
	
	mysql_select_db(DatabaseSB, $ConSB);
	$t3=0; $t4=0;$t5=0; $t6=0; $t7=0; $t8=0; $t9=0; $t10=0; $t11=0; $t12=0; $t13=0; $t14=0; $t15=0;
		
	$SQb = "SELECT 
	'' as A0,
	Kd_Aset as A1, 
	Nm_Aset as A2 
	FROM ref_rek_aset108_2 WHERE Kd_Aset LIKE '1.3' ORDER BY Kd_Aset";
	$nRb = mysql_query($SQb);
	while ($mRb = mysql_fetch_array($nRb)) 
	{ 
		$x0 = "";
		$x1 = $mRb[1];
		$x2 = $mRb[2];
		
		$x3=0; $x4=0; $x5=0; $x6=0; $x7=0; $x8=0; $x9=0; $x10=0; $x11=0; $x12=0; $x13=0; $x14=0; $x15=0;
			
		$fs = "";
		if ($nR!='')
		{
			$x3 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$nR.".%:".$TG.":N:N","LIKE:LIKE:<$sm:LIKE:=","",$fs);
			#mutasi masuk
			$x9 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB_To:Kd_Aset_108_To:Tanggal:Tgl_Mutasi:Extracom",$KdS."%:".$nR.".%:".$TG.":".$TG.":N","LIKE:LIKE:<:>=:LIKE","","");
			#mutasi keluar
			$x14 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_Aset_108:Tanggal:Tgl_Mutasi:Extracom",$KdS."%:".$nR.".%:".$TG.":".$TG.":N","LIKE:LIKE:<:>=:LIKE","",$fs);
		}
		else
		{
			$x3 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".%:".$TG.":N:N","LIKE:LIKE:<$sm:LIKE:=","",$fs);
			#mutasi masuk
			$x9 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB_To:Kd_Aset_108_To:Tanggal:Tgl_Mutasi:Extracom",$KdS."%:".$x1.".%:".$TG.":".$TG.":N","LIKE:LIKE:<:>=:LIKE","","");
			#mutasi keluar
			$x14 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_Aset_108:Tanggal:Tgl_Mutasi:Extracom",$KdS."%:".$x1.".%:".$TG.":".$TG.":N","LIKE:LIKE:<:>=:LIKE","",$fs);
		}
		$x3  = $x3+$x14-$x9;
		
		#sementara
		$x8  = $x9;
		$x12 = $x14;
		
		if ($KdS == "24.04.12.04" && $rThn=='2024'){$x3 = 0;}
		else if ($KdS == "24.04.07.06" && $rThn=='2024'){$x3 = 0;}
		else if ($KdS == "24.04.07.07" && $rThn=='2024'){$x3 = 0;}
		else if ($KdS == "24.04.13.03" && $rThn=='2024'){$x3 = 0;}
		else if ($KdS == "24.04.10.03" && $rThn=='2024'){$x3 = 0;}
		
		$x15 = $x3 + $x9 - $x14;
		$xB = "bold";
		TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$xB);
		Level3($nR,$x1,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,DatabaseSA,$ConSA,DatabaseSB,$ConSB);
		$t3 = $t3+$x3;
		$t4 = $t4+$x4;
		$t5 = $t5+$x5;
		$t6 = $t6+$x6;
		$t7 = $t7+$x7;
		$t8 = $t8+$x8;
		$t9 = $t9+$x9;
		$t10 = $t10+$x10;
		$t11 = $t11+$x11;
		$t12 = $t12+$x12;
		$t13 = $t13+$x13;
		$t14 = $t14+$x14;
		$t15 = $t15+$x15;
	}
	
	function Level3($nR,$Mst,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB)
	{
		$iGc = 1;
		if ($nR!='')
		{
			$SQc = "SELECT 
			'' as A0,
			Kd_Aset as A1, 
			Nm_Aset as A2 
			FROM ref_rek_aset108_3 WHERE Kd_Aset = '".$nR."' ORDER BY Kd_Aset";
		}
		else
		{
			$SQc = "SELECT 
			'' as A0,
			Kd_Aset as A1, 
			Nm_Aset as A2 
			FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '".$Mst.".%' AND Kd_Aset NOT LIKE '".$Mst.".7' ORDER BY Kd_Aset";
		}
		$nRc = mysql_query($SQc);
		while ($mRc = mysql_fetch_array($nRc)) 
		{ 
			$x0 = "";
			$x1 = $mRc[1];
			$x2 = strtoupper($mRc[2]);
			
			$x3=0; $x4=0; $x5=0; $x6=0; $x7=0; $x8=0; $x9=0; $x10=0; $x11=0; $x12=0; $x13=0; $x14=0; $x15=0;
			
			$fs = "";
			$x3 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".%:".$TG.":N:N","LIKE:LIKE:<$sm:LIKE:=","",$fs);
			#mutasi masuk
			$x9 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB_To:Kd_Aset_108_To:Tanggal:Tgl_Mutasi:Extracom",$KdS."%:".$x1.".%:".$TG.":".$TG.":N","LIKE:LIKE:<:>=:LIKE","","");
			#mutasi keluar
			$x14 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_Aset_108:Tanggal:Tgl_Mutasi:Extracom",$KdS."%:".$x1.".%:".$TG.":".$TG.":N","LIKE:LIKE:<:>=:LIKE","",$fs);
			$x3  = $x3+$x14-$x9;
			
			#sementara
			$x8  = $x9;
			$x12 = $x14;
			
			if ($KdS == "24.04.12.04" && $rThn=='2024'){$x3 = 0;}
			else if ($KdS == "24.04.07.06" && $rThn=='2024'){$x3 = 0;}
			else if ($KdS == "24.04.07.07" && $rThn=='2024'){$x3 = 0;}
			else if ($KdS == "24.04.13.03" && $rThn=='2024'){$x3 = 0;}
			else if ($KdS == "24.04.10.03" && $rThn=='2024'){$x3 = 0;}
			
			$x15 = $x3 + $x9 - $x14;
			$xB = "bold";
			if ($iGc>1) {EmptRow();}
			TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$xB);
			Level4($x1,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB);
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
			
			$x3=0; $x4=0; $x5=0; $x6=0; $x7=0; $x8=0; $x9=0; $x10=0; $x11=0; $x12=0; $x13=0; $x14=0; $x15=0;
			
			$fs = "";
			$x3 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108","Kd_UPB:Kd_Aset_108:Tanggal:Extracom:KdpToAset",$KdS."%:".$x1.".%:".$TG.":N:N","LIKE:LIKE:<$sm:LIKE:=","",$fs);
			#mutasi masuk
			$x9 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB_To:Kd_Aset_108_To:Tanggal:Tgl_Mutasi:Extracom",$KdS."%:".$x1.".%:".$TG.":".$TG.":N","LIKE:LIKE:<:>=:LIKE","","");
			#mutasi keluar
			$x14 = fGlobal("ifnull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_UPB:Kd_Aset_108:Tanggal:Tgl_Mutasi:Extracom",$KdS."%:".$x1.".%:".$TG.":".$TG.":N","LIKE:LIKE:<:>=:LIKE","",$fs);
			$x3  = $x3+$x14-$x9;
			
			#sementara
			$x8  = $x9;
			$x12 = $x14;
			
			if ($KdS == "24.04.12.04" && $rThn=='2024'){$x3 = 0;}
			else if ($KdS == "24.04.07.06" && $rThn=='2024'){$x3 = 0;}
			else if ($KdS == "24.04.07.07" && $rThn=='2024'){$x3 = 0;}
			else if ($KdS == "24.04.13.03" && $rThn=='2024'){$x3 = 0;}
			else if ($KdS == "24.04.10.03" && $rThn=='2024'){$x3 = 0;}
			
			$x15 = $x3 + $x9 - $x14;
			$xB = "normal";
			TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$xB);
			$iGd++;
		}
	}
	
	?>
	
	<? function TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$xB)
	{
	?>
	<tr height="22" style=" font-weight:<?=$xB?>">
	<td style="border:1px solid #000; padding-left:5px"><?=$x1?></td>
	<td style="border:1px solid #000; padding-left:3px"><?=$x2?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x4)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x5)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x6)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x7)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x8)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x9)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x10)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x13)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x14)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x15)?></td>
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
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
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
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="25" style="font-weight:bold">
    <td colspan="2" style="border:1px solid #000; border-top:3px double #000; text-align:center">T O T A L</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t4)?></td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t5)?></td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t6)?></td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t7)?></td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t8)?></td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px">&nbsp;</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px">&nbsp;</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px">&nbsp;</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px">&nbsp;</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px">&nbsp;</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px">&nbsp;</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px">&nbsp;</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t9)?></td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px">&nbsp;</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t10)?></td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t13)?></td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t14)?></td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t15)?></td>
  </tr>
</table>
<table border="0" width="1500" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
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
