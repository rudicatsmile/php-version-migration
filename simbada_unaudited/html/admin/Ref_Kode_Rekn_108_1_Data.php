<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

$FnD = str_replace('**',' ',$gFnD);

$CrT = "";
if ($FnD)
{
	$CrT ="WHERE (Kd_Aset LIKE '%$gFnD%' OR Nm_Aset LIKE '%$FnD%')"; 
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="370px" style="border:0px">
<?
$iG=1;
$tJmL= 0;
$nSQ = "SELECT IDT, Kd_Aset, Nm_Aset FROM ref_rek_aset108_2 $CrT ORDER BY Kd_Aset";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$eIdT = $mRo[0];
	$eKdR = $mRo[1];
	
	$rCek = fGlobal("IDT","ref_rek_aset108_3","Kd_Aset",$eKdR."%","LIKE","","");
	?>
	<tr height="25"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td width="670" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[2]?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <a href="<?="Ref_Kode_Rekn_108_2.php?FrmG=REFERENSI -> KODE REKENING PERMENDAGRI 108&rKdR=".$eKdR."&IdL=".$_GET['IdL']?>" class="ico prev">&nbsp;View</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="editDATA('<?=$ReO?>','1','','<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="deleteDATA('<?=$ReO?>','1','<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico dell">&nbsp;Delete</a>&nbsp;&nbsp;
	  
	  </td>
    </tr>
	<?
	$iG++;
}
?>
<? if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc solid">&nbsp;</td>
</tr>
<? }else{ ?>
<tr height="100%">
 <td colspan="5" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
<script languange="javascript">
$("#fFnD").focus();
</script>