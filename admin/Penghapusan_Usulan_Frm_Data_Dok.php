<?php
require('Connection.php');
require('FileFunction.php');

extract($_GET);
$Tg1 = $TH1."-".substr("0".$BL1,-2,2)."-".substr("0".$HR1,-2,2);
$Tg2 = $TH2."-".substr("0".$BL2,-2,2)."-".substr("0".$HR2,-2,2);
$Tg3 = $TH3."-".substr("0".$BL3,-2,2)."-".substr("0".$HR3,-2,2);
?>
<div align="center">
<table border="0" width="1330" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
	<tr>
		<td style="font-size: 12pt; font-weight: bold" align="center">PEMERINTAH <?=$TiDaer." ".$NmDaer?></td>
	</tr>
	<tr>
		<td style="font-size: 12pt; font-weight: bold" align="center"> USULAN MUTASI ASET TETAP</td>
	</tr>
	<tr>
	  <td style="font-size: 12pt; font-weight: bold" align="center">&nbsp;</td>
  </tr>
</table>
<table border="0" width="1330" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse" id="table1">
	<tr>
		<td width="96">UNIT KERJA</td>
		<td width="26">:</td>
		<td width="968">
		<?php
		if ($gUNT=="ALL"){
			echo "SEMUA SKPD";
			$gUNT="__.__.__.__";
		}
		else{
			echo fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
		}
		?></td>
	</tr>
	<tr>
	  <td>JENIS USULAN </td>
	  <td>:</td>
	  <td><?php if ($JeNS!="All" && $JeNS!="AA") {echo fGlobal("Deskripsi","ref_usulan_jenis","Kode",$JeNS,"=","","");} else {echo "SEMUA JENIS USULAN";}?></td>
    </tr>
	
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
</table>
<table border="0" width="1330" cellspacing="0" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table1">
  <tr height="20" style="text-align:center; font-weight:bold">
    <td width="29" rowspan="2" style="border:1px #000000 solid">NO</td>
    <td width="65" rowspan="2" style="border:1px #000000 solid">TANGGAL</td>
    <td width="100" rowspan="2" style="border:1px #000000 solid">NOMOR</td>
    <td width="43" rowspan="2" style="border:1px #000000 solid">JENIS</td>
    <td colspan="2" style="border:1px #000000 solid">DOKUMEN PENDUKUNG </td>
    <td width="259" rowspan="2" style="border:1px #000000 solid">URAIAN</td>
    <td colspan="2" style="border:1px #000000 solid"> U S U L A N </td>
    <td colspan="2" style="border:1px #000000 solid"> TINDAK LANJUT </td>
    </tr>
  <tr height="20" style="text-align:center; font-weight:bold">
    <td width="120" style="border:1px #000000 solid">NOMOR</td>
    <td width="70" style="border:1px #000000 solid">TANGGAL</td>
    <td width="100" style="border:1px #000000 solid">Niali Perolehan</td>
    <td width="100" style="border:1px #000000 solid">Nilai Akhir </td>
    <td width="100" style="border:1px #000000 solid">N i l a i</td>
    <td width="100" style="border:1px #000000 solid">Executed</td>
  </tr>
  
	<?php
	$iG=1;
	$tRo5 = 0;
	$tRo6 = 0;
	$tRo7 = 0;
	$tRo8 = 0;
	if ($JeNS=="All" || $JeNS=="AA") {$JeNS="%";}
	$nSQ = "SELECT Tanggal,Nomor,Referensi,Dokumen_Nom,Dokumen_Tgl,Uraian, Jenis 
	FROM ta_usulan_108 WHERE kd_upb LIKE '$gUNT%' AND (tanggal BETWEEN '$Tg1' AND '$Tg2') AND Jenis LIKE '$JeNS%' ORDER BY Nomor";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
	$mRo5= fGlobal("IfNull(sum(harga),0)","ta_usulan_rinci_108","Referensi",$mRo[2],"=","","");
	$mRo6= fGlobal("IfNull(sum(nilai_akhir),0)","ta_usulan_rinci_108","Referensi",$mRo[2],"=","","");
	
	$mRo7= fGlobal("IfNull(sum(nilai_akhir),0)","ta_usulan_verifikasi_rinci_108","Ref_Usulan:Verifikasi",$mRo[2].":Disetujui","=:=","","");
	$mRo8= fGlobal("IfNull(sum(nilai_akhir),0)","ta_usulan_verifikasi_rinci_108","Ref_Usulan:Eksekusi",$mRo[2].":Sudah","=:=","","");
	
	  if (round($mRo7,2)>round($mRo6,2)){
		$RlA="; color:#FF0000";
	  }
	  else if (round($mRo7,2)<round($mRo6,2)){
		$RlA="; color:#0000FF";
	  }
	  else{
		$RlA="";
	  }
	  
	  if (round($mRo8,2)>round($mRo7,2)){
		$RlB="; color:#FF0000";
	  }
	  else if (round($mRo8,2)<round($mRo7,2)){
		$RlB="; color:#0000FF";
	  }
	  else{
		$RlB="";
	  }
	?>
	  <tr height="20" style="vertical-align:top">
		<td style="border:1px #000000 solid; text-align:center"><?=$iG?>.</td>
		<td style="border:1px #000000 solid; text-align:center"><?=fConvertDateShortBln($mRo[0])?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mRo[1]?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mRo[6]?></td>
		<td style="border:1px #000000 solid; padding-left:5px"><?=$mRo[3]?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=fConvertDateShortBln($mRo[4])?></td>
		<td style="border:1px #000000 solid; padding-left:5px"><?=$mRo[5]?></td>
		<td style="border:1px #000000 solid; text-align:right; padding-right:5px"><?=fConvertToRupiah($mRo5)?></td>
		<td style="border:1px #000000 solid; text-align:right; padding-right:5px"><?=fConvertToRupiah($mRo6)?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:5px <?=$RlA?>"><?=fConvertToRupiah($mRo7)?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:5px <?=$RlB?>"><?=fConvertToRupiah($mRo8)?></td>
	  </tr>
	<?php
		$tRo5= $tRo5+$mRo5;
		$tRo6= $tRo6+$mRo6;
		$tRo7= $tRo7+$mRo7;
		$tRo8= $tRo8+$mRo8;
		$iG++;
	}
	?>
	<?php if ($iG==1){?>
  <tr>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
  </tr>
  <?php } ?>
  <?php
  if ($tRo7>$tRo6){
  	$ClA="; color:#FF0000";
  }
  else if ($tRo7<$tRo6){
  	$ClA="; color:#0000FF";
  }
  else{
  	$ClA="";
  }
  
  if ($tRo8>$tRo7){
  	$ClB="; color:#FF0000";
  }
  else if ($tRo8<$tRo7){
  	$ClB="; color:#0000FF";
  }
  else{
  	$ClB="";
  }
  ?>
  <tr height="25">
    <td colspan="7" style="border:1px #000000 solid; text-align:center; font-weight:bold">T O T A L</td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:5px"><?=fConvertToRupiah($tRo5)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:5px"><?=fConvertToRupiah($tRo6)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:5px <?=$ClA?>"><?=fConvertToRupiah($tRo7)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:5px <?=$ClB?>"><?=fConvertToRupiah($tRo8)?></td>
  </tr>
</table>
<table border="0" width="1330" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse">
	<?php 
	$gUpb = $gUNT;
	require "Dokumen_Footer.php";
	?>
	<tr>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
    </tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">Mengetahui,</td>
		<td align="center">&nbsp;</td>
		<td align="center" width="230"><?php echo $NmIbKt.", ".fConvertDateLongsBln($Tg3)?></td>
		<td align="center" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
		<td width="230" align="center" style="font-weight: bold"><?php echo $FotA[1]?></td>
		<td align="center">&nbsp;</td>
		<td align="center" style="font-weight: bold" width="230"><?php echo $FotC[1]?></td>
		<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center" width="230">&nbsp;</td>
		<td align="center" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center" width="230">&nbsp;</td>
		<td align="center" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center" width="230">&nbsp;</td>
		<td align="center" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
		<td width="230" align="center" style="font-weight: bold"><u><?php echo $FotA[2]?></u></td>
		<td align="center">&nbsp;</td>
		<td align="center" style="font-weight: bold" width="230"><u><?php echo $FotC[2]?></u></td>
		<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">NIP. <?php echo $FotA[3]?></td>
		<td align="center">&nbsp;</td>
		<td align="center" width="230">NIP. <?php echo $FotC[3]?></td>
		<td align="center" width="50">&nbsp;</td>
	</tr>
</table>
</div>