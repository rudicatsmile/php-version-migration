<?php
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
	<?php if ($Rpt=='Y'){?>
		<tr height="20" onclick="showCLICK('unit','00.00.00.00','ALL','<?=$IdL?>'); return false;">
		  <td width="10" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
		  <td width="76" style="border-bottom:1px dotted #CCCCCC">00.00.00.00</td>
		  <td style="border-bottom:1px dotted #CCCCCC; padding-right:15px">ALL</td>
		</tr>
	<?php } ?>
	<?php
	$iG=1;
	$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset!='1.3.7' AND Kd_Aset!='1.5.2' AND Kd_Aset!='1.5.4' AND Kd_Aset!='1.5.5' AND Kd_Aset!='1.5.6' $CrT ORDER BY Kd_Aset";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKd = $mRo[0];
		$gNm = $mRo[1];
		?>
		<tr height="20" onclick="showCLICK('rekn3','<?=$gKd?>','<?=$gNm?>','<?=$IdL?>'); return false;">
			<td width="10" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
			<td width="76" style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
			<td style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?=$gNm?></td>
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
	</tr>
</table>
