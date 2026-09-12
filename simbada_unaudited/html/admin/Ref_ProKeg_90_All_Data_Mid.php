<?
require('Connection.php');
require('FileFunction.php');
require "CheckLogin.php";
extract($_GET);

if ($Lev=='1'){
	$Wd  = 13;
	$KdR = "X";
}
else if ($Lev=='2'){
	$Wd  = 31;
	$KdR = $fKdM.".XX";
}
else if ($Lev=='3'){
	$Wd  = 52;
	$KdR = $fKdM.".XX";
}
else if ($Lev=='4'){
	$Wd  = 72;
	$KdR = $fKdM.".2.XX";
}
else if ($Lev=='5'){
	$Wd  = 105;
	$KdR = $fKdM.".XXXX";
}
#else if ($Lev=='6'){
#	$Wd  = 90;
#	$KdR = $fKdM.".XXX";
#}

$NmR = "";
if ($IdT){
	$nSQ = "SELECT Kode, Deskripsi FROM ref_keg_90_$Lev WHERE IDT='".$IdT."'";
	$nRs = mysql_query($nSQ);
	$mRo = mysql_fetch_array($nRs);
	$KdR = $mRo[0];
	$NmR = $mRo[1];
}

?>
<table border="0" width="600" height="23" cellspacing="0" cellpadding="0" align="center">
  <tr height="25">
    <td width="120">&nbsp;</td>
    <td width="26"></td>
    <td width="454"></td>
  </tr>
  
  <tr height="30">
    <td class="ar">Kode</td>
    <td class="ac">:</td>
    <td><input tabindex="20" name="fKdR" id="fKdR" type="text" value="<?=$KdR?>" readonly style="width:<?=$Wd?>px; padding-left:5px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="30">
    <td class="ar">Deskripsi</td>
    <td class="ac">:</td>
    <td rowspan="4">
	<textarea tabindex="20" name="fNmR" id="fNmR" style="border: 1px solid #C0C0C0; height:80px; width:350px" onkeypress="if (event.keyCode==13) {saveDATA('<?=$Lev?>','<?=$IdT?>','<?=$IdL?>'); return false;}"><?=$NmR?></textarea>	</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
  </tr>
  <tr>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
  </tr>
  <tr>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td><input type="button" name="B1" value="SAVE" onclick="saveDATA('<?=$ReO?>','<?=$Lev?>','<?=$IdT?>','<?=$IdL?>')" style="width: 80px; height: 21px" tabindex="20" />
    <input type="button" name="B2" value="RESET" onclick="editDATA('<?=$ReO?>','<?=$Lev?>','reset','','','<?=$IdL?>')" style="width: 80px; height: 21px" tabindex="20" /></td>
  </tr>
  <tr height="25">
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<script languange="javascript">
$("#fNmR").focus();
</script>