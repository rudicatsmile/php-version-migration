<?
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');
extract($_GET);

if ($gAsT=='All'){$gAsT="%";}

$FnD = str_replace('**',' ',$FnD);
$CrT = "";
#$gREF = fGlobal("Referensi","ta_rkbmd_standar_kebutuhan","IDT",$IdT,"=","","");
if ($FnD)
{
	$CrT ="AND (P1.Kd_Aset_108 LIKE '%$FnD%' OR P1.Nm_Aset LIKE '%$FnD%')";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="100%" border="0" style="font-family:arial; font-size:8pt">
	<?
	
	$iG=1;
	$iG=$PgE+1;
	
	$nSQ = "SELECT P1.IdT as A0, 
	P1.Referensi as A1, 
	P1.Nm_Aset as A2, 
	P1.Harga as A3, 
	IfNull(sum(P2.Debet),0) as A4 
	
	FROM ta_kib_108 P1 
	LEFT JOIN ta_kib_post_108 P2 ON P2.Referensi=P1.Referensi AND P2.Kd_UPB=P1.Kd_UPB AND P2.Ref_Group=P1.Ref_Group
	WHERE P1.Kd_Aset_108='".$KdA."' AND P1.Kd_UPB LIKE '".$SkD."%' 
	$CrT GROUP BY P1.Referensi, P1.Ref_Group 
	ORDER BY P1.Kd_Aset_108 LIMIT $PgE,$gLST";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$Ref = $mRo[1];
		?>
		<tr height="30" <?=fBackCLR($iG)?>>
			<td width="31" style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$iG?>.</td>
			<td width="120" style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$mRo[1]?></td>
			<td width="350" style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px"><?=$mRo[2]?></td>
			<td width="100" style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($mRo[3])?></td>
			<td width="100" style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($mRo[4])?></td>
			<td style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px">&nbsp;</td>
			<td width="61" style="border-bottom:1px dotted #CCCCCC; border-right:0px dotted #CCCCCC; text-align:center">
			<a href="#" class="ico prev" onclick="showDetail('<?=$Ref?>','<?=$IdL?>'); return false;">&nbsp;</a></td>
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
		<td colspan="7" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<? } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
<script languange="javascript">
$("#fFindPL").focus();
</script>