<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$nSQ = "SELECT p1.IDT as A0,
p1.tanggal as A1,
p1.referensi as A2,
p1.nomor as A3,
p1.tahun as A4,
p2.nm_unit as A5,
p1.uraian as A6,
p1.crit as A7,
p2.Nma_Pimpinan as A8,
p2.Nip_Pimpinan as A9 
FROM ta_rkbmd_new_pmf_pmt_phs p1 
LEFT JOIN ref_unit p2 ON p2.kd_unit=p1.kd_unit 
WHERE p1.IDT='".$IdT."'";
#echo $nSQ;
$nRs = mysql_query($nSQ);
$mRo = mysql_fetch_array($nRs);
$kua=""
?>
<div align="center">
<table border="0" width="1330" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
	<tr>
		<td style="font-size: 11pt; font-weight: bold" align="center">RENCANA KEBUTUHAN BARANG MILIK DAERAH </td>
	</tr>
	<tr>
		<td style="font-size: 11pt; font-weight: bold" align="center"> ( RENCANA PEMANFAATAN ) </td>
	</tr>
	<tr>
		<td style="font-size: 10pt; font-weight: bold" align="center"> <?php if ($mRo[7]=="kuasa"){echo "KUASA ";}?>PENGGUNA BARANG</td>
	</tr>
	<tr>
	  <td style="font-size: 10pt; font-weight: bold" align="center">TAHUN ANGGARAN <?=$mRo[4]?></td>
  </tr>
</table>
<table border="0" width="1330" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse" id="table1">
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
<table border="0" width="1330" cellspacing="0" style="font-size:9pt; font-family: Calibri; border-collapse: collapse">
  
  <tr style="text-align:center; font-weight:bold">
    <td style="border:1px #000000 solid">No</td>
    <td width="109" style="border:1px #000000 solid">Kode Barang</td>
    <td style="border:1px #000000 solid">Nama Barang</td>
    <td width="200" style="border:1px #000000 solid">Spesifikasi Nama Barang</td>
    <td width="100" style="border:1px #000000 solid">NIBAR</td>
    <td width="50" style="border:1px #000000 solid">Jumlah<br>Barang</td>
    <td width="200" style="border:1px #000000 solid">Lokasi</td>
    <td width="110" style="border:1px #000000 solid">Peruntukan</td>
    <td width="110" style="border:1px #000000 solid">Bentuk<br>Pemanfaatan</td>
    <td width="80" style="border:1px #000000 solid">Jangka<br>Waktu</td>
    <td width="108" style="border:1px #000000 solid">Ket.</td>
  </tr>
  <tr style="text-align:center; font-weight:bold">
    <td width="30" style="border:1px #000000 solid; border-bottom:3px double">1</td>
    <td style="border:1px #000000 solid; border-bottom:3px double">2</td>
    <td style="border:1px #000000 solid; border-bottom:3px double">3</td>
    <td style="border:1px #000000 solid; border-bottom:3px double">4</td>
    <td style="border:1px #000000 solid; border-bottom:3px double">5</td>
    <td style="border:1px #000000 solid; border-bottom:3px double">6</td>
    <td style="border:1px #000000 solid; border-bottom:3px double">7</td>
    <td style="border:1px #000000 solid; border-bottom:3px double">8</td>
    <td style="border:1px #000000 solid; border-bottom:3px double">9</td>
    <td style="border:1px #000000 solid; border-bottom:3px double">10</td>
    <td style="border:1px #000000 solid; border-bottom:3px double">11</td>
  </tr>
	<?php
	$iG=1;
	$SQ = "SELECT p1.IDT as A0, 
	p1.kd_aset as A1,
	p2.nm_aset as A2,
	p1.nm_aset as A3,
	p1.ref_aset as A4,
	p1.jml_barang as A5,
	p1.lokasi as A6,
	p1.peruntukan as A7,
	p1.bentuk_pemanfaatan as A8,
	p1.jangka_waktu_pemanfaatan as A9,
	'-' as A10 
	
	FROM ta_rkbmd_new_pmf_pmt_phs_rinci p1 
	left join ref_rek_aset108_7 p2 on p2.kd_aset=p1.kd_aset 
	WHERE p1.Referensi='".$mRo[2]."' ORDER BY p1.IDT";
	$rs = mysql_query($SQ);
	#echo $SQ;
	#return false;
	while ($mR = mysql_fetch_array($rs, MYSQL_BOTH))
	{
		?>
		<tr height="23">
		<td style="border:1px #000000 solid; text-align:center"><?=$iG?>.</td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mR[1]?></td>
		<td style="border:1px #000000 solid; padding-left:3px"><?=$mR[2]?></td>
		<td style="border:1px #000000 solid; padding-left:3px"><?=$mR[3]?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mR[4]?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mR[5]?></td>
		<td style="border:1px #000000 solid; padding-left:3px"><?=$mR[6]?></td>
		<td style="border:1px #000000 solid; padding-left:3px"><?=$mR[7]?></td>
		<td style="border:1px #000000 solid; padding-left:3px"><?=$mR[8]?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mR[9]?></td>
		<td style="border:1px #000000 solid"><?=$mR[10]?></td>
		</tr>
		<?php
		$iG++;
	}
	?>
	<?php if ($iG==1){?>
		<tr height="23">
		<td style="border:1px #000000 solid; text-align:center">&nbsp;</td>
		<td style="border:1px #000000 solid; text-align:center">&nbsp;</td>
		<td style="border:1px #000000 solid; padding-left:3px">&nbsp;</td>
		<td style="border:1px #000000 solid; padding-left:3px">&nbsp;</td>
		<td style="border:1px #000000 solid; text-align:center">&nbsp;</td>
		<td style="border:1px #000000 solid; text-align:center">&nbsp;</td>
		<td style="border:1px #000000 solid; padding-left:3px">&nbsp;</td>
		<td style="border:1px #000000 solid; padding-left:3px">&nbsp;</td>
		<td style="border:1px #000000 solid; padding-left:3px">&nbsp;</td>
		<td style="border:1px #000000 solid; text-align:center">&nbsp;</td>
		<td style="border:1px #000000 solid">&nbsp;</td>
		</tr>
	<?php } ?>
  <tr height="22">
    <td colspan="11" style="border:1px #000000 solid">&nbsp;</td>
  </tr>
</table>
<table border="0" width="1330" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
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
		<td align="center" style="text-decoration:underline; font-weight:bold"><?php if ($Crit=='kuasa'){echo str_repeat(".",35);} else {echo $mRo[8];}?></td>
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center"><?php if ($Crit=='kuasa'){echo "NIP. ..............................";} else {echo $mRo[9];}?></td>
	</tr>
</table>