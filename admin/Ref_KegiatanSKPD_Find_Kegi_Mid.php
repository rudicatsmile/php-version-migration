<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
#$gREF = fGlobal("idReferensi","ta_apbd_program_skpd","idProgram:periode:apbd",$gPRG.":".$gTHN.":".$gAPB,"=:=:=","","");
$gREF = substr($gPRG,13,10);
$LmT ="LIMIT 0,200";
if ($FnD)
{
	$CrT ="AND (P1.Id_Referensi LIKE '%$FnD%' OR P1.Nm_Referensi LIKE '%$FnD%')";
	$CrT ="AND (nmKegiatan LIKE '%$FnD%' OR idReferensi LIKE '%$FnD%')";
	$LmT ="";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="240" border="0" style="font-family:calibri; font-size:9pt">
	<?php
	$iG=1;
	$nSQ = "SELECT P1.IDO, P1.Id_Referensi, P1.Nm_Referensi AS NmP, P2.Nm_Referensi AS NmB 
	FROM ref_kegiatan P1 
	LEFT JOIN ref_kegiatan P2 ON P2.Id_Referensi=left(P1.Id_Referensi,7) 
	WHERE P1.Id_Referensi LIKE '".$gREF.".__' $CrT ORDER BY P1.Id_Referensi ".$LmT;
	
	#$nSQ = "SELECT IDT, idReferensi, nmKegiatan 
	#FROM ref_barsel_Kegiatan WHERE idReferensi LIKE 'X.XX.XX.$gREF%' $CrT group by idReferensi, nmKegiatan ORDER BY idReferensi ".$LmT;
	echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rIdT= $mRo[0];
		$gKD = $mRo[1];
		$gNM = $mRo[2];
		$gNB = $mRo[3];
		
		$CeK="";
		?>
		<tr height="20" onclick="showCLICK('kegi','<?=$rIdT?>','<?=$IdL?>'); return false;">
			<td valign="top" width="30" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$iG?>.</td>
			<td valign="top" width="80" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$gKD?></td>
			<td valign="top" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$gNM?></td>
			<td valign="top" width="400" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px"><?=$gNB?></td>
			<td valign="top" width="60" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; text-align:center"><a href="#" class="ico add" onclick="showCLICK('kegi','<?=$rIdT?>','<?=$IdL?>'); return false;">Add</a></td>
		</tr>
		<?php
		$iG++;
	}
	?>
	<?php if ($iG==1) {?>
	<tr height="20">
		<td colspan="5" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<?php } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="2">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
