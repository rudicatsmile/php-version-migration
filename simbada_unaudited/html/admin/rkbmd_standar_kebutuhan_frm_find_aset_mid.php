<?
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');
extract($_GET);

if ($gAsT=='All'){$gAsT="%";}

$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
$gREF = fGlobal("Referensi","ta_rkbmd_standar_kebutuhan","IDT",$IdT,"=","","");
if ($FnD)
{
	$CrT ="AND (P1.Kd_Aset LIKE '%$FnD%' OR P1.Nm_Aset LIKE '%$FnD%')";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="100%" border="0" style="font-family:arial; font-size:8pt">
	<?
	
	$iG=1;
	$iG=$PgE+1;
	
	$nSQ = "SELECT P1.Kd_Aset as A0, P1.Nm_Aset as A1, P2.Nm_Aset as A2, P3.Nm_Aset as A3 
	FROM ref_rek_aset108_7 P1 
	LEFT JOIN ref_rek_aset108_6 P2 ON P2.Kd_Aset=left(P1.Kd_Aset,14) 
	LEFT JOIN ref_rek_aset108_5 P3 ON P3.Kd_Aset=left(P1.Kd_Aset,11) 
	WHERE P1.Kd_Aset LIKE '".$gAsT."%' 
	$CrT ORDER BY P1.Kd_Aset LIMIT $PgE,$gLST";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKd = $mRo[0];
		$gNm = $mRo[1];
		$gGL = $mRo[3]." -> ".$mRo[2];
		?>
		<tr height="30" <?=fBackCLR($iG)?>>
			<td width="31" style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$iG?>.</td>
			<td width="120" style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$gKd?></td>
			<td width="350" style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px"><?=$gNm?></td>
			<td style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=ucwords(strtolower($gGL))?></td>
			<td width="61" style="border-bottom:1px dotted #CCCCCC; border-right:0px dotted #CCCCCC; text-align:center">
			<a href="#" class="ico add" onclick="showCLICK('aset','<?=$IdT?>','<?=$gKd?>','<?=$gNm?>','<?=$IdL?>'); return false;">add</a></td>
	    </tr>
		<?
		$iG++;
	}
	?>
	<?
	$colSP=8;
	$tamSP="NO";
	if ($UID=='creator'){
		$colSP=6;
		$tamSP="YA";
	}
	if ($iG>1) {
	?>
	<!--tr height="20" valign="top">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="<?=$colSP?>">&nbsp;</td>
		<? if ($tamSP=="YA") {?>
		<td align="center" title="Tanpa harus checklist" style="border:1px solid #FF0000; border-right:0px solid #FF0000; vertical-align:middle; cursor: pointer" onclick="proslNIL('aset','<?=$PgE?>','<?=$IdT?>','<?=$gAsT?>','<?=$gLhI?>','<?=$gEXT?>','<?=$IdL?>','ALL'); return false;">
		<a href="#" class="ico add">PROSES ALL</a></td>
		<? } ?>
	</tr-->
	<? } ?>
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
<script languange="javascript">
$("#fFindP").focus();
</script>