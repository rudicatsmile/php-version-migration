<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$PaG=1;
$DataPerPage = 500;
$JumNiLL = 0;
$JumData = 0;
$rPgE = $PgE/$DataPerPage;

$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (Ref_Aset LIKE '%$FnD%' OR Nm_Aset LIKE '%$FnD%' OR Kd_Aset LIKE '%$FnD%' OR No_Register LIKE '%$FnD%')";
}

$gREF = fGlobalNEW("Referensi","ta_usulan_108","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
if ($gREF){
	if ($FnD)
	{
		$nSQ = "SELECT IfNull(sum(nilai_akhir),0) as JmlA, IfNull(count(*),0) as JmlB 
		FROM ta_usulan_rinci_108 
		WHERE Referensi='$gREF'".$CrT;
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$JumNiLL = $mRo[0];
			$JumData = $mRo[1];
		}
	}
	else{
		$JumNiLL = fGlobalNEW("IfNull(sum(nilai_akhir),0)","ta_usulan_rinci_108","Referensi",$gREF,"=","",DatabaseSB,$ConSB,"");
		$JumData = fGlobalNEW("count(*)","ta_usulan_rinci_108","Referensi",$gREF,"=","",DatabaseSB,$ConSB,"");
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
		<a href="#" onclick="showEXEC_RefR('','<?=($iA*$DataPerPage)?>','<?=$IdT?>','<?=$IdL?>');return false;" <?=$iK?>><?=($iA+1)?></a>
	<?php }
	?>
	</div>
	<?php } ?>	</td>
    <td width="110">Total (<i>Nilai Akhir</i>) :<br>Total (<i>Item</i>) </td>
    <td width="100" style="text-align:right; padding-right:20px"><?=fConvertToRupiahBulat($JumNiLL)?><br><?=fConvertToRupiahBulat($JumData)?></td>
  </tr>
</table>
