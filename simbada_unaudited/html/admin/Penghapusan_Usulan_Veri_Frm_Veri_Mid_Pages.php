<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$rPgE = $PgE/100;
#echo $gREF;
#return false;

/*
if ($gUPB){$gSkP = $gUPB;}
else{
	if ($gSUB){$gSkP = $gSUB;}
	else{$gSkP = $gUNT;}
}

if ($gTbL=='a'){
	$Ref = "TNH";
}
if ($gTbL=='b'){
	$Ref = "ALT";
}
if ($gTbL=='c'){
	$Ref = "BNG";
}
if ($gTbL=='d'){
	$Ref = "JLN";
}
if ($gTbL=='e'){
	$Ref = "ATL";
}
*/
$PaG=1;
$DataPerPage = 100;
$JumNiLL = 0;
$JumData = 0;

$gREF = fGlobalNEW("Referensi","ta_usulan_108","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
if ($gREF){
	#$JumNiLL = fGlobalNEW("IfNull(sum(nilai_akhir),0)","ta_usulan_verifikasi_rinci_108","Ref_Usulan",$gREF,"=","",DatabaseSB,$ConSB,"");
	#$JumData = fGlobalNEW("count(*)","ta_usulan_verifikasi_rinci_108","Ref_Usulan",$gREF,"=","",DatabaseSB,$ConSB,"");
	$JumNiLL = fGlobalNEW("IfNull(sum(nilai_akhir),0)","ta_usulan_rinci_108","Referensi",$gREF,"=","",DatabaseSB,$ConSB,"");
	$JumData = fGlobalNEW("count(*)","ta_usulan_rinci_108","Referensi",$gREF,"=","",DatabaseSB,$ConSB,"");
	if ($JumData>$DataPerPage)
	{
		$PaG = ceil($JumData/$DataPerPage);
	}
}
?>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:1080px; height:40px">
  <tr height="28">
    <td valign="middle">
	<? if ($JumData>1){?>
	<div class="pagging">
	<?
	for ($iA = 0; $iA <= $PaG-1; $iA++)
	{
	if ($iA==$rPgE){
		$iK = "style='color:#ff0000; font-weight:bold'";
	}
	else{
		$iK = "";
	}
	#function showFORM(crt,PgE,IdT,gIdL)

	?>
		<a href="#" onclick="showFORM('<?=$ReO?>','refr','<?=($iA*$DataPerPage)?>','<?=$IdT?>','<?=$IdL?>');return false;" <?=$iK?>><?=($iA+1)?></a>
	<? }
	?>
	</div>
	<? } ?>
	</td>
    <td width="110">Total (<i>Nilai Akhir</i>) :</td>
    <td width="100" style="text-align:right; padding-right:20px"><?=fConvertToRupiahBulat($JumNiLL)?></td>
  </tr>
</table>