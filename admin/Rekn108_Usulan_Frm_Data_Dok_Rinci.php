<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
if ($IdT)
{
	$nSQL= "SELECT Referensi as A0, Kd_Unit as A1, Tanggal as A2, Nomor as A3, Dokumen_Nom as A4,Dokumen_Tgl as A5,Uraian as A6 
	FROM ta_permohonan_repla_rek_aset WHERE IDT='$IdT'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	$gREF = $mRo[0];
	$gUNT = substr($mRo[1],0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	
	$dTgL = $mRo[2];
	$dNoM = (int)substr($mRo[3],0,8)."/".substr($mRo[3],9,10);
	$dDokNom = $mRo[4];
	$dDokTgL = $mRo[5];
}
?>
<div align="center">
<table border="0" width="1100" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
	<tr>
		<td style="font-size: 12pt; font-weight: bold" align="center">PEMERINTAH <?=$TiDaer." ".$NmDaer?></td>
	</tr>
	<tr>
		<td style="font-size: 12pt; font-weight: bold" align="center">USULAN MUTASI REKENING ASET</td>
	</tr>
	<tr>
	  <td style="font-size: 12pt; font-weight: bold" align="center">&nbsp;</td>
  </tr>
</table>
<table border="0" width="1100" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse" id="table1">
	<tr>
		<td width="107">UNIT KERJA</td>
		<td width="18">:</td>
		<td width="396"><?=$dUNT?></td>
		<td width="126">DOKUMEN TANGGAL </td>
	    <td width="21">:</td>
	    <td width="413"><?=$dDokNom?></td>
	</tr>
	<tr>
	  <td>TANGGAL USULAN </td>
	  <td>:</td>
	  <td><?=fConvertDateLongsBln($dTgL)?></td>
	  <td>DOKUMEN NOMOR </td>
      <td>:</td>
      <td><?php if ($dDokTgL!="0000-00-00"){echo fConvertDateLongsBln($dDokTgL);}?></td>
  </tr>
	<tr>
	  <td>NOMOR USULAN </td>
	  <td>:</td>
	  <td><?=$dNoM?></td>
	  <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
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
    <td width="34" rowspan="2" style="border:1px #000000 solid">NO</td>
    <td colspan="2" style="border:1px #000000 solid">PERMENDAGRI 17</td>
    <td width="88" rowspan="2" style="border:1px #000000 solid">ASET</td>
    <td colspan="2" style="border:1px #000000 solid">PERMENDAGRI 108</td>
    </tr>
  <tr height="20" style="text-align:center; font-weight:bold">
    <td width="90" style="border:1px #000000 solid">KODE</td>
    <td width="330" style="border:1px #000000 solid">REKENING</td>
    <td width="110" style="border:1px #000000 solid">KODE</td>
	<td width="330" style="border:1px #000000 solid">REKENNG</td>
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
	FROM ta_usulan_rinci WHERE Referensi='$gREF' ORDER BY IDT";
	
	$nSQ = "SELECT IDT, Kd_Rekening_17, Kd_Rekening_108 
	FROM ta_permohonan_repla_rek_aset_rinci 
	WHERE Referensi='$gREF' ORDER BY IDT";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$mRo1 = $mRo[1];
		$mRo2 = $mRo[2];
		
		$nX = (int)substr($mRo1,0,2);
		$gNmA = fGlobal("Nm_Aset","ref_rek_aset5","Kd_Aset",$mRo1,"=","","");
		$gCnT = fGlobal("IfNull(count(*),0)","ta_kib_".fNmHuruf($nX),"Kd_Aset:Kd_UPB",$mRo1.":".$gUNT."%","=:LIKE","","");
		
		$gNmB = "";
		if ($mRo2){
			$gNmB = fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$mRo2,"=","","");
		}
	
	?>
	  <tr height="20" style="vertical-align:top">
		<td style="border:1px #000000 solid; text-align:center"><?=$iG?>.</td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mRo1?></td>
		<td style="border:1px #000000 solid; padding-left:4px"><?=$gNmA?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$gCnT?> item</td>
		<td style="border:1px #000000 solid; padding-left:5px"><?=$mRo2?></td>
		<td style="border:1px #000000 solid; padding-left:5px"><?=$gNmB?></td>
	  </tr>
	<?php
		$tJmL = $tJmL +$gCnT;
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
    </tr>
  <?php } ?>
  <tr height="26">
    <td colspan="3" style="border:1px #000000 solid; text-align:center; font-weight:bold">T O T A L</td>
    <td style="border:1px #000000 solid; text-align:center; font-weight:bold"><?=fConvertToRupiahBulat($tJmL)?> item</td>
    <td style="border:1px #000000 solid; text-align:center; font-weight:bold">&nbsp;</td>
    <td style="border:1px #000000 solid; text-align:center; font-weight:bold">&nbsp;</td>
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