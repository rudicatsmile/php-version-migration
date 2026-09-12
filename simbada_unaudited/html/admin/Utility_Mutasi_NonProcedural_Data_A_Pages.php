<?
require('Connection.php');
require('Connection_CopyData.php');
require('FileFunction.php');
CallConnection(DatabaseSC,$ConSC);
extract($_GET);

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

$PaG=1;
$DataPerPage = 500;
$JumNiLL = 0;
$JumData = 0;
if ($gSkP){
	$JumNiLL = fGlobalNEW("IfNull(sum(debet-kredit),0)","ta_kib_post","kd_upb:referensi",$gSkP."%:".$Ref."%","LIKE:LIKE","",DatabaseSC,$ConSC,"");
	$JumData = fGlobalNEW("count(*)","ta_kib_".$gTbL,"kd_upb",$gSkP."%","LIKE","",DatabaseSC,$ConSC,"");
	if ($JumData>$DataPerPage)
	{
		$PaG = ceil($JumData/$DataPerPage);
	}
}
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:100%">
  <tr height="28">
    <td valign="middle">
	<? if ($JumData>1){?>
	<div class="pagging">
	<?
	for ($iA = 0; $iA <= $PaG-1; $iA++)
	{?>
		<a href="#" onclick="RefreshDATAa('<?=$IdL?>','<?=($iA*$DataPerPage)?>');return false;"><?=$iA+1?></a>
	<? }
	?>
	</div>
	<? } ?>
	</td>
    <td width="55">Total</td>
    <td width="100" style="text-align:right; padding-right:20px"><?=fConvertToRupiahBulat($JumNiLL)?></td>
  </tr>
</table>