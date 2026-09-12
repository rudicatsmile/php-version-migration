<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="WHERE (Kd_Unit LIKE '%$FnD%' OR Nm_Unit LIKE '%$FnD%')";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="240" border="0">
	<?
	$iG=1;
	$nSQ = "SELECT 
	Kd_Unit, 
	Nm_Unit, 
	Nma_Pimpinan,
	Nip_Pimpinan,
	Jab_Pimpinan 
	FROM ref_unit $CrT ORDER BY Kd_Unit";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKd = $mRo[0];
		$gNm = $mRo[1];

		$NmP = $mRo[2];
		$NiP = $mRo[3];
		$JbP = $mRo[4];
		?>
		<tr height="20" onclick="showCLICK('<?=$div?>','','','<?=$gKd?>','<?=$gNm?>','<?=$NmP?>','<?=$NiP?>','<?=$JbP?>','<?=$IdL?>'); return false;">
			<td width="10" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
			<td width="70" style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
			<td style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?=$gNm?></td>
			<td width="40" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
		</tr>
		<?
		$iG++;
	}
	?>
	<? if ($iG==1) {?>
	<tr height="20">
		<td colspan="4" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<? } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
