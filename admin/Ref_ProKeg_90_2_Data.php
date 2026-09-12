<?php
require('Connection.php');
require('FileFunction.php');
require "CheckLogin.php";
extract($_GET);

$FnD = str_replace('**',' ',$gFnD);

$CrT = "";
if ($FnD)
{
	$CrT ="AND (Kode LIKE '%$gFnD%' OR Deskripsi LIKE '%$FnD%')"; 
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="370px" style="border:0px">
<?php
$iG=1;
$tJmL= 0;
$nSQ = "SELECT IDT, Kode, Deskripsi FROM ref_keg_90_2 WHERE Kode LIKE '".$gIdM.".__' $CrT ORDER BY Kode";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$eIdT = $mRo[0];
	$eKdR = $mRo[1];
	$rCek = fGlobal("IDT","ref_keg_90_3","Kode",$eKdR.".%","LIKE","IDT LIMIT 0,1","");
	$rDel="dele";
	if ($rCek){$rDel="delt";}
	?>
	<tr height="25"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td width="670" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[2]?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <a href="<?="Ref_ProKeg_90_3.php?FrmG=REFERENSI -> REFERENSI PROGRAM KEGIATAN 90/2019&rKdR=".$eKdR."&IdL=".$_GET['IdL']?>" class="ico prev">&nbsp;view</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="editDATA('<?=$ReO?>','2','','<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;edit</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="deleteDATA('<?=$ReO?>','2','<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico <?=$rDel?>">&nbsp;delete</a>&nbsp;&nbsp;
	  
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