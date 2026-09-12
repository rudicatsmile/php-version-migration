<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$JeN = fGlobal("Jenis","ta_rkbmd_new_pmf_pmt_phs","Referensi",$gREF,"=","","");
?>
<?php if ($JeN=="PMF") {?>
	<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="300px">
	<?php
	
	$iG=$PgE+1;
	$tJmL=0;
	$nSQ = "SELECT p1.IDT as A0, 
	p1.kd_aset as A1,
	concat('<b>',p2.nm_aset,'</b><br><i>',p1.nm_aset) as A2,
	p1.kd_upb as A3,
	p1.ref_aset as A4,
	p1.no_register as A5,
	p1.jml_barang as A6,
	p1.nilai_perolehan as A7,
	p1.lokasi as A8,
	p1.peruntukan as A9,
	p1.bentuk_pemanfaatan as A10,
	p1.jangka_waktu_pemanfaatan as A11,
	
	p1.bentuk_pemindahtanganan as A12,
	p1.alasan_rencana_pemindahtanganan as A13,
	p1.alasan_rencana_penghapusan as A14,
	p1.keterangan as A15 
	
	FROM ta_rkbmd_new_pmf_pmt_phs_rinci p1 
	left join ref_rek_aset108_7 p2 on p2.kd_aset=p1.kd_aset 
	WHERE p1.Referensi='$gREF' ORDER BY p1.IDT LIMIT $PgE,50";
	$nRs = mysql_query($nSQ);
	#echo $nSQ;
	#return false;
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gBG  = fBackCLR($iG);
		$gIDT = $mRo[0];
		
		?>
		<tr height="40"> 
		  <td width="27" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
		  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
		  <td width="208" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:2px"><?=$mRo[2]?></td>
		  <td width="95" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[4]?></td>
		  <td width="60" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo[5]?></td>
		  <td width="45" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo[6]?></td>
		  <td width="103" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:right; padding-right:2px" <?=$gBG?>><?=fConvertToRupiah($mRo[7])?></td>
		  <td width="178" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:2px"><?=$mRo[8]?></td>
		  <td width="128" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:2px"><?=$mRo[9]?></td>
		  <td width="128" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:2px"><?=$mRo[10]?></td>
		  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[11]?></td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:center">
		  <a href="#" onClick="showEDIT('','<?=$gIDT?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;edit</a>&nbsp;&nbsp;
		  <a href="#" onClick="P_Remove('<?=$PgE?>','<?=$gIDT?>','<?=$CeK?>','<?=$IdL?>'); return false" class="ico dell">&nbsp;remove</a>	  </td>
		</tr>
		<?php
		$iG++;
	}
	?>
	<?php if ($iG>1) {?>
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
	 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
	 </tr>
	<?php }else{ ?>
	<tr height="100%">
	 <td colspan="13" align="center">Data tidak ditemukan..!!</td>
	</tr>
	<?php } ?>
	</table>
<?php } ?>

<?php if ($JeN=="PMT") {?>
	<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="300px">
	<?php
	
	$iG=$PgE+1;
	$tJmL=0;
	$nSQ = "SELECT p1.IDT as A0, 
	p1.kd_aset as A1,
	concat('<b>',p2.nm_aset,'</b><br><i>',p1.nm_aset) as A2,
	p1.kd_upb as A3,
	p1.ref_aset as A4,
	p1.no_register as A5,
	p1.jml_barang as A6,
	p1.nilai_perolehan as A7,
	p1.lokasi as A8,
	
	p1.bentuk_pemindahtanganan as A9,
	p1.alasan_rencana_pemindahtanganan as A10,
	p1.keterangan as A11 
	
	FROM ta_rkbmd_new_pmf_pmt_phs_rinci p1 
	left join ref_rek_aset108_7 p2 on p2.kd_aset=p1.kd_aset 
	WHERE p1.Referensi='$gREF' ORDER BY p1.IDT LIMIT $PgE,50";
	$nRs = mysql_query($nSQ);
	#echo $nSQ;
	#return false;
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gBG  = fBackCLR($iG);
		$gIDT = $mRo[0];
		
		?>
		<tr height="40"> 
		  <td width="27" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
		  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
		  <td width="208" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:2px"><?=$mRo[2]?></td>
		  <td width="95" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[4]?></td>
		  <td width="60" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo[5]?></td>
		  <td width="45" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo[6]?></td>
		  <td width="103" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:right; padding-right:2px" <?=$gBG?>><?=fConvertToRupiah($mRo[7])?></td>
		  <td width="178" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:2px"><?=$mRo[8]?></td>
		  <td width="178" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:2px"><?=$mRo[9]?></td>
		  <td width="178" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:2px"><?=$mRo[10]?></td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:center">
		  <a href="#" onClick="showEDIT('','<?=$gIDT?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;edit</a>&nbsp;&nbsp;
		  <a href="#" onClick="P_Remove('<?=$PgE?>','<?=$gIDT?>','<?=$CeK?>','<?=$IdL?>'); return false" class="ico dell">&nbsp;remove</a>	  </td>
		</tr>
		<?php
		$iG++;
	}
	?>
	<?php if ($iG>1) {?>
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
	<?php }else{ ?>
	<tr height="100%">
	 <td colspan="12" align="center">Data tidak ditemukan..!!</td>
	</tr>
	<?php } ?>
	</table>
<?php } ?>

<?php if ($JeN=="PHS") {?>
	<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="300px">
	<?php
	
	$iG=$PgE+1;
	$tJmL=0;
	$nSQ = "SELECT p1.IDT as A0, 
	p1.kd_aset as A1,
	concat('<b>',p2.nm_aset,'</b><br><i>',p1.nm_aset) as A2,
	p1.kd_upb as A3,
	p1.ref_aset as A4,
	p1.no_register as A5,
	p1.jml_barang as A6,
	p1.nilai_perolehan as A7,
	p1.lokasi as A8,
	
	p1.alasan_rencana_penghapusan as A9,
	p1.keterangan as A10 
	
	FROM ta_rkbmd_new_pmf_pmt_phs_rinci p1 
	left join ref_rek_aset108_7 p2 on p2.kd_aset=p1.kd_aset 
	WHERE p1.Referensi='$gREF' ORDER BY p1.IDT LIMIT $PgE,50";
	$nRs = mysql_query($nSQ);
	#echo $nSQ;
	#return false;
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gBG  = fBackCLR($iG);
		$gIDT = $mRo[0];
		
		?>
		<tr height="40"> 
		  <td width="27" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
		  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
		  <td width="298" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:2px"><?=$mRo[2]?></td>
		  <td width="95" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[4]?></td>
		  <td width="60" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo[5]?></td>
		  <td width="45" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo[6]?></td>
		  <td width="103" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:right; padding-right:2px" <?=$gBG?>><?=fConvertToRupiah($mRo[7])?></td>
		  <td width="248" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:2px"><?=$mRo[8]?></td>
		  <td width="198" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:2px"><?=$mRo[9]?></td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:center">
		  <a href="#" onClick="showEDIT('','<?=$gIDT?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;edit</a>&nbsp;&nbsp;
		  <a href="#" onClick="P_Remove('<?=$PgE?>','<?=$gIDT?>','<?=$CeK?>','<?=$IdL?>'); return false" class="ico dell">&nbsp;remove</a>	  </td>
		</tr>
		<?php
		$iG++;
	}
	?>
	<?php if ($iG>1) {?>
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
	 </tr>
	<?php }else{ ?>
	<tr height="100%">
	 <td colspan="11" align="center">Data tidak ditemukan..!!</td>
	</tr>
	<?php } ?>
	</table>
<?php } ?>
