<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

echo "<table align='center' border='0' width='100%' class='table-listpop' cellspacing='0' cellpadding='0' height='100%' style='border-collapse:collapse'>";
if ($Lev=='kelo'){
	$nSQ = "SELECT kd_aset, nm_aset FROM ref_rek_aset108_2 WHERE kd_aset LIKE '$BidE%' ORDER BY kd_aset";
	$wid = 40;
}
else if ($Lev=='jeni'){
	$nSQ = "SELECT kd_aset, nm_aset FROM ref_rek_aset108_3 WHERE kd_aset LIKE '$KelE%' ORDER BY kd_aset";
	$wid = 60;
}
else if ($Lev=='obje'){
	$nSQ = "SELECT kd_aset, nm_aset FROM ref_rek_aset108_4 WHERE kd_aset LIKE '$JenE%' ORDER BY kd_aset";
	$wid = 80;
}
else if ($Lev=='rinc'){
	$nSQ = "SELECT kd_aset, nm_aset FROM ref_rek_aset108_5 WHERE kd_aset LIKE '$ObjE%' ORDER BY kd_aset";
	$wid = 100;
}
else if ($Lev=='sub1'){
	$nSQ = "SELECT kd_aset, nm_aset FROM ref_rek_aset108_6 WHERE kd_aset LIKE '$RinE%' ORDER BY kd_aset";
	$wid = 110;
}
else if ($Lev=='sub2'){
	$nSQ = "SELECT kd_aset, nm_aset FROM ref_rek_aset108_7 WHERE kd_aset LIKE '$Su1E%' ORDER BY kd_aset";
	$wid = 120;
}
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$x1 = $mRo[0];
	$x2 = $mRo[1];
	$xB = "";
	eShow($x1,$x2,$Lev,$nmDiv,$IdL,$xB);
}
?>
<tr height='100%'>
  <td style='width:<?=$wid?>px; border-bottom:0px #ccc dotted; text-align:center'>&nbsp;</td>
  <td style="border-bottom:0px #ccc dotted; border-left:0px #ccc solid; text-align:center">&nbsp;</td>
</tr>
</table>
<?php

function eShow($x1,$x2,$Lev,$nmDiv,$IdL,$xB)
{
?>
	<?php if ($Lev=="search"){?>
	<tr height="22" style="cursor:pointer" onclick="fCariDATA('CrT','gMS','gSB','gUP')">
	<?php } else{?>
	<tr height="22" style="cursor:pointer" onclick="showGlobalPopupClickMapi('<?=$x1?>','<?=$x2?>','<?=$Lev?>','<?=$nmDiv?>','<?=$IdL?>')">
	<?php } ?>
	  <td style="border-bottom:1px #ccc dotted; text-align:center"><?=$x1?></td>
	  <td style="border-bottom:1px #ccc dotted; border-left:0px #ccc solid; padding-left:5px"><?=$x2?></td>
	</tr>
<?php
}

?>

