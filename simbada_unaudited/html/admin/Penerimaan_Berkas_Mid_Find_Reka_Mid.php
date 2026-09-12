<?
require('Connection.php');
require('FileFunction.php');
require ('CheckLogin.php');

extract($_GET);
#echo $IdT;
$FnD = str_replace('**',' ',$FnD);
$CrT = "";
if ($FnD)
{
	$CrT ="WHERE (Kode LIKE '%$FnD%' OR Nma_Perusahaan LIKE '%$FnD%' OR Nma_Pimpinan LIKE '%$FnD%' OR Alamat LIKE '%$FnD%')";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="240" border="0">
	<?
	$gKd='R000';
	$gNm='Kosongkan.......!!';
	?>
	<tr height="18" onclick="showCLICK('reka','<?=$gKd?>','<?=$gNm?>','<?=$IdT?>','<?=$IdL?>'); return false;">
		<td width="10" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
		<td width="40" style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
		<td width="180" style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?=$gNm?></td>
		<td style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?=$gAL?></td>
		<td width="40" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
	</tr>
	<?
	$iG=1;
	$nSQ = "SELECT 
	Kode,
	Nma_Perusahaan,
	Nma_Pimpinan,
	Alamat 
	FROM ta_rekanan $CrT ORDER BY Kode";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKd = $mRo[0];
		$gNm = $mRo[1];
		$gAL = $mRo[3];
		?>
		<tr height="18" onclick="showCLICK('reka','<?=$gKd?>','<?=$gNm?>','<?=$IdT?>','<?=$IdL?>'); return false;">
			<td width="10" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
			<td width="40" style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
			<td width="180" style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?=$gNm?></td>
			<td style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?=$gAL?></td>
			<td width="40" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
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
