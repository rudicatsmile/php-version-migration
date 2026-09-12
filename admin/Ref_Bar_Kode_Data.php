<?php
require('Connection.php');
require('FileFunction.php');
require "CheckLogin.php";
extract($_GET);
#echo $ReO;
$FnD = str_replace('**',' ',$gFnD);
$gUnt = str_replace('**',' ',$gUnt);
$gSub = str_replace('**',' ',$gSub);
$gUpb = str_replace('**',' ',$gUpb);

require ("Lap_Include.php");
// echo $gUnt."1<P>";
// echo $gSub."2<P>";
// echo $xUpb."3<P>";
// echo $gUpb."4<P>";



if(strpos($gUnt, 'All') !== false){
	$gFUpb = str_replace('All','%',$gUnt);	
}else{
	if(strpos($gSub, 'All') !== false){		
		$gFUpb = $gUnt;
	}else{	
		$gFUpb = $gUpb;
	}
	
}

$CrT ="WHERE (Kd_UPB LIKE '$gFUpb%' AND kode_bar LIKE '%$FnD%')  "; 
if($gUnt=="All"){
	if($gDoK=='1'){
		$CrT ="WHERE (Kd_UPB = '' AND kode_bar LIKE '%$FnD%') "; 
	}else if($gDoK=='2'){
		$CrT ="WHERE (Kd_UPB !=  '' AND kode_bar LIKE '%$FnD%') "; 
	}else{
		$CrT ="WHERE (Kd_UPB LIKE '$gFUpb%' AND kode_bar LIKE '%$FnD%') OR  (Kd_UPB = '' AND kode_bar LIKE '%$FnD%') "; 
	}
}

// echo $gUnt;

//$CrT ="WHERE (Kd_UPB LIKE '$gFUpb%' AND kode_bar LIKE '%$FnD%') OR  Kd_UPB = ''"; 


?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="370px" style="border:0px">
<?php
$iG=1;
$tJmL= 0;


$nSQ = "SELECT idt,Kd_UPB,kode_bar,Recorded,Recorded_map,userName,Referensi FROM ta_kib_108_barcode $CrT ORDER BY Kd_Aset_108";
 //echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$eIdT = $mRo[0];
	$eKdR = $mRo[1];
	$kode_bar = $mRo[2];
	//$rCek = fGlobal("IDT","ta_kib_108","kode_bar",$kode_bar.".%","LIKE","IDT LIMIT 0,1","0");
	//$rCek = fGlobal("IDT","ta_kib_108","kode_bar",$kode_bar,"=","IDT","1");
	$rCek = '';
	// $kode_bar = fGlobal("kode_bar","ta_kib_108_barcode","IDT",$eIdT,"=","","");

	$rDel="dele";
	if ($rCek){$rDel="delt";}
	?>
	<tr height="25"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td width="110" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[2]?></td>
	  <td width="110" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[6]?></td>
	  <td width="140" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[3]?></td>
	  <td width="140" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[4]?></td>
	  <td width="200" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[5]?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">

	  <!-- <a href="<?="Ref_ProKeg_90_2.php?FrmG=REFERENSI -> REFERENSI PROGRAM KEGIATAN 90/2019&rKdR=".$eKdR."&IdL=".$_GET['IdL']?>" class="ico prev">&nbsp;view</a>&nbsp;&nbsp;&nbsp;  -->
	  <a href="#" onClick="editDATA('<?=$mRo[2]?>','1','','<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;edit</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="deleteDATA('<?=$ReO?>','1','<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico <?=$rDel?>">&nbsp;Pembatalan</a>
	 
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