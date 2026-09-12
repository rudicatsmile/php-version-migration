<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (P1.kd_aset LIKE '%$FnD%' OR P1.nm_aset LIKE '%$FnD%')";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="240" border="0">
	<?
	$iG=1;
	$nSQ = "SELECT P1.kd_aset, P1.nm_aset as nm1, P2.nm_aset as nm2, P3.nm_aset as nm3 
	FROM ref_rek_aset5 P1 
	LEFT JOIN ref_rek_aset4 P2 ON P2.kd_aset=left(P1.kd_aset,11) 
	LEFT JOIN ref_rek_aset3 P3 ON P3.kd_aset=left(P2.kd_aset,8) 
	WHERE P1.nm_aset NOT LIKE '%???%' AND P1.kd_aset NOT LIKE '07.%' 
	$CrT ORDER BY P1.kd_aset LIMIT 0,200";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKd = $mRo[0];
		$gNmA = strtoupper($mRo[1]);
		$gNmB = $mRo[2];
		$gNmC = $mRo[3];
		?>
		<tr height="18" onclick="P_AddItemNext('<?=$gKd?>','<?=$gNmA?>','<?=$IdL?>'); return false;">
			<td valign="top" width="10" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
			<td valign="top" width="100" style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
			<td valign="top" style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?="<i>".$gNmC." -> ".$gNmB." -> </i>".$gNmA?></td>
			<td valign="top" width="40" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
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
