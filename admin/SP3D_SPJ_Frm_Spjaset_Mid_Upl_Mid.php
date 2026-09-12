<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$gRA = fGlobal("Referensi","ta_sp3d_spj_rinci","IDT",$eIdT,"=","","");

?>
<table border="0" width="100%" height="23" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td class="ac"><a href="#" onclick="addIMG('<?=$eIdT?>','<?=$IdL?>'); return false;" class="ico add">Upload file ( <?php if ($CrT=='Pdf') {echo "PDF";} else {echo "JPG, JPEG, PNG, BMP, GIF";}?> )</a></td>
  </tr>
</table>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="245" border="0">
	<?php
	$iG=1;
	$nSQ = "SELECT IDT, file_name, file_content, file_type, file_size FROM ta_sp3d_spj_rinci_file WHERE Referensi='$gRA' ORDER BY file_name";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gBG  = fBackCLR($iG);
		$rIdT= $mRo[0];
		$gNm = $mRo[1];
		$gCn = $mRo[2];
		$gTy = $mRo[3];
		
		$gSz = fConvertToRupiah($mRo[4]/1025);
		$gCL=70;
		?>
		<tr height="18">
			<td valign="top" width="15" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px"><?=$iG?>.</td>
			<td valign="top" width="<?=$gCL?>" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
			<img src="<?="SP3D_SPJ_Frm_Spjaset_Mid_Upl_Mid_Src.php?rIdT=".$rIdT?>" height="50" width="50" style="border:1px #999999 solid" onclick="viewIMG('<?=$rIdT?>','600','400','<?=$IdL?>'); return false;">
			</td>
			<td valign="top" <?=$gBG?>style="border-bottom:1px dotted #CCCCCC; padding-top:5px; padding-bottom:5px"><?=$gNm?></td>
			<td valign="top" width="50" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; padding-right:15px; padding-top:5px; padding-bottom:5px; text-align:center"><?=$gSz?> KB</td>
			<td valign="top" width="130" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
			<a href="#" onclick="remoIMG('<?=$CrT?>','<?=$eIdT?>','<?=$rIdT?>','<?=$IdL?>'); return false;" class="ico dele">Remove</a>
			</td>
		</tr>
		<?php
		$iG++;
	}
	?>
	<?php if ($iG==1) {?>
	<tr height="20">
		<td colspan="5" style="text-align:center; vertical-align:middle">Hasil upload tidak ditemukan..!!</td>
	</tr>
	<?php } ?>
	<tr height="100%">
		<td colspan="5" style="text-align:center">&nbsp;</td>
	</tr>
</table>

