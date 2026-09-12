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
	$CrT ="AND (P1.Referensi LIKE '%$gFnD%' OR P1.Uraian LIKE '%$FnD%' OR P1.Nom_SP3D LIKE '%$FnD%' OR P2.Nm_ReknP90 LIKE '%$FnD%' OR P4.Nm_Aset LIKE '%$FnD%')";
}
if ($gJNS=='AA') {$gJNS="%";}
if ($gSES=='AA') {$gSES="%";}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="400px" style="border:0px">
<?
$iG=1;
$tJmL = 0;
$tJmA = 0;

$RefA = "";
$RefB = "";
$RekA = "";
$RekB = "";

$nSQ = "SELECT P1.Nom_SP3D as A0, P1.Referensi as A1, P1.Nom_SP3D as A2, P2.Kd_ReknP90 as A3, 
P2.Nm_ReknP90 as A4, P3.Kd_ReknP108 as A5, P3.Nm_ReknP108 as A6, P4.Nm_Aset as A7,
P4.JmlSatuan as A8,
P4.Harga as A9,
P4.Total as A10,
P4.Referensi as A11,
P3.IDT as A12,
P4.IDT as A13,
P2.Nilai as A14,
P4.Aprove as A15 
FROM ta_sp3d P1 
LEFT JOIN ta_sp3d_rinci P2 ON P2.Referensi=P1.Referensi 
LEFT JOIN ta_sp3d_spj P3 ON P3.Referensi_SP3B=P1.Referensi AND P3.Kd_ReknP90=P2.Kd_ReknP90 
LEFT JOIN ta_sp3d_spj_rinci P4 ON P4.Referensi_SPJ=P3.Referensi AND P4.Kd_ReknP90=P3.Kd_ReknP90 AND P4.Kd_Aset_108=P3.Kd_ReknP108 
WHERE P1.Kd_UPB LIKE '$gUPB' AND P1.Tahun='$gTH' AND P1.KdJenis LIKE '$gJNS' AND P1.KdSesi LIKE '$gSES' AND P2.Kd_ReknP90 LIKE '5%' $CrT 
ORDER BY P1.Referensi, P2.Kd_ReknP90, P3.Kd_ReknP108, P4.Referensi LIMIT 0,500";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$rIdT = $mRo[12];
	$IdTR = $mRo[13];
	$ReKN = substr($mRo[5],0,5);
	$RefA = $mRo[1];
	$RekA = $mRo[3];
	$AstA = $mRo[5];
	$rNiL = $mRo[14];
	$mRoAS= fGlobal("IfNull(sum(Total),0)","ta_sp3d_spj_rinci","Referensi_SP3B:Kd_ReknP90",$RefA.":".$RekA,"=:=","","");
	
	$eCL = "";
	if ($mRoAS > $rNiL){
		$eCL = "; color:#FF0000";
	}
	
	$rEdi = "edit";
	$rDel = "dele";
	$tJmL = $tJmL + $mRo[10];
	$tJmS = $tJmS + $mRo[8];
	
	$fL = "";
	$DeL  = "";
	$rCek = "";
	
	if ($ReKN=='1.3.1'){
		$fL = "A";
	}
	else if ($ReKN=='1.3.2'){
		$fL = "B";
	}
	else if ($ReKN=='1.3.3'){
		$fL = "C";
	}
	else if ($ReKN=='1.3.4'){
		$fL = "D";
	}
	else if ($ReKN=='1.3.5'){
		$fL = "E";
	}
	else if ($ReKN=='1.3.6'){
		$fL = "F";
	}
	
	$eF = "Aprove";
	$iC = "edit";
	if ($mRo[15]=='aproved'){
		$eF = "Aproved";
		$iC = "oke";
	}
	if ($mRo[15]=='ditolak'){
		$eF = "Ditolak";
		$iC = "dele";
	}
	?>
	<? if ($RefB!=$RefA && $iG>1) {?>
	<tr height="20" style="background:#e5fdc0">
	 <td style="border-bottom:1px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
	 <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
	 <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
	 <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
	 <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
	 <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
	 <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
	 <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
	 <td style="border-bottom:1px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
	 <td style="border-bottom:1px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
	 <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
	</tr>
	<? } ?>
	
	<tr height="35"> 
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:0px #ccc solid; text-align:center"><? if ($RefB!=$RefA) {echo $mRo[1]."<br>".$mRo[0];}?></td>
	  <td width="230" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:3px" title="Nilai Kapitalisi : <?=fConvertToRupiah($mRoAS)?>" <?=$gBG?>><? if ($RekB!=$RekA) {echo "<font style='font-weight:bold'>".$mRo[4]."</font><br>".$mRo[3]." ( <font style='cursor:pointer ".$eCL."'>Rp. ".fConvertToRupiah($rNiL)." </font>)";}?></td>
	  <td width="230" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:3px" <?=$gBG?>><? if ($AstB!=$AstA) {echo $mRo[6]."<br>".$mRo[5];}?></td>
	  <td width="230" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px;"><?=$mRo[7]?></td>
	  <td width="50" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center <?=$eCL?>"><?=$mRo[8]?></td>
	  <td width="90" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:right; padding-right:3px <?=$eCL?>"><? if ($mRo[11]!=''){echo fConvertToRupiah($mRo[9]);}?></td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:right; padding-right:3px <?=$eCL?>"><? if ($mRo[11]!=''){echo fConvertToRupiah($mRo[10]);}?></td>
	  <td width="58" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>>
	  <? if ($AstB!=$AstA){?>
	  <a href="#" onClick="showSPJ('','<?=$rIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico docu">&nbsp;Berkas</a>
	  <? } ?>	  </td>
      <td width="70" style="border-bottom:1px #999999 dotted; border-left:0px #ccc solid; text-align:center" <?=$gBG?>>
	  <a href="#" onClick="showASET('','<?=$rIdT?>','<?=$IdTR?>','<?=$rCek?>','<?=$fL?>','<?=$IdL?>'); return false" class="ico reff">Kapitalisasi</a>	  </td>
      <td width="60" style="border-bottom:1px #999999 dotted; border-left:0px #ccc solid; text-align:center" <?=$gBG?>>
	  <? if ($AstB!=$AstA){?>
	  <a href="#" onClick="showUPLOAD('','<?=$rIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico img">&nbsp;&nbsp;Upload</a>
	  <? } ?>	  </td>
      <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <a href="#" onClick="showAPROVE('','<?=$rIdT?>','<?=$IdTR?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico <?=$iC?>"><?=$eF?></a>	  </td>
	</tr>
	<?
	$RefB = $RefA;
	$RekB = $RekA;
	$AstB = $AstA;
	$iG++;
}

?>
<? if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
</tr>
<tr height="20">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="4">T O T A L</td>
  <td style="text-align:center; font-weight:bold; padding-right:3px; border-left:1px #ccc solid "><?=fConvertToRupiahBulat($tJmS)?></td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid">&nbsp;</td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmL)?></td>
  <td colspan="3" style="border-left:1px #ccc solid; ">&nbsp;</td>
  <td style="border-left:1px #ccc solid; ">&nbsp;</td>
</tr>
<? }else{ ?>
<tr height="100%">
 <td colspan="12" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
<script languange="javascript">
$("#fFnD").focus();
</script>