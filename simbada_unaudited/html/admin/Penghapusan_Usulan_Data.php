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
$nSQ = "SELECT P1.IDT,
P1.Tanggal,
P1.Referensi,
P1.Nomor,
P1.Kd_UPB,
P1.Dokumen_Nom,
P1.Dokumen_Tgl,
P2.Kode,
P2.Deskripsi,
P1.OpenRec,
P1.Uraian 
FROM ta_usulan_108 P1 
LEFT JOIN ref_usulan_jenis P2 ON P2.Kode=P1.Jenis 
WHERE P1.Kd_UPB LIKE '$gUnT%' AND (P1.Tanggal BETWEEN '$gTA' AND '$gTB') AND P1.Tanggal NOT LIKE '%2019%' AND P1.Jenis LIKE '$gJNS' $CrT ORDER BY P1.Tanggal DESC,P1.IDT DESC LIMIT 0,500";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$gIdT = $mRo[0];
	$mRo1 = $mRo[1];
	$mRo2 = $mRo[2];
	$mRo3 = $mRo[3];
	$mRo4 = $mRo[4];
	$mRo5 = $mRo[5];
	$mRo6 = $mRo[6];
	$mRo7 = $mRo[7];
	$mRo8 = $mRo[8];
	$mRo9 = $mRo[9];
	$mRo10= $mRo[10];
	
	if ($mRo9=='Y') {$WgT="normal";} else {$WgT="bold";}
	$gJmL = fGlobal("Ifnull(sum(nilai_akhir),0)","ta_usulan_rinci_108","Referensi",$mRo2,"=","","");
	$gCnT = fGlobal("IfNull(count(*),0)","ta_usulan_rinci_108","Referensi",$mRo2,"=","","");
	$gCnB = fGlobal("IfNull(count(*),0)","ta_usulan_verifikasi_rinci_108","Ref_Usulan:Eksekusi",$mRo2.":Sudah","=:=","","");
	#echo $gCnT.":".$gCnB."<br>";
	if ($gCnT > $gCnB && $gCnB!=0){
		$rIco="edie";
		$rCap="<font style='color:#0000ff'><i>Executed</i></font>";
		$rEdi="EDIT";
		$rDel="delt";
		$rCek="NoDelS";
	}
	else if ($gCnT==$gCnB && $gCnT!=0){
		$rIco="edie";
		$rCap="<font style='color:#ff0000'><i>Executed</i></font>";
		$rEdi="EDIT";
		$rDel="delt";
		$rCek="NoDelA";
	}
	else{
		$rIco="edit";
		$rDel="dele";
		$rCap="-";
		$rCek="";
		$rEdi="EDIT";
	}
	$tJmL = $tJmL + $gJmL;
	$DeL  = "";
	?>
	<tr height="22"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><a href="#" onClick="showDELEAll('<?=$FrmG?>','<?=$gIdT?>','<?=$rCek?>','<?=$IdL?>'); return false"><?=$iG?>.</a></td>
	  <td width="70" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=fConvertDateShort($mRo1)?></td>
	  <td width="120" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=$mRo2?><br><?=$mRo3?></td>
	  <td width="220" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:3px; font-weight:<?=$WgT?>" <?=$gBG?>><?=fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo4,0,11),"=","","")?></td>
	  <td width="200" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:4px; font-weight:<?=$WgT?>" <?=$gBG?>><?=$mRo5?></td>
	  <td width="70" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><? if (substr($mRo6,0,4)!='0000') {echo fConvertDateShort($mRo6);}?></td>
	  <td width="270" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid; font-weight:<?=$WgT?>"><?=$mRo7." -> ".$mRo8."<br><font style='font-style:italic; font-weight:normal; color:#0000FF'>".$mRo10."</font>"?></td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right; font-weight:<?=$WgT?>"><?=fConvertToRupiah($gJmL)?></td>
	  <td width="5" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; font-weight:<?=$WgT?>">&nbsp;</td>
	  <td width="160" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center; font-weight:<?=$WgT?>">
	  <a href="#" onClick="showEDIT('<?=$FrmG?>','<?=$gIdT?>','<?=$IdL?>'); return false" class="ico <?=$rIco?>"><?=$rEdi?></a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="showDELE('<?=$FrmG?>','<?=$ReO?>','<?=$gIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico <?=$rDel?>">DELETE</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onclick="P_Dokumen('800','400','<?=$gIdT?>','<?=$IdL?>'); return false" class="ico prev">&nbsp;VIEW</a>	  </td>
      <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>">
	  <?=$rCap?></td>
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
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
</tr>
<tr height="30">
  <td style="text-align:right; font-weight:bold; padding-right:10px; border-bottom:1px #ccc solid" colspan="7">T O T A L</td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-bottom:1px #ccc solid; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmL)?></td>
  <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
  <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
  <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
</tr>
<? if ($gUnT!="%") {
	$JmLA = fGlobal("Ifnull(sum(debet),0)","ta_kib_post_108","kd_upb:referensi",$gUnT."%:TNH%","LIKE:LIKE","","");
	$JmLB = fGlobal("Ifnull(sum(debet),0)","ta_kib_post_108","kd_upb:referensi",$gUnT."%:ALT%","LIKE:LIKE","","");
	$JmLC = fGlobal("Ifnull(sum(debet),0)","ta_kib_post_108","kd_upb:referensi",$gUnT."%:BNG%","LIKE:LIKE","","");
	$JmLD = fGlobal("Ifnull(sum(debet),0)","ta_kib_post_108","kd_upb:referensi",$gUnT."%:JLN%","LIKE:LIKE","","");
	$JmLE = fGlobal("Ifnull(sum(debet),0)","ta_kib_post_108","kd_upb:referensi",$gUnT."%:ATL%","LIKE:LIKE","","");
	$JmLF = fGlobal("Ifnull(sum(debet),0)","ta_kib_post_108","kd_upb:referensi",$gUnT."%:KDP%","LIKE:LIKE","","");
	$JmLG = fGlobal("Ifnull(sum(debet),0)","ta_kib_post_108","kd_upb:referensi",$gUnT."%:KDL%","LIKE:LIKE","","");
	$JmLG+= fGlobal("Ifnull(sum(debet),0)","ta_kib_post_108","kd_upb:referensi",$gUnT."%:ATB%","LIKE:LIKE","","");
	?>
	<tr height="20">
	  <td style="" colspan="11">
	  <table align="center" border="0" width="100%" cellspacing="0" cellpadding="0" height="30px" style="border:0px">
	  <tr>
	  <td width="10">&nbsp;</td>
	  <td width="120">Acuan Total &nbsp;&nbsp;&nbsp; Kib A :</td>
	  <td width="120"><?=fConvertToRupiah($JmLA)?></td>
	  <td width="35">Kib B :</td>
	  <td width="120"><?=fConvertToRupiah($JmLB)?></td>
	  <td width="35">Kib C :</td>
	  <td width="120"><?=fConvertToRupiah($JmLC)?></td>
	  <td width="35">Kib D :</td>
	  <td width="120"><?=fConvertToRupiah($JmLD)?></td>
	  <td width="35">Kib E :</td>
	  <td width="120"><?=fConvertToRupiah($JmLE)?></td>
	  <td width="35">Kib F :</td>
	  <td width="120"><?=fConvertToRupiah($JmLF)?></td>
	  <td width="35">Kib G :</td>
	  <td><?=fConvertToRupiah($JmLG)?></td>
	  </tr>
	  </table>	  </td>
	  </tr>
<? } ?>
<? }else{ ?>
<tr height="100%">
 <td colspan="12" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
