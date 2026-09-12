<?php
require('Connection.php');
require('FileFunction.php');

#require('Connection_SimRAL_'.$gTHN.'.php');

extract($_GET);
if ($gUnT=="ALL"){$gUnT="%";}
$FnD = str_replace('**',' ',$gFnD);

$CrT = "";
if ($FnD)
{
	$CrT ="AND (Referensi LIKE '%$gFnD%' OR Uraian LIKE '%$FnD%')";
}
if ($gTHN=='AA') {$gTHN="____";}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="385px" style="border:0px">
<?php
$ExE="xYA";
if ($gTHN=='2020' && $ExE=="YA")
{
	#PROGRAM
	$nSQ = "SELECT IDT, Nm_Program FROM ta_rkbmd_new_program WHERE tahun='2020' ORDER BY IDT";
	echo $nSQ."<br>";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$NmA = $mRo[1];
		
		#SelectDBnew($DtBaB,$HostB,$PortB,$UserB,$PassB);
		#$SQ  = "SELECT kd_bidang, kd_prog FROM sikd_prog WHERE nm_prog='".$NmA."'";
		#$nR  = mysql_query($SQ);
		#$mR  = mysql_fetch_array($nR);
		#$IdP = $mR[0].".".$mR[1];
		
		#if ($IdP){
		#	SelectDBnew($DtBaA,$HostA,$PortA,$UserA,$PassA);
		#	$SQ  = "UPDATE ta_rkbmd_new_program SET kd_program	='$IdP' WHERE IDT='".$IdT."'";
		#	$nR  = mysql_query($SQ);
		#}
	}
	
	#KEGIATAN
	#SelectDBnew($DtBaA,$HostA,$PortA,$UserA,$PassA);
	$nSQ = "SELECT IDT, Nm_Kegiatan, Kd_Kegiatan FROM ta_rkbmd_new_kegiatan WHERE tahun='2020' ORDER BY IDT";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$NmB = $mRo[1];
		$KdO = $mRo[2];
		
		#SelectDBnew($DtBaB,$HostB,$PortB,$UserB,$PassB);
		#$SQ  = "SELECT kd_bidang, kd_kgtn FROM sikd_kgtn WHERE nm_kgtn='".$NmB."'";
		#$nR = mysql_query($SQ);
		#while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
		#{
		#	$kdK = $mR[0].".".$mR[1];
		#	SelectDBnew($DtBaA,$HostA,$PortA,$UserA,$PassA);
			
		#	$eSQ  = "UPDATE ta_rkbmd_new_rekening SET Kd_Kegiatan='$kdK' WHERE Kd_Kegiatan='".$KdO."' AND tahun='$gTHN'";
		#	$enR  = mysql_query($eSQ);
			
		#	$eSQ  = "UPDATE ta_rkbmd_new_kegiatan SET Kd_Kegiatan='$kdK' WHERE IDT='".$IdT."'";
		#	$enR  = mysql_query($eSQ);
		#}
	}
	######
}

$iG=1;
$tJmL= 0;
#SelectDBnew($DtBaA,$HostA,$PortA,$UserA,$PassA);

$nSQ = "SELECT IDT,Referensi,Tahun,Kd_Unit,Uraian, Apbd, LinkMurni 
FROM ta_rkbmd_new 
WHERE Kd_Unit LIKE '$gUnT%' AND Tahun LIKE '$gTHN' AND Apbd='$gUBH' $CrT ORDER BY Referensi DESC,IDT DESC LIMIT 0,500";
#echo $nSQ;
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
	$rEdi="EDIT";
	$gJmB = fGlobal("IfNull(sum(Usulan_Jumlah),0)","ta_rkbmd_new_rekening","Referensi:Apbd",$mRo1.":".$gUBH,"=:=","","");
	$gJmM = fGlobal("IfNull(sum(Maksimum_Jumlah),0)","ta_rkbmd_new_rekening","Referensi:Apbd",$mRo1.":".$gUBH,"=:=","","");
	$gJmO = fGlobal("IfNull(sum(Optimalisasi_Jumlah),0)","ta_rkbmd_new_rekening","Referensi:Apbd",$mRo1.":".$gUBH,"=:=","","");
	$tJmA = $tJmA + $gJmA;
	
	$stLOCK = fGlobalNEW("pengadaanBMD","ta_unit_lock","kdUnit:tahunBMD:periodeBMD",$mRo3.":".$mRo2.":".$gUBH,"=:=:=","",DatabaseSB,$ConSB,"");
	$rDel="dele";
	if ($stLOCK=='1'){
	   $rDel="delt";
	}
	if ($Link=='Ya'){
	   $rDel="delt";
	}
	if ($gUBH=='0'){
		$eCeK = fGlobal("IDT","ta_rkbmd_new","Referensi:Apbd",$mRo1.":1","=:=","","");
		if ($eCeK!=''){
		   $rDel="delt";
		}
	}
	
	?>
	<tr height="22"> 
	  <td valign="top" width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td valign="top" width="120" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=$mRo1?></td>
	  <td valign="top" width="75" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=$mRo2." - ".$mRo[5]?></td>
	  <td valign="top" width="80" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=$mRo3?></td>
	  <td valign="top" width="300" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:3px; font-weight:<?=$WgT?>" <?=$gBG?>><?=fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo3,0,11),"=","","")?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid; font-weight:<?=$WgT?>"><?=$mRo4?></td>
	  <td valign="top" width="90" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=fConvertToRupiahBulat($gJmB)?></td>
	  <td valign="top" width="90" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=fConvertToRupiahBulat($gJmM)?></td>
	  <td valign="top" width="90" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=fConvertToRupiahBulat($gJmO)?></td>
	  <td valign="top" width="5" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
	  <td valign="top" width="160" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center; font-weight:<?=$WgT?>">
	  <a href="#" onclick="P_Dokumen('<?=$IdT?>','<?=$gUBH?>','800','400','<?=$IdL?>'); return false" class="ico prev">&nbsp;DOK</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="showEDIT('<?=$IdT?>','<?=$IdL?>'); return false" class="ico <?=$rIco?>"><?=$rEdi?></a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="showDELE('<?=$IdT?>','<?=$stLOCK?>','<?=$Link?>','<?=$eCeK?>','<?=$IdL?>'); return false" class="ico <?=$rDel?>">DELETE</a>	  </td>
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
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 </tr>
<tr height="20">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="6">TOTAL ITEM</td>
  <td style="text-align:center; font-weight:bold; border-left:1px #ccc solid"><?=fConvertToRupiahBulat($tJmB)?></td>
  <td style="text-align:center; font-weight:bold; border-left:1px #ccc solid"><?=fConvertToRupiahBulat($tJmM)?></td>
  <td style="text-align:center; font-weight:bold; border-left:1px #ccc solid"><?=fConvertToRupiahBulat($tJmO)?></td>
  <td style="border-left:1px #ccc solid"></td>
  <td></td>
  </tr>
<?php }else{ ?>
<tr height="100%">
 <td colspan="12" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
