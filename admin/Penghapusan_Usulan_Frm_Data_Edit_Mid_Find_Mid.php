<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$FnD = str_replace('**',' ',$gFnD);
$mSKP= substr(fGlobal("Kd_UPB","ta_usulan_rinci_108","IDT",$gID,"=","",""),0,11);
$mReF= fGlobal("Referensi","ta_usulan_rinci_108","IDT",$gID,"=","","");
$mJeN= fGlobal("Jenis","ta_usulan_108","Referensi",$mReF,"=","","");

$CrT = "";
if ($FnD)
{
	if ($gFrm=='alas') {
		$CrT ="AND (Kode LIKE '%$gFnD%' OR Deskripsi LIKE '%$FnD%')";
	}
	else if ($gFrm=='kib') {
		$CrT ="WHERE (Kd_Aset LIKE '%$gFnD%' OR Nm_Aset LIKE '%$FnD%')";
	}
	else if ($gFrm=='rekn') {
		if ($rMsT=='fObJ') {
			$CrT ="AND (P1.Kd_Aset LIKE '%$gFnD%' OR P1.Nm_Aset LIKE '%$FnD%' OR P2.Nm_Aset LIKE '%$FnD%' OR P3.Nm_Aset LIKE '%$FnD%' OR P4.Nm_Aset LIKE '%$FnD%')";
		} else {
			$CrT ="AND (Kd_Aset LIKE '%$gFnD%' OR Nm_Aset LIKE '%$FnD%')";
		}
	}
	else if ($gFrm=='skpd') {
		if ($rMsT=='') 
		{
			if ($mJeN=="MS"){
				$CrT ="WHERE Kd_Unit <> '".$mSKP."' AND (Kd_Unit LIKE '%$gFnD%' OR Nm_Unit LIKE '%$FnD%')";
			}
			else{
				$CrT ="WHERE (Kd_Unit LIKE '%$gFnD%' OR Nm_Unit LIKE '%$FnD%')";
			}
		} 
		else if ($rMsT=='fUnT') 
		{
			$CrT ="AND (Kd_Sub LIKE '%$gFnD%' OR Nm_Sub LIKE '%$FnD%')";
		} 
		else if ($rMsT=='fSuB') 
		{
			$CrT ="AND (Kd_UPB LIKE '%$gFnD%' OR Nm_UPB LIKE '%$FnD%')";
		}
	}
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="290" border="0">
	<?php
	$iG=1;
	if ($gFrm=='alas') {
		$nSQ = "SELECT Kode, Deskripsi FROM ref_usulan_jenis_rinci WHERE Kode LIKE '$gJN%' $CrT ORDER BY Kode";
		$wK=50;
	}
	elseif ($gFrm=='kib') {
		$NoT = substr(fGlobal("Kd_Aset","ta_usulan_rinci_108","IDT",$gID,"=","",""),0,5);
		if ($gJN=='TW'){
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset NOT LIKE '$NoT%' AND Kd_Aset NOT LIKE '1.3.6%' $CrT ORDER BY Kd_Aset";
		}
		else{
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset NOT LIKE '$NoT%' AND Kd_Aset NOT LIKE '1.3.6%' AND Kd_Aset NOT LIKE '1.3.7%' $CrT ORDER BY Kd_Aset";
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset NOT LIKE '1.5%' AND Kd_Aset NOT LIKE '1.3.6%' AND Kd_Aset NOT LIKE '1.3.7%' $CrT ORDER BY Kd_Aset";
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset NOT LIKE '1.5%' AND Kd_Aset NOT LIKE '1.3.7%' $CrT ORDER BY Kd_Aset";
		}
		$wK=30;
		#echo $nSQ." ddd";
	}
	elseif ($gFrm=='rekn') {
		$LiK = fGlobal("KIB_To","ta_usulan_rinci_108","IDT",$gID,"=","","");
		if ($vMsT=='') {$vMsT=$LiK;}
		
		if ($rMsT=='fKIBb') {
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '$LiK%' $CrT ORDER BY Kd_Aset";
			$wK=40;
		}
		else if ($rMsT=='fBiD') {
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '$vMsT%' $CrT ORDER BY Kd_Aset";
			$wK=50;
		}
		else if ($rMsT=='fKeL') {
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '$vMsT%' $CrT ORDER BY Kd_Aset";
			$wK=80;
		}
		else if ($rMsT=='fJeN') {
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '$vMsT%' $CrT ORDER BY Kd_Aset";
			$wK=90;
		}
		else if ($rMsT=='fObJ') {
			$nSQ = "SELECT P1.Kd_Aset, P1.Nm_Aset, P2.Nm_Aset, P3.Nm_Aset, P4.Nm_Aset, P5.Nm_Aset 
			FROM ref_rek_aset108_7 P1 
			LEFT JOIN ref_rek_aset108_3 P2 ON P2.Kd_Aset=Left(P1.Kd_Aset,5)
			LEFT JOIN ref_rek_aset108_4 P3 ON P3.Kd_Aset=Left(P1.Kd_Aset,8)
			LEFT JOIN ref_rek_aset108_5 P4 ON P4.Kd_Aset=Left(P1.Kd_Aset,11)
			LEFT JOIN ref_rek_aset108_6 P5 ON P5.Kd_Aset=Left(P1.Kd_Aset,13)
			WHERE P1.Kd_Aset LIKE '$vMsT%' $CrT ORDER BY P1.Kd_Aset LIMIT 0,100";
			$wK=100;
		}
	}
	elseif ($gFrm=='skpd') {
		if ($rMsT=='fUnT') {
			$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '$vMsT%' $CrT ORDER BY Kd_Sub";
			$wK=90;
		}
		else if ($rMsT=='fSuB') {
			$nSQ = "SELECT Kd_UPB, Nm_UPB FROM ref_upb WHERE Kd_UPB LIKE '$vMsT%' $CrT ORDER BY Kd_UPB";
			$wK=120;
		}
		else {
			$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit $CrT ORDER BY Kd_Unit";
			$wK=70;
		}
	}
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKd = $mRo[0];
		$gNm = $mRo[1];
		if ($rMsT=='fObJx') {
			$gNm = "<b>".strtoupper($gNm)."</b>";
			$gNm.= "<i><br>".$mRo[2];
			$gNm.= " / ".$mRo[3];
			$gNm.= " / ".$mRo[4];
			$gNm.= " / ".$mRo[5];
		}
		?>
		<tr height="18" onclick="choiseFIND('<?=$gFrm?>','alas','<?=$gID?>','<?=$gKd?>','<?=$gNm?>','<?=$IdL?>'); return false;">
			<td valign="top" width="10" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
			<td valign="top" width="<?=$wK?>" style="border-bottom:1px dotted #CCCCCC"><?=$gKd?></td>
			<td valign="top" style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?=$gNm?></td>
			<td valign="top" width="40" style="border-bottom:1px dotted #CCCCCC">&nbsp;</td>
		</tr>
		<?php
		$iG++;
	}
	?>
		<tr height="18" onclick="choiseFIND('<?=$gFrm?>','alas','<?=$gID?>','','','<?=$IdL?>'); return false;">
			<td colspan="4" valign="top" style="text-align:center; border-bottom:1px dotted #CCCCCC; padding-right:15px"><a href="#" class="ico dele">Kosongkan</a></td>
		</tr>
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
