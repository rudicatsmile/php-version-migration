<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$FnD = str_replace('**',' ',$gFnD);
$CrT = "";

$gREF = fGlobal("Referensi","ta_usulan_108","IDT",$IdT,"=","","");
if ($FnD)
{
	$CrT ="AND (Referensi LIKE '%$gFnD%' OR Nomor LIKE '%$gFnD%' OR Dokumen_Nom LIKE '%$FnD%' OR Uraian LIKE '%$FnD%')";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="240" border="0" style="font-family:arial; font-size:8pt">
	<?
	$iG=1;
	$nSQ = "SELECT IDT, Tanggal,Nomor,Kd_UPB,Jenis,Dokumen_Nom,Dokumen_Tgl,Uraian,Referensi FROM ta_usulan_108 WHERE Kd_UPB LIKE '$gUPB%' $CrT ORDER BY Referensi DESC LIMIT 0,100";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rIdT = $mRo[0];
		$mRo1 = $mRo[1];
		$mRo2 = $mRo[2];
		$mRo3 = $mRo[3];
		$mRo4 = $mRo[4];
		$mRo5 = $mRo[5];
		$mRo6 = $mRo[6];
		$mRo7 = $mRo[7];
		$mRo8 = $mRo[8];
		$mRo4= fGlobal("Deskripsi","ref_usulan_jenis","Kode",$mRo4,"=","","");
		$gHR = fGlobal("Ifnull(sum(nilai_akhir),0)","ta_usulan_rinci_108","Referensi",$mRo8,"=","","");
		$ico = "edit";
		?>
		<tr height="28" onclick="showLINK('<?=$rIdT?>','<?=$IdL?>'); return false;">
			<td width="30" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$iG?>.</td>
			<td width="70" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=fConvertDateShort($mRo1)?></td>
			<td width="115" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$mRo8?></td>
			<td width="100" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$mRo3?></td>
			<td width="130" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:left; padding-left:3px"><?=$mRo4?></td>
			<td width="150" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$mRo5?></td>
			<td width="70" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><? if (substr($mRo6,0,4)!="0000") {echo fConvertDateShort($mRo6);}?></td>
			<td <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$mRo7?></td>
			<td width="90" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:right; padding-right:3px"><?=fConvertToRupiah($gHR)?></td>
			<td width="50" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; text-align:center"><a href="#" class="ico <?=$ico?>" onclick="showLINK('<?=$rIdT?>','<?=$IdL?>'); return false;"><?=$ico?></a></td>
		</tr>
		<?
		$iG++;
	}
	?>
	<? if ($iG==1) {?>
	<tr height="20">
		<td colspan="10" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<? } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="7">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
