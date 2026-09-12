<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$FnD = str_replace('**',' ',$FnD);

#echo "fld: ".$fld."<br>";
#echo "AsT: ".$AsT."<br>";
#echo "ReO: ".$ReO."<br>";
#echo "SnsIDT: ".$SnsIDT."<br>";
#echo "IdT: ".$IdT."<br>";
#echo "IdL: ".$IdL;

$KdU = substr(fGlobal("KdUPB","tb_lembar_kerja_belum_tercatat","IDT",$IdT,"=","",""),0,11);

$CrT = "";
if ($FnD)
{
	$CrT ="AND (IdPetugas LIKE '%$FnD%' OR NmPetugas LIKE '%$FnD%')";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="240" border="0">
	<tr height="20" onclick="showPetugasChoiseNewAset('petu2','','<?=$fld?>','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>'); return false;">
		<td width="10" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
		<td width="76" style="border-bottom:1px dotted #CCCCCC">xxxx</td>
		<td style="border-bottom:1px dotted #CCCCCC; padding-right:15px">Clear</td>
	</tr>
	<?
	$iG=1;
	$nSQ = "SELECT IdPetugas, NmPetugas FROM tb_lembar_kerja_petugas WHERE KdUPB='".$KdU."' $CrT ORDER BY IdPetugas";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKd = $mRo[0];
		$gNm = $mRo[1];
		?>
		<tr height="20" onclick="showPetugasChoiseNewAset('petu2','<?=$gKd?>','<?=$fld?>','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>'); return false;">
			<td width="10" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
			<td width="76" style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
			<td style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?=$gNm?></td>
		</tr>
		<?
		$iG++;
	}
	?>
	<? if ($iG==1) {?>
	<tr height="20">
		<td colspan="3" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<? } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
