<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
if ($gUnT=="ALL"){$gUnT="%";}

$FnD = str_replace('**',' ',$gFnD);
$gTA = $gTH."-".substr('0'.$gBL,-2,2)."-".substr('0'.$gHR,-2,2);
$gTB = $gTHd."-".substr('0'.$gBLd,-2,2)."-".substr('0'.$gHRd,-2,2);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (PI_Nama LIKE '%$gFnD%' OR PI_Nip LIKE '%$FnD%' OR PII_Nama LIKE '%$FnD%' OR PII_Nip LIKE '%$FnD%')";
}
if ($gJNS=='00') {$gJNS="%";}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="385px" style="border:0px">
<?php
$iG=1;

$nSQ = "SELECT IDT as A0,
Tanggal as A1,
Nomor as A2,
Tanggal_BMD as A3,

concat(PI_Nama,'<br>',PII_Nama) as A4,
concat(PI_Nip,'<br>',PII_Nip) as A5,
concat(PI_PangkatGol,'<br>',PII_PangkatGol) as A6,
concat(PI_Jabatan,'<br>',PII_Jabatan) as A7,
Model as A8 

FROM tb_rekonsiliasi P1 
WHERE KdSkpd LIKE '$gUnT%' AND (Tanggal BETWEEN '$gTA' AND '$gTB') AND Model LIKE '$gJNS' $CrT ORDER BY Tanggal DESC,IDT DESC LIMIT 0,500";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$gIdT = $mRo[0];
	
	$DeL  = "";
	?>
	<tr height="50"> 
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=fConvertDateShort($mRo[1])?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=$mRo[2]?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>"><?=$mRo[8]?></td>
	  <td style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo[3]?></td>
	  <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px; " <?=$gBG?>><?=$mRo[4]?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; border-left:1px #ccc solid"><?=$mRo[5]?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; border-left:1px #ccc solid"><?=$mRo[6]?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; border-left:1px #ccc solid"><?=$mRo[7]?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-weight:<?=$WgT?>">
	  <a href="#" onClick="showEDIT('<?=$FrmG?>','<?=$gIdT?>','<?=$IdL?>'); return false" class="ico edit">edit</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="showDELE('<?=$FrmG?>','<?=$ReO?>','<?=$gIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico dele">delete</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onclick="P_Dokumen('800','400','<?=$gIdT?>','<?=$IdL?>'); return false" class="ico prev">&nbsp;view</a>	  </td>
    </tr>
	<?php
	$iG++;
}
?>
<tr height="100%">
 <td width="28" style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td width="70" style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td width="120" style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td width="50" style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td width="70" style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td width="223" style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td width="133" style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td width="223" style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td width="253" style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
</tr>
</table>
<script languange="javascript">
$("#fFnD").focus();
</script>