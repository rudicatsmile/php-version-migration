<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$iG=1;
#echo $gUNT."<br>";
#echo $gTHN."<br>";
#echo $gAPB."<br>";
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="385px" style="font-family:calibri; font-size:9pt; border:0px">
<?
$gToT = 0;
if ($gSUB)
{
	if ($gPER!='')
	{
		$nSQ="SELECT idt, idSubKegiatan, kdRekening, nmRekening, fnJumlah, nmSubUnit FROM ta_apbd_rekening_skpd 
		WHERE kdUnit='$gUNT' AND idSubKegiatan = '$gSUB' AND idSubUnit = '$gPER' AND periode='$gTHN' AND apbd='$gAPB' ORDER BY IDT";
	}
	else 
	{
		$nSQ="SELECT idt, idSubKegiatan, kdRekening, nmRekening, fnJumlah, nmSubUnit FROM ta_apbd_rekening_skpd 
		WHERE kdUnit='$gUNT' AND idSubKegiatan = '$gSUB' AND periode='$gTHN' AND apbd='$gAPB' ORDER BY kdRekening";
	}
}
else{
	$nSQ="SELECT idt, idSubKegiatan, kdRekening, nmRekening, fnJumlah, nmSubUnit FROM ta_apbd_rekening_skpd 
	WHERE kdUnit='$gUNT' AND idSubKegiatan = 'XXXXXXXXXXXXXXX' AND periode='$gTHN' AND apbd='$gAPB' ORDER BY kdRekening";
}
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$IdT = $mRo[0];
	$gBG = fBackCLR($iG);
	$DeL = "";
	?>
	<tr height="28"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="110" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td width="95" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[2]?></td>
	  <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px" <?=$gBG?>><?=$mRo[3]?><? if ($gPER==''){echo " ( <font style='color:#0000ff'><i>Peruntukan : ".$mRo[5]." </i></font>)";}?></td>
	  <td width="110" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>>
	  <input name="fNiL" type="text" value="<?=fConvertToRupiah($mRo[4])?>" onkeyup="addSeparatorNum(this)" onkeypress="if (event.keyCode==13){P_Save(this,'<?=$IdT?>','<?=$DeL?>','<?=$IdL?>');}" style="font-family:calibri; font-size:9pt; padding-right:3px; width:100px; border: 1px solid #C0C0C0; text-align:right;  <?=TxBckCLR($iG)?>"/></td>
	  <td width="101" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  -
	  <!--a href="#" class="ico del" onclick="P_RemoveXX('<?=$IdT?>','<?=$DeL?>','<?=$IdL?>'); return false;">Delete</a-->
	  </td>
	</tr>
	<?
	$gToT = $gToT + $mRo[4];
	$iG++;
}
?>
<? if ($iG>1) {?>
<tr height="24px">
 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; text-align:right; padding-right:20px">TOTAL</td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; text-align:center"><input name="fToT" type="text" value="<?=fConvertToRupiah($gToT)?>" style="font-family:calibri; font-size:9pt; font-weight:bold; padding-right:3px; width:100px; border: 1px solid #C0C0C0; text-align:right"/></td>
 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
</tr>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
</tr>
<? }else{ ?>
<tr height="100%">
 <td colspan="6" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
