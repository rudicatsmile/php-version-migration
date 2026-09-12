<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $SmS;
if ($SmS=="I"){
	$LoD = "NO";
	$TGa = "";
	$TGb = "";
	
	$TgA = $fTH."-01-01";
	$TgB = $fTH."-06-30";
}
else{
	$LoD = "YA";
	$tgA = $fTH."-01-01";
	$tgB = $fTH."-06-30";
	
	$TgA = $fTH."-07-01";
	$TgB = $fTH."-12-31";
}


$NmUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$UpB,"=","","");
$nSQL= "SELECT Jbt_Pimpinan, Nm_Pimpinan, Nip_Pimpinan 
FROM ta_upb WHERE Kd_UPB='".$UpB."' AND Tahun='".$fTH."'";
$nRs = mysql_query($nSQL) or die(mysql_error());
$mRo = mysql_fetch_array($nRs);
$JbT = $mRo[0];
$NmA = $mRo[1]; 
$NiP = $mRo[2]; 
$TgC = $eTH."-".substr("0".$eBL,0,2)."-".substr("0".$eHR,0,2);

?>
<table align="center" border="0" width="800" cellspacing="1" style="font-size:10pt; font-family: Calibri; border-collapse: collapse">
<tr>
	<td style="font-size: 11pt; font-weight: bold" align="center">LAPORAN REALISASI PENERIMAAN DAN BELANJA DANA BOS</td>
</tr>
<tr>
	<td style="font-size: 11pt; font-weight: bold" align="center">SEMESTER <?=$SmS?> TAHUN ANGGARAN <?=$fTH?></td>
</tr>
<tr>
	<td style="font-size: 11pt; font-weight: bold" align="center"><?=strtoupper($NmUPB)?></td>
</tr>
<tr>
  <td style="font-size: 12pt; font-weight: bold" align="center">&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="800" cellspacing="1" style="font-size:12pt; font-family: Calibri; border-collapse: collapse">
<tr>
	<td>Bersama ini kami laporkan realisasi atas penggunaan Dana BOS untuk Semester <?=$SmS?> Tahun <?=$fTH?> sebagai berikut:</td>
</tr>
<tr height="10">
	<td></td>
</tr>
</table>
<table align="center" border="0" width="800" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-family: Calibri; font-size:10pt">
  <tr style="text-align:center; font-weight:bold">
    <td width="30" style="border:1px solid #000">NO</td>
    <td style="border:1px solid #000">URAIAN</td>
    <td width="100" style="border:1px solid #000">JUMLAH<br>ANGGARAN<br>( Rp )</td>
    <td width="100" style="border:1px solid #000">REALISASI<br>s/d SEMESTER SEBELUMNYA<br>( Rp )</td>
    <td width="100" style="border:1px solid #000">REALISASI<br>s/d SEMESTER<br>INI<br>( Rp )</td>
    <td width="100" style="border:1px solid #000">JUMLAH<br>REALISASI s/d<br>SEMESTER INI<br>( Rp )</td>
    <td width="100" style="border:1px solid #000">SELISIH / KURANG<br>( Rp )</td>
  </tr>
  <tr style="text-align:center">
    <td style="border:1px solid #000; border-bottom:3px double #000">1</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">2</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">3</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">4</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">5</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">6 (4+5)</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">7 (3-6)</td>
  </tr>
  <?php
	$fRK = "4";
	if ($LoD == "NO")
	{
		$SbLP  = 0;
		$SbLP1 = 0;
		$SbLP2 = 0;
		$SbLP3 = 0;
	}
	if ($LoD == "YA")
	{
		$SbLP  = sumNIL($UpB,$fTH,$tgA,$tgB,"%",$fRK,"");
		$SbLP1 = sumNIL($UpB,$fTH,$tgA,$tgB,"1",$fRK,"");
		$SbLP2 = sumNIL($UpB,$fTH,$tgA,$tgB,"2",$fRK,"");
		$SbLP3 = sumNIL($UpB,$fTH,$tgA,$tgB,"3",$fRK,"");
	}
	$InIP  = sumNIL($UpB,$fTH,$TgA,$TgB,"%",$fRK,"");
	$InIP1 = sumNIL($UpB,$fTH,$TgA,$TgB,"1",$fRK,"");
	$InIP2 = sumNIL($UpB,$fTH,$TgA,$TgB,"2",$fRK,"");
	$InIP3 = sumNIL($UpB,$fTH,$TgA,$TgB,"3",$fRK,"");
	
	$ToTP  = $SbLP  + $InIP;
	$ToTP1 = $SbLP1 + $InIP1;
	$ToTP2 = $SbLP2 + $InIP2;
	$ToTP3 = $SbLP3 + $InIP3;
  ?>
  <tr height="20" style="">
    <td style="border:1px solid #000; text-align:center">1</td>
    <td style="border:1px solid #000; padding-left:3px; font-weight:bold">PENERIMAAN</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
  <tr height="20">
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000; padding-left:3px">BOS Reguler </td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbLP1)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InIP1)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToTP1)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
  <tr height="20">
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000; padding-left:3px">BOS Afirmasi </td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbLP2)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InIP2)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToTP2)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
  <tr height="20">
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000; padding-left:3px">BOS Kinerja </td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbLP3)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InIP3)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToTP3)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
  <tr height="20" style="font-weight:bold">
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:center">JUMLAH</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbLP)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InIP)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToTP)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
  <tr height="20">
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
  </tr>
  <tr height="20">
    <td style="border:1px solid #000; text-align:center">2</td>
    <td style="border:1px solid #000; padding-left:3px; font-weight:bold">PENGLEUARAN</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
  <?php
	$fRK = "5.1.1";
	if ($LoD == "NO")
	{
		$SbL1  = 0;
		$SbL11 = 0;
		$SbL12 = 0;
		$SbL13 = 0;
	}
	if ($LoD == "YA")
	{
		$SbL1  = sumNIL($UpB,$fTH,$tgA,$tgB,"%",$fRK,"");
		$SbL11 = sumNIL($UpB,$fTH,$tgA,$tgB,"1",$fRK,"");
		$SbL12 = 0;
		$SbL13 = 0;
	}
	$InI1  = sumNIL($UpB,$fTH,$TgA,$TgB,"%",$fRK,"");
	$InI11 = sumNIL($UpB,$fTH,$TgA,$TgB,"1",$fRK,"");
	$InI12 = 0;
	$InI13 = 0;
	
	$ToT1  = $SbL1  + $InI1;
	$ToT11 = $SbL11 + $InI11;
	$ToT12 = 0;
	$ToT13 = 0;
  ?>
  <tr height="20" style="font-weight:bold">
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000; padding-left:3px">a.&nbsp;&nbsp;BELANJA PEGAWAI</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbL1)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InI1)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToT1)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
  <tr height="20">
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000; padding-left:20px">BOS Reguler </td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbL11)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InI11)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToT11)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
  <tr height="20">
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000; padding-left:3px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
  <?php
	$fRK = "5.1.2";
	if ($LoD == "NO")
	{
		$SbL2  = 0;
		$SbL21 = 0;
		$SbL22 = 0;
		$SbL23 = 0;
	}
	if ($LoD == "YA")
	{
		$SbL2  = sumNIL($UpB,$fTH,$tgA,$tgB,"%",$fRK,"");
		$SbL21 = sumNIL($UpB,$fTH,$tgA,$tgB,"1",$fRK,"");
		$SbL22 = sumNIL($UpB,$fTH,$tgA,$tgB,"2",$fRK,"");
		$SbL23 = sumNIL($UpB,$fTH,$tgA,$tgB,"3",$fRK,"");
	}
	$InI2  = sumNIL($UpB,$fTH,$TgA,$TgB,"%",$fRK,"");
	$InI21 = sumNIL($UpB,$fTH,$TgA,$TgB,"1",$fRK,"");
	$InI22 = sumNIL($UpB,$fTH,$TgA,$TgB,"2",$fRK,"");
	$InI23 = sumNIL($UpB,$fTH,$TgA,$TgB,"3",$fRK,"");
	
	$ToT2  = $SbL2  + $InI2;
	$ToT21 = $SbL21 + $InI21;
	$ToT22 = $SbL22 + $InI22;
	$ToT23 = $SbL23 + $InI23;
  ?>
  <tr height="20" style="font-weight:bold">
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000; font-weight:bold; padding-left:3px">b.&nbsp;&nbsp;BELANJA BARANG DAN JASA</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbL2)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InI2)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToT2)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
  <tr height="20">
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000; padding-left:20px">BOS Reguler</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbL21)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InI21)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToT21)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
  <tr height="20">
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000; padding-left:20px">BOS Afirmasi </td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbL22)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InI22)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToT22)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
  <tr height="20">
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000; padding-left:20px">BOS Kinerja </td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbL23)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InI23)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToT23)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
  <tr height="20">
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000; padding-left:3px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
  <?php
	$fRK = "5.2";
	if ($LoD == "NO")
	{
		$SbL3  = 0;
	}
	if ($LoD == "YA")
	{
		$SbL3  = sumNIL($UpB,$fTH,$tgA,$tgB,"%",$fRK,"");
	}
	$InI3  = sumNIL($UpB,$fTH,$TgA,$TgB,"%",$fRK,"");
	
	$ToT3  = $SbL3  + $InI3;
  ?>
  <tr height="20" style="font-weight:bold">
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000; padding-left:3px">c.&nbsp;&nbsp;BELANJA MODAL</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
	<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbL3)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InI3)?></td>
	<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToT3)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
	<?php
	$nSQ = "SELECT Kd_Rek, Nm_Rek FROM ref_rek_90_3 WHERE Kd_Rek LIKE '5.2%' ORDER BY Kd_Rek";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$fRK = $mRo[0];
		if ($LoD == "NO")
		{
			$SbLB  = 0;
			$SbLB1 = 0;
			$SbLB2 = 0;
			$SbLB3 = 0;
		}
		if ($LoD == "YA")
		{
			$SbLB  = sumNIL($UpB,$fTH,$tgA,$tgB,"%",$fRK,"");
			$SbLB1 = sumNIL($UpB,$fTH,$tgA,$tgB,"1",$fRK,"");
			$SbLB2 = sumNIL($UpB,$fTH,$tgA,$tgB,"2",$fRK,"");
			$SbLB3 = sumNIL($UpB,$fTH,$tgA,$tgB,"3",$fRK,"");
		}
		$InIB  = sumNIL($UpB,$fTH,$TgA,$TgB,"%",$fRK,"");
		$InIB1 = sumNIL($UpB,$fTH,$TgA,$TgB,"1",$fRK,"");
		$InIB2 = sumNIL($UpB,$fTH,$TgA,$TgB,"2",$fRK,"");
		$InIB3 = sumNIL($UpB,$fTH,$TgA,$TgB,"3",$fRK,"");
		
		$ToTB  = $SbLB  + $InIB;
		$ToTB1 = $SbLB1 + $InIB1;
		$ToTB2 = $SbLB2 + $InIB2;
		$ToTB3 = $SbLB3 + $InIB3;
		?>  
		<tr height="20" style="font-weight:bold">
			<td style="border:1px solid #000">&nbsp;</td>
			<td style="border:1px solid #000; padding-left:18px"><?=$mRo[1]?></td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbLB)?></td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InIB)?></td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToTB)?></td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
		</tr>
		<tr height="20">
			<td style="border:1px solid #000">&nbsp;</td>
			<td style="border:1px solid #000; padding-left:19px">:: BOS Reguler</td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbLB1)?></td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InIB1)?></td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToTB1)?></td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
		</tr>
		<tr height="20">
			<td style="border:1px solid #000">&nbsp;</td>
			<td style="border:1px solid #000; padding-left:19px">:: BOS Afirmasi </td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbLB2)?></td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InIB2)?></td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToTB2)?></td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
		</tr>
		<tr height="20">
			<td style="border:1px solid #000">&nbsp;</td>
			<td style="border:1px solid #000; padding-left:19px">:: BOS Kinerja </td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbLB3)?></td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InIB3)?></td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToTB3)?></td>
			<td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
		</tr>
		<?php
	}
	?>
  <?php
  $SbLT = $SbL1+$SbL2+$SbL3;
  $InIT = $InI1+$InI2+$InI3;
  $ToTT = $ToT1+$ToT2+$ToT3;
  ?>
  <tr height="20" style="font-weight:bold">
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:center">JUMLAH</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($SbLT)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($InIT)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($ToTT)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px">&nbsp;</td>
  </tr>
</table>
<table align="center" border="0" width="800" cellspacing="1" style="font-size:12pt; font-family: Calibri; border-collapse: collapse">
<tr height="10">
  <td style="border:0px solid #000; text-align:justify"></td>
</tr>
<tr height="22">
	<td style="border:0px solid #000; text-align:justify">Laporan realisasi yang disampaikan telah sesuai dengan sasaran penggunaan yang ditetapkan dengan peraturan perundang-undangan dan telah didukung oleh kelengkapan dokumen yang sah sesuai ketentuan dan bertanggungjawab atas kebenarannya.</td>
</tr>
<tr height="10">
  <td style="border:0px solid #000"></td>
</tr>
<tr height="22">
	<td style="border:0px solid #000">Demikian Laporan Realisasi ini dibuat untuk digunakan sebagaimana mestinya.</td>
</tr>
</table>
<table align="center" border="0" width="800" cellspacing="1" style="font-size:11pt; font-family: Calibri; border-collapse: collapse">
<tr height="10">
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="">&nbsp;</td>
</tr>
<tr height="20">
	<td style="width:300px">&nbsp;</td>
	<td style="">&nbsp;</td>
	<td style="width:300px; text-align:center"><?=$NmIbuk.", ".fConvertDateLongsBln($TgC)?></td>
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
<?php
function sumNIL($UpB,$fTH,$TgA,$TgB,$fJN,$fRK,$fSH)
{
	$SW = "SELECT IfNull(sum(P2.Nilai),0) as JM FROM ta_sp3d P1 LEFT JOIN ta_sp3d_rinci P2 ON P2.Referensi=P1.Referensi 
	WHERE P1.Kd_UPB='".$UpB."' AND P1.Tahun='".$fTH."' AND (P1.Tgl_SP3D BETWEEN '".$TgA."' AND '".$TgB."') AND P1.KdJenis LIKE '".$fJN."' AND P2.Kd_ReknP90 LIKE '".$fRK."%'";
	if ($fSH) echo $SW."<br>";
	$rs = mysql_query($SW);
	$mR = mysql_fetch_array($rs);
	return $mR[0];
}
?>