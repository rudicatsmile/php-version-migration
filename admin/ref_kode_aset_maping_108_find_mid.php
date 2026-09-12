<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

echo "<table align='center' border='0' width='100%' class='table-listpop' cellspacing='0' cellpadding='0' height='100%' style='border-collapse:collapse'>";
if ($Lev=='bida'){
	$nSQ = "SELECT kd_aset, nm_aset FROM ref_rek_aset1 ORDER BY kd_aset";
}
else if ($Lev=='kelo'){
	$nSQ = "SELECT kd_aset, nm_aset FROM ref_rek_aset2 WHERE kd_aset LIKE '$Bid%' ORDER BY kd_aset";
}
else if ($Lev=='jeni'){
	$nSQ = "SELECT kd_aset, nm_aset FROM ref_rek_aset3 WHERE kd_aset LIKE '$Kel%' ORDER BY kd_aset";
}
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$x1 = $mRo[0];
	$x2 = strtoupper($mRo[1]);
	$xB = "";
	eShow($x1,$x2,$Lev,$nmDiv,$IdL,$xB);
}

echo "<tr height='100%'>";
echo "<td style='width:60px; border-bottom:0px #ccc dotted; text-align:center'>&nbsp;</td>
	  <td border-bottom:0px #ccc dotted; border-left:0px #ccc solid; text-align:center'>&nbsp;</td>";
echo "</tr>";
echo "</table>";


function eShow($x1,$x2,$Lev,$nmDiv,$IdL,$xB)
{
?>
	<tr height="22" style="cursor:pointer" onclick="showGlobalPopupClick('<?=$x1?>','<?=$x2?>','<?=$Lev?>','<?=$nmDiv?>','<?=$IdL?>')">
	<td style="border-bottom:1px #ccc dotted; text-align:center"><?=$x1?></td>
	<td style="border-bottom:1px #ccc dotted; border-left:0px #ccc solid; padding-left:5px"><?=$x2?></td>
	</tr>
<?php
}

?>

