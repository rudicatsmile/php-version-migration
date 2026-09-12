<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $KdID;
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (Kode LIKE '%$FnD%' OR Deskripsi LIKE '%$FnD%')";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="240" border="0">
	<?php
	$iG=1;
	$nSQ = "SELECT Kode, Deskripsi FROM ref_keg_90_3 WHERE Kode LIKE '".$KdID."%' $CrT ORDER BY Kode";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKd = $mRo[0];
		$gNm = $mRo[1];
		$gBG  = fBackCLR($iG);
		?>
		<tr height="22" onclick="showCLICK('prog','','','<?=$gKd?>','<?=$gNm?>','<?=$IdL?>'); return false;">
			<td width="10" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
			<td width="50" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
			<td <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?=$gNm?></td>
		</tr>
		<?php
		$iG++;
	}
	?>
	<?php if ($iG==1) {?>
	<tr height="20">
		<td colspan="3" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<?php } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
