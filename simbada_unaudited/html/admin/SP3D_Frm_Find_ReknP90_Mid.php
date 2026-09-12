<?
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');
extract($_GET);

$FnD = str_replace('**',' ',$gFnD);

$CrT ="";
if ($FnD)
{
	$CrT =" AND (Kd_Rek LIKE '%$FnD%' OR Nm_Rek LIKE '%$FnD%')";
}
$eRF  = fGlobal("Referensi","ta_sp3d","IDT",$IdT,"=","","");
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="100%" border="0" style="font-family:arial; font-size:9pt">
	<?
	$iG=1;
	if ($gREK=='4_5'){
		$nSQ = "SELECT Kd_Rek, Nm_Rek FROM ref_rek_90_6 WHERE (Kd_Rek LIKE '4%' OR Kd_Rek LIKE '5%') $CrT ORDER BY Kd_Rek LIMIT 0,$gLST";
	}
	else{
		$nSQ = "SELECT Kd_Rek, Nm_Rek FROM ref_rek_90_6 WHERE Kd_Rek LIKE '$gREK%' $CrT ORDER BY Kd_Rek LIMIT 0,$gLST";
	}
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rIdT = $mRo[0];
		$eCK  = fGlobal("IDT","ta_sp3d_rinci","Referensi:Kd_ReknP90",$eRF.":".$rIdT,"=:=","","");
		?>
		<tr height="25">
			<td width="30" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$iG?>.</td>
			<td width="100" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$mRo[0]?></td>
			<td <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$mRo[1]?></td>
			<td width="90" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$g06?></td>
			<td align="center" width="50" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC">
			<? if (!$eCK){?>
			<a href="#" class="ico add" onclick="showCLICK('addrekn','','','<?=$IdT?>','<?=$rIdT?>','<?=$IdL?>'); return false;">Add</a>
			<? } else {?>
			<img src="css/images/okey.gif" />
			<? } ?>
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
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
<script languange="javascript">
$("#fFindP").focus();
</script>