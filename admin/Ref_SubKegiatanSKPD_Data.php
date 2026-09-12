<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$iG=1;
#echo $gUNT."<br>";
#echo $gTHN."<br>";
#echo $gAPB."<br>";
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="385px" style="font-family:calibri; font-size:9pt; border:0px">
<?php
$rToT = 0;
if ($gKEG){
	$nSQ="SELECT idt,idSubKegiatan,idReferensi,nmSubKegiatan FROM ta_apbd_kegiatan_sub_skpd 
	WHERE kdUnit='".$gUNT."' AND idSubKegiatan LIKE '$gKEG%' AND periode='$gTHN' AND apbd='$gAPB' ORDER BY idSubKegiatan";
}
else{
	$nSQ="SELECT idt,idSubKegiatan,idReferensi,nmSubKegiatan FROM ta_apbd_kegiatan_sub_skpd 
	WHERE kdUnit='".$gUNT."' AND idSubKegiatan LIKE 'XXXXXXXXXXXXXXX' AND periode='$gTHN' ORDER BY idSubKegiatan";
}
$nRs = mysql_query($nSQ);
#echo $nSQ;
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$IdT = $mRo[0];
	$gBG = fBackCLR($iG);
	$rKG = $mRo[1];
	$DeL = "";
	$mRo4= fGlobal("IfNull(sum(fnJumlah),0)","ta_apbd_rekening_skpd","kdUnit:idSubKegiatan:periode:apbd",$gUNT.":".$rKG."%:".$gTHN.":".$gAPB,"=:LIKE:=:=","","");
	$DeL = fGlobal("IDT","ta_apbd_rekening_skpd","kdUnit:idSubKegiatan:periode:apbd",$gUNT.":".$rKG."%:".$gTHN.":".$gAPB,"=:LIKE:=:=","IDT LIMIT 0,1","");
	if ($DeL){
		$ico = "delt";
	}
	else{
		$ico = "del";
	}
	
	if (strpos(strtoupper($mRo[1]),'X')!== false) 
	{
		$bCg="background:#FFFF00";
		$DeA=$DeL;
		$rEa="";
	}
	else{
		$bCg1=TxBckCLR($iG);
		$DeA=$DeL;
		$rEa="";
	}
	
	$bCR="";
	if ($mRo[3]=="Nama Kegiatan...........???!!!"){
		$bCR="; color:#FF0000";
	}
	?>
	<tr height="28"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="135" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <!--
	  <input name="fKEG1<?=$IdT?>" id="fKEG1<?=$IdT?>" type="text" value="<?=substr($mRo[1],0,18)?>" <?=$rEa?> onkeypress="if (event.keyCode==13){P_Save(this,'<?=$IdT?>','kode1','<?=$DeA?>','<?=$IdL?>'); return false;}" readonly style="text-align:center; padding-left:1px; width:105px; color:#333333; border: 1px solid #C0C0C0; <?=TxBckCLR($iG)?>"/>&nbsp;.
	  <input name="fKEG2<?=$IdT?>" id="fKEG2<?=$IdT?>" type="text" value="<?=substr($mRo[1],-3,3)?>" <?=$rEa?> onkeypress="if (event.keyCode==13){P_Save(this,'<?=$IdT?>','kode2','<?=$DeA?>','<?=$IdL?>'); return false;}" style="text-align:center; padding-left:1px; width:30px; color:#333333; border: 1px solid #C0C0C0; <?=$bCg?>"/>
	  -->
	  <?=$mRo[1]?>
	  </td>
	  <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px" <?=$gBG?>>
	  <!--input name="fNMA" id="fNMA" type="text" value="<?=$mRo[3]?>" onkeypress="if (event.keyCode==13){P_Save(this,'<?=$IdT?>','desk','','<?=$IdL?>'); return false;}" style="padding-left:1px; width:99%; color:#333333; border: 1px solid #C0C0C0; <?=$bCR?>"/-->
	  <?=$mRo[3]?>
	  </td>
	  <td width="110" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right" <?=$gBG?>><?=fConvertToRupiah($mRo4)?></td>
	  <td width="101" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><a href="#" class="ico <?=$ico?>" onclick="P_RemoveXX('<?=$IdT?>','<?=$DeL?>','<?=$_GET['IdL']?>'); return false;">Delete</a></td>
	</tr>
	<?php
	$iG++;
	$rToT = $rToT+$mRo4;
}
?>
<?php if ($iG>1) {?>
<tr height="25px">
 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; text-align:right; padding-right:20px; font-weight:bold">T O T A L</td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; text-align:right; padding-right:3px; font-weight:bold"><?=fConvertToRupiah($rToT)?></td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
</tr>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
</tr>
<?php }else{ ?>
<tr height="100%">
 <td colspan="5" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
