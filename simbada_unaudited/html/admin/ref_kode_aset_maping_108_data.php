<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
#echo $Jen;
?>
<table align='center' border='0' width='100%' class='table-listpop' cellspacing='0' cellpadding='0' height='100%' style='border-collapse:collapse'>
<?
if ($Jen==""){$Jen=$Kel;}
$iG=1;
$nSQ = "SELECT kd_aset, nm_aset FROM ref_rek_aset4 WHERE kd_aset LIKE '$Jen%' ORDER BY kd_aset";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$x1  = $mRo[0];
	$x2  = strtoupper($mRo[1]);
	$x3  = "";
	$x4  = "";
	$Lev = "OBJ";
	$pad = 5;
	$xB  = "<b>";
	eShow($x1,$x2,$x3,$x4,$Lev,$pad,$IdL,$ReO,$xB);
	rincianLoad($x1,$IdL,$ReO,$sB);
	$iG++;
}

function rincianLoad($obj,$IdL,$ReO,$sB)
{
	$iGa=1;
	$SQa = "SELECT kd_aset, nm_aset FROM ref_rek_aset5 WHERE kd_aset LIKE '$obj%' ORDER BY kd_aset";
	$nRa = mysql_query($SQa);
	while ($mRa = mysql_fetch_array($nRa, MYSQL_BOTH))
	{
		$x1  = $mRa[0];
		$x2  = $mRa[1];
		$x3  = fGlobal("Kd_Aset108","ref_rek_aset5_maping","Kd_Aset17",$x1,"=","","");
		$x4  = fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$x3,"=","","");

		$Lev = "RCI";
		$pad = 20;
		$xB  = "";
		eShow($x1,$x2,$x3,$x4,$Lev,$pad,$IdL,$ReO,$xB);
		$iGa++;
	}
}
?>
<? function eShow($x1,$x2,$x3,$x4,$Lev,$pad,$IdL,$ReO,$xB){?>
<tr height="25px">
 <td style="border-right:1px #ccc solid; border-bottom:1px #ccc dotted; padding-left:10px"><?=$xB.$x1?></td>
 <td style="border-right:1px #ccc solid; border-bottom:1px #ccc dotted; padding-left:<?=$pad?>px"><?=$xB.$x2?></td>
 <td style="border-right:1px #ccc solid; border-bottom:1px #ccc dotted; padding-left:10px"><?=$xB.$x3?></td>
 <td style="border-right:1px #ccc solid; border-bottom:1px #ccc dotted; padding-left:<?=$pad?>px"><?=$xB.$x4?></td>
 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc dotted; text-align:center">
 <? if ($Lev=="RCI" && $ReO!='Y'){?>
 <a href="#" class="ico edit" onClick="showGlobalPopup('view','mappDivShow','ref_kode_aset_maping_108_mapp_mid','ref_kode_aset_maping_108_mapp_top','','kde=<?=$x1?>&IdL=<?=$IdL?>')">MAPPING</a>&nbsp;&nbsp;&nbsp;
 <a href="#" class="ico dell" onclick="ClearMapi('ViewDELL','ref_kode_aset_maping_108_mapp_clear','kde=<?=$x1?>&IdL=<?=$_GET['IdL']?>')">CLEAR</a>
 <? } else { echo "-";}?>
 </td>
</tr>
<? } ?>
<? if ($iG>1) {?>
<tr height="100%">
 <td width="117" style="border-right:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td width="452" style="border-right:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td width="134" style="border-right:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td width="452" style="border-right:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:0px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
</tr>
<? }else{ ?>
<tr height="100%">
 <td colspan="14" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
