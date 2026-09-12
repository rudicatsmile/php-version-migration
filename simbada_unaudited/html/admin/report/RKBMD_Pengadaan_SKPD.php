<?
require "../Connection.php";
require "../FileFunction.php";
extract($_GET);
#echo $fUNT;
#echo $fTHN;
$NmPim = fGlobal("Nma_Pimpinan","ref_unit","kd_unit",$fUNT,"=","","");
$NiPim = fGlobal("Nip_Pimpinan","ref_unit","kd_unit",$fUNT,"=","","");

$TgC = $Hri." ".fNmBulan($Bln)." ".$Thn;
?>
<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-family:calibri; font-size:10pt">
<tr style="text-align:center; font-weight:bold"> 
  <td>RENCANA KEBUTUHAN PENGADAAN BARANG MILIK DAERAH</td>
</tr>
<tr style="text-align:center; font-weight:bold"> 
  <td>(RENCANA PENGADAAN)</td>
</tr>
<tr style="text-align:center; font-weight:bold"> 
  <td>TAHUN <?=$fTHN?></td>
</tr>
</table>
<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-family:calibri; font-size:10pt">
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr> 
  <td width="50">SKPD</td>
  <td width="16">:</td>
  <td width="1134"><?=fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",$fUNT,"=","",DatabaseSB,$ConSB,"")?></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
<table width="1200" border="0" align="center" cellpadding="1" cellspacing="0" style="border-collapse:collapse; font-family:calibri; font-size:10pt">
<tr style="text-align:center; font-weight:bold"> 
	<td width="35" rowspan="2" style="border:1px solid #000">No.</td>
	<td width="392" rowspan="2" style="border:1px solid #000">Program / Kegiatan / Sub Kegiatan</td>
	<td colspan="4" style="border:1px solid #000">Rencana Kebutuhan Pengadaan BMD</td>
	<td width="141" rowspan="2" style="border:1px solid #000">Cara Pemenuhan</td>
	<td width="121" rowspan="2" style="border:1px solid #000">Ket.</td>
  </tr>
<tr style="text-align:center; font-weight:bold"> 
	<td width="107" style="border:1px solid #000">Kode Barang</td>
	<td width="265" style="border:1px solid #000">Nama Barang</td>
	<td width="67" style="border:1px solid #000">Jumlah</td>
	<td width="72" style="border:1px solid #000">Satuan</td>
  </tr>
<tr style="text-align:center"> 
	<td style="border:1px solid #000">1</td>
	<td style="border:1px solid #000">2</td>
	<td style="border:1px solid #000">3</td>
	<td style="border:1px solid #000">4</td>
	<td style="border:1px solid #000">5</td>
	<td style="border:1px solid #000">6</td>
	<td style="border:1px solid #000">7</td>
	<td style="border:1px solid #000">8</td>
</tr>
<?
$iG=1;
$SQ = "SELECT 
P4.Kd_Program as A0,
P4.Nm_Program as A1,
P3.Kd_Kegiatan as A2,
P3.Nm_Kegiatan as A3,
P2.Kd_Sub_Kegiatan as A4,
P2.Nm_Sub_Kegiatan as A5,
P1.Kd_Rekening as A6,
P1.Nm_Rekening as A7,
P1.Usulan_Jumlah as A8, P1.Usulan_Satuan as A9, P1.Cara_Pemenuhan as A10, P1.Keterangan as A11 
FROM ta_rkbmd_new_rekening P1 
LEFT JOIN ta_rkbmd_new_kegiatan_sub P2 ON P2.Kd_Sub_Kegiatan=P1.Kd_Sub_Kegiatan AND P2.Referensi=P1.Referensi 
LEFT JOIN ta_rkbmd_new_kegiatan P3 ON P3.Kd_Kegiatan=P2.Kd_Kegiatan AND P3.Referensi=P2.Referensi 
LEFT JOIN ta_rkbmd_new_program P4 ON P4.Kd_Program=P3.Kd_Program AND P4.Referensi=P3.Referensi 
WHERE P1.Kd_Unit='".$fUNT."' AND P1.Tahun='".$fTHN."' AND P1.Apbd='0' 
ORDER BY P4.Kd_Program, P3.Kd_Kegiatan, P2.Kd_Sub_Kegiatan, P1.Kd_Rekening";
#echo $SQ;
$rs = mysql_query($SQ);
while ($mRo = mysql_fetch_array($rs, MYSQL_BOTH))
{
	$mRo5 = $mRo[5];
	#$KdSa = $mRo[5];
	#if ($KdSa!=$KdSb)
	#{
	
	#	$KdKa = $mRo[2];
	#	$mRo5 = "Sub Kegiatan: ".$mRo[5];
	#	if ($KdKb!=$KdKa)
	#	{
	#		$mRo5 = "Kegiatan: ".$mRo[3]."<br>".$mRo5;
	#	}
	#}
	#else
	#{
	#	$mRo5 = "";
	#}

?>
<tr height="25">
  <td style="border:1px solid #000; text-align:center"><?=$iG?>.</td>
  <td style="border:1px solid #000"><?=$mRo5?></td>
  <td style="border:1px solid #000"><?=$mRo[6]?></td>
  <td style="border:1px solid #000"><?=$mRo[7]?></td>
  <td style="border:1px solid #000; text-align:center"><?=$mRo[8]?></td>
  <td style="border:1px solid #000"><?=$mRo[9]?></td>
  <td style="border:1px solid #000"><?=$mRo[10]?></td>
  <td style="border:1px solid #000"><?=$mRo[11]?></td>
</tr>
<?
$iG++;
$KdSb = $KdSa;
$KdKb = $KdKa;
$tRo8 = $tRo8+$mRo[8];
}
?>
<tr style="text-align:center; font-weight:bold">
  <td colspan="8" style="border:1px solid #000">&nbsp;</td>
  </tr>
</table>
<table border="0" width="1200" cellspacing="1" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" id="table9">
<tr>
  <td align="center">&nbsp;</td>
  <td width="690" align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  </tr>
<tr>
	<td width="230" align="center">&nbsp;</td>
	<td align="center">&nbsp;</td>
	<td align="center" width="270"><?=$NmIbuk?>, <?=$TgC?></td>
  </tr>
<tr>
	<td width="230" align="center" style="font-weight: bold">&nbsp;</td>
	<td align="center">&nbsp;</td>
	<td align="center" style="font-weight: bold" width="270">Pengguna Barang</td>
  </tr>
<tr>
	<td width="230" align="center">&nbsp;</td>
	<td align="center">&nbsp;</td>
	<td align="center" width="270">&nbsp;</td>
  </tr>
<tr>
	<td width="230" align="center">&nbsp;</td>
	<td align="center">&nbsp;</td>
	<td align="center" width="270">&nbsp;</td>
  </tr>
<tr>
	<td width="230" align="center">&nbsp;</td>
	<td align="center">&nbsp;</td>
	<td align="center" width="270">&nbsp;</td>
  </tr>
<tr>
	<td width="230" align="center" style="font-weight: bold">&nbsp;</td>
	<td align="center">&nbsp;</td>
	<td align="center" style="font-weight: bold; text-decoration:underline" width="270"><?=$NmPim?></td>
  </tr>
<tr>
	<td width="230" align="center">&nbsp;</td>
	<td align="center">&nbsp;</td>
	<td align="center" width="270">NIP. <?=$NiPim?></td>
  </tr>
</table>
