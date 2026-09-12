<?php
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');

extract($_GET);
//echo $IdL;
if ($gSUB=="ALL"){
	$gUPB = $gUNT."%";
}
else{
	$gUPB = $gSUB."%";
}

$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (Kd_UPB LIKE '%$gFnD%' OR Nm_UPB LIKE '%$FnD%')";
}

?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="330px" style="border:0px">
<?php
$nSQ = "SELECT Kd_UPB FROM ref_upb WHERE Kd_UPB LIKE '".$gSUB."%' ORDER BY Kd_UPB";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$UpB = $mRo[0];
	$eCK = fGlobal("IDT","ta_sp3d_lock","Kd_UPB:Tahun",$UpB.":".$gTH,"=:=","","");
	if ($eCK=='')
	{
		$SQ = "INSERT INTO ta_sp3d_lock SET 
		Kd_UPB='".$UpB."',
		Tahun='".$gTH."',
		Reguler='N',
		Afirmasi='N',
		Kinerja='N',
		Recorded=now(),
		Pencatat='".$UID."'";
		$nR = mysql_query($SQ);
	}
}

$iG=1;
$tJmL= 0;
$nSQ = "SELECT IDT, Kd_UPB, Nm_UPB FROM ref_upb WHERE Kd_UPB LIKE '".$gSUB."%' $CrT ORDER BY Kd_UPB";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$IdT = $mRo[0];
	$UpB = $mRo[1];
	
	$eReG = fGlobal("Reguler","ta_sp3d_lock","Kd_UPB:Tahun",$UpB.":".$gTH,"=:=","","");
	$GenCKa=""; $GenCKb="checked";
	$GenClrA=""; $GenClrB="";
	if ($eReG=="Y"){
		$GenCKa = "checked"; $GenCKb="";
		$GenClrA= "style='color:#FF0000'"; $GenClrB="";
	}
	
	$eAfI = fGlobal("Afirmasi","ta_sp3d_lock","Kd_UPB:Tahun",$UpB.":".$gTH,"=:=","","");
	$AfiCKa=""; $AfiCKb="checked";
	$AfiClrA=""; $AfiClrB="";
	if ($eAfI=="Y"){
		$AfiCKa = "checked"; $AfiCKb="";
		$AfiClrA= "style='color:#FF0000'"; $AfiClrB="";
	}
	
	$eKiN = fGlobal("Kinerja","ta_sp3d_lock","Kd_UPB:Tahun",$UpB.":".$gTH,"=:=","","");
	$KinCKa=""; $KinCKb="checked";
	$KinClrA=""; $KinClrB="";
	if ($eKiN=="Y"){
		$KinCKa = "checked"; $KinCKb="";
		$KinClrA= "style='color:#FF0000'"; $KinClrB="";
	}
	$CkAll  = "";
	$AllClr = "";
	$CekCrT = "ALL";
	if ($eReG=="Y" && $eAfI=="Y" && $eKiN=="Y"){
		$CkAll  = "checked";
		$AllClr = "style='color:#FF0000'";
		$CekCrT = "NonALL";
	}
	?>
	<tr height="29"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="105" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td width="285"<?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px"><?=$mRo[2]?></td>
	  <td width="150" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <label <?=$GenClrA?>><input name="radioReg<?=$IdT?>" type="radio" value="Y" <?=$GenCKa?> onclick="eSave('Y','Reguler','<?=$UpB?>','<?=$gTH?>','<?=$IdL?>'); return false;" />Lock</label>&nbsp;&nbsp;&nbsp;
	  <label <?=$GenClrB?>><input name="radioReg<?=$IdT?>" type="radio" value="N" <?=$GenCKb?> onclick="eSave('N','Reguler','<?=$UpB?>','<?=$gTH?>','<?=$IdL?>'); return false;" />UnLock</label>
	  </td>
	  <td width="150" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <label <?=$AfiClrA?>><input name="radioAfi<?=$IdT?>" type="radio" value="Y" <?=$AfiCKa?> onclick="eSave('Y','Afirmasi','<?=$UpB?>','<?=$gTH?>','<?=$IdL?>'); return false;" />Lock</label>&nbsp;&nbsp;&nbsp;
	  <label <?=$AfiClrB?>><input name="radioAfi<?=$IdT?>" type="radio" value="N" <?=$AfiCKb?> onclick="eSave('N','Afirmasi','<?=$UpB?>','<?=$gTH?>','<?=$IdL?>'); return false;" />UnLock</label>
	  </td>
	  <td width="150" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <label <?=$KinClrA?>><input name="radioKin<?=$IdT?>" type="radio" value="Y" <?=$KinCKa?> onclick="eSave('Y','Kinerja','<?=$UpB?>','<?=$gTH?>','<?=$IdL?>'); return false;" />Lock</label>&nbsp;&nbsp;&nbsp;
	  <label <?=$KinClrB?>><input name="radioKin<?=$IdT?>" type="radio" value="N" <?=$KinCKb?> onclick="eSave('N','Kinerja','<?=$UpB?>','<?=$gTH?>','<?=$IdL?>'); return false;" />UnLock</label>
	  </td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:10px">
	  <label <?=$AllClr?>><input type="checkbox" name="checkbox" value="checkbox" <?=$CkAll?>  onclick="eSave('Y','<?=$CekCrT?>','<?=$UpB?>','<?=$gTH?>','<?=$IdL?>'); return false;" />Lock All</label>	  </td>
    </tr>
	<?php
	$iG++;
}
?>
<?php if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 </tr>

<?php }else{ ?>
<tr height="100%">
 <td colspan="7" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
<script languange="javascript">
$("#fFnD").focus();
</script>