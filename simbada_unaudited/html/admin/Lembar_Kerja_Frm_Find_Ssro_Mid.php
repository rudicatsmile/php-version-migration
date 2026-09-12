<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$FnD = str_replace('**',' ',$FnD);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (Kd_Aset LIKE '%$FnD%' OR Nm_Aset LIKE '%$FnD%')";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="240" border="0">
	<tr height="18" onclick="showCLICK('ssro','0.0.0.00.00.00.000','ALL','<?=$IdL?>'); return false;">
		<td>&nbsp;</td>
		<td>0.0.0.00.00.00.000</td>
		<td colspan="2" style="text-align:left; vertical-align:middle">ALL</td>
	</tr>
	<?
	$iG=1;
	$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_7 WHERE Kd_Aset LIKE '".$MsT."%' $CrT ORDER BY Kd_Aset";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKd = $mRo[0];
		$gNm = $mRo[1];
		?>
		<tr height="20" onclick="showCLICK('ssro','<?=$gKd?>','<?=$gNm?>','<?=$IdL?>'); return false;">
			<td width="10" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
			<td width="110" style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
			<td style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?=$gNm?></td>
		</tr>
		<?
		$iG++;
	}
	?>
	<? if ($iG==1) {?>
	<tr height="20">
		<td colspan="3" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<? } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
