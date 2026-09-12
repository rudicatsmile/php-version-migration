<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$PaG=1;
$DataPerPage = $gLST;	#200;
$JumNiLL = 0;
$JumData = 0;
$rPgE = $PgE/$DataPerPage;

if ($gAsT=='All'){$gAsT="%";}
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";

if ($FnD)
{
	$CrT ="AND (Kd_Aset_108 LIKE '%$FnD%' OR Nm_Aset LIKE '%$FnD%')";
}

$iG=1;

$nSQ = "SELECT count(*) FROM ta_kib_108 WHERE Kd_Aset_108 = '".$KdA."' AND Kd_UPB LIKE '".$SkD."%' $CrT GROUP BY Referensi, Ref_Group";
$nRs = mysql_query($nSQ);
$mRo = mysql_num_rows($nRs);
$JumData = $mRo;

if ($JumData>$DataPerPage)
{
	$PaG = ceil($JumData/$DataPerPage);
}
?>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:100%; height:40px">
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
		<a href="#" onclick="LoadASET('find','<?=($iA*$DataPerPage)?>','<?=$SkD?>','<?=$KdA?>','<?=$IdL?>');return false;" <?=$iK?>><?=($iA+1)?></a>
	<?php }
	?>
	</div>
	<?php } ?>	</td>
  </tr>
</table>
