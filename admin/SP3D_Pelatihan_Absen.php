<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

?>
<table align="center" border="0" width="780" cellspacing="1" style="font-size:10pt; font-family: Calibri; border-collapse: collapse">
<tr>
	<td style="font-size:15pt; font-weight: bold">DAFTAR HADIR</td>
</tr>
<tr>
	<td style="font-size:13pt; font-weight: bold">PESERTA PELATIHAN KAPITALISASI DANA BOSS</td>
</tr>
<tr>
  <td style="font-size: 12pt; font-weight: bold" align="center">&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-size:10pt">
  <tr height="30" style="text-align:center; font-weight:bold">
    <td width="35" style="border:1px solid #000">NO</td>
    <td width="280" style="border:1px solid #000">NAMA</td>
    <td width="220" style="border:1px solid #000">SATDIK</td>
    <td style="border:1px solid #000">TANDA TANGAN</td>
  </tr>
	<?php
	$iG=1;
	$SQL = "SELECT P1.Nama, P1.NIP, P1.Jabatan, P2.Nm_UPB 
	FROM ta_sp3d_pendaftaran P1
	LEFT JOIN ref_upb P2 ON P2.Kd_UPB=P1.Kd_UPB ORDER BY P1.Kd_UPB, P1.Nama";
	#echo $SQL;
	$nRs = mysql_query($SQL);
	while ($mRo = mysql_fetch_array($nRs))
	{
	?>
	<tr height="50">
		<td style="border:1px solid #000; text-align:center"><?=$iG?>.</td>
		<td style="border:1px solid #000; padding-left:3px"><?="<font style='font-size:11pt; font-weight:bold'>".$mRo[0]."</font><br>".$mRo[1]?></td>
		<td style="border:1px solid #000; padding-left:3px"><?=$mRo[3]?></td>
		<td style="border:1px solid #000; font-size:12pt">&nbsp;</td>
	</tr>
	<?php
	$iG++;
	}
	?>
</table>
