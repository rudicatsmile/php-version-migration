<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

//require('Connection_SimRAL_'.$gTHN.'.php');
$FnD = str_replace('**',' ',$gFnD);
#echo "xxxxxxxxx".$gFrm;
$CrT = "";
if ($FnD)
{
	if ($gFrm=='prog') {
		#$CrT ="AND (idProgram LIKE '%$FnD%' OR nmProgram LIKE '%$FnD%')";
		$CrT ="AND (Kode LIKE '%$gFnD%' OR Deskripsi LIKE '%$FnD%')";
	}
	else if ($gFrm=='kegi') {
		#$CrT ="AND (idKegiatan LIKE '%$FnD%' OR nmKegiatan LIKE '%$FnD%')";
		$CrT ="AND (Kode LIKE '%$gFnD%' OR Deskripsi LIKE '%$FnD%')";
	}
	else if ($gFrm=='subk') {
		#$CrT ="AND (idSubKegiatan LIKE '%$FnD%' OR nmSubKegiatan LIKE '%$FnD%')";
		$CrT ="AND (Kode LIKE '%$gFnD%' OR Deskripsi LIKE '%$FnD%')";
	}
	else if ($gFrm=='rekn') {
		$CrT ="AND (P1.Kd_Aset LIKE '%$FnD%' OR P1.Nm_Aset LIKE '%$FnD%')";
		#$CrT ="AND (Kode LIKE '%$gFnD%' OR Deskripsi LIKE '%$FnD%')";
	}
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="325" border="0">
	<?php
	$iG=1;
	
	if ($gFrm=='prog') 
	{
		$nSQ = "SELECT Kode, Deskripsi FROM ref_keg_90_3 WHERE Kode LIKE 'X.__.__' ORDER BY Kode";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$gKd = $mRo[0];
			$gNm = $mRo[1];
			
			if ($gFrm=='rekn') {
				$gNm = "<b>".strtoupper($gNm)."</b>";
				$gNm.= " --> <i>".$mRo[2];
				$gNm.= " / ".$mRo[3];
				$gNm.= " / ".$mRo[4];
				//$gNm.= " / ".$mRo[5];
			}
			$gBG  = fBackCLR($iG);
			?>
			<tr height="23" onclick="showPKRK_add('<?=$stLOCK?>','<?=$gFrm?>','<?=$gKd?>','<?=$IdT?>','<?=$IdP?>','<?=$IdL?>'); return false;">
				<td width="10" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
				<td width="<?=$wK?>" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
				<td <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?php if ($gFrm=='rekn') {echo $gNm;} else {echo strtoupper($gNm);}?></td>
				<td width="40" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
			</tr>
			<?php
			$iG++;
		}
	}
	?>
	
	<?php
	if ($gFrm=='prog') {
		#$IdS = fGlobalNEW("kd_unit","ta_rkbmd_new","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
		#$nSQ = "SELECT idProgram, nmProgram FROM ta_apbd_program_skpd WHERE periode='".$tTbl."' AND kdUnit='".$IdS."' $CrT GROUP BY idProgram";
		
		#$CrT ="AND (Id_Referensi LIKE '%$gFnD%' OR Nm_Referensi LIKE '%$FnD%')";
		$nSQ = "SELECT Kode, Deskripsi FROM ref_keg_90_3 WHERE Kode LIKE '_.__.__' AND Kode NOT LIKE 'X.__.__' $CrT ORDER BY Kode";
		
		$wK=70;
		$IdT = $IdT;
	}
	elseif ($gFrm=='kegi') {
		#$IdS = fGlobalNEW("kd_unit","ta_rkbmd_new_program","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$IdP = fGlobalNEW("kd_program","ta_rkbmd_new_program","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		
		#$nSQ = "SELECT idKegiatan, nmKegiatan FROM ta_apbd_kegiatan_skpd WHERE periode='".$tTbl."' AND kdUnit='".$IdS."' AND idProgram = '".$IdP."' $CrT GROUP BY idKegiatan";
		$nSQ = "SELECT Kode, Deskripsi FROM ref_keg_90_4 WHERE Kode LIKE '".$IdP."%' $CrT ORDER BY Kode";
		
		$wK=90;
		$IdT = $rIdT;
	}
	elseif ($gFrm=='subk') {
		#$IdS = fGlobalNEW("kd_unit","ta_rkbmd_new_kegiatan","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$IdP = fGlobalNEW("kd_kegiatan","ta_rkbmd_new_kegiatan","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		#$nSQ = "SELECT idSubKegiatan, nmSubKegiatan FROM ta_apbd_kegiatan_sub_skpd WHERE periode='".$tTbl."' AND kdUnit='".$IdS."' AND idKegiatan = '".$IdP."' $CrT GROUP BY idSubKegiatan";
		$nSQ = "SELECT Kode, Deskripsi FROM ref_keg_90_5 WHERE Kode LIKE '".$IdP."%' $CrT ORDER BY Kode";
		
		$wK=120;
		$IdT = $rIdT;
	}
	elseif ($gFrm=='rekn') {
		$nSQ = "SELECT P1.Kd_Aset, P1.Nm_Aset, P2.Nm_Aset, P3.Nm_Aset, P4.Nm_Aset 
		FROM ref_rek_aset108_7 P1 
		LEFT JOIN ref_rek_aset108_4 P2 ON P2.Kd_Aset=Left(P1.Kd_Aset,8)
		LEFT JOIN ref_rek_aset108_5 P3 ON P3.Kd_Aset=Left(P1.Kd_Aset,11)
		LEFT JOIN ref_rek_aset108_6 P4 ON P4.Kd_Aset=Left(P1.Kd_Aset,14)
		WHERE P1.Kd_Aset LIKE '$vMsT%' $CrT ORDER BY P1.Kd_Aset LIMIT 0,300";
		
		$wK=110;
		$IdT = $rIdT;
	}
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKd = $mRo[0];
		$gNm = $mRo[1];
		
		if ($gFrm=='rekn') {
			$gNm = "<b>".strtoupper($gNm)."</b>";
			$gNm.= " --> <i>".$mRo[2];
			$gNm.= " / ".$mRo[3];
			$gNm.= " / ".$mRo[4];
			//$gNm.= " / ".$mRo[5];
		}
		$gBG  = fBackCLR($iG);
		?>
		<tr height="23" onclick="showPKRK_add('<?=$stLOCK?>','<?=$gFrm?>','<?=$gKd?>','<?=$IdT?>','<?=$IdP?>','<?=$IdL?>'); return false;">
			<td width="10" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
			<td width="<?=$wK?>" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
			<td <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?php if ($gFrm=='rekn') {echo $gNm;} else {echo strtoupper($gNm);}?></td>
			<td width="40" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
		</tr>
		<?php
		$iG++;
	}
	?>
	<?php if ($iG==1) {?>
	<tr height="20">
		<td colspan="4" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<?php } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
