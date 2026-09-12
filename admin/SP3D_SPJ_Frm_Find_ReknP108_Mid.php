<?php
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');
extract($_GET);
#echo $IdT;
$FnD = str_replace('**',' ',$gFnD);

if ($FnD)
{
	$CrT =" AND (P1.Kd_Aset LIKE '%$FnD%' OR P1.Nm_Aset LIKE '%$FnD%' OR P2.Nm_Aset LIKE '%$FnD%')";
}
$eRF  = fGlobal("Referensi","ta_sp3d_rinci","IDT",$fIdT,"=","","");
$r90  = fGlobal("Kd_ReknP90","ta_sp3d_rinci","IDT",$fIdT,"=","","");

?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="100%" border="0" style="font-family:calibri; font-size:10pt">
	<?php
	$iG=1;
	$nSQ = "SELECT P1.Kd_Aset as A0, P1.Nm_Aset as A1, P2.Nm_Aset as A2 
	FROM ref_rek_aset108_7 P1 
	LEFT JOIN ref_rek_aset108_6 P2 ON P2.Kd_Aset=LEFT(P1.Kd_Aset,14)
	WHERE P1.Kd_Aset LIKE '$gREK%' AND P1.Kd_Aset NOT LIKE '1.3.7%' $CrT ORDER BY P1.Kd_Aset LIMIT 0, $gLST";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rKD  = $mRo[0];
		$eCK  = fGlobal("IDT","ta_sp3d_spj","Referensi_SP3B:Kd_ReknP90:Kd_ReknP108",$eRF.":".$r90.":".$rKD,"=:=:=","","");
		?>
		<tr height="24">
			<td width="30" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$iG?>.</td>
			<td width="120" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$mRo[0]?></td>
			<td <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px"><?=$mRo[1]?></td>
			<td width="250" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px"><?=$mRo[2]?></td>
			<td width="50" class="ac" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px">
			<?php if ($eCK){?>
			<!--img src="css/images/okey.gif" /-->
			<?php } ?>			</td>
			<td align="center" width="50" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC">
			<?php if ($eCK==''){?>
			<a href="#" class="ico add" onclick="showCLICK('addrekn','','','<?=$fIdT?>','<?=$rKD?>','<?=$IdL?>'); return false;">Add</a>
			<?php } else {?>
			<img src="css/images/okey.gif" />
			<?php } ?>
			</td>
		</tr>
		<?php
		$iG++;
	}
	?>
	<?php if ($iG==1) {?>
	<tr height="20">
		<td colspan="6" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<?php } ?>
	<tr height="100%">
		<td>&nbsp;</td>
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