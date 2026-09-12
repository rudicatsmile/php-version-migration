<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

?>
<table align="center" border="0" width="780" cellspacing="1" style="font-size:10pt; font-family: Calibri; border-collapse: collapse">
<tr>
	<td style="font-size: 12pt; font-weight: bold">CROSSCHECK CALON PESERTA PELATIHAN PER UPB</td>
</tr>
<tr>
  <td style="font-size: 12pt; font-weight: bold" align="center">&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-size:10pt">
  <tr style="text-align:center; font-weight:bold">
    <td width="35" rowspan="2" style="border:1px solid #000">NO</td>
    <td width="270" rowspan="2" style="border:1px solid #000">UPB / UPTD </td>
    <td colspan="3" style="border:1px solid #000">CALON PESERTA </td>
  </tr>
  <tr style="text-align:center; font-weight:bold">
    <td width="203" style="border:1px solid #000">Nama</td>
    <td width="163" style="border:1px solid #000">Jabatan</td>
    <td style="border:1px solid #000">Nomor HP/WA</td>
  </tr>
	<?
	$iG=1;
	$SQL = "SELECT P1.Kd_UPB, P1.Nm_UPB, P2.Nm_Sub 
	FROM ref_upb P1
	LEFT JOIN ref_sub_unit P2 ON P2.Kd_Sub=left(P1.Kd_UPB,14)
	WHERE P1.Kd_UPB LIKE '24.04.08.01.%' AND P2.Nm_Sub LIKE 'UPTD%' ORDER BY P2.Kd_Sub, P1.Kd_UPB";
	#echo $SQL;
	$nRs = mysql_query($SQL);
	while ($mRo = mysql_fetch_array($nRs))
	{
	?>
	<tr height="43">
		<td style="border:1px solid #000; text-align:center; vertical-align:top; padding-top:3px"><?=$iG?>.</td>
		<td style="border:1px solid #000; padding-left:3px; vertical-align:top; padding-top:3px"><?="<b>".$mRo[1]."</b><br><i>".$mRo[2]?></td>
		<td colspan="3" style="border:1px solid #000">
		<table align="center" border="0" width="100%" height="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-size:10pt">
		<?
		$gA=1;
		$SQ = "SELECT Nama, Jabatan, NoHP FROM ta_sp3d_pendaftaran WHERE Kd_UPB = '".$mRo[0]."' ORDER BY Nama";
		$rs = mysql_query($SQ);
		while ($mR = mysql_fetch_array($rs))
		{
		$BrD=0;
		if ($gA>1){
			$BrD=1;
		}
		?>
		<tr>
		<td width="200" style="border-right:1px solid #000; border-top:<?=$BrD?>px dotted #000; padding-left:3px"><?=$mR[0]?>.</td>
		<td width="160" style="border-right:1px solid #000; border-top:<?=$BrD?>px dotted #000; padding-left:3px"><?=$mR[1]?></td>
		<td style="border-top:<?=$BrD?>px dotted #000; padding-left:3px"><?=$mR[2]?></td>
		</tr>
		<?
		$gA++;
		}
		?>
		<? if ($gA==1){?>
		<tr bgcolor="#ebf7ec">
		<td width="200" style="border-right:1px solid #000; padding-left:3px">&nbsp;</td>
		<td width="160" style="border-right:1px solid #000; padding-left:3px">&nbsp;</td>
		<td style="padding-left:3px">&nbsp;</td>
		</tr>
		<? } ?>
		</table>		</td>
	</tr>
	<?
	$iG++;
	}
	?>
</table>
