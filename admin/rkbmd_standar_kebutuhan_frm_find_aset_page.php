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
	$CrT ="AND (Kd_Aset LIKE '%$FnD%' OR Nm_Aset LIKE '%$FnD%')";
}

$iG=1;

$nSQ = "SELECT count(*) FROM ref_rek_aset108_7 WHERE Kd_Aset LIKE '".$gAsT."%' $CrT";
#echo $nSQ;
$nRs = mysql_query($nSQ);
$mRo = mysql_fetch_array($nRs);
$JumData = $mRo[0];

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
		<a href="#" onclick="showASET('find','<?=($iA*$DataPerPage)?>','<?=$IdT?>','<?=$IdL?>');return false;" <?=$iK?>><?=($iA+1)?></a>
	<?php }
	?>
	</div>
	<?php } ?>	</td>
  </tr>
</table>
