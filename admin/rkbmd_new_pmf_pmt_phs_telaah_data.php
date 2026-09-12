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
	$CrT ="AND (p1.Referensi LIKE '%$gFnD%' OR p1.Uraian LIKE '%$FnD%')";
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="385px" style="border:0px">
<?php
$iG=1;
$tJmL= 0;
$nSQ = "SELECT p1.IDT as A0,
p1.tanggal as A1,
p1.referensi as A2,
p1.nomor as A3,
p1.tahun as A4,
p3.nm_unit as A5,
p1.uraian as A6,
sum(nilai_perolehan) as A7 
FROM ta_rkbmd_new_pmf_pmt_phs p1 
LEFT JOIN ta_rkbmd_new_pmf_pmt_phs_rinci p2 ON p2.referensi=p1.referensi 
LEFT JOIN ref_unit p3 ON p3.kd_unit=p1.kd_unit 
WHERE p1.kd_unit LIKE '$gUnT%' AND (p1.Tanggal BETWEEN '$gTA' AND '$gTB') AND p1.jenis ='$Frm' AND p1.crit='$Crit' $CrT GROUP BY p1.referensi";
#echo $nSQ;
#return false;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$IdT  = $mRo[0];
	$rCek = "";
	#$gJmL = fGlobal("Ifnull(sum(nilai_akhir),0)","ta_usulan_rinci_108","Referensi",$mRo2,"=","","");
	?>
	<tr height="40"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="70" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=fConvertDateShort($mRo[1])?></td>
	  <td width="120" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[2]?></td>
	  <td width="170" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[3]?></td>
	  <td width="50" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[4]?></td>
	  <td width="297" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:3px" <?=$gBG?>><?=$mRo[5]?></td>
	  <td width="297" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px" <?=$gBG?>><?=$mRo[6]?></td>
	  <td width="117" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:right; padding-right:3px" <?=$gBG?>><?=fConvertToRupiah($mRo[7])?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>">
	  <a href="#" onClick="showEDIT('<?=$IdT?>','<?=$Frm?>','<?=$Crit?>','<?=$IdL?>'); return false" class="ico edit">Telaah</a>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="#" onclick="P_Dokumen('800','400','<?=$IdT?>','<?=$Frm?>','<?=$Crit?>','<?=$IdL?>'); return false" class="ico prev">&nbsp;Dokumen</a>	  </td>
    </tr>
	<?php
	$iG++;
	$tJmL=$tJmL+$mRo[7];
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
 </tr>
<tr height="20">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="7">T O T A L</td>
  <td style="border-left:1px #ccc solid; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tJmL)?></td>
  <td style="border-left:1px #ccc solid"></td>
  </tr>
<?php }else{ ?>
<tr height="100%">
 <td colspan="10" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
