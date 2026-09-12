<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

if ($RF)
{
	$nSQL= "SELECT Referensi as A0, Kd_Unit as A1, Tanggal as A2, Nomor as A3, Dokumen_Nom as A4,Dokumen_Tgl as A5,Uraian as A6 
	FROM ta_permohonan_repla_rek_aset WHERE Referensi='$RF'";
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
<table border="0" width="900" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
	<tr>
		<td style="font-size: 12pt; font-weight: bold" align="center">PEMERINTAH <?=$TiDaer." ".$NmDaer?></td>
	</tr>
	<tr>
		<td style="font-size: 12pt; font-weight: bold" align="center">RINCIAN USULAN MUTASI REKENING ASET</td>
	</tr>
	<tr>
	  <td style="font-size: 12pt; font-weight: bold" align="center">&nbsp;</td>
  </tr>
</table>
<table border="0" width="900" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse" id="table1">
	<tr>
		<td width="106">UNIT KERJA</td>
		<td width="15">:</td>
		<td><?=$dUNT?></td>
	</tr>
	<tr>
	  <td>TANGGAL USULAN </td>
	  <td>:</td>
	  <td><?=fConvertDateLongsBln($dTgL)?></td>
    </tr>
	<tr>
	  <td>NOMOR USULAN </td>
	  <td>:</td>
	  <td><?=$dNoM?></td>
    </tr>
	<tr>
	  <td>RINCIAN OBJEK</td>
	  <td>:</td>
	  <td><?=$nRK." ".strtoupper(fGlobal("Nm_Aset","ref_rek_aset5","Kd_Aset",$nRK,"=","",""))?></td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
</table>
<table border="0" width="900" cellspacing="0" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table1">
  
  <tr height="20" style="text-align:center; font-weight:bold">
    <td width="34" rowspan="2" style="border:1px #000000 solid">NO</td>
    <td width="70" rowspan="2" style="border:1px #000000 solid">REGISTER</td>
    <td rowspan="2" style="border:1px #000000 solid">NAMA ASET </td>
    <td colspan="2" style="border:1px #000000 solid">PEROLEHAN </td>
    <td width="100" rowspan="2" style="border:1px #000000 solid">NILAI AKHIR</td>
    <td width="200" rowspan="2" style="border:1px #000000 solid">KETERANGAN</td>
  </tr>
  <tr height="20" style="text-align:center; font-weight:bold">
    <td width="70" style="border:1px #000000 solid">TANGGAL</td>
    <td width="110" style="border:1px #000000 solid">AWAL</td>
    </tr>
	<?
	$nX = (int)substr($nRK,0,2);
	
	$iG=1;
	$tJmL = 0;
	
	$nSQ = "SELECT Referensi as A0, 
	No_Register as A1,
	Nm_Aset as A2,
	Tgl_Perolehan as A3,
	Harga as A4,
	Ref_Temp as A5,
	Keterangan as A6  
	FROM ta_kib_".fNmHuruf($nX)." WHERE Kd_UPB LIKE '".$UnT."%' AND Kd_Aset='".$nRK."' ORDER BY No_Register";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$mRo0 = $mRo[0];
		$mRo1 = $mRo[1];
		$mRo2 = $mRo[2];
		$mRo3 = $mRo[3];
		$mRo4 = $mRo[4];
		$mRo5 = $mRo[5];
		$mRo6 = $mRo[6];
		$gNiL = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi:Kd_UPB:Kd_Aset",$mRo0.":".substr($UnT,0,11)."%:".$nRK,"=:LIKE:=","","");
	?>
	  <tr height="22" style="vertical-align:top">
		<td style="border:1px #000000 solid; text-align:center"><?=$iG?>.</td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mRo1?></td>
		<td style="border:1px #000000 solid; padding-left:4px"><?=$mRo2?></td>
	    <td style="border:1px #000000 solid; text-align:center"><?=fConvertDateShort($mRo3)?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:4px"><?=fConvertToRupiah($mRo4)?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:4px"><?=fConvertToRupiah($gNiL)?></td>
	    <td style="border:1px #000000 solid; padding-left:4px"><?=$mRo6?></td>
	  </tr>
	<?
		$tJmL = $tJmL + $mRo4;
		$aNiL = $aNiL + $gNiL;
		$iG++;
	}
	?>
	<? if ($iG==1){?>
  <tr>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
  </tr>
  <? } ?>
  <tr height="26">
    <td colspan="4" style="border:1px #000000 solid; text-align:center; font-weight:bold">T O T A L</td>
    <td style="border:1px #000000 solid; text-align:right; padding-right:4px; font-weight:bold"><?=fConvertToRupiah($tJmL)?></td>
    <td style="border:1px #000000 solid; text-align:right; padding-right:4px; font-weight:bold"><?=fConvertToRupiah($aNiL)?></td>
    <td style="border:1px #000000 solid; text-align:right; padding-right:4px; font-weight:bold">&nbsp;</td>
  </tr>
</table>
<table border="0" width="900" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse">
	<? 
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
		<td align="center" width="230"><? echo $NmIbKt.", ".fConvertDateLongsBln($dTgL)?></td>
		<td align="center" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
		<td width="230" align="center" style="font-weight: bold"><? echo $FotA[1]?></td>
		<td align="center">&nbsp;</td>
		<td align="center" style="font-weight: bold" width="230"><? echo $FotC[1]?></td>
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
		<td width="230" align="center" style="font-weight: bold"><u><? echo $FotA[2]?></u></td>
		<td align="center">&nbsp;</td>
		<td align="center" style="font-weight: bold" width="230"><u><? echo $FotC[2]?></u></td>
		<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">NIP. <? echo $FotA[3]?></td>
		<td align="center">&nbsp;</td>
		<td align="center" width="230">NIP. <? echo $FotC[3]?></td>
		<td align="center" width="50">&nbsp;</td>
	</tr>
</table>
</div>