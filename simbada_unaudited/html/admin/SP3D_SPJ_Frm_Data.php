<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
if ($fIdT){
	$gREF = fGlobal("Referensi","ta_sp3d_rinci","IDT",$fIdT,"=","","");
	$gRKN = fGlobal("Kd_ReknP90","ta_sp3d_rinci","IDT",$fIdT,"=","","");
	?>
	<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="100%" style="border:0px; font-weight:normal">
	<?
	$iG=1;
	$tJmL= 0;
	$nSQ = "SELECT IDT as A0, Referensi as A1, Kd_ReknP108 as A2, Nm_ReknP108 as A3, Tgl_BAST as A4 
	FROM ta_sp3d_spj 
	WHERE Referensi_SP3B='".$gREF."' AND Kd_ReknP90='".$gRKN."' ORDER BY IDT";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gBG  = fBackCLR($iG);
		$eIdT = $mRo[0];
		$mRo7 = fGlobal("IfNull(sum(Total),0)","ta_sp3d_spj_rinci","Referensi_SPJ",$mRo[1],"=","","");
		
		$DeL  = "";
		$rDel = "dele";
		$rCek = "";
		?>
		<tr height="26"> 
		  <td width="102" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:0px #ccc solid; text-align:center"><?=$mRo[1]?></td>
		  <td width="65" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=fConvertDateShort($mRo[4])?></td>
		  <td width="95" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[2]?></td>
		  <td width="250" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px"><?=$mRo[3]?></td>
		  <td width="90" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo7)?></td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
		  <a href="#" onClick="showSPJ('','<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico docu">&nbsp;Berkas</a>&nbsp;&nbsp;
		  <a href="#" onClick="showASET('','<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico edit">Kapitalisasi</a>&nbsp;&nbsp;
		  <a href="#" onClick="showUPLOAD('','<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico img">&nbsp;&nbsp;Upload</a>&nbsp;&nbsp;
		  <a href="#" onClick="showDELE('<?=$eIdT?>','<?=$fIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico <?=$rDel?>">del</a></td>
		</tr>
		<?
		$iG++;
		$tJmL = $tJmL + $mRo[6];
		$tJmA = $tJmA + $mRo7;
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
	 </tr>
	<tr height="22">
	  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="4">T O T A L</td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmA)?></td>
	  <td style="border-left:1px #ccc solid">&nbsp;</td>
	  </tr>
	<? }else{ ?>
	<tr height="100%">
	 <td colspan="7" align="center">Data tidak ditemukan..!!</td>
	</tr>
	<? } ?>
	</table>
<? 
}
?>