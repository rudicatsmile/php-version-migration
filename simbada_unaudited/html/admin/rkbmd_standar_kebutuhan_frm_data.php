<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

?>
	<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="300px">
	<?
	
	$iG=$PgE+1;
	$tJmL=0;
	$nSQ = "SELECT p1.IDT as A0, 
	p1.kd_aset as A1,
	p2.nm_aset as A2,
	p1.nm_aset as A3,
	p1.jumlah as A4,
	p1.satuan as A5,
	p1.keterangan as A6,
	p1.kd_unit as A7 
	
	FROM ta_rkbmd_standar_kebutuhan_rinci p1 
	LEFT JOIN ref_rek_aset108_6 p2 ON p2.kd_aset=left(p1.kd_aset,14) 
	WHERE p1.Referensi='$gREF' ORDER BY p1.IDT LIMIT $PgE,100";
	$nRs = mysql_query($nSQ);
	#echo $nSQ;
	#return false;
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gBG = fBackCLR($iG);
		$IdT = $mRo[0];
		$KdA = $mRo[1];
		$SkD = $mRo[7];
		?>
		<tr height="34"> 
		  <td width="27" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
		  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
		  <td width="400" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:2px"><?="<b>".$mRo[3]."</b><br><i>".ucwords(strtolower($mRo[2]))?></td>
		  <td width="60" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
		  <img src="css/images/prev.gif" style="cursor:pointer" onclick="LoadASET('','0','<?=$SkD?>','<?=$KdA?>','<?=$IdL?>'); return false;" /></td>
		  <td width="75" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
		  <input name="fQtY" id="fQtY" type="text" value="<?=fConvertToRupiahBulat($mRo[4])?>" 
		  onkeypress="if (event.keyCode==13){ SaveRecord(this,'jumlah','<?=$IdT?>','<?=$IdL?>'); return false;}" 
		  style=" text-align:center; width:60px; border: 1px solid #C0C0C0"/>		  </td>
		  <td width="95" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
		  <input name="fSaT" id="fSaT" type="text" value="<?=$mRo[5]?>" 
		  onkeypress="if (event.keyCode==13){ SaveRecord(this,'satuan','<?=$IdT?>','<?=$_GET['IdL']?>'); return false;}" 
		  style=" text-align:center; width:80px; border: 1px solid #C0C0C0"/>		  </td>
		  <td width="450" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
		  <input name="fSaT" id="fSaT" type="text" value="<?=$mRo[6]?>" 
		  onkeypress="if (event.keyCode==13){ SaveRecord(this,'keterangan','<?=$IdT?>','<?=$_GET['IdL']?>'); return false;}" 
		  style="padding-left:3px; width:436px; border: 1px solid #C0C0C0"/>		  
		  </td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:center">
		  <!--a href="#" onClick="showEDIT('','<?=$IdT?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;edit</a>&nbsp;&nbsp;-->
		  <a href="#" onClick="P_Remove('<?=$PgE?>','<?=$IdT?>','<?=$CeK?>','<?=$IdL?>'); return false" class="ico dell">&nbsp;remove</a>	  </td>
		</tr>
		<?
		$iG++;
	}
	?>
	<? if ($iG>1) {?>
	<tr height="100%">
	 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
	 </tr>
	<? }else{ ?>
	<tr height="100%">
	 <td colspan="9" align="center">Data tidak ditemukan..!!</td>
	</tr>
	<? } ?>
	</table>
