<?php
require('Connection.php');
require('FileFunction.php');

extract($_GET);
$FnD = ReplaceTextPHP($FnD);
$SyT = "";
if ($FnD)
{
	$SyT = "AND (kdUnit LIKE '%".$FnD."%' OR idSubUnit LIKE '%".$FnD."%' OR nmSubUnit LIKE '%".$FnD."%')";
}
$iG=1;
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="340px" style="font-family:calibri; font-size:9pt; border:0px">
<?php
$nSQ="SELECT kdUnit as A0, nmOPD as A1, idSubUnit as A2, nmSubUnit as A3, sum(fnJumlah) as A4 
FROM ta_apbd_rekening_skpd 
WHERE periode='$ThN' AND apbd='$ApB' $SyT GROUP BY idSubUnit";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	?>
	<tr height="28"> 
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[0]?></td>
	  <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px" <?=$gBG?>><?=$mRo[1]?></td>
	  <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo[2]?></td>
	  <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px" <?=$gBG?>><?=$mRo[3]?></td>
	  <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:right; padding-right:3px" <?=$gBG?>><?=fConvertToRupiah($mRo[4])?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <input type="text" name="fnEW" id="fnEW" placeholder='XX.XX.XX.XX' onkeypress="if (event.keyCode==13){P_Edit(this,'<?=$mRo[2]?>','','<?=$IdL?>');return false;}" style="width:80px; text-align:center" /></td>
	</tr>
	<?php
	$iG++;
	$rToT = $rToT+$mRo[4];
}
?>
<?php if ($iG>1) {?>
<tr height="25px">
 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; text-align:right; padding-right:3px; font-weight:bold">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; text-align:right; padding-right:3px; font-weight:bold">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; text-align:right; padding-right:3px; font-weight:bold">T O T A L</td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; text-align:right; padding-right:3px; font-weight:bold"><?=fConvertToRupiah($rToT)?></td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
</tr>
<tr height="100%">
 <td width="30" style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td width="80" style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td width="340" style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td width="130" style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td width="340" style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td width="130" style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
</tr>
<?php }else{ ?>
<tr height="100%">
 <td colspan="7" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
