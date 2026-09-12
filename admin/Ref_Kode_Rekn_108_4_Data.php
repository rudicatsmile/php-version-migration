<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

$FnD = str_replace('**',' ',$gFnD);

$CrT = "";
if ($FnD)
{
	$CrT ="AND (Kd_Aset LIKE '%$gFnD%' OR Nm_Aset LIKE '%$FnD%')"; 
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="325px" style="border:0px">
<?php
#$nSQ = "SELECT IDT, Kd_Rek_Old, Nm_Rek FROM ref_rek_90_4 WHERE Kd_Rek_Old LIKE '_._._.__' AND Kd_Rek='' ORDER BY IDT";
#echo $nSQ."<br>";
#$nRs = mysql_query($nSQ);
#while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
#{
#	$IdT = $mRo[0];
#	echo $mRo[1]."<br>";
#	$NewR = substr($mRo[1],0,4);
#	$NewR.= substr("00".substr($mRo[1],4,1),-2,2);
#	$NewR.= substr($mRo[1],-3,3);
#	echo $NewR."<br>";
#	
#	$nS = "UPDATE ref_rek_90_4 SET Kd_Rek='".$NewR."' WHERE IDT='".$IdT."'";
#	echo $nS."<br>";
#	$nR = mysql_query($nS);
#}

$iG=1;
$nSQ = "SELECT IDT, Kd_Aset, Nm_Aset FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$KdR3."%' $CrT ORDER BY Kd_Aset";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$eIdT = $mRo[0];
	$eKdR = $mRo[1];
	$rCek = "";
	$rCek = fGlobal("IDT","ref_rek_aset108_6","Kd_Aset",$eKdR."%","LIKE","","");
	?>
	<tr height="25"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td width="670" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[2]?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <a href="<?="Ref_Kode_Rekn_108_5.php?FrmG=REFERENSI -> KODE REKENING PERMENDAGRI 108&rKdR=".$eKdR."&IdL=".$_GET['IdL']?>" class="ico prev">&nbsp;View</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="editDATA('<?=$ReO?>','4','','<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="deleteDATA('<?=$ReO?>','4','<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico dell">&nbsp;Delete</a>&nbsp;&nbsp;
	  
	  </td>
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
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
</tr>
<?php }else{ ?>
<tr height="100%">
 <td colspan="5" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
<script languange="javascript">
$("#fFnD").focus();
</script>