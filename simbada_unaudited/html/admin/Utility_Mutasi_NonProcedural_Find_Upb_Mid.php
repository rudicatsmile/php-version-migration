<?
require('Connection.php');
require('FileFunction.php');
require('Connection_CopyData.php');
CallConnection(DatabaseSC,$ConSC);
extract($_GET);
$tX="";
if ($TJN)
{
	CallConnection(DatabaseSB,$ConSB);
	$tX="2";
}
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (Kd_UPB LIKE '%$FnD%' OR Nm_UPB LIKE '%$FnD%')";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="240" border="0" style="font-size:9pt">
	<tr height="18" onclick="showCLICK('upb<?=$tX?>','','ALL','<?=$IdL?>'); return false;">
		<td>&nbsp;</td>
		<td>00.00.00.00.00.000</td>
		<td colspan="2" style="text-align:left; vertical-align:middle">ALL</td>
	</tr>
	<?
	$iG=1;
	$nSQ = "SELECT Kd_UPB, Nm_UPB FROM ref_upb WHERE Kd_UPB LIKE '$gSUB.%' $CrT ORDER BY Kd_UPB";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKd = $mRo[0];
		$gNm = $mRo[1];
		?>
		<tr height="18" onclick="showCLICK('upb<?=$tX?>','<?=$gKd?>','<?=$gNm?>','<?=$IdL?>'); return false;">
			<td valign="top" width="10" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
			<td valign="top" width="105" style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
			<td valign="top" style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?=$gNm?></td>
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
