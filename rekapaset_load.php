<?php require('connfile.php');?>
<?php

$gAss1 = fGlobal('IfNull(sum(Debet),0)','ta_kib_post_108','Referensi:Tanggal:extracom','TNH.%:2022-12-31:N','LIKE:<=:=','','');
$gAss1 = $gAss1 - fGlobal('IfNull(sum(Kredit),0)','ta_kib_post_108','Referensi:Tanggal:extracom','TNH.%:2022-12-31:N','LIKE:<=:=','','');

$gAss2 = fGlobal('IfNull(sum(Debet),0)','ta_kib_post_108','Referensi:Tanggal:extracom','ALT.%:2022-12-31:N','LIKE:<=:=','','');
$gAss2 = $gAss2 - fGlobal('IfNull(sum(Kredit),0)','ta_kib_post_108','Referensi:Tanggal:extracom','ALT.%:2022-12-31:N','LIKE:<=:=','','');

$gAss3 = fGlobal('IfNull(sum(Debet),0)','ta_kib_post_108','Referensi:Tanggal:extracom','BNG.%:2022-12-31:N','LIKE:<=:=','','');
$gAss3 = $gAss3 - fGlobal('IfNull(sum(Kredit),0)','ta_kib_post_108','Referensi:Tanggal:extracom','BNG.%:2022-12-31:N','LIKE:<=:=','','');

$gAss4 = fGlobal('IfNull(sum(Debet),0)','ta_kib_post_108','Referensi:Tanggal:extracom','JLN.%:2022-12-31:N','LIKE:<=:=','','');
$gAss4 = $gAss4 - fGlobal('IfNull(sum(Kredit),0)','ta_kib_post_108','Referensi:Tanggal:extracom','JLN.%:2022-12-31:N','LIKE:<=:=','','');

$gAss5 = fGlobal('IfNull(sum(Debet),0)','ta_kib_post_108','Referensi:Tanggal:extracom','ATL.%:2022-12-31:N','LIKE:<=:=','','');
$gAss5 = $gAss5 - fGlobal('IfNull(sum(Kredit),0)','ta_kib_post_108','Referensi:Tanggal:extracom','ATL.%:2022-12-31:N','LIKE:<=:=','','');

$gAss6 = fGlobal('IfNull(sum(Debet),0)','ta_kib_post_108','Referensi:Tanggal:extracom:KdpToAset','KDP.%:2022-12-31:N:N','LIKE:<=:=:=','','');
$gAss6 = $gAss6 - fGlobal('IfNull(sum(Kredit),0)','ta_kib_post_108','Referensi:Tanggal:extracom:KdpToAset','KDP.%:2022-12-31:N:N','LIKE:<=:=:=','','');

$gAss7 = fGlobal('IfNull(sum(Debet),0)','ta_kib_post_108','Referensi:Tanggal','KDL.%:2022-12-31','LIKE:<=','','');
$gAss7 = $gAss7 - fGlobal('IfNull(sum(Kredit),0)','ta_kib_post_108','Referensi:Tanggal','KDL.%:2022-12-31','LIKE:<=','','');
?>
<table width="100%" border="0" style="font-size:8pt; font-family:calibri">
	<tr height="20">
		<td width="15" align="center">::</td>
		<td align="left">TANAH</td>
		<td width="10" align="center">:</td>
		<td width="10" align="center">Rp.</td>
		<td width="125" style="text-align:right"><?=fConvertToRupiah($gAss1)?></td>
		<td width="5">&nbsp;</td>
	</tr>
	<tr height="20">
		<td align="center">::</td>
		<td align="left">PERALATAN & MESIN</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td style="text-align:right"><?=fConvertToRupiah($gAss2)?></td>
		<td>&nbsp;</td>
	</tr>
	<tr height="20">
		<td align="center">::</td>
		<td align="left">GEDUNG & BANGUNAN</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td style="text-align:right"><?=fConvertToRupiah($gAss3)?></td>
		<td>&nbsp;</td>
	</tr>
	<tr height="20">
		<td align="center">::</td>
		<td align="left">JALAN, IRIGASI & JARINGAN</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td style="text-align:right"><?=fConvertToRupiah($gAss4)?></td>
		<td>&nbsp;</td>
	</tr>
	<tr height="20">
		<td align="center">::</td>
		<td align="left">ASET TETAP LAINNYA</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td style="text-align:right"><?=fConvertToRupiah($gAss5)?></td>
		<td>&nbsp;</td>
	</tr>
	<tr height="20">
		<td align="center">::</td>
		<td align="left">KONST. DLM PENGERJAAN</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td style="text-align:right"><?=fConvertToRupiah($gAss6)?></td>
		<td>&nbsp;</td>
	</tr>
	<tr height="20">
		<td align="center">::</td>
		<td align="left">ASET LAINNYA</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td style="text-align:right"><?=fConvertToRupiah($gAss7)?></td>
		<td>&nbsp;</td>
	</tr>
</table>
