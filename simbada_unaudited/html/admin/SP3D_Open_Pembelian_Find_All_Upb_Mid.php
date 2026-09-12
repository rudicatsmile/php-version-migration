<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$FnD = str_replace('**',' ',$FnD);
#echo $gUPB;
#return false;

#$mSKP= substr(fGlobal("Kd_UPB","ta_usulan_rinci_108","IDT",$gID,"=","",""),0,11);

$CrT = "";
if ($FnD)
{
	$CrT ="WHERE (P1.Kd_UPB LIKE '%$FnD%' OR P1.Nm_UPB LIKE '%$FnD%' OR P2.Nm_Sub LIKE '%$FnD%' OR P3.Nm_Unit LIKE '%$FnD%')";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="780" height="100%" border="0">
	<?
	$iG=1;
	$nSQ = "SELECT P1.Kd_UPB as A0, P1.Nm_UPB as A1, P2.Nm_Sub as A2, P3.Nm_Unit as A3 
	FROM ref_upb P1 
	JOIN ref_sub_unit P2 ON P2.Kd_Sub = left(P1.Kd_UPB,14) 
	JOIN ref_unit P3 ON P3.Kd_Unit=left(P1.Kd_UPB,11) $CrT ORDER BY Nm_UPB";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gUPB = $mRo[0];
		$BG = fBackCLR($iG);
		?>
		<!--tr height="28" onclick="choiseFIND('<?=$gFrm?>','tran','<?=$gID?>','<?=$gKd?>','<?=$gNm?>','<?=$IdL?>'); return false;"-->
		<tr height="28">
			<td style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; text-align:center" <?=$BG?>><?=$mRo[0]?></td>
			<td style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; padding-left:3px" <?=$BG?>><?=$mRo[1]?></td>
			<td style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; padding-left:3px" <?=$BG?>><?=$mRo[2]?></td>
			<td style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; padding-left:3px" <?=$BG?>><?=$mRo[3]?></td>
			<td class="ac" style="border-bottom:1px dotted #ccc" <?=$BG?>><a href="<?="SP3D_Open_Pembelian.php?FrmG=DANA BOS -> REKAPITULASI PEMBELIAN BMD&gUPB=".$gUPB."&IdL=".$IdL?>" class="ico edit">Use</a></td>
		</tr>
		<?
		$iG++;
	}
	?>
	<? if ($iG==1) {?>
	<tr height="20">
		<td style="border-right:1px solid #ccc">&nbsp;</td>
		<td style="border-right:1px solid #ccc">&nbsp;</td>
		<td style="border-right:1px solid #ccc">&nbsp;</td>
		<td style="border-right:1px solid #ccc; text-align:center">Data tidak ditemukan..!!</td>
		<td>&nbsp;</td>
	</tr>
	<? } ?>
	<tr height="100%">
		<td width="110" style="border-right:1px solid #ccc">&nbsp;</td>
		<td width="250" style="border-right:1px solid #ccc">&nbsp;</td>
		<td width="250" style="border-right:1px solid #ccc">&nbsp;</td>
		<td width="250" style="border-right:1px solid #ccc">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
