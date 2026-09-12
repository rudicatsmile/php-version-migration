<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$iG=1;
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="385px" style="font-family:calibri; font-size:9pt; border:0px">
<?
$nSQ="SELECT P1.idt,P1.idProgram,P1.idReferensi,P1.nmProgram, P2.nm_referensi FROM ta_apbd_program_skpd P1 
LEFT JOIN ref_kegiatan P2 ON P2.id_referensi=left(P1.idReferensi,7)
WHERE P1.kdUnit='$gUNT' AND P1.periode='$gTHN' ORDER BY P1.idProgram";

$nSQ="SELECT idt,idProgram,nmProgram FROM ta_apbd_program_skpd 
WHERE kdUnit='$gUNT' AND periode='$gTHN' AND apbd='$gAPB' ORDER BY idProgram";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$IdT = $mRo[0];
	$rPR = $mRo[1];
	$gBG = fBackCLR($iG);
	$mRo4= fGlobal("IfNull(sum(fnJumlah),0)","ta_apbd_rekening_skpd","kdUnit:idSubKegiatan:periode:apbd",$gUNT.":".$rPR."%:".$gTHN.":".$gAPB,"=:LIKE:=:=","","");
	
	$DeL = fGlobal("IDT","ta_apbd_kegiatan_skpd","kdUnit:idKegiatan:periode:apbd",$gUNT.":".$rPR."%:".$gTHN.":".$gAPB,"=:LIKE:=:=","","");
	if ($DeL){
		$ico = "delt";
	}
	else{
		$ico = "del";
	}
	
	if (strpos(strtoupper($mRo[1]),'X')!== false) 
	{
		$bCg1=TxBckCLR($iG);
		if (strpos(strtoupper(substr($mRo[1],0,4)),'X')!== false){
			$bCg1="background:#FFFF00";
		}
		$bCg2=TxBckCLR($iG);
		if (strpos(strtoupper(substr($mRo[1],-2,2)),'X')!== false){
			$bCg2="background:#FFFF00";
		}
		$DeA="";
		$rEa="";
	}
	
	else{
		$bCg1=TxBckCLR($iG);
		$bCg2=TxBckCLR($iG);
		$DeA=$DeL;
		$rEa="";
	}
	
	$bCR="";
	if ($mRo[3]=="Nama Program...........???!!!"){
		$bCR="; color:#FF0000";
	}
	?>
	<tr height="28"> 
	  <td width="38" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="120" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <!--
	  <input name="fPRO1<?=$IdT?>" id="fPRO1<?=$IdT?>" type="text" value="<?=substr($mRo[1],0,4)?>" <?=$rEa?> onkeypress="if (event.keyCode==13){P_Save(this,'<?=$IdT?>','kode1','<?=$DeA?>','<?=$IdL?>'); return false;}" maxlength="4" style="text-align:center; padding-left:1px; width:35px; color:#333333; border: 1px solid #C0C0C0; <?=$bCg1?>"/>&nbsp;.
	  <input name="fPRO2<?=$IdT?>" id="fPRO2<?=$IdT?>" type="text" value="<?=substr($mRo[1],5,10)?>" <?=$rEa?> readonly style="text-align:center; padding-left:1px; width:70px; color:#333333; border: 1px solid #C0C0C0; <?=TxBckCLR($iG)?>"/>.
	  <input name="fPRO3<?=$IdT?>" id="fPRO3<?=$IdT?>" type="text" value="<?=substr($mRo[1],-2,2)?>" <?=$rEa?> onkeypress="if (event.keyCode==13){P_Save(this,'<?=$IdT?>','kode3','<?=$DeA?>','<?=$IdL?>'); return false;}" maxlength="2" style="text-align:center; padding-left:1px; width:25px; color:#333333; border: 1px solid #C0C0C0; <?=$bCg2?>"/>
	  -->
	  <?=$mRo[1]?>
	  </td>
	  <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px" <?=$gBG?>>
	  <!--
	  <input name="fNMA" type="text" value="<?=$mRo[3]?>" onkeypress="if (event.keyCode==13){P_Save(this,'<?=$IdT?>','desk','','<?=$IdL?>'); return false;}" style="padding-left:1px; width:99%; color:#333333; border: 1px solid #C0C0C0; <?=$bCR?>"/>	  
	  -->
	  <?=$mRo[2]?>
	  </td>
	  <td width="130" valign="top" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:right; padding-right:3px" <?=$gBG?>><?=fConvertToRupiah($mRo4)?></td>
	  <td valign="top" width="101" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><a href="#" class="ico <?=$ico?>" onclick="P_RemoveXX('<?=$IdT?>','<?=$DeL?>','<?=$_GET['IdL']?>'); return false;">Delete</a></td>
	</tr>
	<?
	$iG++;
	$rToT = $rToT+$mRo4;
}
?>
<? if ($iG>1) {?>
<tr height="25px">
 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; text-align:right; padding-right:3px; font-weight:bold">T O T A L</td>
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
<? }else{ ?>
<tr height="100%">
 <td colspan="5" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
