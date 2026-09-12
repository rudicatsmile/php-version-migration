<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
$LmT ="LIMIT 0,200";
if ($FnD)
{
	#$CrT ="AND (P1.Id_Referensi LIKE '%$FnD%' OR P1.Nm_Referensi LIKE '%$FnD%')";
	$CrT ="WHERE (nmProgram LIKE '%$FnD%' OR idReferensi LIKE '%$FnD%')";
	$LmT ="";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="240" border="0" style="font-family:calibri; font-size:9pt">
	<?
	$iG=1;
	$nSQ = "SELECT P1.IDO, P1.Id_Referensi, P1.Nm_Referensi AS NmP, P2.Nm_Referensi AS NmB FROM ref_kegiatan P1 
	LEFT JOIN ref_kegiatan P2 ON P2.Id_Referensi=left(P1.Id_Referensi,7) 
	WHERE P1.Id_Referensi LIKE '_.__.XX.__' $CrT ORDER BY P1.Id_Referensi ".$LmT;
	
	$nSQ = "SELECT IDT, idReferensi, nmProgram 
	FROM ref_barsel_program $CrT group by idReferensi, nmProgram ORDER BY nmProgram ".$LmT;
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		#$rIdT= $mRo[0];
		$rIdT= $mRo[1];
		$gKD = $mRo[1];
		$gNM = $mRo[2];
		$gNB = $mRo[3];
		
		$CeK="";
		?>
		<tr height="20" onclick="showCLICK('prog','<?=$rIdT?>','<?=$IdL?>'); return false;">
			<td valign="top" width="30" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$iG?>.</td>
			<td valign="top" width="80" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$gKD?></td>
			<td width="932" valign="top" style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px" <?=fBackCLR($iG)?>><?=$gNM?></td>
			<td valign="top" width="215" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px"><?=$gNB?></td>
			<td valign="top" width="60" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; text-align:center"><a href="#" class="ico add" onclick="showCLICK('prog','<?=$rIdT?>','<?=$IdL?>'); return false;">Add</a></td>
		</tr>
		<?
		$iG++;
	}
	?>
	<? if ($iG==1) {?>
	<tr height="20">
		<td colspan="5" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<? } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="2">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
