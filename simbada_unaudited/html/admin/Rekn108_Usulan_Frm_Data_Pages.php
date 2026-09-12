<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$rPgE = $PgE/500;

$PaG=1;
$DataPerPage = 500;
$JumNiLL = 0;
$JumData = 0;
if ($gREF){
	$JumNiLL = fGlobalNEW("IfNull(count(*),0)","ta_permohonan_repla_rek_aset_rinci","referensi",$gREF,"=","",DatabaseSB,$ConSB,"");
	$JumData = fGlobalNEW("count(*)","ta_permohonan_repla_rek_aset_rinci","Referensi",$gREF,"=","",DatabaseSB,$ConSB,"");
	if ($JumData>$DataPerPage)
	{
		$PaG = ceil($JumData/$DataPerPage);
	}
}
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:100%">
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
		<a href="#" onclick="RefreshDATA('<?=$IdL?>','<?=($iA*$DataPerPage)?>');return false;" <?=$iK?>><?=($iA+1)?></a>
	<? }
	?>
	</div>
	<? } ?>
	</td>
    <td width="110">Total (<i>record</i>) :</td>
    <td width="100" style="text-align:right; padding-right:20px"><?=fConvertToRupiahBulat($JumNiLL)?> record</td>
  </tr>
</table>