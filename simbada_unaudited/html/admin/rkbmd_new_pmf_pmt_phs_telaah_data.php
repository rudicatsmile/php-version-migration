<?
require('Connection.php');
require('FileFunction.php');

extract($_GET);
echo $Frm;
if ($gUnT=="ALL"){$gUnT="%";}
$FnD = str_replace('**',' ',$gFnD);

$CrT = "";
if ($FnD)
{
	$CrT ="AND (referensi LIKE '%$gFnD%' OR uraian LIKE '%$FnD%')";
}
if ($gTHN=='AA') {$gTHN="____";}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="385px" style="border:0px">
<?

$iG=1;
$tJmL= 0;

$nSQ = "SELECT idt, referensi, tahun, kd_unit, uraian, nomor 
FROM ta_rkbmd_new_pmf_pmt_phs 
WHERE Kd_Unit LIKE '$gUnT%' AND Tahun LIKE '$gTHN' $CrT ORDER BY referensi DESC, idt DESC LIMIT 0,500";
echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$IdT  = $mRo[0];
	$mRo1 = $mRo[1];
	$mRo2 = $mRo[2];
	$mRo3 = $mRo[3];
	$mRo4 = $mRo[4];
	$Link = $mRo[6];
	$rIco="edit";
	$rCap="-";
	$rCek="";
	$rEdi="TELAAH";
	$gJmB = 0;//fGlobal("IfNull(sum(Usulan_Jumlah),0)","ta_rkbmd_new_rekening","Referensi:Apbd",$mRo1.":".$gUBH,"=:=","","");
	$gJmM = 0;//fGlobal("IfNull(sum(Maksimum_Jumlah),0)","ta_rkbmd_new_rekening","Referensi:Apbd",$mRo1.":".$gUBH,"=:=","","");
	$gJmO = 0;//fGlobal("IfNull(sum(Optimalisasi_Jumlah),0)","ta_rkbmd_new_rekening","Referensi:Apbd",$mRo1.":".$gUBH,"=:=","","");
	$gJmD = 0;//fGlobal("IfNull(sum(Jumlah_Yg_Disetujui),0)","ta_rkbmd_new_rekening","Referensi:Apbd",$mRo1.":".$gUBH,"=:=","","");
	$tJmA = 0;//$tJmA + $gJmA;
	
	$tJmB = $tJmB + $gJmB;
	$tJmM = $tJmM + $gJmM;
	$tJmO = $tJmO + $gJmO;
	$tJmD = $tJmD + $gJmD;
	
	$stLOCK = "";//fGlobalNEW("pengadaanBMD","ta_unit_lock","kdUnit:tahunBMD:periodeBMD",$mRo3.":".$mRo2.":".$gUBH,"=:=:=","",DatabaseSB,$ConSB,"");
	$rDel="dele";
	if ($stLOCK=='1'){
	   $rDel="delt";
	}
	if ($Link=='Ya'){
	   $rDel="delt";
	}
	#if ($gUBH=='0'){
	#	$eCeK = fGlobal("IDT","ta_rkbmd_new_pmf_pmt_phs","Referensi",$mRo1.":1","=:=","","");
	#	if ($eCeK!=''){
	#	   $rDel="delt";
	#	}
	#}
	
	?>
	<tr height="22"> 
	  <td valign="top" width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td valign="top" width="120" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=$mRo1?></td>
	  <td valign="top" width="75" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=$mRo2." - ".$mRo[5]?></td>
	  <td valign="top" width="80" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=$mRo3?></td>
	  <td valign="top" width="300" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:3px; font-weight:<?=$WgT?>" <?=$gBG?>><?=fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo3,0,11),"=","","")?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid; font-weight:<?=$WgT?>"><?=$mRo4?></td>
	  <td valign="top" width="80" <?=$gBG?>  style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=fConvertToRupiahBulat($gJmB)?></td>
	  <td valign="top" width="80" <?=$gBG?>  style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=fConvertToRupiahBulat($gJmM)?></td>
	  <td valign="top" width="80" <?=$gBG?>  style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=fConvertToRupiahBulat($gJmO)?></td>
	  <td valign="top" width="80" <?=$gBG?>  style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=fConvertToRupiahBulat($gJmD)?></td>
	  <td valign="top" width="160" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>">
	  <a href="#" onclick="P_Dokumen('<?=$IdT?>','800','400','<?=$IdL?>'); return false" class="ico prev">&nbsp;DOK</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="showEDIT('<?=$Frm?>','<?=$IdT?>','<?=$IdL?>'); return false" class="ico <?=$rIco?>"><?=$rEdi?></a>&nbsp;&nbsp;&nbsp;
	  <!--a href="#" onClick="showDELE('<?=$IdT?>','<?=$stLOCK?>','<?=$Link?>','<?=$eCeK?>','<?=$IdL?>'); return false" class="ico <?=$rDel?>">DELETE</a--></td>
    </tr>
	<?
	$iG++;
}
?>
<? if ($iG>1) {?>
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
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 </tr>
<tr height="20">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="6">TOTAL ITEM</td>
  <td style="text-align:center; font-weight:bold; border-left:1px #ccc solid"><?=fConvertToRupiahBulat($tJmB)?></td>
  <td style="text-align:center; font-weight:bold; border-left:1px #ccc solid"><?=fConvertToRupiahBulat($tJmM)?></td>
  <td style="text-align:center; font-weight:bold; border-left:1px #ccc solid"><?=fConvertToRupiahBulat($tJmO)?></td>
  <td style="text-align:center; font-weight:bold; border-left:1px #ccc solid"><?=fConvertToRupiahBulat($tJmD)?></td>
  <td style="text-align:center; font-weight:bold; border-left:1px #ccc solid">&nbsp;</td>
  </tr>
<? }else{ ?>
<tr height="100%">
 <td colspan="12" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
