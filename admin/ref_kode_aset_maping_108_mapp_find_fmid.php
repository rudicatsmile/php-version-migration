<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

#echo $eKD;

if ($eKD=='' || $eKD=='1.3'){
	$sYT = "P1.kd_aset LIKE '1.3%'";
}
else 
{
	if ($eKD=='1.5'){
		$sYT = "P1.kd_aset LIKE '1.5%'";
	}
	else if ($eKD=='ALL'){
		$sYT = "(P1.kd_aset LIKE '1.3%' OR P1.kd_aset LIKE '1.5%')";
	}
}

$SyT = "";
if ($TxFnD){
	$TxFnD = str_replace('**',' ',$TxFnD);
	$SyT = "AND (P1.kd_aset LIKE '%".$TxFnD."%' OR P1.nm_aset LIKE '%".$TxFnD."%')";
}
?>
<table align='center' border='0' width='100%' class='table-listpop' cellspacing='0' cellpadding='0' height='100%' style='border-collapse:collapse'>
<?php
$nSQ = "SELECT P1.kd_aset as A0, 
P1.kd_aset as A1, P1.nm_aset as A2, 
P2.kd_aset as A3, P2.nm_aset as A4, 
P3.kd_aset as A5, P3.nm_aset as A6,
P4.kd_aset as A7, P4.nm_aset as A8,
P5.kd_aset as A9, P5.nm_aset as A10,
P6.kd_aset as A11, P6.nm_aset as A12 
FROM ref_rek_aset108_7 P1 

LEFT JOIN ref_rek_aset108_6 P2 ON P2.kd_aset=left(P1.kd_aset,14)
LEFT JOIN ref_rek_aset108_5 P3 ON P3.kd_aset=left(P1.kd_aset,11)
LEFT JOIN ref_rek_aset108_4 P4 ON P4.kd_aset=left(P1.kd_aset,8)
LEFT JOIN ref_rek_aset108_3 P5 ON P5.kd_aset=left(P1.kd_aset,5)
LEFT JOIN ref_rek_aset108_2 P6 ON P6.kd_aset=left(P1.kd_aset,3) 

WHERE $sYT $SyT ORDER BY P1.kd_aset LIMIT 0,500";
$wid = 120;

#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$x1 = $mRo[1];
	$x2 = $mRo[2];
	$x3 = $mRo[3];
	$x4 = $mRo[4];
	$x5 = $mRo[5];
	$x6 = $mRo[6];
	$x7 = $mRo[7];
	$x8 = $mRo[8];
	$x9 = $mRo[9];
	$x10 = $mRo[10];
	$x11 = $mRo[11];
	$x12 = $mRo[12];
	$xB = "";
	eShow($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$nmDiv,$IdL,$xB);
}
?>
<tr height='100%'>
  <td style='width:120px; border-right:1px #ccc solid; border-bottom:0px #ccc dotted; text-align:center'>&nbsp;</td>
  <td style="border-right:1px #ccc solid; border-bottom:0px #ccc dotted; border-left:0px #ccc solid; text-align:center">&nbsp;</td>
  <td style="border-right:1px #ccc solid; width:230px; border-bottom:0px #ccc dotted; border-left:0px #ccc solid; text-align:center">&nbsp;</td>
  <td style="width:150px; border-bottom:0px #ccc dotted; border-left:0px #ccc solid; text-align:center">&nbsp;</td>
</tr>
</table>
<?php

function eShow($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$nmDiv,$IdL,$xB)
{
	$eClR = "";
	if (substr($x1,0,3)=="1.5"){
		$eClR = "; color:#990000";
	}
?>
	<tr height="24" style="cursor:pointer" onclick="showGlobalPopupClickSearch('<?=$x1?>','<?=$x2?>','<?=$x3?>','<?=$x4?>','<?=$x5?>','<?=$x6?>','<?=$x7?>','<?=$x8?>','<?=$x9?>','<?=$x10?>','<?=$x11?>','<?=$x12?>','<?=$nmDiv?>','<?=$IdL?>')">
	  <td style="border-right:1px #ccc solid; border-bottom:1px #ccc dotted; text-align:center; <?=$eClR?>"><?=$x1?></td>
	  <td style="border-right:1px #ccc solid; border-bottom:1px #ccc dotted; border-left:0px #ccc solid; padding-left:5px; <?=$eClR?>"><?=$x2?></td>
	  <td style="border-right:1px #ccc solid; border-bottom:1px #ccc dotted; border-left:0px #ccc solid; padding-left:5px; font-size:8pt; <?=$eClR?>"><?=$x4?></td>
	  <td style="border-right:1px #ccc solid; border-bottom:1px #ccc dotted; border-left:0px #ccc solid; padding-left:5px; font-size:8pt; <?=$eClR?>"><?=$x6?></td>
	</tr>
<?php
}

?>

