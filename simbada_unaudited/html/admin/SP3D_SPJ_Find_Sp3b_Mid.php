<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$FnD = str_replace('**',' ',$FnD);
#echo $gUPB;
#return false;

#$mSKP= substr(fGlobal("Kd_UPB","ta_usulan_rinci_108","IDT",$gID,"=","",""),0,11);

$CrT = "";
if ($FnD)
{
	$CrT ="AND (P1.Referensi LIKE '%$FnD%' OR P1.Nom_SP3D LIKE '%$FnD%' OR P1.Uraian LIKE '%$FnD%' OR P1.Nilai LIKE '%$FnD%')";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="100%" border="0">
	<?
	$iG=1;
	$nSQ = "SELECT P1.IDT as A0, P1.Referensi as A1, P1.Tgl_SP3D as A2, P1.Nom_SP3D as A3, P1.Uraian as A4, P1.Nilai as A5, P3.Deskripsi as A6, P2.Deskripsi as A7 
	FROM ta_sp3d P1 
	LEFT JOIN ref_session P2 ON P2.Kode=P1.KdSesi 
	LEFT JOIN ref_sp3d_jenis P3 ON P3.Kode=P1.KdJenis 
	WHERE P1.Kd_UPB='".$gUPB."' $CrT ORDER BY P1.Tahun DESC, P1.Referensi ASC";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$BG  = fBackCLR($iG);
		
		$mRo5= fGlobal("IfNull(sum(Nilai),0)","ta_sp3d_rinci","Referensi:Kd_ReknP90",$mRo[1].":5%","=:LIKE","","");
		$tSPJ= fGlobal("IfNull(sum(Total),0)","ta_sp3d_spj_rinci","Referensi_SP3B:Kd_ReknP90",$mRo[1].":5%","=:LIKE","","");
		
		$cLa = "";
		$cLb = "";
		if ($tSPJ<$mRo5){
			$cLa = "; color:#0000FF";
			$cLb = "";
		}
		else if ($tSPJ>$mRo5){
			$cLa = "";
			$cLb = "; color:#FF0000";
		}
		$mRo4 = "<b>BOS ".$mRo[6].", ".$mRo[7]."</b>";
		if ($mRo4!=''){
			$mRo4.= "<br><i>".$mRo[4]."</i>";
		}
		?>
		<!--tr height="28" onclick="choiseFIND('<?=$gFrm?>','tran','<?=$gID?>','<?=$gKd?>','<?=$gNm?>','<?=$IdL?>'); return false;"-->
		<tr height="28">
			<td width="110" style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; text-align:center" <?=$BG?>><?=$mRo[1]?></td>
			<td width="80" style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; text-align:center" <?=$BG?>><?=fConvertDateShort($mRo[2])?></td>
			<td width="140" style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; padding-left:3px" <?=$BG?>><?=$mRo[3]?></td>
			<td width="260" style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; padding-left:3px" <?=$BG?>><?=$mRo4?></td>
			<td width="100" style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; text-align:right; padding-right:3px <?=$cLa?>" <?=$BG?>><?=fConvertToRupiah($mRo5)?></td>
			<td width="100" style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; text-align:right; padding-right:3px <?=$cLb?>" <?=$BG?>><?=fConvertToRupiah($tSPJ)?></td>
			<td class="ac" style="border-bottom:1px dotted #ccc" <?=$BG?>><a href="<?="SP3D_SPJ_Frm.php?FrmG=DANA BOS -> FORM INPUT SPJ&IdT=".$IdT."&IdL=".$IdL?>" class="ico edit">Add</a></td>
		</tr>
		<?
		$iG++;
	}
	?>
	<? if ($iG==1) {?>
	<tr height="20">
		<td width="110" style="border-right:1px solid #ccc">&nbsp;</td>
		<td width="80" style="border-right:1px solid #ccc">&nbsp;</td>
		<td width="143" style="border-right:1px solid #ccc">&nbsp;</td>
		<td width="263" style="border-right:1px solid #ccc; text-align:center">Data tidak ditemukan..!!</td>
		<td width="103" style="border-right:1px solid #ccc">&nbsp;</td>
		<td width="103" style="border-right:1px solid #ccc">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<? } ?>
	<tr height="100%">
		<td width="110" style="border-right:1px solid #ccc">&nbsp;</td>
		<td width="80" style="border-right:1px solid #ccc">&nbsp;</td>
		<td width="143" style="border-right:1px solid #ccc">&nbsp;</td>
		<td width="263" style="border-right:1px solid #ccc">&nbsp;</td>
		<td width="103" style="border-right:1px solid #ccc">&nbsp;</td>
		<td width="103" style="border-right:1px solid #ccc">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
