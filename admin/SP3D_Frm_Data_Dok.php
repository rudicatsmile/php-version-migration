<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $IdT;
$nSQL= "SELECT Referensi, Kd_UPB, KdSesi, KdJenis, Tahun, Tgl_SP3D FROM ta_sp3d WHERE IDT='".$IdT."'";
$nRs = mysql_query($nSQL) or die(mysql_error());
$mRo = mysql_fetch_array($nRs);
$KdREF = $mRo[0];
$KdUPB = $mRo[1];
$NmUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$KdUPB,"=","","");

$KdTHP = $mRo[2];
$NmTHP = " <i>".fGlobal("Deskripsi","ref_session","Kode",$KdTHP,"=","","")."</i>";

$KdJNS = $mRo[3];
$NmJNS = fGlobal("Deskripsi","ref_sp3d_jenis","Kode",$KdJNS,"=","","");

$ThnAG = $mRo[4];
$TglAG = $mRo[5];

$nSQL= "SELECT Jbt_Pimpinan, Nm_Pimpinan, Nip_Pimpinan 
FROM ta_upb WHERE Kd_UPB='".$KdUPB."' AND Tahun='".$ThnAG."'";
$nRs = mysql_query($nSQL) or die(mysql_error());
$mRo = mysql_fetch_array($nRs);
$JbT = $mRo[0];
$NmA = $mRo[1]; 
$NiP = $mRo[2]; 

$SldAW = fGlobal("Nilai","ta_sp3d_saldo_awal","Kd_UPB:KdJenis:KdTahap:Tahun",$KdUPB.":".$KdJNS.":".$KdTHP.":".$ThnAG,"=:=:=:=","","");
$fBan  = fGlobal("KasBank","ta_sp3d_saldo_akhir","Kd_UPB:KdJenis:KdTahap:Tahun",$KdUPB.":".$KdJNS.":".$KdTHP.":".$ThnAG,"=:=:=:=","","");
$fBen  = fGlobal("KasBendahara","ta_sp3d_saldo_akhir","Kd_UPB:KdJenis:KdTahap:Tahun",$KdUPB.":".$KdJNS.":".$KdTHP.":".$ThnAG,"=:=:=:=","","");
?>
<div align="center">
<table border="0" width="800" cellspacing="1" style="font-size:10pt; font-family: Calibri; border-collapse: collapse">
<tr>
	<td style="font-size: 12pt; font-weight: bold" align="center">PEMERINTAH <?=$TiDaer." ".$NmDaer?></td>
</tr>
<tr>
	<td style="font-size: 11pt; font-weight: bold" align="center">SURAT PERMINTAAN PENGESAHAN PENDAPATAN DAN BELANJA (SP3B)</td>
</tr>
<tr>
	<td style="font-size: 11pt; font-weight: bold" align="center"><?=strtoupper($NmUPB)?> TAHUN ANGGARAN <?=$ThnAG?></td>
</tr>
<tr>
  <td style="font-size: 12pt; font-weight: bold" align="center">&nbsp;</td>
</tr>
</table>
<table border="0" width="800" cellspacing="1" style="font-size:10pt; font-family: Calibri; border-collapse: collapse; font-weight:bold">
<tr>
	<td style="width:90px">DIBUAT OLEH <?=strtoupper($NmUPB)?></td>
</tr>
<tr>
	<td style="width:90px">REKAP DANA BOS TAHUN ANGGARAN <?=$ThnAG?></td>
</tr>
</table>
<table border="0" width="800" cellspacing="1" style="font-size:10pt; font-family: Calibri; border-collapse: collapse">
<tr height="22" style="text-align:center; font-weight:bold">
	<td style="width:110px; border:1px solid #000">NO</td>
	<td style="border:1px solid #000">URAIAN</td>
	<td style="width:160px; border:1px solid #000">REALISASI</td>
</tr>
<tr height="18" style="text-align:center">
	<td style="border:1px solid #000; border-bottom:3px double #000">1</td>
	<td style="border:1px solid #000; border-bottom:3px double #000">2</td>
	<td style="border:1px solid #000; border-bottom:3px double #000">3</td>
</tr>
<tr height="22" style="font-weight:bold">
	<td style="border:1px solid #000; padding-left:5px">1</td>
	<td style="border:1px solid #000; padding-left:5px">Saldo Awal BOS <?=strtoupper($NmJNS)."&nbsp;&nbsp;&nbsp;&nbsp;( ".$NmTHP." )"?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:8px"><?=fConvertToRupiah($SldAW)?></td>
</tr>
<tr height="22">
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
</tr>
<tr height="22" style="font-weight:bold">
	<td style="border:1px solid #000; padding-left:5px">2</td>
	<td style="border:1px solid #000; padding-left:5px">PENDAPATAN</td>
	<td style="border:1px solid #000; text-align:right; padding-right:8px">&nbsp;</td>
</tr>
<tr height="22">
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
</tr>
<?php
$iGA  = 1;
$JmL4 = 0;
$nSQA = "SELECT LEFT(P1.Kd_ReknP90,3) as A0, P2.Nm_Rek as A1, IfNull(sum(Nilai),0) as A2 
FROM ta_sp3d_rinci P1 
LEFT JOIN ref_rek_90_2 P2 ON P2.Kd_Rek=left(Kd_ReknP90,3) 
WHERE P1.Referensi='".$KdREF."' AND P1.Kd_UPB='".$KdUPB."' AND P1.Kd_ReknP90 LIKE '4%' GROUP BY LEFT(P1.Kd_ReknP90,3)";
$nRsA = mysql_query($nSQA);
while ($mRoA = mysql_fetch_array($nRsA, MYSQL_BOTH))
{
	$xB = "bold";
	$JmL4 = $JmL4 + $mRoA[2];
	RowList($mRoA[0],$mRoA[1],$mRoA[2],$xB);
	callLev3($KdREF,$KdUPB,$mRoA[0]);
	$iGA++;
}

function RowList($mR0,$mR1,$mR2,$xB)
{
?>
<tr height="22">
	<td style="border:1px solid #000; padding-left:5px; font-weight:<?=$xB?>"><?=$mR0?></td>
	<td style="border:1px solid #000; padding-left:5px; font-weight:<?=$xB?>"><?=$mR1?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:8px; font-weight:<?=$xB?>"><?=fConvertToRupiah($mR2)?></td>
</tr>
<?php
}
?>
<tr height="22" style="font-weight:bold">
	<td style="border:1px solid #000; padding-left:5px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:20px">TOTAL PENDAPATAN</td>
	<td style="border:1px solid #000; text-align:right; padding-right:8px"><?=fConvertToRupiah($JmL4)?></td>
</tr>
<tr height="22">
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
</tr>
<?php function RowListEmpty(){?>
<tr height="22">
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
</tr>
<?php }?>
<tr height="22" style="font-weight:bold">
	<td style="border:1px solid #000; padding-left:5px">3</td>
	<td style="border:1px solid #000; padding-left:5px">BELANJA</td>
	<td style="border:1px solid #000; text-align:right; padding-right:8px">&nbsp;</td>
</tr>
<tr height="22">
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
</tr>
<?php
$iGA  = 1;
$JmL5 = 0;
$nSQA = "SELECT LEFT(P1.Kd_ReknP90,3) as A0, P2.Nm_Rek as A1, IfNull(sum(Nilai),0) as A2 
FROM ta_sp3d_rinci P1 
LEFT JOIN ref_rek_90_2 P2 ON P2.Kd_Rek=left(Kd_ReknP90,3) 
WHERE P1.Referensi='".$KdREF."' AND P1.Kd_UPB='".$KdUPB."' AND P1.Kd_ReknP90 LIKE '5%' GROUP BY LEFT(P1.Kd_ReknP90,3)";
$nRsA = mysql_query($nSQA);
while ($mRoA = mysql_fetch_array($nRsA, MYSQL_BOTH))
{
	$xB = "bold";
	if ($iGA>1){RowListEmpty();}
	$JmL5 = $JmL5 + $mRoA[2];
	RowList($mRoA[0],$mRoA[1],$mRoA[2],$xB);
	callLev3($KdREF,$KdUPB,$mRoA[0]);
	$iGA++;
}

$SldAK = $SldAW+$JmL4-$JmL5;

$rCK = "";
$rCL = "";
$MeS = "";
if ($SldAK > ($fBan+$fBen)){
	$rCK = "; color:#ff0000";
	$rCL = "; color:#0000ff";
}
if ($SldAK < ($fBan+$fBen)){
	$rCK = "; color:#0000ff";
	$rCL = "; color:#ff0000";
}
if ($rCL!=''){
	$MeS = "********* Nilai posisi saldo akhir Kas di Bank & Kas di Bendahara belum sesuai...!!*********";
}
?>
<tr height="22" style="font-weight:bold">
	<td style="border:1px solid #000; padding-left:5px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:20px">TOTAL BELANJA</td>
	<td style="border:1px solid #000; text-align:right; padding-right:8px"><?=fConvertToRupiah($JmL5)?></td>
</tr>
<tr height="22">
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
</tr>
<tr height="22" style="font-weight:bold">
	<td style="border:1px solid #000; padding-left:5px">4</td>
	<td style="border:1px solid #000; padding-left:5px">Saldo Akhir BOS <?=strtoupper($NmJNS)."&nbsp;&nbsp;&nbsp;&nbsp;( ".$NmTHP." )"?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:8px <?=$rCK?>"><?=fConvertToRupiah($SldAK)?></td>
</tr>
<tr height="22">
	<td style="border:1px solid #000; padding-left:5px">&nbsp;</td>
	<td style="border:1px solid #000; padding-left:5px; font-weight:bold">Terdiri dari :</td>
	<td style="border:1px solid #000; text-align:right; padding-right:8px">&nbsp;</td>
</tr>
<tr height="22">
	<td style="border:1px solid #000; padding-left:5px">&nbsp;</td>
	<td style="border:1px solid #000; padding-left:5px">- Kas di Bank</td>
	<td style="border:1px solid #000; text-align:right; padding-right:8px <?=$rCL?>"><?=fConvertToRupiah($fBan)?></td>
</tr>
<tr height="22">
	<td style="border:1px solid #000; padding-left:5px">&nbsp;</td>
	<td style="border:1px solid #000; padding-left:5px">- Kas di Bendahara Pengeluaran</td>
	<td style="border:1px solid #000; text-align:right; padding-right:8px <?=$rCL?>"><?=fConvertToRupiah($fBen)?></td>
</tr>
</table>
<table border="0" width="800" cellspacing="1" style="font-size:11pt; font-family: Calibri; border-collapse: collapse">
<?php if ($MeS!=""){?>
<tr height="30">
	<td style="border:0px solid #000; color:#FF0000; font-style:italic; text-align:center; font-size:10pt"><?=$MeS?></td>
</tr>
<?php } ?>
<tr height="12">
	<td style="border:0px solid #000">&nbsp;</td>
</tr>
<tr height="22">
	<td style="border:0px solid #000; text-align:justify">Laporan realisasi yang disampaikan telah sesuai dengan sasaran penggunaan yang ditetapkan dengan peraturan perundang-undangan dan telah didukung oleh kelengkapan dokumen yang sah sesuai ketentuan dan bertanggungjawab atas kebenarannya.</td>
</tr>
<tr height="22">
	<td style="border:0px solid #000">Demikian Laporan Realisasi ini dibuat untuk digunakan sebagaimana mestinya.</td>
</tr>
</table>
<table border="0" width="800" cellspacing="1" style="font-size:11pt; font-family: Calibri; border-collapse: collapse">
<tr height="10">
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
</tr>
<tr height="20">
	<td style="width:300px">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="width:300px; text-align:center"><?=$NmIbuk.", ".fConvertDateLongsBln($TglAG)?></td>
</tr>
<tr height="20">
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="text-align:center"><?=$JbT?></td>
</tr>
<tr height="50">
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
</tr>
<tr height="20">
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="font-weight:bold; text-align:center; text-decoration:underline"><?=$NmA?></td>
</tr>
<tr height="20">
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="text-align:center">NIP : <?=$NiP?></td>
</tr>
</table>
</div>
<?php
function callLev3($KdREF,$KdUPB,$mR0)
{
	$iGB = 1;
	$nSQB = "SELECT LEFT(P1.Kd_ReknP90,6) as A0, P2.Nm_Rek as A1, IfNull(sum(Nilai),0) as A2 
	FROM ta_sp3d_rinci P1 
	LEFT JOIN ref_rek_90_3 P2 ON P2.Kd_Rek=left(Kd_ReknP90,6) 
	WHERE P1.Referensi='".$KdREF."' AND P1.Kd_UPB='".$KdUPB."' AND P1.Kd_ReknP90 LIKE '".$mR0."%' GROUP BY LEFT(P1.Kd_ReknP90,6)";
	$nRsB = mysql_query($nSQB);
	while ($mRoB = mysql_fetch_array($nRsB, MYSQL_BOTH))
	{
		$xB = "bold";
		if ($iGB>1){RowListEmpty();}
		RowList($mRoB[0],$mRoB[1],$mRoB[2],$xB);
		callLev4($KdREF,$KdUPB,$mRoB[0]);
		$iGB++;
	}
}

function callLev4($KdREF,$KdUPB,$mR0)
{
	$iGC = 1;
	$nSQC = "SELECT LEFT(P1.Kd_ReknP90,9) as A0, P2.Nm_Rek as A1, IfNull(sum(Nilai),0) as A2 
	FROM ta_sp3d_rinci P1 
	LEFT JOIN ref_rek_90_4 P2 ON P2.Kd_Rek=left(Kd_ReknP90,9) 
	WHERE P1.Referensi='".$KdREF."' AND P1.Kd_UPB='".$KdUPB."' AND P1.Kd_ReknP90 LIKE '".$mR0."%' GROUP BY LEFT(P1.Kd_ReknP90,9)";
	$nRsC = mysql_query($nSQC);
	while ($mRoC = mysql_fetch_array($nRsC, MYSQL_BOTH))
	{
		$xB = "bold";
		if ($iGC>1){RowListEmpty();}
		RowList($mRoC[0],$mRoC[1],$mRoC[2],$xB);
		callLev5($KdREF,$KdUPB,$mRoC[0]);
		$iGC++;
	}
}

function callLev5($KdREF,$KdUPB,$mR0)
{
	$nSQD = "SELECT LEFT(P1.Kd_ReknP90,12) as A0, P2.Nm_Rek as A1, IfNull(sum(Nilai),0) as A2 
	FROM ta_sp3d_rinci P1 
	LEFT JOIN ref_rek_90_5 P2 ON P2.Kd_Rek=left(Kd_ReknP90,12) 
	WHERE P1.Referensi='".$KdREF."' AND P1.Kd_UPB='".$KdUPB."' AND P1.Kd_ReknP90 LIKE '".$mR0."%' GROUP BY LEFT(P1.Kd_ReknP90,12)";
	$nRsD = mysql_query($nSQD);
	while ($mRoD = mysql_fetch_array($nRsD, MYSQL_BOTH))
	{
		$xB = "bold";
		RowList($mRoD[0],$mRoD[1],$mRoD[2],$xB);
		callLev6($KdREF,$KdUPB,$mRoD[0]);
	}
}

function callLev6($KdREF,$KdUPB,$mR0)
{
	$nSQE = "SELECT LEFT(P1.Kd_ReknP90,16) as A0, P2.Nm_Rek as A1, IfNull(sum(Nilai),0) as A2 
	FROM ta_sp3d_rinci P1 
	LEFT JOIN ref_rek_90_6 P2 ON P2.Kd_Rek=left(Kd_ReknP90,16) 
	WHERE P1.Referensi='".$KdREF."' AND P1.Kd_UPB='".$KdUPB."' AND P1.Kd_ReknP90 LIKE '".$mR0."%' GROUP BY LEFT(P1.Kd_ReknP90,16)";
	$nRsE = mysql_query($nSQE);
	while ($mRoE = mysql_fetch_array($nRsE, MYSQL_BOTH))
	{
		$xB = "normal";
		RowList($mRoE[0],$mRoE[1],$mRoE[2],$xB);
	}
}?>
