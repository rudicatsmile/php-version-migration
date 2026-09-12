<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$rPgE = $PgE/200;

$FnD = str_replace('**',' ',$gFnD);
$SyT = "";
if ($FnD){
	$SyT = " AND (Ref_Aset LIKE '%".$FnD."%' OR Kd_Aset LIKE '%".$FnD."%' OR No_Register LIKE '%".$FnD."%' OR Nm_Aset LIKE '%".$FnD."%' OR Uraian LIKE '%".$FnD."%' OR Harga LIKE '%".$FnD."%' OR Nilai_Akhir LIKE '%".$FnD."%')";
}

$PaG=1;
$DataPerPage = 200;
$JumNiLL = 0;
$JumData = 0;
if ($gREF){
	if ($SyT!='')
	{
		$nSQ = "SELECT IfNull(sum(nilai_akhir),0) as JmLA, count(*) as JmlB
		FROM ta_usulan_rinci_108 WHERE Referensi='$gREF' $SyT";
		$nRs = mysql_query($nSQ);
		$mRo = mysql_fetch_array($nRs);
		$JumNiLL = $mRo[0];
		$JumData = $mRo[1];
	}
	else 
	{
		$JumNiLL = fGlobalNEW("IfNull(sum(nilai_akhir),0)","ta_usulan_rinci_108","referensi",$gREF,"=","",DatabaseSB,$ConSB,"");
		$JumData = fGlobalNEW("count(*)","ta_usulan_rinci_108","Referensi",$gREF,"=","",DatabaseSB,$ConSB,"");
	}
	
	if ($JumData>$DataPerPage)
	{
		$PaG = ceil($JumData/$DataPerPage);
	}
}
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:100%">
  <tr height="28">
    <td valign="top">
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
	<?php } ?>	</td>
    <td width="110" valign="top">Total (<i>Nilai Akhir</i>) :<br>
      Total (<i>Item</i>) :</td>
    <td width="100" valign="top" style="text-align:right; padding-right:20px"><?=fConvertToRupiahBulat($JumNiLL)?><br><?=fConvertToRupiahBulat($JumData)?></td>
  </tr>
</table>
