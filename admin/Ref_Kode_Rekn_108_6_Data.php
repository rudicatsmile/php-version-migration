<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
#require('zRepairData.php');
#echo $ReO;
$FnD = str_replace('**',' ',$gFnD);

$CrT = "";
if ($FnD)
{
	$CrT ="AND (P1.Kd_Aset LIKE '%$gFnD%' OR P1.Nm_Aset LIKE '%$FnD%')"; 
}
?>
<table align="center" border="0" width="1000" class="table-list" cellspacing="0" cellpadding="0" height="100%" style="border:0px">
<?php
#$nSQ = "SELECT IDT, Kd_Rek_Old, Nm_Rek FROM ref_rek_90_6 WHERE Kd_Rek_Old LIKE '_._._.__.__.___' AND Kd_Rek='' ORDER BY IDT";
#echo $nSQ."<br>";
#$nRs = mysql_query($nSQ);
#while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
#{
#	$IdT = $mRo[0];
#	echo $mRo[1]."<br>";
#	$NewR = substr($mRo[1],0,4);
#	$NewR.= substr("00".substr($mRo[1],4,1),-2,2);
#	$NewR.= substr($mRo[1],-10,10);
#	echo $NewR."<br>";
	
#	$nS = "UPDATE ref_rek_90_6 SET Kd_Rek='".$NewR."' WHERE IDT='".$IdT."'";
#	echo $nS."<br>";
#	$nR = mysql_query($nS);
#}

$LA = 700;
$CS = 4;
if (substr($KdR5,0,5)=='1.5.4')
{
	$LA = 300;
	$CS = 7;
}

$iG=1;
$nSQ = "SELECT P1.IDT as A0, P1.Kd_Aset as A1, P1.Nm_Aset as A2, P1.Ms_Manfaat as A3, P1.Link_Kib_AE as A4, P2.Nm_Aset as A5 
FROM ref_rek_aset108_7 P1 
LEFT JOIN ref_rek_aset108_7 P2 ON P2.Kd_Aset=P1.Link_Kib_AE 
WHERE P1.Kd_Aset LIKE '".$KdR5."%' $CrT ORDER BY P1.Kd_Aset";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$eIdT = $mRo[0];
	$eKdR = $mRo[1];
	$rCek = "";
	?>
	<tr height="25"> 
	  <td width="30" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="108" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td width="<?=$LA?>" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[2]?></td>
	  <?php if (substr($KdR5,0,5)=='1.5.4'){?>
	  <td width="50" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[3]?> Th</td>
	  <td width="300" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[4]." : ".$mRo[5]?></td>
	  <td width="60" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <a href="#" onClick="alert('Under construction..!'); return false" class="ico edit">&nbsp;</a>
	  </td>
	  <?php } ?>
	  <td style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>>
	  <a href="#" onClick="editDATA('<?=$ReO?>','6','','<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="deleteDATA('<?=$ReO?>','6','<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico dell">&nbsp;Del</a>&nbsp;&nbsp;	  </td>
    </tr>
	<?php
	$iG++;
}
?>
<?php if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
 <?php if (substr($KdR5,0,5)=='1.5.4'){?>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
 <?php } ?>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
</tr>
<?php }else{ ?>
<tr height="100%">
 <td colspan="<?=$CS?>" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
<script languange="javascript">
$("#fFnD").focus();
</script>