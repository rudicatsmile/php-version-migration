<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$FnD = str_replace('**',' ',$gFnD);

$CrT = "";
if ($FnD)
{
	$CrT ="AND (P1.Kd_Rek LIKE '%$gFnD%' OR P1.Nm_Rek LIKE '%$FnD%')"; 
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="280px" style="border:0px">
<?
$iG=1;
$nSQ = "SELECT P1.IDT, P1.Kd_Rek, P1.Nm_Rek, P2.Kd_Rek_13 as A3, P3.Nm_Rek as A4 
FROM ref_rek_90_6 P1 

LEFT JOIN ref_rek_90_6_mapping_13 P2 ON P2.Kd_Rek_90=P1.Kd_Rek 
LEFT JOIN ref_rek_5 P3 ON P3.Kd_Rek=P2.Kd_Rek_13 

WHERE P1.Kd_Rek LIKE '".$KdR5."%' $CrT ORDER BY P1.Kd_Rek";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$eIdT = $mRo[0];
	$eKdR = $mRo[1];
	$rCek = "";
	?>
	<tr height="25"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td width="420" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[2]?></td>
	  <td width="500" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[3]." : ".$mRo[4]?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <a href="#" onClick="editDATA('6','','<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="deleteDATA('6','<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico dell">&nbsp;Delete</a>&nbsp;&nbsp;	  </td>
    </tr>
	<?
	$iG++;
}
?>
<? if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
</tr>
<? }else{ ?>
<tr height="100%">
 <td colspan="6" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
<script languange="javascript">
$("#fFnD").focus();
</script>