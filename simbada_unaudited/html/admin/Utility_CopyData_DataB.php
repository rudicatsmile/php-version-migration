<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (Referensi LIKE '%$gFnD%' 
	OR Keterangan LIKE '%$FnD%' 
	OR Harga LIKE '%$FnD%' 
	OR Ref_Mutasi LIKE '%$FnD%' 
	OR Nm_Aset LIKE '%$FnD%' 
	OR Kd_Aset LIKE '%$FnD%')";

}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="385px" style="border:0px">
<?
#echo $fDBA;
$x=array();
$iG=1;
$tJmL= 0;
if (($FnD!='') && ($fDBA!=''))
{
	CallConnection($fDBB,$ConSB);
	$nSQ = "SELECT IDT, Referensi, Kd_Aset_108, No_Register, Nm_Aset, Kd_UPB, Harga 
	FROM ta_kib_108 WHERE Kd_UPB LIKE '$gUnT%' $CrT ORDER BY Tgl_Perolehan LIMIT 0,50";
	
	$nSQ = "SELECT P1.IDT, P1.Referensi, P1.Kd_Aset_108, P1.No_Register, P1.Nm_Aset, P1.Harga, P1.Kd_UPB, P2.Nm_UPB 
	FROM ta_kib_108 P1 
	LEFT JOIN ref_upb P2 ON P2.Kd_UPB=P1.Kd_UPB 
	WHERE P1.Kd_UPB LIKE '$gUnT%' $CrT ORDER BY P1.Referensi LIMIT 0,50";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$x[1] = $mRo[1];
		$x[2] = $mRo[2];
		$x[3] = $mRo[3];
		#$x[4] = $mRo[4];
		$x[4] = $mRo[4]."<br><i>".strtolower($mRo[7])."</i>";
		$x[5] = $mRo[5];
		rinciDATA($x[1],$x[2],$x[3],$x[4],$x[5],$x[6],$x[7],$x[8],$x[9],$x[10],$x[11],$iG,$xB);
		$iG++;
	}
}
?>
<? function rinciDATA($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$iG,$xB){?>
	<?
	$gBG  = fBackCLR($iG);
	?>
	<tr height="22"> 
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x1?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x2?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x3?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:left; padding-left:3px"><?=$x4?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:right; padding-right:2px"><?=fConvertToRupiah($x5)?></td>
    </tr>
<? } ?>
<? if ($iG==1) {?>
<tr height="100%">
 <td colspan="7" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
<tr height="100%">
 <td width="25" style="border-bottom:0px #999999 dotted">&nbsp;</td>
 <td width="95" style="border-bottom:0px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
 <td width="85" style="border-bottom:0px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
 <td width="60" style="border-bottom:0px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
 <td style="border-bottom:0px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
 <td width="70" style="border-bottom:0px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
 </tr>
</table>
