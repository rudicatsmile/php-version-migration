<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
if ($gUPB=="ALL"){
	if ($gSUB=="ALL"){
		$gUPB = $gUNT."%";
	}
	else{
		$gUPB = $gSUB."%";
	}
}
else{
	$gUPB = $gUPB;
}
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (P1.Referensi LIKE '%$gFnD%' OR P1.Uraian LIKE '%$FnD%' OR P1.Nom_SP3D LIKE '%$FnD%' OR P5.Kd_UPB LIKE '%$FnD%' OR P5.Nm_UPB LIKE '%$FnD%')";
}
if ($gJNS=='AA') {$gJNS="%";}
if ($gSES=='AA') {$gSES="%";}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="330px" style="border:0px">
<?
$iG=1;
$tJmL= 0;
$nSQ = "SELECT P1.IDT, P1.Tgl_SP3D, P1.Referensi, P1.Nom_SP3D, P3.Nm_Unit, P4.Nm_Sub, P5.Nm_UPB, P2.Deskripsi, P1.Uraian, P1.Nilai, P6.Deskripsi as NmJns, P2.Kode as KdSE, P6.Kode as KdJN 
FROM ta_sp3d P1 
LEFT JOIN ref_session P2 ON P2.Kode=P1.KdSesi 
LEFT JOIN ref_unit P3 ON P3.Kd_Unit=Left(P1.Kd_UPB,11) 
LEFT JOIN ref_sub_unit P4 ON P4.Kd_Sub=Left(P1.Kd_UPB,14) 
LEFT JOIN ref_upb P5 ON P5.Kd_UPB=P1.Kd_UPB 
LEFT JOIN ref_sp3d_jenis P6 ON P6.Kode=P1.KdJenis 
WHERE P1.Kd_UPB LIKE '$gUPB' AND P1.Tahun='$gTH' AND P1.KdJenis LIKE '$gJNS' AND P1.KdSesi LIKE '$gSES' $CrT ORDER BY P1.Referensi LIMIT 0,500";
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
	#$mRo9 = $mRo[9];
	$mRo10= $mRo[10];
	$mRo9 = fGlobal("IfNull(sum(Nilai),0)","ta_sp3d_rinci","Referensi:Kd_ReknP90",$mRo[2].":5%","=:LIKE","","");
	$mRo11= fGlobal("IfNull(sum(Total),0)","ta_sp3d_spj_rinci","Referensi_SP3B",$mRo[2],"=","","");
	
	if ($mRo9=='Y') {$WgT="normal";} else {$WgT="normal";}
	$gJmL = 0;//fGlobal("Ifnull(sum(nilai_akhir),0)","ta_usulan_rinci_108","Referensi",$mRo2,"=","","");
	$gCnT = 0;//fGlobal("IfNull(count(*),0)","ta_usulan_rinci_108","Referensi",$mRo2,"=","","");
	$gCnB = 0;//fGlobal("IfNull(count(*),0)","ta_usulan_verifikasi_rinci_108","Ref_Usulan:Eksekusi",$mRo2.":Sudah","=:=","","");
	#echo $gCnT.":".$gCnB."<br>";
	if ($gCnT > $gCnB && $gCnB!=0){
		$rIco="edie";
		$rCap="<font style='color:#0000ff'><i>Executed</i></font>";
		$rEdi="Edit";
		$rDel="delt";
		$rCek="NoDelS";
	}
	else if ($gCnT==$gCnB && $gCnT!=0){
		$rIco="edie";
		$rCap="<font style='color:#ff0000'><i>Executed</i></font>";
		$rEdi="Edit";
		$rDel="delt";
		$rCek="NoDelA";
	}
	else{
		$rIco="edit";
		$rDel="dele";
		$rCap="-";
		$rCek="";
		$rEdi="Edit";
	}
	
	$fL = "";
	if ($mRo11<$mRo9){
		$fL = "; color:#0000FF";
	}
	else if ($mRo11>$mRo9){
		$fL = "; color:#FF0000";
	}
	
	$tJmL = $tJmL + $mRo9;
	$tJmS = $tJmS + $mRo11;
	$DeL  = "";
	
	$Lock = fGlobal($mRo10,"ta_sp3d_lock","Kd_UPB:Tahun",$gUPB.":".$gTH,"=:=","","");
	if ($Lock=='N')
	{
		#Lock by tahap selanjutnya
		$Lock = fGlobal("IDT","ta_sp3d","Kd_UPB:Tahun:KdJenis:KdSesi",$gUPB.":".$gTH.":".$mRo['KdJN'].":".$mRo['KdSE'],"=:=:=:>","IDT LIMIT 0,1","");
		if ($Lock){$Lock='Y';}
	}
	if ($Lock=='Y'){
		$rDel="delt";
	}
	?>
	<tr height="32"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="110" <?=$gBG?> style="border-bottom:1px #999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo2?></td>
	  <td width="70" <?=$gBG?> style="border-bottom:1px #999 dotted; border-left:1px #ccc solid; text-align:center"><?=fConvertDateShort($mRo1)?></td>
	  <td width="140" <?=$gBG?> style="border-bottom:1px #999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo3?></td>
	  <td width="210" <?=$gBG?> style="border-bottom:1px #999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:5px"> <?="UPB -> ".$mRo6?></td>
	  <td width="60" style="border-bottom:1px #999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:5px" <?=$gBG?>><?=$mRo10?></td>
	  <td width="50" <?=$gBG?> style="border-bottom:1px #999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid"><?=$mRo7?></td>
	  <td width="240" style="border-bottom:1px #999 dotted; border-left:1px #ccc solid; padding-left:5px" <?=$gBG?>><?=$mRo8?></td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right"><?=fConvertToRupiah($mRo9)?></td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right <?=$fL?>"><?=fConvertToRupiah($mRo11)?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999 dotted; border-left:1px #ccc solid; text-align:center">
	  <a href="#" onClick="showEDIT('<?=$gIdT?>','<?=$IdL?>'); return false" class="ico <?=$rIco?>"><?=$rEdi?></a>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="<?="SP3D_SPJ_Frm.php?FrmG=DANA BOS -> FORM INPUT SPJ&IdT=".$gIdT."&IdL=".$IdL?>" class="ico spj">Kapitalisasi</a>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="showDELE('<?=$Lock?>','<?=$gIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico <?=$rDel?>">Del</a>	  </td>
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
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="7">T O T A L</td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid">&nbsp;</td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmL)?></td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmS)?></td>
  <td style="border-left:1px #ccc solid">&nbsp;</td>
  </tr>
<? }else{ ?>
<tr height="100%">
 <td colspan="12" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
