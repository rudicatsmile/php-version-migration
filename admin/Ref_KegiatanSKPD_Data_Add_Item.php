<?php
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);
#echo $gUNT;

$gSKP = fGlobal("Kd_Unit_Link","ref_unit","Kd_Unit",$gUNT,"=","","");
if ($gSKP==""){
	$MsG="Kode maping Unit belum terisi..!!";
	echo "<script type='text/javascript'>errorMSG('".$MsG."')</script>";
}
else if ($gPRG==""){
	$MsG="kode program belum dipilih..!!";
	echo "<script type='text/javascript'>errorMSG('".$MsG."')</script>";
}
else{
	$gNEW = $gPRG.".XXX";
	$gTBL = "ta_apbd_kegiatan_skpd";
	$gFLD = "";
	$gVAL = "";
	$gFLD = "kdUnit";
	$gVAL = "'$gUNT'";
	
	$gFLD.= ", idKegiatan";
	$gVAL.= ", '$gNEW'";
	
	$gFLD.= ", idReferensi";
	$gVAL.= ", ''";
	
	$gFLD.= ", nmKegiatan";
	$gVAL.= ", 'Nama Kegiatan...........???!!!'";
	
	$gFLD.= ", periode";
	$gVAL.= ", '$gTHN'";

	$gFLD.= ", apbd";
	$gVAL.= ", '0'";
	InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
	
	echo "<script type='text/javascript'>RefreshDATA('".$IdL."')</script>";
}

?>
