<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$rPgE = $PgE/50;

$PaG=1;
$DataPerPage = 100;
$JumNiLL = 0;
$JumData = 0;
if ($gREF){
	#FROM ta_rkbmd_standar_kebutuhan_rinci p1 
	#WHERE p1.Referensi='$gREF' ORDER BY p1.IDT LIMIT $PgE,100";

	$JumNiLL = 0;//fGlobalNEW("IfNull(sum(nilai_perolehan),0)","ta_rkbmd_standar_kebutuhan_rinci","referensi",$gREF,"=","",DatabaseSB,$ConSB,"");
	$JumData = fGlobalNEW("count(*)","ta_rkbmd_standar_kebutuhan_rinci","Referensi",$gREF,"=","",DatabaseSB,$ConSB,"");
	if ($JumData>$DataPerPage)
	{
		$PaG = ceil($JumData/$DataPerPage);
	}
}
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:100%">
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
	?>
		<a href="#" onclick="RefreshDATA('<?=$IdL?>','<?=($iA*$DataPerPage)?>');return false;" <?=$iK?>><?=($iA+1)?></a>
	<?php }
	?>
	</div>
	<?php } ?>
	</td>
    <td width="110">Total (<i>Nilai Akhir</i>) :</td>
    <td width="100" style="text-align:right; padding-right:20px"><?=fConvertToRupiahBulat($JumNiLL)?></td>
  </tr>
</table>