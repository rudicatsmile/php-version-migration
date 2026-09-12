<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
//echo $fIdT;
$GetIdT = $fIdT;
?>
<table border="0" class="table-list" cellspacing="0" cellpadding="0" height="100%" style="width:1005; border:0px; font-weight:normal">
<?
$iG=1;
$tJmL= 0;
$nSQ = "SELECT IDT as A0, Kd_ReknP90 as A1, Nm_ReknP90 as A2, Nilai as A3 
FROM ta_sp3d_rinci 
WHERE Referensi='".$gREF."' AND Kd_ReknP90 LIKE '5%' ORDER BY IDT";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$eCK = "";
	$gBG  = fBackCLR($iG);
	$fIdT = $mRo[0];
	if ($GetIdT==$fIdT){
		$eCK = "checked";
	}
	$mRo4 = fGlobal("IfNull(sum(Total),0)","ta_sp3d_spj_rinci","Referensi_SP3B:Kd_ReknP90",$gREF.":".$mRo[1],"=:=","","");

	$fL = "";
	if ($mRo4<$mRo[3]){
		$fL = "; color:#0000FF";
	}
	else if ($mRo4>$mRo[3]){
		$fL = "; color:#FF0000";
	}
	
	$DeL  = "";
	$rDel = "dele";
	$rCek = "";
	?>
	<tr height="30"> 
	  <td valign="top" width="85" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-top:3px; text-align:center"><?=$mRo[1]?></td>
	  <td valign="middle" width="290" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px">
	  <table border="0" width="100%" cellspacing="0" cellpadding="0" height="100%" style="border:0px; font-weight:normal; color:#666">
	  <tr height="20"> 
	  <td colspan="4" style="font-weight:bold; color:#000"><?=$mRo[2]?></td>
	  </tr>
	  <tr height="20"> 
	    <td width="60">Nilai SP3B</td>
	    <td width="10">:</td>
	    <td width="100" class="ar"><?=fConvertToRupiah($mRo[3])?></td>
	    <td>&nbsp;</td>
	  </tr>
	  <tr height="20"> 
	    <td>Nilai ASET</td>
	    <td>:</td>
	    <td style="text-align:right <?=$fL?>"><?=fConvertToRupiah($mRo4)?></td>
	    <td>&nbsp;</td>
	  </tr>
	  </table>	  </td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <input name="radiobutton" type="radio" value="radiobutton" <?=$eCK?> onclick="PilihDATA('<?=$fIdT?>','0','<?=$IdL?>')" />	  </td>
    </tr>
	<?
	$iG++;
	$tJmL = $tJmL + $mRo[3];
	$tJmA = $tJmA + $mRo7;
}

$fL = "";
if ($tJmA<$tJmL){
	$fL = "; color:#0000FF";
}
else if ($tJmA>$tJmL){
	$fL = "; color:#FF0000";
}
?>
<? if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 </tr>
<tr height="22">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="2">T O T A L</td>
  <td style="border-left:1px #ccc solid">&nbsp;</td>
  </tr>
<? }else{ ?>
<tr height="100%">
 <td colspan="4" align="center">Data spj tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
