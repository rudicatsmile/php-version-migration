<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $IdT;
$nSQ = "SELECT p1.IDT as A0,
p1.tanggal as A1,
p1.referensi as A2,
p1.nomor as A3,
p1.tahun as A4,
p2.nm_unit as A5,
p1.uraian as A6,
p2.Nma_Pimpinan as A7,
p2.Nip_Pimpinan as A8,
p1.kd_unit as A9 
FROM ta_rkbmd_standar_kebutuhan p1 
LEFT JOIN ref_unit p2 ON p2.kd_unit=p1.kd_unit 
WHERE p1.IDT='".$IdT."'";
#echo $nSQ;
$nRs = mysql_query($nSQ);
$mRo = mysql_fetch_array($nRs);
$kua=""
?>
<div align="center">
<table border="0" width="1000" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
	<tr>
		<td style="font-size: 11pt; font-weight: bold" align="center">STANDAR KEBUTUHAN BARANG MILIK DAERAH </td>
	</tr>
	<tr>
	  <td style="font-size: 10pt; font-weight: bold" align="center">TAHUN <?=$mRo[4]?></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="1000" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse" id="table1">
	<tr>
		<td <?php if ($mRo[7]=="kuasa"){echo "width='120'";} else {echo "width='70'";}?>width="120">UNIT KERJA</td>
		<td width="18">:</td>
		<td><?=$mRo[5]?></td>
	</tr>
	<?php if ($mRo[7]=="kuasa"){?>
	<tr>
	  <td>PENGGUNA BARANG</td>
	  <td>:</td>
	  <td><?=$mRo[8]?></td>
    </tr>
	<?php } ?>
	<tr>
	  <td>KAB/KOTA</td>
	  <td>:</td>
	  <td><?=$NmDaer?></td>
    </tr>
	<tr>
	  <td>PROVINSI</td>
	  <td>:</td>
	  <td><?=$NmProv?></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="1000" cellspacing="0" style="font-size:9pt; font-family: Calibri; border-collapse: collapse">
  
  <tr style="text-align:center; font-weight:bold">
    <td rowspan="2" style="border:1px #000000 solid">No</td>
    <td rowspan="2" style="border:1px #000000 solid">Kode Barang</td>
    <td rowspan="2" style="border:1px #000000 solid">Nama Barang</td>
    <td rowspan="2" style="border:1px #000000 solid">Jumlah Aset<br>Yang Ada </td>
    <td colspan="2" style="border:1px #000000 solid">Kebutuhan</td>
    <td rowspan="2" style="border:1px #000000 solid">Uraian</td>
  </tr>
  <tr style="text-align:center; font-weight:bold">
    <td style="border:1px #000000 solid">Jumlah</td>
    <td style="border:1px #000000 solid">Satuan</td>
  </tr>
  <tr style="text-align:center; font-weight:bold">
    <td width="30" style="border:1px #000000 solid; border-bottom:3px double">1</td>
    <td width="110" style="border:1px #000000 solid; border-bottom:3px double">2</td>
    <td style="border:1px #000000 solid; border-bottom:3px double">3</td>
    <td width="90" style="border:1px #000000 solid; border-bottom:3px double">4</td>
    <td width="90" style="border:1px #000000 solid; border-bottom:3px double">5</td>
    <td width="100" style="border:1px #000000 solid; border-bottom:3px double">6</td>
    <td width="150" style="border:1px #000000 solid; border-bottom:3px double">7</td>
  </tr>
	<?php
	$iG  = 1;
	$mR4 = 0;
	$mR5 = 0;

	$SQ = "SELECT p1.IDT as A0, 
	p1.kd_aset as A1,
	p2.nm_aset as A2,
	p1.nm_aset as A3,
	'0' as A4,
	p1.jumlah as A5,
	p1.satuan as A6,
	p1.keterangan as A7 
	
	FROM ta_rkbmd_standar_kebutuhan_rinci p1 
	LEFT JOIN ref_rek_aset108_6 p2 ON p2.kd_aset=left(p1.kd_aset,14) 
	WHERE p1.Referensi='".$mRo[2]."' ORDER BY p1.IDT";
	$rs = mysql_query($SQ);
	#echo $SQ;
	#return false;
	while ($mR = mysql_fetch_array($rs, MYSQL_BOTH))
	{
		$KdA = $mR[1];
		$mA4 = fGlobal("count(*)","ta_kib_108","Kd_Aset_108:Kd_UPB",$KdA.":".$mRo[9]."%","=:LIKE","","");
		
		?>
		<tr height="35">
		<td style="border:1px #000000 solid; text-align:center"><?=$iG?>.</td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mR[1]?></td>
		<td style="border:1px #000000 solid; padding-left:3px"><?="<b>".$mR[3]."</b><br><i>".ucwords(strtolower($mR[2]))?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=fConvertToRupiahBulat($mA4)?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=fConvertToRupiahBulat($mR[5])?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mR[6]?></td>
		<td style="border:1px #000000 solid; padding-left:3px"><?=$mR[7]?></td>
		</tr>
		<?php
		$iG++;
		$mR4=$mR4+$mA4;
		$mR5=$mR5+$mR[5];
	}
	?>
	<?php if ($iG==1){?>
		<tr height="23">
		<td style="border:1px #000000 solid; text-align:center">&nbsp;</td>
		<td style="border:1px #000000 solid; text-align:center">&nbsp;</td>
		<td style="border:1px #000000 solid; padding-left:3px">&nbsp;</td>
		<td style="border:1px #000000 solid; padding-left:3px">&nbsp;</td>
		<td style="border:1px #000000 solid; text-align:center">&nbsp;</td>
		<td style="border:1px #000000 solid; padding-left:3px">&nbsp;</td>
		<td style="border:1px #000000 solid">&nbsp;</td>
		</tr>
	<?php } ?>
  <tr height="22" style="font-weight:bold">
    <td colspan="3" style="border:1px #000000 solid; text-align:center">T O T A L</td>
    <td style="border:1px #000000 solid; text-align:center"><?=fConvertToRupiahBulat($mR4)?></td>
    <td style="border:1px #000000 solid; text-align:center"><?=fConvertToRupiahBulat($mR5)?></td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
  </tr>
</table>
<table border="0" width="1000" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
	<tr>
		<td width="393">&nbsp;</td>
		<td width="539">&nbsp;</td>
		<td width="388">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center"><?=$NmIbuk?>, <?=fConvertDateLongsBln($mRo[1])?></td>
	</tr>
	<tr height="30">
		<td align="center">&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center"><?php if ($Crit=='kuasa'){echo "KUASA PENGGUNA BARANG";} else {echo "PENGGUNA BARANG";}?></td>
	</tr>
	<tr>
		<td height="60">&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center" style="text-decoration:underline; font-weight:bold"><?php if ($Crit=='kuasa'){echo str_repeat(".",35);} else {echo $mRo[7];}?></td>
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center"><?php if ($Crit=='kuasa'){echo "NIP. ..............................";} else {echo $mRo[8];}?></td>
	</tr>
</table>