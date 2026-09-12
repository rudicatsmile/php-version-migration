<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

$val  = str_replace('**',' ',$val);

if ($CrT=='Desk') {$fLD = "deskripsi";}
if ($CrT=='Merk') {$fLD = "merk_type";}
if ($CrT=='Ukur') {$fLD = "Ukuran";}
if ($CrT=='Satu') {$fLD = "Satuan";}


if ($CrT=='Qty'){
	$fLD = "Qty";
	$val = fConvertToNumeric($val);
	$HrG = fGlobal("harga","ta_rkbmd","IDO",$mID,"=","","");
	$ToT = $val*$HrG;
}

if ($CrT=='Harga'){
	$fLD = "Harga";
	$val = fConvertToNumeric($val);
	$QtY = fGlobal("qty","ta_rkbmd","IDO",$mID,"=","","");
	$ToT = $val*$QtY;
}

if ($CrT=='Qty' || $CrT=='Harga'){
	$nSQ = "UPDATE ta_rkbmd SET $fLD='$val', Jumlah='$ToT', Pencatat='$UID', Recorded=now() WHERE IDO='$mID'";
}
else{
	$nSQ = "UPDATE ta_rkbmd SET $fLD='$val', Pencatat='$UID', Recorded=now() WHERE IDO='$mID'";
}
$nRs = mysql_query($nSQ);
$MsG="Proses penyimpanan data $fLD berhasi..!!";
?>
<script languange="javascript">
	P_Next('<?=$MsG?>','<?=$IdL?>');
</script>