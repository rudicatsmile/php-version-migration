<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

#echo $Lev.":".$ReO;

if ($Lev=='1'){
	$Wd  = 20;
	$KdR = $fKdM.".X";
}
else if ($Lev=='2'){
	$Wd  = 30;
	$KdR = $fKdM.".X";
}
else if ($Lev=='3'){
	$Wd  = 50;
	$KdR = $fKdM.".XX";
}
else if ($Lev=='4'){
	$Wd  = 65;
	$KdR = $fKdM.".XX";
}
else if ($Lev=='5'){
	$Wd  = 80;
	$KdR = $fKdM.".XX";
}

else if ($Lev=='6'){
	$Wd  = 105;
	$KdR = $fKdM.".XXX";
}

$NmR = "";
if ($IdT){
	$fD = '';
	if ($Lev==6){$fD=', Link_Kib_AE, Ms_Manfaat';}
	$nSQ = "SELECT Kd_Aset, Nm_Aset $fD FROM ref_rek_aset108_".($Lev+1)." WHERE IDT='".$IdT."'";
	$nRs = mysql_query($nSQ);
	$mRo = mysql_fetch_array($nRs);
	$KdR = $mRo[0];
	$NmR = $mRo[1];
	
	$KdT = "";
	$KdM = "";
	$UmR = "";
	if ($Lev==6)
	{
		$UmR = $mRo[3];
	}
	if (($Lev==6) && (substr($KdR,0,5)=='1.5.4'))
	{
		$KdT = $mRo[2];
		$KdM = fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$KdT,"=","","");
	}
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
    <td class="al"><input name="fKdR" id="fKdR" type="text" value="<?=$KdR?>" readonly style="width:<?=$Wd?>px; padding-left:5px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="30">
    <td class="ar">Deskripsi</td>
    <td class="ac">:</td>
    <td class="al" rowspan="4">
	<textarea name="fNmR" id="fNmR" style="border: 1px solid #C0C0C0; height:50px; width:340px" onkeypress="if (event.keyCode==13) {saveDATA('<?=$Lev?>','<?=$IdT?>','<?=$IdL?>'); return false;}"><?=$NmR?></textarea>	</td>
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
  <?php if (($Lev==6) && (substr($KdR,0,5)!='1.3.1')) {?>
  <tr height="25">
    <td class="ar">Umur Ekonomis</td>
    <td class="ac">:</td>
    <td class="al" style="font-weight:normal"><input name="fUmR" id="fUmR" type="text" value="<?=$UmR?>" style="text-align:center; width:30px; border: 1px solid #C0C0C0"/>&nbsp;&nbsp;Tahun</td>
  </tr>
  <?php } else {?>
  <input name="fUmR" id="fUmR" type="hidden" value="" style="width:50px; padding-left:5px; border: 1px solid #C0C0C0"/>
  <?php } ?>
  <?php if (($Lev==6) && (substr($KdR,0,5)=='1.5.4')) {?>
  <tr height="25">
    <td class="ar">Link Aset Tetap</td>
    <td class="ac">:</td>
    <td class="al"><input name="fKdT" id="fKdT" type="text" value="<?=$KdT?>" style="width:<?=$Wd?>px; padding-left:5px; border: 1px solid #C0C0C0; background:#CCFF66"/></td>
  </tr>
  <tr height="25">
    <td class="ar">Nama Aset Tetap</td>
    <td class="ac">:</td>
    <td class="al"><input name="fKdM" id="fKdM" type="text" value="<?=$KdM?>" readonly style="width:338px; padding-left:5px; border: 1px solid #C0C0C0; background:#CCFF66"/></td>
  </tr>
  <?php } else {?>
  <input name="fKdT" id="fKdT" type="hidden" value="" style="width:50px; padding-left:5px; border: 1px solid #C0C0C0"/>
  <?php } ?>
  <tr>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td class="al"><input type="button" name="B1" value="SAVE" onclick="saveDATA('<?=$ReO?>','<?=$Lev?>','<?=$IdT?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
    <input type="button" name="B2" value="RESET" onclick="editDATA('<?=$ReO?>','<?=$Lev?>','reset','','','<?=$IdL?>')" style="width: 80px; height: 21px" /></td>
  </tr>
  <tr>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<script languange="javascript">
$("#fNmR").focus();
</script>