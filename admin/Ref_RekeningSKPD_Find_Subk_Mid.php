<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (idSubKegiatan LIKE '%$FnD%' OR nmSubKegiatan LIKE '%$FnD%')";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="240" border="0">
	<?php
	$iG=1;
	$nSQ = "SELECT idt, idSubKegiatan, nmSubKegiatan FROM ta_apbd_kegiatan_sub_skpd 
	WHERE kdUnit='$gUNT' AND periode='$gTHN' AND apbd='$gAPB' $CrT AND idSubKegiatan LIKE '$gKEG%' ORDER BY idSubKegiatan";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKd = $mRo[1];
		$gNm = $mRo[2];
		?>
		<tr height="18" onclick="showCLICK('subk','<?=$gKd?>','<?=$gNm?>','<?=$IdL?>'); return false;">
			<td valign="top" width="10" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
			<td valign="top" width="120" style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
			<td valign="top" style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?=$gNm?></td>
			<td valign="top" width="40" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
		</tr>
		<?php
		$iG++;
	}
	?>
	<?php if ($iG==1) {?>
	<tr height="20">
		<td colspan="4" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<?php } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
