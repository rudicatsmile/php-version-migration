<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="300px">
<?php
$UnT = fGlobal("Kd_Unit","ta_permohonan_repla_rek_aset","Referensi",$gREF,"=","","");

$iG=$PgE+1;
$tJmL=0;

$nSQ = "SELECT IDT, Kd_Rekening_17, Kd_Rekening_108, CheckList 
FROM ta_permohonan_repla_rek_aset_rinci 
WHERE Referensi='".$gREF."' ORDER BY IDT LIMIT $PgE,500";
$nRs = mysql_query($nSQ);
#echo $nSQ;
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$gIDT = $mRo[0];
	$mRo1 = $mRo[1];
	$mRo2 = $mRo[2];
	$mCek = $mRo[3];
	
	$nX = (int)substr($mRo1,0,2);
	$gNmA = fGlobal("Nm_Aset","ref_rek_aset5","Kd_Aset",$mRo1,"=","","");
	$gCnT = fGlobal("IfNull(count(*),0)","ta_kib_".fNmHuruf($nX),"Kd_Aset:Kd_UPB",$mRo1.":".$UnT."%","=:LIKE","","");
	
	$gNmB = "-";
	if ($mRo2){
		$gNmB = fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$mRo2,"=","","");
	}
	
	$eCek="";
	if ($mCek=="Y"){
		$eCek="checked";
	}
	?>
	<tr height="22"> 
	  <td valign="top" width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td valign="top" width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo1?></td>
	  <td valign="top" width="300" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:3px" <?=$gBG?>><?=$gNmA?></td>
	  <td valign="top" width="70" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$gCnT?> Item</td>
	  <td valign="top" width="30" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><a href="#" class="ico prev" onclick="P_Rinci('800','400','<?=$gREF?>','<?=$UnT?>','<?=$mRo1?>','<?=$_GET['IdL']?>'); return false;"></a></td>
	  <td valign="top" width="105" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo2?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid"><?=$gNmB?></td>
	  <td valign="top" width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center; border-left:1px #ccc solid">&nbsp;</td>
	  <td valign="top" width="82" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid">
	  <label><input type="checkbox" name="check<?=$gIDT?>" value="ON" <?=$eCek?> />Proses</label></td>
	</tr>
	<?php
	$iG++;
	$tJmL = $tJmL +$gCnT;
}
?>
<?php if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
</tr>
<tr height="20">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="3">
    TOTAL ASET</td>
  <td colspan="2" style="text-align:center; font-weight:bold; border-left:1px #ccc solid"><?=fConvertToRupiahBulat($tJmL)?> Item</td>
  <td style="text-align:right; font-weight:bold; border-left:1px #ccc solid">&nbsp;</td>
  <td style="text-align:right; font-weight:bold; border-left:1px #ccc solid">&nbsp;</td>
  <td style="border-left:1px #ccc solid"></td>
  <td colspan="3"></td>
</tr>
<?php }else{ ?>
<tr height="100%">
 <td colspan="10" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
