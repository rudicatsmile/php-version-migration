<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
if ($gUnT=="ALL"){$gUnT="%";}

$FnD = str_replace('**',' ',$gFnD);
$gTA = $gTH."-".substr('0'.$gBL,-2,2)."-".substr('0'.$gHR,-2,2);
$gTB = $gTHd."-".substr('0'.$gBLd,-2,2)."-".substr('0'.$gHRd,-2,2);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (Referensi LIKE '%$gFnD%' OR Uraian LIKE '%$FnD%' OR Nomor LIKE '%$FnD%' OR Dokumen_Nom LIKE '%$FnD%')";
}
if ($gJNS=='AA') {$gJNS="__";}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="385px" style="border:0px">
<?php
$iG=1;
$tJmL= 0;
$nSQ = "SELECT IDT, Tanggal, Referensi, Nomor, Kd_Unit, Dokumen_Nom, Dokumen_Tgl, OpenRec  
FROM ta_permohonan_repla_rek_aset 
WHERE Kd_Unit LIKE '$gUnT%' AND (Tanggal BETWEEN '$gTA' AND '$gTB') $CrT ORDER BY Tanggal DESC, IDT DESC";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$gIDT = $mRo[0];
	$mRo1 = $mRo[1];
	$mRo2 = $mRo[2];
	$mRo3 = $mRo[3];
	$mRo4 = $mRo[4];
	$mRo5 = $mRo[5];
	$mRo6 = $mRo[6];
	$mRo7 = $mRo[7];
	
	if ($mRo7=='Y') {$WgT="normal";} else {$WgT="bold";}
	
	$gCnT = fGlobal("IfNull(count(*),0)","ta_permohonan_repla_rek_aset_rinci","Referensi",$mRo2,"=","","");
	$gCnB = fGlobal("IfNull(count(*),0)","ta_permohonan_repla_rek_aset_rinci","Referensi:Status",$mRo2.":Sudah","=:=","","");
	if ($gCnT==$gCnB && $gCnT!=0){
		$rIco="oke";
		$rCap="Executed";
	}
	else{
		$rIco="edit";
		$rCap="Execute";
	}
	$tJmL = $tJmL + $gCnT;
	$DeL  = "";
	?>
	<tr height="22"> 
	  <td valign="top" width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td valign="top" width="70" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=fConvertDateShort($mRo1)?></td>
	  <td valign="top" width="120" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=$mRo2?></td>
	  <td valign="top" width="120" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=$mRo3?></td>
	  <td valign="top" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:3px; font-weight:<?=$WgT?>" <?=$gBG?>><?=fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo4,0,11),"=","","")?></td>
	  <td valign="top" width="150" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:4px; font-weight:<?=$WgT?>" <?=$gBG?>><?=$mRo5?></td>
	  <td valign="top" width="70" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?php if (substr($mRo6,0,4)!='0000') {echo fConvertDateShort($mRo6);}?></td>
	  <td valign="top" width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=fConvertToRupiahBulat($gCnT)?> item</td>
	  <td valign="top" width="5" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; font-weight:<?=$WgT?>">&nbsp;</td>
	  <td valign="top" width="80" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center; font-weight:<?=$WgT?>">
	  <a href="#" onClick="showFORM('','0','<?=$gIDT?>','<?=$IdL?>'); return false" class="ico edit">Verifikasi</a></td>
      <td valign="top" width="80" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>">
	  <a href="#" onClick="showEXEC('<?=$mRo7?>','0','<?=$gIDT?>','<?=$IdL?>'); return false" class="ico <?=$rIco?>"><?=$rCap?></a></td>
	</tr>
	<?php
	$iG++;
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
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
</tr>
<tr height="20">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="7">T O T A L</td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmL)?></td>
  <td style="border-left:1px #ccc solid"></td>
  <td></td>
  <td></td>
</tr>
<?php }else{ ?>
<tr height="100%">
 <td colspan="12" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
