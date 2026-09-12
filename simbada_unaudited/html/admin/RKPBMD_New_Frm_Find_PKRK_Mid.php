<?
require('Connection.php');
//require('Connection_SimRAL.php');
require('FileFunction.php');
extract($_GET);
$FnD = str_replace('**',' ',$gFnD);

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
	}
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="325" border="0">
	<?
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
				$gNm.= "<br><i>".$mRo[2];
				$gNm.= " / ".$mRo[3];
				$gNm.= " / ".$mRo[4];
				#$gNm.= " / ".$mRo[5];
			}
			?>
			<tr height="<?=$hE?>" onclick="showPKRK_add('<?=$stLOCK?>','<?=$gFrm?>','<?=$gKd?>','<?=$IdT?>','<?=$IdP?>','<?=$IdL?>'); return false;">
				<td width="10" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
				<td width="<?=$wK?>" style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
				<td style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><? if ($gFrm=='rekn') {echo $gNm;} else {echo strtoupper($gNm);}?></td>
				<td width="40" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
			</tr>
			<?
			$iG++;
		}
	}
	?>
	
	<?
	if ($gFrm=='prog') {
		$IdS = fGlobalNEW("kd_unit","ta_rkpbmd_new","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
		#$nSQ = "SELECT idProgram, nmProgram FROM ta_apbd_program_skpd WHERE kdUnit='".$IdS."' $CrT GROUP BY idProgram";
		$nSQ = "SELECT Kode, Deskripsi FROM ref_keg_90_3 WHERE Kode LIKE '_.__.__' AND Kode NOT LIKE 'X.__.__' $CrT ORDER BY Kode";
		$hE=30;
		$wK=90;
		$IdT = $IdT;
	}
	elseif ($gFrm=='kegi') {
		#$IdS = fGlobalNEW("kd_unit","ta_rkpbmd_new_program","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$IdP = fGlobalNEW("kd_program","ta_rkpbmd_new_program","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		#$nSQ = "SELECT idKegiatan, nmKegiatan FROM ta_apbd_kegiatan_skpd WHERE kdUnit='".$IdS."' AND idProgram ='".$IdP."' $CrT GROUP BY idKegiatan";
		$nSQ = "SELECT Kode, Deskripsi FROM ref_keg_90_4 WHERE Kode LIKE '".$IdP."%' $CrT ORDER BY Kode";
		
		$hE=30;
		$wK=100;
		$IdT = $rIdT;
	}
	elseif ($gFrm=='subk') {
		#$IdS = fGlobalNEW("kd_unit","ta_rkpbmd_new_kegiatan","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$IdP = fGlobalNEW("kd_kegiatan","ta_rkpbmd_new_kegiatan","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		#$nSQ = "SELECT idSubKegiatan, nmSubKegiatan FROM ta_apbd_kegiatan_sub_skpd WHERE kdUnit='".$IdS."' AND idKegiatan ='".$IdP."' $CrT GROUP BY idSubKegiatan";
		$nSQ = "SELECT Kode, Deskripsi FROM ref_keg_90_5 WHERE Kode LIKE '".$IdP."%' $CrT ORDER BY Kode";
		
		$hE=30;
		$wK=100;
		$IdT = $rIdT;
	}
	elseif ($gFrm=='rekn') {
		$IdS = fGlobalNEW("Kd_Unit","ta_rkpbmd_new_kegiatan_sub","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		
		$nSQ = "SELECT P1.Kd_Aset, P1.Nm_Aset, P2.Nm_Aset, P3.Nm_Aset, P4.Nm_Aset 
		FROM ref_rek_aset108_7 P1 
		LEFT JOIN ref_rek_aset108_4 P2 ON P2.Kd_Aset=Left(P1.Kd_Aset,8)
		LEFT JOIN ref_rek_aset108_5 P3 ON P3.Kd_Aset=Left(P1.Kd_Aset,11)
		LEFT JOIN ref_rek_aset108_6 P4 ON P4.Kd_Aset=Left(P1.Kd_Aset,14)
		LEFT JOIN ta_kib_108 ON P5.Kd_Aset_108=P1.Kd_Aset 
		WHERE P5.Kd_UPB LIKE '".$IdS."%' AND P1.Kd_Aset LIKE '$vMsT%' $CrT ORDER BY P1.Kd_Aset LIMIT 0,300";
		
		$nSQ = "SELECT P1.Kd_Aset, P1.Nm_Aset, P2.Nm_Aset, P3.Nm_Aset, P4.Nm_Aset 
		FROM ref_rek_aset108_7 P1 
		LEFT JOIN ref_rek_aset108_4 P2 ON P2.Kd_Aset=Left(P1.Kd_Aset,8)
		LEFT JOIN ref_rek_aset108_5 P3 ON P3.Kd_Aset=Left(P1.Kd_Aset,11)
		LEFT JOIN ref_rek_aset108_6 P4 ON P4.Kd_Aset=Left(P1.Kd_Aset,14)
		WHERE P1.Kd_Aset LIKE '$vMsT%' $CrT ORDER BY P1.Kd_Aset LIMIT 0,300";
		#echo $nSQ."xx";
		
		$hE=45;
		$wK=120;
		$IdT = $rIdT;
	}
	
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKd = $mRo[0];
		$gNm = $mRo[1];
		if ($gFrm=='rekn') {
			$gNm = "<b>".strtoupper($gNm)."</b>";
			$gNm.= "<br><i>".$mRo[2];
			$gNm.= " / ".$mRo[3];
			$gNm.= " / ".$mRo[4];
			#$gNm.= " / ".$mRo[5];
		}
		?>
		<tr height="<?=$hE?>" onclick="showPKRK_add('<?=$stLOCK?>','<?=$gFrm?>','<?=$gKd?>','<?=$IdT?>','<?=$IdP?>','<?=$IdL?>'); return false;">
			<td width="10" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
			<td width="<?=$wK?>" style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
			<td style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><? if ($gFrm=='rekn') {echo $gNm;} else {echo strtoupper($gNm);}?></td>
			<td width="40" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
		</tr>
		<?
		$iG++;
	}
	?>
	<? if ($iG==1) {?>
	<tr height="20">
		<td colspan="4" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<? } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
