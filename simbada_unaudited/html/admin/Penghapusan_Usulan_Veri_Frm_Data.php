<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
if ($gUnT=="ALL"){$gUnT="%";}

$FnD = str_replace('**',' ',$gFnD);
$gTA = $gTH."-".substr('0'.$gBL,-2,2)."-".substr('0'.$gHR,-2,2);
$gTB = $gTHd."-".substr('0'.$gBLd,-2,2)."-".substr('0'.$gHRd,-2,2);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (P1.Referensi LIKE '%$gFnD%' OR P1.Uraian LIKE '%$FnD%' OR P1.Nomor LIKE '%$FnD%' OR P1.Dokumen_Nom LIKE '%$FnD%')";
}
if ($gJNS=='AA') {$gJNS="__";}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="385px" style="border:0px">
<?
$iG=1;
$tJmL= 0;
$nSQ = "SELECT P1.IDT,P1.Tanggal,P1.Referensi,P1.Nomor,P1.Kd_UPB,P1.Dokumen_Nom,P1.Dokumen_Tgl,P2.Kode,P2.Deskripsi,P1.OpenRec  
FROM ta_usulan_108 P1 LEFT JOIN ref_usulan_jenis P2 ON P2.Kode=P1.Jenis 
WHERE P1.Kd_UPB LIKE '$gUnT%' AND (P1.Tanggal BETWEEN '$gTA' AND '$gTB') AND P1.Jenis LIKE '$gJNS' $CrT ORDER BY P1.Tanggal DESC,P1.IDT DESC";
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
	$mRo8 = $mRo[8];
	$mRo9 = $mRo[9];
	
	if ($mRo9=='Y') {$WgT="normal";} else {$WgT="bold";}
	$gJmL = fGlobal("Ifnull(sum(Nilai_Akhir),0)","ta_usulan_rinci_108","Referensi",$mRo2,"=","","");
	$gCnT = fGlobal("IfNull(count(*),0)","ta_usulan_rinci_108","Referensi",$mRo2,"=","","");
	$gCnB = fGlobal("IfNull(count(*),0)","ta_usulan_verifikasi_rinci_108","Ref_Usulan:Eksekusi",$mRo2.":Sudah","=:=","","");
	if ($gCnT==$gCnB && $gCnT!=0){
		$rIco="oke";
		$rCap="EXECUTED";
	}
	else{
		$rIco="edit";
		$rCap="EXECUTE";
	}
	$tJmL = $tJmL + $gJmL;
	$DeL  = "";
	?>
	<tr height="26"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="70" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=fConvertDateShort($mRo1)?></td>
	  <td width="120" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=$mRo2?></td>
	  <td width="120" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=$mRo3?></td>
	  <td width="300" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:3px; font-weight:<?=$WgT?>" <?=$gBG?>><?=fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo4,0,11),"=","","")?></td>
	  <td width="150" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:4px; font-weight:<?=$WgT?>" <?=$gBG?>><?=$mRo5?></td>
	  <td width="70" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><? if (substr($mRo6,0,4)!='0000') {echo fConvertDateShort($mRo6);}?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid; font-weight:<?=$WgT?>"><?=$mRo7." -> ".$mRo8?></td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right; font-weight:<?=$WgT?>"><?=fConvertToRupiah($gJmL)?></td>
	  <td width="5" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; font-weight:<?=$WgT?>">&nbsp;</td>
	  <td width="80" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center; font-weight:<?=$WgT?>">
	  <a href="#" onClick="showFORM('<?=$ReO?>','','0','<?=$gIDT?>','<?=$IdL?>'); return false" class="ico edit">Verifikasi</a></td>
      <td width="80" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>">
	  <a href="#" onClick="showEXEC('<?=$ReO?>','<?=$mRo7?>','0','<?=$gIDT?>','<?=$IdL?>'); return false" class="ico <?=$rIco?>"><?=$rCap?></a></td>
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
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
</tr>
<tr height="20">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="8">T O T A L</td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmL)?></td>
  <td style="border-left:1px #ccc solid"></td>
  <td></td>
  <td></td>
</tr>
<? }else{ ?>
<tr height="100%">
 <td colspan="13" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
