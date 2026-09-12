<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$rPgE = $PgE/50;

$PaG=1;
$DataPerPage = 50;
$JumNiLL = 0;
$JumData = 0;

$gREF = fGlobalNEW("Referensi","ta_permohonan_repla_rek_aset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
if ($gREF){
	$JumData = fGlobalNEW("count(*)","ta_permohonan_repla_rek_aset_rinci","Referensi",$gREF,"=","",DatabaseSB,$ConSB,"");
	if ($JumData>$DataPerPage)
	{
		$PaG = ceil($JumData/$DataPerPage);
	}
}
?>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:1080px; height:40px">
  <tr height="28">
    <td valign="middle">
	<?php if ($JumData>1){?>
	<div class="pagging">
	<?php
	for ($iA = 0; $iA <= $PaG-1; $iA++)
	{
	if ($iA==$rPgE){
		$iK = "style='color:#ff0000; font-weight:bold'";
	}
	else{
		$iK = "";
	}
	#function showFORM(crt,PgE,IdT,gIdL)

	?>
		<a href="#" onclick="showFORM('refr','<?=($iA*$DataPerPage)?>','<?=$IdT?>','<?=$IdL?>');return false;" <?=$iK?>><?=($iA+1)?></a>
	<?php }
	?>
	</div>
	<?php } ?>
	</td>
    <td width="110">&nbsp;</td>
    <td width="100" style="text-align:right; padding-right:20px">&nbsp;</td>
  </tr>
</table>