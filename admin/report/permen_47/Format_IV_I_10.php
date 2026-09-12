<?php
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

if ($semesterOrMonth=='semester'){
	$period = strtoupper(NmaSemester($rSem));
}else{
	$period = $rBulan;
}
if($formatType=='Format.IV.A.4.1' || $formatType=='Format.IV.A.4.2'){
    $contractHeader = "Dasar Hukum";
    $contractSubHeader = "Nama";
}elseif($formatType=='Format.IV.A.5.1' || $formatType=='Format.IV.A.5.2'){
    $contractHeader = "Dokumen Putusan Pengadilan Yang Telah Mempunyai Kekuatan Hukum Tetap";
    $contractSubHeader = "Nama Dokumen";
}elseif($formatType=='Format.IV.A.6.1' || $formatType=='Format.IV.A.6.2'){
    $contractHeader = "Dokumen Lainnya";
    $contractSubHeader = "Nama Dokumen";
}elseif($formatType=='Format.IV.A.8.1' || $formatType=='Format.IV.A.8.2'){
    $contractHeader = "Perjanjian Tukar Menukar";
    $contractSubHeader = "Nama Dokumen";
}else{
    $contractHeader = "Perjanjian Kontrak";
    $contractSubHeader = "Nama Perjanjian";
}
?> 
<body>
<table border="0" width="1500" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td style="text-align:right"><?=$formatType?></td>
  </tr>
</table>
<table border="0" width="1500" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri"><?=$titleDocument?></td>
  </tr>
  
  <?php
  if($subTitleDocument != ''){
  ?>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri"><?=$subTitleDocument?></td>
  </tr>
  <?php
  }
  ?>

  <?php
  if($subTitleDocument2 != ''){
  ?>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri"><?=$subTitleDocument2?></td>
  </tr>
  <?php
  }
  ?>

<?php
  if($isKomptabel=='1'){
  ?>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri; font-size:10pt"><?=$Vx?></td>
  </tr>
  <?php
  }
  ?>

  <?php
  if($isNameLocation=='1'){
  ?>
  <tr>
    <td style="text-align:center; font-weight:bold; font-family:calibri; font-size:10pt">KABUPATEN/KOTA : <?=strtoupper($NmDaer)?></td>
  </tr>
  <?php
  }
  ?>
  

  <?php
  if($skpdPosition=='1' && $isSkpd == '1'){
  ?>
	<tr>
		<td style="text-align:center; font-weight:bold; font-family:calibri; font-size:10pt"><?=$SkP?></td> 
	</tr>
  <?php
  }
  ?>
  
  <tr>
    <td style="text-align:center; font-family:calibri; font-weight:bold; font-size:10pt"><?=$period?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-family:calibri; font-weight:bold; font-size:10pt">TAHUN : <?=$rThn?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="1500" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
<?php
  if($isLocation=='1'){
  ?>
	<tr>
		<td width="244" valign="top">PROVINSI</td>
		<td width="11" valign="top">:</td>
		<td valign="top"><?=strtoupper($NmProv)?></td>
	</tr>
	<tr>
		<td valign="top">KABUPATEN</td>
		<td valign="top">:</td>
		<td valign="top"><?=strtoupper($NmDaer)?></td>
	</tr>
	<?php
	if($skpdPosition=='2'){
	?>
	<tr>
		<td valign="top">SKPD</td>
		<td valign="top">:</td>
		<td valign="top"><?=$SkP?></td>
	</tr>
	<?php
	}
	?>
    
  <?php
}
?>
<tr>
		<td valign="top">Kuasa Pengguna Barang</td>
		<td valign="top">:</td>
		<td valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td valign="top">Pengguna Barang</td>
		<td valign="top">:</td>
		<td valign="top">&nbsp;</td>
	</tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>



<table border="0" width="1500" align="center" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:9pt">
  <tr height="25" style="font-weight:bold; text-align:center">
    <td colspan="2" style="border:1px solid #000">Penggolongan dan Kodefikasi Barang</td>
    <td style="border:1px solid #000" rowspan="2">NUSP</td>
    <td style="border:1px solid #000" rowspan="2">Spesifikasi nama barang</td>
    <td style="border:1px solid #000" rowspan="2">Jumlah</td>
    <td style="border:1px solid #000" rowspan="2">Harga Satuan (Rp)</td>
    <td style="border:1px solid #000" rowspan="2">Nilai Total Persediaan (Rp)</td>
    <td rowspan="2" style="border:1px solid #000">Keterangan</td>
  </tr>
  <tr style="text-align:center; font-weight:bold">
    <td style="border:1px solid #000; border-bottom:1px solid #000">Kode<br>Barang</td>
    <td style="border:1px solid #000; border-bottom:1px solid #000" width="35">Nama Barang</td>
  </tr>
  <tr style="text-align:center">
    <td width="54" style="border:1px solid #000; border-bottom:3px double #000">
	&nbsp;</td>
    <td style="border:1px solid #000; border-bottom:3px double #000" width="35">
	&nbsp;</td>
    <td width="74" style="border:1px solid #000; border-bottom:3px double #000">
	&nbsp;</td>
    <td width="85" style="border:1px solid #000; border-bottom:3px double #000">
	&nbsp;</td>
    <td width="77" style="border:1px solid #000; border-bottom:3px double #000">
	&nbsp;</td>
    <td width="77" style="border:1px solid #000; border-bottom:3px double #000">
	&nbsp;</td>
    <td width="77" style="border:1px solid #000; border-bottom:3px double #000">
	&nbsp;</td>
    <td width="83" style="border:1px solid #000; border-bottom:3px double #000">
	&nbsp;</td>
  </tr>
	<?php
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
			if((int)$GLOBALS['level'] >= 4) {Level4($x1,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB);}
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
            if((int)$GLOBALS['level'] >= 5) {Level5($x1,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB);}
			$iGd++;
		}
	}

    function Level5($Mst,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB)
	{
		$iGd = 1;
		$SQd = "SELECT 
		'' as A0,
		Kd_Aset as A1, 
		Nm_Aset as A2 
		FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$Mst.".%' ORDER BY Kd_Aset";
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
            if((int)$GLOBALS['level'] >= 6) {Level6($x1,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB);}
			$iGd++;
		}
	}

    function Level6($Mst,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB)
	{
		$iGd = 1;
		$SQd = "SELECT 
		'' as A0,
		Kd_Aset as A1, 
		Nm_Aset as A2 
		FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '".$Mst.".%' ORDER BY Kd_Aset";
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
            if((int)$GLOBALS['level'] >= 7) {Level7($x1,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB);}
			$iGd++;
		}
	}

    function Level7($Mst,$KdS,$TG,$TGx,$TGz,$rSem,$rThn,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB)
	{
		$iGd = 1;
		$SQd = "SELECT 
		'' as A0,
		Kd_Aset as A1, 
		Nm_Aset as A2 
		FROM ref_rek_aset108_7 WHERE Kd_Aset LIKE '".$Mst.".%' ORDER BY Kd_Aset";
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
	
	<?php function TempRow($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$xB)
	{
	?>
	<tr height="22" style=" font-weight:<?=$xB?>">
	<td style="border:1px solid #000; padding-left:5px"><?=$x1?></td>
	<td style="border:1px solid #000; padding-left:3px" width="32"><?=$x2?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($x4)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	</tr>
	<?php
	}
	?>
	<?php function EmptRow()
	{
	?>
	<tr height="22">
	<td style="border:1px solid #000; padding-left:4px">&nbsp;</td>
	<td style="border:1px solid #000; padding-left:3px" width="32">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
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
    <td style="border:1px solid #000" width="35">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="25" style="font-weight:bold">
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($t4)?></td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px">&nbsp;</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px">&nbsp;</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px">&nbsp;</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px">&nbsp;</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px">&nbsp;</td>
    <td style="border:1px solid #000; border-top:3px double #000; text-align:right; padding-right:3px">&nbsp;</td>
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
