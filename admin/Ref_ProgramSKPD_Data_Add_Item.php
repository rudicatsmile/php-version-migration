<?php
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);
#echo $gUNT;

$gSKP = fGlobal("Kd_Unit_Link","ref_unit","Kd_Unit",$gUNT,"=","","");
if ($gSKP==""){
	$MsG="kode maping Unit belum terisi..!!";
	echo "<script type='text/javascript'>errorMSG('".$MsG."')</script>";
}
else{
	$gNEW = "X.XX.".$gSKP.".00.XX";
	$gTBL = "ta_apbd_program_skpd";
	$gFLD = "";
	$gVAL = "";
	$gFLD = "kdUnit";
	$gVAL = "'$gUNT'";
	
	$gFLD.= ", idProgram";
	$gVAL.= ", '$gNEW'";
	
	$gFLD.= ", idReferensi";
	$gVAL.= ", ''";
	
	$gFLD.= ", nmProgram";
	$gVAL.= ", 'Nama Program...........???!!!'";
	
	$gFLD.= ", periode";
	$gVAL.= ", '$gTHN'";

	$gFLD.= ", apbd";
	$gVAL.= ", '0'";
	InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
	
	echo "<script type='text/javascript'>RefreshDATA('".$IdL."')</script>";
}

?>
