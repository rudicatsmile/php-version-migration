<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$FnD = str_replace('**',' ',$gFnD);
$CrT = "";

//$gREF = fGlobal("idReferensi","ta_apbd_program_skpd","idProgram:periode:apbd",$gPRG.":".$gTHN.":".$gAPB,"=:=:=","","");
$LmT ="LIMIT 0,500";
if ($FnD)
{
	#<=2019
	$CrT ="AND (P1.kd_rek LIKE '%$FnD%' OR P1.nm_rek LIKE '%$FnD%')";
	
	#<=2020
	$CrT ="AND (P1.kd_rekening LIKE '%$FnD%' OR P1.nm_rekening LIKE '%$FnD%')";
	$LmT ="";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="240" border="0" style="font-family:calibri; font-size:9pt">
	<?
	$iG=1;
	#<=2019
	$nSQ = "SELECT P1.IDT, P1.kd_rek, P1.nm_Rek, P2.nm_Rek as nmRk FROM ref_rek_5 P1 
	LEFT JOIN ref_rek_4 P2 ON P2.kd_rek = left(P1.kd_rek,8) 
	WHERE (P1.kd_rek LIKE '5.2.%' OR P1.kd_rek LIKE '5.3.%') 
	$CrT AND P1.nm_rek NOT LIKE 'dst%' ORDER BY P1.kd_rek ".$LmT;
	
	#2020
	$nSQ = "SELECT P1.IDT, P1.kd_rekening, P1.nm_rekening, P2.nm_rekening as nmRk 
	FROM ref_rek_64_5 P1 
	LEFT JOIN ref_rek_64_4 P2 ON P2.kd_rekening = left(P1.kd_rekening,8) 
	WHERE P1.kd_rekening LIKE '5.%' AND  P1.kd_rekening NOT LIKE '5.1.1.%' 
	$CrT AND P1.nm_rekening NOT LIKE 'dst%' ORDER BY P1.kd_rekening ".$LmT;
	//echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rIdT= $mRo[0];
		$gKD = $mRo[1];
		$gNM = $mRo[2];
		$gNB = $mRo[3];
		
		$CeK="";
		?>
		<tr height="20" onclick="showCLICK('rekn','<?=$rIdT?>','','<?=$IdL?>'); return false;">
			<td valign="top" width="30" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; text-align:center"><?=$iG?>.</td>
			<td valign="top" width="80" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; text-align:center"><?=$gKD?></td>
			<td valign="top" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; padding-left:3px; padding-right:3px"><?=$gNM?></td>
			<td valign="top" width="400" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; padding-left:3px"><?=$gNB?></td>
			<td valign="top" width="60" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #ccc; text-align:center"><a href="#" class="ico add" onclick="showCLICK('rekn','<?=$rIdT?>','','<?=$IdL?>'); return false;">Add</a></td>
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
