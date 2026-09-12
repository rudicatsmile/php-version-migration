<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

$val  = str_replace('**',' ',$val);

if ($CrT=='Desk') {$fLD = "deskripsi";}
if ($CrT=='Satu') {$fLD = "Satuan";}
if ($CrT=='Loka') {$fLD = "Lokasi";}

if ($CrT=='Qty'){
	$fLD = "Qty";
	$val = fConvertToNumeric($val);
	$HrG = fGlobal("harga","ta_rkpbmd_rinci","IDO",$rID,"=","","");
	$ToT = $val*$HrG;
}

if ($CrT=='Harga'){
	$fLD = "Harga";
	$val = fConvertToNumeric($val);
	$QtY = fGlobal("qty","ta_rkpbmd_rinci","IDO",$rID,"=","","");
	$ToT = $val*$QtY;
}

if ($CrT=='Qty' || $CrT=='Harga'){
	$nSQ = "UPDATE ta_rkpbmd_rinci SET $fLD='$val', Jumlah='$ToT', Pencatat='$UID', Recorded=now() WHERE IDO='$rID'";
}
else{
	$nSQ = "UPDATE ta_rkpbmd_rinci SET $fLD='$val', Pencatat='$UID', Recorded=now() WHERE IDO='$rID'";
}
$nRs = mysql_query($nSQ);
$MsG="Proses penyimpanan data $fLD berhasi..!!";
?>
<script languange="javascript">
	//P_Next('<?=$MsG?>','<?=$IdL?>');
	P_EditItemAset('refr','<?=$mID?>','','<?=$IdL?>')
</script>