<?
require('Connection.php');
require('Connection_Simkada.php');
require('FileFunction.php');
extract($_GET);
$FnD = str_replace('**',' ',$gFnD);
//echo $vMsT." xx<br>";
//echo $gFrm." xx<br>";
//echo $gFrm;

$CrT = "";
if ($FnD)
{
	if ($gFrm=='prog') {
		$CrT ="AND (id_program LIKE '%$gFnD%' OR nama_program LIKE '%$FnD%')";
	}
	else if ($gFrm=='kegi') {
		$CrT ="AND (id_referensi LIKE '%$gFnD%' OR nama_referensi LIKE '%$FnD%')";
	}
	else if ($gFrm=='rekn') {
		$CrT ="AND (P1.Kd_Aset LIKE '%$gFnD%' OR P1.Nm_Aset LIKE '%$FnD%')";
	}
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="325" border="0">
	<?
	$iG=1;
	if ($gFrm=='prog') {
		$SkP = fGlobalNEW("Kd_Unit_Link","ref_unit","kd_unit",$gUNT,"=","",DatabaseSB,$ConSB,"");
		CallConnection(DatabaseSA,$ConSA);
		$nSQ = "SELECT id_program, nama_program FROM program WHERE id_satker LIKE '_.__.$SkP' $CrT GROUP BY id_program";
		$wK=90;
		$IdT = $IdT;
	}
	elseif ($gFrm=='kegi') {
		$IdP = fGlobalNEW("Kd_Program","ta_rkpbmd_new_program","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		CallConnection(DatabaseSA,$ConSA);
		if ((int)substr($IdP,-2,2)>=15){
			$IdPL = substr($IdP,0,4);
		}
		else{
			$IdPL = "x.xx";
		}
		$nSQ = "SELECT id_kegiatan, nama_kegiatan FROM kegiatan WHERE id_kegiatan LIKE '$IdP.%' $CrT GROUP BY id_kegiatan";
		$nSQ = "SELECT id_referensi, nama_referensi FROM referensi_kegiatan WHERE id_referensi LIKE '".$IdPL.".%.".substr($IdP,-2,2).".__' $CrT GROUP BY id_referensi";
		$wK=110;
		$IdT = $rIdT;
	}
	elseif ($gFrm=='rekn') {
		$nSQ = "SELECT P1.Kd_Aset, P1.Nm_Aset, P2.Nm_Aset, P3.Nm_Aset, P4.Nm_Aset 
		FROM ref_rek_aset5 P1 
		LEFT JOIN ref_rek_aset2 P2 ON P2.Kd_Aset=Left(P1.Kd_Aset,5)
		LEFT JOIN ref_rek_aset3 P3 ON P3.Kd_Aset=Left(P1.Kd_Aset,8)
		LEFT JOIN ref_rek_aset4 P4 ON P4.Kd_Aset=Left(P1.Kd_Aset,11)
		WHERE P1.Kd_Aset LIKE '$vMsT%' AND P1.nm_aset NOT LIKE '%???%' AND P1.Kd_Aset NOT LIKE '07.%' $CrT ORDER BY P1.Kd_Aset LIMIT 0,100";
		$wK=90;
		$IdT = $rIdT;
	}
	//echo $nSQ;
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
			$gNm.= " / ".$mRo[5];
		}
		?>
		<tr height="20" onclick="showPKRK_add('<?=$stLOCK?>','<?=$gFrm?>','<?=$gKd?>','<?=$IdT?>','<?=$IdP?>','<?=$IdL?>'); return false;">
			<td valign="top" width="10" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
			<td valign="top" width="<?=$wK?>" style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
			<td valign="top" style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><? if ($gFrm=='rekn') {echo $gNm;} else {echo strtoupper($gNm);}?></td>
			<td valign="top" width="40" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
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
