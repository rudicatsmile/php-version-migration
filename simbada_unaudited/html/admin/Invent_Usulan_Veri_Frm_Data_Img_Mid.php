<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
//echo $crt."<br>";
$gRF = fGlobal("Ref_Usulan","ta_usulan_verifikasi_rinci_108","IDT",$tID,"=","","");
$gRA = fGlobal("Ref_Aset","ta_usulan_verifikasi_rinci_108","IDT",$tID,"=","","");
//echo $gRF."<br>".$gRA;
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="245" border="0">
	<?
	$iG=1;
	$nSQ = "SELECT IDT, file_name, file_content, file_type, file_size FROM ta_usulan_rinci_file_108 WHERE Referensi='$gRF' AND Ref_Aset ='$gRA' AND Crit='$CrT' ORDER BY file_name";
	//echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gBG  = fBackCLR($iG);
		$rIdT= $mRo[0];
		$gNm = $mRo[1];
		$gCn = $mRo[2];
		$gTy = $mRo[3];
		
		$gSz = fConvertToRupiah($mRo[4]/1025);
		if ($CrT=='Img') {$gCL=70;} else {$gCL=20;}
		?>
		<tr height="18">
			<td valign="top" width="15" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px"><?=$iG?>.</td>
			<td valign="top" width="<?=$gCL?>" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
			<? if ($CrT=='Img') {?><img src="<?="Invent_Usulan_Frm_Data_Edit_Upl_Mid_Src.php?rIdT=".$rIdT?>" height="50" width="50" style="border:1px #999999 solid" ><? } ?>
			</td>
			<td valign="top" <?=$gBG?>style="border-bottom:1px dotted #CCCCCC; padding-top:5px; padding-bottom:5px"><?=$gNm?></td>
			<td valign="top" width="50" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; padding-right:15px; padding-top:5px; padding-bottom:5px; text-align:center"><?=$gSz?> KB</td>
			<td valign="top" width="90" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
			<a href="#" onclick="viewIMG('<?=$rIdT?>','600','400','<?=$IdL?>'); return false;" class="ico prev">View</a>
			</td>
		</tr>
		<?
		$iG++;
	}
	?>
	<? if ($iG==1) {?>
	<tr height="20">
		<td colspan="5" style="text-align:center; vertical-align:middle">Hasil upload tidak ditemukan..!!</td>
	</tr>
	<? } ?>
	<tr height="20">
		<td colspan="5" style="text-align:center">&nbsp;</td>
	</tr>
	<tr height="100%">
		<td colspan="5" style="text-align:center">&nbsp;</td>
	</tr>
</table>