<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
if ($IdT)
{
	$nSQL= "SELECT Referensi,Kd_UPB,Tanggal,Nomor,Jenis,Dokumen_Nom,Dokumen_Tgl,Uraian 
	FROM ta_usulan_108 WHERE IDT='$IdT'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	$gREF = $mRo[0];
	$gUNT = substr($mRo[1],0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	
	$dTgL = $mRo[2];
	$dNoM = (int)substr($mRo[3],0,8)."/".substr($mRo[3],9,10);
	$dJnS = fGlobal("Deskripsi","ref_usulan_jenis","Kode",$mRo[4],"=","","");
	$mRo4 = $mRo[4];
	$dDokNom = $mRo[5];
	$dDokTgL = $mRo[6];
}
?>
<div align="center">
<table border="0" width="1100" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
	<tr>
		<td style="font-size: 12pt; font-weight: bold" align="center">PEMERINTAH <?=$TiDaer." ".$NmDaer?></td>
	</tr>
	<tr>
		<td style="font-size: 12pt; font-weight: bold" align="center">RINCIAN USULAN PENGHAPUSAN ASET TETAP</td>
	</tr>
	<tr>
	  <td style="font-size: 12pt; font-weight: bold" align="center">&nbsp;</td>
  </tr>
</table>
<table border="0" width="1100" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse" id="table1">
	<tr>
		<td width="113">UNIT KERJA</td>
		<td width="20">:</td>
		<td width="437"><?=$dUNT?></td>
		<td width="115">JENIS USULAN </td>
	    <td width="25">:</td>
	    <td width="471"><?=$dJnS?></td>
	</tr>
	<tr>
	  <td>TANGGAL USULAN </td>
	  <td>:</td>
	  <td><?=fConvertDateLongsBln($dTgL)?></td>
	  <td>DOKUMEN TANGGAL </td>
      <td>:</td>
      <td><?=$dDokNom?></td>
  </tr>
	<tr>
	  <td>NOMOR URULAN </td>
	  <td>:</td>
	  <td><?=$dNoM?></td>
	  <td>DOKUMEN NOMOR </td>
      <td>:</td>
      <td><?php if ($dDokTgL!="0000-00-00"){echo fConvertDateLongsBln($dDokTgL);}?></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="1100" cellspacing="0" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table1">
  <tr height="20" style="text-align:center; font-weight:bold">
    <td width="32" rowspan="2" style="border:1px #000000 solid">NO</td>
    <td width="112" rowspan="2" style="border:1px #000000 solid">REFERENSI</td>
    <td width="92" rowspan="2" style="border:1px #000000 solid">KODE</td>
    <td width="62" rowspan="2" style="border:1px #000000 solid">REGISTER</td>
    <td width="176" rowspan="2" style="border:1px #000000 solid">NAMA ASET </td>
    <td width="349" rowspan="2" style="border:1px #000000 solid">DESKRIPSI</td>
    <td colspan="2" style="border:1px #000000 solid">PEROLEHAN</td>
    <td width="98" rowspan="2" style="border:1px #000000 solid">NILAI AKHIR</td>
  </tr>
  <tr height="20" style="text-align:center; font-weight:bold">
	<td width="55" style="border:1px #000000 solid">TAHUN</td>
	<td width="106" style="border:1px #000000 solid">NILAI</td>
    </tr>
	<?php
	$iG=1;
	$tRo7 = 0;
	$tRo8 = 0;
	$nSQ = "SELECT IDT,
	Ref_Aset,
	Kd_Aset,
	No_Register,
	Nm_Aset,
	Tgl_Perolehan,
	Uraian,
	Harga,
	Nilai_Akhir,
	To_UPB 
	FROM ta_usulan_rinci_108 WHERE Referensi='$gREF' ORDER BY IDT";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
	if ($mRo[6]!="-" && $mRo[6]!=""){
		$mRo6 = $mRo[6];
	}
	else{
		$mRo[6]="";
	}
	if ($mRo4=="MS"){
		if ($mRo6!=""){
			$br="<br>";
		}
		else{
			$br="";
		}
		$mRo6=$br."<i>Mutasi ke : ".fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo[9],0,11),"=","","")."</i>";
	}
	?>
	  <tr height="20" style="vertical-align:top">
		<td style="border:1px #000000 solid; text-align:center"><?=$iG?>.</td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mRo[1]?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mRo[2]?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mRo[3]?></td>
		<td style="border:1px #000000 solid; padding-left:5px"><?=$mRo[4]?></td>
		<td style="border:1px #000000 solid; padding-left:5px"><?=$mRo6?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=substr($mRo[5],0,4)?></td>
		<td style="border:1px #000000 solid; text-align:right; padding-right:5px"><?=fConvertToRupiah($mRo[7])?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:5px"><?=fConvertToRupiah($mRo[8])?></td>
	  </tr>
	<?php
		$tRo7 = $tRo7+$mRo[7];
		$tRo8 = $tRo8+$mRo[8];
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
  </tr>
  <?php } ?>
  <tr>
    <td colspan="7" style="border:1px #000000 solid; text-align:center; font-weight:bold">T O T A L</td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:5px"><?=fConvertToRupiah($tRo7)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:5px"><?=fConvertToRupiah($tRo8)?></td>
  </tr>
</table>
<table border="0" width="1100" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse">
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
		<td align="center" width="230"><?php echo $NmIbKt.", ".fConvertDateLongsBln($dTgL)?></td>
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