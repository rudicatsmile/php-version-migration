<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$FnD  = str_replace('**',' ',$gFnD);
$FrmG = str_replace('**',' ',$FrmG);
$CrT = "";

if ($FnD)
{
	$CrT ="AND (Referensi LIKE '%$gFnD%' OR Nomor LIKE '%$gFnD%' OR Perihal LIKE '%$FnD%' OR KpdYth LIKE '%$FnD%' OR Sebab LIKE '%$FnD%')";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="240" border="0" style="font-family:arial; font-size:8pt">
	<?
	$iG=1;
	$nSQ = "SELECT P1.IDT as A0, 
	P1.Referensi as A1,
	P1.Tanggal as A2,
	P1.Nomor as A3,
	P1.Perihal as A4,
	P2.Nm_Unit as A5,
	P1.KpdYth as A6,
	P1.Lampiran as A7,
	P1.Sebab as A8 
	FROM ta_surat_usulan_penghentian P1 
	LEFT JOIN ref_unit P2 ON P2.Kd_Unit=P1.KdUnit 
	WHERE P1.KdUnit = '$gUnt' $CrT ORDER BY P1.Referensi DESC LIMIT 0,100";
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
		$ico = "edit";
		#fConvertDateShort
		?>
		<tr height="28" <?=fBackCLR($iG)?>>
			<td width="25" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; text-align:center"><?=$iG?>.</td>
			<td width="105" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; text-align:center"><?=$mRo1?></td>
			<td width="65" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; text-align:center"><?=$mRo2?></td>
			<td width="90" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; text-align:left; padding-left:2px"><?=$mRo3?></td>
			<td width="130" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; text-align:left; padding-left:2px"><?=$mRo4?></td>
			<td width="200" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; text-align:left; padding-left:2px"><?=ucwords(strtolower($mRo5))?></td>
			<td style="border-bottom:1px dotted #ccc; text-align:center"><a href="#" class="ico <?=$ico?>" onclick="showLINK('<?=$rIdT?>','<?=$FrmG?>','<?=$IdL?>'); return false;"><?=$ico?></a></td>
		</tr>
		<?
		$iG++;
	}
	?>
	<? if ($iG==1) {?>
	<tr height="20">
		<td colspan="7" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<? } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="4">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
