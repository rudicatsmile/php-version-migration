<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
?>
<?php if ($CrT=='Edit') {?>
	<?php
	$gJN  = fGlobal("Jenis","ta_usulan_108","Referensi",$gRF,"=","","");
	$gALS = fGlobal("Kd_Rinci","ta_usulan_rinci_108","IDT",$gIdT,"=","","");
	$dALS = fGlobal("Deskripsi","ref_usulan_jenis_rinci","Kode",$gALS,"=","","");
	
	?>
	<table align="center" cellpadding="0" class="table-form" cellspacing="0" width="100%" height="100" border="0">
	<tr height="10">
	  <td width="30"></td>
	  <td width="60"></td>
	  <td width="20"></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>


	<tr height="10">
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	</tr>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">KRITERIA</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="fALS" type="hidden" value="<?=$gALS?>" style="padding-left:5px; width:40px; border: 1px solid #C0C0C0"/>
	  <input name="dALS" type="text" value="<?=$dALS?>" readonly onClick="findEDIT('','alas','','<?=$gIdT?>','<?=$_GET['IdL']?>')" style="padding-left:5px; width:300px; border: 1px solid #C0C0C0"/>&nbsp;&nbsp;<a href="#" class="ico prev" onClick="findEDIT('','alas','','<?=$gIdT?>','<?=$_GET['IdL']?>'); return false;"></a>	  </td>
	  <td>&nbsp;</td>
	</tr>
	<tr height="20">
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	</table>
<?php } else { ?>

	<?php
	$gRA = fGlobal("Ref_Aset","ta_usulan_rinci_108","IDT",$gIdT,"=","","");
	?>
	<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="100" border="0">
		<?php
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
				<?php if ($CrT=='Img') {?><img src="<?="Invent_Usulan_Frm_Data_Edit_Upl_Mid_Src.php?rIdT=".$rIdT?>" height="50" width="50" style="border:1px #999999 solid" ><?php } ?>
				</td>
				<td valign="top" <?=$gBG?>style="border-bottom:1px dotted #CCCCCC; padding-top:5px; padding-bottom:5px"><?=$gNm?></td>
				<td valign="top" width="50" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; padding-right:15px; padding-top:5px; padding-bottom:5px; text-align:center"><?=$gSz?> KB</td>
				<td valign="top" width="130" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
				<a href="#" onclick="viewIMG('<?=$rIdT?>','600','400','<?=$IdL?>'); return false;" class="ico prev">View</a>&nbsp;|&nbsp;
				<a href="#" onclick="remoIMG('<?=$CrT?>','<?=$gIdT?>','<?=$rIdT?>','<?=$IdL?>'); return false;" class="ico dele">Remove</a>
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
		<tr height="20">
			<td colspan="5" style="text-align:center"><a href="#" onclick="addIMG('<?=$CrT?>','<?=$gIdT?>'); return false;" class="ico add">Upload file ( <?php if ($CrT=='Pdf') {echo "PDF";} else {echo "JPG, JPEG, PNG, BMP, GIF";}?> )</a></td>
		</tr>
		<tr height="100%">
			<td colspan="5" style="text-align:center">&nbsp;</td>
		</tr>
	</table>
<?php } ?>