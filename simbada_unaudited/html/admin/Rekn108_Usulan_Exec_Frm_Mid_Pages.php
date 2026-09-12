<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$PaG=1;
$DataPerPage = 50;
$JumNiLL = 0;
$JumData = 0;
$rPgE = $PgE/$DataPerPage;

$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (Kd_Rekening_17 LIKE '%$FnD%' OR Kd_Rekening_108 LIKE '%$FnD%')";
}

$gREF = fGlobalNEW("Referensi","ta_permohonan_repla_rek_aset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
if ($gREF){
	if ($FnD)
	{
		$nSQ = "SELECT IfNull(count(*),0) as JmlB 
		FROM ta_permohonan_repla_rek_aset_rinci 
		WHERE Referensi='$gREF'".$CrT;
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$JumData = $mRo[0];
		}
	}
	else{
		$JumData = fGlobalNEW("count(*)","ta_permohonan_repla_rek_aset_rinci","Referensi",$gREF,"=","",DatabaseSB,$ConSB,"");
	}
	if ($JumData>$DataPerPage)
	{
		$PaG = ceil($JumData/$DataPerPage);
	}
}
?>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:1080px; height:40px">
  <tr height="28">
    <td valign="middle">
	<? if ($JumData>1){?>
	<div class="pagging">
	<?
	for ($iA = 0; $iA <= $PaG-1; $iA++)
	{
	if ($iA==$rPgE){
		$iK = "style='color:#ff0000; font-weight:bold'";
	}
	else{
		$iK = "";
	}
	?>
		<a href="#" onclick="showEXEC_RefR('','<?=($iA*$DataPerPage)?>','<?=$IdT?>','<?=$IdL?>');return false;" <?=$iK?>><?=($iA+1)?></a>
	<? }
	?>
	</div>
	<? } ?>
	</td>
    <td width="110">&nbsp;</td>
    <td width="100" style="text-align:right; padding-right:20px">&nbsp;</td>
  </tr>
</table>